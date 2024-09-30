<?php

use Contao\CoreBundle\DataContainer\PaletteManipulator;

PaletteManipulator::create()
    ->addLegend('mautic_legend', 'template_legend', PaletteManipulator::POSITION_BEFORE)
    ->addField('use_mautic', 'mautic_legend', PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('registration', 'tl_module')
    ->applyToPalette('closeAccount', 'tl_module')
;


$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'use_mautic';
$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'mautic_create_contact';
$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'mautic_add_to_segment';

$GLOBALS['TL_DCA']['tl_module']['subpalettes']['use_mautic'] = 'mautic_create_contact';
$GLOBALS['TL_DCA']['tl_module']['subpalettes']['mautic_add_to_segment'] = 'mautic_segment';
$GLOBALS['TL_DCA']['tl_module']['subpalettes']['mautic_create_contact'] = 'mautic_add_to_segment';

$GLOBALS['TL_DCA']['tl_module']['fields']['use_mautic'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['use_mautic'],
    'inputType' => 'checkbox',
    'eval' => [
        'tl_class' => 'clr',
        'submitOnChange' => true
    ],
    'exclude' => true,
    'sql' => "char(1) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_module']['fields']['mautic_create_contact'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['mautic_create_contact'],
    'inputType' => 'checkbox',
    'eval' => [
        'tl_class' => 'clr',
        'submitOnChange' => true
    ],
    'exclude' => true,
    'sql' => "char(1) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_module']['fields']['mautic_add_to_segment'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['mautic_add_to_segment'],
    'inputType' => 'checkbox',
    'eval' => [
        'tl_class' => 'clr',
        'submitOnChange' => true
    ],
    'exclude' => true,
    'sql' => "char(1) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_module']['fields']['mautic_segment'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['mautic_segment'],
    'inputType' => 'select',
    'eval' => [
        'chosen' => true,
        'mandatory' => true,
        'tl_class' => 'w50',
        'includeBlankOption' => true
    ],
    'options_callback' => [ 'mautic.datacontainer.options', 'getSegments' ],
    'exclude' => true,
    'sql' => "varchar(255) NOT NULL default ''"
];