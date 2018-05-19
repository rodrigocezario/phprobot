<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Motor
 *
 * @author rodrigocezario
 */
class Motor {
    
    private $posicao;
    private $command;
    
    public function __construct($posicao, ICommand $command) {
        $this->posicao = $posicao;
        $this->command = $command;
    }
    
    public function run($acao){
        //aqui devo executar a acao do comando 
        //o sinal ; no final do comando é um toker 
        //para processar o comando no arduino
        $this->command->executa($this->posicao . ":" . $acao . ";");
        //DEBUG
        //echo 'Acao: '. $this->posicao . ':'. $acao ."<br>";
    }
    
    public function getPosicao(){
        return $this->posicao;
    }
    
}
