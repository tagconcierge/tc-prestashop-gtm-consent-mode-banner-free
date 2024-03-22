<?php

namespace TagConcierge\GtmConsentModeBannerFree\Install;

class InstallerFactory
{
    public static function create(): Installer
    {
        return new Installer();
    }
}
