<?php
// tracker-safe.php - SAFE VERSION - Never deletes or destroys data
class SafeTracker {
    private $dataFile = 'visitor_data.json';
    private $backupDir = 'backups/';
    private $maxFileSize = 10485760; // 10MB - when reached, creates new file instead of deleting
    
    public function __construct($pageName = null) {
        $this->dataFile = __DIR__ . '/data/' . $this->dataFile;
        $this->backupDir = __DIR__ . '/data/' . $this->backupDir;
        $this->currentPage = $pageName ?: $this->detectPage();
        
        $this->ensureDataDirectory();
        $this->ensureBackupDirectory();
        
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    private function detectPage() {
        $scriptName = $_SERVER['SCRIPT_NAME'];
        $page = pathinfo($scriptName, PATHINFO_FILENAME);
        
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
    
    private function ensureBackupDirectory() {
        if (!is_dir($this->backupDir)) {
            mkdir($this->backupDir, 0755, true);
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
        
        if ($this->isPrivateIP($ip)) {
            return $geoData;
        }
        
        return $this->getGeoFromIPInfo($ip, $geoData);
    }
    
    private function isPrivateIP($ip) {
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false;
    }
    
    private function getGeoFromIPInfo($ip, $geoData) {
        try {
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
            // Silent fail - data preserved
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
            // NEVER DELETE DATA - if file gets too big, create a new file with timestamp
            if (file_exists($this->dataFile) && filesize($this->dataFile) > $this->maxFileSize) {
                $this->createNewDataFile(); // Creates backup and new file - NO DELETION
            }
            
            $existingData = [];
            if (file_exists($this->dataFile)) {
                $existingContent = file_get_contents($this->dataFile);
                $existingData = json_decode($existingContent, true) ?? [];
                
                // If JSON is corrupted, recover what we can
                if ($existingData === null) {
                    $existingData = $this->recoverData($existingContent);
                }
            }
            
            // Add new data
            $existingData[] = $data;
            
            // Save with error handling
            $result = file_put_contents($this->dataFile, json_encode($existingData, JSON_PRETTY_PRINT));
            
            if ($result === false) {
                // If save fails, try emergency save
                $this->emergencySave($data);
                return false;
            }
            
            return true;
            
        } catch (Exception $e) {
            // Emergency save if anything goes wrong
            $this->emergencySave($data);
            error_log("SafeTracker Error: " . $e->getMessage());
            return false;
        }
    }
    
    private function createNewDataFile() {
        // NEVER DELETE - just create a new file with timestamp
        $timestamp = date('Y-m-d-His');
        $newFilename = $this->backupDir . 'visitor_data_' . $timestamp . '.json';
        
        if (file_exists($this->dataFile)) {
            // Copy current data to backup (preserve all data)
            copy($this->dataFile, $newFilename);
            
            // Keep current data in main file but start fresh for new entries
            // The main file will continue with empty array, old data is safe in backup
            file_put_contents($this->dataFile, json_encode([], JSON_PRETTY_PRINT));
        }
    }
    
    private function recoverData($corruptedContent) {
        // Try to recover data from corrupted JSON
        $recoveredData = [];
        
        // Simple recovery: look for JSON objects in the corrupted content
        preg_match_all('/\{(?:[^{}]|(?R))*\}/', $corruptedContent, $matches);
        
        foreach ($matches[0] as $potentialJson) {
            $data = json_decode($potentialJson, true);
            if ($data !== null && is_array($data)) {
                $recoveredData[] = $data;
            }
        }
        
        // If recovery found data, backup the corrupted file
        if (!empty($recoveredData)) {
            $backupFile = $this->backupDir . 'recovered_' . date('Y-m-d-His') . '.json';
            file_put_contents($backupFile, $corruptedContent);
        }
        
        return $recoveredData;
    }
    
    private function emergencySave($data) {
        // Last resort save - never lose data
        $emergencyFile = $this->backupDir . 'emergency_data_' . date('Y-m-d') . '.txt';
        $logEntry = date('Y-m-d H:i:s') . " - " . json_encode($data) . PHP_EOL;
        file_put_contents($emergencyFile, $logEntry, FILE_APPEND | LOCK_EX);
    }
    
    public function getAllData() {
        $allData = [];
        
        // Get data from main file
        if (file_exists($this->dataFile)) {
            $content = file_get_contents($this->dataFile);
            $mainData = json_decode($content, true) ?? [];
            $allData = array_merge($allData, $mainData);
        }
        
        // Get data from backup files (never lose any data)
        $backupFiles = glob($this->backupDir . 'visitor_data_*.json');
        foreach ($backupFiles as $backupFile) {
            $content = file_get_contents($backupFile);
            $backupData = json_decode($content, true) ?? [];
            $allData = array_merge($allData, $backupData);
        }
        
        // Get data from emergency files
        $emergencyFiles = glob($this->backupDir . 'emergency_data_*.txt');
        foreach ($emergencyFiles as $emergencyFile) {
            $lines = file($emergencyFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                $parts = explode(" - ", $line, 2);
                if (count($parts) === 2) {
                    $data = json_decode($parts[1], true);
                    if ($data !== null) {
                        $allData[] = $data;
                    }
                }
            }
        }
        
        // Sort by timestamp
        usort($allData, function($a, $b) {
            return strtotime($a['timestamp']) - strtotime($b['timestamp']);
        });
        
        return $allData;
    }
    
    public function getStats() {
        $allData = $this->getAllData();
        $uniqueIPs = [];
        $pages = [];
        
        foreach ($allData as $visit) {
            $uniqueIPs[$visit['ip_address']] = true;
            $pages[$visit['page_visited']] = true;
        }
        
        return [
            'total_visits' => count($allData),
            'unique_visitors' => count($uniqueIPs),
            'pages_tracked' => count($pages),
            'data_sources' => [
                'main_file' => file_exists($this->dataFile) ? basename($this->dataFile) : 'Not found',
                'backup_files' => count(glob($this->backupDir . 'visitor_data_*.json')),
                'emergency_files' => count(glob($this->backupDir . 'emergency_data_*.txt'))
            ]
        ];
    }
}

// Auto-initialize for each page - SAFE VERSION
try {
    $currentPage = basename($_SERVER['SCRIPT_NAME'], '.php');
    $tracker = new SafeTracker($currentPage);
    $visitorData = $tracker->collectData();
    $saveResult = $tracker->saveData($visitorData);
    
    // Make data available for JavaScript
    $trackingData = [
        'session_id' => $visitorData['session_id'],
        'page_name' => $visitorData['page_visited'],
        'visit_number' => $visitorData['visit_number']
    ];
    
} catch (Exception $e) {
    // Even if tracker fails, the page should still work
    error_log("Tracker initialization failed: " . $e->getMessage());
    $trackingData = [
        'session_id' => 'error_' . uniqid(),
        'page_name' => 'Unknown',
        'visit_number' => 1
    ];
}
?>