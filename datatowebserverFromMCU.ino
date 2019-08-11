

int inputPin = 5; // Input pin which will be used for Industrial parameter recording sensors(for Infrared sensor) 
int val = 0; // variable for reading the pin status
//libraries
#include <ESP8266WiFi.h>
#include <WiFiClient.h> 
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>

const char *ssid = "Pks";  //personal note to self - never use " or ' in ssid
const char *password = "pks123456"; //

//Web/Server address to read/write from 
const char *host = "https://itspks.gq";   

//=======================================================================
//                    Power on setup
//=======================================================================

void setup() {
 pinMode(inputPin, INPUT);
pinMode(13,OUTPUT);
  
  delay(1000);
  Serial.begin(115200);
  WiFi.mode(WIFI_OFF);        
  delay(1000);
  WiFi.mode(WIFI_STA);        
  
  WiFi.begin(ssid, password);  
  Serial.println("");

  Serial.print("Connecting");
  // Wait for connection
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

   Serial.println("");
  Serial.print("Connected to ");
  Serial.println(ssid);
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());  
}

//=======================================================================
//                    Main Program Loop
//=======================================================================
void loop() {
  
  val = digitalRead(inputPin); 
   if (val == HIGH) {

  Serial.print("DETECTED");
  HTTPClient http;   

  String ADCData, station, postData;
  int adcvalue=random(1,50); 
  ADCData = String(adcvalue);   
  station =random(1,10); //value to be sent
  int pks = random(1,10); // status of the string
  //Post Data post data
  postData = "phlevel=" + ADCData + "&turbidity=" + station + "&do=" + pks  ;
  
  http.begin("http://www.captiozon.tk/postdemo.php");     //website URL         //Specify request destination
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");    

  int httpCode = http.POST(postData);   //Send the request
  String payload = http.getString();    //Get the response payloaddd

  Serial.println(httpCode);   //Print HTTP return code
  Serial.println(payload);    //Print request response payload

  http.end();  //Close connection
  digitalWrite(13,HIGH);
    delay(100);
    digitalWrite(13,LOW);
    
  delay(5000);  //Post Data at every 5 second
  
  }

  else {
    Serial.print("NOT DETECTED");
    delay(1000);
    digitalWrite(13,HIGH);
    delay(1000);
    digitalWrite(13,LOW);
    digitalWrite(13,HIGH);
    delay(1000);
    digitalWrite(13,LOW);
    digitalWrite(13,HIGH);
    delay(1000);
    digitalWrite(13,LOW);
    digitalWrite(13,HIGH);
    delay(1000);
    digitalWrite(13,LOW);
    digitalWrite(13,HIGH);
    delay(1000);
    digitalWrite(13,LOW);
    
    
    }
  
}
//=======================================================================
