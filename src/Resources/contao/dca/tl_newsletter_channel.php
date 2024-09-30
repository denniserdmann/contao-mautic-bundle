<?php

use Contao\CoreBundle\DataContainer\PaletteManipulator;

PaletteManipulator::create()
    ->addLegend('mautic_legend', 'template_legend', PaletteManipulator::POSITION_BEFORE)
    ->addField('mautic_add_to_segment', 'mautic_legend', PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('default', 'tl_newsletter_channel')
;

$GLOBALS['TL_DCA']['tl_newsletter_channel']['palettes']['__selector__'][] = 'mautic_add_to_segment';
$GLOBALS['TL_DCA']['tl_newsletter_channel']['subpalettes']['mautic_add_to_segment'] = 'mautic_segment';


$GLOBALS['TL_DCA']['tl_newsletter_channel']['fields']['mautic_add_to_segment'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['mautic_add_to_segment'],
    'inputType' => 'checkbox',
    'eval' => [
        'tl_class' => 'clr',
        'submitOnChange' => true
    ],
    'exclude' => true,
    'sql' => "char(1) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_newsletter_channel']['fields']['mautic_segment'] = [
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