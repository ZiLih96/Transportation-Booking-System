// Function to show alert message after registration attempt
document.getElementById("registerForm").addEventListener("submit", function(event) {
    event.preventDefault();
    var formData = new FormData(this);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", this.action, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Registration successful
                showAlert("Registration successful! Welcome to GoSchool.");
                window.location.href = "/login"; // Directly specify the URL
            } else {
                // Registration unsuccessful, handle error response
                var response = JSON.parse(xhr.responseText);
                if (response.error) {
                    // Display error message for duplicate username
                    showAlert("Registration failed. " + response.error);
                }
            }
        }
    };
    xhr.send(formData);
});

function showAlert(message) {
    alert(message);
}