<?php
require_once 'controllers/signup.cont.php';
?>

<form class="signup-form" action="controllers/signup.cont.php" method="post">
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