<div class="form-cont">
    <div class="form-inner">
        <?php

        require_once 'config/config.php';

        // Display error messages if there are any
        if (isset($_SESSION['errors'])) {
            foreach ($_SESSION['errors'] as $error) {
                echo "<div class='error'>$error</div>";
            }
        }

        // Display success message if user was successfully created
        if (isset($_SESSION['signup_success'])) {
            echo "<div class='success'>User successfully created, please now login</div>";
        }

        // Redirect to dashboard if user is already logged in
        if(isset($_SESSION['user'])) {
            header('Location: /dashboard.php');
        }

        ?>

        <form method="POST" action="controllers/login.cont.php">
            <h1>Login</h1>
            <input type="text" id="username" name="username" placeholder="Username/E-mail..."><br><br>
            <input type="password" id="password" name="password" placeholder="Password..."><br><br>

            <input type="submit" value="submit">
        </form>
    </div>

    <button onclick="document.location.href = '/signup.php'">Sign Up</button>


</div>