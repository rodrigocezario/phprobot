<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Carro
 *
 * @author rodrigocezario
 */




class Carro extends Carrinho {
    
    
    public function ahead($distancia) {
        $this->motor["MOTOR1"]->run("FRENTE");
        $this->motor["MOTOR2"]->run("FRENTE");
    }

    public function back($distancia) {
        $this->motor["MOTOR1"]->run("TRAS");
    }
    
    public function parar(){
        $this->motor["MOTOR1"]->run("PARAR");
    }

    public function exibirStatus() {
        
    }

    public function turnLeft($graus) {
        
    }

    public function turnRight($graus) {
        
    }

}
