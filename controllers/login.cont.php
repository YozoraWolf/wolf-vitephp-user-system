<?php
require_once 'incl/db.incl.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    try {
        $data = new FormData($_POST['username'], $_POST['username'], $_POST['password'], $_POST['password']);
        
        // Validate the fields 
        $fields_valid = are_fields_valid($data);
        if ($fields_valid !== LoginErrors::none) {
            $errors[] = $login_msgs[$fields_valid];
        }

        // Attempt to login the user
        $login = login_user($data, $pdo);
        if ($login !== LoginErrors::none) {
            $errors[] = $login_msgs[$login];
        }

        require_once 'config/config.php';

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header('Location: /login.php');
            exit();
        }

        // Successful login
        header('Location: /dashboard.php'); // Redirect to a different page upon successful login
        exit();
    } catch (Exception $e) {

        header('Location: /login.php');
        exit();
    }
} else {
    header('Location: /login.php');
    exit();
}

enum LoginErrors {
    case none;
    case empty;
    case email;
    case password_invalid;
}

$login_msgs = [
    LoginErrors::none => 'none',
    LoginErrors::empty => 'Please fill in all fields',
    LoginErrors::email => 'Invalid e-mail',
    LoginErrors::password_invalid => 'Invalid e-mail or password'
];

function are_fields_valid(FormData $data) {
    $email = htmlspecialchars($data->email);
    $password = htmlspecialchars($data->password);
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        return LoginErrors::email;
    }
    if (empty($email) || empty($password)) {
        return LoginErrors::empty;
    }
    return LoginErrors::none;
}

function login_user(FormData $data, object $pdo) {
    $email = htmlspecialchars($data->email);
    $password = htmlspecialchars($data->password);

    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result && password_verify($password, $result['password'])) {
        return LoginErrors::none;
    }

    return LoginErrors::password_invalid;
}
?>
