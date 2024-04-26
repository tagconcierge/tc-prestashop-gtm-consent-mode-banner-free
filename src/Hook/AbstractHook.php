<?php

namespace TagConcierge\GtmConsentModeBannerFree\Hook;

use Context as PrestaShopContext;
use TagConcierge\GtmConsentModeBannerFree\Install\TagConciergeModuleInterface;

abstract class AbstractHook
{
    const HOOKS = [];

    /** @var TagConciergeModuleInterface */
    protected $module;

    public function __construct(TagConciergeModuleInterface $module)
    {
        $this->module = $module;
    }

    /**
     * @return array
     */
    public function getHooks()
    {
        return static::HOOKS;
    }

    /**
     * @return PrestaShopContext
     */
    protected function getContext()
    {
        return PrestaShopContext::getContext();
    }
}
