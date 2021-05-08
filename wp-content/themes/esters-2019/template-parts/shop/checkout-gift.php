<section id="checkout__gift">
    <header><?= woocommerce_form_field('is_order_gift', [
        'type'          => 'checkbox',
        'label'         => 'Is this a gift?',
        'required'      => false,
    ], 'true'); ?></header>
    <main class="fields">
        <h4>Gift Recipient Info</h4>
        <?php foreach (ThemeLib\Esters\Shop\Shop::getGiftFields() as $name => $def) :
            $fieldname = "recipient_$name"; woocommerce_form_field($fieldname, [
            'type'          => $def[1],
            'class'         => ['my-field-class form-row-wide'],
            'label'         => false,
            'placeholder'   => __($def[0]),
            ], $checkout->get_value($fieldname));
        endforeach; ?>
    </main>
</section>
