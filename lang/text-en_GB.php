<?php
/**
 * Этот файл является частью расширения модуля веб-приложения GearMagic.
 * 
 * Пакет английской (британской) локализации.
 * 
 * @link https://gearmagic.ru
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

return [
    '{name}'        => 'Cache',
    '{description}' => 'Data caching',
    '{permissions}' => [
        'any'  => ['Full access', 'Configuring data caching']
    ],

    // Form: вкладка / Настройка службы кэширования
    'Configuring the cache service' => 'Configuring the cache service',
    'Caching method' => 'Caching method',
    'Website article caching' => 'Website article caching',
    'Classifier data caching' => 'Classifier data caching',
    'Caching service enabled' => 'Caching service enabled',
    'Cache key prefix' => 'Cache key prefix',
    // Form: вкладка / Файловая система
    'Filesystem adapter' => 'Filesystem adapter',
    'Filesystem' => 'Filesystem',
    'the cache is written to disk as PHP files and read as native code' => 'the cache is written to disk as PHP files and read as native code',
    'Filesystem note' => 'The directory cache points to the location where files in PHP format are written. Make sure the directory exists and you have permissions to access it (button «<b>Check</b>»).',
    'Filesystem format' => 'The directory entry must follow the following format: <br><div style="font-size:15px;margin-top:4px;color:#333">{0}</div>',
    'Directory cache' => 'Directory cache',
    'Directory attributes' => 'Directory attributes',
    'Full path' => 'Full path',
    'Permissions' => 'Permissions',
    'Error creating cache file' => 'Error creating cache file.',
    '<unknown>' => '<unknown>',
    '<does not exist>' => '<does not exist>',
    '<indefinitely>' => '<indefinitely>',
    // Form: вкладка / Сервер Redis
    'Redis adapter' => 'Redis adapter',
    'NoSQL resident database management system' => 'an open source NoSQL resident database management system that works with key-value data structures',
    'Redis DSN note' => 'The DSN (Data Source Name) entry can point to either an IP address/host (and optional port) or a socket path, or a password and database index. To enable TLS, the redis schema must be changed to rediss (the second s means «secure»).',
    'Lazy connections to the server' => 'Lazy connections to the server',
    'Use persistent connection' => 'Use persistent connection',
    'TCP-keepalive timeout of the connection' => 'TCP-keepalive timeout of the connection (sec.)',
    'Specifies the TCP-keepalive timeout of the connection' => 'Specifies the TCP-keepalive timeout (in seconds) for the connection. This requires phpredis v4 or higher and a server with TCP-keepalive support', // tooltip
    'Connection attempt timeout' => 'Connection attempt timeout (sec.)',
    'Specifies the time (in seconds) used to connect' => 'Specifies the time (in seconds) used to connect to the Redis server before a connection attempt times out', // tooltip
    'Read attempt timeout' => 'Read attempt timeout (sec.)',
    'Specifies the time (in seconds) used when performing read operations' => 'Specifies the time (in seconds) used when performing read operations on the underlying network resource before the operation times out', // tooltip
    'Delay between reconnect attempts' => 'Delay between reconnect attempts (ms.)',
    'Specifies the delay between reconnection attempts' => 'Specifies the delay (in milliseconds) between reconnect attempts if the client-server connection is lost',
    // Form: вкладка / Сервер Memcached
    'Memcached adapter' => 'Memcached adapter',
    'software that implements an in-memory data caching service' => 'software that implements an in-memory data caching service based on a hash table',
    'Memcached DSN note' => 'The DSN (data source name) entry must include an IP/host (and optional port) or socket path, an optional username and password (for SASL authentication), and an optional weight (for prioritizing servers in the cluster; its value is an integer from 0 to 100, which defaults to zero; higher value means higher priority).',
    'Automatic cluster rebalancing' => 'Automatic cluster rebalancing',
    'I/O buffering' => 'I/O buffering',
    'Compatibility with "libketama"' => 'Compatibility with «libketama»',
    'Asynchronous input and output operations' => 'Asynchronous input and output operations',
    'Testing and verification of all used keys' => 'Testing and verification of all used keys',
    'Using UDP protocol mode' => 'Using UDP protocol mode',
    'Use the "no-delay" algorithm' => 'Use the «no-delay» algorithm',
    'Enable TCP function "keep-alive"' => 'Enable TCP functio «keep-alive»',
    'Randomization of replica read start point' => 'Randomization of replica read start point',
    'Socket connection timeout' => 'Socket connection timeout (ms.)',
    'Specifies the timeout of socket connection' => 'Specifies the timeout (in milliseconds) for socket connection operations when the no_block option is enabled', // tooltip
    'Key distribution method' => 'Key distribution method',
    'Specifies the method for distributing the key of an item between servers' => 'Specifies the method for distributing the key of an item between servers', // tooltip
    'Hashing algorithm' => 'Hashing algorithm',
    'Hashing algorithm used for item keys' => 'Hashing algorithm used for item keys', // tooltip
    'Serializer' => 'Serializer',
    'Specifies the serializer used to serialize scalar values' => 'Specifies the serializer used to serialize scalar values', // tooltip
    'Limit of failed connection attempts' => 'Limit of failed connection attempts',
    'Limit of unsuccessful attempts to connect to the server' => 'Limit of failed attempts to connect to the server before marking the server as «dead»', // tooltip
    'DSN format' => 'The data source name (DSN) can be specified in the following format: <br><div style="font-size:15px;margin-top:4px;color:#333">{0}</div>',
    'Connection options' => 'Connection options',
    'Check' => 'Check',
    'Check connection' => 'Check connection',
    'Reset cache' => 'Reset cache',
    'reset settings' => 'reset settings',
    // Form: сообщения
    'Save settings' => 'Save settings',
    'Reset settings' => 'Reset settings',
    'settings saved {0} successfully' => 'settings saved "<b>{0}</b>" successfully',
    'settings reseted {0} successfully' => 'settings reseted "<b>{0}</b>" successfully',
    // Form: вкладки / сообщения
    'Connection' => 'Connection',
    'An attempt was made to connect to the cache server successfully' => 'An attempt was made to connect to the cache server successfully.',
    'Error deleting cache data' => 'Error deleting cache data.',
    'Clearing the cache' => 'Clearing the cache',
    'Cache data deleted successfully' => 'Cache data deleted successfully.',
    'Save settings' => 'Save settings',
    'Reset settings' => 'Reset settings',
    'The directory {0} you specified does not exist' => 'The directory «{0}» you specified does not exist «{0}»',
    'Error creating cache directory "{0}"' => 'Error creating cache directory "{0}".'
];
