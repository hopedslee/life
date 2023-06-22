#define RELAY 3
#define POWER_LED 11
#define WATER_LED 13
#define RELAY_LED 12

void setup() {
  Serial.begin(9600); //시리얼 모니터를 시작합니다.
  pinMode(RELAY, OUTPUT);
  pinMode(POWER_LED, OUTPUT);
  pinMode(WATER_LED, OUTPUT);
  pinMode(RELAY_LED, OUTPUT);
  digitalWrite(POWER_LED, HIGH); // LED ON 한다.
}

void loop() {
  int level = analogRead(A0);  // 수분센서의 신호를 측정합니다.
  if(level<330) // 물이 부족하면 
  { 
    digitalWrite(WATER_LED, HIGH); // 부저가 울리기 시작한다.
    if(RELAY) {
        delay(3000);
        digitalWrite(RELAY, HIGH); 
        digitalWrite(RELAY_LED, HIGH); // 부저가 울리기 시작한다.
    }
    Serial.println(level);   //시리얼 모니터에 값을 출력합니다.
  }
  else
  {
    digitalWrite(WATER_LED, LOW); 
    if(RELAY) {
        delay(3000);
        digitalWrite(RELAY_LED, LOW); 
        digitalWrite(RELAY, LOW); 
    }
    Serial.println(level);   //시리얼 모니터에 값을 출력합니다.
    delay(1000);
  }
  //digitalWrite(RELAY, HIGH); // 부저가 울리기 시작한다.
  delay(1000);
}