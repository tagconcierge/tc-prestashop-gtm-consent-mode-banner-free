<?php

namespace TagConcierge\GtmConsentModeBannerFree\Hook;

use Configuration as PrestaShopConfiguration;
use TagConcierge\GtmConsentModeBannerFree\ValueObject\ConfigurationVO;

class CustomCssHook extends AbstractHook
{
    use HookTrait;

    /** @var array */
    const HOOKS = [
        Hooks::DISPLAY_HEADER => [
            'loadCss',
        ],
    ];

    /**
     * @return string
     */
    public function loadCss()
    {
        if (false === $this->isEnabled()) {
            return '';
        }

        $customCss = PrestaShopConfiguration::get(ConfigurationVO::CUSTOM_CSS);

        $this->getContext()->smarty->assign('tc_gtmcb_custom_css', $customCss);

        return $this->module->render('hooks/custom_css/css.tpl');
    }
}
