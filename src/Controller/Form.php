<?php
/**
 * Этот файл является частью расширения модуля веб-приложения GearMagic.
 * 
 * @link https://gearmagic.ru
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

namespace Gm\Backend\References\Properties\Controller;

use Gm\Mvc\Module\BaseModule;
use Gm\Panel\Widget\EditWindow;
use Gm\Panel\Controller\FormController;

/**
 * Контроллер формы свойства элемента интерфейса.
 * 
 * @author Anton Tivonenko <anton.tivonenko@gmail.com>
 * @package Gm\Backend\References\Properties\Controller
 * @since 1.0
 */
class Form extends FormController
{
    /**
     * {@inheritdoc}
     * 
     * @var BaseModule|\Gm\Backend\References\Properties\Extension
     */
    public BaseModule $module;

    /**
     * {@inheritdoc}
     */
    public function createWidget(): EditWindow
    {
        /** @var EditWindow $window */
        $window = parent::createWidget();

        // панель формы (Gm.view.form.Panel GmJS)
        $window->form->router->route = $this->module->route('/form');
        $window->form->loadJSONFile('/form', 'items');
        $window->form->bodyPadding = 10;
        $window->form->defaults = [
            'labelWidth' => 130,
            'labelAlign' => 'right',
            'allowBlank' => false, 
            'anchor'     => '100%'
        ];

        // окно компонента (Ext.window.Window Sencha ExtJS)
        $window->width = 470;
        $window->autoHeight = true;
        $window->resizable = false;
        return $window;
    }
}
