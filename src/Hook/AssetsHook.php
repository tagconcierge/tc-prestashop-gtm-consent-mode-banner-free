<?php

namespace TagConcierge\GtmConsentModeBannerFree\Hook;

class AssetsHook extends AbstractHook
{
    use HookTrait;

    /** @var array */
    const HOOKS = [
        Hooks::ACTION_FRONT_CONTROLLER_SET_MEDIA => [
            'loadAssets',
        ],
    ];

    /**
     * @return void
     */
    public function loadAssets()
    {
        if (false === $this->isEnabled()) {
            return;
        }

        $controller = $this->getContext()->controller;
        $scriptUrl = 'https://public-assets.tagconcierge.com/consent-banner/1.1.0/cb.min.js';
        $styleUrl = 'https://public-assets.tagconcierge.com/consent-banner/1.1.0/styles/light.css';

        if (method_exists($controller, 'registerJavascript')) {
            $controller->registerJavascript(
                'tag-concierge-consent-mode-banner',
                $scriptUrl,
                ['server' => 'remote', 'position' => 'head', 'priority' => 20]
            );
        } else {
            $controller->addJS($scriptUrl);
        }

        if (method_exists($controller, 'registerJavascript')) {
            $controller->registerStylesheet(
                'tag-concierge-consent-mode-banner',
                $styleUrl,
                ['server' => 'remote', 'position' => 'head', 'priority' => 20]
            );
        } else {
            $controller->addCSS($styleUrl);
        }
    }
}
