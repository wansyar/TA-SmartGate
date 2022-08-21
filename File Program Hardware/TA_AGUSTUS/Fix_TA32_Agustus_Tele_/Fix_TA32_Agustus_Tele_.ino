#include <Arduino.h>
#include <WiFi.h>
#include <CTBot.h>
#include <HTTPClient.h>
#include <SoftwareSerial.h>
#include "ESP32QRCodeReader.h"

#define WIFI_SSID "AlatAbsensiSmartGate"
#define WIFI_PASSWORD "Fisika123"


#define led_pin 4 
#define led_connect 2 
#define led_upload 15

//konek telegram
CTBot myBot;
String token = "5364027849:AAEA23-bRf7jagVPwtNH1VFRCyJDEH_SHaA";
const int id = 1024222127;

SoftwareSerial Suhu(13, 12); //TX RX

ESP32QRCodeReader reader(CAMERA_MODEL_AI_THINKER);
struct QRCodeData qrCodeData;

String datasuhu;
float suhu ;

void bacasuhu(){
  datasuhu = "";
  while (Suhu.available() > 0){
    datasuhu += char(Suhu.read());  
    }
    datasuhu.trim();
  }

void setup()
{
  Serial.begin(9600);
  Suhu.begin(9600);
  Serial.println();

  pinMode(led_pin, OUTPUT);
  pinMode(led_connect, OUTPUT);

  WiFi.mode(WIFI_STA);
  WiFi.begin(WIFI_SSID, WIFI_PASSWORD);
  Serial.println("");
  
  Serial.print("Connecting");
  while (WiFi.status() !=WL_CONNECTED)   
    {
      Serial.print(".");
      delay(500);
    }
    Serial.print("Connected");
    digitalWrite(led_connect, HIGH);

  //Koneksi Telegram
  myBot.wifiConnect(WIFI_SSID, WIFI_PASSWORD);
  myBot.setTelegramToken(token);

  reader.setup();
  reader.begin();
}

void loop()
{
  if (reader.receiveQrCode(&qrCodeData, 100))
  {
    Serial.println("Found QRCode");
    if (qrCodeData.valid)
    {
      flashlight();
      Serial.print("Payload: ");
      Serial.println((const char *)qrCodeData.payload);
      bacasuhu();
      kirimdata(String((const char *)qrCodeData.payload));
    }
    else
    {
      Serial.print("Invalid: ");
      Serial.println((const char *)qrCodeData.payload);
    }
  }
  delay(300);
}

void kirimdata(String datanama){
  if(WiFi.status()== WL_CONNECTED){
    pinMode(led_upload, OUTPUT);
    suhu = datasuhu.toFloat();
    if(suhu > 0){          
    HTTPClient http;
    http.begin("https://fisika-mipa-unsri.com/smartgate/kirimdataedit.php");
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");

    String postData = (String)"nama=" + datanama + "&suhu=" + datasuhu;

    int httpResponseCode = http.POST(postData);


    if(httpResponseCode == 200){
      for (int i = 0; i < 3; i++) {
        digitalWrite(led_upload, HIGH);
        delay(100);                 
        digitalWrite(led_upload, LOW);
        delay(100);
        }
        Serial.println("Data Suhu berhasil dimasukan");
            {if(suhu > 35 &&suhu < 37) {
              myBot.sendMessage(id,"Suhu Normal,Pintu Terbuka");
              Suhu.println("Terbuka");
              }else {
                String balasan;
                balasan = (String)"Nama "+datanama+ (String)+",Suhu Tidak Normal, Pintu Tertutup";
                myBot.sendMessage(id,balasan);
              }}  
        }else{
          Serial.println("Gagal memasukan data");
          }
    http.end();
    }
  }
    else {
      Serial.println("WiFi Disconnected");
    }     
}

void flashlight() {
  digitalWrite(led_pin, HIGH);               // matikan lampu flash LED
  delay(30);
  digitalWrite(led_pin, LOW);               // aktifkan lampu flash LED
  delay(30);
}
