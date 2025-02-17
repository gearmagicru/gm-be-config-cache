<?php
/**
 * Этот файл является частью расширения модуля веб-приложения GearMagic.
 * 
 * Файл конфигурации установки расширения.
 * 
 * @link https://gearmagic.ru
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

return [
    'id'          => 'gm.be.config.cache',
    'moduleId'    => 'gm.be.config',
    'name'        => 'Cache',
    'description' => 'Data caching',
    'namespace'   => 'Gm\Backend\Config\Cache',
    'path'        => '/gm/gm.be.config.cache',
    'route'       => 'cache',
    'locales'     => ['ru_RU', 'en_GB'],
    'permissions' => ['any', 'info'],
    'events'      => [],
    'required'    => [
        ['php', 'version' => '8.2'],
        ['app', 'code' => 'GM MS'],
        ['app', 'code' => 'GM CMS'],
        ['app', 'code' => 'GM CRM'],
        ['module', 'id' => 'gm.be.config']
    ]
];
