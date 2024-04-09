{literal}
<script type="text/javascript" data-tag-concierge-gtm-consent-mode-banner-scripts src="https://public-assets.tagconcierge.com/cookies-banner-js/1.0.0/consent-banner.min.js"></script>
<script type="text/javascript" data-tag-concierge-gtm-consent-mode-banner-scripts>
  var config = {/literal}{$tc_gtmcb_config|json_encode nofilter}{literal};
  var cookiesConfig = {
    ad_storage: [/^_gcl.*/, /^_tt.*/, /^_fb.*/, /^_pin.*/],
    analytics_storage: [/^_ga/]
  };

  function getCookies(regexp) {
    return document.cookie.split(';').filter(c => {
      return regexp.test(c.trim());
    }).map(c => {
      return c.trim().split('=').shift();
    });
  }
  function deleteCookie(name) {
    document.cookie = name+"=;path=/;domain=."+window.location.host+";expires=Thu, 01 Jan 1970 00:00:01 GMT";
  }
  cookiesBannerJs(
    function() {
      try {
        var consentPreferences = JSON.parse(localStorage.getItem('consent_preferences'));
        return consentPreferences;
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
      for (var key of Object.keys(updatedPreferences || {})) {
        if (cookiesConfig[key] && updatedPreferences[key] === 'denied') {
          cookiesConfig[key].map(function(regexp) {
            getCookies(regexp).map(function(cookieName) {
              deleteCookie(cookieName);
            });
          });
        }
      }
      localStorage.setItem('consent_preferences', JSON.stringify(updatedPreferences));
    },
    config
  );
</script>
{/literal}
