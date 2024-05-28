<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <script type="module" src="/src/main.js"></script>
    </head>
    <body>
        <?php 
            require_once 'incl/db.incl.php';
        ?>

        <?php 
            if($_SESSION['user']) {
                require_once 'views/home.view.php';
            } else {
                header('Location: /login');
            }
            
        ?>
    </body>
</html>