<?php

namespace TagConcierge\GtmConsentModeBannerFree\Install;

interface TagConciergeModuleInterface
{
    public function render(string $templatePath): string;

    public function getHooks(): array;
}
