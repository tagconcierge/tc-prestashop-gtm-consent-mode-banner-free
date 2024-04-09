<?php

use Configuration as PrestaShopConfiguration;
use TagConcierge\GtmConsentModeBannerFree\Hook;
use TagConcierge\GtmConsentModeBannerFree\Install\ModuleTrait;
use TagConcierge\GtmConsentModeBannerFree\Install\TagConciergeModuleInterface;
use TagConcierge\GtmConsentModeBannerFree\ValueObject\ConfigurationVO;
use Tools as PrestaShopTools;

if (!defined('_PS_VERSION_')) {
    exit;
}

require_once _PS_MODULE_DIR_ . 'gtmconsentmodebannerfree/vendor/autoload.php';

class GtmConsentModeBannerFree extends Module implements TagConciergeModuleInterface
{
    use ModuleTrait;

    /** @var array */
    const HOOKS = [
        Hook\AssetsHook::class,
        Hook\InitialScriptHook::class,
        Hook\BannerScriptHook::class,
        Hook\GtmHook::class,
        Hook\CustomCssHook::class,
    ];

    /** @var string */
    const MODULE_FILE = _PS_MODULE_DIR_ . 'gtmconsentmodebannerfree/gtmconsentmodebannerfree.php';

    /**
     * TagConcierge constructor.
     */
    public function __construct()
    {
        $this->name = 'gtmconsentmodebannerfree';
        $this->author = 'Tag Concierge';
        $this->version = '1.0.2';
        $this->ps_versions_compliancy = ['min' => '1.7.1.0', 'max' => _PS_VERSION_];
        $this->bootstrap = true;
        $this->tab = 'advertising_marketing';

        parent::__construct();

        $this->displayName = $this->trans('Google Tag Manager Consent Mode Banner Free', [], 'Modules.GtmConsentModeBannerFree.Admin');
        $this->description = $this->trans('Lightweight Consent/Cookies Banner compatible with GTM Consent Mode dedicated for Prestashop.', [], 'Modules.GtmConsentModeBannerFree.Admin');

        $this->init();
    }

    protected function getConsentTypesForm(): string
    {
        $consentTypes = ConfigurationVO::getConsentTypes();

        $this->context->smarty->assign('consent_types', $consentTypes);
        $this->context->smarty->assign('form_action_url', $this->context->link->getAdminLink('AdminModules', true)
            . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name);

        return $this->render('admin/consent_types_form.tpl');
    }

    protected function handleConsentTypes(): void
    {
        if (PrestaShopTools::isSubmit('tc_gtmcmb_submit_consent_types')) {
            PrestaShopConfiguration::updateValue(
                ConfigurationVO::CONSENT_TYPES,
                json_encode(PrestaShopTools::getValue(ConfigurationVO::CONSENT_TYPES)),
                ConfigurationVO::isHtmlField(ConfigurationVO::CONSENT_TYPES)
            );
        }
    }

    public function isPro(): bool
    {
        return false;
    }
}
