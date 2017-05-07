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

function getForm($name)
{
    return do_shortcode('[contact-form-7 title="' . $name . ' (' . $_SESSION['lang'] . ')"]');
}
