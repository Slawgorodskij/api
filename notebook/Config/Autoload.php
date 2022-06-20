<?php

namespace App\Config;

class Autoload
{

    public function loadClass($className)
    {
        $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        $fileName = str_replace('App\\', dirname(__DIR__) . DIRECTORY_SEPARATOR, $className) . ".php";

        if (file_exists($fileName)) {
            include $fileName;
        }
    }
}