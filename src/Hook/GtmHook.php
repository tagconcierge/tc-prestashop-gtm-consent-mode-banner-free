<?php

namespace TagConcierge\GtmConsentModeBannerFree\Hook;

use Configuration as PrestaShopConfiguration;
use TagConcierge\GtmConsentModeBannerFree\ValueObject\ConfigurationVO;

class GtmHook extends AbstractHook
{
    use HookTrait;

    /** @var array */
    const HOOKS = [
        Hooks::DISPLAY_HEADER => [
            'loadGtmScript',
        ],
        Hooks::DISPLAY_AFTER_BODY_OPENING_TAG => [
            'loadGtmFrame',
        ],
        Hooks::DISPLAY_BANNER => [
            'loadGtmFrame',
        ],
    ];

    /**
     * @return string
     */
    public function loadGtmScript()
    {
        if (false === $this->isEnabled()) {
            return '';
        }

        return PrestaShopConfiguration::get(ConfigurationVO::GTM_CONTAINER_SNIPPET_HEAD);
    }

    /**
     * @return string
     */
    public function loadGtmFrame()
    {
        if (false === $this->isEnabled()) {
            return '';
        }

        return PrestaShopConfiguration::get(ConfigurationVO::GTM_CONTAINER_SNIPPET_BODY);
    }
}
