<?php

namespace TagConcierge\GtmConsentModeBannerFree\Hook;

use Cookie as PrestaShopCookie;
use Configuration as PrestaShopConfiguration;
use TagConcierge\GtmConsentModeBannerFree\ValueObject\ConfigurationVO;

class GtmHook extends AbstractHook
{
    /** @var array */
    public const HOOKS = [
        Hooks::DISPLAY_HEADER => [
            'loadGtmScript',
        ],
        Hooks::DISPLAY_AFTER_BODY_OPENING_TAG => [
            'loadGtmFrame',
        ],
    ];

    public function loadGtmScript(): string
    {
        if (false === $this->isEnabled()) {
            return '';
        }

        return PrestaShopConfiguration::get(ConfigurationVO::GTM_CONTAINER_SNIPPET_HEAD);
    }

    public function loadGtmFrame(): string
    {
        if (false === $this->isEnabled()) {
            return '';
        }

        return PrestaShopConfiguration::get(ConfigurationVO::GTM_CONTAINER_SNIPPET_BODY);
    }

    protected function isEnabled(): bool
    {
        $isEnabledOnlyForAdmins = (bool) PrestaShopConfiguration::get(ConfigurationVO::ENABLED_ONLY_FOR_ADMIN);

        if (false === $isEnabledOnlyForAdmins) {
            return true;
        }

        $cookie = new PrestaShopCookie('psAdmin');

        return false !== $cookie->id_employee;
    }
}
