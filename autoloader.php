<?php

/**
 * Description of autoloader
 *
 * @author Rodrigo Cezario da Silva <rodrigocezario@msn.com>
 * @copyright  2018 Rodrigo Cezario
 * @version V1.1
 * @link https://github.com/rodrigocezario/phprobot PHP Robot
 */


spl_autoload_register(function ($class_name) {
    $arquivo = __DIR__ . '/classes/' . $class_name . '.php';
    if (file_exists($arquivo)) {
        include_once $arquivo;
    }
});

