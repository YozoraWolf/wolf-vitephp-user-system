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

        // Display success message if user was successfully created (though probably not seen due to redirect)
        if (isset($_SESSION['signup_success'])) {
            echo "<div class='success'>User successfully created, please now login</div>";
        }

        ?>


        <form class="signup-form" action="controllers/signup.cont.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" placeholder="Username" required>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="Email" required>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <label for="password_repeat">Repeat Password:</label>
            <input type="password" name="password_repeat" id="password_repeat" placeholder="Repeat Password" required>
            <button type="submit" name="submit">Sign Up</button>
        </form>
    </div>

    <button onclick="document.location.href = '/login.php'">Login</button>
</div>