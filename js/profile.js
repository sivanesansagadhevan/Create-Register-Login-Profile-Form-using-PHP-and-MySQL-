// profile.js

$(document).ready(function() {
  var userId = localStorage.getItem("loggedInUser");
  if (!userId) {
    window.location.href = "login.php";
  } else {
    $.ajax({
      type: "GET",
      url: "profile.php",
      data: { user_id: userId },
      dataType: "json",
      success: function(response) {
        $("#name").text(response.name);
        $("#email").text(response.email);
        $("#age").val(response.age);
        $("#dob").val(response.dob);
        $("#contact").val(response.contact);
      },
      error: function() {
        alert("An error occurred");
      }
    });

    $("#updateForm").submit(function(e) {
      e.preventDefault();
      var age = $("#age").val();
      var dob = $("#dob").val();
      var contact = $("#contact").val();
      $.ajax({
        type: "POST",
        url: "update_profile.php",
        data: { user_id: userId, age: age, dob: dob, contact: contact },
        dataType: "json",
        success: function(response) {
          alert(response.message);
        },
        error: function() {
          alert("An error occurred");
        }
      });
    });

    $("#logout").click(function() {
      localStorage.removeItem("loggedInUser");
      window.location.href = "login.php";
    });
  }
});
