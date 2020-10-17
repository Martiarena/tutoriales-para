<?php
/**
 * Product quantity inputs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="form-inline">
    <div class="form-group quantity buttons_added">
        <div class="input-group">
            <span type="button" value="-" class="add-action qty-minus input-group-addon">-</span>
				<input type="number" 
					step="<?php echo esc_attr( $step ); ?>"
					min="<?php echo esc_attr( $min_value ); ?>"
					max="<?php echo esc_attr( $max_value ); ?>"
                   name="<?php echo esc_attr( $input_name ); ?>" 
				   value="<?php echo esc_attr( $input_value ); ?>"
                   title="<?php esc_attr_x( 'Qty', 'Product quantity input tooltip', 'woocommerce' ) ?>" 
				   class="input-text qty text form-control" 
				   size="4" 
					pattern="<?php echo esc_attr( $pattern ); ?>" 
					inputmode="<?php echo esc_attr( $inputmode ); ?>" 
				/>
            <span type="button " value="+" class="add-action input-group-addon qty-plus">+</span>
        </div>
    </div>
</div>