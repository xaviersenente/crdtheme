<?php
/**
 * Accroche une fonction ou une méthode à une action de filtrage spécifique.
 * All add_filter() calls.
 */


// Filtre les types de bloc autorisés par Gutenberg.
add_filter( 'allowed_block_types', 'crdtheme_gutenberg_blocks' );

// Ajout d'un filtre pour les types de contenu.
// add_filter('acf/load_field/name=cpt_header_archive', 'acf_load_cpt_field_choices');
