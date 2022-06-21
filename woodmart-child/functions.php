<?php
/**
 * Enqueue script and styles for child theme
 */
function woodmart_child_enqueue_styles() {
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'woodmart-style' ), woodmart_get_theme_info( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'woodmart_child_enqueue_styles', 10010 );


// WooCommerce checkout page
add_action('woocommerce_review_order_before_submit','quadlayers_checkout_content');
function quadlayers_checkout_content(){
echo '<img src="/wp-content/themes/woodmart-child/banks.webp" />';
}

add_filter( 'woocommerce_default_address_fields' , 'custom_override_default_address_fields' );
function custom_override_default_address_fields($address_fields) {

    $address_fields['postcode']['required'] = false;

return $address_fields;
}
add_filter( 'woocommerce_billing_fields', 'adjust_requirement_of_checkout_contact_fields');
function adjust_requirement_of_checkout_contact_fields( $fields ) {
    $fields['billing_email']['required']    = false;
    $fields['billing_phone']['required']    = true;

    return $fields;
}

add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
function custom_override_checkout_fields( $fields ) {
 unset($fields['billing']['billing_company']);
 unset($fields['billing']['billing_address_2']);
 return $fields;
}

add_filter( 'woocommerce_default_address_fields', 'custom_override_default_locale_fields' );
function custom_override_default_locale_fields( $fields ) {
    $fields['first_name']['priority'] = 1;
    $fields['last_name']['priority'] = 2;
    $fields['state']['priority'] = 3;
    $fields['city']['priority'] = 4;
    $fields['address_1']['priority'] = 5;
    $fields['postcode']['priority'] = 6;
    $fields['phone']['priority'] = 7;
    $fields['email']['priority'] = 8;
    return $fields;
}


// Auth Cookie Expiration Time
add_filter( 'auth_cookie_expiration', 'stay_logged_in_for_1_year' );
function stay_logged_in_for_1_year( $expire ) {
  return 31556926;
}

// Description Title
// add_filter( 'woocommerce_product_tabs', 'woo_rename_tab', 98);
// function woo_rename_tab($tabs) {
// $tabs['description']['title'] = 'نقد و بررسی';
// return $tabs;
// }

// // Related products Title
// add_filter('gettext', 'change_rp_text', 10, 3);
// add_filter('ngettext', 'change_rp_text', 10, 3);

// function change_rp_text($translated, $text, $domain)
// {
//      if ($text === 'Related products' && $domain === 'woocommerce') {
//          $translated = esc_html__('مشابه', $domain);
//      }
//      return $translated;
// }