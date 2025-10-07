<?php
    if (isset($_REQUEST['viewLogin'])) {
        $vistaLogin = $_REQUEST['viewLogin'];
    }else {
        $vistaLogin = "login";
    }
    switch ($vistaLogin) {
        case "login":{
            require_once './views/login.php';
            break;
        }
        default:{
            require_once './views/error404.php';
        }
        break;
    }
?>