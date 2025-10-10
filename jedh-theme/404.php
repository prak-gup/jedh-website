<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package JEDH
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <div class="error-404">
            <div class="error-content">
                <div class="error-icon">
                    <i class="fas fa-search"></i>
                </div>
                
                <h1 class="error-title">404 - Page Not Found</h1>
                
                <p class="error-message">
                    Sorry, the page you are looking for doesn't exist or has been moved.
                </p>
                
                <div class="error-actions">
                    <a href="<?php echo home_url(); ?>" class="btn btn-primary">
                        <i class="fas fa-home"></i>
                        Go to Homepage
                    </a>
                    
                    <a href="https://wa.me/<?php echo jedh_get_option('whatsapp', '919602227267'); ?>" class="btn btn-secondary">
                        <i class="fab fa-whatsapp"></i>
                        Contact Us
                    </a>
                </div>
                
                <div class="search-section">
                    <h3>Search for what you need:</h3>
                    <?php get_search_form(); ?>
                </div>
                
                <div class="helpful-links">
                    <h3>Popular Pages:</h3>
                    <ul>
                        <li><a href="<?php echo home_url('/services/'); ?>">Our Services</a></li>
                        <li><a href="<?php echo home_url('/doctors/'); ?>">Our Doctors</a></li>
                        <li><a href="<?php echo home_url('/pricing/'); ?>">Pricing</a></li>
                        <li><a href="<?php echo home_url('/contact/'); ?>">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
.error-404 {
    text-align: center;
    padding: 4rem 0;
    min-height: 60vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.error-content {
    max-width: 600px;
    margin: 0 auto;
}

.error-icon {
    font-size: 4rem;
    color: var(--primary-color);
    margin-bottom: 2rem;
}

.error-title {
    font-size: 2.5rem;
    color: #333;
    margin-bottom: 1rem;
}

.error-message {
    font-size: 1.2rem;
    color: #666;
    margin-bottom: 2rem;
    line-height: 1.6;
}

.error-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-bottom: 3rem;
}

.search-section {
    margin-bottom: 3rem;
    padding: 2rem;
    background: #f9f9f9;
    border-radius: 12px;
}

.search-section h3 {
    margin-bottom: 1rem;
    color: #333;
}

.helpful-links {
    text-align: left;
}

.helpful-links h3 {
    margin-bottom: 1rem;
    color: #333;
}

.helpful-links ul {
    list-style: none;
    padding: 0;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 0.5rem;
}

.helpful-links li {
    padding: 0.5rem 0;
}

.helpful-links a {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 500;
}

.helpful-links a:hover {
    text-decoration: underline;
}

@media (max-width: 768px) {
    .error-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .error-title {
        font-size: 2rem;
    }
    
    .helpful-links ul {
        grid-template-columns: 1fr;
    }
}
</style>

<?php get_footer(); ?>
