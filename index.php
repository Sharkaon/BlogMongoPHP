<?php
require_once 'vendor/autoload.php';
require_once 'config.php';
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo HOME_URL?>/styles/style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"/>
        <title>Blog</title>
    </head>
    <body>
        <div id="mainContent">
            <?php
                require_once 'start.php';
            ?>
        </div>
    </body>
</html>