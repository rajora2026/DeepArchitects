<?php
// view-data-safe.php - View all data including backups
session_start();

// 5-minute login timeout
$login_timeout = 300; // 5 minutes in seconds

// Check if user is timed out
if (isset($_SESSION['login_time'])) {
    if (time() - $_SESSION['login_time'] > $login_timeout) {
        session_destroy();
        header('Location: /');
        exit;
    } else {
        // Update login time on each request
        $_SESSION['login_time'] = time();
    }
}

include 'tracker-safe.php';

// Simple password protection
$password = 'Rajbhai123'; // Change this!

if ($_POST['password'] ?? '' === $password) {
    $_SESSION['authenticated'] = true;
    $_SESSION['login_time'] = time();
}

if (!($_SESSION['authenticated'] ?? false)) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Access Analytics Data | Deep Architect</title>
        	<link rel="icon" href="/images/deeplogo.jpeg" />


        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                <h2>🔒 Analytics Access</h2>
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

$tracker = new SafeTracker();
$allData = $tracker->getAllData();
$stats = $tracker->getStats();

// Calculate page statistics
$pageStats = [];
$uniquePageVisits = [];

foreach ($allData as $visit) {
    $page = $visit['page_visited'];
    $session = $visit['session_id'];
    
    $pageStats[$page]['total_visits'] = ($pageStats[$page]['total_visits'] ?? 0) + 1;
    $pageStats[$page]['last_visit'] = $visit['timestamp'];
    
    if (!isset($uniquePageVisits[$page])) {
        $uniquePageVisits[$page] = [];
    }
    $uniquePageVisits[$page][$session] = true;
    $pageStats[$page]['unique_visitors'] = count($uniquePageVisits[$page]);
}

// Calculate session time left
$time_left = $login_timeout - (time() - $_SESSION['login_time']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safe Analytics Dashboard | Deep Architect</title>
    	<link rel="icon" href="/images/deeplogo.jpeg" />


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

        /* Data Source Cards */
        .data-source-card {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            border-left: 4px solid var(--primary);
        }

        .data-source-card .stat-number {
            background: linear-gradient(135deg, #1976d2, #0d47a1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Protection Features */
        .protection-features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-top: 2rem;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 1rem;
            background: var(--light);
            border-radius: 12px;
            border-left: 4px solid var(--success);
        }

        .feature-item i {
            color: var(--success);
            font-size: 1.2rem;
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

        /* Security Banner */
        .security-banner {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            border: 1px solid #ffeaa7;
            border-left: 4px solid var(--warning);
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .security-banner i {
            color: var(--warning);
            font-size: 1.2rem;
        }

        /* Progress Bar */
        .progress-bar {
            height: 6px;
            background: var(--gray-light);
            border-radius: 3px;
            overflow: hidden;
            margin-top: 10px;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 3px;
            transition: width 1s linear;
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
            
            .protection-features {
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
    </style>
</head>
<body>
    <div class="dashboard">
        <!-- Header -->
        <header class="header">
            <div class="header-content">
                <div class="logo">
                    🛡️ Safe Analytics Pro By Raj
                </div>
                <div class="session-timer <?php echo $time_left < 60 ? 'danger' : ($time_left < 120 ? 'warning' : ''); ?>" id="sessionTimer">
                    ⏰ <span id="timerDisplay"><?php echo sprintf('%02d:%02d', floor($time_left / 60), $time_left % 60); ?></span>
                </div>
                <div class="nav-links">
                    <a href="#overview">Overview</a>
                    <a href="#protection">Protection</a>
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
                    Session expires in: <span id="welcomeTimer"><?php echo sprintf('%02d:%02d', floor($time_left / 60), $time_left % 60); ?></span>
                </div>
                <h1>🛡️ Safe Analytics Dashboard Created by Rajvardhan</h1>
                <p>Protected analytics with automatic backup and recovery</p>
            </section>

            <!-- Security Banner -->
            <div class="security-banner">
                <i class="fas fa-shield-alt"></i>
                <div>
                    <strong>Enhanced Protection:</strong> Your data is protected with automatic backups, emergency recovery, and no data deletion.
                    <div class="progress-bar">
                        <div class="progress-fill" id="progressBar" style="width: <?php echo ($time_left / 300) * 100; ?>%"></div>
                    </div>
                </div>
            </div>

            <!-- Overview Stats -->
            <section id="overview">
                <h2 class="section-title">📊 Overview Statistics</h2>
                <div class="stats-grid">
                    <div class="stat-card data-source-card">
                        <h3>Backup Files</h3>
                        <div class="stat-number"><?php echo $stats['data_sources']['backup_files']; ?></div>
                        <p>Protected backup files</p>
                    </div>
                    <div class="stat-card data-source-card">
                        <h3>Emergency Files</h3>
                        <div class="stat-number"><?php echo $stats['data_sources']['emergency_files']; ?></div>
                        <p>Emergency recovery files</p>
                    </div>
                    <div class="stat-card">
                        <h3>Total Visits</h3>
                        <div class="stat-number"><?php echo $stats['total_visits']; ?></div>
                        <p>All-time visits</p>
                    </div>
                    <div class="stat-card">
                        <h3>Unique Visitors</h3>
                        <div class="stat-number"><?php echo $stats['unique_visitors']; ?></div>
                        <p>Distinct users</p>
                    </div>
                </div>
            </section>

            <!-- Protection Features -->
            <section id="protection">
                <h2 class="section-title">🛡️ Data Protection Features</h2>
                <div class="protection-features">
                    <div class="feature-item">
                        <i class="fas fa-ban"></i>
                        <div>
                            <strong>No Data Deletion</strong>
                            <div style="font-size: 0.9rem; color: var(--gray);">Data is never deleted, only archived</div>
                        </div>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-rotate"></i>
                        <div>
                            <strong>Automatic Backup Rotation</strong>
                            <div style="font-size: 0.9rem; color: var(--gray);">Multiple backup layers for safety</div>
                        </div>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-life-ring"></i>
                        <div>
                            <strong>Emergency Recovery</strong>
                            <div style="font-size: 0.9rem; color: var(--gray);">Instant data restoration</div>
                        </div>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-tools"></i>
                        <div>
                            <strong>Corruption Restoration</strong>
                            <div style="font-size: 0.9rem; color: var(--gray);">Automatic file repair</div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Page Statistics -->
            <section id="pages">
                <h2 class="section-title">📄 Page Performance</h2>
                <div class="page-stats">
                    <?php foreach ($pageStats as $pageName => $pageData): ?>
                    <div class="page-stat-card">
                        <h3><?php echo htmlspecialchars($pageName); ?></h3>
                        <div class="stat-item">
                            <span class="stat-label">Total Visits:</span>
                            <span class="stat-value"><?php echo $pageData['total_visits']; ?></span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Unique Visitors:</span>
                            <span class="stat-value"><?php echo $pageData['unique_visitors']; ?></span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Last Visit:</span>
                            <span class="stat-value"><?php echo $pageData['last_visit']; ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <!-- Recent Visits -->
            <section id="visits">
                <h2 class="section-title">👥 Recent Visitor Activity</h2>
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
                            <?php 
                            $recentVisits = array_slice(array_reverse($allData), 0, 50);
                            foreach ($recentVisits as $visit): 
                            ?>
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
                        📥 Export JSON Data
                    </a>
                    <a href="/" class="export-btn">
                        🏠 Back to Website
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
        let totalSeconds = <?php echo $time_left; ?>;
        
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
            
            // Update progress bar
            const progress = (totalSeconds / 300) * 100;
            document.getElementById('progressBar').style.width = `${progress}%`;
            
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
        
        // Auto-refresh data every 30 seconds
        setInterval(() => {
            // You can add auto-refresh functionality here if needed
            console.log('Safe analytics session active, time remaining:', totalSeconds, 'seconds');
        }, 30000);
    </script>
</body>
</html>
<?php
// Handle exports
if ($_GET['export'] ?? '' === 'json') {
    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="safe_analytics_export.json"');
    echo json_encode([
        'stats' => $stats,
        'page_stats' => $pageStats,
        'recent_visits' => $recentVisits,
        'total_records' => count($allData),
        'export_timestamp' => date('Y-m-d H:i:s')
    ], JSON_PRETTY_PRINT);
    exit;
}

// Handle logout
if ($_GET['logout'] ?? '' === '1') {
    session_destroy();
    header('Location: /');
    exit;
}
?>