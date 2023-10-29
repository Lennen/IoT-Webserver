/**
 * GET request to the Web-server
 * using API key (secret variable)
 * with the user name variable
 * 
 *  Created on: 22.11.2019 By Eugene Rychkov
 *
 */
#include <Arduino.h>
#include <WiFi.h>
#include <WiFiMulti.h>
#include <HTTPClient.h>
#define USE_SERIAL Serial

WiFiMulti wifiMulti;

void setup() {
    USE_SERIAL.begin(115200);
    USE_SERIAL.println();
    USE_SERIAL.println();
    USE_SERIAL.println();

    for(uint8_t t = 4; t > 0; t--) {
        USE_SERIAL.printf("[SETUP] WAIT %d...\n", t);
        USE_SERIAL.flush();
        delay(1000);
    }
    //Указать свои данные для подключения к WIFI-сети
    wifiMulti.addAP("Technofeya_WiFi", "12345678");
}

void loop() {
    String postData;
    // wait for WiFi connection
    if((wifiMulti.run() == WL_CONNECTED)) {
        HTTPClient http;
        USE_SERIAL.print("[HTTP] begin...\n");

        //If we are sending the value from the ESP32 to the web-server,
        //There is no important to get a response and process, use one.
        //There is a value from the sensor you can change val=250. 
        //We should add the new value to the sensor with the specified sendor_id 
        //To the user account login = kras 
        
        http.begin("http://iot.tfeya.ru/sensorData.php?login=kras&sensor_id=1&val=250&secret=12345678");
        int httpCode = http.POST(postData);   //Send the request

        String payload = http.getString();    //Get the response payload
 
        Serial.println(httpCode);   //Print HTTP return code
        Serial.println(payload);    //Print request response payload
        
        http.end();
    }
    USE_SERIAL.println("Not connected now");
    delay(1000);
}
