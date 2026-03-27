<?php
/**
 * Theme header.
 *
 * @package UDSP31
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$phone           = get_theme_mod( 'udsp31_phone', '05 62 13 20 22' );
$phone_href      = preg_replace( '/[^0-9+]/', '', $phone );
$email           = sanitize_email( get_theme_mod( 'udsp31_email', 'udsp31@gmail.com' ) );
$institution     = get_theme_mod( 'udsp31_institution_line', __( 'Union Departementale des Sapeurs-Pompiers de Haute-Garonne', 'udsp31' ) );
$brand_subtitle  = get_theme_mod( 'udsp31_brand_subtitle', __( 'Haute-Garonne', 'udsp31' ) );
$site_name       = get_bloginfo( 'name' );
$displayed_title = $site_name ? $site_name : 'UDSP 31';
$logo_data       = udsp31_get_logo_data( 'light' );
$logo_url        = ! empty( $logo_data['url'] ) ? $logo_data['url'] : '';
$logo_shape      = ! empty( $logo_data['shape'] ) ? $logo_data['shape'] : 'standard';
$brand_classes   = 'brand brand--logo-' . sanitize_html_class( $logo_shape );
$show_identity   = ! has_custom_logo() && ! $logo_url;
$discover_url    = udsp31_get_discover_url();
$executive_url   = udsp31_get_executive_url();
$commissions_url = udsp31_get_content_page_url( 'les-commissions' );
$secourisme_url  = udsp31_get_content_page_url( 'secourisme' );
$jsp_commission_url = udsp31_get_content_page_url( 'jeunes-sapeurs-pompiers' );
$spv_url         = udsp31_get_content_page_url( 'sapeurs-pompiers-volontaires' );
$spp_url         = udsp31_get_content_page_url( 'sapeurs-pompiers-professionnels' );
$sssm_url        = udsp31_get_content_page_url( 'service-de-sante-et-de-secours-medical' );
$dps_url         = udsp31_get_content_page_url( 'dispositif-previsionnel-de-secours' );
$social_url      = udsp31_get_content_page_url( 'social' );
$sport_url       = udsp31_get_content_page_url( 'sport' );
$asp_url         = udsp31_get_content_page_url( 'anciens-sapeurs-pompiers' );
$services_url    = udsp31_get_content_page_url( 'nos-services' );
$formation_url   = udsp31_get_content_page_url( 'formation-secourisme' );
$recruitment_landing_url = udsp31_get_content_page_url( 'devenir-pompier' );
$volunteer_url   = udsp31_get_recruitment_url( 'devenir-pompier-volontaire' );
$professional_url = udsp31_get_recruitment_url( 'devenir-pompier-professionel' );
$jsp_url         = udsp31_get_recruitment_url( 'devenir-jeune-sapeur-pompier' );
$se_former_url   = $formation_url;
$is_home         = is_front_page();
$is_discover     = is_page( 'decouvrir-ludsp31' );
$is_executive    = is_page( 'le-bureau-executif' );
$is_commissions  = is_page(
	array(
		'les-commissions',
		'secourisme',
		'jeunes-sapeurs-pompiers',
		'sapeurs-pompiers-volontaires',
		'sapeurs-pompiers-professionnels',
		'service-de-sante-et-de-secours-medical',
		'dispositif-previsionnel-de-secours',
		'social',
		'sport',
		'anciens-sapeurs-pompiers',
	)
);
$is_services     = is_page(
	array(
		'nos-services',
		'formation-secourisme',
		'dispositif-previsionnel-de-secours',
	)
);
$is_recruitment_landing = is_page( 'devenir-pompier' );
$is_volunteer    = is_page( 'devenir-pompier-volontaire' );
$is_professional = is_page( 'devenir-pompier-professionel' );
$is_jsp_page     = is_page( 'devenir-jeune-sapeur-pompier' );
$is_recruitment  = $is_recruitment_landing || $is_volunteer || $is_professional || $is_jsp_page;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" id="top">
	<div class="topbar">
		<div class="container topbar__inner">
			<div class="topbar__contacts">
				<?php if ( $phone ) : ?>
					<a href="<?php echo esc_url( 'tel:' . $phone_href ); ?>" class="topbar__link">
						<span class="icon-wrap"><?php udsp31_the_icon( 'phone' ); ?></span>
						<span><?php echo esc_html( $phone ); ?></span>
					</a>
				<?php endif; ?>

				<?php if ( $email ) : ?>
					<a href="<?php echo esc_url( 'mailto:' . $email ); ?>" class="topbar__link">
						<span class="icon-wrap"><?php udsp31_the_icon( 'mail' ); ?></span>
						<span><?php echo esc_html( $email ); ?></span>
					</a>
				<?php endif; ?>
			</div>

			<p class="topbar__title"><?php echo esc_html( $institution ); ?></p>
		</div>
	</div>

	<div class="header-shell">
		<div class="container header-shell__inner">
			<div class="<?php echo esc_attr( $brand_classes ); ?>">
				<?php if ( has_custom_logo() ) : ?>
					<div class="brand__logo"><?php the_custom_logo(); ?></div>
				<?php elseif ( $logo_url ) : ?>
					<a class="brand__logo brand__logo--fallback" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'Retour a l accueil', 'udsp31' ); ?>">
						<img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( $displayed_title ); ?>" />
					</a>
				<?php else : ?>
					<a class="brand__badge" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'Retour a l accueil', 'udsp31' ); ?>">SP</a>
				<?php endif; ?>

				<?php if ( $show_identity ) : ?>
					<a class="brand__identity" href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<strong><?php echo esc_html( $displayed_title ); ?></strong>
						<span><?php echo esc_html( $brand_subtitle ); ?></span>
					</a>
				<?php endif; ?>
			</div>

			<button class="nav-toggle" type="button" aria-expanded="false" aria-controls="site-navigation">
				<span></span>
				<span></span>
				<span></span>
				<span class="screen-reader-text"><?php esc_html_e( 'Ouvrir le menu', 'udsp31' ); ?></span>
			</button>

			<nav class="site-navigation" id="site-navigation" aria-label="<?php esc_attr_e( 'Navigation principale', 'udsp31' ); ?>">
				<?php if ( has_nav_menu( 'primary' ) ) : ?>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'container'      => false,
							'menu_class'     => 'primary-menu',
							'depth'          => 2,
						)
					);
					?>
				<?php else : ?>
					<ul class="primary-menu">
						<li class="<?php echo $is_home ? 'current-menu-item' : ''; ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Accueil', 'udsp31' ); ?></a></li>
						<li class="menu-item-has-children <?php echo ( $is_discover || $is_executive ) ? 'current-menu-item' : ''; ?>">
							<a href="<?php echo esc_url( $discover_url ); ?>"><?php esc_html_e( "L'UDSP31", 'udsp31' ); ?></a>
							<ul class="sub-menu">
								<li class="<?php echo $is_discover ? 'current-menu-item' : ''; ?>"><a href="<?php echo esc_url( $discover_url ); ?>"><?php esc_html_e( "Decouvrir l'UDSP 31", 'udsp31' ); ?></a></li>
								<li class="<?php echo $is_executive ? 'current-menu-item' : ''; ?>"><a href="<?php echo esc_url( $executive_url ); ?>"><?php esc_html_e( 'Le bureau executif', 'udsp31' ); ?></a></li>
							</ul>
						</li>
						<li class="menu-item-has-children <?php echo $is_commissions ? 'current-menu-item' : ''; ?>">
							<a href="<?php echo esc_url( $commissions_url ); ?>"><?php esc_html_e( 'Les commissions', 'udsp31' ); ?></a>
							<ul class="sub-menu">
								<li class="<?php echo is_page( 'secourisme' ) ? 'current-menu-item' : ''; ?>"><a href="<?php echo esc_url( $secourisme_url ); ?>"><?php esc_html_e( 'Secourisme', 'udsp31' ); ?></a></li>
								<li class="<?php echo is_page( 'jeunes-sapeurs-pompiers' ) ? 'current-menu-item' : ''; ?>"><a href="<?php echo esc_url( $jsp_commission_url ); ?>"><?php esc_html_e( 'Jeunes Sapeurs-Pompiers', 'udsp31' ); ?></a></li>
								<li class="<?php echo is_page( 'sapeurs-pompiers-volontaires' ) ? 'current-menu-item' : ''; ?>"><a href="<?php echo esc_url( $spv_url ); ?>"><?php esc_html_e( 'Sapeurs-Pompiers volontaires', 'udsp31' ); ?></a></li>
								<li class="<?php echo is_page( 'sapeurs-pompiers-professionnels' ) ? 'current-menu-item' : ''; ?>"><a href="<?php echo esc_url( $spp_url ); ?>"><?php esc_html_e( 'Sapeurs-Pompiers professionnels', 'udsp31' ); ?></a></li>
								<li class="<?php echo is_page( 'service-de-sante-et-de-secours-medical' ) ? 'current-menu-item' : ''; ?>"><a href="<?php echo esc_url( $sssm_url ); ?>"><?php esc_html_e( 'Service de sante et de secours medical', 'udsp31' ); ?></a></li>
								<li class="<?php echo is_page( 'dispositif-previsionnel-de-secours' ) ? 'current-menu-item' : ''; ?>"><a href="<?php echo esc_url( $dps_url ); ?>"><?php esc_html_e( 'Dispositif previsionnel de secours', 'udsp31' ); ?></a></li>
								<li class="<?php echo is_page( 'social' ) ? 'current-menu-item' : ''; ?>"><a href="<?php echo esc_url( $social_url ); ?>"><?php esc_html_e( 'Social', 'udsp31' ); ?></a></li>
								<li class="<?php echo is_page( 'sport' ) ? 'current-menu-item' : ''; ?>"><a href="<?php echo esc_url( $sport_url ); ?>"><?php esc_html_e( 'Sport', 'udsp31' ); ?></a></li>
								<li class="<?php echo is_page( 'anciens-sapeurs-pompiers' ) ? 'current-menu-item' : ''; ?>"><a href="<?php echo esc_url( $asp_url ); ?>"><?php esc_html_e( 'Anciens Sapeurs-Pompiers', 'udsp31' ); ?></a></li>
							</ul>
						</li>
						<li class="menu-item-has-children <?php echo $is_services ? 'current-menu-item' : ''; ?>">
							<a href="<?php echo esc_url( $services_url ); ?>"><?php esc_html_e( 'Nos services', 'udsp31' ); ?></a>
							<ul class="sub-menu">
								<li class="<?php echo is_page( 'formation-secourisme' ) ? 'current-menu-item' : ''; ?>"><a href="<?php echo esc_url( $formation_url ); ?>"><?php esc_html_e( 'Formation', 'udsp31' ); ?></a></li>
								<li class="<?php echo is_page( 'dispositif-previsionnel-de-secours' ) ? 'current-menu-item' : ''; ?>"><a href="<?php echo esc_url( $dps_url ); ?>"><?php esc_html_e( 'Dispositif Previsionnel de Secours', 'udsp31' ); ?></a></li>
							</ul>
						</li>
						<li class="menu-item-has-children <?php echo $is_recruitment ? 'current-menu-item' : ''; ?>">
							<a href="<?php echo esc_url( $recruitment_landing_url ); ?>"><?php esc_html_e( 'Devenir pompier', 'udsp31' ); ?></a>
							<ul class="sub-menu">
								<li class="<?php echo $is_volunteer ? 'current-menu-item' : ''; ?>"><a href="<?php echo esc_url( $volunteer_url ); ?>"><?php esc_html_e( 'Devenir Pompier volontaire', 'udsp31' ); ?></a></li>
								<li class="<?php echo $is_professional ? 'current-menu-item' : ''; ?>"><a href="<?php echo esc_url( $professional_url ); ?>"><?php esc_html_e( 'Devenir Pompier Professionnel', 'udsp31' ); ?></a></li>
								<li class="<?php echo $is_jsp_page ? 'current-menu-item' : ''; ?>"><a href="<?php echo esc_url( $jsp_url ); ?>"><?php esc_html_e( 'Devenir Jeune Sapeur-Pompier', 'udsp31' ); ?></a></li>
							</ul>
						</li>
					</ul>
				<?php endif; ?>
			</nav>

			<a class="header-cta" href="<?php echo esc_url( $se_former_url ); ?>">
				<span><?php esc_html_e( 'Se former', 'udsp31' ); ?></span>
				<span class="button__icon" aria-hidden="true"><?php udsp31_the_icon( 'launch' ); ?></span>
			</a>
		</div>
	</div>
</header>
