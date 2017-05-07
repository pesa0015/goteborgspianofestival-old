<?php

require 'page.php';

add_filter('wp_default_scripts', 'remove_jquery');

function remove_jquery(&$scripts)
{
    if (!is_admin())
    {
        $scripts->remove('jquery');
    }
}

function year() {
    return get_field('year', PAGE_DATES);
}

function begins() {
    return get_field('begins', PAGE_DATES);
}

function ends() {
    return get_field('ends', PAGE_DATES);
}

function home() {
    return get_bloginfo('home');
}

function getForm($name)
{
    return do_shortcode('[contact-form-7 title="' . $name . ' (' . $_SESSION['lang'] . ')"]');
}
