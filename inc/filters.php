<?php
/**
 * Accroche une fonction ou une méthode à une action de filtrage spécifique.
 * All add_filter() calls.
 */


// Filtre les types de bloc autorisés par Gutenberg.
add_filter( 'allowed_block_types', 'crdtheme_gutenberg_blocks' );

// Retire la balise p des descriptions de taxonomies
remove_filter('term_description', 'wpautop');

