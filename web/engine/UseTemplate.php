<?php

namespace app\engine;

class UseTemplate {
    public function getData($tpl, $params = []) {
        extract($params);
        ob_start();
        include($tpl);
        return ob_get_clean();
    } // use()
} // class UseTemplate