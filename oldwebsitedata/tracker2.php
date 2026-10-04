<?php
// tracker.php - Multi-page visitor data collection

class MultiPageTracker {
    private $dataFile = 'visitor_data.json';
    private $maxFileSize = 10485760; // 10MB max file size
    private $currentPage;
    
    public function __construct($pageName = null) {
        $this->dataFile = __DIR__ . '/data/' . $this->dataFile;
        $this->currentPage = $pageName ?: $this->detectPage();
        $this->ensureDataDirectory();
        
        // Start session for cross-page tracking
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    private function detectPage() {
        $scriptName = $_SERVER['SCRIPT_NAME'];
        $page = pathinfo($scriptName, PATHINFO_FILENAME);
        
        // Map common page names
        $pageMap = [
            'index' => 'Home',
            'about' => 'About Us',
            'contact' => 'Contact',
            'design' => 'Design',
            'projects' => 'Projects',
            'career' => 'Career',
            'privacy' => 'Privacy Policy'
        ];
        
        return $pageMap[$page] ?? ucfirst($page);
    }
    
    private function ensureDataDirectory() {
        $dir = dirname($this->dataFile);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
    }
    
    public function collectData() {
        $visitorData = [
            'timestamp' => date('Y-m-d H:i:s'),
            'ip_address' => $this->getClientIP(),
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown',
            'page_visited' => $this->currentPage,
            'page_url' => $_SERVER['REQUEST_URI'] ?? '/',
            'http_referer' => $_SERVER['HTTP_REFERER'] ?? 'Direct',
            'request_method' => $_SERVER['REQUEST_METHOD'] ?? 'GET',
            'session_id' => $this->getSessionId(),
            'visit_number' => $this->getVisitNumber(),
            'previous_page' => $_SESSION['previous_page'] ?? 'First Visit'
        ];
        
        // Add geolocation data
        $visitorData = array_merge($visitorData, $this->getGeolocationData($visitorData['ip_address']));
        
        // Update session for next page
        $_SESSION['previous_page'] = $this->currentPage;
        $_SESSION['visit_count'] = ($_SESSION['visit_count'] ?? 0) + 1;
        $_SESSION['first_visit'] = $_SESSION['first_visit'] ?? date('Y-m-d H:i:s');
        
        return $visitorData;
    }
    
    private function getClientIP() {
        $ip_keys = ['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR'];
        
        foreach ($ip_keys as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip);
                    if ($this->validateIP($ip)) {
                        return $ip;
                    }
                }
            }
        }
        return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    }
    
    private function validateIP($ip) {
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE);
    }
    
    private function getGeolocationData($ip) {
        $geoData = [
            'country' => 'Unknown',
            'country_code' => 'Unknown',
            'region' => 'Unknown',
            'city' => 'Unknown',
            'latitude' => '0',
            'longitude' => '0',
            'timezone' => 'Unknown'
        ];
        
        // Skip for localhost/private IPs
        if ($this->isPrivateIP($ip)) {
            return $geoData;
        }
        
        // Try ipinfo.io first
        $geoData = $this->getGeoFromIPInfo($ip, $geoData);
        
        return $geoData;
    }
    
    private function isPrivateIP($ip) {
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false;
    }
    
    private function getGeoFromIPInfo($ip, $geoData) {
        try {
            // Free tier - no token needed for basic info
            $url = "https://ipinfo.io/{$ip}/json";
            $response = @file_get_contents($url, false, stream_context_create([
                'http' => ['timeout' => 3]
            ]));
            
            if ($response) {
                $data = json_decode($response, true);
                if (!isset($data['error'])) {
                    $geoData['country'] = $data['country'] ?? 'Unknown';
                    $geoData['country_code'] = $data['country'] ?? 'Unknown';
                    $geoData['region'] = $data['region'] ?? 'Unknown';
                    $geoData['city'] = $data['city'] ?? 'Unknown';
                    
                    if (isset($data['loc'])) {
                        $loc = explode(',', $data['loc']);
                        $geoData['latitude'] = $loc[0] ?? '0';
                        $geoData['longitude'] = $loc[1] ?? '0';
                    }
                    
                    $geoData['timezone'] = $data['timezone'] ?? 'Unknown';
                }
            }
        } catch (Exception $e) {
            // Silent fail
        }
        
        return $geoData;
    }
    
    private function getSessionId() {
        if (!isset($_SESSION['visitor_session_id'])) {
            $_SESSION['visitor_session_id'] = md5(uniqid() . $_SERVER['HTTP_USER_AGENT'] . $this->getClientIP());
        }
        return $_SESSION['visitor_session_id'];
    }
    
    private function getVisitNumber() {
        return $_SESSION['visit_count'] ?? 1;
    }
    
    public function saveData($data) {
        try {
            // Prevent file from growing too large
            if (file_exists($this->dataFile) && filesize($this->dataFile) > $this->maxFileSize) {
                $this->rotateLogFile();
            }
            
            $existingData = [];
            if (file_exists($this->dataFile)) {
                $existingContent = file_get_contents($this->dataFile);
                $existingData = json_decode($existingContent, true) ?? [];
            }
            
            $existingData[] = $data;
            
            file_put_contents($this->dataFile, json_encode($existingData, JSON_PRETTY_PRINT));
            return true;
        } catch (Exception $e) {
            error_log("MultiPageTracker Error: " . $e->getMessage());
            return false;
        }
    }
    
    private function rotateLogFile() {
        $backupFile = $this->dataFile . '.' . date('Y-m-d-His');
        if (file_exists($this->dataFile)) {
            rename($this->dataFile, $backupFile);
        }
    }
    
    public function getPageStats() {
        if (!file_exists($this->dataFile)) {
            return [];
        }
        
        $data = json_decode(file_get_contents($this->dataFile), true) ?? [];
        $pageStats = [];
        $uniquePageVisits = [];
        
        foreach ($data as $visit) {
            $page = $visit['page_visited'];
            $session = $visit['session_id'];
            
            // Count total visits per page
            $pageStats[$page]['total_visits'] = ($pageStats[$page]['total_visits'] ?? 0) + 1;
            
            // Count unique visitors per page
            if (!isset($uniquePageVisits[$page])) {
                $uniquePageVisits[$page] = [];
            }
            $uniquePageVisits[$page][$session] = true;
            $pageStats[$page]['unique_visitors'] = count($uniquePageVisits[$page]);
            
            // Track last visit
            $pageStats[$page]['last_visit'] = $visit['timestamp'];
        }
        
        return $pageStats;
    }
    
    public function getOverallStats() {
        if (!file_exists($this->dataFile)) {
            return ['total_visits' => 0, 'unique_visitors' => 0, 'pages_tracked' => 0];
        }
        
        $data = json_decode(file_get_contents($this->dataFile), true) ?? [];
        $uniqueIPs = [];
        $pages = [];
        
        foreach ($data as $visit) {
            $uniqueIPs[$visit['ip_address']] = true;
            $pages[$visit['page_visited']] = true;
        }
        
        return [
            'total_visits' => count($data),
            'unique_visitors' => count($uniqueIPs),
            'pages_tracked' => count($pages),
            'data_file' => $this->dataFile
        ];
    }
}

// Auto-initialize for each page
$currentPage = basename($_SERVER['SCRIPT_NAME'], '.php');
$tracker = new MultiPageTracker($currentPage);
$visitorData = $tracker->collectData();
$tracker->saveData($visitorData);

// Make data available for JavaScript
$trackingData = [
    'session_id' => $visitorData['session_id'],
    'page_name' => $visitorData['page_visited'],
    'visit_number' => $visitorData['visit_number']
];
?>