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
        <h1>Controle do Robô</h1>
        <form action="index.php" method="post">
            
            <input type="submit" name="frente" value="frente">
            
            <input type="submit" name="tras" value="tras">
            
            <input type="submit" name="parar" value="parar">
            
        </form>
        
        <?php
        
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            
            include '../classes/Carrinho.php';
            include '../classes/ComandoMotor.php';
            include '../classes/ICarrinho.php';
            include '../classes/ICommand.php';
            include '../classes/Motor.php';
            include '../classes/MotorPosicao.php';
            include '../classes/PhpSerial.php';
            include '../classes/configuracoes.php';
            include '../avantis/Carro.php';
            
            
            $command = new ComandoMotor; //implmentação do serial
            
            
            $motor = new Motor(MotorPosicao::MOTOR1, $command);
            
            $carro = new Carro();
            $carro->addMotor($motor);
            
            if(isset($_POST["frente"])) {
                $carro->ahead(666);
                echo 'Para o infinito e além';
            }elseif(isset($_POST["tras"])){
                $carro->back(33);
                echo 'Voltando...';
            }elseif(isset($_POST["parar"])){
                $carro->parar();
                echo 'Parando...';
            } else{
                echo 'não sei o que fazer...';
            }

        }
        
        ?>
    </body>
</html>
