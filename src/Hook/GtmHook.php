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
            'displayAfterBodyOpeningTag',
        ],
        Hooks::DISPLAY_BANNER => [
            'displayBanner',
        ],
    ];

    /**
     * @return string
     */
    public function displayAfterBodyOpeningTag()
    {
        if (1.7 > _PS_VERSION_) {
            return '';
        }

        return $this->loadGtmFrame();
    }

    /**
     * @return string
     */
    public function displayBanner()
    {
        if (1.7 <= _PS_VERSION_) {
            return '';
        }

        return $this->loadGtmFrame();
    }

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
