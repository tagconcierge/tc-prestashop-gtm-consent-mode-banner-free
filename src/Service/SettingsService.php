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

        return $consentTypes;
    }

    /**
     * @return array[]
     */
    public function getConsentTypesFields()
    {
        return $this->getConsentTypes();
    }
}
