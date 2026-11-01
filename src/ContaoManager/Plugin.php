<?php

declare(strict_types=1);

namespace Fusion360\BackendClassicBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Fusion360\BackendClassicBundle\Fusion360BackendClassicBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(Fusion360BackendClassicBundle::class)->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
