// time-tracker-safe.js - Completely Hidden Multi-Page Time Tracker
class MultiPageTimeTracker {
    constructor() {
        this.startTime = Date.now();
        this.sessionId = null;
        this.pageActive = true;
        this.pageName = null;
        this.totalSessionTime = 0;
        this.pageVisitTime = 0;
        this.scrollDepth = 0;
        this.userInteractions = 0;
        this.init();
    }

    init() {
        this.getTrackingData();
        this.setupEventListeners();
        this.startHeartbeat();
        console.log('🔒 Safe Time Tracker Activated (Hidden Mode)');
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

        // Initialize session start time if not set
        if (!localStorage.getItem('session_start_time')) {
            localStorage.setItem('session_start_time', Date.now());
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
            this.userInteractions++;
            this.sendTimeData('user_interaction');
        }, 2000));

        // Track scrolling
        document.addEventListener('scroll', this.debounce(() => {
            this.scrollDepth = this.getScrollDepth();
        }, 500));

        // Track form interactions
        this.trackFormInteractions();

        // Track mouse movements (engagement)
        document.addEventListener('mousemove', this.debounce(() => {
            this.sendTimeData('user_engaged');
        }, 10000));
    }

    trackFormInteractions() {
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', () => {
                this.sendTimeData('form_submission');
            });

            const inputs = form.querySelectorAll('input, textarea, select');
            inputs.forEach(input => {
                input.addEventListener('focus', () => {
                    this.sendTimeData('form_interaction');
                });
            });
        });
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
                scroll_depth: this.scrollDepth,
                user_interactions: this.userInteractions,
                viewport_size: `${window.innerWidth}x${window.innerHeight}`,
                language: navigator.language,
                timezone: Intl.DateTimeFormat().resolvedOptions().timeZone
            };

            // Use sendBeacon for unload events (more reliable)
            if (eventType === 'page_unload') {
                if (navigator.sendBeacon) {
                    const blob = new Blob([JSON.stringify(data)], { type: 'application/json' });
                    navigator.sendBeacon('time-tracker-safe.php', blob);
                } else {
                    this.sendViaFetch(data);
                }
            } else {
                // Use fetch for other events
                this.sendViaFetch(data);
            }

            // Update local time tracking
            this.pageVisitTime += timeSpent;
            this.totalSessionTime = this.getTotalSessionTime();

            // Reset start time for next interval
            if (['heartbeat', 'page_unload', 'visibility_change'].includes(eventType)) {
                this.startTime = currentTime;
            }
        }
    }

    sendViaFetch(data) {
        fetch('time-tracker-safe.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
            keepalive: true // Keep request alive even after page unload
        })
            .then(response => response.json())
            .then(result => {
                // Silent success - no UI feedback
                if (result.status === 'success') {
                    // Data saved successfully (completely silent)
                }
            })
            .catch(error => {
                console.log('Time tracking error:', error);
                // Emergency local storage backup (silent)
                this.emergencyLocalSave(data);
            });
    }

    emergencyLocalSave(data) {
        try {
            const emergencyKey = 'time_tracker_emergency_' + Date.now();
            const emergencyData = {
                ...data,
                emergency_save: true,
                local_timestamp: Date.now()
            };
            localStorage.setItem(emergencyKey, JSON.stringify(emergencyData));

            // Try to send emergency data later (silent)
            setTimeout(() => {
                this.retryEmergencySaves();
            }, 10000); // Retry after 10 seconds

        } catch (e) {
            // Silent fail - no UI feedback
            console.error('Emergency save failed:', e);
        }
    }

    retryEmergencySaves() {
        // Retry sending any emergency saved data (silent)
        for (let i = 0; i < localStorage.length; i++) {
            const key = localStorage.key(i);
            if (key && key.startsWith('time_tracker_emergency_')) {
                try {
                    const data = JSON.parse(localStorage.getItem(key));
                    this.sendViaFetch(data);
                    localStorage.removeItem(key); // Remove if successful
                } catch (e) {
                    // Silent fail - no UI feedback
                    console.error('Failed to retry emergency save:', e);
                }
            }
        }
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

    // Public method to get current tracking data (for debugging only)
    getCurrentStats() {
        return {
            sessionId: this.sessionId,
            pageName: this.pageName,
            pageTime: Math.round((Date.now() - this.startTime) / 1000),
            sessionTime: this.getTotalSessionTime(),
            scrollDepth: this.scrollDepth,
            interactions: this.userInteractions,
            pageActive: this.pageActive
        };
    }

    // Method to check if tracker is working (for debugging)
    isActive() {
        return true;
    }
}

// Initialize when DOM is loaded - Completely silent
document.addEventListener('DOMContentLoaded', () => {
    window.timeTracker = new MultiPageTimeTracker();

    // Optional: Only log in development mode
    if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
        console.log('%c🔒 Hidden Time Tracker Active', 'color: #27ae60; font-weight: bold; font-size: 12px;');
        console.log('%cTracker running silently in background', 'color: #666; font-size: 11px;');
    }
});

// Export for module usage
if (typeof module !== 'undefined' && module.exports) {
    module.exports = MultiPageTimeTracker;
}