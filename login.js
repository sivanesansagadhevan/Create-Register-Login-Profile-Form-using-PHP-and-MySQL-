document.addEventListener('DOMContentLoaded', function() {
  // Get the login form element and add a submit event listener
  var form = document.getElementById('login-form');
  form.addEventListener('submit', function(event) {
    // Prevent the default form submission
    event.preventDefault();

    // Validate the form fields
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var errors = [];
    if (!email) {
      errors.push('Email is required');
    }
    if (!password) {
      errors.push('Password is required');
    }

    // If there are no errors, submit the form
    if (errors.length == 0) {
      form.submit();
    } else {
      // Display the errors to the user
      var errorContainer = document.getElementById('error-container');
      errorContainer.innerHTML = '';
      var errorList = document.createElement('ul');
      errors.forEach(function(error) {
        var listItem = document.createElement('li');
        listItem.textContent = error;
        errorList.appendChild(listItem);
      });
      errorContainer.appendChild(errorList);
    }
  });
});
