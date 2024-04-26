<?php

namespace TagConcierge\GtmConsentModeBannerFree\Install;

class InstallerFactory
{
    /**
     * @return Installer
     */
    public static function create()
    {
        return new Installer();
    }
}
