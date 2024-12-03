<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header class="site-header">
        <div class="container">
            <!-- Logo -->
            <div class="logo">
                <a href="<?php echo home_url(); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/Logo.png" alt="Logo">
                </a>
            </div>
            <!-- Navigation -->
            <nav class="main-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary', // Nom de l'emplacement défini dans functions.php
                    'menu_class'     => 'nav-menu', // Classe CSS pour le menu
                    'container'      => false,      // Pas de conteneur supplémentaire
                ));
                ?>
            </nav>
            <!-- Inclure le modal -->
<?php get_template_part('template-parts/modal-contact'); ?>
        </div>
    </header>
    <main>
