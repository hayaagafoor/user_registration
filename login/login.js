document.addEventListener("DOMContentLoaded", function () {

  const form = document.querySelector("form");

  form.addEventListener("submit", function (e) {
    let valid = true;

    // clear previous errors
    document.querySelectorAll(".error").forEach(el => el.textContent = "");

    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();

    // Email validation
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email === "") {
      document.getElementById("emailError").textContent = "Email is required";
      valid = false;
    } else if (!emailPattern.test(email)) {
      document.getElementById("emailError").textContent = "Enter valid email";
      valid = false;
    }

    // Password validation
    if (password === "") {
      document.getElementById("passwordError").textContent = "Password is required";
      valid = false;
    }

    if (!valid) {
      e.preventDefault(); // stop form submit
    }
  });

});
