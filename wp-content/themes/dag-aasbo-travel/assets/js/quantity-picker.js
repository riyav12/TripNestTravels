document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".quantity-picker").forEach(function (picker) {
    const input = picker.querySelector(".qty-input");
    picker.querySelector(".plus").addEventListener("click", function () {
      input.value = parseInt(input.value) + 1;
    });
    picker.querySelector(".minus").addEventListener("click", function () {
      if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
      }
    });
  });
});
