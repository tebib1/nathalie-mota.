<?php
get_header();

// Boucle WordPress

	if (has_post_thumbnail()) {
		the_post_thumbnail('large'); // Taille de l'image
	};
	
        ?>
        <h1><?php the_title(); ?></h1>
        <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
        <p><strong>Catégorie :</strong> <?php echo get_the_term_list(get_the_ID(), 'catégorie', '', ', '); ?></p>
        <p><strong>Format :</strong> <?php echo get_the_term_list(get_the_ID(), 'format', '', ', '); ?></p>
        <p><strong>Type :</strong> <?php echo esc_html(get_post_meta(get_the_ID(), 'type', true)); ?></p>
        <p><strong>Référence :</strong> <?php echo esc_html(get_post_meta(get_the_ID(), 'reference', true)); ?></p>
        <?php
  


get_footer();
?>


