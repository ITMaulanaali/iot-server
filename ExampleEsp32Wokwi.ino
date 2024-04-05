// This example uses an ESP32 Development Board
// to connect to shiftr.io.
//
// You can check on your device after a successful
// connection here: https://www.shiftr.io/try.
//
// by Joël Gähwiler
// https://github.com/256dpi/arduino-mqtt

#include <WiFi.h>
#include <MQTT.h>

const char ssid[] = "Wokwi-GUEST";
const char pass[] = "";

WiFiClient net;
MQTTClient client;

unsigned long lastMillis = 0;

#define suhu 32
#define kelembaban 35
short lampu = 19;

void connect() {
  Serial.print("checking wifi...");
  while (WiFi.status() != WL_CONNECTED) {
    Serial.print(".");
    delay(1000);
  }

  Serial.print("\nconnecting...");
  while (!client.connect("esp32", "hidroponikan", "XU3QHexrKaVsrfLd")) {
    Serial.print(".");
    delay(1000);
  }

  Serial.println("\nconnected!");

  client.subscribe("mqttx/rumah/esp32/lampu");
  // client.unsubscribe("/hello");
}

void messageReceived(String &topic, String &payload) {
  if(payload == "true"){
    digitalWrite(lampu, HIGH);
    Serial.println("nyalalampu");
  }else{
    digitalWrite(lampu, LOW);
    Serial.println("matilampu");
  }

  // Note: Do not use the client in the callback to publish, subscribe or
  // unsubscribe as it may cause deadlocks when other things arrive while
  // sending and receiving acknowledgments. Instead, change a global variable,
  // or push to a queue and handle it in the loop after calling `client.loop()`.
}

void setup() {
  Serial.begin(115200);
  WiFi.begin(ssid, pass);
  pinMode(lampu, OUTPUT);
  pinMode(suhu, INPUT);
  pinMode(kelembaban, INPUT);

  // Note: Local domain names (e.g. "Computer.local" on OSX) are not supported
  // by Arduino. You need to set the IP address directly.
  client.begin("hidroponikan.cloud.shiftr.io", net);
  client.onMessage(messageReceived);

  connect();
}

void loop() {
  client.loop();
  delay(10);  // <- fixes some issues with WiFi stability

  if (!client.connected()) {
    connect();
  }

  short sensorSuhu = analogRead(suhu);
  short sensorKelembaban = analogRead(kelembaban);

  // publish a message roughly every second.
  if (millis() - lastMillis > 1000) {
    lastMillis = millis();
    client.publish("mqttx/suhu", String(sensorSuhu));
    client.publish("mqttx/kelembaban", String(sensorKelembaban));
  }
}