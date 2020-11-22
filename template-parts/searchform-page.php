<div class="searchFormPage">
  <form class="searchFormPage__form" action="<?php echo esc_url( site_url() ); ?>" method="get">
    <label class="sr-only" for="searchForm">Rechercher</label>
    <input class="searchFormPage__input" type="search" name="s" placeholder="Rechercher…" value="<?php the_search_query(); ?>">
    <button class="searchFormPage__submit btn -dark" type="submit">
      Rechercher
    </button>
  </form>
</div>