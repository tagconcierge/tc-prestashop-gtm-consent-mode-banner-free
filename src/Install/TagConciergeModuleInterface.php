<?php

namespace TagConcierge\GtmConsentModeBannerFree\Install;

use TagConcierge\GtmConsentModeBannerFree\Service\SettingsService;

interface TagConciergeModuleInterface
{
    /**
     * @param string $templatePath
     * @return string
     */
    public function render($templatePath);

    /**
     * @return array
     */
    public function getHooks();

    /**
     * @return bool
     */
    public function isPro();

    /**
     * @return SettingsService
     */
    public function getSettingsService();

    /**
     * @return string
     */
    public function getNotificationKey();

    /**
     * @return string
     */
    public function getName();
}
