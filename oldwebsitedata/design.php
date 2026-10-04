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
    <title>Architectural Design | Deep Architects</title>
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

        /* Design Hero Section */
        .design-hero {
            height: 70vh;
            background-image: url('https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: center;
            text-align: center;
            color: var(--white);
        }

        .design-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
        }

        .design-hero .container {
            position: relative;
            z-index: 1;
        }

        .design-hero h1 {
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

        /* Design Intro Section */
        .design-intro {
            text-align: center;
            max-width: 800px;
            margin: 0 auto 60px;
        }

        .design-intro p {
            font-size: 18px;
            margin-bottom: 30px;
        }

        /* Principles Section */
        .principles-section {
            background-color: var(--light-color);
        }

        .principles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
        }

        .principle-card {
            background-color: var(--white);
            padding: 40px 30px;
            border-radius: 8px;
            text-align: center;
            transition: var(--transition);
            box-shadow: var(--box-shadow);
            position: relative;
            overflow: hidden;
        }

        .principle-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .principle-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(212, 175, 55, 0.1);
            border-radius: 50%;
            color: var(--primary-color);
            font-size: 30px;
            transition: var(--transition);
        }

        .principle-card:hover .principle-icon {
            background-color: var(--primary-color);
            color: var(--white);
        }

        .principle-card h3 {
            margin-bottom: 15px;
            font-size: 22px;
        }

        /* Gallery Section */
        .gallery-section {
            background-color: var(--white);
        }

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

        /* Process Section */
        .process-section {
            background-color: var(--light-color);
            background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxkZWZzPjxwYXR0ZXJuIGlkPSJwYXR0ZXJuIiB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHBhdHRlcm5Vbml0cz0idXNlclNwYWNlT25Vc2UiIHBhdHRlcm5UcmFuc2Zvcm09InJvdGF0ZSg0NSkiPjxyZWN0IHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgZmlsbD0icmdiYSgyMTcsMjE3LDIxNywwLjAzKSIvPjwvcGF0dGVybj48L2RlZnM+PHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0idXJsKCNwYXR0ZXJuKSIvPjwvc3ZnPg==');
        }

        .process-steps {
            display: flex;
            flex-direction: column;
            gap: 30px;
            max-width: 800px;
            margin: 0 auto;
            position: relative;
        }

        .process-steps::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 2px;
            height: 100%;
            background-color: var(--primary-color);
            opacity: 0.3;
        }

        .process-step {
            display: flex;
            gap: 30px;
            position: relative;
        }

        .process-step:nth-child(odd) {
            flex-direction: row-reverse;
            text-align: right;
        }

        .process-icon {
            width: 60px;
            height: 60px;
            background-color: var(--primary-color);
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
            position: relative;
            z-index: 1;
        }

        .process-content {
            flex: 1;
            background-color: var(--white);
            padding: 30px;
            border-radius: 8px;
            box-shadow: var(--box-shadow);
        }

        .process-content h3 {
            color: var(--primary-color);
            margin-bottom: 15px;
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
        @media (max-width: 992px) {
            .process-steps::before {
                left: 30px;
                transform: none;
            }
            
            .process-step {
                flex-direction: row !important;
                text-align: left !important;
                gap: 20px;
            }
            
            .process-icon {
                width: 50px;
                height: 50px;
                font-size: 20px;
            }
        }

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
            
            .design-hero h1 {
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
        }

        @media (max-width: 576px) {
            .design-hero h1 {
                font-size: 32px;
            }
            
            .btn {
                padding: 10px 20px;
            }
            
            .principles-grid {
                grid-template-columns: 1fr;
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
            <a href="index.php" class="logo">DEEP<span>ARCHITECTS</span></a>
            <nav class="nav">
                <ul class="nav-list">
                    <li><a href="index.php" class="nav-link">Home</a></li>
                    <li><a href="about.php" class="nav-link">About</a></li>
                    <li><a href="design.php" class="nav-link active">Design</a></li>
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

    <!-- Design Hero Section -->
    <section class="design-hero">
        <div class="container">
            <h1>Architectural Design</h1>
            <ul class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li class="separator">/</li>
                <li>Architectural Design</li>
            </ul>
        </div>
    </section>

    <!-- Design Intro Section -->
    <section class="section">
        <div class="container">
            <div class="design-intro">
                <p>Architectural design is the art and science of shaping spaces that are both functional and visually inspiring. It blends creativity with technical expertise to craft structures that stand the test of time while reflecting identity, purpose, and environment.</p>
            </div>

            <!-- Principles Section -->
            <div class="section-header">
                <h2 class="section-title">Our Design Principles</h2>
                <p class="section-subtitle">Guiding philosophies that shape every project we undertake</p>
            </div>

            <div class="principles-grid">
                <div class="principle-card">
                    <div class="principle-icon">
                        <i class="fas fa-balance-scale"></i>
                    </div>
                    <h3>Balance</h3>
                    <p>Combines beauty with purpose, creating harmonious spaces that are both aesthetically pleasing and highly functional.</p>
                </div>

                <div class="principle-card">
                    <div class="principle-icon">
                        <i class="fas fa-globe-asia"></i>
                    </div>
                    <h3>Context</h3>
                    <p>Reflects surroundings and culture, ensuring each design feels naturally integrated with its environment.</p>
                </div>

                <div class="principle-card">
                    <div class="principle-icon">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h3>Sustainability</h3>
                    <p>Embraces eco-friendly solutions that minimize environmental impact while maximizing efficiency and comfort.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="section gallery-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Our Design Portfolio</h2>
                <p class="section-subtitle">Explore our diverse range of architectural designs</p>
            </div>


<script>
(function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="s6AUzwfFT7PviTbRDOQpF";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
</script>


            <div class="gallery-grid">
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Modern Residence">
                    <div class="gallery-overlay">
                        <h3>Modern Residence</h3>
                    </div>
                </div>
               
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1600607688969-a5bfcd646154?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Urban Villa">
                    <div class="gallery-overlay">
                        <h3>Urban Villa</h3>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2232&q=80" alt="Luxury Penthouse">
                    <div class="gallery-overlay">
                        <h3>Luxury Penthouse</h3>
                    </div>
                </div>
                
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Beach House">
                    <div class="gallery-overlay">
                        <h3>Beach House</h3>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Mountain Retreat">
                    <div class="gallery-overlay">
                        <h3>Mountain Retreat</h3>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1600607688969-a5bfcd646154?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="City Loft">
                    <div class="gallery-overlay">
                        <h3>City Loft</h3>
                    </div>
                </div>
                
                </div>
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2232&q=80" alt="Lakeside Cabin">
                    <div class="gallery-overlay">
                        <h3>Lakeside Cabin</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section class="section process-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Our Design Process</h2>
                <p class="section-subtitle">A structured approach to creating exceptional architecture</p>
            </div>

            <div class="process-steps">
                <div class="process-step">
                    <div class="process-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <div class="process-content">
                        <h3>Concept Development</h3>
                        <p>We begin with in-depth discussions to understand your vision, needs, and the unique characteristics of your site.</p>
                    </div>
                </div>

                <div class="process-step">
                    <div class="process-icon">
                        <i class="fas fa-pencil-ruler"></i>
                    </div>
                    <div class="process-content">
                        <h3>Schematic Design</h3>
                        <p>Initial sketches and 3D models are created to explore spatial relationships and design possibilities.</p>
                    </div>
                </div>

                <div class="process-step">
                    <div class="process-icon">
                        <i class="fas fa-drafting-compass"></i>
                    </div>
                    <div class="process-content">
                        <h3>Design Development</h3>
                        <p>The chosen concept is refined with detailed drawings specifying materials, systems, and structural elements.</p>
                    </div>
                </div>

                <div class="process-step">
                    <div class="process-icon">
                        <i class="fas fa-file-contract"></i>
                    </div>
                    <div class="process-content">
                        <h3>Construction Documents</h3>
                        <p>Comprehensive technical drawings and specifications are prepared for permitting and construction.</p>
                    </div>
                </div>

                <div class="process-step">
                    <div class="process-icon">
                        <i class="fas fa-hard-hat"></i>
                    </div>
                    <div class="process-content">
                        <h3>Construction Administration</h3>
                        <p>We oversee the construction process to ensure the design vision is faithfully executed.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section cta-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Ready to Bring Your Vision to Life?</h2>
                <p class="section-subtitle">Contact us to discuss your architectural design project</p>
            </div>
            <a href="contact.html" class="btn btn-primary">Get in Touch</a>
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
            <div class="footer-bottom">
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