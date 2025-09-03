document.addEventListener("DOMContentLoaded", function () {
  // Get user logged-in status (should return '1' if logged in)
  var isUserLoggedIn = window.userIsLoggedIn?.value === '1';

  // Show only for logged-in users and only once per session
  if (isUserLoggedIn && !sessionStorage.getItem("discountPopupShown")) {
    setTimeout(function () {
      const popup = document.getElementById("discount-popup");
      if (popup) popup.style.display = "flex"; // or "block" if you're not using flex
      sessionStorage.setItem("discountPopupShown", "true");
    }, 2000); // show after 2 seconds
  }

  // Close popup on button click
  document.addEventListener("click", function (e) {
    if (e.target.classList.contains("close-popup") || e.target.id === "popup-close") {
      const popup = document.getElementById("discount-popup");
      if (popup) popup.style.display = "none";
    }
  });
});
