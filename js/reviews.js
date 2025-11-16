// ===================================
// Google Places API - Reviews Integration
// ===================================

const GOOGLE_PLACES_CONFIG = {
    apiKey: 'AIzaSyCVUqY8DKR5cG4tFRz1j1wDLajd0TrmGwU',
    placeId: '11f2b0wpph', // JEDH Place ID from Google Maps
    cacheKey: 'jedh_google_reviews',
    cacheExpiry: 24 * 60 * 60 * 1000 // 24 hours in milliseconds
};

// Fetch reviews from Google Places API (New)
async function fetchGoogleReviews() {
    try {
        console.log('Fetching Google reviews for Place ID:', GOOGLE_PLACES_CONFIG.placeId);
        
        // Check cache first
        const cachedData = getCachedReviews();
        if (cachedData) {
            console.log('Using cached reviews data');
            return cachedData;
        }

        // Fetch from Google Places API (New)
        const response = await fetch(
            `https://places.googleapis.com/v1/places/${GOOGLE_PLACES_CONFIG.placeId}`,
            {
                method: 'GET',
                headers: {
                    'X-Goog-Api-Key': GOOGLE_PLACES_CONFIG.apiKey,
                    'X-Goog-FieldMask': 'reviews,rating,user_ratings_total,displayName'
                }
            }
        );

        if (!response.ok) {
            const errorData = await response.json();
            console.error('Google Places API Error:', errorData);
            
            // If API is not enabled yet, show helpful message
            if (response.status === 403) {
                throw new Error('Places API (New) is not enabled. Please enable it in Google Cloud Console and wait a few minutes for it to propagate.');
            }
            
            throw new Error(`API request failed: ${response.status} - ${errorData.error?.message || 'Unknown error'}`);
        }

        const data = await response.json();
        console.log('Google Places API Response:', data);

        // Process and cache the data
        const processedData = processReviewsData(data);
        cacheReviews(processedData);
        
        return processedData;

    } catch (error) {
        console.error('Error fetching Google reviews:', error);
        throw error;
    }
}

// Process reviews data from API response
function processReviewsData(apiData) {
    const reviews = apiData.reviews || [];
    const rating = apiData.rating || 0;
    const totalReviews = apiData.user_ratings_total || 0;
    const businessName = apiData.displayName?.text || 'Jaipur Eye & Dental Hospital';

    // Filter 5-star reviews and sort by most recent
    const fiveStarReviews = reviews
        .filter(review => review.rating === 5)
        .sort((a, b) => {
            // Sort by publish time (most recent first)
            const timeA = new Date(a.publishTime || a.relativePublishTimeDescription || 0);
            const timeB = new Date(b.publishTime || b.relativePublishTimeDescription || 0);
            return timeB - timeA;
        })
        .slice(0, 5); // Get top 5

    // Calculate rating breakdown
    const ratingBreakdown = calculateRatingBreakdown(reviews);

    return {
        businessName,
        rating: rating.toFixed(1),
        totalReviews,
        reviews: fiveStarReviews,
        allReviews: reviews, // Keep all reviews for breakdown calculation
        ratingBreakdown
    };
}

// Calculate rating breakdown (5-star, 4-star, etc.)
function calculateRatingBreakdown(reviews) {
    const breakdown = {
        5: 0,
        4: 0,
        3: 0,
        2: 0,
        1: 0
    };

    reviews.forEach(review => {
        const rating = review.rating;
        if (rating >= 1 && rating <= 5) {
            breakdown[rating]++;
        }
    });

    const total = reviews.length;
    const percentages = {};
    const counts = {};

    for (let i = 5; i >= 1; i--) {
        counts[i] = breakdown[i];
        percentages[i] = total > 0 ? ((breakdown[i] / total) * 100).toFixed(1) : 0;
    }

    return { counts, percentages, total };
}

// Format review date
function formatReviewDate(review) {
    if (review.publishTime) {
        const date = new Date(review.publishTime);
        const now = new Date();
        const diffTime = Math.abs(now - date);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        
        if (diffDays === 0) return 'Today';
        if (diffDays === 1) return 'Yesterday';
        if (diffDays < 7) return `${diffDays} days ago`;
        if (diffDays < 30) return `${Math.floor(diffDays / 7)} weeks ago`;
        if (diffDays < 365) return `${Math.floor(diffDays / 30)} months ago`;
        return `${Math.floor(diffDays / 365)} years ago`;
    }
    
    // Fallback to relative description if available
    if (review.relativePublishTimeDescription) {
        return review.relativePublishTimeDescription;
    }
    
    return 'Recently';
}

// Render reviews on the page
function renderReviews(reviewsData) {
    const reviewsGrid = document.getElementById('reviewsGrid');
    if (!reviewsGrid) return;

    // Clear existing static reviews
    reviewsGrid.innerHTML = '';

    if (!reviewsData.reviews || reviewsData.reviews.length === 0) {
        reviewsGrid.innerHTML = '<div class="review-card"><p>No 5-star reviews available at the moment.</p></div>';
        return;
    }

    // Render each review
    reviewsData.reviews.forEach((review, index) => {
        const reviewCard = createReviewCard(review, index);
        reviewsGrid.appendChild(reviewCard);
    });

    console.log(`Rendered ${reviewsData.reviews.length} 5-star reviews`);
}

// Create a review card element
function createReviewCard(review, index) {
    const card = document.createElement('div');
    card.className = 'review-card';
    card.setAttribute('data-rating', review.rating);
    card.setAttribute('data-service', 'all'); // Default, can be enhanced later
    card.setAttribute('data-dynamic', 'true'); // Mark as dynamically loaded

    const authorName = review.authorAttribution?.displayName || review.authorAttribution?.uri?.replace('https://www.google.com/maps/contrib/', '').split('/')[0] || 'Anonymous';
    const reviewText = review.text?.text || review.text || 'No review text available.';
    const rating = review.rating || 5;
    const date = formatReviewDate(review);

    // Create stars HTML
    const starsHtml = Array.from({ length: 5 }, (_, i) => 
        `<i class="fas ${i < rating ? 'fa-star' : 'far fa-star'}"></i>`
    ).join('');

    card.innerHTML = `
        <div class="review-header">
            <div class="review-author">
                <h4>${escapeHtml(authorName)}</h4>
                <p class="review-service">Google Review</p>
            </div>
            <div class="review-rating">
                ${starsHtml}
            </div>
        </div>
        <p class="review-content">"${escapeHtml(reviewText)}"</p>
        <div class="review-footer">
            <span class="review-date">${date}</span>
            <span class="review-verified">
                <i class="fas fa-check-circle"></i> Google Verified
            </span>
        </div>
    `;

    return card;
}

// Update overall rating section
function updateOverallRating(reviewsData) {
    // Update rating number
    const ratingNumber = document.querySelector('.rating-number');
    if (ratingNumber) {
        ratingNumber.textContent = reviewsData.rating;
    }

    // Update rating count
    const ratingCount = document.querySelector('.rating-count');
    if (ratingCount) {
        ratingCount.textContent = `Based on ${formatNumber(reviewsData.totalReviews)} reviews`;
    }

    // Update stars display
    const ratingStars = document.querySelector('.rating-stars');
    if (ratingStars) {
        const rating = parseFloat(reviewsData.rating);
        const fullStars = Math.floor(rating);
        const hasHalfStar = rating % 1 >= 0.5;
        
        let starsHtml = '';
        for (let i = 0; i < fullStars; i++) {
            starsHtml += '<i class="fas fa-star"></i>';
        }
        if (hasHalfStar) {
            starsHtml += '<i class="fas fa-star-half-alt"></i>';
        }
        for (let i = fullStars + (hasHalfStar ? 1 : 0); i < 5; i++) {
            starsHtml += '<i class="far fa-star"></i>';
        }
        ratingStars.innerHTML = starsHtml;
    }

    // Update rating breakdown bars
    if (reviewsData.ratingBreakdown) {
        const breakdown = reviewsData.ratingBreakdown;
        const total = breakdown.total || 1;

        for (let star = 5; star >= 1; star--) {
            const count = breakdown.counts[star] || 0;
            const percentage = total > 0 ? (count / total * 100) : 0;
            
            const barElement = document.querySelector(`.rating-bar:nth-child(${6 - star})`);
            if (barElement) {
                const progressBar = barElement.querySelector('.rating-bar-progress');
                const countElement = barElement.querySelector('.rating-bar-count');
                
                if (progressBar) {
                    progressBar.style.width = `${percentage}%`;
                }
                if (countElement) {
                    countElement.textContent = formatNumber(count);
                }
            }
        }
    }
}

// Update stats section
function updateStatsSection(reviewsData) {
    const stats = calculateStats(reviewsData);
    
    // Update stat items
    const statItems = document.querySelectorAll('.stat-item');
    if (statItems.length >= 4) {
        // Happy Patients - use total reviews
        if (statItems[0]) {
            const numberEl = statItems[0].querySelector('.stat-number');
            if (numberEl) {
                numberEl.textContent = formatNumber(reviewsData.totalReviews) + '+';
            }
        }
        
        // Average Rating
        if (statItems[1]) {
            const numberEl = statItems[1].querySelector('.stat-number');
            if (numberEl) {
                numberEl.textContent = reviewsData.rating + '★';
            }
        }
        
        // 5-Star Percentage
        if (statItems[2] && reviewsData.ratingBreakdown) {
            const total = reviewsData.ratingBreakdown.total || 1;
            const fiveStarCount = reviewsData.ratingBreakdown.counts[5] || 0;
            const percentage = total > 0 ? Math.round((fiveStarCount / total) * 100) : 0;
            const numberEl = statItems[2].querySelector('.stat-number');
            if (numberEl) {
                numberEl.textContent = percentage + '%';
            }
        }
        
        // Years of Trust - calculate from business start (2017) or keep static
        // Since business started in 2017, calculate years
        if (statItems[3]) {
            const yearsSince2017 = new Date().getFullYear() - 2017;
            const numberEl = statItems[3].querySelector('.stat-number');
            if (numberEl) {
                numberEl.textContent = yearsSince2017 + '+';
            }
        }
    }
}

// Calculate additional stats
function calculateStats(reviewsData) {
    const breakdown = reviewsData.ratingBreakdown || {};
    const total = breakdown.total || reviewsData.totalReviews || 0;
    const fiveStarCount = breakdown.counts[5] || 0;
    const fiveStarPercentage = total > 0 ? Math.round((fiveStarCount / total) * 100) : 0;

    return {
        totalReviews: total,
        averageRating: reviewsData.rating,
        fiveStarPercentage
    };
}

// Cache management
function cacheReviews(data) {
    try {
        const cacheData = {
            data: data,
            timestamp: Date.now()
        };
        localStorage.setItem(GOOGLE_PLACES_CONFIG.cacheKey, JSON.stringify(cacheData));
        console.log('Reviews cached successfully');
    } catch (error) {
        console.error('Error caching reviews:', error);
    }
}

function getCachedReviews() {
    try {
        const cached = localStorage.getItem(GOOGLE_PLACES_CONFIG.cacheKey);
        if (!cached) return null;

        const cacheData = JSON.parse(cached);
        const now = Date.now();

        if (now - cacheData.timestamp > GOOGLE_PLACES_CONFIG.cacheExpiry) {
            localStorage.removeItem(GOOGLE_PLACES_CONFIG.cacheKey);
            return null;
        }

        return cacheData.data;
    } catch (error) {
        console.error('Error reading cached reviews:', error);
        return null;
    }
}

// Utility functions
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function formatNumber(num) {
    if (num >= 1000) {
        return (num / 1000).toFixed(1) + 'K';
    }
    return num.toString();
}

// Initialize reviews on page load
async function initGoogleReviews() {
    // Check if we're on the reviews page
    if (!document.getElementById('reviewsGrid')) {
        return;
    }

    console.log('Initializing Google Reviews integration...');

    try {
        // Show loading state
        const reviewsGrid = document.getElementById('reviewsGrid');
        if (reviewsGrid) {
            reviewsGrid.innerHTML = '<div class="review-card"><p>Loading reviews...</p></div>';
        }

        // Fetch reviews
        const reviewsData = await fetchGoogleReviews();

        // Render reviews
        renderReviews(reviewsData);
        updateOverallRating(reviewsData);
        updateStatsSection(reviewsData);

        // Update page header text
        const pageHeader = document.querySelector('.page-header p');
        if (pageHeader && reviewsData.totalReviews) {
            pageHeader.textContent = `Real stories from ${formatNumber(reviewsData.totalReviews)}+ satisfied patients who trusted JEDH for their eye and dental care`;
        }

        // Update showing count
        const showingText = document.querySelector('.reviews-section .text-center p');
        if (showingText && reviewsData.reviews) {
            showingText.textContent = `Showing ${reviewsData.reviews.length} of ${formatNumber(reviewsData.totalReviews)}+ reviews`;
        }

        // Update Google Reviews section
        const googleRatingText = document.querySelector('.google-rating-text');
        if (googleRatingText && reviewsData.rating) {
            googleRatingText.textContent = `Rated ${reviewsData.rating} on Google`;
        }

        const googleStars = document.querySelector('.google-stars');
        if (googleStars && reviewsData.rating) {
            const rating = parseFloat(reviewsData.rating);
            const fullStars = Math.floor(rating);
            const hasHalfStar = rating % 1 >= 0.5;
            
            let starsHtml = '';
            for (let i = 0; i < fullStars; i++) {
                starsHtml += '<i class="fas fa-star"></i>';
            }
            if (hasHalfStar) {
                starsHtml += '<i class="fas fa-star-half-alt"></i>';
            }
            for (let i = fullStars + (hasHalfStar ? 1 : 0); i < 5; i++) {
                starsHtml += '<i class="far fa-star"></i>';
            }
            googleStars.innerHTML = starsHtml;
        }

        const googleReviewCount = document.querySelector('.google-badge p');
        if (googleReviewCount && reviewsData.totalReviews) {
            googleReviewCount.textContent = `Based on ${formatNumber(reviewsData.totalReviews)} Google reviews`;
        }

        console.log('Google Reviews loaded successfully');

    } catch (error) {
        console.error('Failed to load Google reviews:', error);
        
        // Show error message but keep static content
        const reviewsGrid = document.getElementById('reviewsGrid');
        if (reviewsGrid) {
            reviewsGrid.innerHTML = `
                <div class="review-card">
                    <p style="color: var(--text-medium);">
                        Unable to load reviews from Google at this time. 
                        ${error.message.includes('not enabled') ? 'Please enable Places API (New) in Google Cloud Console.' : 'Please try again later.'}
                    </p>
                </div>
            `;
        }
    }
}

// Export for use
window.initGoogleReviews = initGoogleReviews;

// Auto-initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initGoogleReviews);
} else {
    initGoogleReviews();
}

