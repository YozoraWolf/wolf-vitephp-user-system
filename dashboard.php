<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="./global.css" />
    </head>
    <body>
        <?php 
            require_once 'incl/db.incl.php';
            require_once 'models/form.model.php';
            require_once 'config/config.php';

            if(isset($_SESSION['user'])) {
                require_once 'views/dashboard.view.php';
            } else {
                $_SESSION['errors'] = [$login_msgs[LoginErrors::LOGIN_INVALID]];
                header('Location: /login.php');
            }
            
        ?>
    </body>
</html>