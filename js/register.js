$(document).ready(function() {
  $('#register-form').submit(function(e) {
    e.preventDefault();
    var name = $('#name').val().trim();
    var email = $('#email').val().trim();
    var password = $('#password').val().trim();
    var confirmPassword = $('#confirm-password').val().trim();

    if (name == '') {
      $('#error-message').html('Please enter your name');
      return false;
    }
    if (email == '') {
      $('#error-message').html('Please enter your email');
      return false;
    }
    if (password == '') {
      $('#error-message').html('Please enter a password');
      return false;
    }
    if (confirmPassword == '') {
      $('#error-message').html('Please confirm your password');
      return false;
    }

    if (password != confirmPassword) {
      $('#error-message').html('Passwords do not match');
      return false;
    }

    $.ajax({
      type: 'POST',
      url: 'register.php',
      data: { name: name, email: email, password: password },
      success: function(response) {
        if (response == 'success') {
          window.location.href = 'profile.php';
        } else {
          $('#error-message').html(response);
        }
      }
    });
  });
});
