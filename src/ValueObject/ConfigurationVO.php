<?php

namespace TagConcierge\GtmConsentModeBannerFree\ValueObject;

use Configuration as PrestaShopConfiguration;

class ConfigurationVO
{
    /** @var string */
    public const STATE = 'TC_GTMCMB_STATE';

    /** @var string */
    public const ENABLED_ONLY_FOR_ADMIN = 'TC_GTMCMB_ENABLED_ONLY_FOR_ADMIN';

    /** @var string */
    public const ENABLED_ONLY_DEFAULT_CONSENT_MODE = 'TC_GTMCMB_ENABLED_ONLY_DEFAULT_CONSENT_MODE';

    /** @var string */
    public const DISPLAY_MODE = 'TC_GTMCMB_DISPLAY_MODE';

    /** @var string */
    public const WALL = 'TC_GTMCMB_WALL';

    /** @var string */
    public const THEME = 'TC_GTMCMB_THEME';

    /** @var string */
    public const MAIN_MODAL_TITLE = 'TC_GTMCMB_MAIN_MODAL_TITLE';

    /** @var string */
    public const MAIN_MODAL_CONTENT = 'TC_GTMCMB_MAIN_MODAL_CONTENT';

    /** @var string */
    public const MAIN_MODAL_ACCEPT_BUTTON = 'TC_GTMCMB_MAIN_MODAL_ACCEPT_BUTTON';

    /** @var string */
    public const MAIN_MODAL_OPEN_SETTINGS_BUTTON = 'TC_GTMCMB_MAIN_MODAL_OPEN_SETTINGS_BUTTON';

    /** @var string */
    public const MAIN_MODAL_REJECT_BUTTON = 'TC_GTMCMB_MAIN_MODAL_REJECT_BUTTON';

    /** @var string */
    public const SETTINGS_MODAL_TITLE = 'TC_GTMCMB_SETTINGS_MODAL_TITLE';

    /** @var string */
    public const SETTINGS_MODAL_CONTENT = 'TC_GTMCMB_SETTINGS_MODAL_CONTENT';

    /** @var string */
    public const SETTINGS_MODAL_SAVE_BUTTON = 'TC_GTMCMB_SETTINGS_MODAL_SAVE_BUTTON';

    /** @var string */
    public const SETTINGS_MODAL_CLOSE_BUTTON = 'TC_GTMCMB_SETTINGS_MODAL_CLOSE_BUTTON';

    /** @var string */
    public const SETTINGS_MODAL_REJECT_BUTTON = 'TC_GTMCMB_SETTINGS_MODAL_REJECT_BUTTON';

    /** @var string */
    public const SETTINGS_MODAL_ACCEPT_BUTTON = 'TC_GTMCMB_SETTINGS_MODAL_ACCEPT_BUTTON';

    /** @var string */
    public const CUSTOM_CSS = 'TC_GTMCMB_CUSTOM_CSS';

    /** @var string */
    public const GTM_CONTAINER_SNIPPET_HEAD = 'TC_GTMCMB_GTM_CONTAINER_SNIPPET_HEAD';

    /** @var string */
    public const GTM_CONTAINER_SNIPPET_BODY = 'TC_GTMCMB_GTM_CONTAINER_SNIPPET_BODY';

    /** @var string */
    public const CONSENT_TYPES = 'TC_GTMCMB_CONSENT_TYPES';

    /** @var string */
    public const COOKIE_REMOVAL_ON_DENIAL = 'TC_GTMCMB_COOKIE_REMOVAL_ON_DENIAL';

    private static $proFields = [
        self::COOKIE_REMOVAL_ON_DENIAL
    ];

    /**
     * @var array
     */
    private static $fields = [
        self::STATE => [
            'type' => 'switch',
            'label' => 'Is enabled?',
            'is_bool' => true,
            'desc' => 'General state of the module.',
            'values' => [
                [
                    'id' => 'active',
                    'value' => true,
                    'label' => 'Enabled',
                ],
                [
                    'id' => 'inactive',
                    'value' => false,
                    'label' => 'Disabled',
                ],
            ],
        ],
        self::ENABLED_ONLY_FOR_ADMIN => [
            'type' => 'switch',
            'label' => 'Enable only for admins?',
            'is_bool' => true,
            'desc' => 'When checked the consent mode will be only enabled for logged-in administrators. Helpful when testing.',
            'values' => [
                [
                    'id' => 'active',
                    'value' => true,
                    'label' => 'Enabled',
                ],
                [
                    'id' => 'inactive',
                    'value' => false,
                    'label' => 'Disabled',
                ],
            ],
        ],
        self::ENABLED_ONLY_DEFAULT_CONSENT_MODE => [
            'type' => 'switch',
            'label' => 'Enable only default consent mode?',
            'is_bool' => true,
            'desc' => 'When checked the plugin will only load default consent mode state.',
            'values' => [
                [
                    'id' => 'active',
                    'value' => true,
                    'label' => 'Enabled',
                ],
                [
                    'id' => 'inactive',
                    'value' => false,
                    'label' => 'Disabled',
                ],
            ],
        ],
        self::COOKIE_REMOVAL_ON_DENIAL => [
            'type' => 'switch',
            'label' => 'Remove cookies on consent denial?',
            'is_bool' => true,
            'desc' => 'When checked the plugin will remove tracking cookies from user\'s browser if consent was denied.',
            'values' => [
                [
                    'id' => 'active',
                    'value' => true,
                    'label' => 'Enabled',
                ],
                [
                    'id' => 'inactive',
                    'value' => false,
                    'label' => 'Disabled',
                ],
            ],
        ],
        self::DISPLAY_MODE => [
            'type' => 'select',
            'label' => 'Display mode',
            'desc' => 'Form of the banner, small bar at the bottom of the page or center modal covering content.',
            'options' => [
                'query' => [
                    [
                        'id' => 'bar',
                        'name' => 'Bar',
                    ],
                    [
                        'id' => 'modal',
                        'name' => 'Modal',
                    ],
                ],
                'id' => 'id',
                'name' => 'name',
            ],
        ],
        self::WALL => [
            'type' => 'switch',
            'label' => 'Wall',
            'is_bool' => true,
            'desc' => 'Whether to display a "wall" which will cover (with some default opacity) the content of the page when banner is shown.',
            'values' => [
                [
                    'id' => 'active',
                    'value' => true,
                    'label' => 'Enabled',
                ],
                [
                    'id' => 'inactive',
                    'value' => false,
                    'label' => 'Disabled',
                ],
            ],
        ],
        self::THEME => [
            'type' => 'select',
            'label' => 'Theme',
            'desc' => 'Select theme of the banner that will apply default styling.',
            'options' => [
                'query' => [
                    [
                        'id' => 'light',
                        'name' => 'Light',
                    ],
                    [
                        'id' => 'dark',
                        'name' => 'Dark',
                    ],
                ],
                'id' => 'id',
                'name' => 'name',
            ],
        ],
        self::MAIN_MODAL_TITLE => [
            'type' => 'text',
            'label' => 'Title',
            'desc' => 'Title of the main banner modal. Not shown when Display Mode is set to "bar".',
        ],
        self::MAIN_MODAL_CONTENT => [
            'type' => 'textarea',
            'label' => 'Content',
            'desc' => 'Content of the banner. Supports simple markdown like [links](https://url.com) or **bold**. Buttons will be shown on the right side of this content.',
        ],
        self::MAIN_MODAL_ACCEPT_BUTTON => [
            'type' => 'text',
            'label' => 'Accept Button',
            'desc' => 'Text of accept button on the main banner.',
        ],
        self::MAIN_MODAL_OPEN_SETTINGS_BUTTON => [
            'type' => 'text',
            'label' => 'Open Settings Button',
            'desc' => 'Text of settings button on the main banner.',
        ],
        self::MAIN_MODAL_REJECT_BUTTON => [
            'type' => 'text',
            'label' => 'Reject Button',
            'desc' => 'Text of reject button on the main banner.',
        ],
        self::SETTINGS_MODAL_TITLE => [
            'type' => 'text',
            'label' => 'Title',
            'desc' => 'Title of the main banner modal. Not shown when Display Mode is set to "bar".',
        ],
        self::SETTINGS_MODAL_CONTENT => [
            'type' => 'textarea',
            'label' => 'Content',
            'desc' => 'Content of the settings banner. Supports simple markdown like [links](https://url.com) or **bold**.',
        ],
        self::SETTINGS_MODAL_SAVE_BUTTON => [
            'type' => 'text',
            'label' => 'Save Button',
            'desc' => 'Text of save button on the settings banner.',
        ],
        self::SETTINGS_MODAL_CLOSE_BUTTON => [
            'type' => 'text',
            'label' => 'Close Button',
            'desc' => 'Text of settings button on the settings banner.',
        ],
        self::SETTINGS_MODAL_REJECT_BUTTON => [
            'type' => 'text',
            'label' => 'Reject Button',
            'desc' => 'Text of reject button on the settings banner.',
        ],
        self::SETTINGS_MODAL_ACCEPT_BUTTON => [
            'type' => 'text',
            'label' => 'Accept Button',
            'desc' => 'Text of accept button on the settings banner.',
        ],
        self::CUSTOM_CSS => [
            'type' => 'textarea',
            'label' => 'Custom CSS',
            'desc' => 'Style your Consent Mode Banner. CSS selectors cheatsheet: all buttons - .consent-banner-button, primary (accept) buttons - .consent-banner-button[href="#accept"]',
        ],
        self::GTM_CONTAINER_SNIPPET_HEAD => [
            'type' => 'textarea',
            'label' => 'GTM snippet head',
            'desc' => 'Paste the first snippet provided by GTM. It will be loaded in the <head> of the page.',
        ],
        self::GTM_CONTAINER_SNIPPET_BODY => [
            'type' => 'textarea',
            'label' => 'GTM snippet body',
            'desc' => 'Paste the second snippet provided by GTM. It will be loaded after opening <body> tag.',
        ],
        self::CONSENT_TYPES => []
    ];

    private static $htmlFields = [
        ConfigurationVO::GTM_CONTAINER_SNIPPET_HEAD,
        ConfigurationVO::GTM_CONTAINER_SNIPPET_BODY,
        ConfigurationVO::CUSTOM_CSS,
    ];

    private static $forms = [
        'basic_settings' => [
            'fields' => [
                self::STATE,
                self::ENABLED_ONLY_FOR_ADMIN,
                self::ENABLED_ONLY_DEFAULT_CONSENT_MODE,
                self::COOKIE_REMOVAL_ON_DENIAL,
                self::DISPLAY_MODE,
                self::WALL,
                self::THEME,
            ],
            'legend' => [
                'title' => 'Basic Settings',
                'icon' => 'icon-cogs',
            ],
        ],
        'banner_main_modal' => [
            'fields' => [
                self::MAIN_MODAL_TITLE,
                self::MAIN_MODAL_CONTENT,
                self::MAIN_MODAL_ACCEPT_BUTTON,
                self::MAIN_MODAL_OPEN_SETTINGS_BUTTON,
                self::MAIN_MODAL_REJECT_BUTTON,
            ],
            'legend' => [
                'title' => 'Banner Main Modal',
                'icon' => 'icon-cogs',
            ],
        ],
        'banner_settings_modal' => [
            'fields' => [
                self::SETTINGS_MODAL_TITLE,
                self::SETTINGS_MODAL_CONTENT,
                self::SETTINGS_MODAL_SAVE_BUTTON,
                self::SETTINGS_MODAL_CLOSE_BUTTON,
                self::SETTINGS_MODAL_REJECT_BUTTON,
                self::SETTINGS_MODAL_ACCEPT_BUTTON,
            ],
            'legend' => [
                'title' => 'Banner Settings Modal',
                'icon' => 'icon-cogs',
            ],
        ],
        'custom_css' => [
            'fields' => [
                self::CUSTOM_CSS,
            ],
            'legend' => [
                'title' => 'Custom CSS',
                'icon' => 'icon-cogs',
            ],
        ],
        'gtm_snippet' => [
            'fields' => [
                self::GTM_CONTAINER_SNIPPET_HEAD,
                self::GTM_CONTAINER_SNIPPET_BODY,
            ],
            'legend' => [
                'title' => 'Google Tag Manager snippet',
                'icon' => 'icon-cogs',
            ],
        ],
    ];

    private static $defaultValues = [
        self::CUSTOM_CSS => '#consent-banner-settings,
#consent-banner-modal {
    border-radius: 6px !important;
}


.consent-banner-button {
    color:#af1d1f;
    border-color:#af1d1f;
    background-color: transparent;
    border-width: 2px;
    padding: 8px 27px;
    border-radius: 3px;
}

.consent-banner-button:hover {
    color: #d83e40;
    border-color: #d83e40;
}

.consent-banner-button[href="#accept"] {
    color: #ffffff;
    border-color: #af1d1f;
    background-color: #af1d1f;
}

.consent-banner-button[href="#accept"]:hover {
    border-color: #d83e40;
    background-color: #d83e40;
}

#consent-banner-settings ul label {
    margin-left: 11px;
}',
        self::DISPLAY_MODE => 'bar',
        self::WALL => false,
        self::MAIN_MODAL_TITLE => 'We respect users privacy',
        self::MAIN_MODAL_CONTENT => 'We use cookies to improve your browsing experience, display ads or customized content, and analyze site traffic. Clicking the "Accept All" button indicates your consent to our use of cookies.',
        self::MAIN_MODAL_ACCEPT_BUTTON => 'Accept all',
        self::MAIN_MODAL_OPEN_SETTINGS_BUTTON => 'Customize',
        self::MAIN_MODAL_REJECT_BUTTON => 'Reject',
        self::SETTINGS_MODAL_TITLE => 'Customize your consent preferences',
        self::SETTINGS_MODAL_CONTENT =>
'We use cookies to help users navigate and perform certain functions efficiently. Details of all cookies corresponding to each consent category can be found below.

Cookies classified as "essential" are stored in the user\'s browser because they are necessary to enable basic site functions.

We also use third-party cookies to help us analyze how users use the site, as well as to store user preferences and deliver relevant content and advertising to users. These types of cookies will only be stored in your browser with your prior consent.

You can enable or disable some or all of these cookies, but disabling some of them may affect your browsing experience.',
        self::SETTINGS_MODAL_SAVE_BUTTON => 'Save my preferences',
        self::SETTINGS_MODAL_CLOSE_BUTTON => 'Close',
        self::SETTINGS_MODAL_REJECT_BUTTON => 'Reject',
        self::SETTINGS_MODAL_ACCEPT_BUTTON => 'Accept all',
        self::CONSENT_TYPES => [
            [
                'name' => 'necessary',
                'title' => 'Necessary',
                'description' => 'Necessary cookies are critical to the basic functions of the site and the site will not function as intended without them.These cookies do not store any personally identifiable information.',
                'default' => 'required',
            ], [
                'name' => 'analytics_storage',
                'title' => 'Analytics',
                'description' => 'Analytical cookies are used to understand how users interact with the site. These cookies help provide information on metrics of number of visitors, rejection rate, source of traffic, etc.',
                'default' => 'denied',
            ], [
                'name' => 'ad_storage',
                'title' => 'Advertising',
                'description' => 'Advertising cookies are used to deliver personalized ads to users based on the pages they have previously visited, and to analyze the effectiveness of the advertising campaign.',
                'default' => 'denied',
            ], [
                'name' => 'functionality_storage',
                'title' => 'Functional',
                'description' => 'Functional cookies help perform certain functions, such as sharing site content on social media platforms, collecting feedback and other third-party functions.',
                'default' => 'denied',
            ]
        ]
    ];

    public static function getFields(): array
    {
        return self::$fields;
    }

    public static function getForms(): array
    {
        return self::$forms;
    }

    public static function getFormFields(string $form): array
    {
        $fields = [];
        foreach (self::$forms[$form]['fields'] as $fieldName) {
            $fields[$fieldName] = self::$fields[$fieldName];
        }

        return $fields;
    }

    public static function isHtmlField(string $fieldName): bool
    {
        return in_array($fieldName, self::$htmlFields, true);
    }

    public static function getDefaultValue(string $fieldName)
    {
        return self::$defaultValues[$fieldName] ?? null;
    }

    public static function getConsentTypes(): array
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

        foreach ($consentTypes as &$consentType) {
            $consentType['additional_consent_types'] = '';
        }

        return $consentTypes;
    }

    public static function isProFeature(string $fieldName): bool
    {
        return true === in_array($fieldName, self::$proFields);
    }
}
