<?php
/**
 * Template Name: Decouvrir l'UDSP 31
 *
 * @package UDSP31
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$discover_commissions = array(
	array(
		'icon'  => 'users',
		'title' => __( 'Sapeurs-pompiers volontaires', 'udsp31' ),
		'text'  => __( "Accompagner l'engagement volontaire, relayer les besoins du terrain et soutenir les centres dans leur vie associative.", 'udsp31' ),
	),
	array(
		'icon'  => 'shield',
		'title' => __( 'Sapeurs-pompiers professionnels', 'udsp31' ),
		'text'  => __( "Porter les sujets lies a l'exercice professionnel et renforcer le dialogue entre les acteurs de la communaute sapeur-pompier.", 'udsp31' ),
	),
	array(
		'icon'  => 'graduation',
		'title' => __( 'Jeunes Sapeurs-Pompiers', 'udsp31' ),
		'text'  => __( "Structurer les sections JSP, valoriser leurs activites et transmettre les valeurs d'engagement, de discipline et de citoyennete.", 'udsp31' ),
	),
	array(
		'icon'  => 'handshake',
		'title' => __( 'Anciens sapeurs-pompiers', 'udsp31' ),
		'text'  => __( 'Maintenir le lien entre les generations et faire vivre la memoire associative et l esprit de corps.', 'udsp31' ),
	),
	array(
		'icon'  => 'document',
		'title' => __( 'Formations de secourisme', 'udsp31' ),
		'text'  => __( 'Developper les formations au secourisme et diffuser les gestes qui sauvent aupres du grand public.', 'udsp31' ),
	),
	array(
		'icon'  => 'document',
		'title' => __( 'Dispositifs previsionnels de secours', 'udsp31' ),
		'text'  => __( 'Organiser et encadrer les DPS afin d assurer la prevention et la securite sur les evenements du territoire.', 'udsp31' ),
	),
	array(
		'icon'  => 'heart',
		'title' => __( 'Social', 'udsp31' ),
		'text'  => __( 'Accompagner les membres et leurs familles dans les moments importants ou plus fragiles de leur parcours.', 'udsp31' ),
	),
	array(
		'icon'  => 'users',
		'title' => __( 'Sport', 'udsp31' ),
		'text'  => __( 'Favoriser la preparation physique, la cohesion et le depassement de soi a travers les pratiques sportives.', 'udsp31' ),
	),
	array(
		'icon'  => 'shield',
		'title' => __( 'Medical et 3SM', 'udsp31' ),
		'text'  => __( "Relier l'expertise medicale, la prevention et les enjeux de sante au service de la communaute sapeur-pompier.", 'udsp31' ),
	),
);

$discover_missions = array(
	array(
		'icon'  => 'shield',
		'title' => __( 'Defendre et representer', 'udsp31' ),
		'text'  => __( 'Porter la voix des sapeurs-pompiers, des PATS, des anciens et des JSP a l echelle departementale.', 'udsp31' ),
	),
	array(
		'icon'  => 'handshake',
		'title' => __( 'Soutenir et federer', 'udsp31' ),
		'text'  => __( 'Entretenir les liens, le mutuel appui et la fraternite entre les femmes et les hommes engages au service des autres.', 'udsp31' ),
	),
	array(
		'icon'  => 'graduation',
		'title' => __( 'Transmettre et former', 'udsp31' ),
		'text'  => __( 'Contribuer a la formation des JSP et au developpement du secourisme pour le grand public.', 'udsp31' ),
	),
	array(
		'icon'  => 'heart',
		'title' => __( 'Accompagner les familles', 'udsp31' ),
		'text'  => __( 'Venir en aide a ses membres et a leurs proches lorsque la situation humaine ou sociale l exige.', 'udsp31' ),
	),
);

$discover_structure = array(
	array(
		'step'  => '01',
		'title' => __( 'CIS et SDIS', 'udsp31' ),
		'text'  => __( "Les Centres d'Incendie et de Secours relevent du SDIS pour tout ce qui concerne l'activite operationnelle, les interventions, les moyens et l'organisation du service.", 'udsp31' ),
	),
	array(
		'step'  => '02',
		'title' => __( 'Amicales', 'udsp31' ),
		'text'  => __( 'Dans les CIS, les amicales portent la vie associative locale: ceremonies, sports, anciens, loisirs, JSP et moments de cohesion.', 'udsp31' ),
	),
	array(
		'step'  => '03',
		'title' => __( 'UDSP 31', 'udsp31' ),
		'text'  => __( "L'Union Departementale rassemble ces energies a l'echelle de la Haute-Garonne et offre un cadre associatif structure aux activites menees en service ou hors service.", 'udsp31' ),
	),
	array(
		'step'  => '04',
		'title' => __( 'Reseau national', 'udsp31' ),
		'text'  => __( 'Les unions departementales s inscrivent ensuite dans un reseau regional puis national avec la FNSPF, pour porter la voix des sapeurs-pompiers a tous les niveaux.', 'udsp31' ),
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
					<p class="discover-hero__lede"><?php esc_html_e( "Association loi 1901, l'UDSP 31 represente, defend et accompagne l'ensemble des sapeurs-pompiers de la Haute-Garonne, tout en faisant vivre les valeurs de solidarite, d'engagement et de service.", 'udsp31' ); ?></p>

					<div class="discover-hero__actions">
						<a class="button button--primary" href="#missions-udsp">
							<span><?php esc_html_e( 'Explorer nos missions', 'udsp31' ); ?></span>
							<span class="button__icon"><?php udsp31_the_icon( 'arrow' ); ?></span>
						</a>
						<a class="button button--secondary" href="#organisation-udsp">
							<span><?php esc_html_e( "Comprendre l'organisation", 'udsp31' ); ?></span>
						</a>
					</div>
				</div>

				<div class="discover-hero__media" aria-hidden="true">
					<figure class="discover-media-card discover-media-card--primary">
						<img src="<?php echo esc_url( udsp31_asset_url( 'assets/images/portrait-sapeuse.png' ) ); ?>" alt="" />
					</figure>
					<figure class="discover-media-card discover-media-card--secondary">
						<img src="<?php echo esc_url( udsp31_asset_url( 'assets/images/pompiers2.png' ) ); ?>" alt="" />
					</figure>
					<figure class="discover-media-card discover-media-card--tertiary">
						<img src="<?php echo esc_url( udsp31_asset_url( 'assets/images/JSP.png' ) ); ?>" alt="" />
					</figure>
				</div>
			</div>
		</section>

		<section class="section discover-section discover-section--story">
			<div class="container discover-story">
				<div class="discover-story__copy">
					<h2><?php esc_html_e( "L'UDSP 31, au coeur de la communaute sapeur-pompier", 'udsp31' ); ?></h2>
					<p><?php esc_html_e( "L'Union Departementale des Sapeurs-Pompiers de la Haute-Garonne, ou UDSP 31, est une association regie par la loi de 1901. Elle represente, defend et accompagne les sapeurs-pompiers du departement, dans un esprit de solidarite, d'engagement et de service.", 'udsp31' ); ?></p>
					<p><?php esc_html_e( "Elle rassemble les sapeurs-pompiers volontaires, professionnels, les jeunes sapeurs-pompiers et les anciens. A ce titre, elle joue un role de lien, de soutien et de cohesion entre les differentes composantes du monde sapeur-pompier en Haute-Garonne.", 'udsp31' ); ?></p>
					<p><?php esc_html_e( "Au-dela de sa mission de representation, l'UDSP 31 veille aux interets moraux de ses membres, encourage l'entraide, accompagne les familles lorsque cela est necessaire et joue egalement un role cle dans la formation au secourisme aupres du grand public.", 'udsp31' ); ?></p>
				</div>

				<aside class="discover-summary discover-summary--photo" aria-hidden="true">
					<figure class="discover-summary__photo">
						<img src="<?php echo esc_url( udsp31_asset_url( 'assets/images/JSP fille.png' ) ); ?>" alt="" />
					</figure>
				</aside>
			</div>
		</section>

		<section class="section section--quick-links discover-section discover-section--commissions" id="commissions">
			<div class="container">
				<div class="section-heading">
					<h2><?php esc_html_e( 'Une organisation au service des sapeurs-pompiers', 'udsp31' ); ?></h2>
					<p><?php esc_html_e( "Pour agir concretement sur le terrain, l'UDSP 31 s'appuie sur plusieurs commissions et domaines d'action qui repondent aux besoins reels du departement.", 'udsp31' ); ?></p>
				</div>

				<div class="discover-commission-grid">
					<?php foreach ( $discover_commissions as $commission ) : ?>
						<article class="discover-commission-card">
							<span class="info-card__icon"><?php udsp31_the_icon( $commission['icon'] ); ?></span>
							<h3><?php echo esc_html( $commission['title'] ); ?></h3>
							<p><?php echo esc_html( $commission['text'] ); ?></p>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<section class="section discover-section" id="missions-udsp">
			<div class="container">
				<div class="section-heading discover-section-heading">
					<h2><?php esc_html_e( 'Des missions au service des sapeurs-pompiers et de la population', 'udsp31' ); ?></h2>
					<p><?php esc_html_e( "L'UDSP 31 defend d'abord les interets des sapeurs-pompiers et contribue a preserver leurs valeurs. Elle renforce aussi les liens entre les personnels, en creant des espaces d'echange, de soutien et de fraternite.", 'udsp31' ); ?></p>
				</div>

				<div class="discover-impact__copy discover-impact__copy--full">
					<p><?php esc_html_e( "Elle joue un role fort dans la transmission et la formation, avec l'enseignement du secourisme pour le grand public, le soutien au developpement des JSP et l'accompagnement des activites physiques et sportives qui nourrissent la cohesion et le depassement de soi.", 'udsp31' ); ?></p>
					<p><?php esc_html_e( "Sur le plan humain, elle peut venir en aide a ses membres et a leurs familles. Par ses actions de terrain, sa communication et ses evenements, elle participe aussi au rayonnement des sapeurs-pompiers aupres du public.", 'udsp31' ); ?></p>

					<ul class="discover-feature-list">
						<?php foreach ( $discover_missions as $mission ) : ?>
							<li>
								<span class="value-list__icon"><?php udsp31_the_icon( $mission['icon'] ); ?></span>
								<div>
									<strong><?php echo esc_html( $mission['title'] ); ?></strong>
									<p><?php echo esc_html( $mission['text'] ); ?></p>
								</div>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</section>

		<section class="section section--stats discover-section" id="organisation-udsp">
			<div class="container">
				<div class="section-heading">
					<h2><?php esc_html_e( "L'UDSP 31 dans l'organisation sapeur-pompier", 'udsp31' ); ?></h2>
					<p><?php esc_html_e( "L'action operationnelle releve du SDIS et des CIS. En parallele, l'UDSP 31 structure la vie associative, relie les amicales et s'inscrit dans un reseau regional et national plus large.", 'udsp31' ); ?></p>
				</div>

				<div class="discover-flow">
					<?php foreach ( $discover_structure as $item ) : ?>
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
					<img src="<?php echo esc_url( udsp31_asset_url( 'assets/images/JSP.png' ) ); ?>" alt="" />
					<img src="<?php echo esc_url( udsp31_asset_url( 'assets/images/pompiers2.png' ) ); ?>" alt="" />
				</div>

				<div class="discover-closing__copy">
					<span class="section-kicker"><?php esc_html_e( 'Une association ancree dans le departement', 'udsp31' ); ?></span>
					<h2><?php esc_html_e( 'Faire le lien, accompagner et faire rayonner', 'udsp31' ); ?></h2>
					<p><?php esc_html_e( "Par son action quotidienne, l'UDSP 31 occupe une place importante dans la vie des sapeurs-pompiers de la Haute-Garonne. Elle fait le lien entre les generations, accompagne les personnels, soutient les familles, developpe le secourisme et valorise le sport et l'engagement associatif.", 'udsp31' ); ?></p>
					<p><?php esc_html_e( "Au-dela de son role administratif ou associatif, elle incarne surtout une communaute soudee, attachee a ses valeurs et pleinement engagee au service du territoire.", 'udsp31' ); ?></p>

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
