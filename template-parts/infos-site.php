<?php 
  $directeur  = get_field_object('directeur_site');
  $adresse    = get_field_object('adresse_site');
  $horaires   = get_field_object('horaires_site');

?>

<ul class="infos">
  <li class="infos__row">
    <span class="infos__label"><?php echo $directeur['label']; ?></span>
    <span class="infos__value"><?php echo $directeur['value']; ?></span>
  </li>
  <li class="infos__row">
    <span class="infos__label"><?php echo $adresse['label']; ?></span>
    <span class="infos__value"><?php echo $adresse['value']['address']; ?> — <?php echo $adresse['value']['post_code']; ?> <?php echo $adresse['value']['city']; ?></span>
  </li>
  <li class="infos__row">
    <span class="infos__label"><?php echo $horaires['label']; ?></span>
    <span class="infos__value"><?php echo $horaires['value']; ?></span>
  </li>
</ul>