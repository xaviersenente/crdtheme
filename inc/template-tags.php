<?php
/**
 * Template tags, used in template files.
 */

/**
 * Fonction qui va retourner le titre pour chacun des modèles de page WordPress
 * Repris de la fonction de base de Wordpress (wp_title) et légèrement modifiée 
 * @link https://developer.wordpress.org/reference/functions/wp_title/
 * @param boolean $display
 * @return string $title
 */


function crdtheme_display_page_title( $display = true ) {

	$m        = get_query_var( 'm' );
	$year     = get_query_var( 'year' );
	$monthnum = get_query_var( 'monthnum' );
	$day      = get_query_var( 'day' );
	$search   = get_query_var( 's' );
	$title    = '';

	// S'il y a un article (Post)
	if ( is_single() || ( is_home() && ! is_front_page() ) || ( is_page() && ! is_front_page() ) ) {
		$title = single_post_title( '', false );
  }
  
  // Si c'est la page d'accueil
	if ( is_front_page() ) {
		$title = get_bloginfo( 'name' );
	}

	// S'il y a une page d'archive
	if ( is_post_type_archive() ) {
		$post_type = get_query_var( 'post_type' );
		if ( is_array( $post_type ) ) {
			$post_type = reset( $post_type );
		}
		$post_type_object = get_post_type_object( $post_type );
		if ( ! $post_type_object->has_archive ) {
			$title = post_type_archive_title( '', false );
		}
	}

	// if ( is_post_type_archive() ) {
  //   $rows = get_field( 'header_archive', 'header_archives' );
  //   if( $rows ) :
  //     foreach( $rows as $row ) :
  //       if ( $row['cpt_header_archive'] == get_post_type() ) : 
  //         $title = $row['title_header_archive'];
  //       endif;
  //     endforeach;
  //   endif;
	// }

	// S'il y a une catégorie ou une étiquette (tag)
	if ( is_category() || is_tag() ) {
		$title = single_term_title( '', false );
	}

	// S'il y a une taxonomie
	if ( is_tax() ) {
		$term = get_queried_object();
		if ( $term ) {
			$tax   = get_taxonomy( $term->taxonomy );
			$title = single_term_title( $tax->labels->name . ' <br> ', false );
		}
	}

	// S'il y a un auteur
	if ( is_author() && ! is_post_type_archive() ) {
		$author = get_queried_object();
		if ( $author ) {
			$title = $author->display_name;
		}
	}

  // Les archives des types de contenu avec has_archive doivent remplacer les termes.
	if ( is_post_type_archive() && $post_type_object->has_archive ) {
		$title = post_type_archive_title( '', false );
	}

	// S'il y a un mois
	if ( is_archive() && ! empty( $m ) ) {
		$my_year  = substr( $m, 0, 4 );
		$my_month = $wp_locale->get_month( substr( $m, 4, 2 ) );
		$my_day   = intval( substr( $m, 6, 2 ) );
		$title    = $my_year . ( $my_month ? $my_month : '' ) . ( $my_day ? $my_day : '' );
	}

	// S'il y a une année
	if ( is_archive() && ! empty( $year ) ) {
		$title = $year;
		if ( ! empty( $monthnum ) ) {
			$title .= $wp_locale->get_month( $monthnum );
		}
		if ( ! empty( $day ) ) {
			$title .= zeroise( $day, 2 );
		}
	}

	// S'il y a une recherche
	if ( is_search() ) {
		/* translators: 1: separator, 2: search phrase */
		$title = __( 'Recherche' );
	}

  // S'il y a une page 404
	if ( is_404() ) {
		$title = __( 'Erreur 404, la page est introuvable' );
	}

	// Envoyez-le…
	if ( $display ) {
		echo $title;
	} else {
		return $title;
	}
}
