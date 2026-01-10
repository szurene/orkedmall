const passwordField = document.getElementById("password");
const confirmField  = document.getElementById("confirm");
const birthDateField = document.getElementById("birthDate");

const passwordError = document.getElementById("passwordError");
const confirmError  = document.getElementById("confirmError");
const ageError = document.getElementById("ageError");

// PASSWORD STRENGTH CHECK
passwordField.addEventListener("input", validatePassword);
confirmField.addEventListener("input", validateConfirm);
birthDateField.addEventListener("change", validateAge);

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

// CONFIRM PASSWORD CHECK
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

// AGE VALIDATION (Must be 18+)
function validateAge() {
    const birthDate = new Date(birthDateField.value);
    const today = new Date();
    
    // Calculate age
    let age = today.getFullYear() - birthDate.getFullYear();
    const monthDiff = today.getMonth() - birthDate.getMonth();
    const dayDiff = today.getDate() - birthDate.getDate();
    
    // Adjust age if birthday hasn't occurred yet this year
    if (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)) {
        age--;
    }
    
    if (birthDateField.value === "") {
        ageError.style.display = "none";
        return true; // Let HTML5 required attribute handle empty field
    }
    
    if (age < 18) {
        ageError.style.display = "block";
        ageError.textContent = "You must be 18 years or older to register.";
        birthDateField.classList.add("error");
        return false;
    } else {
        ageError.style.display = "none";
        birthDateField.classList.remove("error");
        return true;
    }
}

// FINAL FORM VALIDATION
function validateRegister() {
    const passOK = validatePassword();
    const confirmOK = validateConfirm();
    const ageOK = validateAge();
    
    if (!ageOK) {
        // Scroll to age error for better UX
        birthDateField.scrollIntoView({ behavior: 'smooth', block: 'center' });
        birthDateField.focus();
    }
    
    return passOK && confirmOK && ageOK;
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

// Initialize validation on page load (in case of back navigation with errors)
document.addEventListener('DOMContentLoaded', function() {
    // If there's already a value in birth date field, validate it
    if (birthDateField.value) {
        validateAge();
    }
});