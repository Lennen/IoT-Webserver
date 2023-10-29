/**
 * GET request to the Web-server
 * using API key (secret variable)
 * with the user name variable and JSON-parsing
 * 
 *  Created on: 22.11.2019 By Eugene Rychkov
 *
 */
#include <Arduino.h>
#include <WiFi.h>
#include <WiFiMulti.h>
#include <HTTPClient.h>
#define USE_SERIAL Serial
#include "ArduinoJson.h"

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
        
        http.begin("http://iot.tfeya.ru/sensorData.php?login=kras&sensor_id=1&secret=12345678&val=240&json=1");
        int httpCode = http.POST(postData);   //Send the request

        String payload = http.getString();    //Get the response payload
 
        Serial.println(httpCode);   //Print HTTP return code
         Serial.println(" Payload: ");
        Serial.println(payload);    //Print request response payload

        ///////// JSON PARSING ///////////
        
        StaticJsonBuffer<300> JSONBuffer;                         //Memory pool
        JsonObject& parsed = JSONBuffer.parseObject(payload); //Parse message
       
        if (!parsed.success()) {   //Check for errors in parsing     
          Serial.println("Parsing failed");
          delay(2000);
          return;
        }
       
        const char * sensorName = parsed["SensorName"]; //Get sensor type value
        int value = parsed["val"];                    //Get value of sensor measurement
       
        Serial.print("Sensor name: ");
        Serial.println(sensorName);
        Serial.print("Sensor value: ");
        Serial.println(value);
        
        ///////// JSON PARSING END ///////////
        
        http.end();
    }
    USE_SERIAL.println("Not connected now");
    delay(1000);
}
