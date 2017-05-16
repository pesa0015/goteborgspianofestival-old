<?php

session_start();
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
}
if ($_SESSION['lang'] == 'sv' || $_SESSION['lang'] == 'en') {
    require 'lang/' . $_SESSION['lang'] . '.php';
}
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

add_action('admin_bar_menu', 'linked_url', 80);
function linked_url($wp_admin_bar) {
    $args = array(
        'id' => 'translate',
        'title' => 'Översätt',
        'href' => get_admin_url() . 'options-general.php?page=translate'
    );
    $wp_admin_bar->add_menu($args);
}

/** Step 2 (from text above). */
add_action('admin_menu', 'my_plugin_menu');

/** Step 1. */
function my_plugin_menu() {
    add_options_page('My Plugin Options', 'My Plugin', 'manage_options', 'translate', 'my_plugin_options');
}

/** Step 3. */
function my_plugin_options() {
    if (!current_user_can('manage_options'))  {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    global $wpdb;
    $translations = $wpdb->get_results('SELECT * FROM translations;', OBJECT);
    require 'lang/translate.php';
}
