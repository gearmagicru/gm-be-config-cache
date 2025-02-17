/*!
 * Контроллер формы.
 * Расширение "Кэш".
 * Модуль "Конфигурация".
 * 
 * Copyright 2015 Вeб-студия GearMagic. Anton Tivonenko <anton.tivonenko@gmail.com>
 * https://gearmagic.ru/license/
 */

Ext.define('Gm.be.config.cache.FormController', {
    extend: 'Gm.view.form.PanelController',
    alias: 'controller.gm-be-config-cache-form',

    /**
     * Генерирует уникальный префикс ключа кэша.
     * @param {Ext.form.field.TextField} me
     */
     generateKeyPrefix: (me) => {
         me.setValue('g-' + Gm.uniqId() + ':');
    }
});
