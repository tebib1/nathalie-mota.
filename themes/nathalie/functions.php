<?php
function theme_setup() {
    // Enregistrer les emplacements de menus
    register_nav_menus(array(
        'primary' => __('Menu Principal', 'textdomain'), // Emplacement utilisé dans header.php
    ));
}
add_action('after_setup_theme', 'theme_setup');


// Inclure le fichier style principal
function enqueue_theme_styles() {
    wp_enqueue_style('theme-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'enqueue_theme_styles');

// Fonction unique pour inclure les scripts JS
function enqueue_custom_scripts() {
    // Inclure le script modal.js
    wp_enqueue_script(
        'custom-modal-script',
        get_stylesheet_directory_uri() . '/js/modal.js',
        array('jquery'), // Dépend de jQuery
        null,
        true // Charger dans le footer
    );

    // Inclure le script catalogue.js
    
        wp_enqueue_script('catalogue-js', get_template_directory_uri() . '/js/catalogue.js', ['jquery'], null, true);
        wp_localize_script('catalogue-js', 'ajaxurl', admin_url('admin-ajax.php'));
    
    // Inclure le script script.js
    
    wp_enqueue_script('script-js', get_template_directory_uri() . '/js/script.js', ['jquery'], null, true);


    add_action('wp_enqueue_scripts', 'enqueue_catalogue_scripts');
    

}

add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

function theme_add_google_fonts() {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Space+Mono&display=swap', false);
}
add_action('wp_enqueue_scripts', 'theme_add_google_fonts');

function get_photos_with_filters() {
    // Récupérer les paramètres envoyés par AJAX
    $category = sanitize_text_field($_POST['cateegorie']);
    $format = sanitize_text_field($_POST['format']);
    $date_order = sanitize_text_field($_POST['date']);
    $page = intval($_POST['page']) ?: 1;

    // Arguments pour WP_Query
    $args = [
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'paged' => $page,
        'orderby' => 'date',
        'order' => $date_order ?: 'DESC',
        'tax_query' => [],
    ];

    // Filtrer par catégorie
    if (!empty($category)) {
        $args['tax_query'][] = [
            'taxonomy' => 'cateegorie',
            'field' => 'slug',
            'terms' => $category,
        ];
    }

    // Filtrer par format
    if (!empty($format)) {
        $args['tax_query'][] = [
            'taxonomy' => 'format',
            'field' => 'slug',
            'terms' => $format,
        ];
    }

    // Récupérer les photos
    $query = new WP_Query($args);

    // Préparer les résultats
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $image_url = get_the_post_thumbnail_url(get_the_ID());
            $photo_title = get_the_title();
               // Récupérer la catégorie et la référence
               $categories = wp_get_post_terms(get_the_ID(), 'cateegorie', ['fields' => 'names']);
               $category = !empty($categories) ? $categories[0] : 'Catégorie non disponible';
       
               $reference = get_post_meta(get_the_ID(), 'Reference', true) ?: 'Référence non disponible';

               echo '<div class="photo-item">';
               echo '<a href="' . esc_url(get_permalink()) . '">';
               echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($photo_title) . '" ';
               echo 'data-category="' . esc_attr($category) . '" ';
               echo 'data-reference="' . esc_attr($reference) . '">';
               echo '</a>';
               echo '<div class="photo-icons" onclick="openLightbox(\'' . esc_url($image_url) . '\')"></div>';
               echo '<a class="icons" href="' . esc_url(get_permalink()) . '"></a>';
               echo '<div class="photo-overlay">';
               echo '<h2 id="lightbox-title">' . esc_html($photo_title) . '</h2>';
                // Afficher les catégories de la photo
                if (!empty($categories)) {
                    echo '<div class="photo-categories">';
                    foreach ($categories as $category_name) {
                        echo '<p class="category">' . esc_html($category_name) . '</p>';
                    }
                    echo '</div>';
                    echo '</div>';
                }
                
               echo '</div>';
        }
        wp_reset_postdata();
    

  
    }

    wp_die();
}
add_action('wp_ajax_get_photos', 'get_photos_with_filters');
add_action('wp_ajax_nopriv_get_photos', 'get_photos_with_filters');



?>
