<?php
require_once('classes/database.php');
$con=new database(); 
if(isset($_POST['SignUp'])){
    $UserName = $_POST['UserName'];
    $UserPass = $_POST['UserPass'];
    $confirm = $_POST['confirm'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $birthday = $_POST['birthday'];
    $sex = $_POST['sex'];

  if ($UserPass == $confirm){
        if ($con->signup($UserName, $UserPass, $firstname, $lastname, $birthday, $sex)){
            header('location:login.php');
    } else {
        $error_message = "Username already exists. Please choose a different username.";
        }
    } else {
        $error_message = "Password did not match.";
    }  
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up Page</title>
  <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .login-container {
      max-width: 400px;
      margin: 0 auto;
      margin-top: 100px;
      height: auto;
      padding: 20px;
    }
  </style>
</head>
<body>

<div class="container-fluid login-container rounded shadow">
  <h2 class="text-center mb-4">Register Now</h2>

  <form method = "post">
  <div class="form-group">
    <label for="firstname">Firstname:</label>
    <input type="text" class="form-control" name = "firstname" placeholder="Enter firstname">
  </div>
  <div class="form-group">
    <label for="lastname">Lastname:</label>
    <input type="text" class="form-control" name = "lastname" placeholder="Enter lastname">
  </div>
  <div class="mb-3">
      <label for="birthday" class="form-label">Birthday:</label>
      <input type="date" class="form-control" name="birthday">
    </div>
    <div class="mb-3">
      <label for="sex" class="form-label">Sex:</label>
      <select class="form-select" name="sex">
        <option selected disabled>Select Sex</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
      </select>
    </div>
    <div class="form-group">
      <label for="UserName">Username:</label>
      <input type="text" class="form-control" name = "UserName" placeholder="Enter username">
    </div>
    <div class="form-group">
      <label for="UserPass">Password:</label>
      <input type="password" class="form-control" name = "UserPass" placeholder="Enter password">
    </div>
      <div class="form-group">
    <label for="UserPass">Confirm Password:</label>
    <input type="password" class="form-control" required name = "confirm" placeholder="Enter password">
  </div>
<?php if (!empty($error_message)): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>
    <input type="submit" name = "SignUp" class="btn btn-danger btn-block" value = "Sign Up"></input>

  </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>