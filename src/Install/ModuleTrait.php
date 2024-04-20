<?php

namespace TagConcierge\GtmConsentModeBannerFree\Install;

use Configuration as PrestaShopConfiguration;
use TagConcierge\GtmConsentModeBannerFree\Service\SettingsService;
use TagConcierge\GtmConsentModeBannerFree\ValueObject\ConfigurationVO;
use TagConcierge\GtmConsentModeBannerFree\Hook\HookProvider;
use Tools as PrestaShopTools;

trait ModuleTrait
{
    /** @var array */
    private $hooks;

    /**
     * @var HookProvider
     */
    private $hookProvider;

    /**
     * @var SettingsService
     */
    private $settingsService;

    /**
     * @return void
     */
    private function init()
    {
        @define('TC_GTMCMB_VERSION', $this->version);

        $this->hookProvider = new HookProvider($this);
        $this->settingsService = new SettingsService($this);
        $this->setupHooks();
    }

    /**
     * @return bool
     */
    public function install()
    {
        if (false === parent::install()) {
            return false;
        }

        $installer = InstallerFactory::create();

        return $installer->install($this);
    }

    /**
     * @return bool
     */
    public function uninstall()
    {
        if (false === parent::uninstall()) {
            return false;
        }

        $installer = InstallerFactory::create();

        return $installer->uninstall($this);
    }

    /**
     * @return bool
     */
    public function resetHooks()
    {
        $installer = InstallerFactory::create();

        return $installer->resetHooks($this);
    }

    /**
     * @return string
     */
    public function getContent()
    {
        $this->context->smarty->assign('module_dir', $this->_path);
        $this->context->smarty->assign('plugin_version', $this->version);

        $output = false === $this->isPro() ? $this->getInfoBox() : '';

        if (PrestaShopTools::isSubmit('tc_gtmcmb_submit_consent_types')) {
            PrestaShopConfiguration::updateValue(
                ConfigurationVO::CONSENT_TYPES,
                json_encode(PrestaShopTools::getValue(ConfigurationVO::CONSENT_TYPES)),
                ConfigurationVO::isHtmlField(ConfigurationVO::CONSENT_TYPES)
            );
        }

        foreach (array_keys(ConfigurationVO::getForms()) as $formName) {
            if (PrestaShopTools::isSubmit('tc_gtmcmb_submit_'.$formName)) {
                // get actual value of PS_USE_HTMLPURIFIER
                $usePurifier = PrestaShopConfiguration::get('PS_USE_HTMLPURIFIER');
                // disable it to allow store gtm snippets in configuration
                PrestaShopConfiguration::updateValue('PS_USE_HTMLPURIFIER', 0);

                foreach (array_keys(ConfigurationVO::getFormFields($formName)) as $key) {
                    PrestaShopConfiguration::updateValue(
                        $key,
                        PrestaShopTools::getValue($key),
                        ConfigurationVO::isHtmlField($key)
                    );
                }

                $output .= $this->displayConfirmation('Settings updated.');
                // restore original value of PS_USE_HTMLPURIFIER
                PrestaShopConfiguration::updateValue('PS_USE_HTMLPURIFIER', $usePurifier);
            }
        }

        foreach (ConfigurationVO::getForms() as $formName => $formDetails) {
            $helper = new \HelperForm();

            $helper->show_toolbar = false;
            $helper->table = $this->table;
            $helper->module = $this;
            $helper->default_form_language = $this->context->language->id;
            $helper->allow_employee_form_lang = PrestaShopConfiguration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);

            $helper->identifier = $this->identifier;
            $helper->submit_action = 'tc_gtmcmb_submit_'.$formName;
            $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
                . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name;
            $helper->token = PrestaShopTools::getAdminTokenLite('AdminModules');

            $vars = [];
            $input = [];

            foreach (ConfigurationVO::getFormFields($formName) as $key => $value) {
                $vars[$key] = PrestaShopConfiguration::get($key);
                $value['name'] = $key;

                if (true === ConfigurationVO::isProFeature($key) && false === $this->isPro()) {
                    $value['disabled'] = true;
                    $value['desc'] .= ' <a href="https://tagconcierge.com/consent-mode-banner#prestashop" target="_blank">Upgrade to PRO</a>';
                    $vars[$key] = false;
                }

                $input[] = $value;
            }

            $helper->tpl_vars = [
                'fields_value' => $vars,
                'languages' => $this->context->controller->getLanguages(),
                'id_language' => $this->context->language->id,
            ];

            $formHtml = $helper->generateForm([[
                'form' => [
                    'legend' => $formDetails['legend'],
                    'input' => $input,
                    'submit' => [
                        'title' => 'Save',
                    ],
                ],
            ]]);

            $output .= $formHtml;
        }

        return $output . $this->getConsentTypesForm();
    }

    /**
     * @return string
     */
    protected function getConsentTypesForm()
    {
        $this->context->smarty->assign('consent_types', $this->settingsService->getConsentTypesFields());
        $this->context->smarty->assign('form_action_url', $this->context->link->getAdminLink('AdminModules', true)
            . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name);

        return $this->render('admin/consent_types_form.tpl');
    }

    /**
     * @return array
     */
    public function getHooks()
    {
        return array_keys($this->hooks);
    }

    /**
     * @return bool
     */
    private function isModuleActive()
    {
        return '1' === PrestaShopConfiguration::get(ConfigurationVO::STATE);
    }

    /**
     * @return void
     */
    private function setupHooks()
    {
        foreach (self::HOOKS as $hookClass) {
            foreach ($hookClass::HOOKS as $hookName => $callbacks) {
                $this->hooks[$hookName][$hookClass] = $callbacks;
            }
        }
    }

    /**
     * @return string
     */
    private function getInfoBox()
    {
        return $this->render('admin/info_box.tpl');
    }

    /**
     * @param string $templatePath
     * @return string
     */
    public function render($templatePath)
    {
        $path = sprintf('views/templates/%s', $templatePath);
        $templateExists = file_exists(sprintf('%s/views/templates/%s', dirname(static::MODULE_FILE), $templatePath));

        if (false === $templateExists) {
            $path = sprintf('vendor/tagconcierge/tc-prestashop-gtm-consent-mode-banner-free/views/templates/%s', $templatePath);
        }

        return $this->display(
            static::MODULE_FILE,
            $path
        );
    }

    /**
     * @return SettingsService
     */
    public function getSettingsService()
    {
        return $this->settingsService;
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return string|null
     */
    public function __call($name, array $arguments)
    {
        try {
            $hookName = null;

            if ('hook' === PrestaShopTools::substr($name, 0, 4)) {
                $hookName = lcfirst(PrestaShopTools::substr($name, 4));
            }

            if (null === $hookName) {
                throw new \RuntimeException(sprintf('Method not implemented: %s.', $name));
            }

            if (false === isset($this->hooks[$hookName])) {
                return null;
            }

            if (false === $this->isModuleActive()) {
                return null;
            }

            $result = '';

            foreach ($this->hooks[$hookName] as $hookClass => $callbacks) {
                $hook = $this->hookProvider->provide($hookClass);

                foreach ($callbacks as $callback) {
                    $result .= $hook->{$callback}($arguments[0]);
                }
            }

            if (false === empty($result)) {
                return $result;
            }
        } catch (\Exception $e) {
            \PrestaShopLogger::addLog(
                sprintf(
                    '%s: %s',
                    $this->name,
                    $e->getMessage()
                ),
                $severityError = 3
            );
        }

        return null;
    }
}
