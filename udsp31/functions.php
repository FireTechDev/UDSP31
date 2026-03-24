<?php
/**
 * UDSP31 theme functions.
 *
 * @package UDSP31
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'udsp31_setup' ) ) {
	/**
	 * Configure theme supports and menus.
	 *
	 * @return void
	 */
	function udsp31_setup() {
		load_theme_textdomain( 'udsp31', get_template_directory() . '/languages' );

		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 72,
				'width'       => 72,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'align-wide' );

		register_nav_menus(
			array(
				'primary' => __( 'Menu principal', 'udsp31' ),
				'footer'  => __( 'Liens rapides du footer', 'udsp31' ),
				'legal'   => __( 'Menu legal du footer', 'udsp31' ),
			)
		);
	}
}
add_action( 'after_setup_theme', 'udsp31_setup' );

/**
 * Enqueue theme assets.
 *
 * @return void
 */
function udsp31_scripts() {
	$style_path  = get_stylesheet_directory() . '/style.css';
	$script_path = get_template_directory() . '/assets/js/theme.js';
	$style_ver   = file_exists( $style_path ) ? (string) filemtime( $style_path ) : wp_get_theme()->get( 'Version' );
	$script_ver  = file_exists( $script_path ) ? (string) filemtime( $script_path ) : wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'udsp31-style', get_stylesheet_uri(), array(), $style_ver );
	wp_enqueue_script(
		'udsp31-script',
		get_template_directory_uri() . '/assets/js/theme.js',
		array(),
		$script_ver,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'udsp31_scripts' );

/**
 * Return a theme asset URL.
 *
 * @param string $path Relative path.
 * @return string
 */
function udsp31_asset_url( $path ) {
	return trailingslashit( get_template_directory_uri() ) . ltrim( $path, '/' );
}

/**
 * Classify a logo shape from its dimensions.
 *
 * @param int $width  Logo width.
 * @param int $height Logo height.
 * @return string
 */
function udsp31_get_logo_shape( $width, $height ) {
	$width  = max( 1, (int) $width );
	$height = max( 1, (int) $height );
	$ratio  = $width / $height;

	if ( $ratio >= 2.2 ) {
		return 'wide';
	}

	if ( $ratio <= 1.2 ) {
		return 'stacked';
	}

	return 'standard';
}

/**
 * Detect the color variant encoded in a logo filename.
 *
 * @param string $file_name Logo file name.
 * @return string
 */
function udsp31_get_logo_variant_key( $file_name ) {
	$file_name = strtolower( (string) $file_name );

	if ( preg_match( '/(?:white|blanc|light|clear)/', $file_name ) ) {
		return 'light';
	}

	if ( preg_match( '/(?:blue|bleu|navy|dark)/', $file_name ) ) {
		return 'default';
	}

	return 'default';
}

/**
 * Build logo metadata from a local file path and public URL.
 *
 * @param string $path File path.
 * @param string $url  File URL.
 * @return array<string, mixed>
 */
function udsp31_build_logo_data( $path, $url ) {
	$size      = @getimagesize( $path );
	$width     = ! empty( $size[0] ) ? (int) $size[0] : 0;
	$height    = ! empty( $size[1] ) ? (int) $size[1] : 0;
	$file_name = wp_basename( $path );

	return array(
		'url'     => $url,
		'width'   => $width,
		'height'  => $height,
		'shape'   => udsp31_get_logo_shape( $width, $height ),
		'variant' => udsp31_get_logo_variant_key( $file_name ),
		'source'  => 'bundled',
		'name'    => $file_name,
	);
}

/**
 * Return available bundled logos indexed by variant.
 *
 * @return array<string, array<string, mixed>>
 */
function udsp31_get_bundled_logos() {
	static $logos = null;

	if ( null !== $logos ) {
		return $logos;
	}

	$logos    = array();
	$patterns = array(
		get_template_directory() . '/assets/images/*UDSP31*',
		get_template_directory() . '/assets/images/*udsp31*',
	);

	foreach ( $patterns as $pattern ) {
		$matches = glob( $pattern );

		if ( empty( $matches ) ) {
			continue;
		}

		sort( $matches );

		foreach ( $matches as $path ) {
			if ( ! is_file( $path ) ) {
				continue;
			}

			$extension = strtolower( pathinfo( $path, PATHINFO_EXTENSION ) );

			if ( ! in_array( $extension, array( 'png', 'jpg', 'jpeg', 'webp', 'svg' ), true ) ) {
				continue;
			}

			$file_name = wp_basename( $path );
			$variant   = udsp31_get_logo_variant_key( $file_name );
			$url       = trailingslashit( get_template_directory_uri() ) . 'assets/images/' . rawurlencode( $file_name );

			if ( ! isset( $logos[ $variant ] ) ) {
				$logos[ $variant ] = udsp31_build_logo_data( $path, $url );
			}
		}
	}

	if ( empty( $logos['default'] ) && file_exists( get_template_directory() . '/assets/images/logo-header.png' ) ) {
		$path             = get_template_directory() . '/assets/images/logo-header.png';
		$logos['default'] = udsp31_build_logo_data( $path, udsp31_asset_url( 'assets/images/logo-header.png' ) );
		$logos['default']['source'] = 'legacy';
	}

	if ( empty( $logos['light'] ) && file_exists( get_template_directory() . '/assets/images/logo-footer.png' ) ) {
		$path           = get_template_directory() . '/assets/images/logo-footer.png';
		$logos['light'] = udsp31_build_logo_data( $path, udsp31_asset_url( 'assets/images/logo-footer.png' ) );
		$logos['light']['source'] = 'legacy';
	}

	return $logos;
}

/**
 * Return logo data for a given UI context.
 *
 * @param string $context light or dark background context.
 * @return array<string, mixed>
 */
function udsp31_get_logo_data( $context = 'light' ) {
	$custom_logo_id = (int) get_theme_mod( 'custom_logo' );

	if ( $custom_logo_id ) {
		$custom_logo = wp_get_attachment_image_src( $custom_logo_id, 'full' );

		if ( $custom_logo ) {
			return array(
				'url'    => $custom_logo[0],
				'width'  => (int) $custom_logo[1],
				'height' => (int) $custom_logo[2],
				'shape'  => udsp31_get_logo_shape( (int) $custom_logo[1], (int) $custom_logo[2] ),
				'variant'=> 'default',
				'source' => 'custom',
			);
		}
	}

	$logos = udsp31_get_bundled_logos();

	if ( 'dark' === $context ) {
		if ( ! empty( $logos['light'] ) ) {
			return $logos['light'];
		}

		if ( ! empty( $logos['default'] ) ) {
			return $logos['default'];
		}
	} else {
		if ( ! empty( $logos['default'] ) ) {
			return $logos['default'];
		}

		if ( ! empty( $logos['light'] ) ) {
			return $logos['light'];
		}
	}

	return array(
		'url'    => '',
		'width'  => 0,
		'height' => 0,
		'shape'  => 'standard',
		'variant'=> 'default',
		'source' => 'none',
	);
}

/**
 * Return a section URL anchored on the home page.
 *
 * @param string $section Section ID.
 * @return string
 */
function udsp31_section_url( $section ) {
	$hash = ltrim( (string) $section, '#' );

	if ( '' === $hash ) {
		return home_url( '/' );
	}

	return home_url( '/#' . $hash );
}

/**
 * Return inline SVG icons used by the theme.
 *
 * @param string $icon Icon key.
 * @return string
 */
function udsp31_get_icon( $icon ) {
	$icons = array(
		'phone'      => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M21 16.2v3a2 2 0 0 1-2.2 2A19.8 19.8 0 0 1 10.2 18a19.4 19.4 0 0 1-6-6A19.8 19.8 0 0 1 1 3.2 2 2 0 0 1 3 1h3a2 2 0 0 1 2 1.7l.5 3a2 2 0 0 1-.6 1.8L6.6 8.9a16 16 0 0 0 8.5 8.5l1.4-1.3a2 2 0 0 1 1.8-.6l3 .5A2 2 0 0 1 21 16.2Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
		'mail'       => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M4 5h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="m3 7 9 6 9-6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
		'arrow'      => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M5 12h14" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="m13 6 6 6-6 6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
		'heart'      => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="m12 20-1.4-1.3C5.4 14 2 10.9 2 7.1A4.8 4.8 0 0 1 6.8 2 5.2 5.2 0 0 1 12 5.1 5.2 5.2 0 0 1 17.2 2 4.8 4.8 0 0 1 22 7.1c0 3.8-3.4 6.9-8.6 11.6Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>',
		'shield'     => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M12 3 5 6v5c0 4.4 2.8 8.5 7 10 4.2-1.5 7-5.6 7-10V6l-7-3Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="m12 8 1.2 2.3 2.5.4-1.8 1.8.4 2.5-2.3-1.2-2.3 1.2.4-2.5-1.8-1.8 2.5-.4L12 8Z" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/></svg>',
		'graduation' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="m2 9.5 10-5 10 5-10 5-10-5Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M6 11.5V16c0 1.7 3 3 6 3s6-1.3 6-3v-4.5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M22 9.5v5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>',
		'users'      => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M16 21v-1.5A3.5 3.5 0 0 0 12.5 16H7.5A3.5 3.5 0 0 0 4 19.5V21" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><circle cx="10" cy="8" r="3" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="M20 21v-1.5A3.5 3.5 0 0 0 17.4 16.1" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M15.4 5.1a3 3 0 0 1 0 5.8" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>',
		'document'   => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M7 3h7l5 5v13a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M14 3v6h6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M9 13h6M9 17h6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>',
		'calendar'   => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><rect x="3" y="5" width="18" height="16" rx="2" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="M16 3v4M8 3v4M3 10h18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>',
		'clock'      => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="M12 7v5l3 2" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
		'location'   => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M12 21s7-4.8 7-11a7 7 0 1 0-14 0c0 6.2 7 11 7 11Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><circle cx="12" cy="10" r="2.5" fill="none" stroke="currentColor" stroke-width="1.8"/></svg>',
		'handshake'  => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M8 8 4.5 11.5a2 2 0 0 0 0 2.8l2.2 2.2a2 2 0 0 0 2.8 0l2.1-2.1" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><path d="m16 8 3.5 3.5a2 2 0 0 1 0 2.8l-2.2 2.2a2 2 0 0 1-2.8 0L12 14" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><path d="m9 11 2.2-2.2a2 2 0 0 1 2.8 0L16 11" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
	);

	return isset( $icons[ $icon ] ) ? $icons[ $icon ] : '';
}

/**
 * Echo a static SVG icon.
 *
 * @param string $icon Icon key.
 * @return void
 */
function udsp31_the_icon( $icon ) {
	$svg = udsp31_get_icon( $icon );

	if ( '' === $svg ) {
		return;
	}

	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Static SVG defined in the theme.
	echo $svg;
}

/**
 * Register Customizer settings for the homepage.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 * @return void
 */
function udsp31_customize_register( $wp_customize ) {
	$wp_customize->add_panel(
		'udsp31_options',
		array(
			'title'       => __( 'UDSP31', 'udsp31' ),
			'description' => __( 'Contenus principaux du theme.', 'udsp31' ),
			'priority'    => 30,
		)
	);

	$sections = array(
		'udsp31_contact' => array(
			'title'    => __( 'Coordonnees', 'udsp31' ),
			'priority' => 10,
		),
		'udsp31_hero'    => array(
			'title'    => __( 'Hero', 'udsp31' ),
			'priority' => 20,
		),
		'udsp31_social'  => array(
			'title'    => __( 'Reseaux sociaux', 'udsp31' ),
			'priority' => 30,
		),
	);

	foreach ( $sections as $section_id => $section_args ) {
		$wp_customize->add_section(
			$section_id,
			array(
				'title'    => $section_args['title'],
				'priority' => $section_args['priority'],
				'panel'    => 'udsp31_options',
			)
		);
	}

	$settings = array(
		'udsp31_brand_subtitle'    => array(
			'section'  => 'udsp31_contact',
			'label'    => __( 'Sous-titre de marque', 'udsp31' ),
			'default'  => __( 'Haute-Garonne', 'udsp31' ),
			'sanitize' => 'sanitize_text_field',
		),
		'udsp31_institution_line'  => array(
			'section'  => 'udsp31_contact',
			'label'    => __( 'Ligne institutionnelle', 'udsp31' ),
			'default'  => __( 'Union Departementale des Sapeurs-Pompiers de Haute-Garonne', 'udsp31' ),
			'sanitize' => 'sanitize_text_field',
		),
		'udsp31_phone'             => array(
			'section'  => 'udsp31_contact',
			'label'    => __( 'Telephone', 'udsp31' ),
			'default'  => '05 62 13 20 22',
			'sanitize' => 'sanitize_text_field',
		),
		'udsp31_email'             => array(
			'section'  => 'udsp31_contact',
			'label'    => __( 'Email', 'udsp31' ),
			'default'  => 'udsp31@gmail.com',
			'sanitize' => 'sanitize_email',
			'type'     => 'email',
		),
		'udsp31_hours'             => array(
			'section'  => 'udsp31_contact',
			'label'    => __( 'Horaires', 'udsp31' ),
			'default'  => '9h00 a 17h00',
			'sanitize' => 'sanitize_text_field',
		),
		'udsp31_address_line_1'    => array(
			'section'  => 'udsp31_contact',
			'label'    => __( 'Adresse ligne 1', 'udsp31' ),
			'default'  => __( '6 Bd Deodat de Severac', 'udsp31' ),
			'sanitize' => 'sanitize_text_field',
		),
		'udsp31_address_line_2'    => array(
			'section'  => 'udsp31_contact',
			'label'    => __( 'Adresse ligne 2', 'udsp31' ),
			'default'  => __( '31770 Colomiers', 'udsp31' ),
			'sanitize' => 'sanitize_text_field',
		),
		'udsp31_hero_badge'        => array(
			'section'  => 'udsp31_hero',
			'label'    => __( 'Badge du hero', 'udsp31' ),
			'default'  => __( 'Union Departementale des Sapeurs-Pompiers de la Haute-Garonne', 'udsp31' ),
			'sanitize' => 'sanitize_text_field',
		),
		'udsp31_hero_title'        => array(
			'section'  => 'udsp31_hero',
			'label'    => __( 'Titre du hero', 'udsp31' ),
			'default'  => __( 'Federer, soutenir et representer', 'udsp31' ),
			'sanitize' => 'sanitize_text_field',
		),
		'udsp31_hero_text'         => array(
			'section'  => 'udsp31_hero',
			'label'    => __( 'Texte du hero', 'udsp31' ),
			'default'  => __( "L'UDSP 31 accompagne les sapeurs-pompiers et propose des services de formation, prevention et securite pour le grand public, les entreprises et les collectivites.", 'udsp31' ),
			'sanitize' => 'sanitize_textarea_field',
			'type'     => 'textarea',
		),
		'udsp31_hero_primary_label' => array(
			'section'  => 'udsp31_hero',
			'label'    => __( 'Libelle du bouton principal', 'udsp31' ),
			'default'  => __( 'Demander une formation', 'udsp31' ),
			'sanitize' => 'sanitize_text_field',
		),
		'udsp31_hero_primary_url'  => array(
			'section'  => 'udsp31_hero',
			'label'    => __( 'Lien du bouton principal', 'udsp31' ),
			'default'  => udsp31_section_url( 'acces-rapides' ),
			'sanitize' => 'esc_url_raw',
			'type'     => 'url',
		),
		'udsp31_hero_secondary_label' => array(
			'section'  => 'udsp31_hero',
			'label'    => __( 'Libelle du bouton secondaire', 'udsp31' ),
			'default'  => __( 'Demander un DPS', 'udsp31' ),
			'sanitize' => 'sanitize_text_field',
		),
		'udsp31_hero_secondary_url' => array(
			'section'  => 'udsp31_hero',
			'label'    => __( 'Lien du bouton secondaire', 'udsp31' ),
			'default'  => udsp31_section_url( 'acces-rapides' ),
			'sanitize' => 'esc_url_raw',
			'type'     => 'url',
		),
		'udsp31_hero_tertiary_label' => array(
			'section'  => 'udsp31_hero',
			'label'    => __( 'Libelle du bouton tertiaire', 'udsp31' ),
			'default'  => __( "S'informer sur les JSP", 'udsp31' ),
			'sanitize' => 'sanitize_text_field',
		),
		'udsp31_hero_tertiary_url' => array(
			'section'  => 'udsp31_hero',
			'label'    => __( 'Lien du bouton tertiaire', 'udsp31' ),
			'default'  => udsp31_section_url( 'engagement' ),
			'sanitize' => 'esc_url_raw',
			'type'     => 'url',
		),
		'udsp31_facebook_url'      => array(
			'section'  => 'udsp31_social',
			'label'    => __( 'Facebook', 'udsp31' ),
			'default'  => '',
			'sanitize' => 'esc_url_raw',
			'type'     => 'url',
		),
		'udsp31_instagram_url'     => array(
			'section'  => 'udsp31_social',
			'label'    => __( 'Instagram', 'udsp31' ),
			'default'  => '',
			'sanitize' => 'esc_url_raw',
			'type'     => 'url',
		),
		'udsp31_linkedin_url'      => array(
			'section'  => 'udsp31_social',
			'label'    => __( 'LinkedIn', 'udsp31' ),
			'default'  => '',
			'sanitize' => 'esc_url_raw',
			'type'     => 'url',
		),
		'udsp31_youtube_url'       => array(
			'section'  => 'udsp31_social',
			'label'    => __( 'YouTube', 'udsp31' ),
			'default'  => '',
			'sanitize' => 'esc_url_raw',
			'type'     => 'url',
		),
	);

	foreach ( $settings as $setting_id => $setting_args ) {
		$wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => $setting_args['default'],
				'sanitize_callback' => $setting_args['sanitize'],
			)
		);

		$wp_customize->add_control(
			$setting_id,
			array(
				'label'   => $setting_args['label'],
				'section' => $setting_args['section'],
				'type'    => isset( $setting_args['type'] ) ? $setting_args['type'] : 'text',
			)
		);
	}
}
add_action( 'customize_register', 'udsp31_customize_register' );
