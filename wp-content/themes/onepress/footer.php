<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package OnePress
 */

$hide_footer = false;
$page_id     = get_the_ID();

if ( is_page() ) {
	$hide_footer = get_post_meta( $page_id, '_hide_footer', true );
}

if ( onepress_is_wc_active() ) {
	if ( is_shop() ) {
		$page_id     = wc_get_page_id( 'shop' );
		$hide_footer = get_post_meta( $page_id, '_hide_footer', true );
	}
}

if ( ! $hide_footer ) {
	?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php
		/**
		 * @since 2.0.0
		 * @see onepress_footer_widgets
		 * @see onepress_footer_connect
		 */
		do_action( 'onepress_before_site_info' );
		$onepress_btt_disable = sanitize_text_field( get_theme_mod( 'onepress_btt_disable' ) );

		?>

		<div class="site-info">
			<div class="container">
				<?php if ( $onepress_btt_disable != '1' ) : ?>
					<div class="btt">
						<a class="back-to-top" href="#page" title="<?php echo esc_attr__( 'Back To Top', 'onepress' ); ?>"><i class="fa fa-angle-double-up wow flash" data-wow-duration="2s"></i></a>
					</div>
				<?php endif; ?>
				<?php
				/**
				 * hooked onepress_footer_site_info
				 *
				 * @see onepress_footer_site_info
				 */
				//do_action( 'onepress_footer_site_info' );
				?>
				Copyright © 2022 Yayasan Dana Paramita Majapahit
				<span class="sep"> – </span>Develop
				<a href="https://omegasoft.co.id/">by Omegasoft</a>
			</div>
		</div>
		<!-- .site-info -->

	</footer><!-- #colophon -->
	<?php
}
/**
 * Hooked: onepress_site_footer
 *
 * @see onepress_site_footer
 */
do_action( 'onepress_site_end' );
?>
</div><!-- #page -->

<?php do_action( 'onepress_after_site_end' ); ?>

<?php wp_footer(); ?>

<a href="https://wa.me/628113525900" class="tp-whatsapp fa fa-whatsapp"></a>
<style>
  a.tp-whatsapp {
	padding: 20px;
    background-color: #23A455;
    border-radius: 100%;
    color: white;
    font-size: 30px;
    position: fixed;
    right: 10px;
    bottom: 10px;
    z-index: 9999;
	text-decoration: none;
}
	a.tp-whatsapp:hover {
    color: grey;
}
  a.tp-whatsapp img {
    max-width: 150px;
}
</style>


</body>
</html>
