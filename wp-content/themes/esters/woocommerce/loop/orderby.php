<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="row">
    <div class="col-xs-12 col-sm-4 col-sm-offset-8 col-md-3 col-md-offset-9">
        <form class="woocommerce-ordering" method="get">
            <select name="orderby" class="orderby">
                <?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
                    <option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
                <?php endforeach; ?>
            </select>
            <?php
                // Keep query string vars intact
                foreach ( $_GET as $key => $val ) {
                    if ( 'orderby' === $key || 'submit' === $key ) {
                        continue;
                    }
                    if ( is_array( $val ) ) {
                        foreach( $val as $innerVal ) {
                            echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
                        }
                    } else {
                        echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
                    }
                }
            ?>
        </form>
    </div>
</div>
