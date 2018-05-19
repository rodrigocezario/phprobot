<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ComandoMotor
 *
 * @author rodrigocezario
 */

include "PhpSerial.php";

class ComandoMotor implements ICommand {
    
    public function executa($comando) {
        $serial = new PhpSerial;
        $serial->deviceSet("/dev/ttyACM0");
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
