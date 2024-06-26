<?php

namespace TagConcierge\GtmConsentModeBannerFree\Hook;

class InitialScriptHook extends AbstractHook
{
    use HookTrait;

    /** @var array */
    const HOOKS = [
        Hooks::DISPLAY_HEADER => [
            'loadInitialScript',
        ],
    ];

    /**
     * @return string
     */
    public function loadInitialScript()
    {
        if (false === $this->isEnabled()) {
            return '';
        }

        $consentTypes = $this->module->getSettingsService()->getConsentTypes();

        $consentTypes = array_reduce($consentTypes, static function ($agg, $type) {
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
}
