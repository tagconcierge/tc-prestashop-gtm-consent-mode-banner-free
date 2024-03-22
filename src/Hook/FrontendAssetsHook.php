<?php

namespace TagConcierge\GtmConsentModeBannerFree\Hook;

use Cookie as PrestaShopCookie;
use Configuration as PrestaShopConfiguration;
use TagConcierge\GtmConsentModeBannerFree\ValueObject\ConfigurationVO;

class FrontendAssetsHook extends AbstractHook
{
    /** @var array */
    public const HOOKS = [
        Hooks::DISPLAY_HEADER => [
            'loadInitialScript',
            'loadGtmScript',
            'loadCss',
        ],
        Hooks::DISPLAY_AFTER_BODY_OPENING_TAG => [
            'loadGtmFrame',
        ],
        Hooks::DISPLAY_BEFORE_BODY_CLOSING_TAG => [
            'loadBannerScript',
        ],
    ];

    public function loadInitialScript(): string
    {
        if (false === $this->isEnabled()) {
            return '';
        }

        $consentTypes = ConfigurationVO::getConsentTypes();

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

        return $this->module->render('hooks/frontend_assets/initial_script.tpl');
    }

    public function loadGtmScript(): string
    {
        if (false === $this->isEnabled()) {
            return '';
        }

        return PrestaShopConfiguration::get(ConfigurationVO::GTM_CONTAINER_SNIPPET_HEAD);
    }

    public function loadGtmFrame(): string
    {
        if (false === $this->isEnabled()) {
            return '';
        }

        return PrestaShopConfiguration::get(ConfigurationVO::GTM_CONTAINER_SNIPPET_BODY);
    }

    public function loadCss(): string
    {
        if (false === $this->isEnabled()) {
            return '';
        }

        $customCss = PrestaShopConfiguration::get(ConfigurationVO::CUSTOM_CSS);

        $this->getContext()->smarty->assign('tc_gtmcb_custom_css', $customCss);

        return $this->module->render('hooks/frontend_assets/css.tpl');
    }

    public function loadBannerScript(): string
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

        $consentTypes = ConfigurationVO::getConsentTypes();

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

        return $this->module->render('hooks/frontend_assets/banner_script.tpl');
    }

    private function isEnabled(): bool
    {
        $isEnabledOnlyForAdmins = (bool) PrestaShopConfiguration::get(ConfigurationVO::ENABLED_ONLY_FOR_ADMIN);

        if (false === $isEnabledOnlyForAdmins) {
            return true;
        }

        $cookie = new PrestaShopCookie('psAdmin');

        return false !== $cookie->id_employee;
    }
}
