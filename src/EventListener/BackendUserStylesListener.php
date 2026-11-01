<?php

declare(strict_types=1);

namespace Fusion360\BackendClassicBundle\EventListener;

use Contao\BackendUser;
use Contao\CoreBundle\Routing\ScopeMatcher;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\RequestEvent;

/**
 * Adds the back end stylesheets for the look a user picked in their profile:
 * the Classic theme (the Contao 5.6 colours) and the filters above the list.
 */
#[AsEventListener]
class BackendUserStylesListener
{
    public function __construct(
        private readonly ScopeMatcher $scopeMatcher,
        private readonly Security $security,
    ) {
    }

    public function __invoke(RequestEvent $event): void
    {
        if (!$this->scopeMatcher->isBackendMainRequest($event)) {
            return;
        }

        $user = $this->security->getUser();

        if (!$user instanceof BackendUser) {
            return;
        }

        if ('classic' === $user->backendTheme) {
            $GLOBALS['TL_CSS'][] = 'bundles/fusion360backendclassic/classic.css';
        }

        if ($user->filtersOnTop) {
            $GLOBALS['TL_CSS'][] = 'bundles/fusion360backendclassic/filters-top.css';
        }
    }
}
