#include <Wire.h>
#include <Adafruit_MLX90614.h>
#include <Joatsy74HC595.h>
#include <Servo.h>

//Konfigurasi Sensor Suhu dan Sensor Ultrasonik
Adafruit_MLX90614 mlx = Adafruit_MLX90614();
const int pTrig = 2; //Pin untuk triger
const int pEcho = 3; //Pin untuk echo

const int p_Trig= 13; 
const int p_Echo = 12;

Servo myservo;
int pos = 0 ;
//Konfigurasi IC Shiftregister 74HC595 dan 7-Segment
const byte pin_data = 4;
const byte pin_clock = 6;
const byte pin_latch = 5;
const byte count_chips = 8;
const double delay_time = 0.1;
const byte common_logic = 0;
Joatsy74HC595 shiftreg(BUFFERED_OUTPUT, pin_data, pin_clock, pin_latch, count_chips, delay_time);

int buzzer = 7;

int statusPin = 0;
byte dot = 0;

void setup() {
  Serial.begin(9600);
  Serial.println();
  shiftreg.clear();
  //Ultrasonik Suhu
  pinMode(pTrig, OUTPUT);
  pinMode(pEcho, INPUT);

  //Ultrasonik Pintu
  pinMode(p_Trig, OUTPUT);
  pinMode(p_Echo, INPUT);
  
  int pos = 0;
  myservo.attach(11);
  
  pinMode(buzzer, OUTPUT);
  delay(1000);
  mlx.begin();
}

//Konfigurasi keluaran pada 7-segment dari angka 0-9
void build_data(byte n, byte i) {

  byte d = 0;
  if (n == 0) {
    d = B00010100;
    if (i == 2) {
      d = B00010000;
    }
  } else if (n == 1) {
    d = B01111110;
    if (i == 3) {
      d = B10110111;
    }
    if (i == 2) {
      d = B01111010;
    }
  } else if (n == 2) {
    d = B10001100;
    if (i == 3) {
      d = B10001100;
    }
    if (i == 2) {
      d = B10001000;
    }
  } else if (n == 3) {
    d = B01001100;
    if (i == 3) {
      d = B10000101;
    }
    if (i == 2) {
      d = B01001000;
    }
  } else if (n == 4) {
    d = B01100110;
    if (i == 3) {
      d = B00100111;
    }
    if (i == 2) {
      d = B01100010;
    }
  } else if (n == 5) {
    //BDCG EPFA
    d = B01000101;
    if (i == 3) {
      d = B01000101;
    }
    if (i == 2) {
      d = B01000001;
    }
  } else if (n == 6) {
    d = B00000101;
    if (i == 3) {
      d = B01000100;
    }
    if (i == 2) {
      d = B00000001;
    }
  } else if (n == 7) {
    d = B01111100;
    if (i == 3) {
      d = B10010111;
    }
    if (i == 2) {
      d = B01111000;
    }
  } else if (n == 8) {
    d = B00000100;
    if (i == 3) {
      d = B00000100;
    }
    if (i == 2) {
      d = B00000000;
    }
  } else if (n == 9) {
    d = B01000100;
    if (i == 3) {
      d = B00000101;
    }
    if (i == 2) {
      d = B01000000;
    }
  }
  if (dot == 1 && (i == 2 || i == 3)) {
    bitWrite(d, 2, 0);
  }
  if (i == 1) {
    shiftreg.setdata(4, d);
    shiftreg.setdata(8, d);
  } else if (i == 2) {
    shiftreg.setdata(3, d);
    shiftreg.setdata(7, d);
  } else if (i == 3) {
    shiftreg.setdata(2, d);
    shiftreg.setdata(6, d);
  } else if (i == 4) {
    shiftreg.setdata(1, d);
    shiftreg.setdata(5, d);
  }
}

void loop() {
  float n_1;
  float n_2;
  float n_3;
  float n_4;

  int sensor = mlx.readObjectTempC()*100;
  int number;

  long duration, distance;

  float nilaiSuhu = (3.027 + mlx.readObjectTempC());
  sensor = nilaiSuhu*100;
  String kdata;
 //Program Ultrasonik Suhu
  digitalWrite(pTrig, LOW);
  delayMicroseconds(2);
  digitalWrite(pTrig, HIGH);
  delayMicroseconds(10);
  digitalWrite(pTrig, LOW);
  duration = pulseIn(pEcho, HIGH);
  distance = ((duration * 0.034) / 2);

  //Ultrasonik Pintu 
// long waktu, jarak;
//  int pos = 0;
// myservo.write(pos);

//  digitalWrite(p_Trig, LOW);
//  delayMicroseconds(2);
//  digitalWrite(p_Trig, HIGH);
//  delayMicroseconds(10);
//  digitalWrite(p_Trig, LOW);
//  waktu = pulseIn(p_Echo, HIGH);
//  jarak = ((waktu * 0.034) / 2);

//Tampilkan Pada Seven Segment
 {if(distance < 5); 
 sensor = nilaiSuhu*100;
   {
    n_1 = (sensor)/1000;
    n_2 = (sensor%1000)/100;
    n_3 = (sensor%100)/10;
    n_4  =(sensor%100)%10;  

   }  if (distance > 5){ 
    n_1 = 0;
    n_2 = 0;
    n_3 = 0;
    n_4 = 0;
   }
   }
  build_data(n_1, 1);
  build_data(n_2, 2);
  build_data(n_3, 3);
  build_data(n_4, 4);
  shiftreg.buildData();

  //Kirim Data Ke ESP32
   if (distance <5){
    kdata = String(nilaiSuhu);
    if (nilaiSuhu > 35 &&nilaiSuhu < 37){
      digitalWrite(buzzer,HIGH);
      delay(40);
      digitalWrite(buzzer,LOW);
    }else{
      digitalWrite(buzzer,HIGH);
      delay(2000);
      digitalWrite(buzzer,LOW);
    }
    Serial.println(kdata);
    delay(2000);
 }

 //Status Pintu
 String pintu = "";
 while(Serial.available()>0){
  pintu += char(Serial.read());
 }
 pintu.trim();
// Serial.print(pintu);
if(pintu == "Terbuka"){
 myservo.write (80);
 delay (2000);
 for(pos=80 ; pos>=0; pos -=8)
 {
 myservo.write(pos);
 delay (1000);
 }
 }
 else {
 myservo.write(0);
 } 
 delay (2000);
 
//   if(jarak < 10){
//    pos=0;
//  }else{
//    pos=90;     
//  }
}
