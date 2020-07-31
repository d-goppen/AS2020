<?php

use app\engine\UseTemplate;

include "../engine/Autoload.php";

spl_autoload_register([new Autoload(), 'loadClass']);

$template = new UseTemplate();

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    $theBase = new PDO('pgsql:host=localhost;port=5432;dbname=atomskills_goppen',
                       'atom_goppen', 'AtomSkills2020', array(PDO::ATTR_PERSISTENT => true));
    if ($_SERVER["QUERY_STRING"]=="registration") {
        $sql = 'INSERT INTO "users" VALUES
                (DEFAULT, :theLogin, :thePass,
                 :fName, :pName, :surName, NULL, NULL, NULL, :email, now(), NULL)';
        $prepared = $theBase->prepare($sql);
        if ($prepared->execute(array(':theLogin'=>mb_strtolower($_POST['eMail']),
                                 ':thePass'=>password_hash($_POST['pass1'], PASSWORD_DEFAULT),
                                 ':fName'=>$_POST['fName'],
                                 ':pName'=>isset($_POST['pName']) ? $_POST['pName'] : 'NULL',
                                 ':surName'=>$_POST['surName'],
                                 ':email'=>mb_strtolower($_POST['eMail'])))) {
            echo $template->getData('../tpl/main.php',['login' => 1, 'userName' => $_POST['eMail']]);
        }; // if
    } elseif ($_SERVER["QUERY_STRING"]=="login") {
        $sql = 'SELECT * FROM "users" WHERE "login"=:theUser';
        $prepared = $theBase->prepare($sql);
        if ($prepared->execute(array(':theUser'=>mb_strtolower($_POST['login'])))) {
            $userInfo = $prepared->fetchAll();
            if (password_verify($_POST['pass'], $userInfo[0]['pass'])) {
                    echo '<h1 style="color: green;">Access granted<h1>';
                } else {
                    echo '<h1 style="color: red;">Access denied<h1>';
                };
        }; // if
    };
    $prepared = null;
    $theBase = null;
} else if($_SERVER["REQUEST_METHOD"]=="GET") {
    if (count($_GET)) {
        if (isset($_GET['registration'])) {
            echo $template->getData('../tpl/main.php',['registration' => 1]);
        } elseif (isset($_GET['login'])) {
            echo $template->getData('../tpl/main.php',['login' => 1]);
        }; // elseif
    } else {
        echo $template->getData('../tpl/main.php',['login' => 1]);
    }; // else
};
