/*************************************************************************
* File Name          : phprobot_firmware.ino
* Author             : Rodrigo Cezario da Silva
* Updated            : Rodrigo Cezario da Silva
* Version            : V1.1
* Date               : 19/05/2018
* Description        : Firmware for PHPRobot with Arduino + PHP.  
* License            : CC-BY-SA 3.0
* Copyright (C) 2018 - 2018 Rodrigo Cezario da Silva. All right reserved.
* Site: 
**************************************************************************/

#include <AFMotor.h>

AF_DCMotor motor1(1); //frente direita
AF_DCMotor motor2(2); //tras direita
AF_DCMotor motor3(3); //tras esquerda
AF_DCMotor motor4(4); //frente esquerda

#define QTMOTOR 4

AF_DCMotor motores[QTMOTOR] = {motor1, motor2, motor3, motor4};

void setup() {
  Serial.begin(9600);
  for(int i = 0; i < QTMOTOR; i++){
    motores[i].setSpeed(200);
  }
}

void loop() {
  
  if (Serial.available()) {
    // Lê toda string recebida
    String recebido = leStringSerial();
    //Serial.println("Leu o serial...");

    //--> Criação de um vetor de comandos
    //declaracao do vetor de comandos
    int qtComandos = getQuantComandos(recebido);
    String comandos[qtComandos];
    
    int index = 0;
    int posinicial = 0;
    //varrendo a string para adicionar o comando no vetor
    for (int i = 0; i < recebido.length(); i++){ 
      if(recebido.charAt(i) == ';') { 
        comandos[index] = recebido.substring(posinicial, i);
        posinicial = i + 1;
        index++;
      }
    }
    Serial.println("Qt. Comandos: "+ qtComandos);
    //--> Execução dos comandos.
    //executar os comandos...
    for (int i = 0; i < sizeof(comandos); i++){ 
      executaComando(comandos[i]);
    }
     
  }
  
}

//obter a quantidade de comandos
int getQuantComandos(String comandos){
  int conta = 0;
  for (int i = 0; i < comandos.length(); i++){ 
    if(comandos.charAt(i) == ';') { 
      conta++; 
    }
  }
  return conta;
}

void executaComando(String comando){
  //--> Antes de executar o comando é necessário determinar o componente e o comando
  //varrendo a string para desmembrar o componente (motor) do comando
    Serial.println("Executando o comando....");
    for (int i = 0; i < comando.length(); i++){ 
      if(comando.charAt(i) == ':') { 
        //Exemplo de comando:
        //MOTOR1:T;MOTOR1:F;MOTOR1:P;
        int componente = (comando.substring(i-1, i).toInt() - 1); //n. componente
        String direcao = comando.substring(i+1, i+2); //letra da direcao

        //transformando o comando em direção
        if (direcao == "F"){
          Serial.println("Para frente...");
          motores[componente].run(FORWARD); 
        }else if (direcao == "P"){
          Serial.println("Parar...");
          motores[componente].run(RELEASE); 
        }else if (direcao == "T"){
          Serial.println("Para tras...");
          motores[componente].run(BACKWARD); 
        }
        //Serial.println("posicao: "+ String(componente) );
      }
      
    }
     delay(10);
}


String leStringSerial(){
  String conteudo = "";
  char caractere;
  while(Serial.available() > 0) {
    caractere = Serial.read();
    // Ignora caractere de quebra de linha
    if (caractere != '\n'){
      conteudo.concat(caractere);
    }
    // Aguarda buffer serial ler próximo caracter
    delay(10);
  }
    
  return conteudo;
}

