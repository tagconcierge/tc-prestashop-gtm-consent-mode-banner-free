<?php

namespace TagConcierge\GtmConsentModeBannerFree\Install;

use TagConcierge\GtmConsentModeBannerFree\Service\SettingsService;

interface TagConciergeModuleInterface
{
    public function render(string $templatePath): string;

    public function getHooks(): array;

    public function isPro(): bool;

    public function getSettingsService(): SettingsService;

    public function getNotificationKey(): string;

    public function getName(): string;
}
