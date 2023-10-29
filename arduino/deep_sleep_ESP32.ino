/*
Режим глубокого сна и пробуждение по таймеру
=====================================
ESP32 может работать в режиме глубокого сна,
позволяющего более экономно расходовать энергопотребление,
что важно при разработке IoT-проектов.

В этом режиме выключены процессоры, большая часть RAM
и вся цифровая периферия, получающая тактовый сигнал через APB_CLK.
Единственные компоненты чипа, что по-прежнему могут работать – 
это RTC-контроллер, RTC-периферия и RTC-память.

Этот скетч-пример демонстрирует основы
работы с режимом глубокого сна при помощи таймера,
а также показывает, как сохранять данные в RTC-память,
чтобы заново использовать их между загрузками.

Этот код распространяется по лицензии всеобщего достояния.
Автор: Пранав Черукупалли <cherukupallip@gmail.com>
*/

#define uS_TO_S_FACTOR 1000000  /* коэффициент пересчета
                                   микросекунд в секунды */
#define TIME_TO_SLEEP  5        /* время, в течение которого
                                   будет спать ESP32 (в секундах) */

RTC_DATA_ATTR int bootCount = 0;

/*
Метод для печати в мониторе порта причины пробуждения ESP32
*/
void print_wakeup_reason(){
  esp_sleep_wakeup_cause_t wakeup_reason;

  wakeup_reason = esp_sleep_get_wakeup_cause();

  switch(wakeup_reason)
  {
    case 1  : Serial.println("Wakeup caused by external signal using RTC_IO"); break;
                         //  "Пробуждение от внешнего сигнала с помощью RTC_IO"
    case 2  : Serial.println("Wakeup caused by external signal using RTC_CNTL"); break;
                         //  "Пробуждение от внешнего сигнала с помощью RTC_CNTL"  
    case 3  : Serial.println("Wakeup caused by timer"); break;
                         //  "Пробуждение от таймера"
    case 4  : Serial.println("Wakeup caused by touchpad"); break;
                         //  "Пробуждение от сенсорного контакта"
    case 5  : Serial.println("Wakeup caused by ULP program"); break;
                         //  "Пробуждение от ULP-программы"
    default : Serial.println("Wakeup was not caused by deep sleep"); break;
                         //  "Пробуждение не связано с режимом глубокого сна"

  }
}

void setup(){
  Serial.begin(115200);
  delay(1000); // даем время на установление
               // последовательной коммуникации

  // увеличиваем значение в счетчике загрузок
  // и печатаем это значение с каждой загрузкой:
  ++bootCount;
  Serial.println("Boot number: " + String(bootCount));
              // "Количество загрузок: "

  // печатаем причину пробуждения ESP32:
  print_wakeup_reason();

  /*
  Сначала настраиваем инициатор пробуждения.
  Задаем, чтобы ESP32 просыпалась каждые 5 секунд.
  */
  esp_sleep_enable_timer_wakeup(TIME_TO_SLEEP * uS_TO_S_FACTOR);
  Serial.println("Setup ESP32 to sleep for every " + String(TIME_TO_SLEEP) +
  " Seconds");
             //  "ESP32 будет просыпаться каждые ... секунд"

  /*
  Теперь нам нужно решить, будет ли периферия включена или нет.
  По умолчанию ESP32 автоматически выключит всю периферию,
  которая не нужна инициатору пробуждения,
  но если вы опытный пользователь, то решать вам.

  Подробнее об этом читайте в документации об API:
  http://esp-idf.readthedocs.io/en/latest/api- reference/system/deep_sleep.html
 
  Оставьте знаки комментария у двух строчек ниже.
  В первой из них показывается, как переключить всю RTC-периферию
  в режим глубокого сна,
  а во второй - сообщается о переключении в монитор порта.
  */
  //esp_deep_sleep_pd_config(ESP_PD_DOMAIN_RTC_PERIPH, ESP_PD_OPTION_OFF);
  //Serial.println("Configured all RTC Peripherals to be powered down in sleep");
               //  "Перевод всей RTC-периферии в режим сна"

  /*
  Теперь, когда мы задали инициатора пробуждения, а также,
  если необходимо, задали, останется ли в режиме сна RTC-периферия,
  мы можем начать, собственно, перевод платы в режим сна.

  Если активировать режим сна, не задав инициаторов пробуждения,
  ESP32 будет пребывать в нем вечно, пока пользователь
  не выполнит аппаратный сброс.
  */
  Serial.println("Going to sleep now");
              // "Переход в режим сна"
  delay(1000);
  esp_deep_sleep_start();
  Serial.println("This will never be printed");
              // "Этого напечатано не будет"
}

void loop(){
  // Этот блок кода вызван не будет
}
