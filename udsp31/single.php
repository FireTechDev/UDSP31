<?php
/**
 * Single post template.
 *
 * @package UDSP31
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main site-main--page">
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<section class="page-hero">
			<div class="container">
				<span class="section-kicker"><?php esc_html_e( 'Actualite', 'udsp31' ); ?></span>
				<h1><?php the_title(); ?></h1>
				<p><?php echo esc_html( get_the_date() ); ?></p>
			</div>
		</section>

		<section class="section">
			<div class="container page-content">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="featured-media">
						<?php the_post_thumbnail( 'large' ); ?>
					</div>
				<?php endif; ?>

				<article <?php post_class( 'entry-content' ); ?>>
					<?php the_content(); ?>
				</article>
			</div>
		</section>
	<?php endwhile; ?>
</main>

<?php
get_footer();
