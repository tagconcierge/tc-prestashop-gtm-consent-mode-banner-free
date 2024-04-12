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

    public function getConsentTypes(): array
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
        ];

        try {
            $consentTypes = json_decode(PrestaShopConfiguration::get(ConfigurationVO::CONSENT_TYPES), true);
        } catch (\Throwable $e) {
            $consentTypes = $defaultConsentTypes;
        }

        if (false === is_array($consentTypes)) {
            $consentTypes = $defaultConsentTypes;
        }

        if (false === $this->module->isPro()) {
            $consentTypes = array_slice($consentTypes, 0, 4);

            foreach ($consentTypes as &$consentType) {
                $consentType['additional_consent_types'] = '';
            }
        }

        return $consentTypes;
    }

    public function getConsentTypesFields(): array
    {
        return $this->getConsentTypes();
    }
}
