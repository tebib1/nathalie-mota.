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


function enqueue_custom_scripts() {
    wp_enqueue_script('custom-modal-script', get_stylesheet_directory_uri() . '/js/modal.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');
   
function nathalie_get_icon_svg( $type, $direction ) {
    $icons = array(
        'ui' => array(
            'arrow_left' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M15.41 7.41L10.83 12l4.58 4.59L14 18l-6-6 6-6z"/></svg>',
            'arrow_right' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6z"/></svg>',
        ),
    );

    return $icons[ $type ][ $direction ] ?? '';
}


?>


