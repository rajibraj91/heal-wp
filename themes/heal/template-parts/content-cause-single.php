<?php
/**
 * Template part for displaying single cause post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package heal
 */

$img_id       = get_post_thumbnail_id(get_the_ID());
$img_url_val  = $img_id ? wp_get_attachment_image_src($img_id, 'heal_grid_cause_12', false) : '';
$img_url      = is_array($img_url_val) && !empty($img_url_val) ? $img_url_val[0] : '';
$img_alt      = get_post_meta($img_id, '_wp_attachment_image_alt', true);

// Get CSF Meta Data
$cause_single_meta_data = get_post_meta(get_the_ID(), 'heal_cause_options', true);

$currency_symbol   = $cause_single_meta_data['currency_symbol'] ?? '$';
$donation_goal     = $cause_single_meta_data['donation_goal'] ?? '0';
$donation_manually = $cause_single_meta_data['donation_manually'] ?? '0';
$donation_paypal   = $cause_single_meta_data['donation_paypal'] ?? '';
$donation_bdt      = $cause_single_meta_data['donation_bdt'] ?? '';
$donation_cp       = $cause_single_meta_data['donation_cp'] ?? '';
$donation_link     = $cause_single_meta_data['donation_link'] ?? '';

// Calculate Progress
$goal   = (int) str_replace(',', '', $donation_goal);
$raised = (int) str_replace(',', '', $donation_manually);
$percent = $goal > 0 ? ($raised / $goal) * 100 : 0;
$to_go  = $goal > $raised ? ($goal - $raised) : 0;
?>

<div id="post-<?php the_ID(); ?>" class="cases">
    <div class="cases__item">
        <div class="cases__inner">
            
            <?php if ($img_url): ?>
                <div class="cases__thumb position-relative">
                    <?php echo wp_get_attachment_image($img_id, 'heal_grid_cause_12', false, [
                        'alt'   => esc_attr($img_alt),
                        'class' => 'img-fluid w-100'
                    ]); ?>
                    
                    <div class="event__bars">
                        <div class="event__bars-left">
                            <div class="event__title">
                                <p>
                                    <span><?php echo round($percent); ?>% <?php esc_html_e('Donated', 'heal'); ?></span> 
                                    <?php echo esc_html__('/', 'heal'); ?> 
                                    <?php echo esc_html($currency_symbol); ?><?php echo number_format($to_go); ?> 
                                    <?php esc_html_e('To Go', 'heal'); ?>
                                </p>
                            </div>
                            <div class="donaterange__content">
                                <div class="donaterange__bars" data-percent="<?php echo round($percent); ?>%">
                                    <div class="donaterange__bar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="cases__content">

                <!-- Accordion -->
                <div class="accordion" id="accordionExample">
                    
                    <!-- Paypal -->
                    <div class="accordion-item">
                        <h6 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <?php esc_html_e('Paypal', 'heal'); ?>
                            </button>
                        </h6>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <?php if($donation_paypal): ?>
                                    <form class="donate" action="<?php echo esc_url($donation_paypal); ?>" method="post">
                                        <input type="text" placeholder="<?php echo esc_attr($currency_symbol); ?> " name="donate_amount">
                                        <button type="submit" class="default-btn move-right">
                                            <span><?php esc_html_e('Donate Now', 'heal'); ?></span>
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <p><?php esc_html_e('Paypal option not available.', 'heal'); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Direct Bank Transfer -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <?php esc_html_e('Direct Bank Transfer', 'heal'); ?>
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <?php if($donation_bdt): ?>
                                    <div class="bank-transform">
                                        <?php echo wpautop( wp_kses_post( $donation_bdt ) ); ?>
                                    </div>
                                <?php else: ?>
                                    <p><?php esc_html_e('Bank transfer details not available.', 'heal'); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Check Payment -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <?php esc_html_e('Check Payment', 'heal'); ?>
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <?php if($donation_cp): ?>
                                    <div class="payment">
                                        <?php echo wpautop( wp_kses_post( $donation_cp ) ); ?>
                                    </div>
                                <?php else: ?>
                                    <p><?php esc_html_e('Check payment details not available.', 'heal'); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </div><!-- Accordion End -->

                <!-- Content -->
                <div class="cases__content-content">
                    <h5><?php the_title(); ?></h5>
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
(function($){
    $(window).scroll(function() {
        var hT = $('.donaterange__content').offset().top,
            hH = $('.donaterange__content').outerHeight(),
            wH = $(window).height(),
            wS = $(this).scrollTop();
        if (wS > (hT+hH-1.4*wH)){
            jQuery(document).ready(function(){
                jQuery('.donaterange__bars').each(function(){
                    jQuery(this).find('.donaterange__bar').animate({
                        width:jQuery(this).attr('data-percent')
                    }, 5000); // 5 seconds
                });
            });
        }
    });
})(jQuery);
</script>
