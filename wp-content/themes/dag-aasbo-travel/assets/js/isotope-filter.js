document.addEventListener("DOMContentLoaded", function ($) {
  var iso = new Isotope('.isotope-container', {
    itemSelector: '.isotope-item',
    layoutMode: 'fitRows'
  });

  document.querySelectorAll('#destinasjon-filter button').forEach(function (btn) {
    btn.addEventListener('click', function () {
      let filterValue = this.getAttribute('data-filter');
      iso.arrange({ filter: filterValue });
console.log("hello");
      // active button style
      document.querySelectorAll('#destinasjon-filter button').forEach(b => b.classList.remove('active'));
      this.classList.add('active');
    });
  });
});
