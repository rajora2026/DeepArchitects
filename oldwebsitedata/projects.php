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

    <title>Our Projects | Deep Architects</title>
    	<link rel="icon" href="/images/deeplogo.jpeg" />
    	<link rel="icon" href="/images/deeplogo.jpeg" />
    <link rel="icon" href="/images/deeplogo.jpeg" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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

        /* Projects Hero Section */
        .projects-hero {
            height: 70vh;
            background-image: url('https://images.unsplash.com/photo-1487958449943-2429e8be8625?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: center;
            text-align: center;
            color: var(--white);
        }

        .projects-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
        }

        .projects-hero .container {
            position: relative;
            z-index: 1;
        }

        .projects-hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
            color: var(--white);
        }

        .breadcrumb {
            display: flex;
            justify-content: center;
            list-style: none;
        }

        .breadcrumb li {
            margin: 0 10px;
        }

        .breadcrumb a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .breadcrumb .separator {
            color: var(--white);
            opacity: 0.7;
        }

        /* Project Category Section */
        .project-category {
            margin-bottom: 80px;
        }

        .category-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .category-title {
            font-size: 32px;
            margin-bottom: 15px;
            color: var(--dark-color);
        }

        .category-description {
            max-width: 800px;
            margin: 0 auto 30px;
            font-size: 18px;
        }

        .principles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .principle-card {
            text-align: center;
            padding: 30px 20px;
            background-color: rgba(212, 175, 55, 0.05);
            border-radius: 8px;
            transition: var(--transition);
        }

        .principle-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--box-shadow);
        }

        .principle-icon {
            font-size: 32px;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .principle-card h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        /* Gallery Grid */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .gallery-item {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            height: 300px;
            box-shadow: var(--box-shadow);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            transition: var(--transition);
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        .gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
            display: flex;
            align-items: flex-end;
            padding: 20px;
            opacity: 0;
            transition: var(--transition);
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-overlay h3 {
            color: var(--white);
            font-size: 18px;
        }

        /* CTA Section */
        .cta-section {
            background-color: var(--dark-color);
            color: var(--white);
            text-align: center;
        }

        .cta-section .section-title {
            color: var(--white);
        }

        .cta-section .section-subtitle {
            color: rgba(255, 255, 255, 0.8);
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
            
            .projects-hero h1 {
                font-size: 36px;
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
            
            .category-title {
                font-size: 28px;
            }
        }

        @media (max-width: 576px) {
            .projects-hero h1 {
                font-size: 32px;
            }
            
            .btn {
                padding: 10px 20px;
            }
            
            .gallery-grid {
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
            <a href="index.html" class="logo">DEEP<span>ARCHITECTS</span></a>
            <nav class="nav">
                <ul class="nav-list">
                    <li><a href="index.php" class="nav-link">Home</a></li>
                    <li><a href="about.php" class="nav-link">About</a></li>
                    <li><a href="design.php" class="nav-link">Design</a></li>
                    <li><a href="projects.php" class="nav-link active">Projects</a></li>
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

    <!-- Projects Hero Section -->
    <section class="projects-hero">
        <div class="container">
            <h1>Our Projects</h1>
            <ul class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li class="separator">/</li>
                <li>Projects</li>
            </ul>
        </div>
    </section>

    <!-- Commercial Projects Section -->
    <section class="section">
        <div class="container">
            <div class="project-category">
                <div class="category-header">
                    <h2 class="category-title">Commercial Projects</h2>
                    <p class="category-description">Crafting spaces that enhance business performance while creating a strong visual and functional identity. We merge strategic planning with creative execution to support productivity, customer engagement, and brand experience.</p>
                
                    <div class="principles-grid">
                        <div class="principle-card">
                            <div class="principle-icon">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            <h3>Efficiency</h3>
                            <p>Supports seamless operations</p>
                        </div>
                        <div class="principle-card">
                            <div class="principle-icon">
                                <i class="fas fa-bullseye"></i>
                            </div>
                            <h3>Branding</h3>
                            <p>Reflects business identity</p>
                        </div>
                        <div class="principle-card">
                            <div class="principle-icon">
                                <i class="fas fa-handshake"></i>
                            </div>
                            <h3>Experience</h3>
                            <p>Enhances client interaction</p>
                        </div>
                    </div>
                </div>

                <div class="gallery-grid">
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1497366811353-6870744d04b2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2069&q=80" alt="Corporate Office">
                        <div class="gallery-overlay">
                            <h3>Corporate Office</h3>
                        </div>
                    </div>
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1606744837616-56c9a5c6a6eb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2071&q=80" alt="Retail Store">
                        <div class="gallery-overlay">
                            <h3>Retail Storefront</h3>
                        </div>
                    </div>
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1565538810643-b5bdb714032a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Hotel Lobby">
                        <div class="gallery-overlay">
                            <h3>Hotel Lobby</h3>
                        </div>
                    </div>
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1598300042247-d088f8ab3a91?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2034&q=80" alt="Restaurant">
                        <div class="gallery-overlay">
                            <h3>Fine Dining Restaurant</h3>
                        </div>
                    </div>
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1604329760661-e71dc83f8f26?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Co-working Space">
                        <div class="gallery-overlay">
                            <h3>Co-working Space</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Residential Projects Section -->
    <section class="section" style="background-color: var(--light-color);">
        <div class="container">
            <div class="project-category">
                <div class="category-header">
                    <h2 class="category-title">Residential Projects</h2>
                    <p class="category-description">Creating personalized, comfortable, and functional living spaces that reflect the lifestyle and personality of the people who inhabit them. We blend aesthetics with practicality to make a house feel like home.</p>
                
                    <div class="principles-grid">
                        <div class="principle-card">
                            <div class="principle-icon">
                                <i class="fas fa-couch"></i>
                            </div>
                            <h3>Comfort</h3>
                            <p>Prioritizes ease and livability</p>
                        </div>
                        <div class="principle-card">
                            <div class="principle-icon">
                                <i class="fas fa-palette"></i>
                            </div>
                            <h3>Personalization</h3>
                            <p>Reflects homeowner's taste</p>
                        </div>
                        <div class="principle-card">
                            <div class="principle-icon">
                                <i class="fas fa-home"></i>
                            </div>
                            <h3>Functionality</h3>
                            <p>Supports daily routines</p>
                        </div>
                    </div>
                </div>

                <div class="gallery-grid">
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Modern Villa">
                        <div class="gallery-overlay">
                            <h3>Modern Villa</h3>
                        </div>
                    </div>
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1600607688969-a5bfcd646154?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Penthouse">
                        <div class="gallery-overlay">
                            <h3>Luxury Penthouse</h3>
                        </div>
                    </div>
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2232&q=80" alt="Townhouse">
                        <div class="gallery-overlay">
                            <h3>Urban Townhouse</h3>
                        </div>
                    </div>
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Country Home">
                        <div class="gallery-overlay">
                            <h3>Country Home</h3>
                        </div>
                    </div>
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1600121848594-d8644e57abab?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Apartment">
                        <div class="gallery-overlay">
                            <h3>Modern Apartment</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Landscape Projects Section -->
    <section class="section">
        <div class="container">
            <div class="project-category">
                <div class="category-header">
                    <h2 class="category-title">Landscape Projects</h2>
                    <p class="category-description">Shaping outdoor spaces to be functional, sustainable, and visually appealing. We harmonize natural elements with built environments to enhance both aesthetics and usability.</p>
                
                    <div class="principles-grid">
                        <div class="principle-card">
                            <div class="principle-icon">
                                <i class="fas fa-tree"></i>
                            </div>
                            <h3>Harmony</h3>
                            <p>Blends nature with architecture</p>
                        </div>
                        <div class="principle-card">
                            <div class="principle-icon">
                                <i class="fas fa-route"></i>
                            </div>
                            <h3>Functionality</h3>
                            <p>Creates usable outdoor areas</p>
                        </div>
                        <div class="principle-card">
                            <div class="principle-icon">
                                <i class="fas fa-recycle"></i>
                            </div>
                            <h3>Sustainability</h3>
                            <p>Eco-friendly planning</p>
                        </div>
                    </div>
                </div>

                <div class="gallery-grid">
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1585320806297-9794b3e4eeae?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2089&q=80" alt="Public Park">
                        <div class="gallery-overlay">
                            <h3>Public Park</h3>
                        </div>
                    </div>
                   <!-- <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1600566752225-3bdc840df003?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Residential Garden">
                        <div class="gallery-overlay">
                            <h3>Residential Garden</h3>
                        </div> -->
                  
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Rooftop Garden">
                        <div class="gallery-overlay">
                            <h3>Rooftop Garden</h3>
                        </div>
                    </div>
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1600566752355-35792bedcfea?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Commercial Plaza">
                        <div class="gallery-overlay">
                            <h3>Commercial Plaza</h3>
                        </div>
                    </div>
                    <div class="gallery-item">
                        <img src="images/water.png">
                            <h3>Water Feature Design</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Project Management Section -->
    <section class="section" style="background-color: var(--light-color);">
        <div class="container">
            <div class="project-category">
                <div class="category-header">
                    <h2 class="category-title">Project Management</h2>
                    <p class="category-description">Ensuring every stage of a design or construction project runs smoothly—on time, within budget, and to the highest standards. We bring coordination, clarity, and control to complex workflows.</p>
                
                    <div class="principles-grid">
                        <div class="principle-card">
                            <div class="principle-icon">
                                <i class="fas fa-tasks"></i>
                            </div>
                            <h3>Planning</h3>
                            <p>Defines scope and goals</p>
                        </div>
                        <div class="principle-card">
                            <div class="principle-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <h3>Coordination</h3>
                            <p>Aligns teams and resources</p>
                        </div>
                        <div class="principle-card">
                            <div class="principle-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <h3>Execution</h3>
                            <p>Delivers quality results</p>
                        </div>
                    </div>
                </div>

                <div class="gallery-grid">
                    <div class="gallery-item">
                        <img src="images/contruct.png" alt="Construction Site">
                        <div class="gallery-overlay">
                            <h3>Construction Oversight</h3>
                        </div>
                    </div>
                    <div class="gallery-item">
                        <img src="images/Coordination.png" alt="Team Meeting">
                        <div class="gallery-overlay">
                            <h3>Project Coordination</h3>
                        </div>
                    </div>
                    <div class="gallery-item">
                        <img src="images/4.png" alt="Blueprint Review">
                        <div class="gallery-overlay">
                            <h3>Design Review</h3>
                        </div>
                    </div>
                  <!--  <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1581093450021-4a7360e9a7c9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Site Inspection">
                        <div class="gallery-overlay">
                            <h3>Quality Inspection</h3>
                        </div>
                    </div> -->
                    <div class="gallery-item">
                        <img src="images/handover.png" alt="Project Completion">
                        <div class="gallery-overlay">
                            <h3>Project Handover</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section cta-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Start Your Project With Us</h2>
                <p class="section-subtitle">Let's collaborate to bring your architectural vision to life</p>
            </div>
            <a href="contact.php" class="btn btn-primary">Get a Free Consultation</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-col">
                    <a href="index.html" class="logo" style="color: var(--white); font-size: 24px; font-weight: 700; letter-spacing: 1px; margin-bottom: 20px; display: block;">DEEP<span style="color: var(--primary-color);">ARCHITECTS</span></a>
                    <p>Shaping the future of architecture through innovative design, sustainability, and timeless aesthetics.</p>
                    <div class="social-links">
                        <a target="_blank" href="https://www.facebook.com/rupesh.chawda.581"><i class="fab fa-facebook-f"></i></a>
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
                           <li><a href="sitemap.php">Sitemap</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h3>Services</h3>
                    <ul>
                        <li><a href="#">Architecture Design</a></li>
                        <li><a href="#">Commercial</a></li>
                        <li><a href="#">Turnkey Solutions</a></li>
                        <li><a href="#">Landscape</a></li>
                    </ul>
                </div>



                <script>
(function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="s6AUzwfFT7PviTbRDOQpF";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
</script>


                <div class="footer-col">
                    <h3>Location</h3>
                    <p>100/2, Deep Tower, Mishrilal Nagar,Kaila Devi Road ,Dewas,455001 (M.P.)</p>
                    <h3 style="margin-top: 20px;">Follow Us</h3>
                    <div class="social-links">
                        <a target="_blank" href="https://www.facebook.com/rupesh.chawda.581"><i class="fab fa-facebook-f"></i></a>
                        <a target="_blank" href="https://www.instagram.com/deeparchitect.official/"><i class="fab fa-instagram"></i></a>
                        <a target="_blank" href="https://www.linkedin.com/in/rupeshchawda/"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
                <p <div class="footer-logo-box">
						    							    		Deep Architect	& <a href="https://www.rajvardhansingh.in/">Rajvardhan Singh</a> 					    	
						    	<span class="copyright-text">2026. All Rights Reserved</span></p>
                <div class="footer-links">
                    <a href="privacy.php">Privacy Policy</a>
                    <a href="privacy.php">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <a href="#" class="back-to-top" id="backToTop">
        <i class="fas fa-arrow-up"></i>
    </a>

    <script>
        // Back to Top Button
        const backToTopButton = document.getElementById('backToTop');
        
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.add('active');
            } else {
                backToTopButton.classList.remove('active');
            }
        });
        
        backToTopButton.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Mobile Navigation Toggle
        const hamburger = document.querySelector('.hamburger');
        const navList = document.querySelector('.nav-list');

        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            navList.classList.toggle('active');
        });

        // Close mobile menu when clicking on a link
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                hamburger.classList.remove('active');
                navList.classList.remove('active');
            });
        });

        // Header scroll effect
        window.addEventListener('scroll', () => {
            const header = document.getElementById('header');
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>