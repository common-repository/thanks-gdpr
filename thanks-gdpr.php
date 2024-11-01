<?php
/*
Plugin Name: Thanks, GDPR
Description: GDPR is too complicated.
Version:     1.0
Author:      Eric Nagel
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function thanks_gdpr() {
    if (!is_page() && !is_single()) {
        return;
    }

    // via http://www.wipmania.com/en/api/#apitab_wie_a
    $result = wp_remote_get('http://api.wipmania.com/' . urlencode($_SERVER['REMOTE_ADDR']) . '?' . urlencode(get_site_url()));

    $country = $result['body'];

    // via https://www.hipaajournal.com/what-countries-are-affected-by-the-gdpr/
    // and https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2
    if (in_array($country, array(
                                    'AT',
                                    'BE',
                                    'BG',
                                    'HR',
                                    'CY',
                                    'CZ',
                                    'DK',
                                    'EE',
                                    'FI',
                                    'FR',
                                    'DE',
                                    'GR',
                                    'HU',
                                    'IE',
                                    'GB',
                                    'IT',
                                    'LV',
                                    'LT',
                                    'LU',
                                    'MT',
                                    'NL',
                                    'PL',
                                    'PT',
                                    'RO',
                                    'SK',
                                    'SI',
                                    'EA',
                                    'SE',

                                    // Spain
                                    'IC',
                                    'ES',

                                    // United Kingdom
                                    'AC',
                                    'DG',
                                    'TA',
                                    'UK',
                                    'GB',

                                    // 'US'
                                ))) {

        wp_redirect("https://thanksgdpr.com/?utm_source=" . urlencode(get_site_url()), 302 );
        exit();
    }
}
add_action('template_redirect', 'thanks_gdpr', 1);