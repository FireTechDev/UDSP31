<?php
/**
 * Shared content page helpers.
 *
 * @package UDSP31
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load shared content page definitions.
 *
 * @return array<string, array<string, mixed>>
 */
function udsp31_get_content_pages() {
	static $pages = null;

	if ( null !== $pages ) {
		return $pages;
	}

	$data_path = get_template_directory() . '/assets/data/content-pages.json';

	if ( ! file_exists( $data_path ) ) {
		$pages = array();
		return $pages;
	}

	$contents = file_get_contents( $data_path ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
	$decoded  = json_decode( (string) $contents, true );

	$pages = is_array( $decoded ) ? $decoded : array();

	return $pages;
}

/**
 * Return one shared content page definition.
 *
 * @param string $slug Page slug.
 * @return array<string, mixed>|null
 */
function udsp31_get_content_page( $slug ) {
	$slug  = trim( (string) $slug );
	$pages = udsp31_get_content_pages();

	if ( '' === $slug || ! isset( $pages[ $slug ] ) || ! is_array( $pages[ $slug ] ) ) {
		return null;
	}

	return $pages[ $slug ];
}

/**
 * Determine whether a post uses the shared content page system.
 *
 * @param int|WP_Post|null $post Post object or ID.
 * @return bool
 */
function udsp31_is_content_page_post( $post = null ) {
	$post = get_post( $post );

	if ( ! $post instanceof WP_Post || 'page' !== $post->post_type ) {
		return false;
	}

	return null !== udsp31_get_content_page( $post->post_name );
}

/**
 * Return saved admin overrides for a shared content page.
 *
 * @param int $post_id Post ID.
 * @return array<string, mixed>
 */
function udsp31_get_content_page_override( $post_id ) {
	$override = get_post_meta( (int) $post_id, '_udsp31_content_page', true );

	return is_array( $override ) ? $override : array();
}

/**
 * Return the effective content page definition for a specific post.
 *
 * @param string   $slug    Page slug.
 * @param int|null $post_id Optional post ID.
 * @return array<string, mixed>|null
 */
function udsp31_get_content_page_for_post( $slug, $post_id = null ) {
	$page = udsp31_get_content_page( $slug );

	if ( null === $page ) {
		return null;
	}

	$post_id  = $post_id ? (int) $post_id : (int) get_the_ID();
	$override = $post_id ? udsp31_get_content_page_override( $post_id ) : array();

	if ( $override ) {
		$page = array_replace_recursive( $page, $override );
	}

	if ( 'devenir-pompier-volontaire' === $slug ) {
		$page['hero']['images'] = array(
			'spv-feu-vl.png',
			'spv-camion-photo.jpg',
			'spv-equipe.jpg',
		);
	}

	if ( 'social' === $slug ) {
		$page['hero']['images'] = array(
			'Social-stade enfants.png',
			'social-enfant.png',
			'spv-pompier volontaires.png',
		);
	}

	if ( 'sapeurs-pompiers-volontaires' === $slug ) {
		$page['hero']['images'] = array(
			'spv-feu-vl.png',
			'spv-camion-photo.jpg',
			'spv-equipe.jpg',
		);
	}

	return $page;
}

/**
 * Return a human-friendly admin label for a content page key.
 *
 * @param string|int $key Field key.
 * @return string
 */
function udsp31_get_content_page_field_label( $key ) {
	if ( is_int( $key ) || ctype_digit( (string) $key ) ) {
		return sprintf( __( 'Element %d', 'udsp31' ), (int) $key + 1 );
	}

	$labels = array(
		'nav_group'      => __( 'Groupe de navigation', 'udsp31' ),
		'title'          => __( 'Titre', 'udsp31' ),
		'description'    => __( 'Description', 'udsp31' ),
		'hero'           => __( 'Hero de page', 'udsp31' ),
		'lede'           => __( 'Texte d introduction', 'udsp31' ),
		'primary_cta'    => __( 'Bouton principal', 'udsp31' ),
		'secondary_cta'  => __( 'Bouton secondaire', 'udsp31' ),
		'label'          => __( 'Libelle', 'udsp31' ),
		'target'         => __( 'Lien ou cible', 'udsp31' ),
		'images'         => __( 'Images', 'udsp31' ),
		'story'          => __( 'Bloc introduction', 'udsp31' ),
		'paragraphs'     => __( 'Paragraphes', 'udsp31' ),
		'summary'        => __( 'Encart lateral', 'udsp31' ),
		'kicker'         => __( 'Sur-titre', 'udsp31' ),
		'text'           => __( 'Texte', 'udsp31' ),
		'items'          => __( 'Elements du resume', 'udsp31' ),
		'photo'          => __( 'Photo', 'udsp31' ),
		'gallery_section'=> __( 'Bloc photos', 'udsp31' ),
		'gallery_items'  => __( 'Photos', 'udsp31' ),
		'logo_section'   => __( 'Bloc logo', 'udsp31' ),
		'links_section'  => __( 'Bloc liens', 'udsp31' ),
		'links'          => __( 'Liens', 'udsp31' ),
		'image'          => __( 'Image', 'udsp31' ),
		'caption'        => __( 'Legende', 'udsp31' ),
		'link'           => __( 'Lien', 'udsp31' ),
		'cards_section'  => __( 'Bloc cartes', 'udsp31' ),
		'cards'          => __( 'Cartes', 'udsp31' ),
		'icon'           => __( 'Icone', 'udsp31' ),
		'id'             => __( 'Identifiant d ancre', 'udsp31' ),
		'intro'          => __( 'Introduction de section', 'udsp31' ),
		'feature_section'=> __( 'Bloc valeurs', 'udsp31' ),
		'features'       => __( 'Valeurs', 'udsp31' ),
		'flow_section'   => __( 'Bloc etapes', 'udsp31' ),
		'steps'          => __( 'Etapes', 'udsp31' ),
		'step'           => __( 'Numero', 'udsp31' ),
		'gallery'        => __( 'Galerie', 'udsp31' ),
	);

	if ( isset( $labels[ $key ] ) ) {
		return $labels[ $key ];
	}

	return ucwords( str_replace( '-', ' ', str_replace( '_', ' ', (string) $key ) ) );
}

/**
 * Check whether a key is reserved for internal editor state.
 *
 * @param string|int $key Field key.
 * @return bool
 */
function udsp31_is_content_page_internal_key( $key ) {
	return is_string( $key ) && 0 === strpos( $key, '_udsp31_' );
}

/**
 * Determine whether a top-level section supports visibility toggles.
 *
 * @param array<int, string|int> $path Field path.
 * @return bool
 */
function udsp31_content_page_section_supports_visibility( $path ) {
	$path = array_values(
		array_filter(
			(array) $path,
			static function ( $segment ) {
				return ! is_int( $segment ) && ! ctype_digit( (string) $segment );
			}
		)
	);

	return 1 === count( $path ) && ! in_array( $path[0], array( 'nav_group', 'title', 'description' ), true );
}

/**
 * Check whether a section is enabled for front-end display.
 *
 * @param array<string, mixed> $section Section data.
 * @return bool
 */
function udsp31_is_content_page_section_enabled( $section ) {
	if ( ! is_array( $section ) ) {
		return false;
	}

	if ( ! isset( $section['_udsp31_enabled'] ) ) {
		return true;
	}

	return ! in_array( $section['_udsp31_enabled'], array( false, 0, '0', '', null ), true );
}

/**
 * Check whether a content page field should be editable in admin.
 *
 * @param array<int, string|int> $path Field path.
 * @return bool
 */
function udsp31_is_content_page_field_editable( $path ) {
	$path = array_values(
		array_filter(
			(array) $path,
			static function ( $segment ) {
				return ! is_int( $segment ) && ! ctype_digit( (string) $segment );
			}
		)
	);

	if ( ! $path ) {
		return true;
	}

	$last = (string) end( $path );

	if ( udsp31_is_content_page_internal_key( $last ) ) {
		return false;
	}

	if ( in_array( $last, array( 'nav_group', 'description', 'id', 'icon', 'photo', 'image' ), true ) ) {
		return false;
	}

	if ( in_array( 'closing', $path, true ) ) {
		return false;
	}

	if ( in_array( 'images', $path, true ) || in_array( 'gallery', $path, true ) ) {
		return false;
	}

	return true;
}

/**
 * Check whether a content page field should use a textarea.
 *
 * @param array<int, string|int> $path Field path.
 * @return bool
 */
function udsp31_is_content_page_textarea_field( $path ) {
	$path = array_values(
		array_filter(
			(array) $path,
			static function ( $segment ) {
				return ! is_int( $segment ) && ! ctype_digit( (string) $segment );
			}
		)
	);

	if ( ! $path ) {
		return false;
	}

	$last = (string) end( $path );

	return in_array( $last, array( 'lede', 'text', 'intro', 'description' ), true ) || in_array( 'paragraphs', $path, true );
}

/**
 * Determine whether an array is associative.
 *
 * @param array<mixed> $value Value to inspect.
 * @return bool
 */
function udsp31_is_assoc_array( $value ) {
	if ( ! is_array( $value ) ) {
		return false;
	}

	return array_keys( $value ) !== range( 0, count( $value ) - 1 );
}

/**
 * Check whether a value tree contains at least one editable field.
 *
 * @param mixed                  $value Value tree.
 * @param array<int, string|int> $path  Field path.
 * @return bool
 */
function udsp31_content_page_has_editable_fields( $value, $path = array() ) {
	if ( ! is_array( $value ) ) {
		return udsp31_is_content_page_field_editable( $path );
	}

	foreach ( $value as $key => $child_value ) {
		if ( udsp31_content_page_has_editable_fields( $child_value, array_merge( $path, array( $key ) ) ) ) {
			return true;
		}
	}

	return false;
}

/**
 * Return a more useful label for list items in admin.
 *
 * @param array<int, string|int> $path Field path.
 * @param string                 $fallback Fallback label.
 * @return string
 */
function udsp31_get_content_page_item_label( $path, $fallback ) {
	$parent = '';

	foreach ( array_reverse( (array) $path ) as $segment ) {
		if ( ! is_int( $segment ) && ! ctype_digit( (string) $segment ) ) {
			$parent = (string) $segment;
			break;
		}
	}

	$index = 1;

	foreach ( array_reverse( (array) $path ) as $segment ) {
		if ( is_int( $segment ) || ctype_digit( (string) $segment ) ) {
			$index = (int) $segment + 1;
			break;
		}
	}

	$templates = array(
		'cards'         => __( 'Carte %d', 'udsp31' ),
		'steps'         => __( 'Etape %d', 'udsp31' ),
		'items'         => __( 'Point %d', 'udsp31' ),
		'features'      => __( 'Valeur %d', 'udsp31' ),
		'paragraphs'    => __( 'Paragraphe %d', 'udsp31' ),
		'images'        => __( 'Image %d', 'udsp31' ),
		'gallery'       => __( 'Image %d', 'udsp31' ),
		'gallery_items' => __( 'Photo %d', 'udsp31' ),
		'links'         => __( 'Lien %d', 'udsp31' ),
	);

	if ( isset( $templates[ $parent ] ) ) {
		return sprintf( $templates[ $parent ], $index );
	}

	return $fallback;
}

/**
 * Check whether a field path points to a specific indexed item.
 *
 * @param array<int, string|int> $path Field path.
 * @return bool
 */
function udsp31_content_page_path_has_index( $path ) {
	foreach ( (array) $path as $segment ) {
		if ( is_int( $segment ) || ctype_digit( (string) $segment ) ) {
			return true;
		}
	}

	return false;
}

/**
 * Return helper text for admin fields.
 *
 * @param array<int, string|int> $path Field path.
 * @return string
 */
function udsp31_get_content_page_field_help( $path ) {
	$path = array_values(
		array_filter(
			(array) $path,
			static function ( $segment ) {
				return ! is_int( $segment ) && ! ctype_digit( (string) $segment );
			}
		)
	);

	$last = $path ? (string) end( $path ) : '';

	if ( 'target' === $last ) {
		return __( 'Exemples : `page:contact`, `anchor:mon-ancre` ou une URL complete `https://...`.', 'udsp31' );
	}

	if ( 'lede' === $last ) {
		return __( 'Texte court affiche juste sous le titre principal.', 'udsp31' );
	}

	if ( 'intro' === $last ) {
		return __( 'Petit texte d introduction affiche sous le titre de section.', 'udsp31' );
	}

	return '';
}

/**
 * Sanitize submitted content page values.
 *
 * @param mixed                 $value Submitted value.
 * @param array<int, string|int> $path Field path.
 * @return mixed
 */
function udsp31_sanitize_content_page_value( $value, $path = array() ) {
	if ( is_array( $value ) ) {
		$sanitized = array();

		foreach ( $value as $key => $child_value ) {
			$sanitized[ $key ] = udsp31_sanitize_content_page_value( $child_value, array_merge( $path, array( $key ) ) );
		}

		return $sanitized;
	}

	$value = (string) $value;
	$path  = array_values(
		array_filter(
			(array) $path,
			static function ( $segment ) {
				return ! is_int( $segment ) && ! ctype_digit( (string) $segment );
			}
		)
	);
	$last  = $path ? (string) end( $path ) : '';

	if ( 'target' === $last ) {
		return preg_match( '#^https?://#i', $value ) ? esc_url_raw( $value ) : sanitize_text_field( $value );
	}

	if ( 'icon' === $last || 'nav_group' === $last ) {
		return sanitize_key( $value );
	}

	if ( 'id' === $last ) {
		return sanitize_title( $value );
	}

	if ( udsp31_is_content_page_textarea_field( $path ) ) {
		return sanitize_textarea_field( $value );
	}

	return sanitize_text_field( $value );
}

/**
 * Render one admin field group for a content page.
 *
 * @param string                $name  Input name.
 * @param mixed                 $value Field value.
 * @param array<int, string|int> $path Field path.
 * @param string                $label Field label.
 * @param int                   $depth Nesting depth.
 * @return void
 */
function udsp31_render_content_page_admin_field( $name, $value, $path = array(), $label = '', $depth = 0 ) {
	if ( is_array( $value ) ) {
		if ( ! udsp31_content_page_has_editable_fields( $value, $path ) ) {
			foreach ( $value as $key => $child_value ) {
				$child_label = udsp31_get_content_page_field_label( $key );
				$child_name  = $name . '[' . $key . ']';
				$child_path  = array_merge( $path, array( $key ) );

				udsp31_render_content_page_admin_field( $child_name, $child_value, $child_path, $child_label, $depth + 1 );
			}
			return;
		}

		$is_assoc = udsp31_is_assoc_array( $value );
		$classes  = array( 'udsp31-content-page-editor__group' );
		$title    = $label;

		if ( 0 === $depth ) {
			$classes[] = 'is-root';
		} elseif ( $is_assoc ) {
			$classes[] = 'is-object';
		} else {
			$classes[] = 'is-list';
		}

		if ( udsp31_content_page_path_has_index( $path ) ) {
			$title = udsp31_get_content_page_item_label( $path, $label );
		}

		if ( 0 === $depth ) {
			echo '<div class="' . esc_attr( implode( ' ', $classes ) ) . '">';
		} elseif ( 1 === $depth ) {
			echo '<details class="' . esc_attr( implode( ' ', $classes ) ) . '" open>';
			echo '<summary>' . esc_html( $title ) . '</summary>';
			echo '<div class="udsp31-content-page-editor__details-body">';

			if ( udsp31_content_page_section_supports_visibility( $path ) ) {
				$enabled_name = $name . '[_udsp31_enabled]';
				$is_enabled   = udsp31_is_content_page_section_enabled( $value );

				echo '<div class="udsp31-content-page-editor__toggle">';
				printf(
					'<input type="hidden" name="%1$s" value="0" />',
					esc_attr( $enabled_name )
				);
				printf(
					'<label><input type="checkbox" name="%1$s" value="1"%2$s /> %3$s</label>',
					esc_attr( $enabled_name ),
					checked( $is_enabled, true, false ),
					esc_html__( 'Afficher ce bloc sur la page', 'udsp31' )
				);
				echo '</div>';
			}
		} else {
			echo '<div class="' . esc_attr( implode( ' ', $classes ) ) . '">';
			if ( '' !== $title ) {
				echo '<h3>' . esc_html( $title ) . '</h3>';
			}
		}

		foreach ( $value as $key => $child_value ) {
			if ( udsp31_is_content_page_internal_key( $key ) ) {
				continue;
			}

			$child_label = udsp31_get_content_page_field_label( $key );
			$child_name  = $name . '[' . $key . ']';
			$child_path  = array_merge( $path, array( $key ) );

			udsp31_render_content_page_admin_field( $child_name, $child_value, $child_path, $child_label, $depth + 1 );
		}

		if ( 1 === $depth ) {
			echo '</div></details>';
		} else {
			echo '</div>';
		}

		return;
	}

	$editable = udsp31_is_content_page_field_editable( $path );

	if ( ! $editable ) {
		printf(
			'<input type="hidden" name="%1$s" value="%2$s" />',
			esc_attr( $name ),
			esc_attr( (string) $value )
		);
		return;
	}

	$textarea = udsp31_is_content_page_textarea_field( $path );

	echo '<div class="udsp31-content-page-editor__field">';
	echo '<label>';
	echo '<span>' . esc_html( $label ) . '</span>';

	if ( $textarea ) {
		printf(
			'<textarea name="%1$s" rows="4">%2$s</textarea>',
			esc_attr( $name ),
			esc_textarea( (string) $value )
		);
	} else {
		printf(
			'<input type="text" name="%1$s" value="%2$s" />',
			esc_attr( $name ),
			esc_attr( (string) $value )
		);
	}

	$help = udsp31_get_content_page_field_help( $path );

	if ( '' !== $help ) {
		echo '<small>' . esc_html( $help ) . '</small>';
	}

	echo '</label>';
	echo '</div>';
}

/**
 * Render the admin metabox for shared content pages.
 *
 * @param WP_Post $post Current post.
 * @return void
 */
function udsp31_render_content_page_metabox( $post ) {
	$page = udsp31_get_content_page_for_post( $post->post_name, $post->ID );

	if ( null === $page ) {
		echo '<p>' . esc_html__( 'Aucun contenu structure n est defini pour cette page.', 'udsp31' ) . '</p>';
		return;
	}

	wp_nonce_field( 'udsp31_save_content_page', 'udsp31_content_page_nonce' );
	?>
	<style>
		.udsp31-content-page-editor__intro {
			margin: 0 0 16px;
			color: #44546f;
			line-height: 1.5;
		}

		.udsp31-content-page-editor__group {
			margin: 0 0 18px;
			padding: 16px;
			border: 1px solid #d8dee8;
			border-radius: 10px;
			background: #fff;
		}

		.udsp31-content-page-editor__group.is-root {
			margin: 0;
			padding: 0;
			border: 0;
			background: transparent;
		}

		.udsp31-content-page-editor__group.is-object,
		.udsp31-content-page-editor__group.is-list {
			box-shadow: 0 1px 2px rgba(15, 23, 42, 0.04);
		}

		.udsp31-content-page-editor details > summary {
			cursor: pointer;
			font-weight: 700;
			font-size: 14px;
			margin: -16px;
			padding: 16px 18px;
			list-style: none;
		}

		.udsp31-content-page-editor details > summary::-webkit-details-marker {
			display: none;
		}

		.udsp31-content-page-editor details > summary::after {
			content: '+';
			float: right;
			font-size: 18px;
			line-height: 1;
			color: #5f6b7a;
		}

		.udsp31-content-page-editor details[open] > summary::after {
			content: '−';
		}

		.udsp31-content-page-editor__details-body {
			padding-top: 16px;
		}

		.udsp31-content-page-editor__group h3 {
			margin: 0 0 14px;
			font-size: 14px;
			color: #1d2327;
		}

		.udsp31-content-page-editor__group.is-list > h3,
		.udsp31-content-page-editor__group.is-object > h3 {
			padding-bottom: 10px;
			border-bottom: 1px solid #e7ebf0;
		}

		.udsp31-content-page-editor__field {
			margin: 0 0 12px;
		}

		.udsp31-content-page-editor__field:last-child {
			margin-bottom: 0;
		}

		.udsp31-content-page-editor__field span {
			display: block;
			margin: 0 0 6px;
			font-weight: 600;
		}

		.udsp31-content-page-editor__field input,
		.udsp31-content-page-editor__field textarea {
			width: 100%;
			border-color: #c9d1db;
		}

		.udsp31-content-page-editor__field small {
			display: block;
			margin-top: 6px;
			color: #5f6b7a;
			line-height: 1.4;
		}

		.udsp31-content-page-editor__toggle {
			margin: 0 0 16px;
			padding: 12px 14px;
			border: 1px solid #d8dee8;
			border-radius: 8px;
			background: #f8fafc;
		}

		.udsp31-content-page-editor__toggle label {
			display: flex;
			align-items: center;
			gap: 8px;
			font-weight: 600;
		}

		.udsp31-content-page-editor__toggle input[type="checkbox"] {
			margin: 0;
		}

		.udsp31-content-page-editor__legend {
			margin: 0 0 18px;
			padding: 12px 14px;
			border-left: 4px solid #2271b1;
			background: #f6fbff;
			color: #334155;
		}
	</style>
	<p class="udsp31-content-page-editor__intro">
		<?php esc_html_e( 'Modifie ici les textes et les liens de la page sans toucher au code ni a la mise en page.', 'udsp31' ); ?>
	</p>
	<div class="udsp31-content-page-editor__legend">
		<?php esc_html_e( 'Les images, les icones et certains reglages techniques restent geres par le theme pour garder une mise en page propre.', 'udsp31' ); ?>
	</div>
	<div class="udsp31-content-page-editor">
		<?php udsp31_render_content_page_admin_field( 'udsp31_content_page', $page ); ?>
	</div>
	<?php
}

/**
 * Register the admin metabox for shared content pages.
 *
 * @return void
 */
function udsp31_add_content_page_metabox() {
	$post_id = isset( $_GET['post'] ) ? (int) $_GET['post'] : 0; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

	if ( ! $post_id || ! udsp31_is_content_page_post( $post_id ) ) {
		return;
	}

	add_meta_box(
		'udsp31-content-page',
		__( 'Contenu structure UDSP31', 'udsp31' ),
		'udsp31_render_content_page_metabox',
		'page',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes_page', 'udsp31_add_content_page_metabox' );

/**
 * Save structured content page data.
 *
 * @param int $post_id Post ID.
 * @return void
 */
function udsp31_save_content_page_metabox( $post_id ) {
	if ( ! isset( $_POST['udsp31_content_page_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['udsp31_content_page_nonce'] ) ), 'udsp31_save_content_page' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_page', $post_id ) || ! udsp31_is_content_page_post( $post_id ) ) {
		return;
	}

	if ( empty( $_POST['udsp31_content_page'] ) || ! is_array( $_POST['udsp31_content_page'] ) ) {
		delete_post_meta( $post_id, '_udsp31_content_page' );
		return;
	}

	$submitted = wp_unslash( $_POST['udsp31_content_page'] );
	$sanitized = udsp31_sanitize_content_page_value( $submitted );

	update_post_meta( $post_id, '_udsp31_content_page', $sanitized );
}
add_action( 'save_post_page', 'udsp31_save_content_page_metabox' );

/**
 * Hide the standard editor on structured content pages to avoid confusion.
 *
 * @return void
 */
function udsp31_hide_content_page_editor() {
	$post_id = isset( $_GET['post'] ) ? (int) $_GET['post'] : 0; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

	if ( ! $post_id || ! udsp31_is_content_page_post( $post_id ) ) {
		return;
	}
	?>
	<style>
		#postdivrich,
		#wp-content-wrap,
		label[for="content-html"],
		label[for="content-tmce"] {
			display: none !important;
		}
	</style>
	<?php
}
add_action( 'admin_head-post.php', 'udsp31_hide_content_page_editor' );

/**
 * Return a page URL with a slug fallback.
 *
 * @param string $slug Page slug.
 * @return string
 */
function udsp31_get_content_page_url( $slug ) {
	$page = get_page_by_path( $slug );

	if ( $page instanceof WP_Post ) {
		return get_permalink( $page );
	}

	return home_url( '/' . trim( (string) $slug, '/' ) . '/' );
}

/**
 * Return a theme image URL with safe encoding.
 *
 * @param string $file_name Image file name.
 * @return string
 */
function udsp31_get_image_url( $file_name ) {
	return udsp31_force_https_url( trailingslashit( get_template_directory_uri() ) . 'assets/images/' . rawurlencode( (string) $file_name ) );
}

/**
 * Resolve an internal content page target.
 *
 * @param string $target Link target token.
 * @return string
 */
function udsp31_resolve_content_target( $target ) {
	$target = (string) $target;

	if ( '' === $target ) {
		return home_url( '/' );
	}

	if ( 0 === strpos( $target, 'anchor:' ) ) {
		return '#' . ltrim( substr( $target, 7 ), '#' );
	}

	if ( 0 === strpos( $target, 'page:' ) ) {
		return udsp31_get_content_page_url( substr( $target, 5 ) );
	}

	if ( 'home' === $target ) {
		return home_url( '/' );
	}

	if ( 'discover' === $target ) {
		return udsp31_get_discover_url();
	}

	if ( 'executive' === $target ) {
		return udsp31_get_executive_url();
	}

	return $target;
}

/**
 * Render the summary block for a shared content page.
 *
 * @param array<string, mixed> $summary    Summary definition.
 * @param string               $anchor_id Optional anchor ID.
 * @return void
 */
function udsp31_render_content_summary( $summary, $anchor_id = '' ) {
	if ( ! empty( $summary['photo'] ) ) {
		?>
		<aside class="discover-summary discover-summary--photo" aria-hidden="true">
			<figure class="discover-summary__photo">
				<img src="<?php echo esc_url( udsp31_get_image_url( $summary['photo'] ) ); ?>" alt="" />
			</figure>
		</aside>
		<?php
		return;
	}

	$items = ! empty( $summary['items'] ) && is_array( $summary['items'] ) ? $summary['items'] : array();
	?>
	<aside class="discover-summary"<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
		<article class="discover-summary__card">
			<?php if ( ! empty( $summary['kicker'] ) ) : ?>
				<span class="section-kicker"><?php echo esc_html( $summary['kicker'] ); ?></span>
			<?php endif; ?>
			<?php if ( ! empty( $summary['title'] ) ) : ?>
				<h3><?php echo esc_html( $summary['title'] ); ?></h3>
			<?php endif; ?>
			<?php if ( ! empty( $summary['text'] ) ) : ?>
				<p><?php echo esc_html( $summary['text'] ); ?></p>
			<?php endif; ?>

			<?php if ( $items ) : ?>
				<ul class="discover-summary__meta">
					<?php foreach ( $items as $item ) : ?>
						<li>
							<strong><?php echo esc_html( $item['label'] ); ?></strong>
							<span><?php echo esc_html( $item['text'] ); ?></span>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</article>
	</aside>
	<?php
}

/**
 * Check whether the current page has editor content.
 *
 * @param int|WP_Post|null $post Optional post object or ID.
 * @return bool
 */
function udsp31_page_has_editor_content( $post = null ) {
	$post = get_post( $post );

	if ( ! $post instanceof WP_Post ) {
		return false;
	}

	return '' !== trim( (string) $post->post_content );
}

/**
 * Render the page editor content inside discover templates.
 *
 * @param array<string, string> $args Optional CSS class overrides.
 * @return void
 */
function udsp31_render_page_editor_content( $args = array() ) {
	if ( ! udsp31_page_has_editor_content() ) {
		return;
	}

	$args = wp_parse_args(
		$args,
		array(
			'section_class'   => 'section discover-section discover-section--editor-content',
			'container_class' => 'container page-content',
			'content_class'   => 'entry-content',
		)
	);
	?>
	<section class="<?php echo esc_attr( $args['section_class'] ); ?>">
		<div class="<?php echo esc_attr( $args['container_class'] ); ?>">
			<div class="<?php echo esc_attr( $args['content_class'] ); ?>">
				<?php the_content(); ?>
			</div>
		</div>
	</section>
	<?php
}

/**
 * Render a shared content page.
 *
 * @param string $slug Page slug.
 * @return bool
 */
function udsp31_render_content_page( $slug ) {
	$post_id = 0;

	if ( is_singular( 'page' ) ) {
		$post_id = (int) get_queried_object_id();
	}

	$page = udsp31_get_content_page_for_post( $slug, $post_id );

	if ( null === $page ) {
		return false;
	}

	$hero          = ! empty( $page['hero'] ) && is_array( $page['hero'] ) ? $page['hero'] : array();
	$hero_images   = ! empty( $hero['images'] ) && is_array( $hero['images'] ) ? $hero['images'] : array();
	$story         = ! empty( $page['story'] ) && is_array( $page['story'] ) ? $page['story'] : array();
	$gallery_section = ! empty( $page['gallery_section'] ) && is_array( $page['gallery_section'] ) ? $page['gallery_section'] : array();
	$cards_section = ! empty( $page['cards_section'] ) && is_array( $page['cards_section'] ) ? $page['cards_section'] : array();
	$feature_section = ! empty( $page['feature_section'] ) && is_array( $page['feature_section'] ) ? $page['feature_section'] : array();
	$flow_section  = ! empty( $page['flow_section'] ) && is_array( $page['flow_section'] ) ? $page['flow_section'] : array();
	$closing_section = ! empty( $page['closing'] ) && is_array( $page['closing'] ) ? $page['closing'] : array();
	$logo_section  = ! empty( $page['logo_section'] ) && is_array( $page['logo_section'] ) ? $page['logo_section'] : array();
	$links_section = ! empty( $page['links_section'] ) && is_array( $page['links_section'] ) ? $page['links_section'] : array();
	$combine_jsp_recruitment = 'devenir-jeune-sapeur-pompier' === $slug;
	$hero_classes  = array(
		'discover-media-card--primary',
		'discover-media-card--secondary',
		'discover-media-card--tertiary',
	);

	get_header();
	?>
	<main id="primary" class="site-main site-main--discover">
		<?php if ( have_posts() ) : ?>
			<?php the_post(); ?>
		<?php endif; ?>

		<?php if ( 'cookies' === $slug ) : ?>
			<section class="section discover-section">
				<div class="container">
					<div class="discover-summary discover-summary--single">
						<article class="discover-summary__card">
							<h1><?php echo esc_html( $page['title'] ); ?></h1>
							<p><?php esc_html_e( "Le site udsp31.fr n'utilise pas, a ce jour, de cookies publicitaires ou de mesure d'audience necessitant le consentement de l'utilisateur.", 'udsp31' ); ?></p>
							<p><?php esc_html_e( 'Des cookies strictement techniques peuvent toutefois etre utilises lorsque cela est necessaire au bon fonctionnement du site, notamment pour des fonctionnalites d administration, de securite ou de gestion de session.', 'udsp31' ); ?></p>
							<p><?php esc_html_e( 'Si de nouveaux services necessitant l utilisation de cookies sont ajoutes, cette page sera mise a jour en consequence.', 'udsp31' ); ?></p>
						</article>
					</div>
				</div>
			</section>
			<?php
			get_footer();
			return true;
			?>
		<?php endif; ?>

		<?php if ( 'mentions-legales' === $slug ) : ?>
			<section class="section discover-section">
				<div class="container">
					<div class="discover-summary discover-summary--single">
						<article class="discover-summary__card discover-legal-card">
							<h1><?php echo esc_html( $page['title'] ); ?></h1>
							<p><strong><?php esc_html_e( 'Derniere mise a jour : 31 mars 2026', 'udsp31' ); ?></strong></p>
							<p><?php esc_html_e( "Conformement aux dispositions legales en vigueur, il est precise aux utilisateurs du site https://www.udsp31.fr/ l'identite des differents intervenants dans le cadre de sa realisation et de son suivi.", 'udsp31' ); ?></p>

							<h2><?php esc_html_e( '1. Editeur du site', 'udsp31' ); ?></h2>
							<p><?php esc_html_e( 'Le present site est edite par :', 'udsp31' ); ?></p>
							<p><?php esc_html_e( 'Union Departementale des Sapeurs-Pompiers de la Haute-Garonne (UDSP 31)', 'udsp31' ); ?><br />
							<?php esc_html_e( '6 Bd Deodat de Severac', 'udsp31' ); ?><br />
							<?php esc_html_e( '31770 Colomiers', 'udsp31' ); ?><br />
							<?php esc_html_e( 'Telephone : 05 62 13 20 22', 'udsp31' ); ?><br />
							<?php esc_html_e( 'E-mail : udsp31@gmail.com', 'udsp31' ); ?></p>
							<p><?php esc_html_e( 'President de l UDSP 31 : Patrice GALTIER', 'udsp31' ); ?></p>

							<h2><?php esc_html_e( '2. Directeur de la publication', 'udsp31' ); ?></h2>
							<p><?php esc_html_e( 'Patrice GALTIER', 'udsp31' ); ?><br />
							<?php esc_html_e( 'President de l UDSP 31', 'udsp31' ); ?></p>

							<h2><?php esc_html_e( '3. Hebergement', 'udsp31' ); ?></h2>
							<p><?php esc_html_e( 'Le site est heberge par :', 'udsp31' ); ?></p>
							<p><?php esc_html_e( 'OVHcloud', 'udsp31' ); ?><br />
							<?php esc_html_e( '2 rue Kellermann', 'udsp31' ); ?><br />
							<?php esc_html_e( '59100 Roubaix', 'udsp31' ); ?><br />
							<?php esc_html_e( 'France', 'udsp31' ); ?><br />
							<?php esc_html_e( 'Site web : https://www.ovhcloud.com/fr/', 'udsp31' ); ?></p>

							<h2><?php esc_html_e( '4. Acces au site', 'udsp31' ); ?></h2>
							<p><?php esc_html_e( "Le site est accessible en permanence, sauf interruption programmee ou non, notamment pour les besoins de maintenance ou en cas de force majeure.", 'udsp31' ); ?></p>
							<p><?php esc_html_e( "L'UDSP 31 s'efforce d'assurer l'exactitude et la mise a jour des informations diffusees sur le site. Toutefois, elle ne peut garantir l'exactitude, la completude ou l'actualite de l'ensemble des informations mises a disposition.", 'udsp31' ); ?></p>
							<p><?php esc_html_e( "L'utilisateur reconnait utiliser ces informations sous sa responsabilite exclusive.", 'udsp31' ); ?></p>

							<h2><?php esc_html_e( '5. Propriete intellectuelle', 'udsp31' ); ?></h2>
							<p><?php esc_html_e( "L'ensemble des elements presents sur le site, notamment les textes, images, photographies, illustrations, logos, documents, elements graphiques, videos, icones, ainsi que leur mise en forme, sont, sauf mention contraire, la propriete exclusive de l'UDSP 31 ou font l'objet d'un droit d'utilisation.", 'udsp31' ); ?></p>
							<p><?php esc_html_e( "Toute reproduction, representation, diffusion, adaptation, modification, publication ou exploitation, totale ou partielle, de tout ou partie du site, par quelque procede que ce soit, est interdite sans autorisation ecrite prealable de l'UDSP 31.", 'udsp31' ); ?></p>
							<p><?php esc_html_e( "Toute utilisation non autorisee du site ou de l'un quelconque de ses elements pourra donner lieu a des poursuites.", 'udsp31' ); ?></p>

							<h2><?php esc_html_e( '6. Liens hypertextes', 'udsp31' ); ?></h2>
							<p><?php esc_html_e( "Le site peut contenir des liens vers d'autres sites internet. L'UDSP 31 ne peut etre tenue responsable du contenu de ces sites tiers, ni de leur disponibilite, ni des eventuels dommages pouvant resulter de leur consultation.", 'udsp31' ); ?></p>
							<p><?php esc_html_e( "La creation de liens vers le site udsp31.fr est autorisee, sous reserve qu'elle ne porte pas atteinte a l'image, aux interets ou aux droits de l'UDSP 31, et qu'elle ne cree aucune confusion sur la nature des contenus ou l'identite de l'editeur.", 'udsp31' ); ?></p>

							<h2><?php esc_html_e( '7. Responsabilite', 'udsp31' ); ?></h2>
							<p><?php esc_html_e( "L'UDSP 31 met en oeuvre les moyens raisonnables necessaires pour assurer le bon fonctionnement du site. Toutefois, sa responsabilite ne saurait etre engagee en cas de dysfonctionnement, d'interruption, de bogue, d'incompatibilite technique ou de dommages directs ou indirects lies a l'utilisation du site.", 'udsp31' ); ?></p>
							<p><?php esc_html_e( "L'utilisateur du site s'engage a acceder au site avec un materiel recent, exempt de virus et avec un navigateur a jour.", 'udsp31' ); ?></p>

							<h2><?php esc_html_e( '8. Donnees personnelles', 'udsp31' ); ?></h2>
							<p><?php esc_html_e( "Le site peut etre amene a collecter certaines donnees personnelles, notamment via ses formulaires de contact ou d'inscription.", 'udsp31' ); ?></p>
							<p><?php esc_html_e( "Ces donnees sont traitees conformement a la reglementation applicable. Pour en savoir plus sur la collecte et le traitement des donnees personnelles, l'utilisateur est invite a consulter la Politique de confidentialite du site.", 'udsp31' ); ?></p>

							<h2><?php esc_html_e( '9. Cookies', 'udsp31' ); ?></h2>
							<p><?php esc_html_e( "A la date de mise a jour des presentes mentions legales, le site ne semble pas utiliser de cookies publicitaires ou de mesure d'audience necessitant le consentement prealable de l'utilisateur.", 'udsp31' ); ?></p>
							<p><?php esc_html_e( "Des cookies strictement techniques peuvent toutefois etre utilises lorsque cela est necessaire au bon fonctionnement du site, a la securite ou a l'administration technique.", 'udsp31' ); ?></p>
							<p><?php esc_html_e( "Pour plus d'informations, l'utilisateur peut consulter la page Politique relative aux cookies.", 'udsp31' ); ?></p>

							<h2><?php esc_html_e( '10. Droit applicable', 'udsp31' ); ?></h2>
							<p><?php esc_html_e( 'Le present site est soumis au droit francais.', 'udsp31' ); ?></p>
							<p><?php esc_html_e( "Tout litige relatif a l'utilisation du site est soumis a la competence des juridictions francaises, sous reserve des dispositions legales imperatives applicables.", 'udsp31' ); ?></p>

							<h2><?php esc_html_e( '11. Contact', 'udsp31' ); ?></h2>
							<p><?php esc_html_e( 'Pour toute question concernant le site, son contenu ou son fonctionnement, vous pouvez contacter :', 'udsp31' ); ?></p>
							<p><?php esc_html_e( 'UDSP 31', 'udsp31' ); ?><br />
							<?php esc_html_e( '6 Bd Deodat de Severac', 'udsp31' ); ?><br />
							<?php esc_html_e( '31770 Colomiers', 'udsp31' ); ?><br />
							<?php esc_html_e( 'Telephone : 05 62 13 20 22', 'udsp31' ); ?><br />
							<?php esc_html_e( 'E-mail : udsp31@gmail.com', 'udsp31' ); ?></p>
						</article>
					</div>
				</div>
			</section>
			<?php
			get_footer();
			return true;
			?>
		<?php endif; ?>

		<?php if ( $hero && udsp31_is_content_page_section_enabled( $hero ) ) : ?>
			<section class="page-hero discover-hero <?php echo esc_attr( 'discover-hero--' . sanitize_html_class( $slug ) ); ?>">
				<div class="container discover-hero__grid">
					<div class="discover-hero__copy">
						<h1><?php echo esc_html( $page['title'] ); ?></h1>
						<?php if ( ! empty( $hero['lede'] ) ) : ?>
							<p class="discover-hero__lede"><?php echo esc_html( $hero['lede'] ); ?></p>
						<?php endif; ?>

						<div class="discover-hero__actions">
							<?php if ( ! empty( $hero['primary_cta']['label'] ) ) : ?>
								<a class="button button--primary" href="<?php echo esc_url( udsp31_resolve_content_target( $hero['primary_cta']['target'] ) ); ?>">
									<span><?php echo esc_html( $hero['primary_cta']['label'] ); ?></span>
									<span class="button__icon"><?php udsp31_the_icon( 'arrow' ); ?></span>
								</a>
							<?php endif; ?>
							<?php if ( ! empty( $hero['secondary_cta']['label'] ) ) : ?>
								<a class="button button--secondary" href="<?php echo esc_url( udsp31_resolve_content_target( $hero['secondary_cta']['target'] ) ); ?>">
									<span><?php echo esc_html( $hero['secondary_cta']['label'] ); ?></span>
								</a>
							<?php endif; ?>
						</div>
					</div>

					<div class="discover-hero__media" aria-hidden="true">
						<?php foreach ( array_slice( $hero_images, 0, 3 ) as $index => $image_name ) : ?>
							<figure class="discover-media-card <?php echo esc_attr( $hero_classes[ $index ] ); ?>">
								<img src="<?php echo esc_url( udsp31_get_image_url( $image_name ) ); ?>" alt="" />
							</figure>
						<?php endforeach; ?>
					</div>
				</div>
			</section>
		<?php endif; ?>

		<?php if ( $story && udsp31_is_content_page_section_enabled( $story ) ) : ?>
			<section class="section discover-section discover-section--story">
				<div class="container discover-story">
					<div class="discover-story__copy">
						<?php if ( ! empty( $story['title'] ) ) : ?>
							<h2><?php echo esc_html( $story['title'] ); ?></h2>
						<?php endif; ?>
						<?php if ( ! empty( $story['paragraphs'] ) && is_array( $story['paragraphs'] ) ) : ?>
							<?php foreach ( $story['paragraphs'] as $paragraph ) : ?>
								<p><?php echo esc_html( $paragraph ); ?></p>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>

					<?php if ( ! empty( $story['summary'] ) && is_array( $story['summary'] ) ) : ?>
						<?php udsp31_render_content_summary( $story['summary'], 'contact' === $slug ? 'contact-details' : '' ); ?>
					<?php endif; ?>
				</div>
			</section>
		<?php endif; ?>

		<?php if ( $gallery_section && udsp31_is_content_page_section_enabled( $gallery_section ) ) : ?>
			<section class="section discover-section" id="<?php echo esc_attr( $gallery_section['id'] ); ?>">
				<div class="container">
					<div class="section-heading discover-section-heading">
						<?php if ( ! empty( $gallery_section['title'] ) ) : ?>
							<h2><?php echo esc_html( $gallery_section['title'] ); ?></h2>
						<?php endif; ?>
						<?php if ( ! empty( $gallery_section['intro'] ) ) : ?>
							<p><?php echo esc_html( $gallery_section['intro'] ); ?></p>
						<?php endif; ?>
					</div>

					<?php if ( ! empty( $gallery_section['gallery_items'] ) && is_array( $gallery_section['gallery_items'] ) ) : ?>
						<div class="discover-gallery-grid">
							<?php foreach ( $gallery_section['gallery_items'] as $gallery_item ) : ?>
								<article class="discover-gallery-card">
									<?php if ( ! empty( $gallery_item['image'] ) ) : ?>
										<figure class="discover-gallery-card__media">
											<img src="<?php echo esc_url( udsp31_get_image_url( $gallery_item['image'] ) ); ?>" alt="<?php echo esc_attr( $gallery_item['title'] ?? '' ); ?>" />
										</figure>
									<?php endif; ?>
									<div class="discover-gallery-card__content">
										<?php if ( ! empty( $gallery_item['title'] ) ) : ?>
											<h3><?php echo esc_html( $gallery_item['title'] ); ?></h3>
										<?php endif; ?>
										<?php if ( ! empty( $gallery_item['caption'] ) ) : ?>
											<p><?php echo esc_html( $gallery_item['caption'] ); ?></p>
										<?php endif; ?>
									</div>
								</article>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			</section>
		<?php endif; ?>

		<?php if ( $cards_section && udsp31_is_content_page_section_enabled( $cards_section ) ) : ?>
			<section class="section section--quick-links discover-section" id="<?php echo esc_attr( $cards_section['id'] ); ?>">
				<div class="container">
					<div class="section-heading">
						<h2><?php echo esc_html( $cards_section['title'] ); ?></h2>
						<p><?php echo esc_html( $cards_section['intro'] ); ?></p>
					</div>

					<div class="discover-commission-grid">
						<?php foreach ( $cards_section['cards'] as $card ) : ?>
							<article class="discover-commission-card">
								<?php if ( ! empty( $card['icon'] ) ) : ?>
									<span class="info-card__icon"><?php udsp31_the_icon( $card['icon'] ); ?></span>
								<?php endif; ?>
								<h3><?php echo esc_html( $card['title'] ); ?></h3>
								<p><?php echo esc_html( $card['text'] ); ?></p>
							</article>
						<?php endforeach; ?>
					</div>
				</div>
			</section>
		<?php endif; ?>

		<?php if ( $feature_section && udsp31_is_content_page_section_enabled( $feature_section ) ) : ?>
			<section class="section discover-section" id="<?php echo esc_attr( $feature_section['id'] ); ?>">
				<div class="container">
					<div class="section-heading discover-section-heading">
						<?php if ( ! empty( $feature_section['title'] ) ) : ?>
							<h2><?php echo esc_html( $feature_section['title'] ); ?></h2>
						<?php endif; ?>
						<?php if ( ! empty( $feature_section['intro'] ) ) : ?>
							<p><?php echo esc_html( $feature_section['intro'] ); ?></p>
						<?php endif; ?>
					</div>

					<?php $feature_notes_after_list = ! empty( $feature_section['id'] ) && 'candidatures-jsp-2026' === $feature_section['id']; ?>
					<div class="discover-impact__copy discover-impact__copy--full">
						<?php if ( ! $feature_notes_after_list && ! empty( $feature_section['paragraphs'] ) && is_array( $feature_section['paragraphs'] ) ) : ?>
							<?php foreach ( $feature_section['paragraphs'] as $paragraph ) : ?>
								<p><?php echo esc_html( $paragraph ); ?></p>
							<?php endforeach; ?>
						<?php endif; ?>

						<?php if ( ! empty( $feature_section['features'] ) && is_array( $feature_section['features'] ) ) : ?>
							<ul class="discover-feature-list">
								<?php foreach ( $feature_section['features'] as $feature ) : ?>
									<li>
										<?php if ( ! empty( $feature['icon'] ) ) : ?>
											<span class="value-list__icon"><?php udsp31_the_icon( $feature['icon'] ); ?></span>
										<?php endif; ?>
										<div>
											<strong><?php echo esc_html( $feature['title'] ); ?></strong>
											<p><?php echo esc_html( $feature['text'] ); ?></p>
										</div>
									</li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>

						<?php if ( $feature_notes_after_list && ! empty( $feature_section['paragraphs'] ) && is_array( $feature_section['paragraphs'] ) ) : ?>
							<div class="discover-impact__notes">
								<?php foreach ( $feature_section['paragraphs'] as $paragraph ) : ?>
									<p><?php echo esc_html( $paragraph ); ?></p>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>

						<?php if ( $combine_jsp_recruitment && $links_section && udsp31_is_content_page_section_enabled( $links_section ) && ! empty( $links_section['links'] ) && is_array( $links_section['links'] ) ) : ?>
							<div class="discover-recruitment-links">
								<?php if ( ! empty( $links_section['title'] ) || ! empty( $links_section['intro'] ) ) : ?>
									<div class="discover-recruitment-links__header">
										<?php if ( ! empty( $links_section['title'] ) ) : ?>
											<h3><?php echo esc_html( $links_section['title'] ); ?></h3>
										<?php endif; ?>
										<?php if ( ! empty( $links_section['intro'] ) ) : ?>
											<p><?php echo esc_html( $links_section['intro'] ); ?></p>
										<?php endif; ?>
									</div>
								<?php endif; ?>

								<div class="discover-links-list">
									<?php foreach ( $links_section['links'] as $link_item ) : ?>
										<?php if ( empty( $link_item['label'] ) || empty( $link_item['target'] ) ) : ?>
											<?php continue; ?>
										<?php endif; ?>
										<a class="button button--secondary" href="<?php echo esc_url( udsp31_resolve_content_target( $link_item['target'] ) ); ?>" target="_blank" rel="noreferrer noopener">
											<span><?php echo esc_html( $link_item['label'] ); ?></span>
											<span class="button__icon" aria-hidden="true"><?php udsp31_the_icon( 'launch' ); ?></span>
										</a>
									<?php endforeach; ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</section>
		<?php endif; ?>

		<?php if ( $flow_section && udsp31_is_content_page_section_enabled( $flow_section ) ) : ?>
			<section class="section section--stats discover-section" id="<?php echo esc_attr( $flow_section['id'] ); ?>">
				<div class="container">
					<div class="section-heading">
						<h2><?php echo esc_html( $flow_section['title'] ); ?></h2>
						<p><?php echo esc_html( $flow_section['intro'] ); ?></p>
					</div>

					<div class="discover-flow">
						<?php foreach ( $flow_section['steps'] as $step ) : ?>
							<article class="discover-flow__card">
								<span class="discover-flow__step"><?php echo esc_html( $step['step'] ); ?></span>
								<h3><?php echo esc_html( $step['title'] ); ?></h3>
								<p><?php echo esc_html( $step['text'] ); ?></p>
							</article>
						<?php endforeach; ?>
					</div>
				</div>
			</section>
		<?php endif; ?>

		<?php if ( ! $combine_jsp_recruitment && $links_section && udsp31_is_content_page_section_enabled( $links_section ) && ! empty( $links_section['links'] ) && is_array( $links_section['links'] ) ) : ?>
			<section class="section discover-section discover-section--links" id="<?php echo esc_attr( $links_section['id'] ); ?>">
				<div class="container">
					<div class="section-heading discover-section-heading">
						<?php if ( ! empty( $links_section['title'] ) ) : ?>
							<h2><?php echo esc_html( $links_section['title'] ); ?></h2>
						<?php endif; ?>
						<?php if ( ! empty( $links_section['intro'] ) ) : ?>
							<p><?php echo esc_html( $links_section['intro'] ); ?></p>
						<?php endif; ?>
					</div>

					<div class="discover-links-list">
						<?php foreach ( $links_section['links'] as $link_item ) : ?>
							<?php if ( empty( $link_item['label'] ) || empty( $link_item['target'] ) ) : ?>
								<?php continue; ?>
							<?php endif; ?>
							<a class="button button--secondary" href="<?php echo esc_url( udsp31_resolve_content_target( $link_item['target'] ) ); ?>" target="_blank" rel="noreferrer noopener">
								<span><?php echo esc_html( $link_item['label'] ); ?></span>
								<span class="button__icon" aria-hidden="true"><?php udsp31_the_icon( 'launch' ); ?></span>
							</a>
						<?php endforeach; ?>
					</div>
				</div>
			</section>
		<?php endif; ?>

		<?php if ( $logo_section && udsp31_is_content_page_section_enabled( $logo_section ) && ! empty( $logo_section['image'] ) ) : ?>
			<section class="section discover-section discover-section--logo" id="<?php echo esc_attr( $logo_section['id'] ); ?>">
				<div class="container">
					<div class="discover-logo-block">
						<img src="<?php echo esc_url( udsp31_get_image_url( $logo_section['image'] ) ); ?>" alt="<?php echo esc_attr( $logo_section['title'] ?? '' ); ?>" />
						<?php if ( ! empty( $logo_section['title'] ) || ! empty( $logo_section['caption'] ) ) : ?>
							<div class="discover-logo-block__copy">
								<?php if ( ! empty( $logo_section['title'] ) ) : ?>
									<h2><?php echo esc_html( $logo_section['title'] ); ?></h2>
								<?php endif; ?>
								<?php if ( ! empty( $logo_section['caption'] ) ) : ?>
									<p><?php echo esc_html( $logo_section['caption'] ); ?></p>
								<?php endif; ?>
							</div>
						<?php endif; ?>
						<?php if ( ! empty( $logo_section['link']['label'] ) && ! empty( $logo_section['link']['target'] ) ) : ?>
							<a class="button button--secondary" href="<?php echo esc_url( udsp31_resolve_content_target( $logo_section['link']['target'] ) ); ?>" target="_blank" rel="noreferrer noopener">
								<span><?php echo esc_html( $logo_section['link']['label'] ); ?></span>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</section>
		<?php endif; ?>

		<?php if ( 'dispositif-previsionnel-de-secours' === $slug && $closing_section && udsp31_is_content_page_section_enabled( $closing_section ) ) : ?>
			<section class="section discover-section">
				<div class="container">
					<div class="discover-closing">
						<div class="discover-closing__copy">
							<?php if ( ! empty( $closing_section['kicker'] ) ) : ?>
								<p class="section-heading__eyebrow"><?php echo esc_html( $closing_section['kicker'] ); ?></p>
							<?php endif; ?>
							<?php if ( ! empty( $closing_section['title'] ) ) : ?>
								<h2><?php echo esc_html( $closing_section['title'] ); ?></h2>
							<?php endif; ?>
							<?php if ( ! empty( $closing_section['paragraphs'] ) && is_array( $closing_section['paragraphs'] ) ) : ?>
								<?php foreach ( $closing_section['paragraphs'] as $paragraph ) : ?>
									<p><?php echo esc_html( $paragraph ); ?></p>
								<?php endforeach; ?>
							<?php endif; ?>

							<div class="discover-closing__actions">
								<?php if ( ! empty( $closing_section['primary_cta']['label'] ) ) : ?>
									<a class="button button--primary" href="<?php echo esc_url( udsp31_resolve_content_target( $closing_section['primary_cta']['target'] ) ); ?>">
										<span><?php echo esc_html( $closing_section['primary_cta']['label'] ); ?></span>
										<span class="button__icon"><?php udsp31_the_icon( 'arrow' ); ?></span>
									</a>
								<?php endif; ?>
							</div>
						</div>

						<?php if ( ! empty( $closing_section['gallery'] ) && is_array( $closing_section['gallery'] ) ) : ?>
							<div class="discover-closing__gallery" aria-hidden="true">
								<?php foreach ( array_slice( $closing_section['gallery'], 0, 3 ) as $image_name ) : ?>
									<img src="<?php echo esc_url( udsp31_get_image_url( $image_name ) ); ?>" alt="" />
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</section>
		<?php endif; ?>

	</main>
	<?php
	get_footer();

	return true;
}
