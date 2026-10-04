<?php
// time-tracker.php - Handle multi-page time tracking
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get JSON input
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
        
        // Save time data
        $timeFile = __DIR__ . '/data/time_data.json';
        $dir = dirname($timeFile);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        
        $existingData = [];
        if (file_exists($timeFile)) {
            $existingContent = file_get_contents($timeFile);
            $existingData = json_decode($existingContent, true) ?? [];
        }
        
        $existingData[] = $timeData;
        file_put_contents($timeFile, json_encode($existingData, JSON_PRETTY_PRINT));
        
        echo json_encode(['status' => 'success', 'message' => 'Time data saved']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
}
?>