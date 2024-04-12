<?php

namespace TagConcierge\GtmConsentModeBannerFree\Install;

use Configuration as PrestaShopConfiguration;
use DateTime;
use TagConcierge\GtmConsentModeBannerFree\ValueObject\ConfigurationVO;

class Installer
{
    public function install(TagConciergeModuleInterface $module): bool
    {
        foreach (ConfigurationVO::getFields() as $key => $value) {
            $defaultValue = ConfigurationVO::getDefaultValue($key);

            if (null !== $defaultValue) {
                if (true === is_array($defaultValue)) {
                    $defaultValue = json_encode($defaultValue);
                }
                PrestaShopConfiguration::updateValue($key, $defaultValue);
                continue;
            }

            $boolean = $value['boolean'] ?? false;
            PrestaShopConfiguration::updateValue($key, $boolean ? false : '');
        }

        if (false === PrestaShopConfiguration::get(ConfigurationVO::INSTALLATION_DATE)) {
            PrestaShopConfiguration::updateValue(ConfigurationVO::INSTALLATION_DATE, (new DateTime())->getTimestamp());
        }

        return $this->registerHooks($module);
    }

    public function uninstall(TagConciergeModuleInterface $module): bool
    {
        foreach (array_keys(ConfigurationVO::getFields()) as $key) {
            if (ConfigurationVO::INSTALLATION_DATE === $key) {
                continue;
            }
            PrestaShopConfiguration::deleteByName($key);
        }

        return true;
    }

    private function registerHooks(TagConciergeModuleInterface $module): bool
    {
        foreach ($module->getHooks() as $hook) {
            if (false === $module->registerHook($hook)) {
                return false;
            }
        }

        return true;
    }
}
