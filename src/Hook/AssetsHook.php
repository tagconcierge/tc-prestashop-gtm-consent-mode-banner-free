<?php

namespace TagConcierge\GtmConsentModeBannerFree\Hook;

use Cookie as PrestaShopCookie;
use Configuration as PrestaShopConfiguration;
use TagConcierge\GtmConsentModeBannerFree\ValueObject\ConfigurationVO;

class AssetsHook extends AbstractHook
{
    use HookTrait;

    /** @var array */
    public const HOOKS = [
        Hooks::ACTION_FRONT_CONTROLLER_SET_MEDIA => [
            'loadAssets',
        ],
    ];

    public function loadAssets(): void
    {
        if (false === $this->isEnabled()) {
            return;
        }

        $this->getContext()->controller->registerJavascript(
            'tag-concierge-consent-mode-banner',
            'https://public-assets.tagconcierge.com/cookies-banner-js/1.0.0/consent-banner.min.js',
            ['server' => 'remote', 'position' => 'head', 'priority' => 20]
        );

        $this->getContext()->controller->registerStylesheet(
            'tag-concierge-consent-mode-banner',
            'https://public-assets.tagconcierge.com/cookies-banner-js/1.0.0/styles/light.css',
            ['server' => 'remote', 'position' => 'head', 'priority' => 20]
        );
    }
}
