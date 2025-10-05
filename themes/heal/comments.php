<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package heal
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php
    // You can start editing here -- including this comment!
    if (have_comments()) :
        ?>
        <h2 class="comments-title">
            <?php
            $heal_comment_count = get_comments_number();
            if ('1' === $heal_comment_count) {
                printf(
                /* translators: 1: title. */
                    esc_html__('1 Comment', 'heal')

                );
            } else {
                printf( // WPCS: XSS OK.
                /* translators: 1: comment count number, 2: title. */
                    esc_html(_nx('%1$s Comments &ldquo;%2$s&rdquo;', '%1$s Comments ', $heal_comment_count, 'comments title', 'heal')),
                    number_format_i18n($heal_comment_count)
                );
            }
            ?>
        </h2><!-- .comments-title -->

        <div class="blog-comment-navigation">
            <?php the_comments_navigation(); ?>
        </div>
        <div class="clearfix"></div>
            <ul class="comment-list">
                <?php
                wp_list_comments(array(
                    'style' => 'ul',
                    'callback' => 'heal_comment_modification',
                    'short_ping' => true,
                ));
                ?>
            </ul><!-- .comment-list -->
            <div class="blog-comment-navigation">
                <?php the_comments_navigation(); ?>
            </div>
            <?php
            // If comments are closed and there are comments, let's leave a little note, shall we?
            if (!comments_open()) :
                ?>
                <p class="no-comments"><?php esc_html_e('Comments are closed.', 'heal'); ?></p>
            <?php
            endif;

    endif; // Check for have_comments().
    $fields = array(
        'author' => ' <div class="form-group form-clt">
                        <input type="text" id="author" name="author" tabindex="1" value="' . esc_attr($commenter['comment_author']) . '" class="form-control" placeholder="' . esc_attr__('Name', 'heal') . '">
                    </div>',
        'email' => ' <div class="form-group form-clt">
                        <input type="email" class="form-control" name="email" id="email" value="' . esc_attr($commenter['comment_author_email']) . '" tabindex="2" placeholder="' . esc_attr__('Email', 'heal') . '">
                    </div>',
        'URL' => '<div class="form-group form-clt">
                        <input type="text" id="url" name="url" value="' . esc_url($commenter['comment_author_url']) . '" class="form-control" tabindex="3" placeholder="' . esc_attr__('Subject', 'heal') . '">
                    </div>'
    );
    comment_form(array(
        'fields' => apply_filters('comment_form_default_fields', $fields),
        
        'comment_notes_before' => '',
        'comment_notes_after' => '',
        'title_reply' => esc_html__('Leave A Comment', 'heal'),
        'title_reply_to' => esc_html__('Leave A Reply To %s', 'heal'),
        'id_form'              => 'contact-form',
        'id_submit'            => 'submit',
        'class_container'      => 'gt-comment-form-wrap pt-5',
        'class_submit'         => '', // empty because we're using a custom button
        'label_submit'         => '',
        'submit_button'        => '<div class="col-lg-6">
                                        <button type="submit" class="default-btn move-right">
                                            <span class="gt-icon-btn"><i class="icon-icon-1"></i></span>
                                            <span class="gt-text-btn">
                                                <span class="gt-text-2">SEND MESSAGE</span>
                                            </span>
                                        </button>
                                    </div>',
        'label_submit' => esc_html__('Post Comment', 'heal'),
        'comment_field' => '<div class="form-group textarea form-clt">
                                <textarea name="comment" id="comment" class="form-control" placeholder="' . esc_attr__('Comment...', 'heal') . '" cols="30" rows="10"></textarea>
                            </div>'
    ));
    ?>

</div><!-- #comments -->
