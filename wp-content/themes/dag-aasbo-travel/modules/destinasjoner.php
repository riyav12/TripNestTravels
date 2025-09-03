<?php
/**
 * Destinasjoner Section (Isotope filter layout)
 */

?>

<section class="container py-5 destinasjoner">
  <h2 class="text-center fw-bold mb-4" >
    <?php _e('Destinasjoner', 'dagasbo'); ?>
  </h2>

  <!-- Filter Buttons -->
  <ul class="nav justify-content-center gap-2 flex-wrap mb-4 filter-buttons" id="destinasjon-filter">
    <li class="nav-item">
      <button class="btn btn-outline-secondary btn-sm active" data-filter="*">
        <?php _e('Alle reisemåter', 'dagasbo'); ?>
      </button>
    </li>
    <li class="nav-item">
      <button class="btn btn-outline-primary btn-sm" data-filter=".fly">
        <?php _e('Flyreiser', 'dagasbo'); ?>
      </button>
    </li>
    <li class="nav-item">
      <button class="btn btn-outline-secondary btn-sm" data-filter=".buss">
        <?php _e('Bussreiser', 'dagasbo'); ?>
      </button>
    </li>
    <li class="nav-item">
      <button class="btn btn-outline-secondary btn-sm" data-filter=".cruise">
        <?php _e('Cruisereiser', 'dagasbo'); ?>
      </button>
    </li>
  </ul>

  <!-- Isotope Container with Destination Cards -->
  <div class="row g-4 isotope-container">
    <?php
      $cards_path = get_template_directory() . '/partials/_destination_cards.php';
      if (file_exists($cards_path)) {
        include $cards_path;
      } else {
        echo '<div class="col-12 text-danger text-center">Destinasjonskort-filen mangler.</div>';
      }
    ?>
  </div>
</section>
