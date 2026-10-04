document.addEventListener('DOMContentLoaded', function() {
    // Header Scroll Effect
    const header = document.getElementById('header');
    window.addEventListener('scroll', function() {
        if (window.scrollY > 100) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    // Mobile Menu Toggle
    const hamburger = document.querySelector('.hamburger');
    const navList = document.querySelector('.nav-list');
    const navLinks = document.querySelectorAll('.nav-link');
    
    hamburger.addEventListener('click', function() {
        hamburger.classList.toggle('active');
        navList.classList.toggle('active');
    });
    
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            hamburger.classList.remove('active');
            navList.classList.remove('active');
        });
    });

    // Hero Slider
    const slides = document.querySelectorAll('.slide');
    const dotsContainer = document.querySelector('.slider-dots');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');
    let currentSlide = 0;
    let slideInterval;

    // Create dots
    slides.forEach((_, index) => {
        const dot = document.createElement('div');
        dot.classList.add('dot');
        if (index === 0) dot.classList.add('active');
        dot.addEventListener('click', () => goToSlide(index));
        dotsContainer.appendChild(dot);
    });

    const dots = document.querySelectorAll('.dot');

    // Next slide function
    function nextSlide() {
        goToSlide(currentSlide === slides.length - 1 ? 0 : currentSlide + 1);
    }

    // Previous slide function
    function prevSlide() {
        goToSlide(currentSlide === 0 ? slides.length - 1 : currentSlide - 1);
    }

    // Go to specific slide
    function goToSlide(index) {
        slides[currentSlide].classList.remove('active');
        dots[currentSlide].classList.remove('active');
        
        currentSlide = index;
        
        slides[currentSlide].classList.add('active');
        dots[currentSlide].classList.add('active');
    }

    // Start auto slide
    function startSlide() {
        slideInterval = setInterval(nextSlide, 4000);
    }

    // Stop auto slide when hovering
    function pauseSlide() {
        clearInterval(slideInterval);
    }

    // Event listeners
    nextBtn.addEventListener('click', () => {
        pauseSlide();
        nextSlide();
        startSlide();
    });

    prevBtn.addEventListener('click', () => {
        pauseSlide();
        prevSlide();
        startSlide();
    });

    // Start the slider
    startSlide();

    // Testimonials Slider
    const testimonials = document.querySelectorAll('.testimonial');
    const testimonialsDotsContainer = document.querySelector('.testimonials-dots');
    let currentTestimonial = 0;
    let testimonialInterval;

    // Create dots for testimonials
    testimonials.forEach((_, index) => {
        const dot = document.createElement('div');
        dot.classList.add('testimonial-dot');
        if (index === 0) dot.classList.add('active');
        dot.addEventListener('click', () => goToTestimonial(index));
        testimonialsDotsContainer.appendChild(dot);
    });

    const testimonialDots = document.querySelectorAll('.testimonial-dot');

    // Next testimonial function
    function nextTestimonial() {
        goToTestimonial(currentTestimonial === testimonials.length - 1 ? 0 : currentTestimonial + 1);
    }

    // Go to specific testimonial
    function goToTestimonial(index) {
        testimonials[currentTestimonial].classList.remove('active');
        testimonialDots[currentTestimonial].classList.remove('active');
        
        currentTestimonial = index;
        
        testimonials[currentTestimonial].classList.add('active');
        testimonialDots[currentTestimonial].classList.add('active');
    }

    // Start auto testimonial slide
    function startTestimonialSlide() {
        testimonialInterval = setInterval(nextTestimonial, 5000);
    }

    // Start the testimonial slider
    startTestimonialSlide();

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Active link highlighting
    const sections = document.querySelectorAll('section');
    window.addEventListener('scroll', function() {
        let current = '';
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            
            if (pageYOffset >= sectionTop - 200) {
                current = section.getAttribute('id');
            }
        });
        
        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === `#${current}`) {
                link.classList.add('active');
            }
        });
    });

    // Back to top button
    const backToTopBtn = document.getElementById('backToTop');
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTopBtn.classList.add('active');
        } else {
            backToTopBtn.classList.remove('active');
        }
    });

    // Counter animation
    const counters = document.querySelectorAll('.counter');
    const speed = 200;
    
    function animateCounters() {
        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            const count = +counter.innerText;
            const increment = target / speed;
            
            if (count < target) {
                counter.innerText = Math.ceil(count + increment);
                setTimeout(animateCounters, 1);
            } else {
                counter.innerText = target + (counter.getAttribute('data-target').includes('+') ? '+' : '');
            }
        });
    }
    
    // Start counter animation when milestones section is in view
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounters();
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    
    const milestonesSection = document.querySelector('.milestones');
    if (milestonesSection) {
        observer.observe(milestonesSection);
    }

    // Set current year in footer
    document.getElementById('year').textContent = new Date().getFullYear();

    // Scroll reveal animations
    const scrollReveal = ScrollReveal({
        origin: 'bottom',
        distance: '60px',
        duration: 1000,
        delay: 200,
        reset: true
    });
    
    scrollReveal.reveal('.section-header', { origin: 'top' });
    scrollReveal.reveal('.about-text, .about-image', { interval: 200 });
    scrollReveal.reveal('.service-card', { interval: 200 });
    scrollReveal.reveal('.team-card', { interval: 200 });
    scrollReveal.reveal('.milestone-card', { interval: 200 });
    scrollReveal.reveal('.contact-info, .contact-form', { interval: 200 });
    scrollReveal.reveal('.footer-col', { interval: 200 });
});