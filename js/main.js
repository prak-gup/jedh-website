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
    initYouTubeVideoSlider();
    initTeamSlider();

});

// ===================================
// Mobile Menu Toggle
// ===================================
function initMobileMenu() {
    const toggle = document.querySelector('.mobile-menu-toggle');
    const menu = document.querySelector('.nav-menu');
    const body = document.body;

    if (toggle && menu) {
        toggle.addEventListener('click', function(e) {
            e.stopPropagation();
            e.preventDefault();
            const isActive = menu.classList.contains('active');
            
            menu.classList.toggle('active');
            toggle.classList.toggle('active');
            body.classList.toggle('menu-open');

            // Prevent body scroll when menu is open
            if (!isActive) {
                body.style.overflow = 'hidden';
                body.style.position = 'fixed';
                body.style.width = '100%';
            } else {
                body.style.overflow = '';
                body.style.position = '';
                body.style.width = '';
            }

            // Hamburger animation is now handled by CSS
        });

        // Close menu when clicking on menu links (but not dropdown toggles)
        const menuLinks = menu.querySelectorAll('a');
        menuLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                // Don't close if it's a dropdown toggle
                if (this.parentElement.classList.contains('dropdown') && this.nextElementSibling) {
                    return; // Let dropdown handler manage this
                }
                
                // Close menu for regular links
                menu.classList.remove('active');
                toggle.classList.remove('active');
                body.classList.remove('menu-open');
                body.style.overflow = '';
                body.style.position = '';
                body.style.width = '';
            });
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!toggle.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.remove('active');
                toggle.classList.remove('active');
                body.classList.remove('menu-open');
                body.style.overflow = '';
                body.style.position = '';
                body.style.width = '';
            }
        });

        // Close menu on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && menu.classList.contains('active')) {
                menu.classList.remove('active');
                toggle.classList.remove('active');
                body.classList.remove('menu-open');
                body.style.overflow = '';
                body.style.position = '';
                body.style.width = '';
            }
        });

        // Handle dropdown menus in mobile
        const dropdowns = menu.querySelectorAll('.dropdown');
        dropdowns.forEach(dropdown => {
            const dropdownToggle = dropdown.querySelector('a');
            const dropdownMenu = dropdown.querySelector('.dropdown-menu');
            
            if (dropdownToggle && dropdownMenu) {
                dropdownToggle.addEventListener('click', function(e) {
                    // Only prevent default on mobile
                    if (window.innerWidth <= 768) {
                        e.preventDefault();
                        e.stopPropagation();
                        
                        // Close other dropdowns
                        dropdowns.forEach(otherDropdown => {
                            if (otherDropdown !== dropdown) {
                                otherDropdown.classList.remove('active');
                            }
                        });
                        
                        // Toggle current dropdown
                        dropdown.classList.toggle('active');
                    }
                });
            }
        });
        
        // Improve touch handling for mobile menu
        if (window.innerWidth <= 768) {
            // Add touch event listeners for better mobile interaction
            menu.addEventListener('touchstart', function(e) {
                // Improve touch response
            }, { passive: true });
        }
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
    // Insurance logos are now rendered as static HTML for no-JS fallback
    // No dynamic loading needed
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
    
    // Mobile-specific performance optimizations
    if (window.innerWidth <= 768) {
        // Reduce animations on mobile for better performance
        const animatedElements = document.querySelectorAll('.floating-card, .whatsapp-float');
        animatedElements.forEach(el => {
            el.style.animationDuration = '4s'; // Slower animations on mobile
        });
        
        // Lazy load images that are not in viewport
        initLazyLoading();
    }
});

// ===================================
// Mobile-Specific Optimizations
// ===================================
function initMobileOptimizations() {
    // Detect if device is mobile
    const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || window.innerWidth <= 768;
    
    if (isMobile) {
        // Add mobile class to body for CSS targeting
        document.body.classList.add('mobile-device');
        
        // Optimize touch interactions
        document.addEventListener('touchstart', function() {}, {passive: true});
        document.addEventListener('touchmove', function() {}, {passive: true});
        
        // Prevent double-tap zoom on buttons
        const buttons = document.querySelectorAll('.btn, .mobile-menu-toggle, .lang-btn');
        buttons.forEach(btn => {
            btn.addEventListener('touchend', function(e) {
                e.preventDefault();
                this.click();
            });
        });
        
        // Optimize scroll performance
        let ticking = false;
        function updateScrollEffects() {
            // Your scroll effects here
            ticking = false;
        }
        
        window.addEventListener('scroll', function() {
            if (!ticking) {
                requestAnimationFrame(updateScrollEffects);
                ticking = true;
            }
        }, {passive: true});
    }
}

// Initialize mobile optimizations
initMobileOptimizations();

// ===================================
// YouTube Video Slider
// ===================================

// YouTube Configuration (no API key needed - uses RSS feed)
const YOUTUBE_CONFIG = {
    channelId: 'UCLN1jQPyiXFuerx-TMjuEeQ', // Direct channel ID for JEDH
    maxResults: 12,
    cacheKey: 'jedh_youtube_videos_v3',
    cacheExpiry: 24 * 60 * 60 * 1000 // 24 hours in milliseconds
};

// Hardcoded fallback video data from JEDH channel (updated Jan 2026)
const FALLBACK_VIDEOS = [
    { id: 'jRY3wmp3xyY', title: 'More Than Surgery | Life of an Ophthalmologist' },
    { id: 'hwwaPTZUT-U', title: '83-Year-Old Patient, Cool & Calm During Cataract Surgery' },
    { id: 'DI7KaCMmcFc', title: 'How We Prepare Our Team for Advanced Dental Technology' },
    { id: 'T90W7SPM5_k', title: 'Femto LASIK Patient Testimonial | Bhumika\'s Experience' },
    { id: 'Frj4sRSAshI', title: 'Real stories. Real trust.' },
    { id: 'NcWYTEDwVGg', title: 'Small space. Big focus' },
    { id: 'ii-7KT0Vw5U', title: 'Young Cataract Surgery | Rayner Galaxy IOL Implanted' },
    { id: 'LSmSLxrp-_k', title: 'Age is just a number - Fitness is a choice' },
    { id: 'F_DRuXJcPH4', title: 'Old Lenses in New Frame? Here\'s Why It Can Cause Problems' },
    { id: 'pSCuCvfHDdA', title: 'Thinking About Invisalign? Watch This First Visit Guide' },
    { id: 'o9vBuGwR6XU', title: 'Cataract Surgery Follow-Up: Don\'t Forget Your Eye Drops & Papers' },
    { id: 'hTGzSA3Jnpg', title: 'My Oldest Patient Ever - 105 Years Young' },
    { id: 'uY0QCDfMKrQ', title: 'Root Canal Without Fear | Patient Review' },
    { id: 'MVbhHdEZ90I', title: 'Don\'t Pick Your Laser Surgery Before Watching This' },
    { id: 'LfWgQhCliSE', title: 'Stop Using Reading Glasses! Your Eyes Are at Risk' }
].map(v => ({
    id: v.id,
    title: v.title,
    description: '',
    thumbnail: `https://i.ytimg.com/vi/${v.id}/mqdefault.jpg`,
    publishedAt: '',
    channelId: YOUTUBE_CONFIG.channelId,
    viewCount: 0,
    duration: '',
    url: `https://www.youtube.com/watch?v=${v.id}`,
    embedUrl: `https://www.youtube.com/embed/${v.id}?autoplay=1&rel=0`
}));

// Global variables for video slider
let currentVideoIndex = 0;
let videosPerView = 3;
let totalVideos = 0;
let videos = [];

function initYouTubeVideoSlider() {
    // Check if video section exists
    const videoSection = document.getElementById('videoSlider');
    if (!videoSection) return;

    // Set videos per view based on screen size
    updateVideosPerView();
    window.addEventListener('resize', updateVideosPerView);

    console.log('Initializing YouTube video slider with channel ID:', YOUTUBE_CONFIG.channelId);

    // Clear old cache versions
    clearAllOldCache();

    // Check cache first
    const cachedVideos = getCachedVideos();
    if (cachedVideos && cachedVideos.length > 0) {
        console.log('Using cached videos:', cachedVideos.length);
        videos = cachedVideos;
        renderVideoSlider();
        return;
    }

    // Try fetching from RSS feed, fall back to hardcoded data
    fetchYouTubeVideos();
}

function updateVideosPerView() {
    if (window.innerWidth <= 480) {
        videosPerView = 1;
    } else if (window.innerWidth <= 768) {
        videosPerView = 2;
    } else {
        videosPerView = 3;
    }
}

async function fetchYouTubeVideos() {
    try {
        showLoadingState();
        console.log('Fetching YouTube videos via RSS feed...');

        // Try fetching from YouTube RSS feed via CORS proxy
        const rssUrl = `https://www.youtube.com/feeds/videos.xml?channel_id=${YOUTUBE_CONFIG.channelId}`;
        const proxyUrl = `https://api.allorigins.win/raw?url=${encodeURIComponent(rssUrl)}`;

        const response = await fetch(proxyUrl);

        if (!response.ok) {
            throw new Error(`RSS fetch failed: ${response.status}`);
        }

        const xmlText = await response.text();
        const parser = new DOMParser();
        const xmlDoc = parser.parseFromString(xmlText, 'text/xml');
        const entries = xmlDoc.querySelectorAll('entry');

        if (!entries || entries.length === 0) {
            throw new Error('No videos found in RSS feed');
        }

        videos = Array.from(entries).slice(0, YOUTUBE_CONFIG.maxResults).map(entry => {
            const videoId = entry.querySelector('videoId')?.textContent || '';
            const title = entry.querySelector('title')?.textContent || '';
            const published = entry.querySelector('published')?.textContent || '';
            const mediaGroup = entry.querySelector('group');
            const description = mediaGroup?.querySelector('description')?.textContent || '';
            const viewCount = parseInt(mediaGroup?.querySelector('community statistics')?.getAttribute('views') || '0');

            return {
                id: videoId,
                title: title,
                description: description,
                thumbnail: `https://i.ytimg.com/vi/${videoId}/mqdefault.jpg`,
                publishedAt: published,
                channelId: YOUTUBE_CONFIG.channelId,
                viewCount: viewCount,
                duration: '',
                url: `https://www.youtube.com/watch?v=${videoId}`,
                embedUrl: `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0`
            };
        });

        console.log(`Fetched ${videos.length} videos from RSS feed`);

        // Cache the videos
        cacheVideos(videos);

        // Render the slider
        renderVideoSlider();

    } catch (error) {
        console.error('RSS feed fetch failed, using fallback videos:', error);
        // Use hardcoded fallback data
        videos = FALLBACK_VIDEOS.slice(0, YOUTUBE_CONFIG.maxResults);
        console.log(`Using ${videos.length} fallback videos`);
        cacheVideos(videos);
        renderVideoSlider();
    }
}

function formatDuration(duration) {
    // Convert ISO 8601 duration (PT4M13S) to readable format (4:13)
    const match = duration.match(/PT(?:(\d+)H)?(?:(\d+)M)?(?:(\d+)S)?/);
    if (!match) return '0:00';
    
    const hours = parseInt(match[1] || 0);
    const minutes = parseInt(match[2] || 0);
    const seconds = parseInt(match[3] || 0);
    
    if (hours > 0) {
        return `${hours}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    } else {
        return `${minutes}:${seconds.toString().padStart(2, '0')}`;
    }
}

function formatViewCount(count) {
    if (count >= 1000000) {
        return (count / 1000000).toFixed(1) + 'M';
    } else if (count >= 1000) {
        return (count / 1000).toFixed(1) + 'K';
    }
    return count.toString();
}

function renderVideoSlider() {
    const sliderTrack = document.getElementById('sliderTrack');
    const loadingElement = document.getElementById('videoLoading');
    const sliderElement = document.getElementById('videoSlider');
    const indicatorsElement = document.getElementById('sliderIndicators');

    if (!sliderTrack || !loadingElement || !sliderElement) return;

    // Hide loading, show slider
    loadingElement.style.display = 'none';
    sliderElement.style.display = 'flex';

    // Clear existing content
    sliderTrack.innerHTML = '';
    indicatorsElement.innerHTML = '';

    // Reset slider position
    currentVideoIndex = 0;

    totalVideos = videos.length;
    const totalSlides = Math.ceil(totalVideos / videosPerView);
    
    console.log(`Rendering slider: ${totalVideos} videos, ${videosPerView} per view, ${totalSlides} slides`);

    // Create video cards
    console.log(`Creating ${videos.length} video cards...`);
    videos.forEach((video, index) => {
        const videoCard = createVideoCard(video, index);
        sliderTrack.appendChild(videoCard);
    });
    
    console.log(`Created ${sliderTrack.children.length} video cards in DOM`);

    // Only show indicators if there's more than one slide
    if (totalSlides > 1) {
        for (let i = 0; i < totalSlides; i++) {
            const dot = document.createElement('div');
            dot.className = `indicator-dot ${i === 0 ? 'active' : ''}`;
            dot.addEventListener('click', () => goToSlide(i));
            indicatorsElement.appendChild(dot);
        }
    } else {
        // Hide indicators if only one slide
        indicatorsElement.style.display = 'none';
    }

    // Initialize slider controls
    initSliderControls();
    
    // Set initial position after a brief delay to ensure cards are rendered
    setTimeout(() => {
        updateSliderPosition();
    }, 100);
}

function createVideoCard(video, index) {
    const card = document.createElement('div');
    card.className = 'video-card';
    card.setAttribute('data-video-id', video.id);
    card.setAttribute('data-video-index', index);

    const durationHtml = video.duration ? `<div class="video-duration">${video.duration}</div>` : '';
    const viewsHtml = video.viewCount > 0 ? `
            <div class="video-meta">
                <div class="video-views">
                    <i class="fas fa-eye"></i>
                    <span>${formatViewCount(video.viewCount)}</span>
                </div>
            </div>` : '';

    card.innerHTML = `
        <div class="video-thumbnail">
            <img src="${video.thumbnail}" alt="${video.title}" loading="lazy">
            <div class="video-play-overlay">
                <i class="fas fa-play"></i>
            </div>
            ${durationHtml}
        </div>
        <div class="video-info">
            <h3 class="video-title">${video.title}</h3>
            ${viewsHtml}
        </div>
    `;

    // Add click event to open modal
    card.addEventListener('click', () => openVideoModal(video));

    return card;
}

function initSliderControls() {
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    if (prevBtn) {
        prevBtn.addEventListener('click', () => previousSlide());
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', () => nextSlide());
    }

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') {
            previousSlide();
        } else if (e.key === 'ArrowRight') {
            nextSlide();
        }
    });
}

function nextSlide() {
    const totalSlides = Math.ceil(totalVideos / videosPerView);
    console.log(`Next slide: current=${currentVideoIndex}, total=${totalSlides}`);
    if (currentVideoIndex < totalSlides - 1) {
        currentVideoIndex++;
        updateSliderPosition();
    } else {
        console.log('Already at last slide');
    }
}

function previousSlide() {
    console.log(`Previous slide: current=${currentVideoIndex}`);
    if (currentVideoIndex > 0) {
        currentVideoIndex--;
        updateSliderPosition();
    } else {
        console.log('Already at first slide');
    }
}

function goToSlide(slideIndex) {
    currentVideoIndex = slideIndex;
    updateSliderPosition();
}

function updateSliderPosition() {
    const sliderTrack = document.getElementById('sliderTrack');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const indicators = document.querySelectorAll('.indicator-dot');
    const sliderContainer = sliderTrack?.closest('.video-slider');

    if (!sliderTrack) return;

    // Get actual card width and gap from computed styles
    const firstCard = sliderTrack.querySelector('.video-card');
    if (!firstCard) {
        console.warn('No video cards found in slider track');
        return;
    }
    
    const cardWidth = firstCard.offsetWidth;
    const cardRect = firstCard.getBoundingClientRect();
    const trackStyle = window.getComputedStyle(sliderTrack);
    
    // Get gap - could be in px, rem, or em
    let gap = 24; // Default fallback
    const gapValue = trackStyle.gap;
    if (gapValue) {
        // Convert rem/em to px if needed
        if (gapValue.includes('rem')) {
            const remValue = parseFloat(gapValue);
            gap = remValue * parseFloat(getComputedStyle(document.documentElement).fontSize);
        } else if (gapValue.includes('em')) {
            const emValue = parseFloat(gapValue);
            gap = emValue * parseFloat(getComputedStyle(sliderTrack).fontSize);
        } else {
            gap = parseInt(gapValue) || 24;
        }
    }
    
    // Alternative: calculate gap from second card position if available
    const secondCard = sliderTrack.querySelector('.video-card:nth-child(2)');
    if (secondCard) {
        const secondCardRect = secondCard.getBoundingClientRect();
        const calculatedGap = secondCardRect.left - cardRect.right;
        if (calculatedGap > 0) {
            gap = calculatedGap;
        }
    }
    
    // Calculate transform: move by one "page" of videos (videosPerView cards)
    // Each page = videosPerView * (cardWidth + gap)
    const cardWithGap = cardWidth + gap;
    const translateX = -(currentVideoIndex * videosPerView * cardWithGap);
    
    sliderTrack.style.transform = `translateX(${translateX}px)`;
    sliderTrack.style.transition = 'transform 0.5s ease';

    // Update button states
    const totalSlides = Math.ceil(totalVideos / videosPerView);
    
    if (prevBtn) {
        const isFirst = currentVideoIndex === 0;
        prevBtn.disabled = isFirst;
        prevBtn.style.opacity = isFirst ? '0.5' : '1';
        prevBtn.style.cursor = isFirst ? 'not-allowed' : 'pointer';
    }
    
    if (nextBtn) {
        const isLast = currentVideoIndex >= totalSlides - 1;
        nextBtn.disabled = isLast;
        nextBtn.style.opacity = isLast ? '0.5' : '1';
        nextBtn.style.cursor = isLast ? 'not-allowed' : 'pointer';
    }

    // Update indicators
    indicators.forEach((dot, index) => {
        dot.classList.toggle('active', index === currentVideoIndex);
    });
    
    console.log(`Slider position: ${currentVideoIndex + 1}/${totalSlides}`, {
        totalVideos,
        videosPerView,
        cardWidth,
        gap,
        cardWithGap,
        translateX,
        totalSlides
    });
}

function openVideoModal(video) {
    const modal = document.getElementById('videoModal');
    const modalVideo = document.getElementById('modalVideo');
    const modalClose = document.getElementById('modalClose');
    const modalOverlay = document.getElementById('modalOverlay');

    if (!modal || !modalVideo) return;

    // Set video source
    modalVideo.src = video.embedUrl;

    // Show modal
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';

    // Close modal events
    const closeModal = () => {
        modal.classList.remove('active');
        modalVideo.src = '';
        document.body.style.overflow = '';
    };

    if (modalClose) {
        modalClose.addEventListener('click', closeModal);
    }

    if (modalOverlay) {
        modalOverlay.addEventListener('click', closeModal);
    }

    // Close on escape key
    const handleEscape = (e) => {
        if (e.key === 'Escape') {
            closeModal();
            document.removeEventListener('keydown', handleEscape);
        }
    };
    document.addEventListener('keydown', handleEscape);
}

function showLoadingState() {
    const loadingElement = document.getElementById('videoLoading');
    const sliderElement = document.getElementById('videoSlider');
    const errorElement = document.getElementById('videoError');

    if (loadingElement) loadingElement.style.display = 'flex';
    if (sliderElement) sliderElement.style.display = 'none';
    if (errorElement) errorElement.style.display = 'none';
}

function showErrorState() {
    const loadingElement = document.getElementById('videoLoading');
    const sliderElement = document.getElementById('videoSlider');
    const errorElement = document.getElementById('videoError');

    if (loadingElement) loadingElement.style.display = 'none';
    if (sliderElement) sliderElement.style.display = 'none';
    if (errorElement) errorElement.style.display = 'flex';
}

function cacheVideos(videos) {
    const cacheData = {
        videos: videos,
        timestamp: Date.now()
    };
    localStorage.setItem(YOUTUBE_CONFIG.cacheKey, JSON.stringify(cacheData));
}

function getCachedVideos() {
    try {
        const cached = localStorage.getItem(YOUTUBE_CONFIG.cacheKey);
        if (!cached) return null;

        const cacheData = JSON.parse(cached);
        const now = Date.now();

        // Check if cache is still valid
        if (now - cacheData.timestamp > YOUTUBE_CONFIG.cacheExpiry) {
            localStorage.removeItem(YOUTUBE_CONFIG.cacheKey);
            return null;
        }

        // Validate cached videos belong to correct channel
        if (cacheData.videos && Array.isArray(cacheData.videos)) {
            const validCachedVideos = cacheData.videos.filter(video => {
                return video.channelId === YOUTUBE_CONFIG.channelId;
            });

            if (validCachedVideos.length === 0) {
                // Cache contains videos from wrong channel, clear it
                console.log('Cached videos are from wrong channel, clearing cache');
                clearVideoCache();
                return null;
            }

            return validCachedVideos;
        }

        return cacheData.videos;
    } catch (error) {
        console.error('Error reading cached videos:', error);
        return null;
    }
}

function clearVideoCache() {
    try {
        localStorage.removeItem(YOUTUBE_CONFIG.cacheKey);
        console.log('Video cache cleared');
    } catch (error) {
        console.error('Error clearing video cache:', error);
    }
}

function clearAllOldCache() {
    try {
        const oldCacheKeys = [
            'jedh_youtube_videos',
            'jedh_youtube_videos_v1',
            'jedh_youtube_videos_v2'
        ];

        oldCacheKeys.forEach(key => {
            if (localStorage.getItem(key)) {
                localStorage.removeItem(key);
                console.log(`Cleared old cache: ${key}`);
            }
        });
    } catch (error) {
        console.error('Error clearing old cache:', error);
    }
}

// ===================================
// Team Photo Slider
// ===================================
function initTeamSlider() {
    const slides = document.querySelectorAll('.team-slide');
    const dots = document.querySelectorAll('.team-slider-dot');
    const prevBtn = document.querySelector('.team-slider-prev');
    const nextBtn = document.querySelector('.team-slider-next');

    if (!slides.length || slides.length <= 1) return; // No slider needed

    let currentSlide = 0;
    const totalSlides = slides.length;

    // Show slide function
    function showSlide(index) {
        // Remove active class from all slides and dots
        slides.forEach(slide => slide.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));

        // Add active class to current slide and dot
        slides[index].classList.add('active');
        dots[index].classList.add('active');

        currentSlide = index;
    }

    // Next slide
    function nextSlide() {
        const next = (currentSlide + 1) % totalSlides;
        showSlide(next);
    }

    // Previous slide
    function prevSlide() {
        const prev = (currentSlide - 1 + totalSlides) % totalSlides;
        showSlide(prev);
    }

    // Event listeners for arrows
    if (prevBtn) {
        prevBtn.addEventListener('click', prevSlide);
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', nextSlide);
    }

    // Event listeners for dots
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => showSlide(index));
    });

    // Auto-advance slider every 5 seconds
    let autoSlideInterval = setInterval(nextSlide, 5000);

    // Pause auto-slide on hover
    const sliderContainer = document.querySelector('.team-slider');
    if (sliderContainer) {
        sliderContainer.addEventListener('mouseenter', () => {
            clearInterval(autoSlideInterval);
        });

        sliderContainer.addEventListener('mouseleave', () => {
            autoSlideInterval = setInterval(nextSlide, 5000);
        });
    }

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        const teamSection = document.querySelector('.team-showcase');
        if (!teamSection) return;

        // Only handle if team section is in viewport
        const rect = teamSection.getBoundingClientRect();
        const isVisible = rect.top < window.innerHeight && rect.bottom > 0;

        if (isVisible) {
            if (e.key === 'ArrowLeft') {
                prevSlide();
            } else if (e.key === 'ArrowRight') {
                nextSlide();
            }
        }
    });

    // Touch swipe support for mobile
    let touchStartX = 0;
    let touchEndX = 0;

    if (sliderContainer) {
        sliderContainer.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        sliderContainer.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, { passive: true });
    }

    function handleSwipe() {
        const swipeThreshold = 50;
        const diff = touchStartX - touchEndX;

        if (Math.abs(diff) > swipeThreshold) {
            if (diff > 0) {
                // Swipe left - next slide
                nextSlide();
            } else {
                // Swipe right - previous slide
                prevSlide();
            }
        }
    }
}

// ===================================
// Export for use in other scripts
// ===================================
window.JEDH = {
    switchLanguage,
    handleBookingForm,
    openVideoModal
};
