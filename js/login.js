// login.js

$(document).ready(function() {
  $("#loginForm").submit(function(e) {
    e.preventDefault();
    var email = $("#email").val();
    var password = $("#password").val();
    $.ajax({
      type: "POST",
      url: "login.php",
      data: { email: email, password: password },
      dataType: "json",
      success: function(response) {
        if (response.success) {
          localStorage.setItem("loggedInUser", response.user_id);
          window.location.href = "profile.php";
        } else {
          $("#error").text(response.message).show();
        }
      },
      error: function() {
        $("#error").text("An error occurred").show();
      }
    });
  });
});
