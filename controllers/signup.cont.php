<?php

require_once '../incl/db.incl.php';
require_once '../models/form.model.php';


include_once '../incl/crypto.incl.php';


function does_email_exist($email, $pdo) {
    global $dbtable;
    $email = htmlspecialchars(strip_tags($email));
    $query = "SELECT * FROM $dbtable WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? true : false;
}

function validate_fields($data, $errors) {
    global $signup_msgs;
    $username = $data->username;
    $email = $data->email;
    $password = $data->password;
    $password_repeat = $data->password_repeat;
    if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $errors[] = $signup_msgs[SignupErrors::EMAIL_INVALID];
    }
    if(empty($username) || empty($email) || empty($password) || empty($password_repeat)) {
        $errors[] = $signup_msgs[SignupErrors::EMP];
    }
    if($password !== $password_repeat) {
        $errors[] = $signup_msgs[SignupErrors::PASSWORD_MATCH_FAIL];
    }
}

function create_user($data, $pdo) {
    global $dbtable;
    $username = htmlspecialchars(strip_tags($data->username));
    $email = htmlspecialchars(strip_tags($data->email));
    $password = htmlspecialchars(strip_tags($data->password));
    $password = bcrypt_hash($password);
    $query = "INSERT INTO $dbtable (username, email, password) VALUES (:username, :email, :password)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    var_dump($stmt);
    $stmt->execute();
}

// Check if form was submitted
if(isset($_POST['submit'])) {
    $errors = [];
    try {

        $data = new FormData($_POST['username'], $_POST['email'], $_POST['password'], $_POST['password_repeat']);
        validate_fields($data, $errors);

        require_once '../config/config.php';

        if(does_email_exist($data->email, $pdo)) {
            $errors[] = $signup_msgs[SignupErrors::EMAIL_EXISTS];
            $_SESSION['errors'] = $errors;
            header('Location: /signup.php');
            exit();
        }

        create_user($data, $pdo);
        $_SESSION['signup_success'] = true;
        header('Location: /login.php');
        exit();
    } catch (Exception $e) {
        echo "Error: {$e->getMessage()}";
    }

}

?>