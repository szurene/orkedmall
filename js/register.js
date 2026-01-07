const passwordField = document.getElementById("password");
const confirmField  = document.getElementById("confirm");

const passwordError = document.getElementById("passwordError");
const confirmError  = document.getElementById("confirmError");

// PASSWORD STRENGTH CHECK
passwordField.addEventListener("input", validatePassword);
confirmField.addEventListener("input", validateConfirm);

function validatePassword() {

    const password = passwordField.value;

    const hasUpper   = /[A-Z]/.test(password);
    const hasLower   = /[a-z]/.test(password);
    const hasNumber  = /[0-9]/.test(password);
    const hasSpecial = /[^A-Za-z0-9]/.test(password);
    const longEnough = password.length >= 6;

    if (!hasUpper || !hasLower || !hasNumber || !hasSpecial || !longEnough) {
        passwordError.style.display = "block";
        passwordError.textContent =
            "Password must include uppercase, lowercase, number, special character & at least 6 characters.";
        return false;
    } else {
        passwordError.style.display = "none";
        return true;
    }
}

// CONFIRM PASSWORD CHECK (INLINE)
function validateConfirm() {

    if (confirmField.value !== passwordField.value) {
        confirmError.style.display = "block";
        confirmError.textContent = "Confirm password does not match password.";
        return false;
    } else {
        confirmError.style.display = "none";
        return true;
    }
}

// FINAL FORM VALIDATION
function validateRegister() {
    const passOK = validatePassword();
    const confirmOK = validateConfirm();

    return passOK && confirmOK;
}

// TOGGLE HAMBURGER MENU
function toggleMenu(id) {
    const menu = document.getElementById(id);
    menu.classList.toggle("show");
}

// Close the menu if clicked outside
window.onclick = function(event) {
    if (!event.target.matches('.menu-btn')) {
        const menus = document.getElementsByClassName("menu-list");
        for (let i = 0; i < menus.length; i++) {
            if (menus[i].classList.contains('show')) {
                menus[i].classList.remove('show');
            }
        }
    }
};

