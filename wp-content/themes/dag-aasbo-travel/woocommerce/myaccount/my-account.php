<?php
defined('ABSPATH') || exit;
?>

<section class="container py-5 my-account-page">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="row g-0 bg-white border rounded-4 overflow-hidden shadow-sm">
        
        <!-- Sidebar -->
        <aside class="col-md-4 bg-light border-end">
          <div class="p-4 h-100">
            <h5 class="mb-4 fw-semibold text-primary">My Account</h5>
            <?php do_action('woocommerce_account_navigation'); ?>
          </div>
        </aside>

        <!-- Content -->
        <div class="col-md-8">
          <div class="p-4 h-100">
            <?php do_action('woocommerce_account_content'); ?>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>
