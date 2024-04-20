<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

/**
 * @param GtmConsentModeBannerFree $module
 * @return bool
 */
function upgradeModule103(GtmConsentModeBannerFree $module)
{
    return $module->resetHooks();
}
