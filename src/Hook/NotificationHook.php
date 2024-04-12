<?php

namespace TagConcierge\GtmConsentModeBannerFree\Hook;

use Configuration as PrestaShopConfiguration;
use DateTime;
use TagConcierge\GtmConsentModeBannerFree\ValueObject\ConfigurationVO;
use Throwable;
use Tools;

class NotificationHook extends AbstractHook
{
    /** @var array */
    public const HOOKS = [
        Hooks::DISPLAY_ADMIN_AFTER_HEADER => [
            'notificationBox'
        ]
    ];

    public function notificationBox(): string
    {
        $installationTimestamp = (int) PrestaShopConfiguration::get(ConfigurationVO::INSTALLATION_DATE);
        $currentTimestamp = (new DateTime())->getTimestamp();


        if ($installationTimestamp + 7*24*60*60 > $currentTimestamp) {
            return '';
        }

        try {
            $controller = $this->getContext()->controller;

            if (null === $controller) {
                return '';
            }

            $controllerClass = get_class($controller);

            if (false === in_array($controllerClass, ['AdminModulesController', 'AdminDashboardController'])) {
                return '';
            }

            if ('AdminModulesController' === $controllerClass && Tools::getValue('configure') !== $this->module->getName()) {
                return '';
            }
        } catch (Throwable $e) {
            return '';
        }

        $this->getContext()->smarty->assign('tc_gtmcb_notification_key', $this->module->getNotificationKey());

        return $this->module->render('admin/notification_box.tpl');
    }
}
