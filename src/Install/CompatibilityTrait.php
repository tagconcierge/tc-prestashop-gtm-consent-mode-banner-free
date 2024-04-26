<?php

namespace TagConcierge\GtmConsentModeBannerFree\Install;

trait CompatibilityTrait
{
    /**
     * @param $id
     * @param array $parameters
     * @param $domain
     * @param $locale
     * @return mixed
     */
    protected function trans($id, array $parameters = [], $domain = null, $locale = null)
    {
        $methodExists = 1 === version_compare(_PS_VERSION_, '1.7.1');

        if (true === $methodExists) {
            return parent::trans($id, $parameters, $domain, $locale);
        }

        return $this->l($id);
    }
}
