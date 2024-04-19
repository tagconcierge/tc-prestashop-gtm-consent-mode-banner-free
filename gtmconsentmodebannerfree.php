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
        Hook\NotificationHook::class,
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
        $this->version = '1.0.3';
        $this->ps_versions_compliancy = ['min' => '1.7.1.0', 'max' => _PS_VERSION_];
        $this->bootstrap = true;
        $this->tab = 'advertising_marketing';

        parent::__construct();

        $this->displayName = $this->trans('Google Tag Manager Consent Mode Banner Free', [], 'Modules.GtmConsentModeBannerFree.Admin');
        $this->description = $this->trans('Lightweight Consent/Cookies Banner compatible with GTM Consent Mode dedicated for Prestashop.', [], 'Modules.GtmConsentModeBannerFree.Admin');

        $this->init();
    }

    public function isPro(): bool
    {
        return false;
    }

    public function getNotificationKey(): string
    {
        return '3f06f392-93f8-4928-9135-3cfd571c8de6';
    }

    public function getName(): string
    {
        return $this->name;
    }
}
