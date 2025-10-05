<?php
add_action('admin_menu', function () {
    add_theme_page(
        esc_html__('Theme Plugins (Category)', 'heal'),
        esc_html__('Theme Plugins', 'heal'),
        'manage_options',
        'heal-theme-plugins',
        'heal_render_theme_plugins_screen'
    );
});

/** Save handler */
add_action('admin_post_heal_save_plugin_category', function () {
    if ( ! current_user_can('manage_options') ) wp_die( esc_html__('Permission denied.', 'heal') );
    check_admin_referer('heal_plugin_category');

    $cat = isset($_POST['heal_cat']) ? sanitize_key($_POST['heal_cat']) : '';
    update_option('heal_current_category', $cat);
    update_option('heal_current_demo', '');

    wp_safe_redirect( admin_url('themes.php?page=heal-theme-plugins&updated=1') );
    exit;
});

/** UI renderer */
function heal_render_theme_plugins_screen() {
    if ( ! current_user_can('manage_options') ) {
        wp_die( esc_html__('Permission denied.', 'heal') );
    }

    if ( ! function_exists('heal_get_category_plugins_map') || ! function_exists('heal_get_plugins_for_category') ) {
        echo '<div class="wrap"><h1>Theme Plugins</h1><p style="color:#c00">Mapping functions not found. Make sure inc/plugins/activation.php is loaded.</p></div>';
        return;
    }

    $cat_map    = heal_get_category_plugins_map();
    $all_cats   = array_keys($cat_map);
    sort($all_cats);

    $saved_cat  = get_option('heal_current_category', (in_array('generic',$all_cats,true) ? 'generic' : ($all_cats[0] ?? '')) );

    $preview_plugins = heal_get_plugins_for_category($saved_cat);

    $tgmpa_url = add_query_arg('heal_cat', $saved_cat, admin_url('themes.php?page=tgmpa-install-plugins'));
    ?>
    <div class="wrap">
        <h1><?php echo esc_html__('Theme Plugins (Category)', 'heal'); ?></h1>

        <?php if ( isset($_GET['updated']) ) : ?>
            <div class="notice notice-success is-dismissible"><p><?php echo esc_html__('Category saved.', 'heal'); ?></p></div>
        <?php endif; ?>

        <form method="post" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">
            <?php wp_nonce_field('heal_plugin_category'); ?>
            <input type="hidden" name="action" value="heal_save_plugin_category">

            <table class="form-table" role="presentation">
                <tbody>
                    <tr>
                        <th scope="row"><?php echo esc_html__('Category', 'heal'); ?></th>
                        <td>
                            <select name="heal_cat">
                                <?php foreach ( $all_cats as $c ) : ?>
                                    <option value="<?php echo esc_attr($c); ?>" <?php selected($saved_cat,$c); ?>>
                                        <?php echo esc_html($c); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <p class="description"><?php echo esc_html__('Pick a category. TGMPA will recommend plugins based on this.', 'heal'); ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p><button class="button button-primary"><?php echo esc_html__('Save Category', 'heal'); ?></button></p>
        </form>

        
    </div>
    <?php
}