<?php
/**
 * Этот файл является частью расширения модуля веб-приложения GearMagic.
 * 
 * @link https://gearmagic.ru
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

namespace Gm\Backend\References\Properties\Controller;

use Gm;
use Gm\Mvc\Module\BaseModule;
use Gm\Panel\Widget\TabGrid;
use Gm\Panel\Helper\ExtGrid;
use Gm\Panel\Helper\HtmlGrid;
use Gm\Panel\Controller\GridController;
use Gm\Panel\Helper\HtmlNavigator as HtmlNav;

/**
 *  Контроллер списка свойств элементов интерфейса.
 * 
 * @author Anton Tivonenko <anton.tivonenko@gmail.com>
 * @package Gm\Backend\References\Properties\Controller
 * @since 1.0
 */
class Grid extends GridController
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
    public function createWidget(): TabGrid
    {
        /** @var TabGrid $tab Сетка данных (Gm.view.grid.Grid GmJS) */
        $tab = parent::createWidget();

        // столбцы (Gm.view.grid.Grid.columns GmJS)
        $tab->grid->columns = [
            ExtGrid::columnNumberer(),
            ExtGrid::columnAction(),
            [
                'text'      => ExtGrid::columnInfoIcon($this->t('Name')),
                'dataIndex' => 'name',
                'cellTip'   => HtmlGrid::tags([
                    HtmlGrid::header('{name}'),
                    HtmlGrid::fieldLabel($this->module->t('Name') . ' (' . Gm::$app->language->name . ')', '{nameLo}'),
                    HtmlGrid::fieldLabel($this->t('Type'), '{type}'),
                    HtmlGrid::fieldLabel($this->t('Property'), '{property}'),
                ]),
                'filter'    => ['type' => 'string'],
                'sortable'  => true,
                'width'     => 250
            ],
            [
                'text'      => $this->module->t('Name') . ' (' . Gm::$app->language->name . ')',
                'dataIndex' => 'nameLo',
                'cellTip'   => '{nameLo}',
                'sortable'  => false,
                'width'     => 270
            ],
            [
                'text'      => '#Type',
                'dataIndex' => 'type',
                'cellTip'   => '{type}',
                'filter'    => ['type' => 'string'],
                'sortable'  => true,
                'width'     => 120
            ],
            [
                'text'      => '#Property',
                'dataIndex' => 'property',
                'cellTip'   => '{property}',
                'filter'    => ['type' => 'string'],
                'sortable'  => true,
                'width'     => 180
            ],
            [
                'text'      => '#Editor',
                'tooltip'   => '#Property editor',
                'dataIndex' => 'editor',
                'cellTip'   => '{editor}',
                'filter'    => ['type' => 'string'],
                'sortable'  => true,
                'width'     => 180
            ]
        ];

        // панель инструментов (Gm.view.grid.Grid.tbar GmJS)
        $tab->grid->tbar = [
            'padding' => 1,
            'items'   => ExtGrid::buttonGroups([
                'edit' => [
                    'items' => [
                        // инструмент "Добавить"
                        'add' => [
                            'caching' => false
                        ],
                        'delete',
                        'cleanup',
                        '-',
                        'edit',
                        'select',
                        '-',
                        'refresh'
                    ]
                ],
                'columns',
                'search'
            ], [
                'route' =>  Gm::alias('@route')
            ])
        ];

        // контекстное меню записи (Gm.view.grid.Grid.popupMenu GmJS)
        $tab->grid->popupMenu = [
            'items' => [
                [
                    'text'    => '#Edit record',
                    'iconCls' => 'g-icon-svg g-icon-m_edit g-icon-m_color_default',
                    'handler' => 'loadWidget',
                    'handlerArgs' => [
                        'route'   => $this->module->route('/form/view/{id}'),
                        'pattern' => 'grid.popupMenu.activeRecord'
                    ]
                ]
            ]
        ];

        // 2-й клик по строке сетки
        $tab->grid->rowDblClickConfig = [
            'allow' => true,
            'route' => $this->module->route('/form/view/{id}')
        ];
        // количество строк в сетке
        $tab->grid->store->pageSize = 50;
        // поле аудита записи
        $tab->grid->logField = 'name';
        // плагины сетки
        $tab->grid->plugins = 'gridfilters';
        // класс CSS применяемый к элементу body сетки
        $tab->grid->bodyCls = 'g-grid_background';

        // панель навигации (Gm.view.navigator.Info GmJS)
        $tab->navigator->info['tpl'] = HtmlNav::tags([
            HtmlNav::header('{nameLo}'),
            HtmlNav::fieldLabel($this->t('Name'), '{name}'),
            HtmlNav::fieldLabel($this->t('Property'), '{property}'),
            HtmlNav::fieldLabel($this->t('Type'), '{type}'),
            HtmlNav::fieldLabel($this->t('Editor'), '{editor}'),
            HtmlNav::widgetButton(
                $this->t('Edit record'),
                ['route' => $this->module->route('/form/view/{id}'), 'long' => true],
                ['title' => $this->t('Edit record')]
            )
        ]);

        $tab
            ->addCss('/grid.css');
        return $tab;
    }
}
