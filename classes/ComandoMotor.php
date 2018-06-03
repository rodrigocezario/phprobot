<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ComandoMotor
 *
 * @author Rodrigo Cezario da Silva <rodrigocezario@msn.com>
 * @copyright  2018 Rodrigo Cezario
 * @version V1.1
 * @link https://github.com/rodrigocezario/phprobot PHP Robot
 */

include "PhpSerial.php";
/* 
 * A porta de comunicação serial dever ser configurada 
 * no arquivo configuracoes.php
 */
include 'configuracoes.php';

class ComandoMotor implements ICommand {
    
    public function executa($comando) {
        $serial = new PhpSerial;
        $serial->deviceSet(PORTA); //serial port ver SO
        $serial->confBaudRate(9600);
        $serial->deviceOpen('w+');
        $serial->confParity("none");
        $serial->confCharacterLength(8);
        $serial->confStopBits(1);
        $serial->deviceOpen();
        $serial->sendMessage($comando);
        $read = $serial->readPort();
        $serial->deviceClose();
        return $read;
    }

}
