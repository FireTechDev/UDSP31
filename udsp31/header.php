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
						<li class="current-menu-item"><a href="<?php echo esc_url( udsp31_section_url( 'top' ) ); ?>"><?php esc_html_e( 'Accueil', 'udsp31' ); ?></a></li>
						<li><a href="<?php echo esc_url( udsp31_section_url( 'engagement' ) ); ?>"><?php esc_html_e( "L'UDSP31", 'udsp31' ); ?></a></li>
						<li class="menu-item-has-children">
							<a href="<?php echo esc_url( udsp31_section_url( 'engagement' ) ); ?>"><?php esc_html_e( 'Commissions', 'udsp31' ); ?></a>
							<ul class="sub-menu">
								<li><a href="<?php echo esc_url( udsp31_section_url( 'missions' ) ); ?>"><?php esc_html_e( 'Secourime & formations', 'udsp31' ); ?></a></li>
								<li><a href="<?php echo esc_url( udsp31_section_url( 'engagement' ) ); ?>"><?php esc_html_e( 'Jeunes Sapeurs Pompiers', 'udsp31' ); ?></a></li>
								<li><a href="<?php echo esc_url( udsp31_section_url( 'engagement' ) ); ?>"><?php esc_html_e( 'Sapeurs pompiers volontaires', 'udsp31' ); ?></a></li>
								<li><a href="<?php echo esc_url( udsp31_section_url( 'engagement' ) ); ?>"><?php esc_html_e( 'Sapeurs pompiers professionnels', 'udsp31' ); ?></a></li>
								<li><a href="<?php echo esc_url( udsp31_section_url( 'engagement' ) ); ?>"><?php esc_html_e( '3SM', 'udsp31' ); ?></a></li>
								<li><a href="<?php echo esc_url( udsp31_section_url( 'acces-rapides' ) ); ?>"><?php esc_html_e( 'Dispositifs previsionnels de secours', 'udsp31' ); ?></a></li>
								<li><a href="<?php echo esc_url( udsp31_section_url( 'engagement' ) ); ?>"><?php esc_html_e( 'Social', 'udsp31' ); ?></a></li>
								<li><a href="<?php echo esc_url( udsp31_section_url( 'engagement' ) ); ?>"><?php esc_html_e( 'Sport', 'udsp31' ); ?></a></li>
								<li><a href="<?php echo esc_url( udsp31_section_url( 'engagement' ) ); ?>"><?php esc_html_e( 'Anciens sapeurs pompiers', 'udsp31' ); ?></a></li>
							</ul>
						</li>
						<li class="menu-item-has-children">
							<a href="<?php echo esc_url( udsp31_section_url( 'missions' ) ); ?>"><?php esc_html_e( 'Nos Services', 'udsp31' ); ?></a>
							<ul class="sub-menu">
								<li><a href="<?php echo esc_url( udsp31_section_url( 'missions' ) ); ?>"><?php esc_html_e( 'Formation', 'udsp31' ); ?></a></li>
								<li><a href="<?php echo esc_url( udsp31_section_url( 'acces-rapides' ) ); ?>"><?php esc_html_e( 'Dispositif Previsionnel de Secours', 'udsp31' ); ?></a></li>
								<li><a href="<?php echo esc_url( udsp31_section_url( 'engagement' ) ); ?>"><?php esc_html_e( 'Jeunes Sapeurs-Pompiers', 'udsp31' ); ?></a></li>
							</ul>
						</li>
						<li><a href="<?php echo esc_url( udsp31_section_url( 'engagement' ) ); ?>"><?php esc_html_e( 'Devenir pompier', 'udsp31' ); ?></a></li>
					</ul>
				<?php endif; ?>
			</nav>

			<a class="header-cta" href="<?php echo esc_url( udsp31_section_url( 'site-footer-contact' ) ); ?>">
				<?php esc_html_e( 'Nous contacter', 'udsp31' ); ?>
			</a>
		</div>
	</div>
</header>
