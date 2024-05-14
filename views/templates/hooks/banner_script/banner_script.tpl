{literal}
<script type="text/javascript" data-tag-concierge-gtm-consent-mode-banner-scripts>
  var config = {/literal}{$tc_gtmcb_config|json_encode nofilter}{literal};

  document.body.addEventListener('consent-banner.ready', () => {
    cookiesBannerJs(
      function() {
        try {
          return JSON.parse(localStorage.getItem('consent_preferences'));
        } catch (error) {
          return null;
        }
      },
      function(consentPreferences) {
        var updatedPreferences = config.consent_types.reduce(function(agg, type) { if (type.additional_consent_types !== '') { Object.assign(agg, Object.fromEntries(type.additional_consent_types.split(',').map((additionalConsentType) => { return [additionalConsentType, agg[type.name]]; }))) } return agg; }, consentPreferences);
        gtag('consent', 'update', updatedPreferences);
        dataLayer.push({
          event: 'consent_update',
          consent_state: updatedPreferences
        });
        localStorage.setItem('consent_preferences', JSON.stringify(updatedPreferences));
      },
      config
    );
  });

  document.body.addEventListener('consent-banner.shown', () => {
    document.querySelectorAll('input[type=\'checkbox\']').forEach((el) => {
      el.classList.add('not_uniform');
      el.classList.add('comparator');
    })
  });
</script>
{/literal}
