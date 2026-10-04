<?php
// view-data.php - View multi-page analytics
session_start();
include 'tracker.php';

// Simple password protection
$password = 'Rajbhai123'; // Change this!

if ($_POST['password'] ?? '' === $password) {
    $_SESSION['authenticated'] = true;
    $_SESSION['login_time'] = time(); // Set login timestamp
}

// Check if session has expired (5 minutes = 300 seconds)
$login_duration = 300; // 5 minutes in seconds
if (($_SESSION['login_time'] ?? 0) + $login_duration < time()) {
    session_destroy();
    // Remove the header redirect - just let it show the login form
    // header('Location: /'); // This line was causing the issue
}
if (!($_SESSION['authenticated'] ?? false)) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Access Analytics Data by Rajvardhan </title>
        	<link rel="icon" href="/images/deeplogo.jpeg" />


        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
            }
            
            .login-container {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                padding: 40px;
                border-radius: 20px;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
                width: 100%;
                max-width: 400px;
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
            
            .login-header {
                text-align: center;
                margin-bottom: 30px;
            }
            
            .login-header h2 {
                color: #333;
                font-size: 28px;
                font-weight: 600;
                margin-bottom: 10px;
            }
            
            .login-header p {
                color: #666;
                font-size: 14px;
            }
            
            .form-group {
                margin-bottom: 20px;
            }
            
            input {
                width: 100%;
                padding: 15px;
                border: 2px solid #e1e5e9;
                border-radius: 10px;
                font-size: 16px;
                transition: all 0.3s ease;
                background: #fff;
            }
            
            input:focus {
                outline: none;
                border-color: #667eea;
                box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            }
            
            button {
                width: 100%;
                padding: 15px;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                border: none;
                border-radius: 10px;
                font-size: 16px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
            }
            
            button:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
            }
        </style>
    </head>
    <body>
        <div class="login-container">
            <div class="login-header">
                <h2>🔒 Analytics Access </h2>
                <p>Enter password to view dashboard</p>
                <p style="font-size: 12px; color: #888; margin-top: 5px;">Session expires in 5 minutes</p>
            </div>
            <form method="post">
                <div class="form-group">
                    <input type="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit">🚀 View Analytics</button>
            </form>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// Update session time on each page load to extend session
$_SESSION['login_time'] = time();

// Define data file paths directly
$dataFile = __DIR__ . '/data/visitor_data.json';
$timeFile = __DIR__ . '/data/time_data.json';

// Read visitor data
$visitorData = [];
if (file_exists($dataFile)) {
    $visitorData = json_decode(file_get_contents($dataFile), true) ?? [];
}

// Calculate overall statistics
$overallStats = [
    'total_visits' => count($visitorData),
    'unique_visitors' => count(array_unique(array_column($visitorData, 'ip_address'))),
    'pages_tracked' => count(array_unique(array_column($visitorData, 'page_visited')))
];

// Calculate page-specific statistics
$pageStats = [];
foreach ($visitorData as $visit) {
    $pageName = $visit['page_visited'];
    
    if (!isset($pageStats[$pageName])) {
        $pageStats[$pageName] = [
            'total_visits' => 0,
            'unique_visitors' => [],
            'last_visit' => ''
        ];
    }
    
    $pageStats[$pageName]['total_visits']++;
    $pageStats[$pageName]['unique_visitors'][$visit['ip_address']] = true;
    
    // Update last visit if this is more recent
    if (empty($pageStats[$pageName]['last_visit']) || 
        strtotime($visit['timestamp']) > strtotime($pageStats[$pageName]['last_visit'])) {
        $pageStats[$pageName]['last_visit'] = $visit['timestamp'];
    }
}

// Convert unique visitors count
foreach ($pageStats as &$stats) {
    $stats['unique_visitors'] = count($stats['unique_visitors']);
}

// Read time data
$timeData = [];
if (file_exists($timeFile)) {
    $timeData = json_decode(file_get_contents($timeFile), true) ?? [];
}

// Calculate time spent per page
$pageTimeStats = [];
foreach ($timeData as $timeEntry) {
    $page = $timeEntry['page_name'];
    $timeSpent = $timeEntry['time_spent'];
    
    if (!isset($pageTimeStats[$page])) {
        $pageTimeStats[$page] = [
            'total_time' => 0,
            'visits' => 0,
            'avg_time' => 0
        ];
    }
    
    $pageTimeStats[$page]['total_time'] += $timeSpent;
    $pageTimeStats[$page]['visits']++;
    $pageTimeStats[$page]['avg_time'] = round($pageTimeStats[$page]['total_time'] / $pageTimeStats[$page]['visits']);
}

// Get recent visits for display
$recentVisits = array_slice(array_reverse($visitorData), 0, 50);

// Calculate remaining time for the session
$remaining_time = ($_SESSION['login_time'] + $login_duration) - time();
$minutes_remaining = floor($remaining_time / 60);
$seconds_remaining = $remaining_time % 60;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi-Page Analytics Dashboard created by Rajvardhan</title>
    	<link rel="icon" href="/images/deeplogo.jpeg" />


    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #667eea;
            --primary-dark: #5a6fd8;
            --secondary: #764ba2;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --dark: #1f2937;
            --light: #f8fafc;
            --gray: #6b7280;
            --gray-light: #e5e7eb;
        }

        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: var(--dark);
            line-height: 1.6;
        }

        .dashboard {
            min-height: 100vh;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
        }

        /* Header Styles */
        .header {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
        }

        .session-timer {
            background: linear-gradient(135deg, var(--warning), var(--danger));
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .session-timer.warning {
            background: linear-gradient(135deg, var(--warning), #f97316);
        }

        .session-timer.danger {
            background: linear-gradient(135deg, var(--danger), #dc2626);
            animation: pulse 1s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--gray);
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .nav-links a:hover {
            background: var(--primary);
            color: white;
        }

        /* Main Content */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        .welcome-section {
            text-align: center;
            margin-bottom: 3rem;
            padding: 2rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 20px;
            color: white;
            box-shadow: 0 20px 40px rgba(102, 126, 234, 0.3);
            position: relative;
            overflow: hidden;
        }

        .session-info {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 10px;
            font-size: 0.9rem;
            backdrop-filter: blur(10px);
        }

        .welcome-section h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .welcome-section p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .stat-card h3 {
            font-size: 0.9rem;
            color: var(--gray);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
        }

        /* Page Stats */
        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .page-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .page-stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .page-stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .page-stat-card h3 {
            color: var(--primary);
            margin-bottom: 1rem;
            font-size: 1.2rem;
            font-weight: 600;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--gray-light);
        }

        .stat-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
            border-bottom: 1px solid var(--gray-light);
        }

        .stat-item:last-child {
            border-bottom: none;
        }

        .stat-label {
            color: var(--gray);
            font-weight: 500;
        }

        .stat-value {
            font-weight: 600;
            color: var(--dark);
        }

        /* Table Styles */
        .table-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            font-size: 0.9rem;
        }

        td {
            padding: 1rem;
            border-bottom: 1px solid var(--gray-light);
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover {
            background: rgba(102, 126, 234, 0.05);
        }

        /* Export Links */
        .export-links {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .export-btn {
            padding: 0.75rem 1.5rem;
            background: white;
            color: var(--primary);
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            border: 2px solid var(--primary);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .export-btn:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .logout-btn {
            background: var(--danger);
            border-color: var(--danger);
            color: white;
        }

        .logout-btn:hover {
            background: #dc2626;
            border-color: #dc2626;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }
            
            .header-content {
                flex-direction: column;
                gap: 1rem;
            }
            
            .nav-links {
                gap: 1rem;
            }
            
            .welcome-section h1 {
                font-size: 2rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .page-stats {
                grid-template-columns: 1fr;
            }
            
            table {
                font-size: 0.9rem;
            }
            
            th, td {
                padding: 0.75rem 0.5rem;
            }
            
            .session-info {
                position: relative;
                top: auto;
                right: auto;
                margin-bottom: 1rem;
            }
        }

        /* Loading Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .stat-card, .page-stat-card, .table-container {
            animation: fadeIn 0.6s ease-out;
        }

        /* Badge Styles */
        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .badge-primary {
            background: rgba(102, 126, 234, 0.1);
            color: var(--primary);
        }

        .badge-success {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <!-- Header -->
        <header class="header">
            <div class="header-content">
                <div class="logo">
                    📊 Analytics Pro by Raj.
                </div>
                <div class="session-timer <?php echo $remaining_time < 60 ? 'danger' : ($remaining_time < 120 ? 'warning' : ''); ?>" id="sessionTimer">
                    ⏰ <span id="timerDisplay"><?pp echo sprintf('%02d:%02d', $minutes_remaining, $seconds_remaining); ?></span>
                </div>
                <div class="nav-links">
                    <a href="#overview">Overview</a>
                    <a href="#pages">Page Stats</a>
                    <a href="#visits">Recent Visits</a>
                    <a href="?logout=1" class="logout-btn">🚪 Logout</a>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="container">
            <!-- Welcome Section -->
            <section class="welcome-section">
                <div class="session-info">
                    Session expires in: <span id="welcomeTimer"><?php echo sprintf('%02d:%02d', $minutes_remaining, $seconds_remaining); ?></span>
                </div>
                <h1>📈 Analytics Dashboard Created by Rajvardhan </h1>
                <p>Real-time insights into your website performance</p>
            </section>

            <!-- Overview Stats -->
            <section id="overview">
                <h2 class="section-title">📊 Overview Statistics</h2>
                <div class="stats-grid">
                    <div class="stat-card">
                        <h3>Total Visits</h3>
                        <div class="stat-number"><?php echo number_format($overallStats['total_visits']); ?></div>
                        <p>All-time page visits</p>
                    </div>
                    <div class="stat-card">
                        <h3>Unique Visitors</h3>
                        <div class="stat-number"><?php echo number_format($overallStats['unique_visitors']); ?></div>
                        <p>Distinct users</p>
                    </div>
                    <div class="stat-card">
                        <h3>Pages Tracked</h3>
                        <div class="stat-number"><?php echo number_format($overallStats['pages_tracked']); ?></div>
                        <p>Active pages</p>
                    </div>
                </div>
            </section>

            <!-- Page Statistics -->
            <section id="pages">
                <h2 class="section-title">📄 Page Performance</h2>
                <div class="page-stats">
                    <?php foreach ($pageStats as $pageName => $stats): ?>
                    <div class="page-stat-card">
                        <h3><?php echo htmlspecialchars($pageName); ?></h3>
                        <div class="stat-item">
                            <span class="stat-label">Total Visits:</span>
                            <span class="stat-value"><?php echo number_format($stats['total_visits']); ?></span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Unique Visitors:</span>
                            <span class="stat-value"><?php echo number_format($stats['unique_visitors']); ?></span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Last Visit:</span>
                            <span class="stat-value"><?php echo $stats['last_visit']; ?></span>
                        </div>
                        <?php if (isset($pageTimeStats[$pageName])): ?>
                        <div class="stat-item">
                            <span class="stat-label">Avg Time:</span>
                            <span class="stat-value badge badge-success"><?php echo $pageTimeStats[$pageName]['avg_time']; ?>s</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Total Time:</span>
                            <span class="stat-value"><?php echo $pageTimeStats[$pageName]['total_time']; ?>s</span>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <!-- Recent Visits -->
            <section id="visits">
                <h2 class="section-title">👥 Recent Visits</h2>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Timestamp</th>
                                <th>Page</th>
                                <th>IP Address</th>
                                <th>Location</th>
                                <th>Referrer</th>
                                <th>Visit #</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentVisits as $visit): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($visit['timestamp']); ?></td>
                                <td>
                                    <span class="badge badge-primary"><?php echo htmlspecialchars($visit['page_visited']); ?></span>
                                </td>
                                <td><?php echo htmlspecialchars($visit['ip_address']); ?></td>
                                <td>
                                    <?php echo htmlspecialchars($visit['city']); ?>, 
                                    <?php echo htmlspecialchars($visit['country']); ?>
                                </td>
                                <td title="<?php echo htmlspecialchars($visit['http_referer']); ?>">
                                    <?php 
                                    $referrer = htmlspecialchars($visit['http_referer']);
                                    echo strlen($referrer) > 25 ? substr($referrer, 0, 25) . '...' : $referrer; 
                                    ?>
                                </td>
                                <td>
                                    <span class="badge badge-primary">#<?php echo htmlspecialchars($visit['visit_number']); ?></span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Export Section -->
            <section>
                <div class="export-links">
                    <a href="?export=json" class="export-btn">
                        📥 Export JSON
                    </a>
                    <a href="?export=csv" class="export-btn">
                        📊 Export CSV
                    </a>
                    <a href="?logout=1" class="export-btn logout-btn">
                        🚪 Logout
                    </a>
                </div>
            </section>
        </div>
    </div>

    <script>
        // Session timer countdown
        let totalSeconds = <?php echo $remaining_time; ?>;
        
        function updateTimer() {
            if (totalSeconds <= 0) {
                // Redirect to home page when time expires
                window.location.href = '/';
                return;
            }
            
            totalSeconds--;
            const minutes = Math.floor(totalSeconds / 60);
            const seconds = totalSeconds % 60;
            const timerDisplay = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            
            // Update all timer displays
            document.getElementById('timerDisplay').textContent = timerDisplay;
            document.getElementById('welcomeTimer').textContent = timerDisplay;
            
            // Update timer style based on remaining time
            const timerElement = document.getElementById('sessionTimer');
            if (totalSeconds < 60) {
                timerElement.className = 'session-timer danger';
            } else if (totalSeconds < 120) {
                timerElement.className = 'session-timer warning';
            }
        }
        
        // Update timer every second
        setInterval(updateTimer, 1000);
        
        // Auto-refresh data every 30 seconds (optional)
        setInterval(() => {
            // You can add auto-refresh functionality here if needed
            console.log('Session active, time remaining:', totalSeconds, 'seconds');
        }, 30000);
    </script>
</body>
</html>
<?php
// Handle exports
if ($_GET['export'] ?? '' === 'json') {
    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="analytics_export.json"');
    echo json_encode([
        'overall_stats' => $overallStats,
        'page_stats' => $pageStats,
        'time_stats' => $pageTimeStats,
        'recent_visits' => $recentVisits
    ], JSON_PRETTY_PRINT);
    exit;
}

if ($_GET['export'] ?? '' === 'csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="analytics_export.csv"');
    
    $output = fopen('php://output', 'w');
    
    // Overall stats
    fputcsv($output, ['Overall Statistics']);
    fputcsv($output, ['Metric', 'Value']);
    fputcsv($output, ['Total Visits', $overallStats['total_visits']]);
    fputcsv($output, ['Unique Visitors', $overallStats['unique_visitors']]);
    fputcsv($output, ['Pages Tracked', $overallStats['pages_tracked']]);
    fputcsv($output, []);
    
    // Page stats
    fputcsv($output, ['Page Statistics']);
    fputcsv($output, ['Page', 'Total Visits', 'Unique Visitors', 'Last Visit']);
    foreach ($pageStats as $pageName => $stats) {
        fputcsv($output, [
            $pageName,
            $stats['total_visits'],
            $stats['unique_visitors'],
            $stats['last_visit']
        ]);
    }
    fputcsv($output, []);
    
    // Time stats
    fputcsv($output, ['Time Statistics']);
    fputcsv($output, ['Page', 'Total Time (s)', 'Visits', 'Average Time (s)']);
    foreach ($pageTimeStats as $pageName => $timeStats) {
        fputcsv($output, [
            $pageName,
            $timeStats['total_time'],
            $timeStats['visits'],
            $timeStats['avg_time']
        ]);
    }
    fputcsv($output, []);
    
    // Recent visits
    fputcsv($output, ['Recent Visits']);
    fputcsv($output, ['Timestamp', 'Page', 'IP Address', 'Country', 'City', 'Referrer', 'Visit #']);
    foreach ($recentVisits as $visit) {
        fputcsv($output, [
            $visit['timestamp'],
            $visit['page_visited'],
            $visit['ip_address'],
            $visit['country'],
            $visit['city'],
            $visit['http_referer'],
            $visit['visit_number']
        ]);
    }
    
    fclose($output);
    exit;
}

// Handle logout
if ($_GET['logout'] ?? '' === '1') {
    session_destroy();
    // Redirect to this same page to show login form
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}