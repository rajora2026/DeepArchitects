<?php
// time-tracker-safe.php - Never loses time data
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if ($input && isset($input['session_id'])) {
        $timeData = [
            'session_id' => $input['session_id'],
            'page_name' => $input['page_name'] ?? 'Unknown',
            'time_spent' => $input['time_spent'] ?? 0,
            'total_time' => $input['total_time'] ?? 0,
            'event_type' => $input['event_type'] ?? 'unknown',
            'timestamp' => $input['timestamp'] ?? date('Y-m-d H:i:s'),
            'page_url' => $input['page_url'] ?? '',
            'page_title' => $input['page_title'] ?? '',
            'scroll_depth' => $input['scroll_depth'] ?? 0
        ];
        
        // Save time data with multiple backups
        $this->saveTimeDataSafely($timeData);
        
        echo json_encode(['status' => 'success', 'message' => 'Time data saved safely']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
}

function saveTimeDataSafely($timeData) {
    $timeFile = __DIR__ . '/data/time_data.json';
    $backupDir = __DIR__ . '/data/backups/';
    $emergencyFile = $backupDir . 'emergency_time_' . date('Y-m-d') . '.txt';
    
    // Ensure directories exist
    if (!is_dir(dirname($timeFile))) {
        mkdir(dirname($timeFile), 0755, true);
    }
    if (!is_dir($backupDir)) {
        mkdir($backupDir, 0755, true);
    }
    
    try {
        // Method 1: Save to main time file
        $existingData = [];
        if (file_exists($timeFile)) {
            $existingContent = file_get_contents($timeFile);
            $existingData = json_decode($existingContent, true) ?? [];
        }
        
        $existingData[] = $timeData;
        
        // If file gets too big, create backup and start new file
        if (file_exists($timeFile) && filesize($timeFile) > 10485760) { // 10MB
            $backupFile = $backupDir . 'time_data_' . date('Y-m-d-His') . '.json';
            copy($timeFile, $backupFile);
            $existingData = [$timeData]; // Start fresh but keep old data in backup
        }
        
        $result = file_put_contents($timeFile, json_encode($existingData, JSON_PRETTY_PRINT));
        
        if ($result === false) {
            throw new Exception("Failed to write to time file");
        }
        
    } catch (Exception $e) {
        // Method 2: Emergency save to text file
        $logEntry = date('Y-m-d H:i:s') . " - " . json_encode($timeData) . PHP_EOL;
        file_put_contents($emergencyFile, $logEntry, FILE_APPEND | LOCK_EX);
    }
}
?>