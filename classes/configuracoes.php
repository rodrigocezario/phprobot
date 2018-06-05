<?php

/**
 * Description of configuracoes
 *
 * @author Rodrigo Cezario da Silva <rodrigocezario@msn.com>
 * @copyright  2018 Rodrigo Cezario
 * @version V1.1
 * @link https://github.com/rodrigocezario/phprobot PHP Robot
 */

/*
 * A porta serial deve ser configurada de acordo 
 * com o SO utilizado. Para saber em qual porta 
 * serial seu arduino está funcionando, no editor 
 * de código do Arduino, selecione 
 * "Tools -> Serial Port" no menu.
 * 
 * Porta Raspberry Pi = /dev/ttyACM0
 * Porta Linux = /dev/ACM0
 * Porta Windows = COM2
 * Porta Mac Os = /dev/cu.usbmodem1411
 */

define("PORTA", "/dev/ttyACM0");

/*
 * 
 * SO = WIN, LINUX, OSX
 * 
 */

define("SO","LINUX");

define("BAUDRATE",9600); //taxa de transferencia na porta


?>

