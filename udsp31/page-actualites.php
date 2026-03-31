<?php
/**
 * Posts listing page for the "Actualites" slug.
 *
 * @package UDSP31
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$paged = max( 1, (int) get_query_var( 'paged' ), (int) get_query_var( 'page' ) );
$query = new WP_Query(
	array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'paged'               => $paged,
		'posts_per_page'      => (int) get_option( 'posts_per_page', 10 ),
		'ignore_sticky_posts' => false,
	)
);
?>

<main id="primary" class="site-main site-main--page">
	<section class="page-hero">
		<div class="container">
			<span class="section-kicker"><?php esc_html_e( 'Actualites', 'udsp31' ); ?></span>
			<h1><?php esc_html_e( 'Actualites', 'udsp31' ); ?></h1>
			<p><?php esc_html_e( "Retrouvez les derniers articles et informations de l'association.", 'udsp31' ); ?></p>
		</div>
	</section>

	<section class="section">
		<div class="container posts-grid">
			<?php if ( $query->have_posts() ) : ?>
				<?php while ( $query->have_posts() ) : ?>
					<?php
					$query->the_post();
					$categories = get_the_category();
					$category   = ! empty( $categories ) ? $categories[0]->name : __( 'Actualite', 'udsp31' );
					$image_url  = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'large' ) : udsp31_asset_url( 'assets/images/hero.jpg' );
					?>
					<article <?php post_class( 'news-card' ); ?>>
						<a class="news-card__image" href="<?php the_permalink(); ?>">
							<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" />
							<span class="news-card__badge"><?php echo esc_html( $category ); ?></span>
						</a>
						<div class="news-card__content">
							<span class="news-card__meta">
								<span class="icon-wrap"><?php udsp31_the_icon( 'calendar' ); ?></span>
								<span><?php echo esc_html( get_the_date() ); ?></span>
							</span>
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<p><?php echo esc_html( wp_trim_words( get_the_excerpt() ? get_the_excerpt() : wp_strip_all_tags( get_the_content() ), 24 ) ); ?></p>
							<a class="news-card__link" href="<?php the_permalink(); ?>">
								<?php esc_html_e( 'Lire la suite', 'udsp31' ); ?>
								<span class="button__icon"><?php udsp31_the_icon( 'arrow' ); ?></span>
							</a>
						</div>
					</article>
				<?php endwhile; ?>

				<div class="pagination-wrap">
					<?php
					echo wp_kses_post(
						paginate_links(
							array(
								'total'   => (int) $query->max_num_pages,
								'current' => $paged,
							)
						)
					);
					?>
				</div>
			<?php else : ?>
				<div class="empty-state">
					<h2><?php esc_html_e( 'Aucun article pour le moment', 'udsp31' ); ?></h2>
					<p><?php esc_html_e( 'Ajoutez un premier article depuis WordPress pour alimenter cette section.', 'udsp31' ); ?></p>
				</div>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	</section>
</main>

<?php
get_footer();
