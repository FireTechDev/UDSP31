<?php
/**
 * Template Name: Devenir Pompier volontaire
 *
 * @package UDSP31
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$volunteer_cards = array(
	array(
		'icon'  => 'handshake',
		'title' => __( 'Le sens du collectif', 'udsp31' ),
		'text'  => __( "Nous recherchons des femmes et des hommes motives par l'envie d'aider, le sens du service et le gout du travail en equipe.", 'udsp31' ),
	),
	array(
		'icon'  => 'users',
		'title' => __( 'Des profils varies', 'udsp31' ),
		'text'  => __( 'Etudiant, salarie, artisan, demandeur d emploi ou parent au foyer: chacun peut trouver sa place dans un centre de secours.', 'udsp31' ),
	),
	array(
		'icon'  => 'graduation',
		'title' => __( 'Une condition physique adaptee', 'udsp31' ),
		'text'  => __( "Il n'est pas necessaire d'etre sportif de haut niveau, mais il faut disposer d'une condition physique compatible avec l'engagement.", 'udsp31' ),
	),
	array(
		'icon'  => 'clock',
		'title' => __( 'Une disponibilite reelle', 'udsp31' ),
		'text'  => __( 'Les candidats doivent pouvoir assurer des gardes et des astreintes, y compris en journee selon les besoins du centre.', 'udsp31' ),
	),
);

$volunteer_flow = array(
	array(
		'step'  => '01',
		'title' => __( 'Prendre contact', 'udsp31' ),
		'text'  => __( "La demarche commence aupres du centre d'incendie et de secours le plus proche de votre domicile, avec un premier echange avec le chef de centre.", 'udsp31' ),
	),
	array(
		'step'  => '02',
		'title' => __( 'Constituer son dossier', 'udsp31' ),
		'text'  => __( 'Le candidat est accompagne pour reunir les pieces necessaires et formaliser sa candidature dans de bonnes conditions.', 'udsp31' ),
	),
	array(
		'step'  => '03',
		'title' => __( 'Valider les tests', 'udsp31' ),
		'text'  => __( "Le parcours comprend les tests physiques, les examens medicaux demandes et la visite medicale d'aptitude.", 'udsp31' ),
	),
	array(
		'step'  => '04',
		'title' => __( 'Debuter son engagement', 'udsp31' ),
		'text'  => __( "Une fois les etapes validees, le futur sapeur-pompier volontaire recoit son equipement et peut debuter sa formation.", 'udsp31' ),
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
					<h1><?php the_title(); ?></h1>
					<p class="discover-hero__lede"><?php esc_html_e( "Chaque jour, des femmes et des hommes s'engagent comme sapeurs-pompiers volontaires pour proteger et secourir la population, en parallele de leur metier, de leurs etudes ou de leur vie de famille.", 'udsp31' ); ?></p>

					<div class="discover-hero__actions">
						<a class="button button--primary" href="#conditions-volontaire">
							<span><?php esc_html_e( 'Voir les conditions', 'udsp31' ); ?></span>
							<span class="button__icon"><?php udsp31_the_icon( 'arrow' ); ?></span>
						</a>
						<a class="button button--secondary" href="#candidater-volontaire">
							<span><?php esc_html_e( 'Comment candidater ?', 'udsp31' ); ?></span>
						</a>
					</div>
				</div>

				<div class="discover-hero__media" aria-hidden="true">
					<figure class="discover-media-card discover-media-card--primary">
						<img src="<?php echo esc_url( udsp31_asset_url( 'assets/images/pompiers2.png' ) ); ?>" alt="" />
					</figure>
					<figure class="discover-media-card discover-media-card--secondary">
						<img src="<?php echo esc_url( trailingslashit( get_template_directory_uri() ) . 'assets/images/' . rawurlencode( 'JSP fille.png' ) ); ?>" alt="" />
					</figure>
					<figure class="discover-media-card discover-media-card--tertiary">
						<img src="<?php echo esc_url( trailingslashit( get_template_directory_uri() ) . 'assets/images/' . rawurlencode( 'secourisme 2.png' ) ); ?>" alt="" />
					</figure>
				</div>
			</div>
		</section>

		<section class="section discover-section discover-section--story">
			<div class="container discover-story">
				<div class="discover-story__copy">
					<h2><?php esc_html_e( 'Un engagement accessible et utile', 'udsp31' ); ?></h2>
					<p><?php esc_html_e( "Etudiant, salarie, artisan, demandeur d'emploi ou parent au foyer: chacun peut trouver sa place parmi les sapeurs-pompiers volontaires.", 'udsp31' ); ?></p>
					<p><?php esc_html_e( "Si vous souhaitez vous rendre utile, vivre une experience humaine forte et rejoindre une equipe engagee, le volontariat permet de servir votre territoire tout en poursuivant votre vie personnelle, professionnelle ou vos etudes.", 'udsp31' ); ?></p>
					<p><?php esc_html_e( "Le volontariat repose sur un cadre exigeant, mais il est accessible a celles et ceux qui veulent s'investir durablement au service de la population.", 'udsp31' ); ?></p>
				</div>

				<aside class="discover-summary" id="conditions-volontaire">
					<article class="discover-summary__card">
						<span class="section-kicker"><?php esc_html_e( 'Conditions a remplir', 'udsp31' ); ?></span>
						<h3><?php esc_html_e( 'Les prerequis pour s engager', 'udsp31' ); ?></h3>
						<p><?php esc_html_e( "L'engagement est pris pour une duree de 5 ans, renouvelable. Certains statuts ou metiers peuvent relever de dispositions particulieres, notamment les militaires, infirmiers ou personnels de securite.", 'udsp31' ); ?></p>

						<ul class="discover-summary__meta">
							<li>
								<strong><?php esc_html_e( 'Age', 'udsp31' ); ?></strong>
								<span><?php esc_html_e( 'Avoir au moins 18 ans, ou 17 ans pour les jeunes sapeurs-pompiers titulaires du brevet.', 'udsp31' ); ?></span>
							</li>
							<li>
								<strong><?php esc_html_e( 'Ancrage local', 'udsp31' ); ?></strong>
								<span><?php esc_html_e( "Habiter a proximite d'un centre d'incendie et de secours.", 'udsp31' ); ?></span>
							</li>
							<li>
								<strong><?php esc_html_e( 'Aptitude', 'udsp31' ); ?></strong>
								<span><?php esc_html_e( 'Avoir un casier judiciaire vierge et remplir les conditions d aptitude medicale et physique.', 'udsp31' ); ?></span>
							</li>
						</ul>
					</article>
				</aside>
			</div>
		</section>

		<section class="section section--quick-links discover-section">
			<div class="container">
				<div class="section-heading">
					<h2><?php esc_html_e( 'Les profils recherches', 'udsp31' ); ?></h2>
					<p><?php esc_html_e( "Nous recherchons des femmes et des hommes prets a s'investir utilement, avec serieux, motivation et disponibilite.", 'udsp31' ); ?></p>
				</div>

				<div class="discover-commission-grid">
					<?php foreach ( $volunteer_cards as $card ) : ?>
						<article class="discover-commission-card">
							<span class="info-card__icon"><?php udsp31_the_icon( $card['icon'] ); ?></span>
							<h3><?php echo esc_html( $card['title'] ); ?></h3>
							<p><?php echo esc_html( $card['text'] ); ?></p>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<section class="section section--stats discover-section" id="candidater-volontaire">
			<div class="container">
				<div class="section-heading">
					<h2><?php esc_html_e( 'Comment candidater ?', 'udsp31' ); ?></h2>
					<p><?php esc_html_e( "La demarche se fait aupres du centre d'incendie et de secours le plus proche de votre domicile, avec un accompagnement progressif a chaque etape.", 'udsp31' ); ?></p>
				</div>

				<div class="discover-flow">
					<?php foreach ( $volunteer_flow as $item ) : ?>
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
					<img src="<?php echo esc_url( udsp31_asset_url( 'assets/images/JSP.png' ) ); ?>" alt="" />
					<img src="<?php echo esc_url( udsp31_asset_url( 'assets/images/pompiers2.png' ) ); ?>" alt="" />
					<img src="<?php echo esc_url( trailingslashit( get_template_directory_uri() ) . 'assets/images/' . rawurlencode( 'secourisme 2.png' ) ); ?>" alt="" />
				</div>

				<div class="discover-closing__copy">
					<span class="section-kicker"><?php esc_html_e( 'Une experience humaine forte', 'udsp31' ); ?></span>
					<h2><?php esc_html_e( 'Rejoindre une equipe engagee', 'udsp31' ); ?></h2>
					<p><?php esc_html_e( "Devenir sapeur-pompier volontaire, c'est choisir un engagement utile, concret et durable au service de la population.", 'udsp31' ); ?></p>
					<p><?php esc_html_e( "Si vous vous reconnaissez dans cet esprit de service et de collectif, prenez contact avec le centre le plus proche ou avec l'UDSP 31 pour etre oriente vers les bons interlocuteurs.", 'udsp31' ); ?></p>

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
