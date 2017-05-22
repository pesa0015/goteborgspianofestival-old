<?php

session_start();
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
}
function getTranslations() {
    global $wpdb;
    $translations = $wpdb->get_results('SELECT name, ' . $_SESSION['lang'] . ' FROM translations', OBJECT_K);
    $translate = array();
    foreach ($translations as $name => $text) {
        $value = (array) $text;
        $translate[$name] = str_replace(['<p>', '</p>'], '', $value[$_SESSION['lang']]);
    }
    return $translate;
}
require 'page.php';

// add_filter('wp_default_scripts', 'remove_jquery');

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

add_action('wp_ajax_custom_translate', 'custom_translate');

function custom_translate() {
    $table = 'translations';
    $sql = "CREATE TABLE IF NOT EXISTS `$table` (
            `id` int(3) NOT NULL,
              `name` varchar(3000) DEFAULT NULL,
              `description` varchar(3000) DEFAULT NULL,
              `sv` varchar(3000) DEFAULT NULL,
              `en` varchar(3000) DEFAULT NULL,
              `created_at` datetime DEFAULT NULL,
              `updated_at` datetime DEFAULT NULL,
              PRIMARY KEY (id)
            ) ENGINE = InnoDB;";
    global $wpdb;
    $wpdb->query($sql);
    $id = (int) $_POST['id'];
    $translationRowExists = $wpdb->get_results('SELECT id FROM ' . $table . ' WHERE id = ' . $id, OBJECT);
    if ($translationRowExists) {
        $result = $wpdb->update(
            $table,
            array(
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'sv' => $_POST['sv'],
                'en' => $_POST['en'],
                'updated_at' => current_time('mysql')
            ),
            array(
                'id' => $_POST['id']
            )
        );

        if ($result > 0) {
            $response = array('success' => true, 'id' => $id, 'newRow' => false);
            wp_send_json_success($response);
        } else {
            $response = array('error' => $wpdb->last_query);
            wp_send_json_success($response);
        }
    } else {
        $wpdb->insert(
            $table,
            array(
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'sv' => $_POST['sv'],
                'en' => $_POST['en'],
                'created_at' => current_time('mysql'),
                'updated_at' => current_time('mysql')
            )
        );

        $response = array('success' => true, 'id' => $wpdb->insert_id, 'newRow' => true);
        wp_send_json_success($response);
    }
}
