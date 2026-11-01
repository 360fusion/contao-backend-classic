<?php

use Contao\Backend;
use Contao\CoreBundle\DataContainer\PaletteManipulator;

// "classic" has no folder in system/themes, so Backend::getTheme() keeps "flexible" as the base and
// Fusion360\BackendClassicBundle\EventListener\BackendUserStylesListener adds the Classic colours on top
$GLOBALS['TL_DCA']['tl_user']['fields']['backendTheme']['options_callback'] = static fn () => Backend::getThemes() + ['classic' => 'Classic'];

$GLOBALS['TL_DCA']['tl_user']['fields']['filtersOnTop'] = [
    'inputType' => 'checkbox',
    'eval' => ['tl_class' => 'w50'],
    'sql' => ['type' => 'boolean', 'default' => false],
];

$manipulator = PaletteManipulator::create()->addField('filtersOnTop', 'backendWidth', PaletteManipulator::POSITION_AFTER);

foreach (['login', 'admin', 'default', 'group', 'extend', 'custom'] as $palette) {
    $manipulator->applyToPalette($palette, 'tl_user');
}
