<?php
/**
 * Template Name: Devenir Pompier Professionnel
 *
 * @package UDSP31
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$professional_cards = array(
	array(
		'icon'  => 'shield',
		'title' => __( 'Caporal', 'udsp31' ),
		'text'  => __( 'Accessible selon plusieurs voies, notamment avec un diplome de niveau 3, ou pour certains profils deja engages dans la securite civile ou le volontariat.', 'udsp31' ),
	),
	array(
		'icon'  => 'document',
		'title' => __( 'Lieutenant 1re classe', 'udsp31' ),
		'text'  => __( 'Accessible avec un diplome de niveau 5, soit bac +2.', 'udsp31' ),
	),
	array(
		'icon'  => 'graduation',
		'title' => __( 'Capitaine', 'udsp31' ),
		'text'  => __( 'Accessible avec un diplome de niveau 6, soit bac +3.', 'udsp31' ),
	),
	array(
		'icon'  => 'users',
		'title' => __( 'Selon le grade vise', 'udsp31' ),
		'text'  => __( 'Les conditions de diplome et les epreuves different selon le concours et le niveau de responsabilite recherche.', 'udsp31' ),
	),
);

$professional_flow = array(
	array(
		'step'  => '01',
		'title' => __( "Etre inscrit sur liste d'aptitude", 'udsp31' ),
		'text'  => __( "La reussite au concours permet d'etre inscrit sur une liste d'aptitude valable au niveau national. Cette inscription a une duree limitee et doit, selon les cas, etre renouvelee.", 'udsp31' ),
	),
	array(
		'step'  => '02',
		'title' => __( 'Postuler apres le concours', 'udsp31' ),
		'text'  => __( "L'inscription sur liste d'aptitude ne vaut pas recrutement. Le candidat doit ensuite postuler aupres des structures qui recrutent.", 'udsp31' ),
	),
	array(
		'step'  => '03',
		'title' => __( "Suivre la formation d'integration", 'udsp31' ),
		'text'  => __( "Apres recrutement, une formation d'integration et de professionnalisation est suivie. Sa duree varie selon le concours obtenu.", 'udsp31' ),
	),
	array(
		'step'  => '04',
		'title' => __( 'Valider son engagement', 'udsp31' ),
		'text'  => __( "A son issue, et sous reserve de reussite, un engagement de service de plusieurs annees est demande.", 'udsp31' ),
	),
);

get_header();
?>

<main id="primary" class="site-main site-main--discover">
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<section class="page-hero discover-hero">
			<div class="container discover-hero__grid">
				<div class="discover-hero__copy">
					<h1><?php esc_html_e( 'Devenir Pompier Professionnel', 'udsp31' ); ?></h1>
					<p class="discover-hero__lede"><?php esc_html_e( "Les sapeurs-pompiers professionnels sont des agents de la fonction publique territoriale. Pour exercer, il faut reussir un concours de la filiere des sapeurs-pompiers professionnels.", 'udsp31' ); ?></p>

					<div class="discover-hero__actions">
						<a class="button button--primary" href="#conditions-professionnel">
							<span><?php esc_html_e( 'Voir les conditions', 'udsp31' ); ?></span>
							<span class="button__icon"><?php udsp31_the_icon( 'arrow' ); ?></span>
						</a>
						<a class="button button--secondary" href="#apres-concours">
							<span><?php esc_html_e( 'Apres le concours', 'udsp31' ); ?></span>
						</a>
					</div>
				</div>

				<div class="discover-hero__media" aria-hidden="true">
					<figure class="discover-media-card discover-media-card--primary">
						<img src="<?php echo esc_url( udsp31_asset_url( 'assets/images/portrait-sapeuse.png' ) ); ?>" alt="" />
					</figure>
					<figure class="discover-media-card discover-media-card--secondary">
						<img src="<?php echo esc_url( trailingslashit( get_template_directory_uri() ) . 'assets/images/' . rawurlencode( 'secourisme 2.png' ) ); ?>" alt="" />
					</figure>
					<figure class="discover-media-card discover-media-card--tertiary">
						<img src="<?php echo esc_url( udsp31_asset_url( 'assets/images/pompiers2.png' ) ); ?>" alt="" />
					</figure>
				</div>
			</div>
		</section>

		<section class="section discover-section discover-section--story">
			<div class="container discover-story">
				<div class="discover-story__copy">
					<h2><?php esc_html_e( 'Un recrutement par concours', 'udsp31' ); ?></h2>
					<p><?php esc_html_e( "Les sapeurs-pompiers professionnels sont des agents de la fonction publique territoriale. Pour exercer, il faut reussir un concours de la filiere des sapeurs-pompiers professionnels.", 'udsp31' ); ?></p>
					<p><?php esc_html_e( 'Selon le grade vise, les conditions de diplome et les epreuves different.', 'udsp31' ); ?></p>
					<p><?php esc_html_e( "Le concours constitue donc la premiere etape d'un parcours exigeant, avant le recrutement effectif, la formation d'integration et la prise de poste.", 'udsp31' ); ?></p>
				</div>

				<aside class="discover-summary" id="conditions-professionnel">
					<article class="discover-summary__card">
						<span class="section-kicker"><?php esc_html_e( 'Conditions generales', 'udsp31' ); ?></span>
						<h3><?php esc_html_e( 'Les conditions a remplir', 'udsp31' ); ?></h3>
						<p><?php esc_html_e( 'Pour se presenter au concours, il faut notamment :', 'udsp31' ); ?></p>

						<ul class="discover-summary__meta">
							<li>
								<strong><?php esc_html_e( 'Age', 'udsp31' ); ?></strong>
								<span><?php esc_html_e( 'Avoir au moins 18 ans.', 'udsp31' ); ?></span>
							</li>
							<li>
								<strong><?php esc_html_e( 'Nationalite', 'udsp31' ); ?></strong>
								<span><?php esc_html_e( "Etre de nationalite francaise, ou ressortissant d'un Etat de l'Union europeenne ou de l'Espace economique europeen.", 'udsp31' ); ?></span>
							</li>
							<li>
								<strong><?php esc_html_e( 'Situation administrative', 'udsp31' ); ?></strong>
								<span><?php esc_html_e( 'Jouir de ses droits civiques et etre en regle au regard des obligations de service national.', 'udsp31' ); ?></span>
							</li>
							<li>
								<strong><?php esc_html_e( 'Casier judiciaire', 'udsp31' ); ?></strong>
								<span><?php esc_html_e( 'Ne pas avoir de condamnation incompatible avec les fonctions exercees.', 'udsp31' ); ?></span>
							</li>
							<li>
								<strong><?php esc_html_e( 'Aptitude physique', 'udsp31' ); ?></strong>
								<span><?php esc_html_e( 'Remplir les conditions d aptitude physique requises.', 'udsp31' ); ?></span>
							</li>
						</ul>
					</article>
				</aside>
			</div>
		</section>

		<section class="section section--quick-links discover-section">
			<div class="container">
				<div class="section-heading">
					<h2><?php esc_html_e( 'Les principaux concours', 'udsp31' ); ?></h2>
					<p><?php esc_html_e( 'Selon le grade vise, les conditions de diplome et les epreuves different.', 'udsp31' ); ?></p>
				</div>

				<div class="discover-commission-grid">
					<?php foreach ( $professional_cards as $card ) : ?>
						<article class="discover-commission-card">
							<span class="info-card__icon"><?php udsp31_the_icon( $card['icon'] ); ?></span>
							<h3><?php echo esc_html( $card['title'] ); ?></h3>
							<p><?php echo esc_html( $card['text'] ); ?></p>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<section class="section section--stats discover-section" id="apres-concours">
			<div class="container">
				<div class="section-heading">
					<h2><?php esc_html_e( 'Apres la reussite au concours', 'udsp31' ); ?></h2>
					<p><?php esc_html_e( "La reussite au concours permet d'etre inscrit sur une liste d'aptitude valable au niveau national. Cette etape est indispensable, mais elle ne vaut pas recrutement.", 'udsp31' ); ?></p>
				</div>

				<div class="discover-flow">
					<?php foreach ( $professional_flow as $item ) : ?>
						<article class="discover-flow__card">
							<span class="discover-flow__step"><?php echo esc_html( $item['step'] ); ?></span>
							<h3><?php echo esc_html( $item['title'] ); ?></h3>
							<p><?php echo esc_html( $item['text'] ); ?></p>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<section class="section discover-section discover-section--closing">
			<div class="container discover-closing">
				<div class="discover-closing__gallery" aria-hidden="true">
					<img src="<?php echo esc_url( trailingslashit( get_template_directory_uri() ) . 'assets/images/' . rawurlencode( 'secourisme 2.png' ) ); ?>" alt="" />
					<img src="<?php echo esc_url( udsp31_asset_url( 'assets/images/portrait-sapeuse.png' ) ); ?>" alt="" />
					<img src="<?php echo esc_url( udsp31_asset_url( 'assets/images/pompiers2.png' ) ); ?>" alt="" />
				</div>

				<div class="discover-closing__copy">
					<span class="section-kicker"><?php esc_html_e( 'Construire son parcours', 'udsp31' ); ?></span>
					<h2><?php esc_html_e( 'Se preparer a un recrutement exigeant', 'udsp31' ); ?></h2>
					<p><?php esc_html_e( "L'inscription sur liste d'aptitude ne vaut pas recrutement. Le candidat doit ensuite postuler aupres des structures qui recrutent, puis suivre une formation d'integration et de professionnalisation.", 'udsp31' ); ?></p>
					<p><?php esc_html_e( "Si vous souhaitez etre oriente ou mieux comprendre les voies d'acces, l'UDSP 31 peut vous aider a identifier les bons interlocuteurs.", 'udsp31' ); ?></p>

					<div class="discover-closing__actions">
						<a class="button button--primary" href="#site-footer-contact">
							<span><?php esc_html_e( 'Nous contacter', 'udsp31' ); ?></span>
							<span class="button__icon"><?php udsp31_the_icon( 'arrow' ); ?></span>
						</a>
						<a class="button button--secondary" href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<span><?php esc_html_e( "Retour a l'accueil", 'udsp31' ); ?></span>
						</a>
					</div>
				</div>
			</div>
		</section>
	<?php endwhile; ?>
</main>

<?php
get_footer();
