<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package crdtheme
 */

  $adresse    = get_field('infos_adresse', 'infos');
  $tel        = get_field('infos_tel', 'infos');
  $mail       = get_field('infos_mail', 'infos');
  $logoFooter = get_field('infos_logo_footer', 'infos');
  $logoGB     = get_field('infos_logo_gb', 'infos');

?>

	</main>
  <footer class="footer">
    <div class="footer__wrapper grid">
      <div class="footer__logo">
        <img src="<?php echo $logoFooter['url']; ?>" class="style-svg"/>
      </div>
      <nav class="footer__menu">
        <h3 class="footer__title">Menu</h3>
        <?php wp_nav_menu( array(
          'theme_location' => 'footer-menu',
          'container'      => false,
          'menu_class'     => 'listUnstyled',
          'depth'          => 1
        ) ); ?>
      </nav>
      
      <div class="footer__contact">
        <h3 class="footer__title">Contact</h3>
        <address class="footer__adresse">
          <?php echo $adresse['street_number']; ?> <?php echo $adresse['street_name']; ?><br>
          <?php echo $adresse['post_code']; ?> <?php echo $adresse['city']; ?><br>
          <a href="tel:<?php echo $tel; ?>"><?php echo $tel; ?></a>
          <br><a href="mailto:<?php echo $mail; ?>"><?php echo $mail; ?></a>
        </address>
      </div>
      <div class="footer__social">
        <h3 class="footer__title">Nous suivre</h3>
        <ul class="footer__list listUnstyled">
          <?php while(have_rows('infos_reseaux_sociaux', 'infos')): the_row();
            $reseau_social = get_sub_field('infos_reseau_social');
            $url = get_sub_field('infos_url_reseau_social');
            $icon = '';
            if($reseau_social == 'facebook') {
              $icon = 'iconFacebook';
            } elseif ($reseau_social == 'twitter') {
              $icon = 'iconTwitter';
            } elseif ($reseau_social == 'instagram') {
              $icon = 'iconInstagram';
            } elseif ($reseau_social == 'youtube') {
              $icon = 'iconYoutube';
            }
          ?>
          <li>
            <a href="<?php echo $url; ?>" aria-label="Notre page <?php echo $reseau_social; ?>">
              <i class="<?php echo $icon; ?>" aria-hidden="true"></i>
            </a>
          </li>
          <?php endwhile; ?>
        </ul>
      </div>
      <div class="footer__gb">
        <img src="<?php echo $logoGB['url']; ?>" class="style-svg"/>
      </div>
    </div>
  </footer>
  
  <?php 
    wp_footer(); 
  ?>
</body>
</html>
