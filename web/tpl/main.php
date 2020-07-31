<?php

use app\engine\UseTemplate;

$template = new UseTemplate(); ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dron Taxi</title>
    <link rel="shortcut icon" href="./icon-svg/Logo_Dron_Taxi.svg" type="image/x-icon">
    <link rel="stylesheet" href="./css/main.css">
</head>
    <body>
        <div class="container dronBack">
            <div class="container">
                <?php echo $template->getData('../tpl/logo.php', ['logoNum' => 2]); ?>
                <div style="display: flex; align-items: center; justify-content: <?=isset($params['registration']) ? 'center' : 'flex-start'; ?>;">
                <?php if (isset($params['login'])) {
                    echo $template->getData('../tpl/loginForm.php', $params);
                } elseif (isset($params['registration'])) {
                    echo $template->getData('../tpl/regForm.php');                    
                }; ?>
                </div>
            </div>
        </div>    
    </body>
</html>