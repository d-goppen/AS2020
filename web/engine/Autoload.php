<?php

class Autoload
{
    public function loadClass($className) {
        $fileName = preg_replace(['/^app\\\/i', '/\\\/'], ["../", "/"], $className) . '.php';
        if (file_exists($fileName)) {
            include $fileName;
        }
    } // loadClass()
} // class Autoload