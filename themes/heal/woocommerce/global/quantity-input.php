<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 *
 * @var bool   $readonly If the input should be set to readonly mode.
 * @var string $type     The input type attribute.
 */

defined( 'ABSPATH' ) || exit;

/* translators: %s: Quantity. */
$label = ! empty( $args['product_name'] ) ? sprintf( esc_html__( '%s quantity', 'heal' ), wp_strip_all_tags( $args['product_name'] ) ) : esc_html__( 'Quantity', 'heal' );

?>
<div class="actions">
    <div class="quantity">
        <label class="screen-reader-text" for="<?php echo esc_attr( $input_id ); ?>"><?php echo esc_html( $label ); ?></label>

        <div class="qty-wrapper">
            <span class="me-3"><?php esc_html_e( 'Quantity', 'heal' ); ?></span>
            <input
                type="text"
                id="<?php echo esc_attr( $input_id ); ?>"
                class="<?php echo esc_attr( join( ' ', (array) $classes ) ); ?>"
                step="<?php echo esc_attr( $step ); ?>"
                min="<?php echo esc_attr( $min_value ); ?>"
                max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>"
                name="<?php echo esc_attr( $input_name ); ?>"
                value="<?php echo esc_attr( $input_value ); ?>"
                title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'heal' ); ?>"
                size="4"
                placeholder="<?php echo esc_attr( $placeholder ); ?>"
                inputmode="<?php echo esc_attr( $inputmode ); ?>"
                autocomplete="<?php echo esc_attr( isset( $autocomplete ) ? $autocomplete : 'on' ); ?>"
            />
            <?php do_action( 'woocommerce_before_quantity_input_field' ); ?>
            <button type="button" class="quantity-plus qty-btn" onclick="updateQuantity('<?php echo esc_attr( $input_id ); ?>', 'increase')">
                <i class="fa-solid fa-plus"></i>
            </button>
            <?php do_action( 'woocommerce_after_quantity_input_field' ); ?>
            <button type="button" class="quantity-minus qty-btn" onclick="updateQuantity('<?php echo esc_attr( $input_id ); ?>', 'decrease')">
                <i class="fa-solid fa-minus"></i>
            </button>
        </div>
    </div>
</div>
<script type="text/javascript">
    function updateQuantity(inputId, action) {
        var inputField = document.getElementById(inputId);
        if (!inputField) return;

        var currentValue = parseInt(inputField.value) || 0;
        var minValue = inputField.min ? parseInt(inputField.min) : 1;
        var maxValue = inputField.max ? parseInt(inputField.max) : Infinity;

        if (action === 'increase' && currentValue < maxValue) {
            inputField.value = currentValue + 1;
        } else if (action === 'decrease' && currentValue > minValue) {
            inputField.value = currentValue - 1;
        }
    }
</script>
