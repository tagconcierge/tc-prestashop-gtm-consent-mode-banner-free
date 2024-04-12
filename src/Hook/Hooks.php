<?php

namespace TagConcierge\GtmConsentModeBannerFree\Hook;

class Hooks
{
    /** @var string */
    public const DISPLAY_HEADER = 'displayHeader';

    /** @var string */
    public const DISPLAY_AFTER_BODY_OPENING_TAG = 'displayAfterBodyOpeningTag';

    /** @var string */
    public const DISPLAY_BEFORE_BODY_CLOSING_TAG = 'displayBeforeBodyClosingTag';

    /** @var string */
    public const ACTION_FRONT_CONTROLLER_SET_MEDIA = 'actionFrontControllerSetMedia';

    /** @var string */
    public const DISPLAY_ADMIN_AFTER_HEADER = 'displayAdminAfterHeader';
}
