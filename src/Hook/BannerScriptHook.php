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
            'loadBannerScript',
        ],
        Hooks::DISPLAY_FOOTER => [
            'loadBannerScript'
        ]
    ];

    /**
     * @return string
     */
    public function loadBannerScript()
    {
        if (false === $this->isEnabled()) {
            return '';
        }

        $settings = array_reduce([
            ConfigurationVO::DISPLAY_MODE,
            ConfigurationVO::WALL,
            ConfigurationVO::MAIN_MODAL_TITLE,
            ConfigurationVO::MAIN_MODAL_CONTENT,
            ConfigurationVO::MAIN_MODAL_ACCEPT_BUTTON,
            ConfigurationVO::MAIN_MODAL_OPEN_SETTINGS_BUTTON,
            ConfigurationVO::MAIN_MODAL_REJECT_BUTTON,
            ConfigurationVO::SETTINGS_MODAL_TITLE,
            ConfigurationVO::SETTINGS_MODAL_CONTENT,
            ConfigurationVO::SETTINGS_MODAL_SAVE_BUTTON,
            ConfigurationVO::SETTINGS_MODAL_CLOSE_BUTTON,
            ConfigurationVO::SETTINGS_MODAL_REJECT_BUTTON,
            ConfigurationVO::SETTINGS_MODAL_ACCEPT_BUTTON,
        ], static function($agg, $setName) {
            $agg[$setName] = PrestaShopConfiguration::get($setName);
            return $agg;
        }, []);

        $consentTypes = $this->module->getSettingsService()->getConsentTypes();

        $config = [
            'display' => [
                'mode' => $settings[ConfigurationVO::DISPLAY_MODE],
                'wall' => (bool) $settings[ConfigurationVO::WALL],
            ],
            'consent_types' => array_values($consentTypes),
            'modal' => [
                'title' => $settings[ConfigurationVO::MAIN_MODAL_TITLE],
                'description' => nl2br($settings[ConfigurationVO::MAIN_MODAL_CONTENT]),
                'buttons' => [
                    'accept' => $settings[ConfigurationVO::MAIN_MODAL_ACCEPT_BUTTON],
                    'settings' => $settings[ConfigurationVO::MAIN_MODAL_OPEN_SETTINGS_BUTTON],
                    'reject' => $settings[ConfigurationVO::MAIN_MODAL_REJECT_BUTTON]
                ]
            ],
            'settings' => [
                'title' => $settings[ConfigurationVO::SETTINGS_MODAL_TITLE],
                'description' => nl2br($settings[ConfigurationVO::SETTINGS_MODAL_CONTENT]),
                'buttons' => [
                    'save' => $settings[ConfigurationVO::SETTINGS_MODAL_SAVE_BUTTON],
                    'close' => $settings[ConfigurationVO::SETTINGS_MODAL_CLOSE_BUTTON],
                    'reject' => $settings[ConfigurationVO::SETTINGS_MODAL_REJECT_BUTTON],
                    'accept' => $settings[ConfigurationVO::SETTINGS_MODAL_ACCEPT_BUTTON]
                ]
            ]
        ];

        $this->getContext()->smarty->assign('tc_gtmcb_config', $config);

        return $this->module->render('hooks/banner_script/banner_script.tpl');
    }
}
