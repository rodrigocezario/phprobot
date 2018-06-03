<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Command
 *
 * @author Rodrigo Cezario da Silva <rodrigocezario@msn.com>
 * @copyright  2018 Rodrigo Cezario
 * @version V1.1
 * @link https://github.com/rodrigocezario/phprobot PHP Robot
 */
interface ICommand {
    
    function executa($comando);
    
}
