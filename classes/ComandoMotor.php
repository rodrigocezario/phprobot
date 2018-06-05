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
        $read = 0;
        if (SO == "WIN") {
            $port = PORTA;
            $baudrate = BAUDRATE;
            exec("MODE $port BAUD=$baudrate PARITY=n DATA=8 XON=on STOP=1");
            $fp = fopen($port, 'c+');
            fwrite($fp, $comando);
            $read = fread($fp,128);  
            fclose($fp);
        } else {
            $serial = new PhpSerial; //tem muito bug e não funcionada direito no windows
            
            $serial->deviceSet(PORTA); //serial port ver SO
            $serial->confBaudRate(BAUDRATE);
            $serial->deviceOpen('w+');
            $serial->confParity("none");
            $serial->confCharacterLength(8);
            $serial->confStopBits(1);
            $serial->deviceOpen();
            $serial->sendMessage($comando);
            $read = $serial->readPort();
            $serial->deviceClose();
        }
        return $read;
    }

}
