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
    <title>Contact Us | Deep Architects</title>

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

        /* Contact Hero Section */
        .contact-hero {
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

        .contact-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
        }

        .contact-hero .container {
            position: relative;
            z-index: 1;
        }

        .contact-hero h1 {
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

        /* Contact Section */
        .contact-section {
            background-color: var(--light-color);
        }

        .contact-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
        }

        .contact-info {
            background-color: var(--white);
            padding: 40px;
            border-radius: 8px;
            box-shadow: var(--box-shadow);
        }

        .contact-info h3 {
            font-size: 24px;
            margin-bottom: 20px;
            color: var(--primary-color);
        }

        .contact-details {
            margin-bottom: 30px;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .contact-icon {
            width: 40px;
            height: 40px;
            background-color: rgba(212, 175, 55, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-size: 16px;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .contact-text h4 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .contact-text p, .contact-text a {
            color: var(--text-color);
            opacity: 0.9;
        }

        .contact-text a:hover {
            color: var(--primary-color);
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .social-links a {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(212, 175, 55, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            transition: var(--transition);
        }

        .social-links a:hover {
            background-color: var(--primary-color);
            color: var(--white);
            transform: translateY(-5px);
        }

        /* Contact Form */
        .contact-form {
            background-color: var(--white);
            padding: 40px;
            border-radius: 8px;
            box-shadow: var(--box-shadow);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: 'Poppins', sans-serif;
            transition: var(--transition);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
        }

        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }

        /* Google Map */
        .map-container {
            height: 400px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: var(--box-shadow);
            margin-top: 60px;
        }

        .map-container iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* Business Hours */
        .hours-container {
            margin-top: 40px;
        }

        .hours-container h3 {
            font-size: 24px;
            margin-bottom: 20px;
            color: var(--primary-color);
        }

        .hours-table {
            width: 100%;
            border-collapse: collapse;
        }

        .hours-table tr {
            border-bottom: 1px solid #eee;
        }

        .hours-table tr:last-child {
            border-bottom: none;
        }

        .hours-table td {
            padding: 12px 0;
        }

        .hours-table td:last-child {
            text-align: right;
            font-weight: 500;
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
            
            .contact-hero h1 {
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
            
            .contact-info, .contact-form {
                padding: 30px;
            }
        }

        @media (max-width: 576px) {
            .contact-hero h1 {
                font-size: 32px;
            }
            
            .btn {
                padding: 10px 20px;
            }
            
            .map-container {
                height: 300px;
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
                    <li><a href="projects.php" class="nav-link">Projects</a></li>
                    <li><a href="contact.php" class="nav-link active">Contact</a></li>
                </ul>
                <div class="hamburger">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </nav>
        </div>
    </header>

    <!-- Contact Hero Section -->
    <section class="contact-hero">
        <div class="container">
            <h1>Get In Touch</h1>
            <ul class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li class="separator">/</li>
                <li>Contact</li>
            </ul>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section contact-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Contact Us</h2>
                <p class="section-subtitle">We'd love to hear from you. Reach out to discuss your project or inquire about our services.</p>
            </div>

            <div class="contact-container">
                <div class="contact-info">
                    <h3>Contact Information</h3>
                    <div class="contact-details">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-text">
                                <h4>Our Office</h4>
                                <p>100/2, Deep Tower, Mishrilal Nagar,Kaila Devi Road, Dewas,455001 (M.P.)7</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="contact-text">
                                <h4>Phone</h4>
                                <a href="tel:+91 99778 22952">+91 99778 22952</a>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-text">
                                <h4>Email</h4>
                                <a href="mailto:info@deeparchitects.com">info@deeparchitects.com</a>
                            </div>
                        </div>
                    </div>

                    <h3 style="margin-top: 40px;">Follow Us</h3>
                    <div class="social-links">
                        <a target="_blank" href="https://www.facebook.com/rupesh.chawda.581"><i class="fab fa-facebook-f"></i></a>
                        <a target="_blank" href="https://www.instagram.com/deeparchitect.official/"><i class="fab fa-instagram"></i></a>
                        <a target="_blank" href="https://www.linkedin.com/in/rupeshchawda/"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>

                <div class="contact-form">
                    <h3>Send Us a Message</h3>
<form action="https://api.web3forms.com/submit" method="POST">
                          <input type="hidden" name="access_key" value="4ec3f189-743c-4693-bdb3-12c5134c53d9">

                        <div class="form-group">
                          
                            <label for="name">Your Name</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" id="subject" name="subject" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Your Message</label>
                            <textarea id="message" name="message" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>

            <!-- Google Map -->
           <!-- Replace the existing map-container div with this updated version -->
<div class="map-container">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3681.011602783671!2d76.0368324!3d22.9524631!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3963177f49cdd727%3A0x9715d6f2aadd3bfb!2sDeep%20Architects%20and%20Interiors!5e0!3m2!1sen!2sin!4v1710000000000!5m2!1sen!2sin" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
    </iframe>
</div>

            <!-- Business Hours -->
            <div class="hours-container">
                <h3>Business Hours</h3>
                <table class="hours-table">
                    <tr>
                        <td>Monday - Friday</td>
                        <td>9:00 AM - 6:00 PM</td>
                    </tr>
                    <tr>
                        <td>Saturday</td>
                        <td>10:00 AM - 4:00 PM</td>
                    </tr>
                    <tr>
                        <td>Sunday</td>
                        <td>Closed</td>
                    </tr>
                </table>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section cta-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Ready to Start Your Project?</h2>
                <p class="section-subtitle">Contact us today to discuss your architectural needs and vision.</p>
            </div>
            <a href="contact.php" class="btn btn-primary">Get a Free Consultation</a>
        </div>
    </section>



<script>
(function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="s6AUzwfFT7PviTbRDOQpF";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
</script>


    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-col">
                    <a href="index.php" class="logo" style="color: var(--white); font-size: 24px; font-weight: 700; letter-spacing: 1px; margin-bottom: 20px; display: block;">DEEP<span style="color: var(--primary-color);">ARCHITECTS</span></a>
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
    document.getElementById('contactForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        // Form elements
        const form = this;
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalBtnText = submitBtn.innerHTML;
        
        // Validation
        const requiredFields = ['name', 'email', 'message'];
        let isValid = true;
        
        requiredFields.forEach(field => {
            const element = document.getElementById(field);
            if (!element.value.trim()) {
                element.style.borderColor = 'red';
                isValid = false;
            } else {
                element.style.borderColor = '#ddd';
            }
        });

        if (!isValid) {
            alert('Please fill in all required fields');
            return;
        }

        // Prepare form data
        const formData = new FormData(form);
        
        // Add hidden _subject field for email subject
        formData.append('_subject', 'New contact form submission from Deep Architects');
        
        // Add redirect URL (optional)
        formData.append('_next', window.location.href + '?success=true');
        
        // Add honeypot field (optional)
        formData.append('_honey', '');

        // Show loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';

        try {
           
                method: "POST",
                body: formData,
                headers: {
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();

            if (response.ok && data.success === "true") {
                // Success - show confirmation
                alert('Thank you! Your message has been sent successfully.');
                form.reset();
                
                // If you added _next parameter, you could also:
                if (new URLSearchParams(window.location.search).has('success')) {
                    // Show a success message on page
                }
            } else {
                throw new Error(data.message || 'Submission failed');
            }
        } catch (error) {
            console.error('Form submission error:', error);
            
            // More specific error messages
            if (error.message.includes('Failed to fetch')) {
                alert('Network error. Please check your internet connection and try again.');
            } else {
                alert('Error: ' + error.message);
            }
        } finally {
            // Reset button state
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnText;
        }
    });
</script>
    <script>
    // Form submission with FormSubmit.co
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Basic validation
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const message = document.getElementById('message').value.trim();
        
        if (!name || !email || !message) {
            alert('Please fill in all required fields');
            return;
        }
        
        // Show loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
        
        // If everything is valid, send via AJAX
        const formData = new FormData(this);

        fetch("https://formsubmit.co/ajax/", {
            method: "POST",
            body: formData,
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success === "true") {
                // Show success message
                alert('Thank you for your message! We will get back to you soon.');
                this.reset();
            } else {
                throw new Error('Form submission failed');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('There was an error sending your message. Please try again later.');
        })
        .finally(() => {
            // Reset button state
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Send Message';
        });
    });

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