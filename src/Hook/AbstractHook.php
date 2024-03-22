<?php

namespace TagConcierge\GtmConsentModeBannerFree\Hook;

use Context as PrestaShopContext;
use TagConcierge\GtmConsentModeBannerFree\Install\TagConciergeModuleInterface;

abstract class AbstractHook
{
    public const HOOKS = [];

    /** @var TagConciergeModuleInterface */
    protected $module;

    public function __construct(TagConciergeModuleInterface $module)
    {
        $this->module = $module;
    }

    public function getHooks(): array
    {
        return static::HOOKS;
    }

    protected function getContext(): PrestaShopContext
    {
        return PrestaShopContext::getContext();
    }
}
