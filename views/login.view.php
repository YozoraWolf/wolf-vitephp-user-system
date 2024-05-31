<div class="form-cont">

    <div class="form-inner">
        <?php

        require_once 'config/config.php';
        require_once 'models/form.model.php';

        if (isset($_SESSION['errors'])) {
            foreach ($_SESSION['errors'] as $error) {
                echo "<div class='error'>$error</div>";
            }
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