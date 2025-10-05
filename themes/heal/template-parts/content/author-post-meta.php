<?php
/**
 * Post Meta Functions
 * @package heal
 * @since 1.0.0
 */

$heal = heal();

// get Codestar option values
$posted_icon   = cs_get_option('blog_post_posted_icon');
$posted_by   = cs_get_option('blog_post_posted_by');
$posted_date = cs_get_option('blog_post_posted_date');
$posted_comment = cs_get_option('blog_post_posted_comment');

// function get_format_icon_class() {
//     $format = get_post_format();

//     switch ($format) {
//         case 'image':
//             return 'fas fa-image';
//         case 'video':
//             return 'fas fa-video';
//         case 'gallery':
//             return 'fas fa-images';
//         case 'quote':
//             return 'fas fa-quote-right';
//         case 'audio':
//             return 'fas fa-music';
//         case 'link':
//             return 'fas fa-link';
//         default:
//             return 'fas fa-file-alt';
//     }
// }
if ( ! function_exists( 'get_format_icon_class' ) ) {
    function get_format_icon_class() {
        $format = get_post_format();

        switch ( $format ) {
            case 'image':
                return 'fas fa-image';
            case 'video':
                return 'fas fa-video';
            case 'gallery':
                return 'fas fa-images';
            case 'quote':
                return 'fas fa-quote-right';
            case 'audio':
                return 'fas fa-music';
            case 'link':
                return 'fas fa-link';
            default:
                return 'fas fa-file-alt';
        }
    }
}

?>

<div class="blog__meta">
    <?php if( isset($posted_icon) && $posted_icon ) : ?>
        <div class="blog__icon">
            <i class="<?php echo esc_attr( get_format_icon_class() ); ?>"></i>
        </div>
    <?php endif; ?>

    <ul>
        <?php if( isset($posted_date) && $posted_date ) : ?>
            <li><?php echo esc_html( get_the_date( 'M d, y' ) ); ?></li>
        <?php endif; ?>

        <?php if( isset($posted_by) && $posted_by ) : ?>
            <li><?php echo esc_html( get_the_author() ); ?></li>
        <?php endif; ?>

        <?php if( isset($posted_comment) && $posted_comment ) : ?>
            <li>
                <?php 
                    $comments_number = get_comments_number();
                    if (comments_open()) {
                        echo esc_html($comments_number) . ' ' . _n('Comment', 'Comments', $comments_number, 'heal');
                    } else {
                        esc_html_e('Comments are closed', 'heal');
                    }
                ?>
            </li>
        <?php endif; ?>
    </ul>
</div>
