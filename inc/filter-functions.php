<?php
/**
 * Theme functions that filter output.
 */


 /**
 * On définit les blocs disponnibles dans l'éditeur Gutenberg
 * et on désactive certaines de ses fonctionnalités
 */
function crdtheme_gutenberg_blocks() {
  return array(
		'core/paragraph',
		'core/heading',
		'core/quote',
		'core/list',
    'core/image',
    'core/gallery',
    'core/file',
    'lazyblock/carousel',
    // 'core/table',
    // 'core/shortcode',
  );
}