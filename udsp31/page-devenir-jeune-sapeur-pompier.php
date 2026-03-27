<?php
/**
 * Template Name: Devenir Jeune Sapeur-Pompier
 *
 * @package UDSP31
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$jsp_cards = array(
	array(
		'icon'  => 'graduation',
		'title' => __( 'JSP1', 'udsp31' ),
		'text'  => __( "Le premier cycle permet de decouvrir les materiels, les comportements qui sauvent et les premieres notions liees a l'engagement citoyen.", 'udsp31' ),
	),
	array(
		'icon'  => 'users',
		'title' => __( 'JSP2', 'udsp31' ),
		'text'  => __( "Le deuxieme cycle approfondit l'apprentissage des materiels, des procedures et du travail en equipe dans un cadre de progression reguliere.", 'udsp31' ),
	),
	array(
		'icon'  => 'heart',
		'title' => __( 'JSP3', 'udsp31' ),
		'text'  => __( "Le troisieme cycle consolide les manoeuvres, les activites sportives, l'entraide et les reflexes collectifs utiles a la vie de section.", 'udsp31' ),
	),
	array(
		'icon'  => 'shield',
		'title' => __( 'JSP4', 'udsp31' ),
		'text'  => __( "Le quatrieme cycle prepare a des mises en situation plus concretes, proches de la realite operationnelle, avant le brevet national.", 'udsp31' ),
	),
);

$jsp_flow = array(
	array(
		'step'  => '01',
		'title' => __( 'Duree et rythme', 'udsp31' ),
		'text'  => __( 'La formation est assuree par des sapeurs-pompiers. Elle dure trois ou quatre ans et se deroule le mercredi ou le samedi pendant la periode scolaire, selon les sections.', 'udsp31' ),
	),
	array(
		'step'  => '02',
		'title' => __( 'Contenus de formation', 'udsp31' ),
		'text'  => __( 'Elle associe enseignements theoriques et pratiques, activites sportives, decouverte des missions des sapeurs-pompiers, manoeuvres, rencontres sportives, ceremonies et evenements.', 'udsp31' ),
	),
	array(
		'step'  => '03',
		'title' => __( 'Brevet national JSP', 'udsp31' ),
		'text'  => __( "A l'issue de la formation, il est possible de presenter le brevet national de jeune sapeur-pompier en reussissant des epreuves theoriques, pratiques et sportives.", 'udsp31' ),
	),
	array(
		'step'  => '04',
		'title' => __( 'Un atout pour la suite', 'udsp31' ),
		'text'  => __( "Ce brevet constitue un veritable atout pour devenir ensuite sapeur-pompier volontaire ou professionnel. Meme sans poursuivre dans cette voie, l'experience apporte des competences et des valeurs utiles toute la vie.", 'udsp31' ),
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
					<p class="discover-hero__lede"><?php esc_html_e( "Vous avez envie de vivre une aventure humaine forte et une experience unique ? Devenez jeune sapeur-pompier. Vous decouvrirez l'esprit d'equipe, l'engagement collectif et les gestes qui sauvent.", 'udsp31' ); ?></p>

					<div class="discover-hero__actions">
						<a class="button button--primary" href="#formation-jsp">
							<span><?php esc_html_e( 'Decouvrir la formation', 'udsp31' ); ?></span>
							<span class="button__icon"><?php udsp31_the_icon( 'arrow' ); ?></span>
						</a>
						<a class="button button--secondary" href="#sections-jsp">
							<span><?php esc_html_e( 'Voir les sections', 'udsp31' ); ?></span>
						</a>
					</div>
				</div>

				<div class="discover-hero__media" aria-hidden="true">
					<figure class="discover-media-card discover-media-card--primary">
						<img src="<?php echo esc_url( trailingslashit( get_template_directory_uri() ) . 'assets/images/' . rawurlencode( 'JSP fille.png' ) ); ?>" alt="" />
					</figure>
					<figure class="discover-media-card discover-media-card--secondary">
						<img src="<?php echo esc_url( udsp31_asset_url( 'assets/images/JSP.png' ) ); ?>" alt="" />
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
					<h2><?php esc_html_e( 'Un parcours pour apprendre, grandir et s engager', 'udsp31' ); ?></h2>
					<p><?php esc_html_e( "Etre jeune sapeur-pompier, c'est s'initier au secourisme et a la lutte contre l'incendie, pratiquer des activites sportives et developper des valeurs essentielles comme la solidarite, le civisme et l'altruisme.", 'udsp31' ); ?></p>
					<p><?php esc_html_e( "La commission des Jeunes Sapeurs-Pompiers de la Haute-Garonne coordonne plusieurs sections reparties sur le departement pour permettre aux jeunes de rejoindre un parcours exigeant et enrichissant au plus pres de chez eux.", 'udsp31' ); ?></p>
					<p><?php esc_html_e( "Chaque section accueille generalement de 8 a 12 jeunes, encadres par des animateurs charges de les former et de les accompagner. Integrer les JSP, c'est aussi apprendre a vivre en groupe, a se depasser, a developper l'entraide et a s'approprier les valeurs de l'engagement citoyen.", 'udsp31' ); ?></p>
				</div>

				<aside class="discover-summary" id="sections-jsp">
					<article class="discover-summary__card">
						<span class="section-kicker"><?php esc_html_e( 'Les sections en Haute-Garonne', 'udsp31' ); ?></span>
						<h3><?php esc_html_e( 'Un reseau present sur tout le departement', 'udsp31' ); ?></h3>
						<p><?php esc_html_e( "Aussonne, Colomiers, lycee Eugene-Montel a Colomiers, Grenade / Saint-Jory, Muret, Ramonville / Montgiscard, Revel, Rouffiac-Tolosan, Saint-Beat, Saint-Lys, Toulouse-Lougnon, Villemur-sur-Tarn, Villefranche-de-Lauragais et Volvestre.", 'udsp31' ); ?></p>

						<ul class="discover-summary__meta">
							<li>
								<strong><?php esc_html_e( 'Effectifs', 'udsp31' ); ?></strong>
								<span><?php esc_html_e( 'Chaque section accueille generalement de 8 a 12 jeunes.', 'udsp31' ); ?></span>
							</li>
							<li>
								<strong><?php esc_html_e( 'Encadrement', 'udsp31' ); ?></strong>
								<span><?php esc_html_e( 'Des animateurs forment et accompagnent les jeunes tout au long du parcours.', 'udsp31' ); ?></span>
							</li>
							<li>
								<strong><?php esc_html_e( 'Objectif', 'udsp31' ); ?></strong>
								<span><?php esc_html_e( "Se preparer a devenir un futur sapeur-pompier tout en grandissant dans un esprit d'equipe.", 'udsp31' ); ?></span>
							</li>
						</ul>
					</article>
				</aside>
			</div>
		</section>

		<section class="section section--quick-links discover-section" id="formation-jsp">
			<div class="container">
				<div class="section-heading">
					<h2><?php esc_html_e( 'La formation', 'udsp31' ); ?></h2>
					<p><?php esc_html_e( 'Le parcours est organise en quatre cycles, JSP1, JSP2, JSP3 et JSP4, repartis sur trois ou quatre annees.', 'udsp31' ); ?></p>
				</div>

				<div class="discover-commission-grid">
					<?php foreach ( $jsp_cards as $card ) : ?>
						<article class="discover-commission-card">
							<span class="info-card__icon"><?php udsp31_the_icon( $card['icon'] ); ?></span>
							<h3><?php echo esc_html( $card['title'] ); ?></h3>
							<p><?php echo esc_html( $card['text'] ); ?></p>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<section class="section section--stats discover-section" id="parcours-jsp">
			<div class="container">
				<div class="section-heading">
					<h2><?php esc_html_e( 'Un parcours complet et valorisant', 'udsp31' ); ?></h2>
					<p><?php esc_html_e( "La formation associe progression technique, vie de groupe, activites sportives et preparation a la suite du parcours sapeur-pompier.", 'udsp31' ); ?></p>
				</div>

				<div class="discover-flow">
					<?php foreach ( $jsp_flow as $item ) : ?>
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
					<img src="<?php echo esc_url( trailingslashit( get_template_directory_uri() ) . 'assets/images/' . rawurlencode( 'JSP fille.png' ) ); ?>" alt="" />
					<img src="<?php echo esc_url( udsp31_asset_url( 'assets/images/JSP.png' ) ); ?>" alt="" />
					<img src="<?php echo esc_url( trailingslashit( get_template_directory_uri() ) . 'assets/images/' . rawurlencode( 'secourisme 2.png' ) ); ?>" alt="" />
				</div>

				<div class="discover-closing__copy">
					<span class="section-kicker"><?php esc_html_e( 'Un engagement qui compte', 'udsp31' ); ?></span>
					<h2><?php esc_html_e( 'Une experience utile pour l avenir', 'udsp31' ); ?></h2>
					<p><?php esc_html_e( "A l'issue de la formation, le brevet national de jeune sapeur-pompier constitue un veritable atout pour devenir ensuite sapeur-pompier volontaire ou professionnel. Il est egalement apprecie dans le monde du travail.", 'udsp31' ); ?></p>
					<p><?php esc_html_e( "Meme si vous ne poursuivez pas ensuite dans la voie des sapeurs-pompiers, cette experience vous apportera des connaissances, des competences et des valeurs utiles tout au long de votre vie.", 'udsp31' ); ?></p>

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
