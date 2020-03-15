<?php
  /**
   * Format d'affichage de la date
   * @link http://php.net/manual/fr/function.date.php
   */
  $dateformat = 'l j F Y \à G\hi';

  /**
   * La fonction strtotime() essaye de lire une date au format anglais fournie par le paramètre time, et de la transformer en timestamp Unix
   * @link http://php.net/manual/fr/function.strtotime.php
   */
  $unixtimestamp = strtotime(get_field('date'));

  /**
   * Renvoie la date au format local, ici, en français
   * @link https://codex.wordpress.org/Function_Reference/date_i18n
   */
  $date = date_i18n($dateformat, $unixtimestamp);
 ?>