<?php

namespace TagConcierge\GtmConsentModeBannerFree\Service;

use Configuration as PrestaShopConfiguration;
use TagConcierge\GtmConsentModeBannerFree\Install\TagConciergeModuleInterface;
use TagConcierge\GtmConsentModeBannerFree\ValueObject\ConfigurationVO;

class SettingsService
{
    private $module;

    public function __construct(TagConciergeModuleInterface $module)
    {
        $this->module = $module;
    }

    /**
     * @return array[]
     */
    public function getConsentTypes()
    {
        $defaultConsentTypes = [
            [
                'name' => '',
                'title' => '',
                'description' => '',
                'default' => '',
            ],
            [
                'name' => '',
                'title' => '',
                'description' => '',
                'default' => '',
            ],
            [
                'name' => '',
                'title' => '',
                'description' => '',
                'default' => '',
            ],
            [
                'name' => '',
                'title' => '',
                'description' => '',
                'default' => '',
            ],
            [
                'name' => '',
                'title' => '',
                'description' => '',
                'default' => '',
            ],
            [
                'name' => '',
                'title' => '',
                'description' => '',
                'default' => '',
            ]
        ];

        try {
            $consentTypes = json_decode(PrestaShopConfiguration::get(ConfigurationVO::CONSENT_TYPES), true);
        } catch (\Exception $e) {
            $consentTypes = $defaultConsentTypes;
        }

        if (false === is_array($consentTypes)) {
            $consentTypes = $defaultConsentTypes;
        }

        if (false === $this->module->isPro()) {
            $consentTypes = array_slice($consentTypes, 0, count(ConfigurationVO::getDefaultValue(ConfigurationVO::CONSENT_TYPES)));

            $consentTypes = array_replace_recursive($defaultConsentTypes, $consentTypes);

            foreach ($consentTypes as &$consentType) {
                $consentType['additional_consent_types'] = '';
            }
        }

        foreach ($consentTypes as &$consentType) {
            if (false === isset($consentType['additional_consent_types'])) {
                $consentType['additional_consent_types'] = '';
            }
        }

        return $consentTypes;
    }

    /**
     * @return array[]
     */
    public function getConsentTypesFields()
    {
        return $this->getConsentTypes();
    }

    public function postSettingsSave()
    {
        return;
    }

    public function getBannerConfig()
    {
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

        $consentTypes = array_filter($this->getConsentTypes(), static function ($item) {
            return false === empty($item['name']);
        });

        $consentTypes = array_values($consentTypes);

        return [
            'display' => [
                'mode' => $settings[ConfigurationVO::DISPLAY_MODE],
                'wall' => (bool) $settings[ConfigurationVO::WALL],
            ],
            'consent_types' => $consentTypes,
            'modal' => [
                'title' => $settings[ConfigurationVO::MAIN_MODAL_TITLE],
                'description' => str_replace(["\r", "\n"], '', nl2br($settings[ConfigurationVO::MAIN_MODAL_CONTENT])),
                'buttons' => [
                    'accept' => $settings[ConfigurationVO::MAIN_MODAL_ACCEPT_BUTTON],
                    'settings' => $settings[ConfigurationVO::MAIN_MODAL_OPEN_SETTINGS_BUTTON],
                    'reject' => $settings[ConfigurationVO::MAIN_MODAL_REJECT_BUTTON]
                ]
            ],
            'settings' => [
                'title' => $settings[ConfigurationVO::SETTINGS_MODAL_TITLE],
                'description' => str_replace(["\r", "\n"], '', nl2br($settings[ConfigurationVO::SETTINGS_MODAL_CONTENT])),
                'buttons' => [
                    'save' => $settings[ConfigurationVO::SETTINGS_MODAL_SAVE_BUTTON],
                    'close' => $settings[ConfigurationVO::SETTINGS_MODAL_CLOSE_BUTTON],
                    'reject' => $settings[ConfigurationVO::SETTINGS_MODAL_REJECT_BUTTON],
                    'accept' => $settings[ConfigurationVO::SETTINGS_MODAL_ACCEPT_BUTTON]
                ]
            ]
        ];
    }
}
