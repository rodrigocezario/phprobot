/*************************************************************************
* File Name          : phprobot_firmware_l298n.ino
* Author             : Rodrigo Cezario da Silva
* Updated            : Rodrigo Cezario da Silva
* Version            : V1.0
* Date               : 03/06/2018
* Description        : Firmware for PHPRobot with Arduino + PHP for 
*                      Dual H-Bridge Motor Driver (L298N).  
* License            : CC-BY-SA 3.0
* Copyright (C) 2018 - 2018 Rodrigo Cezario da Silva. All right reserved.
* Site: 
**************************************************************************/

// motor1 = motorA
int IN1 = 4;
int IN2 = 5;
//motor2 = motorB
int IN3 = 6;
int IN4 = 7;

#define FORWARD 1
#define BACKWARD 2
#define RELEASE 0

int motores[2][2] = {
                      {IN1 , IN2},   //input pin to control Motor1--> Motor[0][0]=4, Motor[0][1]=5
                      {IN3 , IN4},   //input pin to control Motor2--> Motor[1][0]=6, Motor[1][1]=7
                    };

void setup() {
  Serial.begin(9600);
  pinMode(motores[0][0], OUTPUT);  
  pinMode(motores[0][1], OUTPUT);
  pinMode(motores[1][0], OUTPUT);  
  pinMode(motores[1][1], OUTPUT);
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
          run(componente, FORWARD); 
        }else if (direcao == "P"){
          Serial.println("Parar...");
          run(componente, RELEASE);
        }else if (direcao == "T"){
          Serial.println("Para tras...");
          run(componente, BACKWARD);
        }
        //Serial.println("posicao: "+ String(componente) );
      }
      
    }
     delay(10);
}

void run(int motor, int acao){
  //acao = 1 = frente
  //acao = 2 = tras
  //acao = 0 = parar
  switch (acao) {
    case FORWARD:  
      Serial.println("para a frente..."+ String(motor) +" ..");
      Serial.println("Motor pino: "+ String(motores[motor][0]) + " e "+ String(motores[motor][1]));
      digitalWrite(motores[motor][0], HIGH);
      digitalWrite(motores[motor][1], LOW);
      delay(2000);
      break;
    case BACKWARD:   
      Serial.println("entrou dentro do voltar...");
      digitalWrite(motores[motor][0], LOW);
      digitalWrite(motores[motor][1], HIGH);
      break; 
    case RELEASE: 
    Serial.println("entrou dentro do parar..."); 
      digitalWrite(motores[motor][0], LOW);
      digitalWrite(motores[motor][1], LOW);
      break;      
  } 

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

