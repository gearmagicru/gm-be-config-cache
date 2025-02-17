<?php
/**
 * Этот файл является частью расширения модуля веб-приложения GearMagic.
 * 
 * @link https://gearmagic.ru
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

namespace Gm\Backend\Config\Cache\Controller;

use Gm;
use Gm\Helper\Html;
use Gm\Panel\Helper\Ext;
use Gm\Panel\Http\Response;
use Gm\Panel\Helper\ExtCombo;
use Gm\Panel\Widget\EditWindow;
use Gm\Filesystem\Filesystem;
use Gm\Mvc\Module\BaseModule;
use Gm\Backend\Config\Controller\ServiceForm;

/**
 * Контроллер конфигурации службы "Кэш".
 * 
 * Cлужба {@see \Gm\Cache\Cache}.
 * 
 * @author Anton Tivonenko <anton.tivonenko@gmail.com>
 * @package Gm\Backend\Config\Cache\Controller
 * @since 1.0
 */
class Form extends ServiceForm
{
    /**
     * {@inheritdoc}
     * 
     * @var \Gm\Backend\Config\Cache\Extension
     */
    public BaseModule $module;

    /**
     * Вкладка "Файловая система" панели вкладок.
     * 
     * @param EditWindow $window
     * 
     * @return array
     */
    public function filesystemTab(EditWindow $window): array
    {
        $filesystem = Gm::$app->cache->adapters['filesystem'] ?? [];

        $directory   = $filesystem['directory'] ?? '';
        $permissions = $fullpath = $this->module->t('<unknown>');
        if ($directory) {
            $fullpath = Gm::getAlias($directory);
            if (!Filesystem::exists($fullpath)) {
                $fullpath = $this->module->t('<does not exist>');
            } else {
                $permissions = Filesystem::permissions($fullpath);
                if ($permissions === false) {
                    $permissions = $this->module->t('<indefinitely>');
                }
            }
        }
        return [
            'title'       => '#Filesystem adapter',
            'bodyPadding' => 0,
            'autoScroll'  => true,
            'layout'      => 'anchor',
            'items'       => [
                [
                    'xtype' => 'displayfield',
                    'cls'   => 'g-form__display__header g-form__display__header_icon',
                    'width' => '100%',
                    'value' => Html::tags([
                        Html::tag('span', '', ['class' => 'g-icon g-icon_size_32 g-icon-svg gm-config-cache__icon-filesystem']),
                        Html::tag('div', $this->module->t('Filesystem'), ['class' => 'g-form__display__text']),
                        Html::tag('div', $this->module->t('the cache is written to disk as PHP files and read as native code'), ['class' => 'g-form__display__subtext'])
                    ])
                ],
                [
                    'xtype' => 'label',
                    'ui'    => "note",
                    'style' => 'margin-top:-4px',
                    'html'  => $this->module->t('Filesystem note') . '<br><br>'
                             . $this->module->t('Filesystem format', [' @cache, @runtime/cache'])
                ],
                [
                    'xtype' => 'toolbar',
                    'style'=> 'background-color:#e1f5fe',
                    'items' => [
                        '->',
                        [
                            'xtype'       => 'button',
                            'iconCls'     => "g-icon-svg g-icon_size_14 g-icon-m_accessible",
                            'ui'          => 'form-info',
                            'text'        => '#Check',
                            'handler'     => 'onFormAction',
                            'handlerArgs' => [
                                'route'            => $this->module->route('/form/test?adapter=filesystem'),
                                'closeWindowAfter' => false
                            ]
                        ],
                        [
                            'xtype'       => 'button',
                            'iconCls'     => "g-icon-svg g-icon_size_14 g-icon-m_trash",
                            'ui'          => 'form-notice',
                            'text'        => '#Reset cache',
                            'handler'     => 'onFormAction',
                            'handlerArgs' => [
                                'route'            => $this->module->route('/form/clear?adapter=filesystem'),
                                'closeWindowAfter' => false
                            ]
                        ]
                    ]
                ],
                [
                    'xtype' => 'container',
                    'style' => 'padding:12px 5px 5px 5px',
                    'items' => [
                        [
                            'xtype'      => 'textfield',
                            'fieldLabel' => '#Directory cache',
                            'name'       => 'filesystemDirectory',
                            'width'      => '100%',
                            'allowBlank' => false,
                            'labelAlign' => 'right',
                            'labelWidth' => 100,
                            'value'      => $directory
                        ],
                        [
                            'xtype'      => 'fieldset',
                            'title'      => '#Directory attributes',
                            'autoScroll' => true,
                            'height'     => $window->height - 472,
                            'defaults'   => [
                                'labelAlign' => 'right',
                                'xtype'      => 'displayfield',
                                'ui'         => 'parameter'
                            ],
                            'items' => [
                                [
                                    'fieldLabel' => '#Full path',
                                    'value'      => $fullpath
                                ],
                                [
                                    'fieldLabel' => '#Permissions',
                                    'value'      => $permissions
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * Вкладка "Сервер Redis" панели вкладок.
     * 
     * @see  https://symfony.com/doc/current/components/cache/adapters/redis_adapter.html
     * 
     * @param EditWindow $window
     * 
     * @return array
     */
    public function redisTab(EditWindow $window): array
    {
        $redis = Gm::$app->cache->adapters['redis'] ?? [];
        return [
            'title'       => '#Redis adapter',
            'bodyPadding' => 0,
            'autoScroll'  => true,
            'layout'      => 'anchor',
            'items'       => [
                [
                    'xtype' => 'displayfield',
                    'cls'   => 'g-form__display__header g-form__display__header_icon',
                    'width' => '100%',
                    'value' => Html::tags([
                        Html::tag('span', '', ['class' => 'g-icon g-icon_size_32 g-icon-svg gm-config-cache__icon-redis']),
                        Html::tag('div', 'Redis (Remote Dictionary Server)', ['class' => 'g-form__display__text']),
                        Html::tag('div', $this->module->t('NoSQL resident database management system'), ['class' => 'g-form__display__subtext'])
                    ])
                ],
                [
                    'xtype' => 'label',
                    'ui'    => "note",
                    'style' => 'margin-top:-4px',
                    'html'  => $this->module->t('Redis DSN note') . '<br><br>'
                             . $this->module->t('DSN format', ['redis[s]://[pass@][ip|host|socket[:port]][/db-index]'])
                ],
                [
                    'xtype' => 'toolbar',
                    'style'=> 'background-color:#e1f5fe',
                    'items' => [
                        '->',
                        [
                            'xtype'       => 'button',
                            'iconCls'     => "g-icon-svg g-icon_size_14 g-icon-m_accessible",
                            'ui'          => 'form-info',
                            'text'        => '#Check connection',
                            'handler'     => 'onFormAction',
                            'handlerArgs' => [
                                'route'            =>$this->module->route('/form/test?adapter=redis'),
                                'closeWindowAfter' => false
                            ]
                        ],
                        [
                            'xtype'       => 'button',
                            'iconCls'     => "g-icon-svg g-icon_size_14 g-icon-m_trash",
                            'ui'          => 'form-notice',
                            'text'        => '#Reset cache',
                            'handler'     => 'onFormAction',
                            'handlerArgs' => [
                                'route'            => $this->module->route('/form/clear?adapter=redis'),
                                'closeWindowAfter' => false
                            ]
                        ]
                    ]
                ],
                [
                    'xtype' => 'container',
                    'style' => 'padding:12px 5px 5px 5px',
                    'items' => [
                        [
                            'xtype'      => 'textfield',
                            'fieldLabel' => 'DSN',
                            'name'       => 'redisDsn',
                            'width'      => '100%',
                            'allowBlank' => false,
                            'labelAlign' => 'right',
                            'labelWidth' => 50,
                            'value'      => $redis['dsn'] ?? 'redis://localhost:6379'
                        ],
                        [
                            'xtype'      => 'fieldset',
                            'title'      => '#Connection options',
                            'autoScroll' => true,
                            'height'     => $window->height - 505,
                            'defaults'   => [
                                'labelAlign' => 'right',
                                'labelWidth' => 370,
                                'anchor'     => '90%',
                            ],
                            'items' => [
                                Ext::switch(
                                    '#Lazy connections to the server',
                                    'redisLazy',
                                    $redis['options']['lazy'] ?? false
                                ),
                                Ext::switch(
                                    '#Use persistent connection',
                                    'redisPersistent',
                                    $redis['options']['persistent'] ?? false
                                ),
                                Ext::numberField(
                                    '#TCP-keepalive timeout of the connection',
                                    'redisTcpKeepAlive',
                                    $redis['options']['tcp_keepalive'] ?? 0,
                                    [
                                        'tooltip'  => '#Specifies the TCP-keepalive timeout of the connection',
                                        'minValue' => 0
                                    ]
                                ),
                                Ext::numberField(
                                    '#Connection attempt timeout',
                                    'redisTimeout',
                                    $redis['options']['timeout'] ?? 0,
                                    [
                                        'tooltip'  => '#Specifies the time (in seconds) used to connect',
                                        'minValue' => 0
                                    ]
                                ),
                                Ext::numberField(
                                    '#Read attempt timeout',
                                    'redisReadTimeout',
                                    $redis['options']['read_timeout'] ?? 0,
                                    [
                                        'tooltip'  => '#Specifies the time (in seconds) used when performing read operations',
                                        'minValue' => 0
                                    ]
                                ),
                                Ext::numberField(
                                    '#Delay between reconnect attempts',
                                    'redisRetryInterval',
                                    $redis['options']['retry_interval'] ?? 0,
                                    [
                                        'tooltip'  => '#Specifies the delay between reconnection attempts',
                                        'minValue' => 0
                                    ]
                                )
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * Вкладка "Адаптер Memcached" панели вкладок.
     * 
     * @see https://symfony.com/doc/current/components/cache/adapters/memcached_adapter.html
     * 
     * @param EditWindow $window
     * 
     * @return array
     */
    public function memcachedTab(EditWindow $window): array
    {
        $memcached = Gm::$app->cache->adapters['memcached'] ?? [];
        return [
            'title'       => '#Memcached adapter',
            'bodyPadding' => 0,
            'layout'      => 'anchor',
            //'layout'      => 'vbox',
            'items'       => [
                [
                    'xtype' => 'displayfield',
                    'cls'   => 'g-form__display__header g-form__display__header_icon',
                    'width' => '100%',
                    'value' => Html::tags([
                        Html::tag('span', '', ['class' => 'g-icon g-icon_size_32 g-icon-svg gm-config-cache__icon-memcached']),
                        Html::tag('div', 'Memcached', ['class' => 'g-form__display__text']),
                        Html::tag('div', $this->module->t('software that implements an in-memory data caching service'), ['class' => 'g-form__display__subtext'])
                    ])
                ],
                [
                    'xtype' => 'label',
                    'ui'    => "note",
                    'style' => 'margin-top:-4px',
                    'html'  => $this->module->t('Memcached DSN note') . '<br><br>'
                             . $this->module->t('DSN format', ['memcached://[user:pass@][ip|host|socket[:port]][?weight=int]'])
                ],
                [
                    'xtype' => 'toolbar',
                    'style'=> 'background-color:#e1f5fe;',
                    'items' => [
                        '->',
                        [
                            'xtype'       => 'button',
                            'iconCls'     => "g-icon-svg g-icon_size_14 g-icon-m_accessible",
                            'ui'          => 'form-info',
                            'text'        => '#Check connection',
                            'handler'     => 'onFormAction',
                            'handlerArgs' => [
                                'route'            => $this->module->route('/form/test?adapter=memcached'),
                                'closeWindowAfter' => false
                            ]
                        ],
                        [
                            'xtype'       => 'button',
                            'iconCls'     => "g-icon-svg g-icon_size_14 g-icon-m_trash",
                            'ui'          => 'form-notice',
                            'text'        => '#Reset cache',
                            'handler'     => 'onFormAction',
                            'handlerArgs' => [
                                'route'            => $this->module->route('/form/clear?adapter=memcached'),
                                'closeWindowAfter' => false
                            ]
                        ]
                    ]
                ],
                [
                    'xtype'    => 'container',
                    'style'    => 'padding:12px 5px 5px 5px',
                    'defaults' => [
                        'labelAlign' => 'right',
                        'labelWidth' => 45,
                        'width'      => '100%'
                    ],
                    'items' => [
                        Ext::textField(
                            'DSN',
                            'memcachedDsn',
                            $memcached['dsn'] ?? 'memcached://localhost:11211',
                            [
                                'allowBlank' => false
                            ]
                        ),
                        [
                            'xtype'      => 'fieldset',
                            'title'      => '#Connection options',
                            'autoScroll' => true,
                            'height'     => $window->height - 521,
                            'defaults'   => [
                                'labelAlign' => 'right',
                                'labelWidth' => 330,
                                'anchor'     => '90%',
                            ],
                            'items' => [
                                Ext::switch(
                                    '#Automatic cluster rebalancing',
                                    'memcacheAutoEjectHosts',
                                    $memcached['options']['auto_eject_hosts'] ?? false
                                ),
                                Ext::switch(
                                    '#I/O buffering',
                                    'memcachedBufferWrites',
                                    $memcached['options']['buffer_writes'] ?? false
                                ),
                                Ext::switch(
                                    '#Compatibility with "libketama"',
                                    'memcachedLibketamaCompatible',
                                    $memcached['options']['libketama_compatible'] ?? true
                                ),
                                Ext::switch(
                                    '#Asynchronous input and output operations',
                                    'memcachedNoBlock',
                                    $memcached['options']['no_block'] ?? true
                                ),
                                Ext::switch(
                                    '#Testing and verification of all used keys',
                                    'memcachedVerifyKey',
                                    $memcached['options']['verify_key'] ?? false,
                                    [
                                        'disabled' => true
                                    ]
                                ),
                                Ext::switch(
                                    '#Using UDP protocol mode',
                                    'memcachedUseUdp',
                                    $memcached['options']['use_udp'] ?? false
                                ),
                                Ext::switch(
                                    '#Use the "no-delay" algorithm',
                                    'memcachedTcpNodelay',
                                    $memcached['options']['tcp_nodelay'] ?? false
                                ),
                                Ext::switch(
                                    '#Enable TCP function "keep-alive"',
                                    'memcachedTcpKeepAlive',
                                    $memcached['options']['tcp_keepalive'] ?? true
                                ),
                                Ext::switch(
                                    '#Randomization of replica read start point',
                                    'memcachedRandomizeReplicaRead',
                                    $memcached['options']['randomize_replica_read'] ?? false
                                ),
                                Ext::numberField(
                                    '#Socket connection timeout',
                                    'memcachedConnectTimeout',
                                    $redis['options']['connect_timeout '] ?? 1000,
                                    [
                                        'tooltip'  => '#Specifies the timeout of socket connection',
                                        'minValue' => 0
                                    ]
                                ),
                                ExtCombo::local(
                                    '#Key distribution method',
                                    'memcachedDistribution',
                                    [
                                        'fields' => ['id', 'name'],
                                        'data'   => [['modula', 'modula'], ['consistent', 'consistent'], ['virtual_bucket', 'virtual_bucket']]
                                    ],
                                    [
                                        'tooltip' => '#Specifies the method for distributing the key of an item between servers',
                                        'value'   => $redis['options']['distribution'] ?? 'consistent',
                                        'anchor'  => '90%'
                                    ]
                                ),
                                ExtCombo::local(
                                    '#Hashing algorithm',
                                    'memcachedHash',
                                    [
                                        'fields' => ['id', 'name'],
                                        'data'   => [
                                            ['default', 'default'], ['md5', 'md5'], ['crc', 'crc'], ['fnv1_64', 'fnv1_64'], ['fnv1a_64', 'fnv1a_64'], ['fnv1_32', 'fnv1_32'],
                                            ['fnv1a_32', 'fnv1a_32'], ['hsieh', 'hsieh'], ['murmur', 'murmur']
                                        ]
                                    ],
                                    [
                                        'tooltip' => '#Hashing algorithm used for item keys',
                                        'value'   => $redis['options']['hash'] ?? 'md5',
                                        'anchor'  => '90%'
                                    ]
                                ),
                                ExtCombo::local(
                                    '#Serializer',
                                    'memcachedSerializer',
                                    [
                                        'fields' => ['id', 'name'],
                                        'data'   => [['php', 'php'], ['igbinary', 'igbinary']],
                                    ],
                                    [
                                        'tooltip' => '#Specifies the serializer used to serialize scalar values',
                                        'value'   => $redis['options']['serializer'] ?? 'php',
                                        'anchor'  => '90%'
                                    ]
                                ),
                                Ext::numberField(
                                    '#Limit of failed connection attempts',
                                    'memcachedServerFailureLimit',
                                    $redis['options']['server_failure_limit'] ?? 0,
                                    [
                                        'tooltip'  => '#Limit of unsuccessful attempts to connect to the server',
                                        'minValue' => 0,
                                        'disabled' => true
                                    ]
                                )
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * Вкладка "Настройка службы кэширования" панели вкладок.
     * 
     * @param EditWindow $window
     * 
     * @return array
     */
    public function commonTab(EditWindow $window): array
    {
        $adapters = array_keys(Gm::$app->cache->adapters);
        $adapterItems = [];
        foreach ($adapters as $adapter) {
            $adapterItems[] = [$adapter, $this->module->t(ucfirst($adapter) . ' adapter')];
        }
        return [
            'title'       => '#Configuring the cache service',
            'bodyPadding' => 5,
            'bodyStyle'   => 'background-color:#f5f5f5',
            'height'      => $window->height - 200,
            'defaults'    => [
                'labelWidth' => 240,
                'labelAlign' => 'right',
                'width'      => 420
            ],
            'items'       => [
                ExtCombo::local(
                    '#Caching method',
                    'default',
                    [
                        'fields' => ['id', 'name'],
                        'data'   => $adapterItems
                    ],
                    [
                        'value' => Gm::$app->cache->default
                    ]
                ),
                Ext::textField(
                    '#Cache key prefix',
                    'keyPrefix',
                    Gm::$app->cache->keyPrefix,
                    [
                        'allowBlank' => false,
                        "triggers" =>  [
                            "edit" => [
                                "cls"           => "g-form-run-trigger",
                                "handler"       => "generateKeyPrefix",
                                "msgSelectItem" => "Сгенерировать префикс ключа"
                            ]
                        ]
                    ]
                ),
                Ext::switch(
                    '#Website article caching',
                    'postCaching',
                    isset(Gm::$app->cache->postCaching) ? Gm::$app->cache->postCaching : false
                ),
                Ext::switch(
                    '#Classifier data caching',
                    'tableCaching',
                    isset(Gm::$app->cache->tableCaching) ? Gm::$app->cache->tableCaching : false
                ),
                Ext::switch(
                    '#Caching service enabled',
                    'enabled',
                    Gm::$app->cache->enabled
                )
            ]
        ];
    }

    /**
     * Возвращает элементы панели формы (Gm.view.form.Panel GmJS).
     * 
     * @param EditWindow $window
     * 
     * @return array
     */
    protected function getFormItems(EditWindow $window): array
    {
        return [
            [
                'xtype'           => 'tabpanel',
                'activeTab'       => 0,
                'ui'              => 'flat-light',
                'enableTabScroll' => true,
                'anchor'          => '100%',
                'autoHeight'      => true,
                'items'           => [
                    $this->commonTab($window), $this->redisTab($window), $this->memcachedTab($window), $this->filesystemTab($window)
                ]
            ],
            [
                'xtype'  => 'toolbar',
                'dock'   => 'bottom',
                'border' => 0,
                'style'  => ['borderStyle' => 'none'],
                'items'  => [
                    Ext::switch($this->module->t('reset settings'), 'reset', false, ['labelWidth' => 130, 'labelAlign' => 'right'])
                 ]
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function createWidget(): EditWindow
    {
        /** @var EditWindow $window */
        $window = parent::createWidget();

        // окно компонента (Ext.window.Window Sencha ExtJS)
        $window->width = 600;
        $window->height = 800;
        $window->responsiveConfig = [
            'height < 800' => ['height' => '99%'],
        ];

        // панель формы (Gm.view.form.Panel GmJS)
        $window->form->items = $this->getFormItems($window);
        $window->form->bodyPadding = 0;
        $window->form->controller = 'gm-be-config-cache-form';
        $window
            ->addCss('/form.css')
            ->setNamespaceJS('Gm.be.config.cache')
            ->addRequire('Gm.be.config.cache.FormController');
        return $window;
    }

    /**
     * Действие "test" проверяет  соединения с адаптером кэширования.
     * 
     * @return Response
     */
    public function testAction(): Response
    {
        /** @var Response $response */
        $response = $this->getResponse();
        /** @var \Gm\Http\Request $request */
        $request  = Gm::$app->request;

        /** @var string $adapter имя адаптера */
        $adapter = $request->getQuery('adapter');
        if (empty($adapter)) {
            $response
                ->meta->error(Gm::t('app', 'Invalid parameter passed'));
            return $response;
        }

        // если кэш не знает адаптера
        if (!Gm::$app->cache->hasAdapter($adapter)) {
            $response
                ->meta->error(Gm::t('app', 'Could not defined cache adapter "{0}"', [$adapter]));
            return $response;
        }

        /** @var \Gm\Panel\Data\Model\FormModel $model модель данных */
        $model = $this->getModel('Form');
        if ($model === false) {
            $response
                ->meta->error(Gm::t('app', 'Could not defined data model "{0}"', ['Form']));
            return $response;
        }

        // получение настроек из параметров службы или из унифицированного конфигуратора
        $form = $model->get();
        if ($form === null) {
            // если еще нет настроек в унифицированном конфигураторе
            $form = $model;
        }
        // загрузка атрибутов в модель из запроса, даже если запрос POST не имеет данных.
        // Такие поля как "флаг", значение которого может быть false, но через POST не передается, поэтому
        // нет смысла делать проверку "load" на заполение полей формы.
        $form->load($request->getPost());
         /** @var string $testMethod метод тестирования адаптера */
        $testMethod = $adapter . 'Test';
        if (!$form->hasMethod($testMethod)) {
            $response
                ->meta->error(Gm::t('app', 'Could not defined test method "{0}"', [$testMethod]));
            return $response;
        }

        // если ошибка при тестировании
        if (!$form->do($testMethod)) {
            $response
                ->meta->error($form->getError());
            return $response;
        } else {
            $response
                ->meta->cmdShowMsg(
                    $this->t('An attempt was made to connect to the cache server successfully'),
                    $this->t('Connection')
            );
        }
        return $response;
    }


    /**
     * Действие "clear" выполняет сброс кэша. 
     * 
     * @return Response
     */
    public function clearAction(): Response
    {
        /** @var Response $response */
        $response = $this->getResponse();
        /** @var \Gm\Http\Request $request */
        $request  = Gm::$app->request;

        /** @var string $adapter имя адаптера */
        $adapter = $request->getQuery('adapter');
        if (empty($adapter)) {
            $response
                ->meta->error(Gm::t('app', 'Invalid parameter passed'));
            return $response;
        }
        // если кэш не знает адаптера
        if (!Gm::$app->cache->hasAdapter($adapter)) {
            $response
                ->meta->error(Gm::t('app', 'Could not defined cache adapter "{0}"', [$adapter]));
            return $response;
        }
        /** @var \Gm\Panel\Data\Model\FormModel $model модель данных */
        $model = $this->getModel('Form');
        if ($model === false) {
            $response
                ->meta->error(Gm::t('app', 'Could not defined data model "{0}"', ['Form']));
            return $response;
        }
        // получение настроек из параметров службы или из унифицированного конфигуратора
        $form = $model->get();
        if ($form === null) {
            // если еще нет настроек в унифицированном конфигураторе
            $form = $model;
        }
        // загрузка атрибутов в модель из запроса, даже если запрос POST не имеет данных.
        // Такие поля как "флаг", значение которого может быть false, но через POST не передается, поэтому
        // нет смысла делать проверку "load" на заполение полей формы.
        $form->load($request->getPost());
         /** @var string $testMethod метод тестирования адаптера */
        $testMethod = $adapter . 'Test';
        if (!$form->hasMethod($testMethod)) {
            $response
                ->meta->error(Gm::t('app', 'Could not defined test method "{0}"', [$testMethod]));
            return $response;
        }
        // если ошибка при тестировании
        if (!$form->do($testMethod, true)) {
            $response
                ->meta->error($form->getError());
            return $response;
        } else {
            $response
                ->meta->cmdShowMsg(
                    $this->t('Cache data deleted successfully'),
                    $this->t('Clearing the cache')
            );
        }
        return $response;
    }
}
