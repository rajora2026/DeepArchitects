// time-tracker.js - Track time spent across multiple pages
class MultiPageTimeTracker {
    constructor() {
        this.startTime = Date.now();
        this.sessionId = null;
        this.pageActive = true;
        this.pageName = null;
        this.init();
    }
    
    init() {
        this.getTrackingData();
        this.setupEventListeners();
        this.startHeartbeat();
    }
    
    getTrackingData() {
        // Get data from PHP
        this.sessionId = document.body.getAttribute('data-session-id');
        this.pageName = document.body.getAttribute('data-page-name');
        
        if (!this.sessionId) {
            this.sessionId = localStorage.getItem('visitor_session_id') || 
                            this.generateSessionId();
            localStorage.setItem('visitor_session_id', this.sessionId);
        }
        
        if (!this.pageName) {
            this.pageName = document.title || window.location.pathname.split('/').pop();
        }
    }
    
    setupEventListeners() {
        // Track visibility changes
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                this.pageActive = false;
                this.sendTimeData('visibility_change');
            } else {
                this.pageActive = true;
                this.startTime = Date.now();
                this.sendTimeData('visibility_resume');
            }
        });
        
        // Track before unload (page navigation)
        window.addEventListener('beforeunload', () => {
            this.sendTimeData('page_unload');
        });
        
        // Track clicks (user engagement)
        document.addEventListener('click', this.debounce(() => {
            this.sendTimeData('user_interaction');
        }, 1000));
    }
    
    startHeartbeat() {
        // Send heartbeat every 30 seconds while active
        setInterval(() => {
            if (this.pageActive) {
                this.sendTimeData('heartbeat');
            }
        }, 30000);
    }
    
    sendTimeData(eventType = 'heartbeat') {
        const currentTime = Date.now();
        const timeSpent = Math.round((currentTime - this.startTime) / 1000);
        
        if (timeSpent > 0 && this.sessionId) {
            const data = {
                session_id: this.sessionId,
                page_name: this.pageName,
                time_spent: timeSpent,
                total_time: this.getTotalSessionTime(),
                event_type: eventType,
                timestamp: new Date().toISOString(),
                page_url: window.location.href,
                page_title: document.title,
                scroll_depth: this.getScrollDepth()
            };
            
            // Use sendBeacon for unload events (more reliable)
            if (eventType === 'page_unload') {
                navigator.sendBeacon('time-tracker.php', JSON.stringify(data));
            } else {
                // Use fetch for other events
                this.sendViaFetch(data);
            }
            
            // Reset start time for next interval
            if (['heartbeat', 'page_unload', 'visibility_change'].includes(eventType)) {
                this.startTime = currentTime;
            }
        }
    }
    
    sendViaFetch(data) {
        fetch('time-tracker.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
            keepalive: true // Keep request alive even after page unload
        }).catch(error => console.log('Time tracking error:', error));
    }
    
    getTotalSessionTime() {
        const sessionStart = localStorage.getItem('session_start_time');
        if (!sessionStart) {
            localStorage.setItem('session_start_time', Date.now());
            return 0;
        }
        return Math.round((Date.now() - parseInt(sessionStart)) / 1000);
    }
    
    getScrollDepth() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;
        return scrollHeight > 0 ? Math.round((scrollTop / scrollHeight) * 100) : 0;
    }
    
    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
    
    generateSessionId() {
        return 'session_' + Math.random().toString(36).substr(2, 9) + '_' + Date.now();
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    window.pageTimeTracker = new MultiPageTimeTracker();
});