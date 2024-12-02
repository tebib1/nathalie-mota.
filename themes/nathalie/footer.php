<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- #content -->

	<?php get_template_part( 'template-parts/footer/footer-widgets' ); ?>

	<footer class="site-footer">
    <div class="footer">
        <nav class="footer-navigation">
            <ul>
                <li><a href="<?php echo home_url('/mentions-legales'); ?>">Mentions légales</a></li>
                <li><a href="<?php echo home_url('/vie-privee'); ?>">Vie privée</a></li>
                <li><a href="#">Tous droits réservés</a></li>
            </ul>
        </nav>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
