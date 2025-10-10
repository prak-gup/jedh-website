<?php
/**
 * Booking Form Template Part
 *
 * @package JEDH
 */

// Get services for dropdown
$services = get_posts(array(
    'post_type' => 'service',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC'
));
?>

<div class="booking-form-container">
    <div class="booking-form-header">
        <h3>Book Your Consultation</h3>
        <p>Fill out the form below and we'll get back to you within 24 hours</p>
    </div>
    
    <?php if (isset($_GET['booking']) && $_GET['booking'] === 'success') : ?>
        <div class="booking-success">
            <i class="fas fa-check-circle"></i>
            <h4>Thank you for your booking request!</h4>
            <p>We have received your request and will contact you within 24 hours to confirm your appointment.</p>
        </div>
    <?php endif; ?>
    
    <form class="booking-form" method="post" action="">
        <?php wp_nonce_field('jedh_booking_action', 'jedh_booking_nonce'); ?>
        
        <div class="form-row">
            <div class="form-group">
                <label for="booking_name">Full Name *</label>
                <input type="text" id="booking_name" name="name" required>
            </div>
            
            <div class="form-group">
                <label for="booking_phone">Phone Number *</label>
                <input type="tel" id="booking_phone" name="phone" required>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="booking_email">Email Address</label>
                <input type="email" id="booking_email" name="email">
            </div>
            
            <div class="form-group">
                <label for="booking_service">Service Interested In *</label>
                <select id="booking_service" name="service" required>
                    <option value="">Select a service</option>
                    <?php if (!empty($services)) : ?>
                        <?php foreach ($services as $service) : ?>
                            <option value="<?php echo esc_attr(get_the_title($service->ID)); ?>">
                                <?php echo esc_html(get_the_title($service->ID)); ?>
                            </option>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <option value="Cataract Surgery">Cataract Surgery</option>
                        <option value="LASIK/PRK">LASIK/PRK</option>
                        <option value="Dental Implants">Dental Implants</option>
                        <option value="Invisalign">Invisalign</option>
                        <option value="General Consultation">General Consultation</option>
                    <?php endif; ?>
                </select>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="booking_date">Preferred Date</label>
                <input type="date" id="booking_date" name="date" min="<?php echo date('Y-m-d'); ?>">
            </div>
            
            <div class="form-group">
                <label for="booking_time">Preferred Time</label>
                <select id="booking_time" name="time">
                    <option value="">Select time</option>
                    <option value="9:00 AM">9:00 AM</option>
                    <option value="10:00 AM">10:00 AM</option>
                    <option value="11:00 AM">11:00 AM</option>
                    <option value="12:00 PM">12:00 PM</option>
                    <option value="2:00 PM">2:00 PM</option>
                    <option value="3:00 PM">3:00 PM</option>
                    <option value="4:00 PM">4:00 PM</option>
                    <option value="5:00 PM">5:00 PM</option>
                    <option value="6:00 PM">6:00 PM</option>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label for="booking_message">Additional Message</label>
            <textarea id="booking_message" name="message" rows="4" placeholder="Please provide any additional information about your condition or requirements..."></textarea>
        </div>
        
        <div class="form-group">
            <label class="checkbox-label">
                <input type="checkbox" name="consent" required>
                <span class="checkmark"></span>
                I agree to the <a href="<?php echo home_url('/privacy-policy/'); ?>" target="_blank">Privacy Policy</a> and consent to being contacted regarding my appointment.
            </label>
        </div>
        
        <div class="form-actions">
            <button type="submit" name="jedh_booking_submit" class="btn btn-primary btn-lg">
                <i class="fas fa-calendar-check"></i>
                Book Consultation
            </button>
            
            <div class="alternative-contact">
                <p>Or contact us directly:</p>
                <a href="https://wa.me/<?php echo jedh_get_option('whatsapp', '919602227267'); ?>" class="btn btn-whatsapp">
                    <i class="fab fa-whatsapp"></i>
                    WhatsApp
                </a>
                <a href="tel:<?php echo jedh_get_option('phone', '+919602227267'); ?>" class="btn btn-phone">
                    <i class="fas fa-phone"></i>
                    Call Now
                </a>
            </div>
        </div>
    </form>
</div>

<style>
.booking-form-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 2rem;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.booking-form-header {
    text-align: center;
    margin-bottom: 2rem;
}

.booking-form-header h3 {
    color: var(--primary-color);
    margin-bottom: 0.5rem;
}

.booking-success {
    background: #d4edda;
    color: #155724;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 2rem;
    text-align: center;
}

.booking-success i {
    font-size: 2rem;
    color: #28a745;
    margin-bottom: 0.5rem;
}

.booking-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #333;
}

.form-group input,
.form-group select,
.form-group textarea {
    padding: 0.75rem;
    border: 2px solid #e5e5e5;
    border-radius: 8px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: var(--primary-color);
}

.checkbox-label {
    display: flex;
    align-items: flex-start;
    gap: 0.5rem;
    cursor: pointer;
    font-size: 0.9rem;
    line-height: 1.4;
}

.checkbox-label input[type="checkbox"] {
    margin: 0;
    width: auto;
}

.form-actions {
    text-align: center;
    padding-top: 1rem;
    border-top: 1px solid #e5e5e5;
}

.alternative-contact {
    margin-top: 1.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid #e5e5e5;
}

.alternative-contact p {
    margin-bottom: 1rem;
    color: #666;
}

.btn-whatsapp {
    background: #25D366;
    color: white;
    margin: 0 0.5rem;
}

.btn-phone {
    background: var(--primary-color);
    color: white;
    margin: 0 0.5rem;
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .booking-form-container {
        padding: 1rem;
    }
}
</style>
