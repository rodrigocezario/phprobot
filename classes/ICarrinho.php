<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author rodrigocezario
 */
interface ICarrinho {
    
    public function exibirStatus();
    
    //mover para frente
    public function ahead($distancia);
    
    //mover para tras
    public function back($distancia);  
    
    //mover para esquerda
    public function turnLeft($graus);
    
    //mover para direita
    public function turnRight($graus);
    
}
