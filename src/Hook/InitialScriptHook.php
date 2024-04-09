<?php

namespace TagConcierge\GtmConsentModeBannerFree\Hook;

use Cookie as PrestaShopCookie;
use Configuration as PrestaShopConfiguration;
use TagConcierge\GtmConsentModeBannerFree\ValueObject\ConfigurationVO;

class InitialScriptHook extends AbstractHook
{
    use HookTrait;

    /** @var array */
    public const HOOKS = [
        Hooks::DISPLAY_HEADER => [
            'loadInitialScript',
        ],
    ];

    public function loadInitialScript(): string
    {
        if (false === $this->isEnabled()) {
            return '';
        }

        $consentTypes = $this->getConsentTypes();

        $consentTypes = array_reduce($consentTypes, static function($agg, $type) {
            if ('' === $type['name']) {
                return $agg;
            }

            if ('' !== $type['additional_consent_types']) {
                foreach (explode(',', $type['additional_consent_types']) as $key) {
                    $agg[$key] = $type['default'] === 'required' ? 'granted' : $type['default'];
                }
            }
            $agg[$type['name']] = $type['default'] === 'required' ? 'granted' : $type['default'];
            return $agg;
        }, []);

        $this->getContext()->smarty->assign('tc_gtmcb_consent_type', $consentTypes);

        return $this->module->render('hooks/initial_script/initial_script.tpl');
    }

    protected function getConsentTypes(): array
    {
        return ConfigurationVO::getConsentTypes();
    }
}
