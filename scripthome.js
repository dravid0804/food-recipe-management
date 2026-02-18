$(document).ready(function () {
    // Open Modals
    $("#loginBtn").click(() => $("#loginModal").fadeIn());
    $("#registerBtn").click(() => $("#registerModal").fadeIn());

    // Close Modals
    $(".close").click(() => $(".modal").fadeOut());

    // Login Form Submission
    $("#loginForm").submit(function (e) {
        e.preventDefault();
        $.post("login.php", {
            username: $("#loginUsername").val(),
            password: $("#loginPassword").val()
        }, function (response) {
            alert(response);
            if (response === "Login successful!") {
                window.location.href = "dashboard.html";
            }
        });
    });

    // Register Form Submission
    $("#registerForm").submit(function (e) {
        e.preventDefault();
        $.post("register.php", {
            username: $("#regUsername").val(),
            email: $("#regEmail").val(),
            password: $("#regPassword").val()
        }, function (response) {
            alert(response);
        });
    });
});
