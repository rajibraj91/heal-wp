<?php
/**
 * Theme Excerpt Class
 * @package heal
 * @since 1.0.0
 */

if (!defined('ABSPATH')){
	exit(); //exit if access it directly
}

if (!class_exists('heal_core_excerpt')):
class heal_core_excerpt {

    public static $length = 55;

    public static $types = array(
      'short' => 25,
      'regular' => 55,
      'long' => 100,
      'promo'=>15
    );

    public static $more = true;

    /**
     * Sets the length for the excerpt
     * @package heal
     */ 
    public static function length($new_length = 55, $more = true) {
        heal_core_excerpt::$length = $new_length;
        heal_core_excerpt::$more = $more;

        add_filter( 'excerpt_more', 'heal_core_excerpt::auto_excerpt_more' );

        add_filter('excerpt_length', 'heal_core_excerpt::new_length');

        heal_core_excerpt::output();
    }

    public static function new_length() {
        if( isset(heal_core_excerpt::$types[heal_core_excerpt::$length]) )
            return heal_core_excerpt::$types[heal_core_excerpt::$length];
        else
            return heal_core_excerpt::$length;
    }

    public static function output() {
        the_excerpt();
    }

    public static function continue_reading_link() {

        return '<span class="readmore"><a href="'.get_permalink().'">'.esc_html__('Read More','heal-core').'</a></span>';
    }

    public static function auto_excerpt_more( ) {
        if (heal_core_excerpt::$more) :
            return ' ';
        else :
            return ' ';
        endif;
    }

} //end class
endif;

if (!function_exists('heal_core_excerpt')){

	function heal_core_excerpt($length = 55, $more=true) {
		heal_core_excerpt::length($length, $more);
	}

}


?>