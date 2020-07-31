<?php
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    $result = array();
    $code = 405;
    $postData = json_decode(file_get_contents('php://input'), true);
    if (isset($postData['requestType'])) {
        $theBase = new PDO('pgsql:host=localhost;port=5432;dbname=atomskills_goppen',
                           'atom_goppen', 'AtomSkills2020', array(PDO::ATTR_PERSISTENT => true));
        $code = 200;
        switch ($postData['requestType']) {
            case "loginExists":
                if (isset($postData['login'])) {
                    $result['result'] = $theBase->query('SELECT "login" from "users" WHERE "login" = "' . $postData['login'] . '"')->rowCount() > 0;
                };
                break;
    
                case "emailExists":
                    if (isset($postData['email'])) {
                        $result['result'] = $theBase->query('SELECT "email" from "users" WHERE "email" = \'' . $postData['email'] . '\'')->rowCount() > 0;
                    };
                    break;
    
                default:
                    $code = 501;
            }; // switch
    }; // if
    header("Access-Control-Allow-Orgin: *");
    header("Access-Control-Allow-Methods: *");
    header("Content-Type: application/json");
    http_response_code($code);
    echo json_encode($result);
    $theBase = null;
}; // if