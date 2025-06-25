<footer class="footer-green">
    <div class="container">
        <div class="footer-content-green">
            <!-- About Section -->
            <div class="footer-section-green">
                <h4>Lubuk Hitam Waterfall</h4>
                <p>
                    Discover the breathtaking beauty of one of Indonesia's most spectacular natural destinations. 
                    Experience pristine waterfalls, lush forests, and unforgettable adventures in the heart of nature.
                </p>
                <div class="social-links-green mt-3">
                    <a href="#" class="social-link-green" aria-label="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-link-green" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-link-green" aria-label="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-link-green" aria-label="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="#" class="social-link-green" aria-label="TikTok">
                        <i class="fab fa-tiktok"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="footer-section-green">
                <h4>Quick Links</h4>
                <ul class="footer-links-green">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ route('minimap.index') }}">Interactive Map</a></li>
                    <li><a href="{{ url('gallery/') }}">Gallery</a></li>
                    <li><a href="{{ url('facilities/') }}">Facilities</a></li>
                    <li><a href="{{ url('beritas/') }}">News & Updates</a></li>
                    <li><a href="{{ url('contact') }}">Contact Us</a></li>
                </ul>
            </div>

            <!-- Services -->
            <div class="footer-section-green">
                <h4>Our Services</h4>
                <ul class="footer-links-green">
                    <li><a href="{{ url('tourguides/') }}">Tour Guides</a></li>
                    <li><a href="{{ route('madu.index') }}">Local Honey</a></li>
                    <li><a href="{{ route('produkUMKM.index') }}">UMKM Products</a></li>
                    <li><a href="{{ url('weather') }}">Weather Forecast</a></li>
                    <li><a href="{{ route('order-history.index') }}">Order History</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="footer-section-green">
                <h4>Contact Information</h4>
                <div class="contact-info-green">
                    <div class="contact-item-green">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Lubuk Hitam Waterfall<br>West Sumatra, Indonesia</span>
                    </div>
                    <div class="contact-item-green">
                        <i class="fas fa-phone"></i>
                        <span>+62 812-3456-7890</span>
                    </div>
                    <div class="contact-item-green">
                        <i class="fas fa-envelope"></i>
                        <span>info@lubukhitam.com</span>
                    </div>
                    <div class="contact-item-green">
                        <i class="fas fa-clock"></i>
                        <span>Open Daily: 6:00 AM - 6:00 PM</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom-green">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <p style="margin-bottom: 0; color: #014421;">
                        &copy; {{ date('Y') }} Lubuk Hitam Waterfall. All rights reserved.
                    </p>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <div class="footer-bottom-links">
                        <a href="{{ url('privacy-policy') }}">Privacy Policy</a>
                        <span class="separator">|</span>
                        <a href="{{ url('terms-of-service') }}">Terms of Service</a>
                        <span class="separator">|</span>
                        <a href="{{ url('sitemap') }}">Sitemap</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Back to Top Button -->
    <button id="backToTop" class="back-to-top-green" aria-label="Back to top">
        <i class="fas fa-chevron-up"></i>
    </button>
</footer>

<style>
/* Footer Forest Green Theme matching index.blade.php */
.footer-green {
    background: linear-gradient(135deg, 
        rgba(240, 255, 240, 0.95) 0%, 
        rgba(230, 255, 230, 0.98) 50%, 
        rgba(204, 255, 204, 0.95) 100%
    );
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border-top: 1px solid rgba(34, 139, 34, 0.2);
    padding: 3rem 0 0; /* Reduced padding */
    margin-top: 0; /* No top margin */
    position: relative;
    overflow: hidden;
}

/* Responsive spacing adjustments */
@media (max-width: 768px) {
    .footer-green {
        padding: 2rem 0 0; /* Even less padding on mobile */
        margin-top: 0;
    }
    
    .footer-content-green {
        grid-template-columns: 1fr;
        gap: 2rem;
        margin-bottom: 2rem;
    }
    
    .newsletter-section-green {
        padding: 2rem 1.5rem;
        text-align: center;
    }
    
    .newsletter-form-green .input-group {
        flex-direction: column;
        gap: 1rem;
        max-width: 100%;
    }
    
    .form-input-green,
    .btn-newsletter-green {
        border-radius: 25px !important;
        width: 100%;
    }
    
    .footer-bottom-links {
        justify-content: center;
        margin-top: 1rem;
        flex-wrap: wrap;
    }
    
    .back-to-top-green {
        bottom: 20px;
        right: 20px;
        width: 45px;
        height: 45px;
    }
    
    .social-links-green {
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .footer-green {
        padding: 1.5rem 0 0; /* Minimal padding on small screens */
    }
    
    .footer-section-green h4 {
        font-size: 1.1rem;
    }
    
    .newsletter-section-green {
        padding: 1.5rem 1rem;
    }
    
    .contact-item-green {
        font-size: 0.9rem;
    }
    
    .social-link-green {
        width: 40px;
        height: 40px;
        font-size: 1rem;
    }
}



.footer-green::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 20%, rgba(34, 139, 34, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(0, 100, 0, 0.1) 0%, transparent 50%);
    pointer-events: none;
}

.footer-content-green {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 3rem;
    margin-bottom: 3rem;
    position: relative;
    z-index: 2;
}

.footer-section-green h4 {
    color: #013220;
    font-weight: 700;
    margin-bottom: 1.5rem;
    font-size: 1.3rem;
    position: relative;
}

.footer-section-green h4::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 40px;
    height: 3px;
    background: linear-gradient(135deg, #228B22, #006400);
    border-radius: 2px;
}

.footer-section-green p {
    color: #014421;
    line-height: 1.7;
    margin-bottom: 1.5rem;
}

.footer-links-green {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links-green li {
    margin-bottom: 0.75rem;
}

.footer-links-green a {
    color: #014421;
    text-decoration: none;
    transition: all 0.3s ease;
    position: relative;
    padding-left: 1rem;
}

.footer-links-green a::before {
    content: '→';
    position: absolute;
    left: 0;
    color: #228B22;
    font-weight: bold;
    transition: all 0.3s ease;
    transform: translateX(-5px);
    opacity: 0;
}

.footer-links-green a:hover {
    color: #228B22;
    padding-left: 1.5rem;
}

.footer-links-green a:hover::before {
    transform: translateX(0);
    opacity: 1;
}

.social-links-green {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.social-link-green {
    width: 45px;
    height: 45px;
    background: rgba(34, 139, 34, 0.1);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(34, 139, 34, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #228B22;
    transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
    text-decoration: none;
    font-size: 1.1rem;
}

.social-link-green:hover {
    background: linear-gradient(135deg, #228B22, #006400);
    color: white;
    transform: translateY(-3px) scale(1.1);
    box-shadow: 0 10px 25px rgba(34, 139, 34, 0.4);
    border-color: transparent;
}

.contact-info-green {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.contact-item-green {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    color: #014421;
}

.contact-item-green i {
    color: #228B22;
    font-size: 1.1rem;
    margin-top: 0.2rem;
    min-width: 20px;
}

.newsletter-section-green {
    background: rgba(34, 139, 34, 0.05);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(34, 139, 34, 0.1);
    border-radius: 20px;
    padding: 2.5rem;
    margin-bottom: 3rem;
    position: relative;
    z-index: 2;
}

.newsletter-form-green .input-group {
    display: flex;
    max-width: 400px;
    margin-left: auto;
}

.form-input-green {
    flex: 1;
    padding: 1rem 1.5rem;
    border: 1px solid rgba(34, 139, 34, 0.3);
    background: rgba(255, 255, 255, 0.8);
    color: #013220;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-input-green:focus {
    outline: none;
    border-color: #228B22;
    box-shadow: 0 0 0 3px rgba(34, 139, 34, 0.1);
    background: rgba(255, 255, 255, 0.95);
}

.btn-newsletter-green:hover {
    background: linear-gradient(135deg, #006400, #013220) !important;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(34, 139, 34, 0.4);
}

.footer-bottom-green {
    border-top: 1px solid rgba(34, 139, 34, 0.2);
    padding: 2rem 0;
    position: relative;
    z-index: 2;
}

.footer-bottom-links {
    display: flex;
    align-items: center;
    gap: 1rem;
    justify-content: flex-end;
}

.footer-bottom-links a {
    color: #014421;
    text-decoration: none;
    transition: all 0.3s ease;
    font-weight: 500;
}

.footer-bottom-links a:hover {
    color: #228B22;
}

.footer-bottom-links .separator {
    color: rgba(34, 139, 34, 0.4);
}

.back-to-top-green {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #228B22, #006400);
    color: white;
    border: none;
    border-radius: 50%;
    font-size: 1.2rem;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
    box-shadow: 0 8px 25px rgba(34, 139, 34, 0.4);
    z-index: 1000;
    opacity: 0;
    visibility: hidden;
    transform: translateY(20px);
}

.back-to-top-green.visible {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.back-to-top-green:hover {
    background: linear-gradient(135deg, #006400, #013220);
    transform: translateY(-3px) scale(1.1);
    box-shadow: 0 15px 35px rgba(34, 139, 34, 0.6);
}

/* Responsive Design */
@media (max-width: 768px) {
    .footer-green {
        padding: 3rem 0 0;
        margin-top: 4rem;
    }
        .footer-content-green {
        grid-template-columns: 1fr;
        gap: 2rem;
        margin-bottom: 2rem;
    }
    
    .newsletter-section-green {
        padding: 2rem 1.5rem;
        text-align: center;
    }
    
    .newsletter-form-green .input-group {
        flex-direction: column;
        gap: 1rem;
        max-width: 100%;
    }
    
    .form-input-green,
    .btn-newsletter-green {
        border-radius: 25px !important;
        width: 100%;
    }
    
    .footer-bottom-links {
        justify-content: center;
        margin-top: 1rem;
        flex-wrap: wrap;
    }
    
    .back-to-top-green {
        bottom: 20px;
        right: 20px;
        width: 45px;
        height: 45px;
    }
    
    .social-links-green {
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .footer-section-green h4 {
        font-size: 1.1rem;
    }
    
    .newsletter-section-green {
        padding: 1.5rem 1rem;
    }
    
    .contact-item-green {
        font-size: 0.9rem;
    }
    
    .social-link-green {
        width: 40px;
        height: 40px;
        font-size: 1rem;
    }
}

/* Dark mode support */
@media (prefers-color-scheme: dark) {
    .footer-green {
        background: linear-gradient(135deg, 
            rgba(15, 20, 25, 0.95) 0%, 
            rgba(26, 35, 50, 0.98) 50%, 
            rgba(45, 55, 72, 0.95) 100%
        );
    }
    
    .footer-section-green h4,
    .footer-section-green p,
    .footer-links-green a,
    .contact-item-green {
        color: #e2e8f0;
    }
    
    .footer-links-green a:hover {
        color: #90EE90;
    }
    
    .newsletter-section-green {
        background: rgba(45, 55, 72, 0.3);
        border-color: rgba(144, 238, 144, 0.2);
    }
    
    .form-input-green {
        background: rgba(45, 55, 72, 0.8);
        border-color: rgba(144, 238, 144, 0.3);
        color: #e2e8f0;
    }
}

/* Print styles */
@media print {
    .footer-green {
        background: white !important;
        color: black !important;
    }
    
    .back-to-top-green,
    .social-links-green,
    .newsletter-section-green {
        display: none !important;
    }
    
    .footer-section-green h4,
    .footer-section-green p,
    .footer-links-green a {
        color: black !important;
    }
}

/* High contrast mode */
@media (prefers-contrast: high) {
    .footer-green {
        background: #ffffff !important;
        border-top: 3px solid #000000 !important;
    }
    
    .footer-section-green h4,
    .footer-section-green p,
    .footer-links-green a,
    .contact-item-green {
        color: #000000 !important;
    }
    
    .social-link-green {
        background: #ffffff !important;
        border: 2px solid #000000 !important;
        color: #000000 !important;
    }
    
    .back-to-top-green {
        background: #000000 !important;
        color: #ffffff !important;
    }
}

/* Reduced motion support */
@media (prefers-reduced-motion: reduce) {
    .social-link-green,
    .footer-links-green a,
    .back-to-top-green,
    .btn-newsletter-green {
        transition: none !important;
    }
    
    .social-link-green:hover,
    .back-to-top-green:hover {
        transform: none !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Back to top functionality
    const backToTopBtn = document.getElementById('backToTop');
    
    function toggleBackToTop() {
        if (window.pageYOffset > 300) {
            backToTopBtn.classList.add('visible');
        } else {
            backToTopBtn.classList.remove('visible');
        }
    }
    
    // Show/hide back to top button on scroll
    window.addEventListener('scroll', toggleBackToTop, { passive: true });
    
    // Smooth scroll to top
    backToTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    
    // Newsletter form submission
    const newsletterForm = document.querySelector('.newsletter-form-green');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const emailInput = this.querySelector('input[type="email"]');
            const email = emailInput.value.trim();
            
            if (email) {
                // Show loading state
                const submitBtn = this.querySelector('.btn-newsletter-green');
                const originalText = submitBtn.textContent;
                submitBtn.textContent = 'Subscribing...';
                submitBtn.disabled = true;
                
                // Simulate API call
                setTimeout(() => {
                    // Show success message
                    showFooterNotification('Thank you for subscribing! 🎉', 'success');
                    emailInput.value = '';
                    
                    // Reset button
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;
                }, 1500);
            }
        });
    }
    
    // Social media link tracking
    document.querySelectorAll('.social-link-green').forEach(link => {
        link.addEventListener('click', function(e) {
            const platform = this.querySelector('i').className.split('-')[1];
            console.log(`Social media click: ${platform}`);
            
            // Add ripple effect
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            
            ripple.style.cssText = `
                position: absolute;
                width: ${size}px;
                height: ${size}px;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%) scale(0);
                background: rgba(255, 255, 255, 0.6);
                border-radius: 50%;
                animation: social-ripple 0.6s ease-out;
                pointer-events: none;
            `;
            
            this.style.position = 'relative';
            this.style.overflow = 'hidden';
            this.appendChild(ripple);
            
            setTimeout(() => ripple.remove(), 600);
        });
    });
    
    // Footer links hover effects
    document.querySelectorAll('.footer-links-green a').forEach(link => {
        link.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(5px)';
        });
        
        link.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
        });
    });
    
    // Contact info click handlers
    document.querySelectorAll('.contact-item-green').forEach(item => {
        const icon = item.querySelector('i');
        const text = item.querySelector('span').textContent;
        
        item.addEventListener('click', function() {
            if (icon.classList.contains('fa-phone')) {
                const phone = text.replace(/\s/g, '');
                window.open(`tel:${phone}`);
            } else if (icon.classList.contains('fa-envelope')) {
                window.open(`mailto:${text}`);
            } else if (icon.classList.contains('fa-map-marker-alt')) {
                const query = encodeURIComponent(text);
                window.open(`https://maps.google.com/maps?q=${query}`);
            }
        });
        
        // Add cursor pointer for clickable items
        if (icon.classList.contains('fa-phone') || 
            icon.classList.contains('fa-envelope') || 
            icon.classList.contains('fa-map-marker-alt')) {
            item.style.cursor = 'pointer';
            
            item.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(5px)';
                this.style.color = '#228B22';
            });
            
            item.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(0)';
                this.style.color = '#014421';
            });
        }
    });
    
    // Footer notification system
    function showFooterNotification(message, type = 'info') {
        // Remove existing notifications
        document.querySelectorAll('.footer-notification').forEach(n => n.remove());
        
        const notification = document.createElement('div');
        notification.className = 'footer-notification';
        
        const bgColor = type === 'success' ? 'linear-gradient(135deg, #10b981, #059669)' : 
                        type === 'warning' ? 'linear-gradient(135deg, #f59e0b, #d97706)' : 
                        type === 'error' ? 'linear-gradient(135deg, #ef4444, #dc2626)' :
                        'linear-gradient(135deg, #3b82f6, #2563eb)';
        
        notification.style.cssText = `
            position: fixed;
            bottom: 100px;
            right: 30px;
            z-index: 10000;
            padding: 1rem 1.5rem;
            background: ${bgColor};
            color: white;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            font-weight: 500;
            max-width: 300px;
            animation: slideInUp 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            font-size: 0.9rem;
            line-height: 1.4;
        `;
        
        notification.textContent = message;
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.animation = 'slideOutDown 0.4s cubic-bezier(0.25, 0.8, 0.25, 1)';
            setTimeout(() => notification.remove(), 400);
        }, 3000);
    }
    
    // Lazy load footer images if any
    const footerImages = document.querySelectorAll('.footer-green img[data-src]');
    if (footerImages.length > 0) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                    observer.unobserve(img);
                }
            });
        });
        
        footerImages.forEach(img => imageObserver.observe(img));
    }
    
    // Footer animation on scroll into view
    const footer = document.querySelector('.footer-green');
    const footerObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                footer.style.animation = 'fadeInUp 0.8s ease-out';
                
                // Animate footer sections with stagger
                const sections = footer.querySelectorAll('.footer-section-green');
                sections.forEach((section, index) => {
                    setTimeout(() => {
                        section.style.animation = 'fadeInUp 0.6s ease-out';
                        section.style.animationFillMode = 'both';
                    }, index * 100);
                });
            }
        });
    }, { threshold: 0.1 });
    
    footerObserver.observe(footer);
    
    // Performance monitoring for footer
    if ('PerformanceObserver' in window) {
        const perfObserver = new PerformanceObserver((list) => {
            list.getEntries().forEach((entry) => {
                if (entry.name.includes('footer') && entry.duration > 100) {
                    console.warn('Footer performance issue detected:', entry);
                }
            });
        });
        
        try {
            perfObserver.observe({ entryTypes: ['measure'] });
        } catch (e) {
            // Fallback for browsers that don't support all entry types
        }
    }
    
    console.log('🦶 Footer loaded successfully with glassmorphism theme!');
});

// Additional CSS animations for footer
const footerAnimations = document.createElement('style');
footerAnimations.textContent = `
    @keyframes social-ripple {
        to {
            transform: translate(-50%, -50%) scale(2);
            opacity: 0;
        }
    }
    
    @keyframes slideInUp {
        from {
            transform: translateY(30px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOutDown {
        from {
            transform: translateY(0);
            opacity: 1;
        }
        to {
            transform: translateY(30px);
            opacity: 0;
        }
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Smooth transitions for all footer elements */
    .footer-green * {
        transition: all 0.3s ease;
    }
    
    /* Focus styles for accessibility */
    .footer-green a:focus,
    .footer-green button:focus,
    .footer-green input:focus {
        outline: 3px solid rgba(34, 139, 34, 0.6);
        outline-offset: 2px;
        border-radius: 4px;
    }
`;

document.head.appendChild(footerAnimations);
</script>
