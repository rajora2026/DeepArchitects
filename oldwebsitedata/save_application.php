<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get application data
    $applicationData = json_decode($_POST['applicationData'], true);
    
    // Handle file upload
    $uploadDir = 'uploads/applications/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    
    $fileName = uniqid() . '_' . $_FILES['cvFile']['name'];
    $filePath = $uploadDir . $fileName;
    
    if (move_uploaded_file($_FILES['cvFile']['tmp_name'], $filePath)) {
        // Add file info to application data
        $applicationData['cvFile'] = [
            'name' => $_FILES['cvFile']['name'],
            'path' => $filePath,
            'size' => $_FILES['cvFile']['size']
        ];
        
        // Save application data as JSON
        $jsonData = json_encode($applicationData, JSON_PRETTY_PRINT);
        $jsonFileName = 'applications/' . uniqid() . '_application.json';
        file_put_contents($jsonFileName, $jsonData);
        
        echo json_encode([
            'success' => true,
            'message' => 'Application submitted successfully',
            'applicationId' => uniqid()
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'File upload failed'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method'
    ]);
}
?>