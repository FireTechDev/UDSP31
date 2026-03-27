<?php
/**
 * Template Name: Le bureau executif
 *
 * @package UDSP31
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$discover_url     = udsp31_get_discover_url();
$executive_roles  = array(
	array(
		'icon'  => 'shield',
		'title' => __( 'Presidence', 'udsp31' ),
		'text'  => __( "Porter la vision de l'association, representer l'UDSP 31 et arbitrer les priorites en lien avec les besoins du terrain.", 'udsp31' ),
	),
	array(
		'icon'  => 'document',
		'title' => __( 'Secretariat general', 'udsp31' ),
		'text'  => __( "Assurer le suivi des decisions, preparer les instances et coordonner la circulation de l'information entre les commissions et les amicales.", 'udsp31' ),
	),
	array(
		'icon'  => 'heart',
		'title' => __( 'Tresorerie', 'udsp31' ),
		'text'  => __( "Piloter les equilibres financiers, accompagner les projets et garantir une gestion rigoureuse au service des actions associatives.", 'udsp31' ),
	),
	array(
		'icon'  => 'users',
		'title' => __( 'Delegations et vice-presidences', 'udsp31' ),
		'text'  => __( "Relier les sujets operationnels, sociaux, sportifs ou de formation afin que chaque dossier avance avec une responsabilite clairement portee.", 'udsp31' ),
	),
);

$executive_flow = array(
	array(
		'step'  => '01',
		'title' => __( 'Preparer', 'udsp31' ),
		'text'  => __( "Le bureau rassemble les informations utiles, identifie les priorites et structure les dossiers avant leur presentation aux instances de l'association.", 'udsp31' ),
	),
	array(
		'step'  => '02',
		'title' => __( 'Coordonner', 'udsp31' ),
		'text'  => __( "Il fait le lien entre les commissions, les amicales, les partenaires et les responsables associatifs pour assurer une action lisible et coherente.", 'udsp31' ),
	),
	array(
		'step'  => '03',
		'title' => __( 'Decider', 'udsp31' ),
		'text'  => __( "Le bureau executif arbitre, suit les engagements pris et veille a ce que les projets servent effectivement les sapeurs-pompiers du departement.", 'udsp31' ),
	),
	array(
		'step'  => '04',
		'title' => __( 'Rendre compte', 'udsp31' ),
		'text'  => __( "Il inscrit son action dans un cadre transparent, partage les orientations et garantit la continuite de la vie associative.", 'udsp31' ),
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
					<p class="discover-hero__lede"><?php esc_html_e( "Le bureau executif anime la gouvernance associative de l'UDSP 31, coordonne les priorites et veille a la coherence des actions engagees au service des sapeurs-pompiers de la Haute-Garonne.", 'udsp31' ); ?></p>

					<div class="discover-hero__actions">
						<a class="button button--primary" href="#missions-bureau">
							<span><?php esc_html_e( 'Voir les missions du bureau', 'udsp31' ); ?></span>
							<span class="button__icon"><?php udsp31_the_icon( 'arrow' ); ?></span>
						</a>
						<a class="button button--secondary" href="<?php echo esc_url( $discover_url ); ?>">
							<span><?php esc_html_e( "Retour a l'UDSP 31", 'udsp31' ); ?></span>
						</a>
					</div>
				</div>

				<div class="discover-hero__media" aria-hidden="true">
					<figure class="discover-media-card discover-media-card--primary">
						<img src="<?php echo esc_url( udsp31_asset_url( 'assets/images/portrait-sapeuse.png' ) ); ?>" alt="" />
					</figure>
					<figure class="discover-media-card discover-media-card--secondary">
						<img src="<?php echo esc_url( udsp31_asset_url( 'assets/images/JSP fille.png' ) ); ?>" alt="" />
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
					<h2><?php esc_html_e( "Une instance de pilotage au service de l'association", 'udsp31' ); ?></h2>
					<p><?php esc_html_e( "Le bureau executif assure l'impulsion, le suivi et la coordination des grandes orientations de l'UDSP 31. Il veille a ce que les decisions prises servent utilement les sapeurs-pompiers, les amicales et l'ensemble de la vie associative departementale.", 'udsp31' ); ?></p>
					<p><?php esc_html_e( "Son role est de garder une ligne claire, de faire avancer les dossiers structurants et de garantir que chaque action trouve sa place dans une vision collective: soutenir les personnels, accompagner les projets et faire vivre les valeurs de l'Union.", 'udsp31' ); ?></p>
					<p><?php esc_html_e( "Entre representation, organisation et arbitrage, le bureau executif constitue un point d'appui essentiel pour donner du rythme, de la lisibilite et de la continuite a l'action associative.", 'udsp31' ); ?></p>
				</div>

				<aside class="discover-summary">
					<article class="discover-summary__card">
						<span class="section-kicker"><?php esc_html_e( 'Repere', 'udsp31' ); ?></span>
						<h3><?php esc_html_e( 'Un collectif de decision et de coordination', 'udsp31' ); ?></h3>
						<p><?php esc_html_e( "Le bureau executif met en mouvement les priorites de l'UDSP 31 et transforme les orientations associatives en actions concretes et suivies.", 'udsp31' ); ?></p>

						<ul class="discover-summary__meta">
							<li>
								<strong><?php esc_html_e( 'Piloter', 'udsp31' ); ?></strong>
								<span><?php esc_html_e( "Fixer un cap, prioriser et donner de la coherence aux sujets de fond.", 'udsp31' ); ?></span>
							</li>
							<li>
								<strong><?php esc_html_e( 'Animer', 'udsp31' ); ?></strong>
								<span><?php esc_html_e( "Faire travailler ensemble les responsables, les commissions et les relais associatifs.", 'udsp31' ); ?></span>
							</li>
							<li>
								<strong><?php esc_html_e( 'Suivre', 'udsp31' ); ?></strong>
								<span><?php esc_html_e( "Verifier l'avancement des projets et maintenir un niveau d'exigence dans leur execution.", 'udsp31' ); ?></span>
							</li>
						</ul>
					</article>
				</aside>
			</div>
		</section>

		<section class="section section--quick-links discover-section" id="missions-bureau">
			<div class="container">
				<div class="section-heading">
					<h2><?php esc_html_e( 'Les grandes responsabilites du bureau executif', 'udsp31' ); ?></h2>
					<p><?php esc_html_e( "Le bureau executif s'organise autour de fonctions complementaires pour garantir une gouvernance utile, lisible et capable de repondre aux enjeux du departement.", 'udsp31' ); ?></p>
				</div>

				<div class="discover-commission-grid">
					<?php foreach ( $executive_roles as $role ) : ?>
						<article class="discover-commission-card">
							<span class="info-card__icon"><?php udsp31_the_icon( $role['icon'] ); ?></span>
							<h3><?php echo esc_html( $role['title'] ); ?></h3>
							<p><?php echo esc_html( $role['text'] ); ?></p>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<section class="section section--stats discover-section" id="fonctionnement-bureau">
			<div class="container">
				<div class="section-heading">
					<h2><?php esc_html_e( 'Un fonctionnement collectif et rythme', 'udsp31' ); ?></h2>
					<p><?php esc_html_e( "Le bureau executif ne se limite pas a une fonction statutaire. Il travaille dans la duree, suit les projets et assure le lien entre l'ambition associative et sa mise en oeuvre quotidienne.", 'udsp31' ); ?></p>
				</div>

				<div class="discover-flow">
					<?php foreach ( $executive_flow as $item ) : ?>
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
					<span class="section-kicker"><?php esc_html_e( 'Un cap, une methode, une exigence', 'udsp31' ); ?></span>
					<h2><?php esc_html_e( "Donner de la continuite a l'action associative", 'udsp31' ); ?></h2>
					<p><?php esc_html_e( "Le bureau executif veille a la solidite de l'UDSP 31 dans le temps: il accompagne les priorites, structure les decisions et cree les conditions pour que les projets associent utilement les bonnes personnes au bon moment.", 'udsp31' ); ?></p>
					<p><?php esc_html_e( "Cette organisation permet a l'Union Departementale d'agir avec clarte, constance et exigence, au plus pres des attentes des sapeurs-pompiers de la Haute-Garonne.", 'udsp31' ); ?></p>

					<div class="discover-closing__actions">
						<a class="button button--primary" href="#site-footer-contact">
							<span><?php esc_html_e( 'Nous contacter', 'udsp31' ); ?></span>
							<span class="button__icon"><?php udsp31_the_icon( 'arrow' ); ?></span>
						</a>
						<a class="button button--secondary" href="<?php echo esc_url( $discover_url ); ?>">
							<span><?php esc_html_e( "Retour a l'UDSP 31", 'udsp31' ); ?></span>
						</a>
					</div>
				</div>
			</div>
		</section>
	<?php endwhile; ?>
</main>

<?php
get_footer();
