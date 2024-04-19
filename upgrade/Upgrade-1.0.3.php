<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

function upgradeModule103(GtmConsentModeBannerFree $module): bool
{
    return $module->resetHooks();
}
