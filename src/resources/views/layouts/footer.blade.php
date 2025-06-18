<footer class="modern-footer">
    <!-- Main Footer Content -->
    <div class="footer-main">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-brand">
                        <div class="brand-logo">
                            <i class="fas fa-eye"></i>
                            <span>oneVision</span>
                        </div>
                        <p class="brand-description">
                            Discover amazing destinations and create unforgettable memories with our comprehensive
                            travel platform.
                            Your adventure starts here.
                        </p>
                        <div class="social-links">
                            <a href="#" class="social-link" aria-label="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="YouTube">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6">
                    <div class="footer-section">
                        <h5 class="footer-title">Explore</h5>
                        <ul class="footer-links">
                            <li><a href="{{ url('/') }}"><i class="fas fa-home"></i>Home</a></li>
                            <li><a href="{{ url('gallery/') }}"><i class="fas fa-images"></i>Gallery</a></li>
                            <li><a href="{{ route('minimap.index') }}"><i class="fas fa-map-marked-alt"></i>Map</a></li>
                            <li><a href="{{ url('weather') }}"><i class="fas fa-cloud-sun"></i>Weather</a></li>
                            <li><a href="{{ url('facilities/') }}"><i class="fas fa-building"></i>Facilities</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Services -->
                <div class="col-lg-2 col-md-6">
                    <div class="footer-section">
                        <h5 class="footer-title">Services</h5>
                        <ul class="footer-links">
                            <li><a href="{{ url('tourguides/') }}"><i class="fas fa-user-tie"></i>Tour Guides</a></li>
                            <li><a href="{{ route('madu.index') }}"><i class="fas fa-jar"></i>Honey Products</a></li>
                            <li><a href="{{ route('produkUMKM.index') }}"><i class="fas fa-store"></i>UMKM Products</a>
                            </li>
                            <li><a href="{{ url('beritas/') }}"><i class="fas fa-newspaper"></i>News & Updates</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Support -->
                <div class="col-lg-2 col-md-6">
                    <div class="footer-section">
                        <h5 class="footer-title">Support</h5>
                        <ul class="footer-links">
                            <li><a href="{{ url('contact') }}"><i class="fas fa-envelope"></i>Contact Us</a></li>
                            <li><a href="#"><i class="fas fa-question-circle"></i>Help Center</a></li>
                            <li><a href="#"><i class="fas fa-shield-alt"></i>Safety Info</a></li>
                            <li><a href="#"><i class="fas fa-undo"></i>Cancellation</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="col-lg-2 col-md-6">
                    <div class="footer-section">
                        <h5 class="footer-title">Contact</h5>
                        <div class="contact-info">
                            <div class="contact-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Padang, West Sumatra<br>Indonesia</span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-phone"></i>
                                <span>+62 123 456 789</span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-envelope"></i>
                                <span>info@onevision.com</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Brand Section -->
                <div class="copyright">
                    <p align="center">&copy; {{ date('Y') }} oneVision. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Newsletter Section -->
    {{-- <div class="footer-newsletter">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="newsletter-content">
                        <h4>Stay Updated</h4>
                        <p>Subscribe to our newsletter for the latest travel tips and exclusive offers.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form class="newsletter-form" id="newsletterForm">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Enter your email address"
                                aria-label="Email address" required>
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-paper-plane"></i>
                                <span>Subscribe</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Bottom Footer -->
    {{-- <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="copyright">
                        <p>&copy; {{ date('Y') }} oneVision. All rights reserved.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="footer-bottom-links">
                        <a href="#">Privacy Policy</a>
                        <a href="#">Terms of Service</a>
                        <a href="#">Cookie Policy</a>
                    </div>
                    <div class="payment-methods">
                        <i class="fab fa-cc-visa" title="Visa"></i>
                        <i class="fab fa-cc-mastercard" title="Mastercard"></i>
                        <i class="fab fa-cc-paypal" title="PayPal"></i>
                        <i class="fab fa-cc-amex" title="American Express"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Back to Top Button -->
    <button class="back-to-top" id="backToTop" aria-label="Back to top">
        <i class="fas fa-chevron-up"></i>
    </button>
</footer>

<style>
    /* Modern Footer Styles */
    .modern-footer {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        color: #e2e8f0;
        position: relative;
        overflow: hidden;
    }

    .modern-footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.03)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
        opacity: 0.5;
    }

    .footer-main {
        padding: 4rem 0 2rem;
        position: relative;
        z-index: 1;
    }

    /* Brand Section */
    .footer-brand {
        margin-bottom: 2rem;
    }

    .brand-logo {
        display: flex;
        align-items: center;
        font-size: 1.75rem;
        font-weight: 800;
        color: #ffffff;
        margin-bottom: 1rem;
    }

    .brand-logo i {
        margin-right: 0.75rem;
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .brand-description {
        color: #94a3b8;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        max-width: 300px;
    }

    /* Social Links */
    .social-links {
        display: flex;
        gap: 0.75rem;
    }

    .social-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        color: #e2e8f0;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    .social-link:hover {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        color: white;
        transform: translateY(-2px) scale(1.1);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
    }

    /* Footer Sections */
    .footer-section {
        margin-bottom: 2rem;
    }

    .footer-title {
        color: #ffffff;
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 1.5rem;
        position: relative;
    }

    .footer-title::after {
        content: '';
        position: absolute;
        bottom: -0.5rem;
        left: 0;
        width: 30px;
        height: 2px;
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        border-radius: 1px;
    }

    /* Footer Links */
    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li {
        margin-bottom: 0.75rem;
    }

    .footer-links a {
        color: #94a3b8;
        text-decoration: none;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
        padding: 0.25rem 0;
    }

    .footer-links a i {
        margin-right: 0.75rem;
        width: 16px;
        font-size: 0.9rem;
        opacity: 0.7;
    }

    .footer-links a:hover {
        color: #3b82f6;
        transform: translateX(5px);
    }

    .footer-links a:hover i {
        opacity: 1;
    }

    /* Contact Info */
    .contact-info {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .contact-item {
        display: flex;
        align-items: flex-start;
        color: #94a3b8;
    }

    .contact-item i {
        margin-right: 0.75rem;
        margin-top: 0.25rem;
        color: #3b82f6;
        width: 16px;
        flex-shrink: 0;
    }

    /* Newsletter Section */
    .footer-newsletter {
        background: rgba(255, 255, 255, 0.05);
        padding: 2rem 0;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        position: relative;
        z-index: 1;
    }

    .newsletter-content h4 {
        color: #ffffff;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .newsletter-content p {
        color: #94a3b8;
        margin-bottom: 0;
    }

    .newsletter-form .input-group {
        max-width: 400px;
        margin-left: auto;
    }

    .newsletter-form .form-control {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #ffffff;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem 0 0 0.5rem;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    .newsletter-form .form-control::placeholder {
        color: #94a3b8;
    }

    .newsletter-form .form-control:focus {
        background: rgba(255, 255, 255, 0.15);
        border-color: #3b82f6;
        box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
        color: #ffffff;
    }

    .newsletter-form .btn {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 0 0.5rem 0.5rem 0;
        font-weight: 600;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .newsletter-form .btn:hover {
        background: linear-gradient(135deg, #1d4ed8, #1e40af);
        transform: translateY(-1px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
    }

    /* Bottom Footer */
    .footer-bottom {
        padding: 1.5rem 0;
        background: rgba(0, 0, 0, 0.3);
        position: relative;
        z-index: 1;
    }

    .copyright p {
        margin: 0;
        color: #94a3b8;
        font-size: 0.9rem;
    }

    .footer-bottom-links {
        display: flex;
        gap: 1.5rem;
        margin-bottom: 1rem;
        justify-content: flex-end;
    }

    .footer-bottom-links a {
        color: #94a3b8;
        text-decoration: none;
        font-size: 0.9rem;
        transition: color 0.3s ease;
    }

    .footer-bottom-links a:hover {
        color: #3b82f6;
    }

    .payment-methods {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        align-items: center;
    }

    .payment-methods i {
        font-size: 1.5rem;
        color: #64748b;
        transition: all 0.3s ease;
    }

    .payment-methods i:hover {
        color: #3b82f6;
        transform: scale(1.1);
    }

    /* Back to Top Button */
    .back-to-top {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        color: white;
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        opacity: 0;
        visibility: hidden;
        transform: translateY(20px);
        z-index: 1000;
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
    }

    .back-to-top.visible {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .back-to-top:hover {
        transform: translateY(-3px) scale(1.1);
        box-shadow: 0 12px 35px rgba(59, 130, 246, 0.4);
    }

    /* Responsive Design */
    @media (max-width: 991.98px) {
        .footer-main {
            padding: 3rem 0 1.5rem;
        }

        .newsletter-content {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .newsletter-form .input-group {
            margin: 0 auto;
        }

        .footer-bottom-links {
            justify-content: center;
            margin-bottom: 1rem;
        }

        .payment-methods {
            justify-content: center;
        }

        .copyright {
            text-align: center;
        }
    }

    @media (max-width: 767.98px) {
        .footer-main {
            padding: 2rem 0 1rem;
        }

        .brand-logo {
            justify-content: center;
        }

        .footer-brand {
            text-align: center;
        }

        .social-links {
            justify-content: center;
        }

        .footer-section {
            text-align: center;
        }

        .footer-title::after {
            left: 50%;
            transform: translateX(-50%);
        }

        .contact-item {
            justify-content: center;
        }

        .footer-newsletter {
            padding: 1.5rem 0;
        }

        .newsletter-form .input-group {
            flex-direction: column;
            max-width: 300px;
        }

        .newsletter-form .form-control {
            border-radius: 0.5rem;
            margin-bottom: 0.75rem;
        }

        .newsletter-form .btn {
            border-radius: 0.5rem;
            justify-content: center;
        }

        .footer-bottom-links {
            flex-direction: column;
            gap: 0.75rem;
            align-items: center;
        }

        .back-to-top {
            bottom: 1rem;
            right: 1rem;
            width: 45px;
            height: 45px;
        }
    }

    @media (max-width: 575.98px) {
        .brand-description {
            max-width: 100%;
        }

        .newsletter-form .input-group {
            max-width: 280px;
        }

        .payment-methods {
            gap: 0.75rem;
        }

        .payment-methods i {
            font-size: 1.25rem;
        }
    }

    /* Animation for elements coming into view */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .footer-section {
        animation: fadeInUp 0.6s ease-out;
    }

    .footer-section:nth-child(2) {
        animation-delay: 0.1s;
    }

    .footer-section:nth-child(3) {
        animation-delay: 0.2s;
    }

    .footer-section:nth-child(4) {
        animation-delay: 0.3s;
    }

    .footer-section:nth-child(5) {
        animation-delay: 0.4s;
    }

    /* Loading state for newsletter form */
    .newsletter-form.loading .btn {
        pointer-events: none;
    }

    .newsletter-form.loading .btn span {
        opacity: 0;
    }

    .newsletter-form.loading .btn::after {
        content: '';
        position: absolute;
        width: 16px;
        height: 16px;
        border: 2px solid transparent;
        border-top: 2px solid white;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* Hover effects for footer sections */
    .footer-section:hover .footer-title {
        color: #3b82f6;
        transition: color 0.3s ease;
    }

    /* Custom scrollbar for mobile */
    @media (max-width: 767.98px) {
        .footer-links {
            max-height: 200px;
            overflow-y: auto;
        }

        .footer-links::-webkit-scrollbar {
            width: 4px;
        }

        .footer-links::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
        }

        .footer-links::-webkit-scrollbar-thumb {
            background: rgba(59, 130, 246, 0.5);
            border-radius: 2px;
        }

        .footer-links::-webkit-scrollbar-thumb:hover {
            background: rgba(59, 130, 246, 0.7);
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Back to top button functionality
        const backToTopButton = document.getElementById('backToTop');

        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.add('visible');
            } else {
                backToTopButton.classList.remove('visible');
            }
        });

        backToTopButton.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Newsletter form handling
        const newsletterForm = document.getElementById('newsletterForm');

        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const form = e.target;
            const email = form.querySelector('input[type="email"]').value;

            // Add loading state
            form.classList.add('loading');

            // Simulate API call
            setTimeout(() => {
                form.classList.remove('loading');

                // Show success message
                showNotification('Thank you for subscribing to our newsletter!', 'success');

                // Reset form
                form.reset();
            }, 2000);
        });

        // Smooth scroll for footer links
        document.querySelectorAll('.footer-links a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add intersection observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                }
            });
        }, observerOptions);

        // Observe footer sections
        document.querySelectorAll('.footer-section').forEach(section => {
            section.style.animationPlayState = 'paused';
            observer.observe(section);
        });

        // Social links tracking (optional)
        document.querySelectorAll('.social-link').forEach(link => {
            link.addEventListener('click', function(e) {
                const platform = this.querySelector('i').classList[1].replace('fa-', '');
                console.log(`Social link clicked: ${platform}`);
                // You can add analytics tracking here
            });
        });

        // Newsletter email validation
        const emailInput = document.querySelector('.newsletter-form input[type="email"]');

        emailInput.addEventListener('blur', function() {
            const email = this.value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (email && !emailRegex.test(email)) {
                this.style.borderColor = '#ef4444';
                this.style.boxShadow = '0 0 0 0.2rem rgba(239, 68, 68, 0.25)';
            } else {
                this.style.borderColor = '';
                this.style.boxShadow = '';
            }
        });

        // Add ripple effect to buttons
        document.querySelectorAll('.btn, .social-link, .back-to-top').forEach(button => {
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('ripple');

                this.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
    });

    // Global notification function (if not already defined)
    function showNotification(message, type = 'info') {
        // Create toast notification
        const toast = document.createElement('div');
        toast.className = `alert alert-${type === 'success' ? 'success' : 'info'} position-fixed`;
        toast.style.cssText = `
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            animation: slideInRight 0.3s ease-out;
        `;
        toast.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'} me-2"></i>
                <span>${message}</span>
                <button type="button" class="btn-close ms-auto" onclick="this.parentElement.parentElement.remove()"></button>
            </div>
        `;

        document.body.appendChild(toast);

        // Auto remove after 5 seconds
        setTimeout(() => {
            if (toast.parentElement) {
                toast.style.animation = 'slideOutRight 0.3s ease-out';
                setTimeout(() => toast.remove(), 300);
            }
        }, 5000);
    }

    // Add CSS for ripple effect and animations
    const style = document.createElement('style');
    style.textContent = `
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: scale(0);
            animation: ripple-animation 0.6s linear;
            pointer-events: none;
        }

        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        /* Ensure buttons have relative positioning for ripple effect */
        .btn, .social-link, .back-to-top {
            position: relative;
            overflow: hidden;
        }

        /* Additional hover effects */
        .footer-links a::before {
            content: '';
            position: absolute;
            left: -100%;
            top: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.1), transparent);
            transition: left 0.5s;
        }

        .footer-links a:hover::before {
            left: 100%;
        }

        /* Pulse animation for social links */
        .social-link::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(59, 130, 246, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.3s, height 0.3s;
        }

        .social-link:hover::after {
            width: 100%;
            height: 100%;
        }

        /* Enhanced focus states for accessibility */
        .footer-links a:focus,
        .social-link:focus,
        .newsletter-form .form-control:focus,
        .newsletter-form .btn:focus,
        .back-to-top:focus {
            outline: 2px solid #3b82f6;
            outline-offset: 2px;
        }

        /* Dark mode support (optional) */
        @media (prefers-color-scheme: dark) {
            .modern-footer {
                background: linear-gradient(135deg, #000000 0%, #111827 100%);
            }
        }

        /* Print styles */
        @media print {
            .modern-footer {
                background: white !important;
                color: black !important;
            }
            
            .back-to-top {
                display: none !important;
            }
            
            .social-links,
            .newsletter-form {
                display: none !important;
            }
        }

        /* High contrast mode support */
        @media (prefers-contrast: high) {
            .modern-footer {
                background: #000000;
                color: #ffffff;
            }
            
            .footer-links a,
            .contact-item {
                color: #ffffff;
            }
            
            .social-link {
                background: #ffffff;
                color: #000000;
            }
        }

        /* Reduced motion support */
        @media (prefers-reduced-motion: reduce) {
            .footer-section,
            .social-link,
            .back-to-top,
            .newsletter-form .btn {
                animation: none !important;
                transition: none !important;
            }
            
            .back-to-top {
                transform: none !important;
            }
        }

        /* Custom properties for theming */
        .modern-footer {
            --footer-bg-primary: #0f172a;
            --footer-bg-secondary: #1e293b;
            --footer-text-primary: #ffffff;
            --footer-text-secondary: #94a3b8;
            --footer-accent: #3b82f6;
            --footer-accent-hover: #1d4ed8;
        }

        /* Gradient text effect for brand */
        .brand-logo span {
            background: linear-gradient(135deg, #3b82f6, #8b5cf6, #06b6d4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradient-shift 3s ease-in-out infinite;
        }

        @keyframes gradient-shift {
            0%, 100% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
        }

        /* Floating animation for social icons */
        .social-link:nth-child(1) { animation-delay: 0s; }
        .social-link:nth-child(2) { animation-delay: 0.2s; }
        .social-link:nth-child(3) { animation-delay: 0.4s; }
        .social-link:nth-child(4) { animation-delay: 0.6s; }
        .social-link:nth-child(5) { animation-delay: 0.8s; }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-5px);
            }
        }

        .social-link {
            animation: float 3s ease-in-out infinite;
        }

        /* Glowing effect for newsletter button */
        .newsletter-form .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: inherit;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            opacity: 0;
            transition: opacity 0.3s;
            z-index: -1;
        }

        .newsletter-form .btn:hover::before {
            opacity: 0.8;
            animation: glow 1.5s ease-in-out infinite alternate;
        }

        @keyframes glow {
            from {
                box-shadow: 0 0 10px rgba(59, 130, 246, 0.5);
            }
            to {
                box-shadow: 0 0 20px rgba(59, 130, 246, 0.8), 0 0 30px rgba(59, 130, 246, 0.6);
            }
        }

        /* Typewriter effect for newsletter heading */
        .newsletter-content h4 {
            overflow: hidden;
            border-right: 2px solid #3b82f6;
            white-space: nowrap;
            animation: typewriter 2s steps(12) 1s both, blink 1s step-end infinite;
        }

        @keyframes typewriter {
            from {
                width: 0;
            }
            to {
                width: 100%;
            }
        }

        @keyframes blink {
            50% {
                border-color: transparent;
            }
        }

        /* Parallax effect for footer background */
        .modern-footer::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 80%, rgba(59, 130, 246, 0.1) 0%, transparent 50%),
                        radial-gradient(circle at 80% 20%, rgba(139, 92, 246, 0.1) 0%, transparent 50%);
            animation: parallax 20s ease-in-out infinite;
            z-index: 0;
        }

        @keyframes parallax {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-10px) rotate(1deg);
            }
        }

        /* Ensure content stays above parallax background */
        .footer-main,
        .footer-newsletter,
        .footer-bottom {
            position: relative;
            z-index: 1;
        }
    `;
    document.head.appendChild(style);
</script>
