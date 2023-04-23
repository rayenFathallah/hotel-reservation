<?php 
session_start();
if(isset($_SESSION['username'])){
    header("Location:admin.php");
}
?>
<html> 
    <head>
        <title>User login and registration</title>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
  <section>
    <div class="container">
      <div class="user signinBx">
        <div class="imgBx"><img src="./images/hotel1.jpg" alt="hotel image" /></div>
        <div class="formBx">
          <form action="validation.php" method="post">
            <h2>Sign In</h2>
            <input type="text" name="username" placeholder="Username" />
            <input type="password" name="password" placeholder="Password" />
            <button type="submit" name="" value="login" >Login</button>
            <p class="signup">
              Don't have an account ?
              <a href="#" onclick="toggleForm();">Sign Up.</a>
            </p>
          </form>
        </div>
      </div>
      <div class="user signupBx">
        <div class="formBx">
          <form action="register.php" method="post">
            <h2>Create an account</h2>
            <input type="text" name="username" placeholder="Username" />
            <input type="email" name="email" placeholder="Email Address" />
            <input type="password" name="password" placeholder="Create Password" />
            <input type="text" name="telephone" placeholder="phone number"/>
            <input type="text" name="name" placeholder="name"/>
            <button type="submit" name="" value="Sign Up">register</button>
            <p class="signup">
              Already have an account ?
              <a href="#" onclick="toggleForm();">Sign in.</a>
            </p>

          </form>
        </div>
        <div class="imgBx"><img src="./images/hotel.jpg" alt="hotel picture" /></div>
      </div>
    </div>
  </section>
</body>

</html>
<script>
    const toggleForm = () => {
  const container = document.querySelector('.container');
  container.classList.toggle('active');
};
</script>