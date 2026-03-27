<?php
/**
 * Shared content page helpers.
 *
 * @package UDSP31
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load shared content page definitions.
 *
 * @return array<string, array<string, mixed>>
 */
function udsp31_get_content_pages() {
	static $pages = null;

	if ( null !== $pages ) {
		return $pages;
	}

	$data_path = get_template_directory() . '/assets/data/content-pages.json';

	if ( ! file_exists( $data_path ) ) {
		$pages = array();
		return $pages;
	}

	$contents = file_get_contents( $data_path ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
	$decoded  = json_decode( (string) $contents, true );

	$pages = is_array( $decoded ) ? $decoded : array();

	return $pages;
}

/**
 * Return one shared content page definition.
 *
 * @param string $slug Page slug.
 * @return array<string, mixed>|null
 */
function udsp31_get_content_page( $slug ) {
	$slug  = trim( (string) $slug );
	$pages = udsp31_get_content_pages();

	if ( '' === $slug || ! isset( $pages[ $slug ] ) || ! is_array( $pages[ $slug ] ) ) {
		return null;
	}

	return $pages[ $slug ];
}

/**
 * Return a page URL with a slug fallback.
 *
 * @param string $slug Page slug.
 * @return string
 */
function udsp31_get_content_page_url( $slug ) {
	$page = get_page_by_path( $slug );

	if ( $page instanceof WP_Post ) {
		return get_permalink( $page );
	}

	return home_url( '/' . trim( (string) $slug, '/' ) . '/' );
}

/**
 * Return a theme image URL with safe encoding.
 *
 * @param string $file_name Image file name.
 * @return string
 */
function udsp31_get_image_url( $file_name ) {
	return trailingslashit( get_template_directory_uri() ) . 'assets/images/' . rawurlencode( (string) $file_name );
}

/**
 * Resolve an internal content page target.
 *
 * @param string $target Link target token.
 * @return string
 */
function udsp31_resolve_content_target( $target ) {
	$target = (string) $target;

	if ( '' === $target ) {
		return home_url( '/' );
	}

	if ( 0 === strpos( $target, 'anchor:' ) ) {
		return '#' . ltrim( substr( $target, 7 ), '#' );
	}

	if ( 0 === strpos( $target, 'page:' ) ) {
		return udsp31_get_content_page_url( substr( $target, 5 ) );
	}

	if ( 'home' === $target ) {
		return home_url( '/' );
	}

	if ( 'discover' === $target ) {
		return udsp31_get_discover_url();
	}

	if ( 'executive' === $target ) {
		return udsp31_get_executive_url();
	}

	return $target;
}

/**
 * Render the summary block for a shared content page.
 *
 * @param array<string, mixed> $summary Summary definition.
 * @return void
 */
function udsp31_render_content_summary( $summary ) {
	if ( ! empty( $summary['photo'] ) ) {
		?>
		<aside class="discover-summary discover-summary--photo" aria-hidden="true">
			<figure class="discover-summary__photo">
				<img src="<?php echo esc_url( udsp31_get_image_url( $summary['photo'] ) ); ?>" alt="" />
			</figure>
		</aside>
		<?php
		return;
	}

	$items = ! empty( $summary['items'] ) && is_array( $summary['items'] ) ? $summary['items'] : array();
	?>
	<aside class="discover-summary">
		<article class="discover-summary__card">
			<?php if ( ! empty( $summary['kicker'] ) ) : ?>
				<span class="section-kicker"><?php echo esc_html( $summary['kicker'] ); ?></span>
			<?php endif; ?>
			<?php if ( ! empty( $summary['title'] ) ) : ?>
				<h3><?php echo esc_html( $summary['title'] ); ?></h3>
			<?php endif; ?>
			<?php if ( ! empty( $summary['text'] ) ) : ?>
				<p><?php echo esc_html( $summary['text'] ); ?></p>
			<?php endif; ?>

			<?php if ( $items ) : ?>
				<ul class="discover-summary__meta">
					<?php foreach ( $items as $item ) : ?>
						<li>
							<strong><?php echo esc_html( $item['label'] ); ?></strong>
							<span><?php echo esc_html( $item['text'] ); ?></span>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</article>
	</aside>
	<?php
}

/**
 * Render a shared content page.
 *
 * @param string $slug Page slug.
 * @return bool
 */
function udsp31_render_content_page( $slug ) {
	$page = udsp31_get_content_page( $slug );

	if ( null === $page ) {
		return false;
	}

	$hero_images   = ! empty( $page['hero']['images'] ) && is_array( $page['hero']['images'] ) ? $page['hero']['images'] : array();
	$story         = ! empty( $page['story'] ) && is_array( $page['story'] ) ? $page['story'] : array();
	$cards_section = ! empty( $page['cards_section'] ) && is_array( $page['cards_section'] ) ? $page['cards_section'] : array();
	$flow_section  = ! empty( $page['flow_section'] ) && is_array( $page['flow_section'] ) ? $page['flow_section'] : array();
	$closing       = ! empty( $page['closing'] ) && is_array( $page['closing'] ) ? $page['closing'] : array();
	$hero_classes  = array(
		'discover-media-card--primary',
		'discover-media-card--secondary',
		'discover-media-card--tertiary',
	);

	get_header();
	?>
	<main id="primary" class="site-main site-main--discover">
		<?php if ( have_posts() ) : ?>
			<?php the_post(); ?>
		<?php endif; ?>

		<section class="page-hero discover-hero">
			<div class="container discover-hero__grid">
				<div class="discover-hero__copy">
					<h1><?php echo esc_html( $page['title'] ); ?></h1>
					<?php if ( ! empty( $page['hero']['lede'] ) ) : ?>
						<p class="discover-hero__lede"><?php echo esc_html( $page['hero']['lede'] ); ?></p>
					<?php endif; ?>

					<div class="discover-hero__actions">
						<?php if ( ! empty( $page['hero']['primary_cta']['label'] ) ) : ?>
							<a class="button button--primary" href="<?php echo esc_url( udsp31_resolve_content_target( $page['hero']['primary_cta']['target'] ) ); ?>">
								<span><?php echo esc_html( $page['hero']['primary_cta']['label'] ); ?></span>
								<span class="button__icon"><?php udsp31_the_icon( 'arrow' ); ?></span>
							</a>
						<?php endif; ?>
						<?php if ( ! empty( $page['hero']['secondary_cta']['label'] ) ) : ?>
							<a class="button button--secondary" href="<?php echo esc_url( udsp31_resolve_content_target( $page['hero']['secondary_cta']['target'] ) ); ?>">
								<span><?php echo esc_html( $page['hero']['secondary_cta']['label'] ); ?></span>
							</a>
						<?php endif; ?>
					</div>
				</div>

				<div class="discover-hero__media" aria-hidden="true">
					<?php foreach ( array_slice( $hero_images, 0, 3 ) as $index => $image_name ) : ?>
						<figure class="discover-media-card <?php echo esc_attr( $hero_classes[ $index ] ); ?>">
							<img src="<?php echo esc_url( udsp31_get_image_url( $image_name ) ); ?>" alt="" />
						</figure>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<?php if ( $story ) : ?>
			<section class="section discover-section discover-section--story">
				<div class="container discover-story">
					<div class="discover-story__copy">
						<?php if ( ! empty( $story['title'] ) ) : ?>
							<h2><?php echo esc_html( $story['title'] ); ?></h2>
						<?php endif; ?>
						<?php if ( ! empty( $story['paragraphs'] ) && is_array( $story['paragraphs'] ) ) : ?>
							<?php foreach ( $story['paragraphs'] as $paragraph ) : ?>
								<p><?php echo esc_html( $paragraph ); ?></p>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>

					<?php if ( ! empty( $story['summary'] ) && is_array( $story['summary'] ) ) : ?>
						<?php udsp31_render_content_summary( $story['summary'] ); ?>
					<?php endif; ?>
				</div>
			</section>
		<?php endif; ?>

		<?php if ( $cards_section ) : ?>
			<section class="section section--quick-links discover-section" id="<?php echo esc_attr( $cards_section['id'] ); ?>">
				<div class="container">
					<div class="section-heading">
						<h2><?php echo esc_html( $cards_section['title'] ); ?></h2>
						<p><?php echo esc_html( $cards_section['intro'] ); ?></p>
					</div>

					<div class="discover-commission-grid">
						<?php foreach ( $cards_section['cards'] as $card ) : ?>
							<article class="discover-commission-card">
								<?php if ( ! empty( $card['icon'] ) ) : ?>
									<span class="info-card__icon"><?php udsp31_the_icon( $card['icon'] ); ?></span>
								<?php endif; ?>
								<h3><?php echo esc_html( $card['title'] ); ?></h3>
								<p><?php echo esc_html( $card['text'] ); ?></p>
							</article>
						<?php endforeach; ?>
					</div>
				</div>
			</section>
		<?php endif; ?>

		<?php if ( $flow_section ) : ?>
			<section class="section section--stats discover-section" id="<?php echo esc_attr( $flow_section['id'] ); ?>">
				<div class="container">
					<div class="section-heading">
						<h2><?php echo esc_html( $flow_section['title'] ); ?></h2>
						<p><?php echo esc_html( $flow_section['intro'] ); ?></p>
					</div>

					<div class="discover-flow">
						<?php foreach ( $flow_section['steps'] as $step ) : ?>
							<article class="discover-flow__card">
								<span class="discover-flow__step"><?php echo esc_html( $step['step'] ); ?></span>
								<h3><?php echo esc_html( $step['title'] ); ?></h3>
								<p><?php echo esc_html( $step['text'] ); ?></p>
							</article>
						<?php endforeach; ?>
					</div>
				</div>
			</section>
		<?php endif; ?>

		<?php if ( $closing ) : ?>
			<section class="section discover-section discover-section--closing">
				<div class="container discover-closing">
					<div class="discover-closing__gallery" aria-hidden="true">
						<?php if ( ! empty( $closing['gallery'] ) && is_array( $closing['gallery'] ) ) : ?>
							<?php foreach ( array_slice( $closing['gallery'], 0, 3 ) as $image_name ) : ?>
								<img src="<?php echo esc_url( udsp31_get_image_url( $image_name ) ); ?>" alt="" />
							<?php endforeach; ?>
						<?php endif; ?>
					</div>

					<div class="discover-closing__copy">
						<?php if ( ! empty( $closing['kicker'] ) ) : ?>
							<span class="section-kicker"><?php echo esc_html( $closing['kicker'] ); ?></span>
						<?php endif; ?>
						<?php if ( ! empty( $closing['title'] ) ) : ?>
							<h2><?php echo esc_html( $closing['title'] ); ?></h2>
						<?php endif; ?>
						<?php if ( ! empty( $closing['paragraphs'] ) && is_array( $closing['paragraphs'] ) ) : ?>
							<?php foreach ( $closing['paragraphs'] as $paragraph ) : ?>
								<p><?php echo esc_html( $paragraph ); ?></p>
							<?php endforeach; ?>
						<?php endif; ?>

						<div class="discover-closing__actions">
							<?php if ( ! empty( $closing['primary_cta']['label'] ) ) : ?>
								<a class="button button--primary" href="<?php echo esc_url( udsp31_resolve_content_target( $closing['primary_cta']['target'] ) ); ?>">
									<span><?php echo esc_html( $closing['primary_cta']['label'] ); ?></span>
									<span class="button__icon"><?php udsp31_the_icon( 'arrow' ); ?></span>
								</a>
							<?php endif; ?>
							<?php if ( ! empty( $closing['secondary_cta']['label'] ) ) : ?>
								<a class="button button--secondary" href="<?php echo esc_url( udsp31_resolve_content_target( $closing['secondary_cta']['target'] ) ); ?>">
									<span><?php echo esc_html( $closing['secondary_cta']['label'] ); ?></span>
								</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</section>
		<?php endif; ?>
	</main>
	<?php
	get_footer();

	return true;
}
