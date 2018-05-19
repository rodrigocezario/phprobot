<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Test de Communication to Arduino with Serial Port</h1>
        <?php
        /*
        // Define porta onde arduino está conectado
        $port = "/dev/cu.usbmode1411";

        // Configura velocidade de comunicação com a porta serial
        exec("stty -F $port raw speed 9600");

        // Inicia comunicação serial
        $fp = fopen($port, 'c+');

        // Escreve na porta
        fwrite($fp, "LED1:1");

        // Fecha a comunicação serial
        fclose($fp);
         * 
         */
        include_once '../classes/MotorPosicao.php';
        include_once '../classes/ICommand.php';
        include_once '../classes/ComandoMotor.php';
        include_once '../classes/Motor.php';
        include_once '../classes/ICarrinho.php';
        include_once '../classes/Carrinho.php';
        include_once 'CarrinhoTeste.php';
        
        $command = new ComandoMotor;
        
        $motor = new Motor(MotorPosicao::MOTOR1, $command);
        $motor2 = new Motor(MotorPosicao::MOTOR2, $command);
        $motor3 = new Motor(MotorPosicao::MOTOR3, $command);
        
        //$motor->run("vamos rodar...");
        
        $car = new CarrinhoTeste;
        $car->addMotor($motor);
        $car->addMotor($motor2);
        $car->addMotor($motor3);
        
        $car->printMotores();
        $car->ahead(15);
        //$car->parar();
        
        
        ?>
    </body>
</html>
