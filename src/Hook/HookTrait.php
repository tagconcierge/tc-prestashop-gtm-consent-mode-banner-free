<?php

namespace TagConcierge\GtmConsentModeBannerFree\Hook;

use Configuration as PrestaShopConfiguration;
use Cookie as PrestaShopCookie;
use TagConcierge\GtmConsentModeBannerFree\ValueObject\ConfigurationVO;

trait HookTrait
{
    /**
     * @return bool
     */
    protected function isEnabled()
    {
        $isEnabledOnlyForAdmins = (bool) PrestaShopConfiguration::get(ConfigurationVO::ENABLED_ONLY_FOR_ADMIN);

        if (false === $isEnabledOnlyForAdmins) {
            return true;
        }

        $cookie = new PrestaShopCookie('psAdmin');

        return false !== (bool) $cookie->id_employee;
    }
}
