# PHP Robot

PHP Robot é um projeto de ferramenta pedagógica para ensino-aprendizagem dos conceitos de orientação a objetos na disciplina de programação web com a linguagem PHP. Recomenda-se a utilização desta ferramenta para o reforço dos conceitos apresentados em sala de aula.

Esta ferramenta apresenta como diferencial a utilização da plataforma de prototipagem Arduino e Raspberry PI na construção do robô. Neste repositório, estão a disposição o código fonte de firmware para o Arduino e do middleware em PHP que permite ao estudante implementar o funcionamento do robô em Arduino. O Raspberry PI foi utilizado no projeto para permite a execução do servidor web para execução do PHP.

## Modelo de Classes do projeto
A figura a seguir ilustra o modelo de classes do projeto.
![Modelo de Classes do projeto](img/classes.png?raw=true "Modelo de Classes do projeto")
Para a utilização da ferramenta, será necessário da implementação da especialização da classe Carrinho. Os valores que devem ser passados como parâmetro nas operações previstas pela interface ICarrinho ainda não funcionam. Para que esses valores possam fazer alguma diferença, falta estudar uma forma de definir como será tratadas essas unidades. Para tanto, será necessário refatorar os firmwares [firmware neste projeto](firmware/phprobot_firmware/phprobot_firmware.ino) e [firmware neste projeto](firmware/phprobot_firmware_l298n/phprobot_firmware_l298n.ino).

## Configuração da porta USB

A porta serial deve ser configurada de acordo com o sistema operacional utilizado. Para saber em qual porta serial seu Arduino está funcionando, no editor de código do Arduino, selecione no menu "Tools -> Serial Port". Faça a alteração no arquivo [Arquivo de configuração](classes/configuracao.php).

```php
define("PORTA", "/dev/ttyACM0"); //raspberry serial port
```

Alguns exemplos de portas seriam:

### Porta Raspberry Pi
```sh
/dev/ttyACM0
```
### Porta Linux
```sh
/dev/ACM0
```
### Porta Windows
```sh
COM2
```
### Porta Mac Os
```sh
/dev/cu.usbmodem1411
```

## Firmwares

Na versão atual, o projeto conta com duas versões de firmwares. O firmware phprobot_firmware [Firmware para Driver Motor Ponte H Shield L293D ](/phprobot_firmware/phprobot_firmware.ino) deve ser utilizado para controlar até 4 motores. Para tanto, será necessário junto ao hardware um Motor Shield L293D Driver Ponte H para Arduino, retratado na figura a seguir.
![Motor Shield L293D](img/l293d.jpg?raw=true "Driver Motor Ponte H Shield L293D")
Outra opção, seria a utilização de um Driver Motor Ponte H L298n, apresentado na figura a seguir. Para utilizar a Ponte H L298n, é necessário o carregamento do firmware phprobot_firmware_l298n [Firmware para Driver Motor Ponte H L298n](/phprobot_firmware_l298n/phprobot_firmware_l298n.ino). Vale lembrar que o Driver Motor Ponte H L298N presta suporte até 2 motores.
![Driver Motor Ponte H L298N](img/l298n.jpg?raw=true "Driver Motor Ponte H L298N")

## Definição dos Motores

A implementação padrão do Firmware, permite adicionar até 4 motores através da ferramenta. No entanto, a quantidade de motores pode facilmente ser alterar.

Na implementação utilizando a ferramenta, para adicionar um motor à um Carro, é necessário uma instância da classe Motor para cada motor. Além disso, um motor (instância de Motor) devem ser composto por uma implementação de ICommand. O código a seguir ilustra a implementação necessário para criação de um motor.

```php
$command = new ComandoMotor;
$motor = new Motor(MotorPosicao::MOTOR1, $command);
```
Não esqueça que cada motor criado deve ser adicionado ao Carrinho, conforme mostra o código a seguir.

```php
$car->addMotor($motor);
```

Para testar um comando na porta serial do Arduino, pode-se utilizar uma string como: posicao : acao ;
O exemplo a seguir apresenta um string acionando o motor1 (motor na posição 1) com a ação de girar no sentido horário.

```sh
MOTOR1:FRENTE;
```

Mais de um comando pode ser passado, como o exemplo a seguir:

```sh
MOTOR1:FRENTE;MOTOR2:TRAS;MOTOR1:PARAR
```

## Implementação de ICommand

A interface ICommand permite a flexibilidade na troca de implementações de Command. A classe ComandoMotor permite o envio de comandos através de uma porta serial com PHP. Para tanto, foi utilizado a implementação PHP Serial, disponível no site [GitHub Pages](https://github.com/Xowap/PHP-Serial).

### Comando para os Motores

Neste momento, existem somente 3 possibilidade de comandos, sendo:
- FRENTE: permite acionar o motor no sentido horário.
- TRAS: permite acionar o motor no sentido oposto ao do comando FRENTE, no sentido anti-horário.
- PARAR: para o funcionamento do motor.

Esses comandos permite as operações sobre motores. O código a seguir ilustra o adicionamento de um motor passando o comando para girar para frente (sentido horário) de um determinado motor. Observe que o comando deve ser passado como argumento para método run da classe Motor.

```php
$this->motor["MOTOR1"]->run("PARAR");
```

Cabe dizer que outras implementações de comandos poderão ser adicionadas ao projeto futuramente. Um exemplo de implementação de comando futuro, poderia ser a possibilidade de leitura de um valor obtido de um sensor ultrassônico, como o HC-SR04.

## Configurações no Raspberry Pi (Robô)

Algumas configurações são necessários para Raspberry Pi para o funcionamento adequado ao acesso a porta Serial. A comunicação entre Raspberry e Arduíno foi realizada através de um protocolo padrão de comunicação, o UART (Universal Synchronous Receiver/Transmitter). A conexão entre o Raspberry Pi e o Arduino pode ser feita através da GPIO, utilizando as portas RX e TX, ou utilizando a própria porta USB dos dispositivos.

Um problema recorrente na integração destes dispositivos trata-se do Reset do Arduino a cada vez que o Raspberry Pi iniciar uma comunicação. Uma solução relatada na rede, recomenda a adição de um capacitor de 10uF entre os sinais GND e Reset do Arduino para evitar o reinício. No entanto, optou-se por outra solução acidentalmente encontrada. :)
Observou-se que quando utilizado (inicializado) o software Minicom no Raspberry Pi, o Arduino não reiniciava a cada comando via serial enviado pelo PHP. De alguma forma o Minicom faz como que o Arduino não seja reicializado a cada comando via serial. O comando utilizado para instalar o Minicom no Raspberry Pi foi:

```sh
sudo apt-get install minicom
```

Após este passo, optou-se em adicionar o comando do Minicom no arquivo rc.local para ser executado durante a inicialização do sistema, conforme mostra comando a seguir:

```sh
sudo minicom -D /dev/ttyACM0 -b 9600
```

Talvez esta não seja a solução mais adequada. Porém, resolveu o problema de reinício do Arduino sem a necessidade de adicionar qualquer componente. :)
Além disso, foi necessário atribuir permissão a porta usb e pasta do servidor web do Raspberry Pi.

```sh
sudo chown pi:pi /dev/ttyACM0
sudo usermod -a -G dialout www-data
sudo chown pi:www-data -R /var/www
sudo adduser pi www-data
sudo chmod 777 /dev/ttyACM0
```

## Contribuições

Todos são bem-vindos a contribuir com este projeto. Sinta-se a vontade em enviar suas sugestões e críticas para o e-mail <rodrigocezario@msn.com>. :)
