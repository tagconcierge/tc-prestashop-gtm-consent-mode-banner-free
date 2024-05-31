<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

/**
 * @param GtmConsentModeBannerFree $module
 *
 * @return bool
 */
function upgradeModule110(GtmConsentModeBannerFree $module)
{
    return $module->resetHooks();
}
