<?php
function theme_setup() {
    // Enregistrer les emplacements de menus
    register_nav_menus(array(
        'primary' => __('Menu Principal', 'textdomain'), // Emplacement utilisé dans header.php
    ));
}

//inclure le fichier style
add_action('after_setup_theme', 'theme_setup');
function enqueue_theme_styles() {
    wp_enqueue_style('theme-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'enqueue_theme_styles');

?>
