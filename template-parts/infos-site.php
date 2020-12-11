<ul class="infos">
  <?php if ( $args['directeur']['value'] ) : ?>
  <li class="infos__row">
    <span class="infos__label"><?php echo $args['directeur']['label']; ?></span>
    <span class="infos__value"><?php echo $args['directeur']['value']; ?></span>
  </li>
  <?php endif; ?>

  <?php if ( $args['adresse']['value'] ) : ?>
  <li class="infos__row">
    <span class="infos__label"><?php echo $args['adresse']['label']; ?></span>
    <span class="infos__value"><?php echo $args['adresse']['value']['address']; ?> — <?php echo $args['adresse']['value']['post_code']; ?> <?php echo $args['adresse']['value']['city']; ?></span>
  </li>
  <?php endif; ?>

  <?php if ( $args['horaires']['value'] ) : ?>
  <li class="infos__row">
    <span class="infos__label"><?php echo $args['horaires']['label']; ?></span>
    <span class="infos__value"><?php echo $args['horaires']['value']; ?></span>
  </li>
  <?php endif; ?>
</ul>