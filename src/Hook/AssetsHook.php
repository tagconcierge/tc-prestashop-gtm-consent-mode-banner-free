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

    /** @var string */
    protected $scriptUrl = 'https://public-assets.tagconcierge.com/consent-banner/1.1.0/cb.min.js';

    /** @var string */
    protected $styleUrl = 'https://public-assets.tagconcierge.com/consent-banner/1.1.0/styles/light.css';

    /** @var string */
    protected $origin = 'remote';

    /**
     * @return void
     */
    public function loadAssets()
    {
        if (false === $this->isEnabled()) {
            return;
        }

        $controller = $this->getContext()->controller;

        if (method_exists($controller, 'registerJavascript')) {
            $controller->registerJavascript(
                'tag-concierge-consent-mode-banner',
                $this->scriptUrl,
                ['server' => $this->origin, 'position' => 'head', 'priority' => 20]
            );
        } else {
            $controller->addJS($this->scriptUrl);
        }

        if (method_exists($controller, 'registerJavascript')) {
            $controller->registerStylesheet(
                'tag-concierge-consent-mode-banner',
                $this->styleUrl,
                ['server' => $this->origin, 'position' => 'head', 'priority' => 20]
            );
        } else {
            $controller->addCSS($this->styleUrl);
        }
    }
}
