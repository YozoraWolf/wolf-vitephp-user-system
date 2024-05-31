<div class="form-cont">
    <div class="form-inner">
        <?php

        require_once 'config/config.php';

        if (isset($_SESSION['errors'])) {
            foreach ($_SESSION['errors'] as $error) {
                echo "<div class='error'>$error</div>";
            }
        }

        if (isset($_SESSION['signup_success'])) {
            echo "<div class='success'>User successfully created, please now login</div>";
        }
        ?>

        <form method="POST" action="controllers/login.cont.php">
            <h1>Login</h1>
            <input type="text" id="username" name="username" placeholder="Username/E-mail..."><br><br>
            <input type="password" id="password" name="password" placeholder="Password..."><br><br>

            <input type="submit" value="submit">
        </form>
    </div>





</div>