// ===================================
// JEDH Website - JavaScript
// ===================================

// DOM Ready
document.addEventListener('DOMContentLoaded', function() {

    // Initialize all components
    initMobileMenu();
    initLanguageSwitch();
    initSmoothScroll();
    initScrollEffects();
    loadInsuranceLogos();
    initCTATracking();

});

// ===================================
// Mobile Menu Toggle
// ===================================
function initMobileMenu() {
    const toggle = document.querySelector('.mobile-menu-toggle');
    const menu = document.querySelector('.nav-menu');

    if (toggle && menu) {
        toggle.addEventListener('click', function() {
            menu.classList.toggle('active');
            toggle.classList.toggle('active');

            // Animate hamburger
            const spans = toggle.querySelectorAll('span');
            if (toggle.classList.contains('active')) {
                spans[0].style.transform = 'rotate(45deg) translateY(8px)';
                spans[1].style.opacity = '0';
                spans[2].style.transform = 'rotate(-45deg) translateY(-8px)';
            } else {
                spans[0].style.transform = 'none';
                spans[1].style.opacity = '1';
                spans[2].style.transform = 'none';
            }
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!toggle.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.remove('active');
                toggle.classList.remove('active');
                const spans = toggle.querySelectorAll('span');
                spans[0].style.transform = 'none';
                spans[1].style.opacity = '1';
                spans[2].style.transform = 'none';
            }
        });
    }
}

// ===================================
// Language Switcher
// ===================================
function initLanguageSwitch() {
    const langButtons = document.querySelectorAll('.lang-btn');
    let currentLang = 'en';

    langButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            langButtons.forEach(b => b.classList.remove('active'));

            // Add active class to clicked button
            this.classList.add('active');

            // Get selected language
            const lang = this.getAttribute('data-lang');
            currentLang = lang;

            // Switch content
            switchLanguage(lang);
        });
    });
}

function switchLanguage(lang) {
    // Get all elements with bilingual content
    const elements = document.querySelectorAll('[data-en][data-hi]');

    elements.forEach(element => {
        const enText = element.getAttribute('data-en');
        const hiText = element.getAttribute('data-hi');

        if (lang === 'en') {
            element.textContent = enText;
        } else if (lang === 'hi') {
            element.textContent = hiText;
        }
    });

    // Store preference
    localStorage.setItem('jedh-language', lang);
}

// Load saved language preference
window.addEventListener('load', function() {
    const savedLang = localStorage.getItem('jedh-language');
    if (savedLang) {
        const langBtn = document.querySelector(`.lang-btn[data-lang="${savedLang}"]`);
        if (langBtn) {
            langBtn.click();
        }
    }
});

// ===================================
// Smooth Scroll
// ===================================
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
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
}

// ===================================
// Scroll Effects
// ===================================
function initScrollEffects() {
    const navbar = document.querySelector('.navbar');
    let lastScroll = 0;

    window.addEventListener('scroll', function() {
        const currentScroll = window.pageYOffset;

        // Add shadow on scroll
        if (currentScroll > 100) {
            navbar.style.boxShadow = '0 4px 6px rgba(0,0,0,0.1)';
        } else {
            navbar.style.boxShadow = '0 2px 4px rgba(0,0,0,0.05)';
        }

        lastScroll = currentScroll;
    });

    // Intersection Observer for fade-in animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe sections for animation
    const sections = document.querySelectorAll('.service-card, .feature-item, .pricing-card, .testimonial-card');
    sections.forEach(section => {
        section.style.opacity = '0';
        section.style.transform = 'translateY(30px)';
        section.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(section);
    });
}

// ===================================
// Load Insurance Logos
// ===================================
function loadInsuranceLogos() {
    const insuranceGrid = document.getElementById('insuranceGrid');

    if (!insuranceGrid) return;

    // Sample insurance partners (you can replace with actual logos from Cashless folder)
    const insurancePartners = [
        'RGHS',
        'CGHS',
        'Star Health',
        'ICICI Lombard',
        'HDFC ERGO',
        'Care Health',
        'Max Bupa',
        'Bajaj Allianz',
        'Aditya Birla',
        'National Insurance',
        'New India',
        'United India'
    ];

    insurancePartners.forEach(partner => {
        const div = document.createElement('div');
        div.className = 'insurance-logo-item';

        // For now, use text. Replace with actual image path
        const span = document.createElement('span');
        span.textContent = partner;
        span.style.fontSize = '0.875rem';
        span.style.fontWeight = '600';
        span.style.color = '#4A4A4A';
        span.style.textAlign = 'center';

        div.appendChild(span);
        insuranceGrid.appendChild(div);
    });
}

// ===================================
// CTA Tracking
// ===================================
function initCTATracking() {
    // Track WhatsApp CTA clicks
    const whatsappButtons = document.querySelectorAll('a[href*="wa.me"]');
    whatsappButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            console.log('WhatsApp CTA clicked:', this.textContent.trim());
            // Add analytics tracking here
            // Example: gtag('event', 'whatsapp_click', { button: this.textContent });
        });
    });

    // Track Phone CTA clicks
    const phoneButtons = document.querySelectorAll('a[href^="tel:"]');
    phoneButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            console.log('Phone CTA clicked');
            // Add analytics tracking here
        });
    });

    // Track Service Explore clicks
    const serviceLinks = document.querySelectorAll('.service-card a, .pricing-card a');
    serviceLinks.forEach(link => {
        link.addEventListener('click', function() {
            console.log('Service link clicked:', this.href);
            // Add analytics tracking here
        });
    });
}

// ===================================
// Form Handling (for future booking form)
// ===================================
function handleBookingForm() {
    const form = document.querySelector('#booking-form');

    if (!form) return;

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(form);
        const data = Object.fromEntries(formData);

        console.log('Form submitted:', data);

        // Show success message
        alert('Thank you! We will contact you shortly.');
        form.reset();

        // Send to backend/CRM
        // fetch('/api/booking', { method: 'POST', body: JSON.stringify(data) })
    });
}

// ===================================
// Testimonial Slider (Simple Auto-scroll)
// ===================================
function initTestimonialSlider() {
    const slider = document.querySelector('.testimonial-slider');
    if (!slider) return;

    let currentIndex = 0;
    const cards = slider.querySelectorAll('.testimonial-card');
    const totalCards = cards.length;

    // Auto-scroll every 5 seconds
    setInterval(function() {
        currentIndex = (currentIndex + 1) % totalCards;
        const offset = currentIndex * -100;
        slider.style.transform = `translateX(${offset}%)`;
    }, 5000);
}

// ===================================
// Floating Elements Animation
// ===================================
function initFloatingElements() {
    const floatingCards = document.querySelectorAll('.floating-card');

    floatingCards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.3}s`;
    });
}

// ===================================
// Lazy Loading Images
// ===================================
function initLazyLoading() {
    const images = document.querySelectorAll('img[data-src]');

    const imageObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.getAttribute('data-src');
                img.removeAttribute('data-src');
                imageObserver.unobserve(img);
            }
        });
    });

    images.forEach(img => imageObserver.observe(img));
}

// ===================================
// Scroll to Top Button
// ===================================
function initScrollToTop() {
    const scrollBtn = document.createElement('button');
    scrollBtn.innerHTML = '<i class="fas fa-arrow-up"></i>';
    scrollBtn.className = 'scroll-to-top';
    scrollBtn.style.cssText = `
        position: fixed;
        bottom: 100px;
        right: 30px;
        width: 50px;
        height: 50px;
        background: var(--primary-color);
        color: white;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 998;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    `;

    document.body.appendChild(scrollBtn);

    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 500) {
            scrollBtn.style.opacity = '1';
        } else {
            scrollBtn.style.opacity = '0';
        }
    });

    scrollBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

// Initialize scroll to top
initScrollToTop();

// ===================================
// Cookie Consent Banner (Optional)
// ===================================
function initCookieConsent() {
    const consent = localStorage.getItem('jedh-cookie-consent');

    if (!consent) {
        const banner = document.createElement('div');
        banner.style.cssText = `
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: var(--text-dark);
            color: white;
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 2rem;
            z-index: 9999;
            box-shadow: 0 -4px 10px rgba(0,0,0,0.1);
        `;

        banner.innerHTML = `
            <p style="margin: 0; flex: 1;">We use cookies to improve your experience on our site. By continuing, you agree to our use of cookies.</p>
            <button id="accept-cookies" style="background: var(--primary-color); color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 600;">Accept</button>
        `;

        document.body.appendChild(banner);

        document.getElementById('accept-cookies').addEventListener('click', function() {
            localStorage.setItem('jedh-cookie-consent', 'true');
            banner.remove();
        });
    }
}

// Initialize cookie consent after a delay
setTimeout(initCookieConsent, 2000);

// ===================================
// Analytics Integration (Google Analytics example)
// ===================================
function initAnalytics() {
    // Add your Google Analytics tracking ID
    // window.dataLayer = window.dataLayer || [];
    // function gtag(){dataLayer.push(arguments);}
    // gtag('js', new Date());
    // gtag('config', 'GA_TRACKING_ID');

    console.log('Analytics initialized');
}

// ===================================
// Error Handling
// ===================================
window.addEventListener('error', function(e) {
    console.error('Error:', e.error);
});

// ===================================
// Performance Monitoring
// ===================================
window.addEventListener('load', function() {
    const perfData = window.performance.timing;
    const pageLoadTime = perfData.loadEventEnd - perfData.navigationStart;
    console.log('Page load time:', pageLoadTime, 'ms');
});

// ===================================
// Export for use in other scripts
// ===================================
window.JEDH = {
    switchLanguage,
    handleBookingForm
};
