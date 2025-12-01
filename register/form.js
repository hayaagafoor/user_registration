document.addEventListener("DOMContentLoaded", function () {

    const form = document.querySelector("form");

    form.addEventListener("submit", function(e) {

        let valid = true;

        document.querySelectorAll(".error").forEach(el => el.textContent = "");

        let name = document.getElementById("name").value.trim();
        let phone = document.getElementById("phone").value.trim();
        let email = document.getElementById("email").value.trim();
        let password = document.getElementById("password").value;
        let cpassword = document.getElementById("cpassword").value;

        //name shouldn't be empty
        if (name === "") {
            document.getElementById("nameError").textContent = "Name is required";
            valid = false;
        }
        //phone number validation
        if (!/^[0-9]{10}$/.test(phone)) {
            document.getElementById("phoneError").textContent = "Phone number must be exactly 10 digits";
            valid = false;
        }

        else if (!/^[6-9]/.test(phone)) {
            document.getElementById("phoneError").textContent = "Phone number must start with 6, 7, 8, or 9";
            valid = false;
        }
        //email validation
        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            document.getElementById("emailError").textContent = "Enter a valid email address";
            valid = false;
        }
        //password matching
        if (password !== cpassword) {
            document.getElementById("passwordError").textContent = "Passwords do not match";
            valid = false;
        }

        if (!valid) {
            e.preventDefault(); 
        }

    });

});