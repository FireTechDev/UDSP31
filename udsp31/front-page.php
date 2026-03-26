<?php
/**
 * Front page template.
 *
 * @package UDSP31
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$missions = array(
	array(
		'icon'  => 'users',
		'title' => __( 'Soutien aux pompiers', 'udsp31' ),
		'text'  => __( 'Accompagnement et defense des interets des sapeurs-pompiers.', 'udsp31' ),
	),
	array(
		'icon'  => 'graduation',
		'title' => __( 'Formation & prevention', 'udsp31' ),
		'text'  => __( 'Sensibilisation du public et formation aux gestes qui sauvent.', 'udsp31' ),
	),
	array(
		'icon'  => 'graduation',
		'title' => __( 'Jeunes Sapeurs-Pompiers', 'udsp31' ),
		'text'  => __( "Nous formons les JSP a l'engagement, a l'esprit d'equipe et aux gestes de premiers secours.", 'udsp31' ),
	),
	array(
		'icon'  => 'document',
		'title' => __( 'Dispositifs previsionnels de secours', 'udsp31' ),
		'text'  => __( "Nous organisons des DPS adaptes a vos evenements pour assurer la prevention, la securite du public et la coordination des secours.", 'udsp31' ),
	),
);

$stats = array(
	array(
		'value' => 3048,
		'suffix'=> '',
		'label' => __( 'Sapeurs-pompiers', 'udsp31' ),
		'text'  => __( 'professionnels et volontaires', 'udsp31' ),
	),
	array(
		'value' => 60,
		'suffix'=> '',
		'label' => __( 'Jeunes SP', 'udsp31' ),
		'text'  => __( 'en formation JSP', 'udsp31' ),
	),
	array(
		'value' => 500,
		'suffix'=> '',
		'label' => __( 'asp', 'udsp31' ),
		'text'  => __( 'Anciens sapeurs pompiers', 'udsp31' ),
	),
	array(
		'value' => 8000,
		'suffix'=> '',
		'label' => __( 'personnes formees', 'udsp31' ),
		'text'  => __( 'aux premiers secours', 'udsp31' ),
	),
);

$quick_links = array(
	array(
		'icon'  => 'document',
		'label' => __( 'Demander un devis DPS', 'udsp31' ),
		'url'   => udsp31_section_url( 'site-footer-contact' ),
	),
	array(
		'icon'  => 'graduation',
		'label' => __( "S'inscrire a une formation", 'udsp31' ),
		'url'   => udsp31_section_url( 'missions' ),
	),
	array(
		'icon'  => 'users',
		'label' => __( 'Rejoindre les JSP', 'udsp31' ),
		'url'   => udsp31_section_url( 'engagement' ),
	),
	array(
		'icon'  => 'phone',
		'label' => __( 'Nous contacter', 'udsp31' ),
		'url'   => udsp31_section_url( 'site-footer-contact' ),
	),
);

$values = array(
	array(
		'icon'  => 'handshake',
		'title' => __( 'Solidarite', 'udsp31' ),
		'text'  => __( 'Soutien aux sapeurs-pompiers et a leurs familles.', 'udsp31' ),
	),
	array(
		'icon'  => 'shield',
		'title' => __( 'Excellence', 'udsp31' ),
		'text'  => __( 'Formation de qualite et innovation constante.', 'udsp31' ),
	),
	array(
		'icon'  => 'heart',
		'title' => __( 'Humanite', 'udsp31' ),
		'text'  => __( "Au coeur de nos actions, l'humain avant tout.", 'udsp31' ),
	),
);

$partners = array(
	'SDIS 31',
	__( 'Prefecture de Haute-Garonne', 'udsp31' ),
	__( 'Conseil Departemental 31', 'udsp31' ),
	__( 'Toulouse Metropole', 'udsp31' ),
	'FNSPF',
);

$hero_slides = array(
	array(
		'image' => udsp31_asset_url( 'assets/images/pompiers2.png' ),
		'label' => __( 'Sapeurs-pompiers en intervention', 'udsp31' ),
	),
	array(
		'image' => udsp31_asset_url( 'assets/images/JSP.png' ),
		'label' => __( 'Jeunes sapeurs-pompiers en exercice', 'udsp31' ),
	),
	array(
		'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/' . rawurlencode( 'secourisme 2.png' ),
		'label' => __( 'Formation aux gestes de premiers secours', 'udsp31' ),
	),
);

$hero_badge           = get_theme_mod( 'udsp31_hero_badge', __( 'Union Departementale des Sapeurs-Pompiers de la Haute-Garonne', 'udsp31' ) );
$hero_title           = get_theme_mod( 'udsp31_hero_title', __( 'Federer, soutenir et representer', 'udsp31' ) );
$hero_text            = get_theme_mod( 'udsp31_hero_text', __( "L'UDSP 31 accompagne les sapeurs-pompiers et propose des services de formation, prevention et securite pour le grand public, les entreprises et les collectivites.", 'udsp31' ) );
$hero_primary_label   = get_theme_mod( 'udsp31_hero_primary_label', __( 'Demander une formation', 'udsp31' ) );
$hero_primary_url     = get_theme_mod( 'udsp31_hero_primary_url', udsp31_section_url( 'acces-rapides' ) );
$hero_secondary_label = get_theme_mod( 'udsp31_hero_secondary_label', __( 'Demander un DPS', 'udsp31' ) );
$hero_secondary_url   = get_theme_mod( 'udsp31_hero_secondary_url', udsp31_section_url( 'acces-rapides' ) );
$hero_tertiary_label  = get_theme_mod( 'udsp31_hero_tertiary_label', __( "S'informer sur les JSP", 'udsp31' ) );
$hero_tertiary_url    = get_theme_mod( 'udsp31_hero_tertiary_url', udsp31_section_url( 'engagement' ) );
$posts_page_id        = (int) get_option( 'page_for_posts' );
$news_archive_url     = $posts_page_id ? get_permalink( $posts_page_id ) : home_url( '/blog/' );

$news_query = new WP_Query(
	array(
		'post_type'           => 'post',
		'posts_per_page'      => 3,
		'post_status'         => 'publish',
		'ignore_sticky_posts' => true,
	)
);

$fallback_news = array(
	array(
		'category' => __( 'Formation', 'udsp31' ),
		'date'     => __( '15 Mars 2026', 'udsp31' ),
		'title'    => __( 'Nouvelle session de formation secourisme en avril', 'udsp31' ),
		'text'     => __( 'Inscrivez-vous des maintenant a notre prochaine session PSC1 destinee au grand public et aux entreprises.', 'udsp31' ),
		'image'    => udsp31_asset_url( 'assets/images/news-1.jpg' ),
	),
	array(
		'category' => __( 'Evenement', 'udsp31' ),
		'date'     => __( '12 Mars 2026', 'udsp31' ),
		'title'    => __( 'Assemblee generale 2026 : un succes collectif', 'udsp31' ),
		'text'     => __( "Retour sur l'assemblee generale annuelle qui a reuni plus de 200 participants autour des enjeux de demain.", 'udsp31' ),
		'image'    => udsp31_asset_url( 'assets/images/news-3.jpg' ),
	),
	array(
		'category' => 'JSP',
		'date'     => __( '8 Mars 2026', 'udsp31' ),
		'title'    => __( 'Recrutement JSP : portes ouvertes le 30 mars', 'udsp31' ),
		'text'     => __( 'Venez decouvrir les sections de Jeunes Sapeurs-Pompiers lors de notre journee portes ouvertes.', 'udsp31' ),
		'image'    => udsp31_asset_url( 'assets/images/news-4.jpg' ),
	),
);
?>

<main id="primary" class="site-main">
	<section class="home-hero" data-hero-carousel data-hero-interval="6500">
		<div class="home-hero__media" aria-hidden="true">
			<?php foreach ( $hero_slides as $index => $slide ) : ?>
				<div
					class="home-hero__slide<?php echo 0 === $index ? ' is-active' : ''; ?>"
					data-hero-slide
					data-hero-label="<?php echo esc_attr( $slide['label'] ); ?>"
					style="background-image: url('<?php echo esc_url( $slide['image'] ); ?>');"
				></div>
			<?php endforeach; ?>
			<div class="home-hero__overlay"></div>
		</div>

		<?php if ( count( $hero_slides ) > 1 ) : ?>
			<div class="home-hero__nav-wrap">
				<button class="home-hero__nav home-hero__nav--prev" type="button" data-hero-prev aria-label="<?php esc_attr_e( 'Visuel precedent', 'udsp31' ); ?>">
					<span class="home-hero__nav-icon" aria-hidden="true"></span>
				</button>
				<button class="home-hero__nav home-hero__nav--next" type="button" data-hero-next aria-label="<?php esc_attr_e( 'Visuel suivant', 'udsp31' ); ?>">
					<span class="home-hero__nav-icon" aria-hidden="true"></span>
				</button>
			</div>
		<?php endif; ?>

		<div class="container home-hero__inner">
			<span class="section-kicker"><?php echo esc_html( $hero_badge ); ?></span>
			<h1><?php echo esc_html( $hero_title ); ?></h1>
			<p class="home-hero__text"><?php echo esc_html( $hero_text ); ?></p>

			<div class="hero-actions">
				<a class="button button--primary" href="<?php echo esc_url( $hero_primary_url ); ?>">
					<span class="button__icon"><?php udsp31_the_icon( 'heart' ); ?></span>
					<span><?php echo esc_html( $hero_primary_label ); ?></span>
				</a>
				<a class="button button--secondary" href="<?php echo esc_url( $hero_secondary_url ); ?>">
					<span class="button__icon"><?php udsp31_the_icon( 'document' ); ?></span>
					<span><?php echo esc_html( $hero_secondary_label ); ?></span>
				</a>
				<a class="button button--secondary" href="<?php echo esc_url( $hero_tertiary_url ); ?>">
					<span class="button__icon"><?php udsp31_the_icon( 'users' ); ?></span>
					<span><?php echo esc_html( $hero_tertiary_label ); ?></span>
				</a>
			</div>

			<?php if ( count( $hero_slides ) > 1 ) : ?>
				<div class="home-hero__dots" aria-label="<?php esc_attr_e( 'Visuels du hero', 'udsp31' ); ?>">
					<?php foreach ( $hero_slides as $index => $slide ) : ?>
						<button
							class="home-hero__dot<?php echo 0 === $index ? ' is-active' : ''; ?>"
							type="button"
							data-hero-dot="<?php echo esc_attr( (string) $index ); ?>"
							aria-label="<?php echo esc_attr( $slide['label'] ); ?>"
							aria-pressed="<?php echo 0 === $index ? 'true' : 'false'; ?>"
						></button>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<section class="section section--missions" id="missions">
		<div class="container">
			<div class="section-heading">
				<h2><?php esc_html_e( 'Nos missions', 'udsp31' ); ?></h2>
				<p><?php esc_html_e( "L'UDSP 31 agit au quotidien pour soutenir les sapeurs-pompiers et servir la population.", 'udsp31' ); ?></p>
			</div>

			<div class="mission-grid">
				<?php foreach ( $missions as $mission ) : ?>
					<article class="info-card">
						<span class="info-card__icon"><?php udsp31_the_icon( $mission['icon'] ); ?></span>
						<h3><?php echo esc_html( $mission['title'] ); ?></h3>
						<p><?php echo esc_html( $mission['text'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="section section--stats" id="chiffres">
		<div class="container">
			<div class="section-heading">
				<h2><?php esc_html_e( "L'UDSP 31 en chiffres", 'udsp31' ); ?></h2>
			</div>

			<div class="stats-grid">
				<?php foreach ( $stats as $stat ) : ?>
					<article class="stat-card">
						<strong class="stat-card__value" data-counter="<?php echo esc_attr( (string) $stat['value'] ); ?>" data-suffix="<?php echo esc_attr( $stat['suffix'] ); ?>">
							<?php echo esc_html( number_format_i18n( $stat['value'] ) . $stat['suffix'] ); ?>
						</strong>
						<span class="stat-card__label"><?php echo esc_html( $stat['label'] ); ?></span>
						<span class="stat-card__text"><?php echo esc_html( $stat['text'] ); ?></span>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="section section--news" id="actualites">
		<div class="container">
			<div class="section-heading section-heading--split">
				<div>
					<h2><?php esc_html_e( 'Actualites', 'udsp31' ); ?></h2>
					<p><?php esc_html_e( 'Suivez nos dernieres nouvelles.', 'udsp31' ); ?></p>
				</div>

				<a class="button button--ghost" href="<?php echo esc_url( $news_archive_url ); ?>">
					<span><?php esc_html_e( 'Voir toutes les actualites', 'udsp31' ); ?></span>
					<span class="button__icon"><?php udsp31_the_icon( 'arrow' ); ?></span>
				</a>
			</div>

			<div class="news-grid">
				<?php if ( $news_query->have_posts() ) : ?>
					<?php
					while ( $news_query->have_posts() ) :
						$news_query->the_post();
						$categories = get_the_category();
						$category   = ! empty( $categories ) ? $categories[0]->name : __( 'Actualite', 'udsp31' );
						$image_url  = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'large' ) : udsp31_asset_url( 'assets/images/news-2.jpg' );
						$excerpt    = get_the_excerpt();

						if ( ! $excerpt ) {
							$excerpt = wp_trim_words( wp_strip_all_tags( get_the_content() ), 20 );
						}
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
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<p><?php echo esc_html( $excerpt ); ?></p>
								<a class="news-card__link" href="<?php the_permalink(); ?>">
									<?php esc_html_e( 'Lire la suite', 'udsp31' ); ?>
									<span class="button__icon"><?php udsp31_the_icon( 'arrow' ); ?></span>
								</a>
							</div>
						</article>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				<?php else : ?>
					<?php foreach ( $fallback_news as $item ) : ?>
						<article class="news-card">
							<div class="news-card__image">
								<img src="<?php echo esc_url( $item['image'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" />
								<span class="news-card__badge"><?php echo esc_html( $item['category'] ); ?></span>
							</div>
							<div class="news-card__content">
								<span class="news-card__meta">
									<span class="icon-wrap"><?php udsp31_the_icon( 'calendar' ); ?></span>
									<span><?php echo esc_html( $item['date'] ); ?></span>
								</span>
								<h3><?php echo esc_html( $item['title'] ); ?></h3>
								<p><?php echo esc_html( $item['text'] ); ?></p>
								<a class="news-card__link" href="<?php echo esc_url( udsp31_section_url( 'site-footer-contact' ) ); ?>">
									<?php esc_html_e( 'Lire la suite', 'udsp31' ); ?>
									<span class="button__icon"><?php udsp31_the_icon( 'arrow' ); ?></span>
								</a>
							</div>
						</article>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<section class="section section--quick-links" id="acces-rapides">
		<div class="container">
			<div class="section-heading">
				<h2><?php esc_html_e( 'Acces rapides', 'udsp31' ); ?></h2>
				<p><?php esc_html_e( 'Trouvez rapidement ce que vous cherchez.', 'udsp31' ); ?></p>
			</div>

			<div class="quick-links-grid">
				<?php foreach ( $quick_links as $link ) : ?>
					<a class="quick-link" href="<?php echo esc_url( $link['url'] ); ?>">
						<span class="quick-link__icon"><?php udsp31_the_icon( $link['icon'] ); ?></span>
						<span><?php echo esc_html( $link['label'] ); ?></span>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="section section--engagement" id="engagement">
		<div class="container engagement-grid">
			<div class="engagement-copy">
				<span class="section-kicker"><?php esc_html_e( 'Nos valeurs', 'udsp31' ); ?></span>
				<h2><?php esc_html_e( 'Un engagement au service de tous', 'udsp31' ); ?></h2>
				<p><?php esc_html_e( "L'Union Departementale des Sapeurs-Pompiers de Haute-Garonne est une association qui oeuvre depuis plus de 100 ans pour defendre les interets des sapeurs-pompiers, promouvoir leurs valeurs et accompagner les acteurs de la securite civile.", 'udsp31' ); ?></p>

				<ul class="value-list">
					<?php foreach ( $values as $value ) : ?>
						<li>
							<span class="value-list__icon"><?php udsp31_the_icon( $value['icon'] ); ?></span>
							<div>
								<strong><?php echo esc_html( $value['title'] ); ?></strong>
								<p><?php echo esc_html( $value['text'] ); ?></p>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>

				<a class="button button--primary" href="<?php echo esc_url( udsp31_section_url( 'site-footer-contact' ) ); ?>">
					<span><?php esc_html_e( "Decouvrir l'UDSP 31", 'udsp31' ); ?></span>
					<span class="button__icon"><?php udsp31_the_icon( 'arrow' ); ?></span>
				</a>
			</div>

			<div class="engagement-media">
				<img src="<?php echo esc_url( udsp31_asset_url( 'assets/images/recruit-3.jpg' ) ); ?>" alt="<?php esc_attr_e( 'Pompiers en intervention', 'udsp31' ); ?>" />
			</div>
		</div>
	</section>

	<section class="section section--partners" id="partenaires">
		<div class="container">
			<div class="section-heading">
				<h2><?php esc_html_e( 'Nos partenaires', 'udsp31' ); ?></h2>
				<p><?php esc_html_e( 'Ils nous font confiance.', 'udsp31' ); ?></p>
			</div>

			<div class="partner-grid">
				<?php foreach ( $partners as $partner ) : ?>
					<div class="partner-card"><?php echo esc_html( $partner ); ?></div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
