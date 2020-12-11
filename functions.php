<?php
/**
 * Fonction du thèmes
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * Pour organiser les fonctions du thèmes
 * @link https://florianbrinkmann.com/en/organizing-files-functions-wordpress-theme-4190/
 */

// Intégration du fichier avec les appels add_action().
require_once get_template_directory() . '/inc/actions.php';

// Intégration du fichier avec les appels add_filter().
require_once get_template_directory() . '/inc/filters.php';

// Intégration du fichier avec les fonctions de filtrage.
require_once get_template_directory() . '/inc/filter-functions.php';

// Intégration du fichier avec les fonctions de template.
require_once get_template_directory() . '/inc/template-functions.php';

// Intégration du fichier avec les fonctions appelées depuis les fichiers de template.
require_once get_template_directory() . '/inc/template-tags.php';

// Walker Nav Menu.
require_once get_template_directory() . '/classes/class-crd-walker-menu.php';

// Plugin ACF
require_once get_template_directory() . '/inc/plugins/acf.php';



