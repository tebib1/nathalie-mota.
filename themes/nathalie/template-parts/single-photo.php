<?php
get_header();
?>
<div class="single-photo-container">
    <div class="photo-details">
        <h1><?php the_title(); ?></h1>
        <div class="bordure">
        <p><strong>Référence :</strong> <?php echo esc_html(get_post_meta(get_the_ID(), 'Reference', true)); ?></p>
        <p><strong>Catégorie :</strong> <?php echo get_the_term_list(get_the_ID(), 'cateegorie', '', ', '); ?></p>
        <p><strong>Format :</strong> <?php echo get_the_term_list(get_the_ID(), 'format', '', ', '); ?></p>
        <p><strong>Type :</strong> <?php echo esc_html(get_post_meta(get_the_ID(), 'type', true)); ?></p>
        <p><strong>Année :</strong> <?php echo get_the_date('Y'); ?></p>
        </div>

    </div>
    <div class="photo-display">
        <img class="single_photo" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
    </div>
</div>
<div class="bloc_photo">
<div class="alignement">
		<p>Cette photo vous intéresse ?</p>
        <a class="contact-button idopenModal" href="javascript:void(0);">Contact</a>

        <?php get_template_part('modal-contact'); ?>
    </div>
    <!-- navigation des photos -->
    <div class="photo-navigation">
    <div class="thumbnail">
        <!-- Placeholder pour afficher la miniature -->
        <img src="" alt="Miniature de navigation" id="hover-thumbnail" style="display: none;">
    </div>
    <div class="nav-arrows">
        <div class="align_fleche">
            <?php 
            $previous_post = get_previous_post(); 
            if ($previous_post): 
                $prev_thumbnail = get_the_post_thumbnail_url($previous_post, 'thumbnail'); 
            ?>
                <a href="<?php echo get_permalink($previous_post); ?>" 
                   class="nav-arrow prev" 
                   data-thumbnail="<?php echo esc_url($prev_thumbnail); ?>">
                    <img src="http://nathalie-mota.local/wp-content/uploads/2025/01/Line-6.png" alt="flèche gauche">
                </a>
            <?php endif; ?>

            <?php 
            $next_post = get_next_post(); 
            if ($next_post): 
                $next_thumbnail = get_the_post_thumbnail_url($next_post, 'thumbnail'); 
            ?>
                <a href="<?php echo get_permalink($next_post); ?>" 
                   class="nav-arrow next" 
                   data-thumbnail="<?php echo esc_url($next_thumbnail); ?>">
                    <img src="http://nathalie-mota.local/wp-content/uploads/2025/01/Line-7.png" alt="flèche droite">
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

 </div>
<div class="related-photos">
    <h2>Vous aimerez aussi</h2>
    <div class="related-items">
        <?php
        $related = new WP_Query(array(
            'post_type' => 'photo',
            'posts_per_page' => 2,
        ));
        if ($related->have_posts()) :
            while ($related->have_posts()) : $related->the_post();
        ?>
                <div class="related-item">
                    <a href="<?php the_permalink(); ?>">
                        <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                  
                    </a>
                </div>
        <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
   

</div>

<?php
get_footer();

