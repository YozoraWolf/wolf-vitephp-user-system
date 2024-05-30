<?php

require_once 'incl/db.incl.php';
class SignupErrors {
    const NONE = 'none';
    const EMP = 'empty';
    const EMAIL = 'email';
    const PASSWORD_VERIFY = 'password_invalid';
}

function does_email_exist(string $email, object $pdo) {
    $email = htmlspecialchars(strip_tags($email));
    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
}

function are_fields_valid(FormData $data) {
    $username = $data->username;
    $email = $data->email;
    $password = $data->password;
    $password_repeat = $data->password_repeat;
    if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        return SignupErrors::EMAIL;
    }
    if(empty($username) || empty($email) || empty($password) || empty($password_repeat)) {
        return SignupErrors::EMP;
    }
    if($password !== $password_repeat) {
        return SignupErrors::PASSWORD_VERIFY;
    }
    return SignupErrors::NONE;
}

function create_user(FormData $data, object $pdo) {
    $username = htmlspecialchars(strip_tags($data->username));
    $email = htmlspecialchars(strip_tags($data->email));
    $password = htmlspecialchars(strip_tags($data->password));
    $password = password_hash($password, PASSWORD_BCRYPT_DEFAULT_COST);
    $query = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
}

// Check if form was submitted
if(isset($_POST['submit'])) {
    $errors = null;
    try {

        $data = new FormData($_POST['username'], $_POST['email'], $_POST['password'], $_POST['password_repeat']);
        $fields_valid = are_fields_valid($data);
        if($fields_valid !== SignupErrors::NONE) {
            $errors = $fields_valid;
        }
        if(does_email_exist($data->email, $pdo)) {
            $errors = SignupErrors::EMAIL;
        }
        create_user($data, $pdo);
    } catch (Exception $e) {
        echo "Error: {$e->getMessage()}";
    }

}

?>