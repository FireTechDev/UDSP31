<?php
/**
 * 404 template.
 *
 * @package UDSP31
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$news_archive_url = udsp31_get_news_archive_url();
?>

<main id="primary" class="site-main site-main--page">
	<section class="page-hero">
		<div class="container">
			<span class="section-kicker">404</span>
			<h1><?php esc_html_e( 'Page introuvable', 'udsp31' ); ?></h1>
			<p><?php esc_html_e( "Le contenu demande n'existe pas ou plus.", 'udsp31' ); ?></p>
		</div>
	</section>

	<section class="section">
		<div class="container empty-state">
			<p><?php esc_html_e( "Vous pouvez revenir a l'accueil ou consulter les dernieres actualites.", 'udsp31' ); ?></p>
			<div class="hero-actions">
				<a class="button button--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<span><?php esc_html_e( "Retour a l'accueil", 'udsp31' ); ?></span>
				</a>
				<a class="button button--secondary" href="<?php echo esc_url( $news_archive_url ); ?>">
					<span><?php esc_html_e( 'Voir les actualites', 'udsp31' ); ?></span>
				</a>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
