<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Nathalie
 * @since Nathalie 1.0
 */

get_header();

if ( have_posts() ) : // Vérifie s'il y a des articles à afficher
    while ( have_posts() ) : // Boucle sur les articles
        the_post();

        // Inclut le fichier de template pour afficher le contenu d'un post.
        get_template_part( 'template-parts/single-photo' );

        // Navigation pour les pièces jointes.
        if ( is_attachment() ) {
            the_post_navigation(
                array(
                    'prev_text' => sprintf( __( '<span class="meta-nav">Published in</span><span class="post-title">%s</span>', 'nathalie' ), '%title' ),
                )
            );
        }

        // Si les commentaires sont activés ou qu'il y a au moins un commentaire, affiche le template de commentaires.
        if ( comments_open() || get_comments_number() ) {
            comments_template();
        }

        // Navigation entre les articles.
        $nathalie_next = is_rtl() ? nathalie_get_icon_svg( 'ui', 'arrow_left' ) : nathalie_get_icon_svg( 'ui', 'arrow_right' );
        $nathalie_prev = is_rtl() ? nathalie_get_icon_svg( 'ui', 'arrow_right' ) : nathalie_get_icon_svg( 'ui', 'arrow_left' );

        $nathalie_next_label     = esc_html__( 'Next post', 'nathalie' );
        $nathalie_previous_label = esc_html__( 'Previous post', 'nathalie' );

        the_post_navigation(
            array(
                'next_text' => '<p class="meta-nav">' . $nathalie_next_label . $nathalie_next . '</p><p class="post-title">%title</p>',
                'prev_text' => '<p class="meta-nav">' . $nathalie_prev . $nathalie_previous_label . '</p><p class="post-title">%title</p>',
            )
        );
    endwhile; // Fin de la boucle.
else :
    // Affiche un message si aucun post n'est trouvé.
    echo '<p>' . esc_html__( 'Sorry, no posts were found.', 'nathalie' ) . '</p>';
endif;

get_footer();
