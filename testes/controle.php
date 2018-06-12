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
        <h2>Controle do robo</h2>
        <form action="controle.php" method="post">
            <input type="submit" value="Frente" name="frente">
            <input type="submit" value="Tras" name="tras">
            <input type="submit" value="Parar" name="parar">
        </form>
        <?php
        include_once '../autoloader.php';
        include_once 'CarrinhoTeste.php';
        
        $command = new ComandoMotor;
        
        $motor = new Motor(MotorPosicao::MOTOR1, $command);
        $motor2 = new Motor(MotorPosicao::MOTOR2, $command);
        $motor3 = new Motor(MotorPosicao::MOTOR3, $command);
        $motor4 = new Motor(MotorPosicao::MOTOR4, $command);
        
        //$motor->run("vamos rodar...");
        
        $car = new CarrinhoTeste;
        $car->addMotor($motor);
        $car->addMotor($motor2);
        $car->addMotor($motor3);
        $car->addMotor($motor4);
        
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST["frente"])) {
                echo "Andar para frente</br>";
                $car->ahead(15);
            } else if(isset($_POST["tras"])) {
                echo "Andar para tras</br>";
                $car->back(33);
            } else if(isset($_POST["parar"])) {
                echo "Parar</br>";
                $car->parar();
            }
        }
        ?>
    </body>
</html>
