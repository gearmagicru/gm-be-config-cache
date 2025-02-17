<?php
/**
 * Этот файл является частью расширения модуля веб-приложения GearMagic.
 * 
 * @link https://gearmagic.ru
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

namespace Gm\Backend\Config\Cache\Model;

use Gm;
use Gm\Filesystem\Filesystem as Fs;
use Gm\Backend\Config\Model\ServiceForm;

/**
 * Модель данных конфигурации службы "Кэш".
 * 
 * Cлужба {@see \Gm\Cache\Cache}.
 * 
 * @author Anton Tivonenko <anton.tivonenko@gmail.com>
 * @package Gm\Backend\Config\Cache\Model
 * @since 1.0
 */
class Form extends ServiceForm
{
    /**
     * {@inheritdoc}
     */
    public function init(): void
    {
        parent::init();

        $this->unifiedName = Gm::$app->cache->getObjectName();
    }

    /**
     * {@inheritdoc}
     */
    public function maskedAttributes(): array
    {
        return [
            'enabled'      => 'enabled', // служба включена
            'default'      => 'default', // адаптер по умолчанию
            'postCaching'  => 'postCaching', // кэширования статей сайта
            'tableCaching' => 'tableCaching', // кэширования данных классификаторов
            'keyPrefix'    => 'keyPrefix', // префикс ключей кэша

            /** 
             * Файловая система
             */
            // кэш каталога
            'filesystemDirectory' => 'filesystemDirectory', // directory

            /** 
             * Redis
             * @see https://symfony.com/doc/current/components/cache/adapters/redis_adapter.html 
             */
            'redisDsn' => 'redisDsn',
            /**
             * Включает или отключает ленивые подключения к серверной части.
             */
            'redisLazy' => 'redisLazy', // lazy (type: bool, default: false) 
            /**
             * Включает или отключает использование постоянных подключений. Значение 0 
             * отключает постоянные соединения, а значение 1 включает их.
             */
            'redisPersistent' => 'redisPersistent', // persistent (type: int, default: 0) 
            /**
             * Указывает тайм-аут TCP-keepalive (в секундах) соединения. Для этого 
             * требуется phpredis v4 или выше и сервер с поддержкой TCP-keepalive.
             */
            'redisTcpKeepAlive' => 'redisTcpKeepAlive', // tcp_keepalive (type: int, default: 0)
            /**
             * Указывает время (в секундах), используемое для подключения к серверу 
             * Redis до истечения времени ожидания попытки подключения.
             */
            'redisTimeout' => 'redisTimeout', // timeout (type: int, default: 30)
            /**
             * Указывает время (в секундах), используемое при выполнении операций 
             * чтения базового сетевого ресурса до истечения времени ожидания операции.
             */
            'redisReadTimeout' => 'redisReadTimeout', // read_timeout (type: int, default: 0)
            /**
             * Указывает задержку (в миллисекундах) между попытками переподключения в случае 
             * потери связи клиента с сервером.
             */
            'redisRetryInterval' => 'redisRetryInterval', // retry_interval (type: int, default: 0)

            /** 
             * Memcached
             * @see https://symfony.com/doc/current/components/cache/adapters/memcached_adapter.html
             */
            'memcachedDsn' => 'memcachedDsn',
            /**
             * Включает или отключает постоянную автоматическую перебалансировку кластера 
             * путем автоматического исключения хостов, которые превысили настроенный server_failure_limit.
             */
            'memcacheAutoEjectHosts' => 'memcacheAutoEjectHosts', // auto_eject_hosts
            /**
             * Включает или отключает буферизованные операции ввода-вывода, заставляя 
             * команды хранения буферизоваться, а не немедленно отправляться на удаленный 
             * сервер (серверы). Любое действие, которое извлекает данные, завершает соединение 
             * или закрывает соединение, приведет к фиксации буфера.
             */
            'memcachedBufferWrites' => 'memcachedBufferWrites', // buffer_writes
            /**
             * Включает или отключает поведение, совместимое с «libketama», позволяя
             * другим клиентам на основе libketama получать прозрачный доступ к ключам, 
             * хранящимся в экземпляре клиента (например, Python и Ruby). При включении 
             * этой опции для параметра хеширования устанавливается значение md5, а для 
             * параметра распределения — последовательное.
             */
            'memcachedLibketamaCompatible' => 'memcachedLibketamaCompatible', // libketama_compatible 
            /**
             * Включает или отключает асинхронные операции ввода и вывода. Это самый 
             * быстрый вариант транспортировки, доступный для функций хранения.
             */
            'memcachedNoBlock' => 'memcachedNoBlock', // no_block
            /**
             * Включает или отключает тестирование и проверку всех используемых ключей, 
             * чтобы убедиться, что они действительны и соответствуют структуре используемого 
             * протокола.
             */
            'memcachedVerifyKey' => 'memcachedVerifyKey', // verify_key 
            /**
             * Включает или отключает использование режима протокола пользовательских дейтаграмм (UDP) 
             * (вместо режима протокола управления передачей (TCP)), где все операции выполняются по 
             * принципу «запустил и забыл»; после того, как клиент выполнил ее, не будет предпринято 
             * никаких попыток убедиться, что операция была получена или над ней были выполнены действия.
             */
            'memcachedUseUdp' => 'memcachedUseUdp', // use_udp
            /**
             * Включает или отключает алгоритм «no-delay» (алгоритм Нэгла) протокола 
             * управления передачей (TCP), который представляет собой механизм, предназначенный 
             * для повышения эффективности сетей за счет уменьшения накладных расходов на 
             * заголовки TCP путем объединения нескольких небольших исходящих сообщений. и 
             * отправить их все сразу.
             */
            'memcachedTcpNodelay' => 'memcachedTcpNodelay', // tcp_nodelay 
            /**
             * Включает или отключает функцию протокола управления передачей (TCP) "keep-alive", 
             * которая помогает определить, перестал ли отвечать другой конец, отправляя запросы 
             * одноранговой сети после периода простоя и закрывая или сохраняя сокет на основе 
             * ответа (или его отсутствия).
             */
            'memcachedTcpKeepAlive' => 'memcachedTcpKeepAlive', // tcp_keepalive 
            /**
             * Включает или отключает рандомизацию начальной точки чтения реплики. 
             * Обычно чтение выполняется с основного сервера, а в случае промаха 
             * чтение выполняется с "primary+1", затем "primary+2", вплоть до "n" 
             * реплик. Этот параметр задает чтение реплик как рандомизированное между 
             * всеми доступными серверами; это позволяет распределять нагрузку чтения 
             * на несколько серверов за счет большего трафика записи. 
             */
            'memcachedRandomizeReplicaRead' => 'memcachedRandomizeReplicaRead', // randomize_replica_read 
            /**
             * Указывает время ожидания (в миллисекундах) операций подключения к сокету, 
             * когда включена опция no_block.
             */
            'memcachedConnectTimeout' => 'memcachedConnectTimeout', // connect_timeout
            /**
             * Указывает метод распределения ключа элемента данных между серверами. 
             * Согласованное хеширование обеспечивает лучшее распределение и позволяет 
             * добавлять серверы в кластер с минимальными потерями кэша.
             */
            'memcachedDistribution' => 'memcachedDistribution', // distribution 
            /**
             * Алгоритм хеширования, используемый для ключей элементов. Каждый алгоритм 
             * хеширования имеет свои преимущества и недостатки. Значение по умолчанию 
             * предлагается для совместимости с другими клиентами.
             */
            'memcachedHash' => 'memcachedHash', // hash
            /**
             * Задает сериализатор, используемый для сериализации нескалярных значений. 
             * Параметры igbinary требуют, чтобы расширение PHP igbinary было включено, 
             * а расширение memcached было скомпилировано с его поддержкой.
             */
            'memcachedSerializer' => 'memcachedSerializer', // serializer
            /**
             * Указывает лимит неудачных попыток подключения к серверу, прежде чем 
             * пометить сервер как «мертвый». Сервер останется в пуле серверов, если 
             * не включен auto_eject_hosts.
             */
            'memcachedServerFailureLimit' => 'memcachedServerFailureLimit' // server_failure_limit
        ];
    }

  /**
     * {@inheritdoc}
     */
    public function afterValidate(bool $isValid): bool
    {
        if ($isValid) {
            // файловая система
            $cachePath = Gm::getAlias($this->filesystemDirectory);
            if (!Fs::exists($cachePath)) {
                if (!Fs::makeDirectory($cachePath, 0755, false)) {
                    $this->addError(
                        $this->module->t('Error creating cache directory "{0}"', 
                        [$cachePath])
                    );
                    return false;
                }
            }
        }
        return $isValid;
    }

    /**
     * {@inheritdoc}
     */
    public function formatterRules(): array
    {
        return [
            [
                [
                    'postCaching', 'tableCaching', 'enabled', 
                    // Redis
                    'redisLazy', 'redisPersistent', 
                    // Memcached
                    'memcacheAutoEjectHosts', 'memcachedBufferWrites', 'memcachedLibketamaCompatible', 
                    'memcachedNoBlock', 'memcachedVerifyKey', 'memcachedUseUdp', 'memcachedTcpNodelay',
                    'memcachedTcpKeepAlive', 'memcachedRandomizeReplicaRead'
                ], 
                'logic' => [true, false]
            ],
            [
                [
                    // Redis
                    'redisPersistent', 'redisTcpKeepAlive', 'redisTimeout', 'redisReadTimeout', 'redisRetryInterval', 
                    // Memcached
                    'memcachedConnectTimeout'
                ],
                'type' => ['int']
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function validationRules(): array
    {
        return [
            [
                [
                    'keyPrefix', 
                    // Redis
                    'redisDsn',
                    // Memcached
                    'memcachedDsn',
                    // Файловая система
                    'filesystemDirectory'
                ], 
                'notEmpty'
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function beforeUpdate(array &$columns): void
    {
        $config = [
            'enabled'     => $columns['enabled'] ?? true,
            'default'     => $columns['default'],
            'postCaching' => $columns['postCaching'] ?? false,
            'tableCaching' => $columns['tableCaching'] ?? false,
            'keyPrefix'   => $columns['keyPrefix'] ?? '',
            'adapters'    => [
                // Файловая система
                'filesystem' => [
                    'directory' => $columns['filesystemDirectory'] ?? null
                ],

                // Redis
                'redis' => [
                    'dsn'     => $columns['redisDsn'] ?? '',
                    'options' => [
                        'lazy'           => $columns['redisLazy'] ?? false,
                        'persistent'     => isset($columns['redisPersistent']) ? ($columns['redisPersistent'] ? 1 : 0) : 0,
                        'tcp_keepalive'  => (int) ($columns['redisTcpKeepAlive'] ?? 0),
                        'timeout'        => (int) ($columns['redisTimeout'] ?? 30),
                        'read_timeout'   => (int) ($columns['redisReadTimeout'] ?? 0),
                        'retry_interval' => (int) ($columns['redisRetryInterval'] ?? 0),
                    ]
                ],

                // Memcached
                'memcached' => [
                    'dsn'     => $columns['memcachedDsn'] ?? '',
                    'options' => [
                        'auto_eject_hosts'       => $columns['memcacheAutoEjectHosts'] ?? false,
                        'buffer_writes'          => $columns['memcachedBufferWrites'] ?? false,
                        'libketama_compatible'   => $columns['memcachedLibketamaCompatible'] ?? true,
                        'no_block'               => $columns['memcachedNoBlock'] ?? true,
                        'use_udp'                => $columns['memcachedUseUdp'] ?? false,
                        'tcp_nodelay'            => $columns['memcachedTcpNodelay'] ?? false,
                        'tcp_keepalive'          => $columns['memcachedTcpKeepAlive'] ?? false,
                        'randomize_replica_read' => $columns['memcachedRandomizeReplicaRead'] ?? false,
                        'connect_timeout'        => (int) ($columns['memcachedConnectTimeout'] ?? 1000),
                        'distribution'           => $columns['memcachedDistribution'] ?? 'consistent',
                        'hash'                   => $columns['memcachedHash'] ?? 'md5',
                        'serializer'             => $columns['memcachedSerializer'] ?? 'php'
                    ]
                ]
            ]
        ];
        $columns = $config;
    }

    /**
     * Проверяет соединение с сервером Redis через DSN.
     * 
     * @param bool $clear Очистить кэш.
     * 
     * @return bool
     */
    public function redisTest(bool $clear = false): bool
    {
        // проверка соединения через DSN
        if (empty($this->redisDsn)) {
            $this->addError( Gm::t(BACKEND, 'Error filling out form fields: {0}', ['Redis DSN']) );
            return false;
        }
        try {
            $adapter =  Gm::$app->cache->createAdapter(
                'redis',
                ['dsn' => $this->redisDsn]
            );
            if ($clear) {
                if (!$adapter->clear()) {
                    $this->addError($this->t('Error deleting cache data'));
                    return false;
                }
            }
        } catch (\Exception $e) {
            $this->addError(mb_convert_encoding($e->getMessage(), 'UTF-8'));
            return false;
        }
        return true;
    }

    /**
     * Проверяет соединение с сервером Memcached через DSN.
     * 
     * @param bool $clear Очистить кэш.
     * 
     * @return bool
     */
    public function memcachedTest(bool $clear = false): bool
    {
        // проверка соединения через DSN
        if (empty($this->memcachedDsn)) {
            $this->addError( Gm::t(BACKEND, 'Error filling out form fields: {0}', ['Memcached DSN']) );
            return false;
        }
        try {
            $adapter =  Gm::$app->cache->createAdapter(
                'memcached',
                ['dsn' => $this->memcachedDsn]
            );
            if ($clear) {
                if (!$adapter->clear()) {
                    $this->addError($this->t('Error deleting cache data'));
                    return false;
                }
            }
        } catch (\Exception $e) {
            $this->addError(mb_convert_encoding($e->getMessage(), 'UTF-8'));
            return false;
        }
        return true;
    }

    /**
     * Проверяет запись в каталог кэширования.
     * 
     * @param bool $clear Очистить кэш.
     * 
     * @return bool
     */
    public function filesystemTest(bool $clear = false): bool
    {
        // проверка соединения через DSN
        if (empty($this->filesystemDirectory)) {
            $this->addError( Gm::t(BACKEND, 'Error filling out form fields: {0}', [$this->t('Directory cache')]) );
            return false;
        }
        $class = Gm::$app->cache->getAdapterClass('filesystem');
        try {
            $adapter = $class::factory([
                'directory' => Gm::getAlias($this->filesystemDirectory)
            ]);
            if ($clear) {
                if (!Fs::deleteDirectory(Gm::getAlias($this->filesystemDirectory), true)) {
                    $this->addError($this->t('Error deleting cache data'));
                    return false;
                }
            } else {
                $key   = 'foo';
                $value = 'bar';
                $item = $adapter->getItem($key);
                $item->set($value);
                if (!$adapter->save($item)) {
                    $this->addError($this->t('Error creating cache file'));
                    return false;
                }
            }
        } catch (\Exception $e) {
            $this->addError($e->getMessage());
            return false;
        }
        return true;
    }
}
