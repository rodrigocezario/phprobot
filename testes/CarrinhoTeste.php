<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CarrinhoTeste
 *
 * @author rodrigocezario
 */

class CarrinhoTeste extends Carrinho {
   
    public function ahead($distancia) {
        $this->motor["MOTOR1"]->run("FRENTE");
        $this->motor["MOTOR2"]->run("FRENTE");
        $this->motor["MOTOR3"]->run("FRENTE");
        $this->motor["MOTOR4"]->run("FRENTE");
    }
    
    public function parar(){
        $this->motor["MOTOR1"]->run("PARAR");
        $this->motor["MOTOR2"]->run("PARAR");
        $this->motor["MOTOR3"]->run("PARAR");
        $this->motor["MOTOR4"]->run("PARAR");
    }

    public function back($distancia) {
        $this->motor["MOTOR1"]->run("TRAS");
        $this->motor["MOTOR2"]->run("TRAS");
        $this->motor["MOTOR3"]->run("TRAS");
        $this->motor["MOTOR4"]->run("TRAS");      
    }

    public function exibirStatus() {
        
    }

    public function turnLeft($graus) {
        
    }

    public function turnRight($graus) {
        
    }

}
