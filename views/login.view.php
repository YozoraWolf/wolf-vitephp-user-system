<div class="form-cont">

    <form method="POST" action="controllers/login.cont.php">
        <h1>Login</h1>
        <input type="text" id="username" name="username" placeholder="Username/E-mail..."><br><br>
        <input type="password" id="password" name="password" placeholder="Password..."><br><br>

        <input type="submit" value="submit">
    </form>


    <?php
    
    class LoginErrors {
        const NONE = 'none';
        const EMP = 'empty';
        const EMAIL = 'email';
        const PASSWORD_INVALID = 'password_invalid';
    }

    $login_msgs = [
        LoginErrors::NONE => 'none',
        LoginErrors::EMP => 'Please fill in all fields',
        LoginErrors::EMAIL => 'Invalid e-mail',
        LoginErrors::PASSWORD_INVALID => 'Invalid e-mail or password'
    ];

    if (isset($_SESSION['errors'])) {
        foreach ($_SESSION['errors'] as $error) {
            echo "<p>$error</p>";
        }
    }
    ?>

</div>