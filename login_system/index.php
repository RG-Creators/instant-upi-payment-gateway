<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login & Signup</title>
  <link rel="stylesheet" href="style/style.css">
  <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
  <section class="container forms">
      <div class="form login">
        <div class="form-content">
          <header>Login</header>
          <form action="backend/login.php" method="POST">
            <div class="field input-field">
              <input type="email" name="email" placeholder="Email" class="input" required>
            </div>
            <div class="field input-field">
              <input type="password" name="password" placeholder="Password" class="password" required>
              <i class='bx bx-hide eye-icon'></i>
            </div>
            <div class="form-link">
              <a href="#" class="forgot-pass">Forgot password?</a>
            </div>
            <div class="field button-field">
              <button type="submit">Login</button>
            </div>
          </form>
          <div class="form-link">
            <span>Don't have an account? <a href="#" class="link signup-link">Signup</a></span>
          </div>
        </div>
        <div class="line"></div>
        <div class="media-options">
          <a href="#" class="field facebook social-login">
            <i class='bx bxl-facebook facebook-icon'></i>
            <span>Login with Facebook</span>
          </a>
        </div>
        <div class="media-options">
          <a href="#" class="field google social-login">
            <span>Login with Google</span>
          </a>
        </div>
      </div>  

      <!-- Signup Form -->
      <div class="form signup">
        <div class="form-content">
          <header>Signup</header>
          <form action="backend/signup.php" method="POST">
            <div class="field input-field">
              <input type="email" name="email" placeholder="Email" class="input" required>
            </div>
            <div class="field input-field">
              <input type="password" name="password" placeholder="Create password" class="password" required>
            </div>
            <div class="field input-field">
              <input type="password" name="confirm_password" placeholder="Confirm password" class="password" required>
              <i class='bx bx-hide eye-icon'></i>
            </div>
            <div class="field button-field">
              <button type="submit">Signup</button>
            </div>
          </form>
          <div class="form-link">
            <span>Already have an account? <a href="#" class="link login-link">Login</a></span>
          </div>
        </div>
        <div class="line"></div>
        <div class="media-options">
          <a href="#" class="field facebook social-login">
            <i class='bx bxl-facebook facebook-icon'></i>
            <span>Login with Facebook</span>
          </a>
        </div>
        <div class="media-options">
          <a href="#" class="field google social-login">
            <span>Login with Google</span>
          </a>
        </div>
      </div>
    </section>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const forms = document.querySelector(".forms"),
            pwShowHide = document.querySelectorAll(".eye-icon"),
            links = document.querySelectorAll(".link"),
            socialLogins = document.querySelectorAll(".social-login");

      // Toggle Password Visibility
      pwShowHide.forEach(eyeIcon => {
        eyeIcon.addEventListener("click", () => {
          let pwFields = eyeIcon.parentElement.parentElement.querySelectorAll(".password");
          pwFields.forEach(password => {
            password.type = password.type === "password" ? "text" : "password";
          });
          eyeIcon.classList.toggle("bx-hide");
          eyeIcon.classList.toggle("bx-show");
        });
      });

      // Toggle Between Login & Signup
      links.forEach(link => {
        link.addEventListener("click", e => {
          e.preventDefault();
          forms.classList.toggle("show-signup");
        });
      });

      // Show "Feature Under Progress" for Social Logins
      socialLogins.forEach(button => {
        button.addEventListener("click", e => {
          e.preventDefault();
          alert("Feature under progress!");
        });
      });
    });
  </script>
</body>
</html>
