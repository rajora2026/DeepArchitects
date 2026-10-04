
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
    <title>Site Map - Deep Architects</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    	<link rel="icon" href="/images/deeplogo.jpeg" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        /* Base Styles */
        :root {
            --primary-color: #d4af37; /* Gold */
            --secondary-color: #333333; /* Dark Gray */
            --light-color: #f8f8f8; /* Light Gray */
            --dark-color: #222222; /* Black */
            --text-color: #555555;
            --white: #ffffff;
            --transition: all 0.3s ease;
            --box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            --section-padding: 100px 0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            line-height: 1.6;
            overflow-x: hidden;
            background-color: var(--white);
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--dark-color);
            line-height: 1.2;
        }

        a {
            text-decoration: none;
            color: inherit;
            transition: var(--transition);
        }

        ul {
            list-style: none;
        }

        img {
            max-width: 100%;
            height: auto;
            object-fit: cover;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .btn {
            display: inline-block;
            padding: 12px 30px;
            border-radius: 4px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: var(--transition);
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: var(--white);
        }

        .btn-primary:hover {
            background-color: var(--dark-color);
            transform: translateY(-3px);
        }

        .btn-secondary {
            background-color: transparent;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
        }

        .btn-secondary:hover {
            background-color: var(--primary-color);
            color: var(--white);
        }

        .section {
            padding: var(--section-padding);
            position: relative;
        }

        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title {
            font-size: 36px;
            margin-bottom: 15px;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: var(--primary-color);
        }

        .section-subtitle {
            font-size: 18px;
            color: var(--text-color);
            max-width: 700px;
            margin: 0 auto;
        }

        /* Header Styles */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            padding: 20px 0;
            transition: var(--transition);
            background-color: transparent;
        }

        .header.scrolled {
            background-color: rgba(255, 255, 255, 0.95);
            box-shadow: var(--box-shadow);
            padding: 15px 0;
        }

        .header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 700;
            color: var(--white);
            letter-spacing: 1px;
        }

        .logo span {
            color: var(--primary-color);
        }

        .header.scrolled .logo {
            color: var(--dark-color);
        }

        .nav-list {
            display: flex;
        }

        .nav-link {
            color: var(--white);
            margin-left: 30px;
            font-weight: 500;
            position: relative;
            padding: 5px 0;
        }

        .header.scrolled .nav-link {
            color: var(--dark-color);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--primary-color);
            transition: var(--transition);
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        .hamburger {
            display: none;
            cursor: pointer;
        }

        .bar {
            display: block;
            width: 25px;
            height: 3px;
            margin: 5px auto;
            background-color: var(--white);
            transition: var(--transition);
        }

        .header.scrolled .bar {
            background-color: var(--dark-color);
        }

        /* Breadcrumb */
        .breadcrumb {
            background-color: var(--light-color);
            padding: 15px 0;
            margin-top: 80px;
        }

        .breadcrumb .container {
            display: flex;
            align-items: center;
        }

        .breadcrumb a {
            color: var(--primary-color);
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .breadcrumb .separator {
            margin: 0 10px;
            color: var(--text-color);
        }

        /* Sitemap Hero */
        .sitemap-hero {
            background-color: var(--light-color);
            padding: 60px 0;
            text-align: center;
        }

        .sitemap-hero h1 {
            font-size: 42px;
            margin-bottom: 20px;
            color: var(--dark-color);
        }

        .sitemap-hero p {
            font-size: 18px;
            max-width: 700px;
            margin: 0 auto;
            color: var(--text-color);
        }

        /* Sitemap Content */
        .sitemap-content {
            padding: 80px 0;
        }

        .sitemap-section {
            margin-bottom: 60px;
        }

        .sitemap-section h2 {
            font-size: 28px;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--primary-color);
            color: var(--dark-color);
        }

        .sitemap-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .sitemap-item {
            background-color: var(--white);
            border-radius: 8px;
            padding: 20px;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            display: flex;
            align-items: center;
        }

        .sitemap-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .sitemap-icon {
            width: 50px;
            height: 50px;
            background-color: rgba(212, 175, 55, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: var(--primary-color);
            font-size: 20px;
        }

        .sitemap-item a {
            font-weight: 500;
            color: var(--dark-color);
            flex: 1;
        }

        .sitemap-item a:hover {
            color: var(--primary-color);
        }

        /* Footer */
        .footer {
            background-color: var(--dark-color);
            color: var(--white);
            padding: 80px 0 0;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 60px;
        }

        .footer-col h3 {
            color: var(--white);
            font-size: 20px;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 10px;
        }

        .footer-col h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 2px;
            background-color: var(--primary-color);
        }

        .footer-col p {
            margin-bottom: 20px;
            opacity: 0.8;
        }

        .footer-col ul li {
            margin-bottom: 10px;
        }

        .footer-col ul li a {
            opacity: 0.8;
            transition: var(--transition);
        }

        .footer-col ul li a:hover {
            opacity: 1;
            color: var(--primary-color);
            padding-left: 5px;
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-links a {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .social-links a:hover {
            background-color: var(--primary-color);
            transform: translateY(-5px);
        }

        .newsletter-form {
            display: flex;
            margin-top: 20px;
        }

        .newsletter-form input {
            flex: 1;
            padding: 12px 15px;
            border: none;
            border-radius: 4px 0 0 4px;
            font-family: 'Poppins', sans-serif;
        }

        .newsletter-form button {
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            padding: 0 20px;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
            transition: var(--transition);
        }

        .newsletter-form button:hover {
            background-color: var(--white);
            color: var(--primary-color);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        .footer-bottom p {
            opacity: 0.7;
            font-size: 14px;
        }

        .footer-links {
            display: flex;
            gap: 20px;
        }

        .footer-links a {
            font-size: 14px;
            opacity: 0.7;
            transition: var(--transition);
        }

        .footer-links a:hover {
            opacity: 1;
            color: var(--primary-color);
        }

        /* Back to Top Button */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background-color: var(--primary-color);
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
            z-index: 999;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .back-to-top.active {
            opacity: 1;
            visibility: visible;
        }

        .back-to-top:hover {
            background-color: var(--dark-color);
            transform: translateY(-5px);
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .hamburger {
                display: block;
            }
            
            .hamburger.active .bar:nth-child(2) {
                opacity: 0;
            }
            
            .hamburger.active .bar:nth-child(1) {
                transform: translateY(8px) rotate(45deg);
            }
            
            .hamburger.active .bar:nth-child(3) {
                transform: translateY(-8px) rotate(-45deg);
            }
            
            .nav-list {
                position: fixed;
                top: 80px;
                left: -100%;
                width: 100%;
                background-color: var(--white);
                flex-direction: column;
                align-items: center;
                padding: 20px 0;
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
                transition: var(--transition);
            }
            
            .nav-list.active {
                left: 0;
            }
            
            .nav-link {
                margin: 15px 0;
                color: var(--dark-color);
            }
            
            .header.scrolled .nav-list {
                top: 70px;
            }
            
            .sitemap-hero h1 {
                font-size: 32px;
            }
            
            .section-title {
                font-size: 30px;
            }
            
            .section-subtitle {
                font-size: 16px;
            }
            
            .section {
                padding: 70px 0;
            }
            
            .sitemap-list {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .sitemap-hero h1 {
                font-size: 28px;
            }
            
            .btn {
                padding: 10px 20px;
            }
            
            .footer-content {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body data-session-id="<?php echo $trackingData['session_id']; ?>" data-page-name="<?php echo $trackingData['page_name']; ?>">

    <!-- Your existing body content -->
        <script src="time-tracker-safe.js"></script>

    <!-- Include tracking scripts -->
    <script src="time-tracker.js"></script>
    
        <!-- Header -->
    <header class="header" id="header">
        <div class="container">
            <a href="index.php" class="logo">DEEP<span>ARCHITECTS</span></a>
            <nav class="nav">
                <ul class="nav-list">
                    <li><a href="index.php" class="nav-link">Home</a></li>
                    <li><a href="about.php" class="nav-link">About</a></li>
                    <li><a href="design.php" class="nav-link">Design</a></li>
                    <li><a href="projects.php" class="nav-link">Projects</a></li>
                    <li><a href="contact.php" class="nav-link">Contact</a></li>
                </ul>
                <div class="hamburger">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </nav>
        </div>
    </header>

    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <div class="container">
            <a href="index.php">Home</a>
            <span class="separator">/</span>
            <span>Site Map</span>
        </div>
    </div>

    <!-- Sitemap Hero -->
    <section class="sitemap-hero">
        <div class="container">
            <h1>Website Site Map</h1>
            <p>Explore all the pages and sections of our website in one convenient location</p>
        </div>
    </section>

    <!-- Sitemap Content -->
    <section class="sitemap-content">
        <div class="container">
            <div class="sitemap-section">
                <h2>Main Pages</h2>
                <div class="sitemap-list">
                    <div class="sitemap-item">
                        <div class="sitemap-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <a href="index.php">Home</a>
                    </div>
                    <div class="sitemap-item">
                        <div class="sitemap-icon">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <a href="about.php">About Us</a>
                    </div>
                    <div class="sitemap-item">
                        <div class="sitemap-icon">
                            <i class="fas fa-drafting-compass"></i>
                        </div>
                        <a href="design.php">Design</a>
                    </div>
                    <div class="sitemap-item">
                        <div class="sitemap-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <a href="projects.php">Projects</a>
                    </div>
                    <div class="sitemap-item">
                        <div class="sitemap-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <a href="contact.php">Contact</a>
                    </div>
                </div>
            </div>

            <div class="sitemap-section">
                <h2>Services</h2>
                <div class="sitemap-list">
                    <div class="sitemap-item">
                        <div class="sitemap-icon">
                            <i class="fas fa-drafting-compass"></i>
                        </div>
                        <a href="#">Architectural Design</a>
                    </div>
                    <div class="sitemap-item">
                        <div class="sitemap-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <a href="#">Residential Design</a>
                    </div>
                    <div class="sitemap-item">
                        <div class="sitemap-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <a href="#">Commercial Design</a>
                    </div>
                    <div class="sitemap-item">
                        <div class="sitemap-icon">
                            <i class="fas fa-couch"></i>
                        </div>
                        <a href="#">Interior Design</a>
                    </div>
                    <div class="sitemap-item">
                        <div class="sitemap-icon">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <a href="#">Urban Planning</a>
                    </div>
                    <div class="sitemap-item">
                        <div class="sitemap-icon">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <a href="#">Sustainability Consulting</a>
                    </div>
                </div>
            </div>

            <div class="sitemap-section">
                <h2>Policy Pages</h2>
                <div class="sitemap-list">
                    <div class="sitemap-item">
                        <div class="sitemap-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <a href="privacy.php">Privacy Policy</a>
                    </div>
                    <div class="sitemap-item">
                        <div class="sitemap-icon">
                            <i class="fas fa-file-contract"></i>
                        </div>
                        <a href="terms.php">Terms of Service</a>
                    </div>
                </div>
            </div>

            <div class="sitemap-section">
                <h2>Additional Resources</h2>
                <div class="sitemap-list">
                    <div class="sitemap-item">
                        <div class="sitemap-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <a href="portfolio.php">Portfolio</a>
                    </div>
                    <div class="sitemap-item">
                        <div class="sitemap-icon">
                            <i class="fas fa-comment"></i>
                        </div>
                        <a href="testimonials.php">Testimonials</a>
                    </div>
                    <div class="sitemap-item">
                        <div class="sitemap-icon">
                            <i class="fas fa-blog"></i>
                        </div>
                        <a href="blog.php">Blog</a>
                    </div>
                    <div class="sitemap-item">
                        <div class="sitemap-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <a href="careers.php">Careers</a>
                    </div>
                    <div class="sitemap-item">
                        <div class="sitemap-icon">
                            <i class="fas fa-question-circle"></i>
                        </div>
                        <a href="faq.php">FAQ</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-col">
                    <a href="index.php" class="logo">DEEP<span>ARCHITECTS</span></a>
                    <p>Shaping the future of architecture through innovative design, sustainability, and timeless aesthetics.</p>
                    <div class="social-links">
                        <a target="_blank" href="https://www.facebook.com/rupesh.chawda.581"><i class="fab fa-facebook"></i></a>
                        <a target="_blank" href="https://www.instagram.com/deeparchitect.official/"><i class="fab fa-instagram"></i></a>
                        <a target="_blank" href="https://www.linkedin.com/in/rupeshchawda/"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="footer-col">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="design.php">Design</a></li>
                        <li><a href="projects.php">Projects</a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="sitemap.php">Site Map</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h3>Services</h3>
                    <ul>
                        <li><a href="#">Architectural Design</a></li>
                        <li><a href="#">Residential Design</a></li>
                        <li><a href="#">Commercial Design</a></li>
                        <li><a href="#">Interior Design</a></li>
                        <li><a href="#">Urban Planning</a></li>
                        <li><a href="#">Sustainability Consulting</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h3>Newsletter</h3>
                    <p>Subscribe to our newsletter for the latest updates and projects.</p>
                    <form class="newsletter-form">
                        <input type="email" placeholder="Your Email" required>
                        <button type="submit"><i class="fas fa-paper-plane"></i></button>
                    </form>
                </div>
            </div>
            <div class="footer-bottom">
                <p>Deep Architect & <a href="https://www.rajvardhansingh.in/">Rajvardhan Singh</a></p>
                <p>2026. All Rights Reserved</p>
                <div class="footer-links">
                    <a href="privacy.php">Privacy Policy</a>
                    <a href="terms.php">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <a href="#" class="back-to-top" id="backToTop">
        <i class="fas fa-arrow-up"></i>
    </a>

    <script>
        // Header scroll effect
        window.addEventListener('scroll', function() {
            const header = document.getElementById('header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Mobile menu toggle
        const hamburger = document.querySelector('.hamburger');
        const navList = document.querySelector('.nav-list');

        hamburger.addEventListener('click', function() {
            hamburger.classList.toggle('active');
            navList.classList.toggle('active');
        });

        // Back to top button
        const backToTopButton = document.getElementById('backToTop');

        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                backToTopButton.classList.add('active');
            } else {
                backToTopButton.classList.remove('active');
            }
        });

        backToTopButton.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>
</body>
</html>