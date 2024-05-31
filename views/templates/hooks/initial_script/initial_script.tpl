{literal}
<script data-tag-concierge-gtm-consent-mode-banner-scripts>
  window.dataLayer = window.dataLayer || [];
  function gtag(){
    dataLayer.push(arguments);
  }
  gtag('consent', 'default', {/literal}{$tc_gtmcb_consent_type|json_encode nofilter}{literal});

  try {
    var consentPreferences = JSON.parse(localStorage.getItem('consent_preferences'));
    if (consentPreferences !== null) {
      gtag('consent', 'update', consentPreferences);
      dataLayer.push({
        event: 'consent_update',
        consent_state: consentPreferences
      });
    }
  } catch (error) {}
</script>
{/literal}
