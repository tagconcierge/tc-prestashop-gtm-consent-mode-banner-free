<?php

namespace TagConcierge\GtmConsentModeBannerFree\Hook;

use Configuration as PrestaShopConfiguration;
use TagConcierge\GtmConsentModeBannerFree\ValueObject\ConfigurationVO;

class BannerScriptHook extends AbstractHook
{
    use HookTrait;

    /** @var array */
    const HOOKS = [
        Hooks::DISPLAY_BEFORE_BODY_CLOSING_TAG => [
            'beforeBodyClosingTag',
        ],
        Hooks::DISPLAY_FOOTER => [
            'displayFooter',
        ],
    ];

    /**
     * @return string
     */
    public function beforeBodyClosingTag()
    {
        if (1.7 > _PS_VERSION_) {
            return '';
        }

        return $this->loadBannerScript();
    }

    /**
     * @return string
     */
    public function displayFooter()
    {
        if (1.7 <= _PS_VERSION_) {
            return '';
        }

        return $this->loadBannerScript();
    }

    /**
     * @return string
     */
    public function loadBannerScript()
    {
        if (false === $this->isEnabled()) {
            return '';
        }

        $config = $this->module->getSettingsService()->getBannerConfig();

        $config = $this->filterConfig($config);

        $this->getContext()->smarty->assign('tc_gtmcb_config', $config);
        $this->getContext()->smarty->assign('tc_gtmcb_cookie_removal_on_denial', PrestaShopConfiguration::get(ConfigurationVO::COOKIE_REMOVAL_ON_DENIAL));

        return $this->module->render('hooks/banner_script/banner_script.tpl');
    }

    protected function filterConfig(array $config)
    {
        return $config;
    }
}
