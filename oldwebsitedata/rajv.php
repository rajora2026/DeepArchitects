<?php
// At the VERY TOP of about.php - nothing before this line
include 'tracker-debug.php';
include 'tracker-safe.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Design | Deep Architects</title>
    <!-- Your existing head content -->
</head>

<body data-session-id="<?php echo $trackingData['session_id']; ?>" data-page-name="<?php echo $trackingData['page_name']; ?>">

    <!-- Your existing body content -->
        <script src="time-tracker-safe.js"></script>

    <!-- Include tracking scripts -->
    <script src="time-tracker.js"></script>
</body>
</html>