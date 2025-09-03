jQuery(document).ready(function($) {
  function updateWishlistCount() {
    $.ajax({
      url: ajax_object.ajax_url,
      type: 'POST',
      data: {
        action: 'get_wishlist_count'
      },
      success: function(response) {
        if (response.success) {
          $('.wishlist-count').remove(); // Remove old count
          if (response.count > 0) {
            $('.wishlist-icon .nav-link').append(
              '<span class="wishlist-count">' + response.count + '</span>'
            );
          }
        }
      }
    });
  }

  // Listen for YITH wishlist added event
  $(document.body).on('added_to_wishlist removed_from_wishlist', function () {
    updateWishlistCount();
  });

  // Trigger it once on load too, in case something's out of sync
  updateWishlistCount();
});
