function validateForm() {
    var name = document.getElementById("name").value;
    var age = document.getElementById("age").value;
    var weight = document.getElementById("weight").value;
    var email = document.getElementById("email").value;
    var healthReport = document.getElementById("healthReport").value;

    if (name.trim() === "") {
        setError("name", "Please enter your name")
        if (name.trim() === "") {
            setError("name", "Please enter your name.");
        } else {
            clearError("name");
        }

        if (age.trim() === "") {
            setError("age", "Please enter your age.");
        } else {
            clearError("age");
        }

        if (weight.trim() === "") {
            setError("weight", "Please enter your weight.");
        } else {
            clearError("weight");
        }

        if (email.trim() === "") {
            setError("email", "Please enter your email address.");
        } else if (!isValidEmail(email)) {
            setError("email", "Please enter a valid email address.");
        } else {
            clearError("email");
        }

        if (healthReport.trim() === "") {
            setError("healthReport", "Please select a PDF file.");
        } else {
            clearError("healthReport");
        }

        if (isFormValid()) {
            // Form is valid, proceed with submission
            document.getElementById("healthReportForm").submit();
        }
    }
}

function setError(field, message) {
    document.getElementById(field).classList.add("error");
    document.getElementById(field + "Error").textContent = message;
}

function clearError(field) {
    document.getElementById(field).classList.remove("error");
    document.getElementById(field + "Error").textContent = "";
}

function isValidEmail(email) {
    var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

function isFormValid() {
    var inputs = document.getElementsByTagName("input");
    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].classList.contains("error")) {
            return false;
        }
    }
    return true;
}