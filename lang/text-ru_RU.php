<?php
/**
 * Этот файл является частью расширения модуля веб-приложения GearMagic.
 * 
 * Пакет русской локализации.
 * 
 * @link https://gearmagic.ru
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

return [
    '{name}'        => 'Кэш',
    '{description}' => 'Кэширования данных',
    '{permissions}' => [
        'any'  => ['Полный доступ', 'Настройка кэширования данных']
    ],

    // Form: вкладка / Настройка службы кэширования
    'Configuring the cache service' => 'Настройка службы кэширования',
    'Caching method' => 'Способ кэширования',
    'Website article caching' => 'Кэширование статей сайта',
    'Classifier data caching' => 'Кэширование данных таблиц',
    'Caching service enabled' => 'Служба кэширования включена',
    'Cache key prefix' => 'Префикс ключей кэша',
    // Form: вкладка / Файловая система
    'Filesystem adapter' => 'Файловая система',
    'Filesystem' => 'Файловая система',
    'the cache is written to disk as PHP files and read as native code' => 'кеш записывается на диск в виде файлов PHP и считывается как собственный код',
    'Filesystem note' => 'Кэш каталога указывает на место записи файлов в формате PHP. Убедитесь, что каталог существует и вы имеет права доступа к нему (кнопка «<b>Проверить</b>»).',
    'Filesystem format' => 'Запись каталога должна соответствовать следующему формату: <br><div style="font-size:15px;margin-top:4px;color:#333">{0}</div>',
    'Directory cache' => 'Кэш каталога',
    'Directory attributes' => 'Атрибуты каталога',
    'Full path' => 'Полный путь',
    'Permissions' => 'Права доступа',
    'Error creating cache file' => 'Ошибка создания файла кэша.',
    '<unknown>' => '<неизвестно>',
    '<does not exist>' => '<не существует>',
    '<indefinitely>' => '<неопределенно>',
    // Form: вкладка / Сервер Redis
    'Redis adapter' => 'Сервер Redis',
    'NoSQL resident database management system' => 'резидентная система управления базами данных класса NoSQL с открытым исходным кодом, работающая со структурами данных типа «ключ — значение»',
    'Redis DSN note' => 'Запись DSN (имя источника данных) может указывать, как на IP-адрес/хост (и необязательный порт), так и на путь к сокету, или  пароль и индекс базы данных. Чтобы включить TLS, схема redis должна быть заменена на rediss (вторая буква s означает «безопасный»).',
    'Lazy connections to the server' => 'Ленивое подключения к серверной части',
    'Use persistent connection' => 'Использовать постоянное подключение',
    'TCP-keepalive timeout of the connection' => 'Тайм-аут TCP-keepalive соединения (сек.)',
    'Specifies the TCP-keepalive timeout of the connection' => 'Указывает тайм-аут TCP-keepalive (в секундах) соединения. Для этого требуется phpredis v4 или выше и сервер с поддержкой TCP-keepalive', // tooltip
    'Connection attempt timeout' => 'Тайм-аут попытки соединения (сек.)',
    'Specifies the time (in seconds) used to connect' => 'Указывает время (в секундах), используемое для подключения к серверу Redis до истечения времени ожидания попытки подключения', // tooltip
    'Read attempt timeout' => 'Тайм-аут попытки чтения (сек.)',
    'Specifies the time (in seconds) used when performing read operations' => 'Указывает время (в секундах), используемое при выполнении операций чтения базового сетевого ресурса до истечения времени ожидания операции', // tooltip
    'Delay between reconnect attempts' => 'Задержка между попытками переподключения (мс.)',
    'Specifies the delay between reconnection attempts' => 'Указывает задержку (в миллисекундах) между попытками переподключения в случае потери связи клиента с сервером',
    // Form: вкладка / Сервер Memcached
    'Memcached adapter' => 'Сервер Memcached',
    'software that implements an in-memory data caching service' => 'программное обеспечение, реализующее сервис кэширования данных в оперативной памяти на основе хеш-таблицы',
    'Memcached DSN note' => 'Запись DSN (имя источника данных) должна включать IP/хост (и необязательный порт) или путь к сокету, необязательные имя пользователя и пароль (для аутентификации SASL) и необязательный вес (для приоритизации серверов в кластере; его значение — целое число от 0 до 100, которое по умолчанию равно нулю; более высокое значение означает более высокий приоритет).',
    'Automatic cluster rebalancing' => 'Автоматическая перебалансировка кластера',
    'I/O buffering' => 'Буферизация операций ввода-вывода',
    'Compatibility with "libketama"' => 'Cовместимость с «libketama»',
    'Asynchronous input and output operations' => 'Асинхронные операции ввода и вывода',
    'Testing and verification of all used keys' => 'Тестирование и проверка всех используемых ключей',
    'Using UDP protocol mode' => 'Использование режима протокола UDP',
    'Use the "no-delay" algorithm' => 'Использовать алгоритм «no-delay»',
    'Enable TCP function "keep-alive"' => 'Включить функцию TCP «keep-alive»',
    'Randomization of replica read start point' => 'Рандомизация начальной точки чтения реплики',
    'Socket connection timeout' => 'Время ожидания подключения к сокету (мс.)',
    'Specifies the timeout of socket connection' => 'Указывает время ожидания (в миллисекундах) операций подключения к сокету, когда включена опция no_block', // tooltip
    'Key distribution method' => 'Метод распределения ключей',
    'Specifies the method for distributing the key of an item between servers' => 'Указывает метод распределения ключа элемента данных между серверами', // tooltip
    'Hashing algorithm' => 'Алгоритм хеширования',
    'Hashing algorithm used for item keys' => 'Алгоритм хеширования, используемый для ключей элементов', // tooltip
    'Serializer' => 'Сериализатор',
    'Specifies the serializer used to serialize scalar values' => 'Задает сериализатор, используемый для сериализации нескалярных значений', // tooltip
    'Limit of failed connection attempts' => 'Лимит неудачных попыток подключения',
    'Limit of unsuccessful attempts to connect to the server' => 'Лимит неудачных попыток подключения к серверу, прежде чем  пометить сервер как «мертвый»', // tooltip
    'DSN format' => 'Имя источника данных (DSN) можно указать в следующем формате: <br><div style="font-size:15px;margin-top:4px;color:#333">{0}</div>',
    'Connection options' => 'Параметры подключения',
    'Check' => 'Проверить',
    'Check connection' => 'Проверить соединение',
    'Reset cache' => 'Сбросить кэш',
    'reset settings' => 'сбросить настройки',
    // Form: сообщения
    'Save settings' => 'Сохранение настроек',
    'Reset settings' => 'Сброс настроек',
    'settings saved {0} successfully' => 'успешное сохранение настроек "<b>{0}</b>"',
    'settings reseted {0} successfully' => 'успешный сброс настроек "<b>{0}</b>"',
    // Form: вкладки / сообщения
    'Connection' => 'Соединение',
    'An attempt was made to connect to the cache server successfully' => 'Попытка соединения с сервером кэширования успешно выполнена.',
    'Error deleting cache data' => 'Ошибка удаления данных кэша.',
    'Clearing the cache' => 'Очистка кэша',
    'Cache data deleted successfully' => 'Данные кэша успешно удалены.',
    'Save settings' => 'Сохранение настроек',
    'Reset settings' => 'Сброс настроек',
    'The directory {0} you specified does not exist' => 'Указанный Вами каталог «{0}» не существует',
    'Error creating cache directory "{0}"' => 'Ошибка создания кэш каталога "{0}".'
];
