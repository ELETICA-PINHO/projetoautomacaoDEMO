#if defined(ESP8266)
#include <ESP8266WiFi.h>  //ESP8266 Core WiFi Library         
#else
#include <WiFi.h>      //ESP32 Core WiFi Library    
#endif

#if defined(ESP8266)
#include <ESP8266WebServer.h> //Local WebServer used to serve the configuration portal
#else
#include <WebServer.h> //Local WebServer used to serve the configuration portal ( https://github.com/zhouhan0126/WebServer-esp32 )
#endif

#include <DNSServer.h> //Local DNS Server used for redirecting all requests to the configuration portal ( https://github.com/zhouhan0126/DNSServer---esp32 )
#include <WiFiManager.h>   // WiFi Configuration Magic ( https://github.com/zhouhan0126/WIFIMANAGER-ESP32 ) >> https://github.com/tzapu/WiFiManager (ORIGINAL)



//-------------------VARIABLES GLOBALES--------------------------
int contconexion = 0;
unsigned long previousMillis = 0;


//tete comite
int releStatus1 ;
String recebe_reServidor1;
String respostaServidor = "";
int conexao = 0;
int cont = 0;

//-------------------------------- CONFIGURAÇÕES DE DOMINIO SERVIDOR URL -----------------------------
int porta_servidor = 1213;
char *host = "45.179.242.3" ;
String strhost = "localhost";
String URL_COMPLETA_ENVIA = "http://localhost/projetoautomacaoDEMO/arquivosControle/sala/control.msg.sala.php/";
String URL_COMPLETA_RECEBE = "http://localhost/projetoautomacaoDEMO/arquivosControle/sala/status.sala.php/";
String URL_COMPLETA_ONLINE = "http://localhost/projetoautomacaoDEMO/arquivosControle/sala/placa_sala_conexao_online.php";
String URL_COMPLETA_SISTEMA = "http://localhost/projetoautomacaoDEMO/arquivosControle/sala/placa_sala_conexao_sistema.php";   //CAMINHO DO SERVIDOR



String URLRELE1 = "/projetoautomacaoDEMO/arquivosControle/sala/control.msg.sala.php";
String URL_RECEBE_DADOS = "/projetoautomacaoDEMO/arquivosControle/sala/status.sala.php";
String URL_ONLINE = "/projetoautomacaoDEMO/arquivosControle/sala/placa_sala_conexao_online.php";
String URL_SISTEMA = "/projetoautomacaoDEMO/arquivosControle/sala/placa_sala_conexao_sistema.php";


//YYY



//---------------------PROTOTIPO DE FUNÇÃO----------------------------------------

void FUNCAO_PULSADOR1();
void FUNCAO_STATUS_RELE1();
void conexaoWifi();
String enviardadosRele1(String dados);
String enviar_iniciar_sistema(String dados);
String enviar_conexao_online(String dados);
String recebedados();
//////////////////////////////////////////////////////////////////////////////////






//--------------CONFIGURAÇÕES DE PINOS -------------------------------------------
#define PULSADOR1 2 ///5
#define RELE1 0 ///4 //
//#define LEDESP
//#define LEDN

//-------------------------------------------------------------------------

void setup() {

  Serial.begin(9600);
  pinMode(RELE1,OUTPUT);
  pinMode(PULSADOR1,INPUT);
  conexaoWifi();
  enviar_iniciar_sistema("inicia=" + String("SISTEM"));



  WiFiManager wifiManager;


  wifiManager.setAPCallback(configModeCallback); 

  wifiManager.setSaveConfigCallback(saveConfigCallback); 


  wifiManager.autoConnect("ELETRICA-PINHO-SERVIDOR", "12345678"); 



}

//--------------------------LOOP--------------------------------
void loop() {


cont ++;

Serial.print("cont");
Serial.println(cont);


  FUNCAO_PULSADOR1();
  recebedados();
  FUNCAO_STATUS_RELE1();



if(cont == 30){

    enviar_conexao_online("conexao=" + String("ONLINE"));
    cont =0;

    Serial.println("zerado");

}









}


///-------------FUNÇÕES ----------------------------------------------



//-----------------------------------INICIA SISTEMA-----------------------------------------------

String enviar_iniciar_sistema(String dados) {
  String linea = "error";
  WiFiClient client;

  if (!client.connect(host, porta_servidor)) {
    Serial.println("falha de conexao");
 //   digitalWrite(LEDN,LOW);
    conexaoWifi();
  
   

    return linea;
  }
 // digitalWrite(LEDN,HIGH);
   client.print(String("POST ") + URL_SISTEMA + " HTTP/1.1" + "\r\n" +
               "Host: " + strhost + "\r\n" +
               "Connection: keep-alive" + "\r\n" +
               "Content-Length: " + dados.length() + "\r\n" +
               "Cache-Control: max-age=0" + "\r\n" +
               "Origin: https://localhost" + "\r\n" +
               "Upgrade-Insecure-Requests: 1" + "\r\n" +
               "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36" + "\r\n" +
               "Content-Type: application/x-www-form-urlencoded" + "\r\n" +
              "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3" + "\r\n" +
              "Referer:" + URL_COMPLETA_SISTEMA + "\r\n" +
              "\r\n" + dados);

  Serial.print("Iniciando Sistema...");
  Serial.println("");

  unsigned long timeout = millis();
  while (client.available() == 0) {
    if (millis() - timeout > 5000) {
      Serial.println("Cliente tempo de exedido!!");
      client.stop();
      conexaoWifi();
      enviar_iniciar_sistema("inicia=" + String("SISTEM_FALHA"));
      return linea;
    }
  }
  while(client.available()){
  linea = client.readStringUntil('\r');
  }
  return linea;
}






//----------------------------------------------------------ENVIA  DADOS -----------------------------------------------------------

String enviardadosRele1(String dados) {
  String linea = "error";
  WiFiClient client;
  //strhost.toCharArray(host, 49);
  if (!client.connect(host, porta_servidor)) {
    Serial.println("falha de conexao");
    //digitalWrite(LEDN,LOW);
    conexaoWifi();
    return linea;
  }

   client.print(String("POST ") + URLRELE1 + " HTTP/1.1" + "\r\n" +
               "Host: " + strhost + "\r\n" +
               "Connection: keep-alive" + "\r\n" +
               "Content-Length: " + dados.length() + "\r\n" +
               "Cache-Control: max-age=0" + "\r\n" +
               "Origin: http://localhost" + "\r\n" +
               "Upgrade-Insecure-Requests: 1" + "\r\n" +
               "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36" + "\r\n" +
               "Content-Type: application/x-www-form-urlencoded" + "\r\n" +
              "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3" + "\r\n" +
              "Referer: " + URL_COMPLETA_ENVIA + "\r\n" +
              "\r\n" + dados);

  Serial.print("Enviando dados a SQL...");
  Serial.println("");

  unsigned long timeout = millis();
  while (client.available() == 0) {
    if (millis() - timeout > 5000) {
      Serial.println("Cliente tempo de exedido!!");
      client.stop();
      return linea;
    }
  }

  while(client.available()){
  linea = client.readStringUntil('\r');
  respostaServidor = linea ;

    if(respostaServidor.indexOf("RELE01OF") != -1){
      recebe_reServidor1 = "RELE01OF";
      digitalWrite(RELE1, HIGH);
  }

  if(respostaServidor.indexOf("RELE01ON") != -1){
    recebe_reServidor1 = "RELE01ON";
   digitalWrite(RELE1, LOW);
  }


  }


  return linea;

  
}



//----------------------------------------------------------RECEBE TODOS OS DADOS DA TABELA STATUS-----------------------------------------------------------

String recebedados() {
  String linea = "error";
  WiFiClient client;
  //strhost.toCharArray(host, 49);
  if (!client.connect(host, porta_servidor)) {
    Serial.println("falha de conexao");
   // digitalWrite(LEDN,LOW);
    conexaoWifi();

    return linea;
  }


  client.print(String("GET ") + URL_RECEBE_DADOS + " HTTP/1.1" + "\r\n" +
               "Host: " + strhost + "\r\n" +
              "Connection: keep-alive" + "\r\n" +
               "Cache-Control: max-age=0" + "\r\n" +
             "Upgrade-Insecure-Requests: 1" + "\r\n" +
             "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36" + "\r\n" +
             "Content-Type: application/x-www-form-urlencoded" + "\r\n" +
             "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3" + "\r\n" +
              "Referer: " + URL_COMPLETA_RECEBE + "\r\n" +
              "\r\n");
 //delay(10);

  Serial.print("Atualizando Status:  ");

  unsigned long timeout = millis();
  while (client.available() == 0) {
    if (millis() - timeout > 5000) {
      Serial.println("Cliente tempo de exedido!!");
      client.stop();
      return linea;
    }
  }
  while(client.available()){
  linea = client.readStringUntil('\r');
  respostaServidor = linea ;

    if(respostaServidor.indexOf("RELE01OF") != -1){
      recebe_reServidor1 = "RELE01OF";
  }

   if(respostaServidor.indexOf("RELE01ON") != -1){
    recebe_reServidor1 = "RELE01ON";
  }

  }
  //Serial.println(linea);

  return linea;

 
}



String enviar_conexao_online(String dados) {
  String linea = "error";
  WiFiClient client;

  if (!client.connect(host, porta_servidor)) {
    Serial.println("falha de conexao");
 //   digitalWrite(LEDN,LOW);
    conexaoWifi();

    return linea;
  }
 // digitalWrite(LEDN,HIGH);
   client.print(String("POST ") + URL_ONLINE + " HTTP/1.1" + "\r\n" +
               "Host: " + strhost + "\r\n" +
               "Connection: keep-alive" + "\r\n" +
               "Content-Length: " + dados.length() + "\r\n" +
               "Cache-Control: max-age=0" + "\r\n" +
               "Origin: https://localhost" + "\r\n" +
               "Upgrade-Insecure-Requests: 1" + "\r\n" +
               "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36" + "\r\n" +
               "Content-Type: application/x-www-form-urlencoded" + "\r\n" +
              "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3" + "\r\n" +
              "Referer:" + URL_COMPLETA_ONLINE + "\r\n" +
              "\r\n" + dados);

  Serial.print("Conexao Online...");
  Serial.println("");

  unsigned long timeout = millis();
  while (client.available() == 0) {
    if (millis() - timeout > 5000) {
      Serial.println("Cliente tempo de exedido!!");
      client.stop();
      conexaoWifi();
      return linea;
    }
  }
  while(client.available()){
  linea = client.readStringUntil('\r');
  }
  return linea;
}




//---------------------------------------------função de Status e pulsador--------------------------------------------------


void FUNCAO_STATUS_RELE1(){



  Serial.println(recebe_reServidor1);

  if(recebe_reServidor1 == "RELE01ON")  // if data == 1 -> LED ON
  {
    digitalWrite(RELE1,LOW);
    releStatus1 = 0;
    }
   else if (recebe_reServidor1 == "RELE01OF") // if data == 0 -> LED OFF
   {
    digitalWrite(RELE1,HIGH);
    releStatus1 = 1;
    }

}



void FUNCAO_PULSADOR1() {

  

 if ( (digitalRead(PULSADOR1) == LOW)) {
     // pisSet();
    digitalWrite(RELE1,LOW);

     if(releStatus1 == 1){

          Serial.println("Rele1 pulsador1:  RELE01ON");
          enviardadosRele1("rele01=" + String("RELE01ON"));
          

     }

      if(releStatus1 == 0){
        digitalWrite(RELE1,HIGH);
          Serial.println("Rele1 pulsador1  RELE01OF");
         enviardadosRele1("rele01=" + String("RELE01OF"));



    }
 }
}



void conexaoWifi(){

    WiFiManager wifiManager;
      if(!wifiManager.startConfigPortal("ELETRICA-PINHO-SERVIDOR", "12345678") )
      {
        Serial.println("Falha ao conectar");
        delay(2000);
        ESP.restart();
      }


 


}





//callback que indica que o ESP entrou no modo AP
void configModeCallback (WiFiManager *myWiFiManager) {  
//  Serial.println("Entered config mode");
  Serial.println("Entrou no modo de configuração");
  Serial.println(WiFi.softAPIP()); //imprime o IP do AP
  Serial.println(myWiFiManager->getConfigPortalSSID()); //imprime o SSID criado da rede

}


//callback que indica que salvamos uma nova rede para se conectar (modo estação)
void saveConfigCallback () {
  Serial.println("Configuração salva");
}
