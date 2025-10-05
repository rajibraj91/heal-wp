<?php
/**
 * Template part for displaying single service post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package heal
 */

 $heal = heal();
 $img_id = get_post_thumbnail_id(get_the_ID());
 $img_url_val = $img_id ? wp_get_attachment_image_src($img_id, 'heal_grid_service_12', false) : '';
 $img_url = is_array($img_url_val) && !empty($img_url_val) ? $img_url_val[0] : '';
 $img_alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);

$service_single_meta_data = get_post_meta(get_the_ID(), 'heal_service_options', true);
$faq_list = isset($service_single_meta_data['service_faqs']) ? $service_single_meta_data['service_faqs'] : [];

 ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('service-details-item'); ?>>
    <div class="gt-service-details-item">
        <?php if ($img_url): ?>
            <div class="gt-service-details-image">
                <?php echo wp_get_attachment_image($img_id, 'heal_grid_service_12', false, ['alt' => esc_attr($img_alt), 'class' => 'img-fluid']); ?>
            </div>
        <?php endif; ?>
        <div class="gt-service-details-content">
            <h5 class="title"><?php the_title();?></h5>

            <?php
                the_content();
            ?>
            <?php if (!empty($faq_list)) : ?>
                <div class="faq-content">
                    <h3><?php esc_html_e('Frequently Asked Questions', 'heal'); ?></h3>
                    <div class="faq-accordion">
                        <div class="accordion" id="faqAccordion-<?php echo esc_attr(get_the_ID()); ?>">
                            <?php foreach ($faq_list as $index => $faq) :
                                $question = $faq['faq_question'] ?? '';
                                $answer   = $faq['faq_answer'] ?? '';
                                $collapse_id = 'faq' . $index . '-' . get_the_ID();
                                $is_first = $index === 0;
                                ?>
                                <div class="accordion-item mb-4 wow fadeInUp" data-wow-delay=".<?php echo esc_attr(($index + 2)); ?>s">
                                    <h5 class="accordion-header">
                                        <button class="accordion-button <?php echo esc_attr(!$is_first ? 'collapsed' : ''); ?>"
                                                type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#<?php echo esc_attr($collapse_id); ?>"
                                                aria-expanded="<?php echo esc_attr( $is_first ? 'true' : 'false' ); ?>"
                                                aria-controls="<?php echo esc_attr($collapse_id); ?>">
                                            <?php echo esc_html($question); ?>
                                        </button>
                                    </h5>
                                    <div id="<?php echo esc_attr($collapse_id); ?>"
                                        class="accordion-collapse collapse <?php echo esc_attr($is_first ? 'show' : ''); ?>"
                                        data-bs-parent="#faqAccordion-<?php echo esc_attr(get_the_ID()); ?>">
                                        <div class="accordion-body">
                                            <?php echo wp_kses_post(wpautop($answer)); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</article>