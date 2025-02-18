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
    '{name}'        => 'Свойства элементов интерфейса',
    '{description}' => 'Свойства элементов интерфейса Панели управления',
    '{permissions}' => [
        'any'  => ['Полный доступ', 'Просмотр и внесение изменений в свойства элементов'],
        'view' => ['Просмотр', 'Просмотр свойств элементов'],
        'read' => ['Чтение', 'Чтение свойств элементов']
    ],

    // Grid: контекстное меню записи
    'Edit record' => 'Редактировать',
    // Grid: столбцы
    'Name' => 'Название',
    'Property' => 'Свойство',
    'Type' => 'Тип значения',
    'Editor' => 'Редактор',
    'Property editor' => 'Редактор свойств',
    // типы значений
    'boolean' => 'Логический',
    'date' => 'Дата',
    'number' => 'Числовой',
    'string' => 'Строковый',
    'array' => 'Массив',
    'object' => 'Объект',

    // Form
    '{form.title}' => 'Добавление свойства элемента',
    '{form.titleTpl}' => 'Изменение свойства элемента "{name}"',
    // Form: поля
    'Editor options used by the "property grid" to change the value of a property' 
        => 'Параметры редактора, используемые "сеткой свойств" для изменения значения свойства'
];
