<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Carrinho
 *
 * @author Rodrigo Cezario da Silva <rodrigocezario@msn.com>
 * @copyright  2018 Rodrigo Cezario
 * @version V1.1
 * @link https://github.com/rodrigocezario/phprobot PHP Robot
 */
abstract class Carrinho implements ICarrinho {
    
    protected $motor = array();
    
    public function addMotor(Motor $motor){
        //nomeando a posição do motor...
        $this->motor["MOTOR" . $motor->getPosicao()] = $motor;
    }
    
    public function printMotores(){
        foreach ($this->motor as $key => $value) {
            echo "Motor: ". $key . "; Posição: " . $value->getPosicao() ."<br>\n";
        }
    }
    
}
