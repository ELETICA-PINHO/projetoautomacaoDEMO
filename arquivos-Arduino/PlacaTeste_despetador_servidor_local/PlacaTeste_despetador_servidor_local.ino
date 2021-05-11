#include <ESP8266WiFi.h>
#include <WiFiClient.h>

//esp32
//teste de atom

//#include <WiFi.h>
//#include <WiFiAP.h>



//-------------------VARIABLES GLOBALES--------------------------
int contconexion = 0;
const char *ssid = "iot";
const char *password = "iot12345";
unsigned long previousMillis = 0;


//tete comite
int releStatus1 ;
String recebe_reServidor1;
String respostaServidor = "";
int conexao = 0;
int cont = 0;

//-------------------------------- CONFIGURAÇÕES DE DOMINIO SERVIDOR URL -----------------------------
int porta_servidor = 1213;
char *host = "ip"  ;  // ip do pc que roda servidor ou seu ip publico
String strhost = "localhost";
String URL_COMPLETA_ENVIA = "http://localhost/projetoautomacaoDEMO/reles.php/";
String URL_COMPLETA_RECEBE = "http://localhost/projetoautomacaoDEMO/status.sala.php/";




String URLRELE1 = "/projetoautomacaoDEMO/reles.php";
String URL_RECEBE_DADOS = "/projetoautomacaoDEMO/status.sala.php";


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





}

//--------------------------LOOP--------------------------------
void loop() {




  recebedados();
  FUNCAO_STATUS_RELE1();
  FUNCAO_PULSADOR1();









}


///-------------FUNÇÕES ----------------------------------------------










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

     if(releStatus1 == 1){

          Serial.println("Rele1 pulsador1:  RELE01ON");
          enviardadosRele1("rele01=" + String("RELE01ON"));

     }

      if(releStatus1 == 0){
          Serial.println("Rele1 pulsador1  RELE01OF");
         enviardadosRele1("rele01=" + String("RELE01OF"));

    }
 }
}



void conexaoWifi(){

  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED and conexao <50 ){ // Testa enquanto WIFI nao conectar, pisca LedEsp{
    ++conexao;
    delay(500);
    Serial.print(".");
   // digitalWrite(LEDESP, LOW);
    delay(30);
  //  digitalWrite(LEDESP, HIGH);
    delay(30);
  }


  if (conexao <50) {
    Serial.println("");
    Serial.println("WiFi conectado");
    Serial.println(WiFi.localIP());
    delay(30);
}else{
    Serial.println("");
    Serial.println("erro de conexao");

  //  digitalWrite(LEDN, LOW);
    delay(30);
    conexaoWifi();
  }


}
