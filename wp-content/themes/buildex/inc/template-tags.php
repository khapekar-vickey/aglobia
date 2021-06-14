<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Buildex
 */

if ( ! function_exists( 'buildex_post_excerpt' ) ) :
	/**
	 * Prints HTML with excerpt.
	 */
	function buildex_post_excerpt( $args = array() ) {
		$default_args = array(
			'before' => '<div class="entry-content">',
			'after'  => '</div>',
			'echo'   => true
		);
		$args = wp_parse_args( $args, $default_args );

		$post_excerpt_enable = buildex_theme()->customizer->get_value( 'blog_post_excerpt' );

		if ( ! $post_excerpt_enable ) {
			return;
		}

		$words_count = buildex_theme()->customizer->get_value( 'blog_post_excerpt_words_count' );

		if ( has_excerpt() ) {
			$excerpt = wp_trim_words( get_the_excerpt(), $words_count, '...' );
		} else {
			$excerpt = get_the_content();
			$excerpt = strip_shortcodes( $excerpt );
			$excerpt = str_replace( ']]>', ']]&gt;', $excerpt );
			$excerpt = wp_trim_words( $excerpt, $words_count, '...' );

			if ( ! $excerpt ) {
				return;
			}
		}

		$excerpt_output = apply_filters(
			'buildex-theme/post/excerpt-output',
			$args['before'] .'<p>'. $excerpt .'</p>'. $args['after']
		);

		if ( $args['echo'] ) {
			echo wp_kses_post( $excerpt_output );
		} else {
			return $excerpt_output;
		}
	}
endif;

if ( ! function_exists( 'buildex_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function buildex_posted_on( $args = array() ) {
		if ( 'post' === get_post_type() ) {

			$default_args = array(
				'prefix' => '',
				'format' => '',
				'before' => '<span class="posted-on">',
				'after'  => '</span>',
				'echo'   => true
			);
			$args = wp_parse_args( $args, $default_args );

			$option_name = ! is_singular( 'post' ) ? 'blog_post_publish_date' : 'single_post_publish_date';
			$post_publish_date_enable = buildex_theme()->customizer->get_value( $option_name );

			if( $post_publish_date_enable ) {

				$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

				$time_string = sprintf( $time_string,
					esc_attr( get_the_date( 'c' ) ),
					esc_html( get_the_date( $args['format'] ) )
				);

				$posted_on = sprintf(
					/* translators: %s: post date. */
					esc_html_x( '%s', 'post date', 'buildex' ),
					$time_string
				);

				$date_output = apply_filters(
					'buildex-theme/post/date-output',
					$args['before'] . $args['prefix'] . ' ' . $posted_on . $args['after']
				);

				$allowed_html = array(
					'time' => array(
						'datetime' => true,
					),
				);

				if ( $args['echo'] ) {
					echo wp_kses( $date_output, buildex_kses_post_allowed_html( $allowed_html ) );
				} else {
					return $date_output;
				}
			}

		}
	}
endif;

if ( ! function_exists( 'buildex_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function buildex_posted_by( $args = array() ) {
		if ( 'post' === get_post_type() ) {

			$default_args = array(
				'prefix' => __( 'By', 'buildex' ),
				'before' => '<span class="byline">',
				'after'  => '</span>',
				'echo'   => true
			);
			$args = wp_parse_args( $args, $default_args );

			$option_name = ! is_singular( 'post' ) ? 'blog_post_author' : 'single_post_author';
			$post_author_enable = buildex_theme()->customizer->get_value( $option_name );

			if( $post_author_enable ) {
				buildex_get_post_author($args);
			}

		}
	}
endif;

if ( ! function_exists( 'buildex_posted_in' ) ) :
	/**
	 * Prints HTML with meta information for the current categories.
	 */
	function buildex_posted_in( $args = array() ) {
		if ( 'post' === get_post_type() ) {

			$default_args = array(
				'prefix'    => '',
				'delimiter' => ', ',
				'before'    => '<span class="cat-links">',
				'after'     => '</span>'
			);
			$args = wp_parse_args( $args, $default_args );

			$option_name = ! is_singular( 'post' ) ? 'blog_post_categories' : 'single_post_categories';
			$post_categories_enable = buildex_theme()->customizer->get_value( $option_name );

			if( $post_categories_enable ) {

				$categories_list = get_the_category_list( esc_html( $args['delimiter'] ) );
				if ( $categories_list ) {
					$categories = sprintf(
						/* translators: 1: list of categories. */
						esc_html__( '%s', 'buildex' ),
						$categories_list
					);

					echo apply_filters(
						'buildex-theme/post/categories-output',
						$args['before'] . $args['prefix'] . ' ' . $categories . $args['after']
					);
				}

			}

		}
	}
endif;

if ( ! function_exists( 'buildex_post_tags' ) ) :
	/**
	 * Prints HTML with meta information for the current tags.
	 */
	function buildex_post_tags( $args = array() ) {
		if ( 'post' === get_post_type() ) {

			$default_args = array(
				'prefix'    => '',
				'delimiter' => ', ',
				'before'    => '<span class="tags-links">',
				'after'     => '</span>'
			);
			$args = wp_parse_args( $args, $default_args );

			$option_name = ! is_singular( 'post' ) ? 'blog_post_tags' : 'single_post_tags';
			$post_tags_enable = buildex_theme()->customizer->get_value( $option_name );

			if( $post_tags_enable ) {

				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', esc_html_x( $args['delimiter'], 'list item separator', 'buildex' ) );
				if ( $tags_list ) {
					$tags = sprintf(
						/* translators: 1: list of tags. */
						esc_html__( '%s', 'buildex' ),
						$tags_list
					);

					echo apply_filters(
						'buildex-theme/post/tags-output',
						$args['before'] . $args['prefix'] . ' ' . $tags . $args['after']
					);
				}
			}

		}
	}
endif;

if ( ! function_exists( 'buildex_post_comments' ) ) :
	/**
	 * Prints HTML with meta information for the current comments.
	 */
	function buildex_post_comments( $args = array() ) {
		if ( 'post' === get_post_type() ) {

			$option_name = ! is_singular( 'post' ) ? 'blog_post_comments' : 'single_post_comments';
			$post_comments_enable = buildex_theme()->customizer->get_value( $option_name );

			if ( $post_comments_enable && ! post_password_required() && comments_open() ) {
				global $post;

				$default_args = array(
					'class'   => 'comments-link',
					'prefix'  => '',
					'postfix' => '',
				);

				$args = wp_parse_args( $args, $default_args );

				$count = $post->comment_count;
				$link = get_comments_link();

				if ( $args['prefix'] ) {
					$args['prefix'] .= ' ';
				}

				if ( $args['postfix'] ) {
					$args['postfix'] = ' ' . $args['postfix'];
				}

				echo apply_filters(
					'buildex-theme/post/comments-output',
					'<a href="' . $link . '" class="' . $args['class'] . '">' . $args['prefix'] . $count . $args['postfix'] . '</a>'
				);
			}

		}
	}
endif;

if ( ! function_exists( 'buildex_get_post_author' ) ) :
	/*
	* Display a post author.
	*/
	function buildex_get_post_author( $args = array() ) {
		$default_args = array(
			'prefix' => '',
			'before' => '<span class="author">',
			'after'  => '</span>',
			'link'   => true,
			'echo'   => true
		);
		$args = wp_parse_args( $args, $default_args );

		global $post;
		$author_id = $post->post_author;

		$author_output = $args['before'];
			if ( $args['prefix'] ) {
				$author_output .= $args['prefix'] . ' ';
			}
			if ( $args['link'] ) {
				$author_output .= '<a href="' . esc_url( get_author_posts_url( $author_id ) ) . '">';
			}
			$author_output .= esc_html( get_the_author_meta( 'display_name' , $author_id ) );
			if ( $args['link'] ) {
				$author_output .= '</a>';
			}
		$author_output .= $args['after'];

		$author_output = apply_filters(
			'buildex-theme/post/author-output',
			$author_output
		);

		if ( $args['echo'] ) {
			echo wp_kses_post( $author_output );
		} else {
			return $author_output;
		}
	}
endif;

if ( ! function_exists( 'buildex_get_post_author_avatar' ) ) :
	/*
	* Display a post author avatar.
	*/
	function buildex_get_post_author_avatar( $args = array() ) {
		$default_args = array(
			'size' => 140,
			'echo' => true
		);
		$args = wp_parse_args( $args, $default_args );

		global $post;
		$author_id = $post->post_author;

		$avatar_output = apply_filters(
			'buildex-theme/post/avatar-output',
			get_avatar( get_the_author_meta( 'user_email', $author_id ), $args['size'], '', esc_attr( get_the_author_meta( 'nickname', $author_id ) ) )
		);

		$allowed_html = array(
			'img' => array(
				'srcset' => true,
			),
			'noscript' => array(),
		);

		if ( $args['echo'] ) {
			echo wp_kses( $avatar_output, buildex_kses_post_allowed_html( $allowed_html ) );
		} else {
			return $avatar_output;
		}
	}
endif;

if ( ! function_exists( 'buildex_get_author_meta' ) ) :
	/*
	* Display author meta.
	*/
	function buildex_get_author_meta( $args = array() ) {
		$default_args = array(
			'field' => 'description',
			'echo'  => true
		);
		$args = wp_parse_args( $args, $default_args );

		global $post;
		$author_id = $post->post_author;

		$author_meta_output = apply_filters(
			'buildex-theme/post/author-meta-output',
			get_the_author_meta( $args['field'], $author_id )
		);

		if ( $args['echo'] ) {
			echo wp_kses_post( $author_meta_output );
		} else {
			return $author_meta_output;
		}
	}
endif;

if ( ! function_exists( 'buildex_post_link' ) ) :
	function buildex_post_link( $args = array() ) {

		$default_args = array(
			'class' => '',
		);

		$args = wp_parse_args( $args, $default_args );

		$post_link_type = buildex_theme()->customizer->get_value( 'blog_read_more_type' );
		$link = get_permalink();
		$post_link_output = '';

		if ( 'text' === $post_link_type ) {
			$title = buildex_theme()->customizer->get_value( 'blog_read_more_text' );

			if ( strlen( $title ) > 0 ) {
				$post_link_output = '<a href="' . $link . '" class="btn ' . $args['class'] . '">' . $title . '</a>';
			}
		}

		if ( 'text_icon' === $post_link_type ) {
			$title = buildex_theme()->customizer->get_value( 'blog_read_more_text' );

			$post_link_output = '<a href="' . $link . '" class="btn-text-icon ' . $args['class'] . '">' . $title . '</a>';
		}

		if ( 'icon' === $post_link_type ) {
			$post_link_output = '<a href="' . $link . '" class="btn-icon ' . $args['class'] . '"></a>';
		}

		echo apply_filters(
			'buildex-theme/post/link-output',
			$post_link_output
		);
	}
endif;

if ( ! function_exists( 'buildex_edit_link' ) ) :
	function buildex_edit_link() {
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'buildex' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'buildex_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function buildex_post_thumbnail( $image_size = 'post-thumbnail', $args = array() ) {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	$default_args = array(
		'link'       => true,
		'class'      => 'post-thumbnail',
		'link-class' => 'post-thumbnail__link',
		'echo'       => true,
	);
	$args = wp_parse_args( $args, $default_args );

	$image_size = apply_filters(
		'buildex-theme/post/thumb-image-size',
		$image_size
	);

	$thumb = '<figure class="' . $args['class'] . '">';
		if ( $args['link'] ) {
			$thumb .= '<a class="' . $args['link-class'] . '" href="' . get_permalink() .'" aria-hidden="true">';
		}
			$thumb .= get_the_post_thumbnail( null, $image_size );
		if ( $args['link'] ) {
			$thumb .= '</a>';
		}
	$thumb .= '</figure>';

	$thumb = apply_filters(
		'buildex-theme/post/thumb',
		$thumb
	);

	$allowed_html = array(
		'a' => array(
			'aria-hidden' => true,
		),
		'img' => array(
			'srcset' => true,
			'sizes'  => true,
		),
		'noscript' => array(),
	);

	if ( $args['echo'] ) {
		echo wp_kses( $thumb, buildex_kses_post_allowed_html( $allowed_html ) );
	} else {
		return $thumb;
	}
}
endif;

if ( ! function_exists( 'buildex_post_overlay_thumbnail' ) ) :
/**
 * Displays post thumbnail as tag style
 *
 * @return string
 */
function buildex_post_overlay_thumbnail( $img_size = 'buildex-thumb-xl', $postID = null ) {
	$thumbnail = apply_filters(
		'buildex-theme/post/overlay-thumb',
		get_the_post_thumbnail_url( $postID, $img_size )
	);

	if( $thumbnail ) {
		echo 'style="background-image: url(' . $thumbnail . ')"';
	}
}
endif;

if ( ! function_exists( 'buildex_get_page_preloader' ) ) :
/**
 * Display the page preloader.
 *
 * @since  1.0.0
 * @return void
 */
function buildex_get_page_preloader() {
	$page_preloader = buildex_theme()->customizer->get_value( 'page_preloader' );

	if ( $page_preloader ) {
		echo  apply_filters(
			'buildex-theme/page/preloader',
			'<div class="page-preloader-cover">
				<div class="page-preloader"></div>
			</div>'
		);
	}
}
endif;

if ( ! function_exists( 'buildex_header_logo' ) ) :
/**
 * Display the header logo.
 *
 * @since  1.0.0
 * @return void
 */
function buildex_header_logo() {
	if ( has_custom_logo() ) {
		the_custom_logo();
	} else {
		$logo = get_bloginfo( 'name' );

		$format = apply_filters(
			'buildex-theme/header/logo-format',
			'<h1 class="site-logo"><a class="site-logo__link" href="%1$s" rel="home">%2$s</a></h1>'
		);

		printf( $format, esc_url( home_url( '/' ) ), $logo );
	}
}
endif;

if ( ! function_exists( 'buildex_site_description' ) ) :
/**
 * Display the site description.
 *
 * @since  1.0.0
 * @return void
 */
function buildex_site_description() {
	$show_desc = buildex_theme()->customizer->get_value( 'show_tagline' );

	if ( ! $show_desc ) {
		return;
	}

	$description = get_bloginfo( 'description', 'display' );

	if ( ! ( $description || is_customize_preview() ) ) {
		return;
	}

	$format = apply_filters( 'buildex-theme/header/description-format', '<div class="site-description">%s</div>' );

	printf( $format, $description );
}
endif;

if ( ! function_exists( 'buildex_social_list' ) ) :
/**
 * Show Social list.
 *
 * @since  1.0.0
 * @since  1.0.1 Added new param - $type.
 * @return void
 */
function buildex_social_list( $context = '', $type = 'icon' ) {
	$visibility_in_header = buildex_theme()->customizer->get_value( 'header_social_links' );
	$visibility_in_footer = buildex_theme()->customizer->get_value( 'footer_social_links' );

	if ( ! $visibility_in_header && ( 'header' === $context ) ) {
		return;
	}

	if ( ! $visibility_in_footer && ( 'footer' === $context ) ) {
		return;
	}

	echo buildex_get_social_list( $context, $type );
}
endif;

if ( ! function_exists( 'buildex_footer_copyright' ) ) :
/**
 * Show footer copyright text.
 *
 * @since  1.0.0
 * @return void
 */
function buildex_footer_copyright() {
	$copyright = buildex_theme()->customizer->get_value( 'footer_copyright' );
	$format    = apply_filters(
		'buildex-theme/footer/copyright-format',
		'<div class="footer-copyright">%s</div>'
	);

	if ( empty( $copyright ) ) {
		return;
	}

	printf( $format, wp_kses( buildex_render_macros( $copyright ), wp_kses_allowed_html( 'post' ) ) );
}
endif;

if ( ! function_exists( 'buildex_is_top_panel_visible' ) ) :
/**
 * Check if top panele visible or not
 *
 * @return bool
 */
function buildex_is_top_panel_visible() {
	$is_visible = false;
	$top_panel_enable = buildex_theme()->customizer->get_value( 'top_panel_enable' );

	if ( $top_panel_enable ) {
		$site_description = ( buildex_theme()->customizer->get_value( 'show_tagline' ) && strlen(get_bloginfo( 'description' ) ) > 0 ) ? true : false;
		$social           = buildex_theme()->customizer->get_value( 'header_social_links' );

		$conditions = apply_filters(
			'buildex-theme/header/top-panel-visibility-conditions',
			array( $site_description, $social )
		);

		foreach ( $conditions as $condition ) {
			if ( ! empty( $condition ) ) {
				$is_visible = true;
			}
		}
	}

	return $is_visible;
}
endif;

if ( ! function_exists( 'buildex_sticky_label' ) ) :
/**
 * Show sticky menu label grabbed from options.
 *
 * @since  1.0.0
 * @return void
 */
function buildex_sticky_label() {

	if ( ! is_sticky() || ! is_home() || is_paged() ) {
		return;
	}

	$sticky_type = buildex_theme()->customizer->get_value( 'blog_sticky_type' );

	$content = '';
	$icon    = apply_filters(
		'buildex-theme/posts/sticky-icon',
		'<i class="fa fa-thumb-tack" aria-hidden="true"></i>'
	);

	switch ( $sticky_type ) {

		case 'icon':
			$content = $icon;
			break;

		case 'label':
			$label = buildex_theme()->customizer->get_value( 'blog_sticky_label' );
			$content = $label;
			break;

		case 'both':
			$label = buildex_theme()->customizer->get_value( 'blog_sticky_label' );
			$content = $icon . $label;
			break;
	}

	if ( empty( $content ) ) {
		return;
	}

	printf( '<div class="sticky-label type-%2$s">%1$s</div>', $content, $sticky_type );
}
endif;