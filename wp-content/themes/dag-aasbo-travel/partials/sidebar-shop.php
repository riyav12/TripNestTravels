<aside class="shop-sidebar">

  <h3>Active Filters</h3>
  <div id="active-filters"></div>

  <div class="widget price-filter">
  <h4>Price</h4>
  <div id="price-slider"></div>
  <p>Price: <span id="price-range-display">0 - 100</span></p>
  <input type="hidden" name="min_price" id="min_price" value="0">
  <input type="hidden" name="max_price" id="max_price" value="100">
</div>


  <h3>Stock status</h3>
  <label><input type="radio" name="stock_status" value="instock"> Show in stock</label><br>
  <label><input type="radio" name="stock_status" value=""> Show all</label>

  <h3>Filter by Color</h3>
  <ul>
    <?php
    $colors = get_terms(['taxonomy' => 'pa_color', 'hide_empty' => true]);
    foreach ($colors as $color) {
        echo '<li><label><input type="checkbox" name="color[]" value="' . esc_attr($color->slug) . '"> ' . esc_html($color->name) . '</label></li>';
    }
    ?>
  </ul>

  <h3>Filter by Size</h3>
  <ul>
    <?php
    $sizes = get_terms(['taxonomy' => 'pa_size', 'hide_empty' => true]);
    foreach ($sizes as $size) {
        echo '<li><label><input type="checkbox" name="size[]" value="' . esc_attr($size->slug) . '"> ' . esc_html($size->name) . '</label></li>';
    }
    ?>
  </ul>

</aside>
