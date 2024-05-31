<?php

include_once '../models/form.model.php';
require_once '../incl/db.incl.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    try {
        $data = new FormData($_POST['username'], $_POST['username'], $_POST['password'], $_POST['password']);

        // Validate the fields 
        $fields_valid = are_fields_valid($data);
        if ($fields_valid !== LoginErrors::NONE) {
            $errors[] = $login_msgs[$fields_valid];
        }

        // Attempt to login the user
        if (!empty($data->username)) {
            $login = login_user($data, $pdo);
            if ($login !== LoginErrors::NONE) {
                $errors[] = $login_msgs[$login];
            }
        }

        var_dump($errors);

        require_once '../config/config.php';

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            print_r($_SESSION); // Debugging
            session_write_close();
            header('Location: /login.php');
            exit();
        }

        // Successful login
        header('Location: /index.php'); // Todo: Create a Dashboard or something ? lol
    } catch (Exception $e) {
        $_SESSION['errors'] = ['An error occurred. Please try again later.'];
        header('Location: /login.php');
        exit();
    }
} else {
    header('Location: /login.php');
}



function are_fields_valid($data) {
    $email = htmlspecialchars($data->email);
    $password = htmlspecialchars($data->password);
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        return LoginErrors::EMAIL_INVALID;
    }
    if (empty($email) || empty($password)) {
        return LoginErrors::EMP;
    }
    return LoginErrors::NONE;
}

function login_user($data, $pdo) {
    global $dbtable;

    $email = htmlspecialchars($data->email);
    $password = htmlspecialchars($data->password);

    if (!checkTableExists($dbtable, $pdo)) {
        createTable($dbtable, $pdo);
    }

    $query = "SELECT * FROM $dbtable WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        return LoginErrors::EMAIL_NOT_FOUND;
    }

    if ($result && password_verify($password, $result['password'])) {
        return LoginErrors::NONE;
    }

    return LoginErrors::PASSWORD_INVALID;
}
