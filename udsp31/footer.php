<?php
/**
 * Theme footer.
 *
 * @package UDSP31
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$brand_subtitle = get_theme_mod( 'udsp31_brand_subtitle', __( 'Haute-Garonne', 'udsp31' ) );
$site_name      = get_bloginfo( 'name' );
$site_title     = $site_name ? $site_name : 'UDSP 31';
$address_line_1 = get_theme_mod( 'udsp31_address_line_1', __( '6 Bd Deodat de Severac', 'udsp31' ) );
$address_line_2 = get_theme_mod( 'udsp31_address_line_2', __( '31770 Colomiers', 'udsp31' ) );
$phone          = get_theme_mod( 'udsp31_phone', '05 62 13 20 22' );
$phone_href     = preg_replace( '/[^0-9+]/', '', $phone );
$email          = sanitize_email( get_theme_mod( 'udsp31_email', 'udsp31@gmail.com' ) );
$hours          = get_theme_mod( 'udsp31_hours', '9h00 a 17h00' );
$logo_data      = udsp31_get_logo_data( 'dark' );
$logo_url       = ! empty( $logo_data['url'] ) ? $logo_data['url'] : '';
$logo_shape     = ! empty( $logo_data['shape'] ) ? $logo_data['shape'] : 'standard';
$brand_classes  = 'brand brand--footer brand--logo-' . sanitize_html_class( $logo_shape );
$show_identity  = ! has_custom_logo() && ! $logo_url;
$facebook_url   = get_theme_mod( 'udsp31_facebook_url', 'https://www.facebook.com/UDSP31' );
$discover_url   = udsp31_get_discover_url();
$news_url       = udsp31_get_news_archive_url();
$contact_url    = udsp31_get_content_page_url( 'contact' );
$formation_url  = udsp31_get_content_page_url( 'formation-secourisme' );
$dps_url        = udsp31_get_content_page_url( 'dispositif-previsionnel-de-secours' );
$jsp_url        = udsp31_get_content_page_url( 'jeunes-sapeurs-pompiers' );
$legal_url      = udsp31_get_content_page_url( 'mentions-legales' );
$cookies_url    = udsp31_get_content_page_url( 'cookies' );
?>

<footer class="site-footer" id="site-footer-contact">
	<div class="container footer-grid">
		<div class="footer-column footer-column--brand">
			<div class="<?php echo esc_attr( $brand_classes ); ?>">
				<?php if ( has_custom_logo() ) : ?>
					<div class="brand__logo"><?php the_custom_logo(); ?></div>
				<?php elseif ( $logo_url ) : ?>
					<a class="brand__logo brand__logo--fallback" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'Retour a l accueil', 'udsp31' ); ?>">
						<img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( $site_title ); ?>" />
					</a>
				<?php else : ?>
					<a class="brand__badge" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'Retour a l accueil', 'udsp31' ); ?>">SP</a>
				<?php endif; ?>

				<?php if ( $show_identity ) : ?>
					<a class="brand__identity" href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<strong><?php echo esc_html( $site_title ); ?></strong>
						<span><?php echo esc_html( $brand_subtitle ); ?></span>
					</a>
				<?php endif; ?>
			</div>

			<p class="footer-about">
				<?php esc_html_e( 'Union Departementale des Sapeurs-Pompiers de Haute-Garonne, au service de la population et des sapeurs-pompiers du departement.', 'udsp31' ); ?>
			</p>

		</div>

		<div class="footer-column">
			<h2><?php esc_html_e( 'Liens rapides', 'udsp31' ); ?></h2>
			<?php if ( has_nav_menu( 'footer' ) ) : ?>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => false,
						'menu_class'     => 'footer-links',
						'depth'          => 1,
					)
				);
				?>
			<?php else : ?>
				<ul class="footer-links">
					<li><a href="<?php echo esc_url( $discover_url ); ?>"><?php esc_html_e( "L'UDSP31", 'udsp31' ); ?></a></li>
					<li><a href="<?php echo esc_url( $news_url ); ?>"><?php esc_html_e( 'Actualites', 'udsp31' ); ?></a></li>
					<li><a href="<?php echo esc_url( $contact_url ); ?>"><?php esc_html_e( 'Contact', 'udsp31' ); ?></a></li>
					<?php if ( $facebook_url ) : ?>
						<li><a href="<?php echo esc_url( $facebook_url ); ?>" target="_blank" rel="noreferrer noopener"><?php esc_html_e( 'Nous suivre sur Facebook', 'udsp31' ); ?></a></li>
					<?php endif; ?>
				</ul>
			<?php endif; ?>
		</div>

		<div class="footer-column">
			<h2><?php esc_html_e( 'Nos services', 'udsp31' ); ?></h2>
			<ul class="footer-links">
				<li><a href="<?php echo esc_url( $formation_url ); ?>"><?php esc_html_e( 'Formation secourisme', 'udsp31' ); ?></a></li>
				<li><a href="<?php echo esc_url( $dps_url ); ?>"><?php esc_html_e( 'Dispositif previsionnel de secours', 'udsp31' ); ?></a></li>
				<li><a href="<?php echo esc_url( $jsp_url ); ?>"><?php esc_html_e( 'Jeunes Sapeurs-Pompiers', 'udsp31' ); ?></a></li>
			</ul>
		</div>

		<div class="footer-column">
			<h2><?php esc_html_e( 'Contact', 'udsp31' ); ?></h2>
			<ul class="footer-contact-list">
				<li>
					<span class="icon-wrap"><?php udsp31_the_icon( 'location' ); ?></span>
					<span><?php echo esc_html( $address_line_1 ); ?><br /><?php echo esc_html( $address_line_2 ); ?></span>
				</li>
				<?php if ( $phone ) : ?>
					<li>
						<span class="icon-wrap"><?php udsp31_the_icon( 'phone' ); ?></span>
						<a href="<?php echo esc_url( 'tel:' . $phone_href ); ?>"><?php echo esc_html( $phone ); ?></a>
					</li>
				<?php endif; ?>
				<?php if ( $email ) : ?>
					<li>
						<span class="icon-wrap"><?php udsp31_the_icon( 'mail' ); ?></span>
						<a href="<?php echo esc_url( 'mailto:' . $email ); ?>"><?php echo esc_html( $email ); ?></a>
					</li>
				<?php endif; ?>
				<?php if ( $hours ) : ?>
					<li>
						<span class="icon-wrap"><?php udsp31_the_icon( 'clock' ); ?></span>
						<span><?php echo esc_html( $hours ); ?></span>
					</li>
				<?php endif; ?>
			</ul>
		</div>
	</div>

	<div class="footer-bottom">
		<div class="container footer-bottom__inner">
			<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> UDSP 31 - R&eacute;alisation <a href="https://www.linkedin.com/in/taelpinault/?locale=fr" target="_blank" rel="noreferrer noopener">Tael PINAULT</a></p>

			<?php if ( has_nav_menu( 'legal' ) ) : ?>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'legal',
						'container'      => false,
						'menu_class'     => 'legal-links',
						'depth'          => 1,
					)
				);
				?>
			<?php else : ?>
				<ul class="legal-links">
					<li><a href="<?php echo esc_url( $legal_url ); ?>"><?php esc_html_e( 'Mentions legales', 'udsp31' ); ?></a></li>
					<li><a href="<?php echo esc_url( $cookies_url ); ?>"><?php esc_html_e( 'Cookies', 'udsp31' ); ?></a></li>
				</ul>
			<?php endif; ?>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
