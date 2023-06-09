<?php 
$login_page = true; //set a variable as a trigger for the if statement on the header 
include 'header.php';

if(isset($_SESSION['logged_in'])){
    header('Location: blogs.php');
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $data = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $data->execute([$email]);

    foreach ($data as $row) {
        if (password_verify($password, $row['password'])) {
            
            $_SESSION['user_id'] = $row['u_id']; //create a session variable named user_id and set it to the user_id
            $_SESSION['logged_in'] = true; //create a session variable named logged_in and set it to true

            header("location: blogs.php");
        } else {
            $message = "Email or password incorrect!";
        }
    }
}
?>
<h1>This from login page</h1>
<div class="row justify-content-center">
    <div class="col-4">
        <?php
        if (isset($message)) { ?>
            <div class="alert alert-info" role="alert">
                <?= $message; ?>
            </div>
        <?php   }
        ?>
        <form action="login.php" method="POST" class="shadow p-4 mt-4">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
            </div>
            <div class="form-group mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <button name="login" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
    </div>
</body>
</html>