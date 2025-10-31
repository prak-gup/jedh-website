<?php
/**
 * Video Section Template Part
 *
 * @package JEDH
 */
?>

<!-- Video Section -->
<section class="video-section">
    <div class="container">
        <div class="video-content">
            <div class="video-text">
                <h2 data-en="Learn About Our Services" data-hi="हमारी सेवाओं के बारे में जानें">Learn About Our Services</h2>
                <p data-en="Watch our doctors explain treatment procedures, recovery, and what to expect" data-hi="हमारे डॉक्टरों को उपचार प्रक्रियाओं, रिकवरी और क्या उम्मीद करें के बारे में समझाते हुए देखें">Watch our doctors explain treatment procedures, recovery, and what to expect</p>
                <a href="https://www.youtube.com/@JEDH" class="btn btn-outline" target="_blank">
                    <i class="fab fa-youtube"></i>
                    <span data-en="Visit Our YouTube Channel" data-hi="हमारे YouTube चैनल पर जाएं">Visit Our YouTube Channel</span>
                </a>
            </div>
            <div class="video-slider-container">
                <!-- Loading State -->
                <div class="video-loading" id="videoLoading">
                    <div class="loading-spinner"></div>
                    <p>Loading videos...</p>
                </div>
                
                <!-- Video Slider -->
                <div class="video-slider" id="videoSlider" style="display: none;">
                    <button class="slider-btn slider-prev" id="prevBtn" aria-label="Previous videos">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    
                    <div class="video-slider-track" id="sliderTrack">
                        <!-- Videos will be dynamically inserted here -->
                    </div>
                    
                    <button class="slider-btn slider-next" id="nextBtn" aria-label="Next videos">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
                
                <!-- Error State -->
                <div class="video-error" id="videoError" style="display: none;">
                    <div class="error-placeholder">
                        <i class="fab fa-youtube"></i>
                        <span>Educational Videos</span>
                        <p>Unable to load videos. <a href="https://www.youtube.com/@JEDH" target="_blank">Visit our YouTube channel</a></p>
                    </div>
                </div>
                
                <!-- Slider Indicators -->
                <div class="slider-indicators" id="sliderIndicators">
                    <!-- Dots will be dynamically inserted here -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Video Modal -->
<div class="video-modal" id="videoModal">
    <div class="modal-overlay" id="modalOverlay"></div>
    <div class="modal-content">
        <button class="modal-close" id="modalClose" aria-label="Close video">
            <i class="fas fa-times"></i>
        </button>
        <div class="modal-video-container">
            <iframe id="modalVideo" src="" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
</div>
