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
            menu.classList.toggle('active');
            toggle.classList.toggle('active');

            // Prevent body scroll when menu is open
            if (menu.classList.contains('active')) {
                body.style.overflow = 'hidden';
            } else {
                body.style.overflow = '';
            }

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

        // Close menu when clicking on menu links
        const menuLinks = menu.querySelectorAll('a');
        menuLinks.forEach(link => {
            link.addEventListener('click', function() {
                menu.classList.remove('active');
                toggle.classList.remove('active');
                body.style.overflow = '';
                
                const spans = toggle.querySelectorAll('span');
                spans[0].style.transform = 'none';
                spans[1].style.opacity = '1';
                spans[2].style.transform = 'none';
            });
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!toggle.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.remove('active');
                toggle.classList.remove('active');
                body.style.overflow = '';
                
                const spans = toggle.querySelectorAll('span');
                spans[0].style.transform = 'none';
                spans[1].style.opacity = '1';
                spans[2].style.transform = 'none';
            }
        });

        // Close menu on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && menu.classList.contains('active')) {
                menu.classList.remove('active');
                toggle.classList.remove('active');
                body.style.overflow = '';
                
                const spans = toggle.querySelectorAll('span');
                spans[0].style.transform = 'none';
                spans[1].style.opacity = '1';
                spans[2].style.transform = 'none';
            }
        });

        // Handle dropdown menus in mobile
        const dropdowns = menu.querySelectorAll('.dropdown');
        dropdowns.forEach(dropdown => {
            const dropdownToggle = dropdown.querySelector('a');
            const dropdownMenu = dropdown.querySelector('.dropdown-menu');
            
            if (dropdownToggle && dropdownMenu) {
                dropdownToggle.addEventListener('click', function(e) {
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
                });
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

// YouTube API Configuration
const YOUTUBE_CONFIG = {
    apiKey: 'AIzaSyCVUqY8DKR5cG4tFRz1j1wDLajd0TrmGwU',
    channelUsername: 'JEDH',
    // Try to get the actual channel ID from the channel URL
    // Visit https://www.youtube.com/@JEDH and look for the channel ID in the page source
    // or use a tool like https://commentpicker.com/youtube-channel-id.php
    fallbackChannelId: null, // We'll set this once we get the actual channel ID
    maxResults: 5,
    cacheKey: 'jedh_youtube_videos',
    cacheExpiry: 24 * 60 * 60 * 1000 // 24 hours in milliseconds
};

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

    // Try to load videos from cache first
    const cachedVideos = getCachedVideos();
    if (cachedVideos) {
        videos = cachedVideos;
        renderVideoSlider();
        return;
    }

    // Test API connection first
    testYouTubeAPI().then(() => {
        // Fetch videos from YouTube API
        fetchYouTubeVideos();
    }).catch((error) => {
        console.error('YouTube API test failed:', error);
        showErrorState();
    });
}

// Test function to check if API is working
async function testYouTubeAPI() {
    try {
        console.log('Testing YouTube API connection...');
        const testUrl = `https://www.googleapis.com/youtube/v3/search?part=snippet&q=test&type=video&maxResults=1&key=${YOUTUBE_CONFIG.apiKey}`;
        
        const response = await fetch(testUrl);
        if (!response.ok) {
            const errorText = await response.text();
            throw new Error(`API test failed: ${response.status} - ${errorText}`);
        }
        
        const data = await response.json();
        console.log('YouTube API test successful:', data);
        return true;
    } catch (error) {
        console.error('YouTube API test failed:', error);
        throw error;
    }
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
        console.log('Starting YouTube video fetch...');
        
        // First, get channel ID from username
        const channelId = await getChannelId(YOUTUBE_CONFIG.channelUsername);
        console.log('Channel ID:', channelId);
        
        if (!channelId || channelId === 'UC_KNOWN_CHANNEL_ID') {
            throw new Error('Channel not found. Please check the channel username or provide the channel ID manually.');
        }

        // Fetch videos from the channel
        const apiUrl = `https://www.googleapis.com/youtube/v3/search?` +
            `part=snippet&` +
            `channelId=${channelId}&` +
            `order=viewCount&` +
            `type=video&` +
            `maxResults=${YOUTUBE_CONFIG.maxResults}&` +
            `key=${YOUTUBE_CONFIG.apiKey}`;
            
        console.log('Fetching videos from:', apiUrl);
        
        const response = await fetch(apiUrl);

        if (!response.ok) {
            const errorText = await response.text();
            console.error('API Error Response:', errorText);
            throw new Error(`API request failed: ${response.status} - ${errorText}`);
        }

        const data = await response.json();
        console.log('API Response:', data);
        
        if (!data.items || data.items.length === 0) {
            throw new Error('No videos found in the channel');
        }

        // Process and enhance video data
        videos = await enhanceVideoData(data.items);
        console.log('Processed videos:', videos);
        
        // Cache the videos
        cacheVideos(videos);
        
        // Render the slider
        renderVideoSlider();
        
    } catch (error) {
        console.error('Error fetching YouTube videos:', error);
        showErrorState();
    }
}

async function getChannelId(username) {
    try {
        // Try the forUsername method first
        let response = await fetch(
            `https://www.googleapis.com/youtube/v3/channels?` +
            `part=id&` +
            `forUsername=${username}&` +
            `key=${YOUTUBE_CONFIG.apiKey}`
        );

        if (response.ok) {
            const data = await response.json();
            if (data.items && data.items.length > 0) {
                return data.items[0].id;
            }
        }

        // If forUsername fails, try searching by channel handle
        response = await fetch(
            `https://www.googleapis.com/youtube/v3/search?` +
            `part=snippet&` +
            `q=${username}&` +
            `type=channel&` +
            `maxResults=1&` +
            `key=${YOUTUBE_CONFIG.apiKey}`
        );

        if (response.ok) {
            const data = await response.json();
            if (data.items && data.items.length > 0) {
                return data.items[0].id.channelId;
            }
        }

        // If both fail, try with the known channel ID for @JEDH
        // You can find this by visiting the channel and looking at the URL
        console.log('Trying fallback channel ID for JEDH...');
        return 'UC_KNOWN_CHANNEL_ID'; // We'll need to get this
        
    } catch (error) {
        console.error('Error getting channel ID:', error);
        return null;
    }
}

async function enhanceVideoData(videoItems) {
    const videoIds = videoItems.map(item => item.id.videoId).join(',');
    
    try {
        // Get additional video details (duration, view count, etc.)
        const response = await fetch(
            `https://www.googleapis.com/youtube/v3/videos?` +
            `part=contentDetails,statistics&` +
            `id=${videoIds}&` +
            `key=${YOUTUBE_CONFIG.apiKey}`
        );

        if (!response.ok) {
            throw new Error('Failed to get video details');
        }

        const detailsData = await response.json();
        const videoDetails = detailsData.items;

        // Combine snippet data with details
        return videoItems.map((item, index) => {
            const details = videoDetails[index] || {};
            return {
                id: item.id.videoId,
                title: item.snippet.title,
                description: item.snippet.description,
                thumbnail: item.snippet.thumbnails.medium.url,
                publishedAt: item.snippet.publishedAt,
                viewCount: details.statistics ? parseInt(details.statistics.viewCount) : 0,
                duration: details.contentDetails ? formatDuration(details.contentDetails.duration) : '0:00',
                url: `https://www.youtube.com/watch?v=${item.id.videoId}`,
                embedUrl: `https://www.youtube.com/embed/${item.id.videoId}?autoplay=1&rel=0`
            };
        });
    } catch (error) {
        console.error('Error enhancing video data:', error);
        // Return basic data if enhancement fails
        return videoItems.map(item => ({
            id: item.id.videoId,
            title: item.snippet.title,
            description: item.snippet.description,
            thumbnail: item.snippet.thumbnails.medium.url,
            publishedAt: item.snippet.publishedAt,
            viewCount: 0,
            duration: '0:00',
            url: `https://www.youtube.com/watch?v=${item.id.videoId}`,
            embedUrl: `https://www.youtube.com/embed/${item.id.videoId}?autoplay=1&rel=0`
        }));
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

    totalVideos = videos.length;
    const totalSlides = Math.ceil(totalVideos / videosPerView);

    // Create video cards
    videos.forEach((video, index) => {
        const videoCard = createVideoCard(video, index);
        sliderTrack.appendChild(videoCard);
    });

    // Create indicators
    for (let i = 0; i < totalSlides; i++) {
        const dot = document.createElement('div');
        dot.className = `indicator-dot ${i === 0 ? 'active' : ''}`;
        dot.addEventListener('click', () => goToSlide(i));
        indicatorsElement.appendChild(dot);
    }

    // Initialize slider controls
    initSliderControls();
    
    // Set initial position
    updateSliderPosition();
}

function createVideoCard(video, index) {
    const card = document.createElement('div');
    card.className = 'video-card';
    card.setAttribute('data-video-id', video.id);
    card.setAttribute('data-video-index', index);

    card.innerHTML = `
        <div class="video-thumbnail">
            <img src="${video.thumbnail}" alt="${video.title}" loading="lazy">
            <div class="video-play-overlay">
                <i class="fas fa-play"></i>
            </div>
            <div class="video-duration">${video.duration}</div>
        </div>
        <div class="video-info">
            <h3 class="video-title">${video.title}</h3>
            <div class="video-meta">
                <div class="video-views">
                    <i class="fas fa-eye"></i>
                    <span>${formatViewCount(video.viewCount)}</span>
                </div>
            </div>
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
    if (currentVideoIndex < totalSlides - 1) {
        currentVideoIndex++;
        updateSliderPosition();
    }
}

function previousSlide() {
    if (currentVideoIndex > 0) {
        currentVideoIndex--;
        updateSliderPosition();
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

    if (!sliderTrack) return;

    // Calculate transform
    const translateX = -(currentVideoIndex * videosPerView * (280 + 24)); // 280px card width + 24px gap
    sliderTrack.style.transform = `translateX(${translateX}px)`;

    // Update button states
    const totalSlides = Math.ceil(totalVideos / videosPerView);
    if (prevBtn) prevBtn.disabled = currentVideoIndex === 0;
    if (nextBtn) nextBtn.disabled = currentVideoIndex >= totalSlides - 1;

    // Update indicators
    indicators.forEach((dot, index) => {
        dot.classList.toggle('active', index === currentVideoIndex);
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

        return cacheData.videos;
    } catch (error) {
        console.error('Error reading cached videos:', error);
        return null;
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
