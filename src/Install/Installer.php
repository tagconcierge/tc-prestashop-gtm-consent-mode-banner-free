<?php

namespace TagConcierge\GtmConsentModeBannerFree\Install;

use Configuration as PrestaShopConfiguration;
use DateTime;
use TagConcierge\GtmConsentModeBannerFree\ValueObject\ConfigurationVO;

class Installer
{
    /**
     * @param TagConciergeModuleInterface $module
     * @return bool
     */
    public function install(TagConciergeModuleInterface $module)
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

            $boolean = isset($value['boolean']) ? $value['boolean'] : false;
            PrestaShopConfiguration::updateValue($key, $boolean ? false : '');
        }

        if (false === PrestaShopConfiguration::get(ConfigurationVO::INSTALLATION_DATE)) {
            PrestaShopConfiguration::updateValue(ConfigurationVO::INSTALLATION_DATE, (new DateTime())->getTimestamp());
        }

        return $this->registerHooks($module);
    }

    /**
     * @param TagConciergeModuleInterface $module
     * @return bool
     */
    public function uninstall(TagConciergeModuleInterface $module)
    {
        foreach (array_keys(ConfigurationVO::getFields()) as $key) {
            if (ConfigurationVO::INSTALLATION_DATE === $key) {
                continue;
            }
            PrestaShopConfiguration::deleteByName($key);
        }

        return true;
    }

    /**
     * @param TagConciergeModuleInterface $module
     * @return bool
     */
    public function resetHooks(TagConciergeModuleInterface $module)
    {
        return $this->unregisterHooks($module) && $this->registerHooks($module);
    }

    /**
     * @param TagConciergeModuleInterface $module
     * @return bool
     */
    private function registerHooks(TagConciergeModuleInterface $module)
    {
        foreach ($module->getHooks() as $hook) {
            if (false === $module->registerHook($hook)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param TagConciergeModuleInterface $module
     * @return bool
     */
    private function unregisterHooks(TagConciergeModuleInterface $module)
    {
        foreach ($module->getHooks() as $hook) {
            $module->unregisterHook($hook);
        }

        return true;
    }
}
