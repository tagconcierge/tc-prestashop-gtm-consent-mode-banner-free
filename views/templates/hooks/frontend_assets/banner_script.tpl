{literal}
<script type="text/javascript" data-tag-concierge-gtm-consent-mode-banner-scripts>(()=>{function C(e){document.readyState!="loading"?e():document.addEventListener?document.addEventListener("DOMContentLoaded",e):document.attachEvent("onreadystatechange",function(){document.readyState!="loading"&&e()})}function v(e,t){if(e!==null)for(var d of Object.keys(t||{}))e.style[d]=t[d]}function A(e,t){for(var d in t){let n=d.replace(/([A-Z])/g,"-$1");e.querySelectorAll(d).forEach(function(r){v(r,t[d])})}}function m(e){return(e||"").replace(/\[([^\]]+)\]\(([^\)]+)\)/g,'<a href="$2">$1</a>').replace(/\*\*\s?([^\n]+)\*\*/g,"<b>$1</b>").replace(/\_\_\s?([^\n]+)\_\_/g,"<b>$1</b>").replace(/\*\s?([^\n]+)\*/g,"<i>$1</i>").replace(/\_\s?([^\n]+)\_/g,"<i>$1</i>")}function S(e){return e!==null}function q(){return console.warn("ConsentBannerJS: loadConsentState function is not provided"),null}function b(e){return console.warn("ConsentBannerJS: saveConsentState function is not provided"),null}function g(e){var t=document.createElement("div");return t.setAttribute("id","consent-banner-main"),t.style.display="none",t}function L(e){var t=document.createElement("div");return t.setAttribute("id","consent-banner-wall"),t}function j(e){var t=document.createElement("div");return t.style.display="none",t.setAttribute("id","consent-banner-modal"),t.innerHTML='<div class="consent-banner-modal-wrapper"><div><h2></h2><p></p></div><div class="consent-banner-modal-buttons"><a class="consent-banner-button" href="#settings"></a><a class="consent-banner-button" href="#reject"></a><a class="consent-banner-button" href="#accept"></a></div></div>',t.querySelector("h2").textContent=e.modal.title,t.querySelector("p").innerHTML=m(e.modal.description),t.querySelector('[href="#accept"]').textContent=e.modal.buttons.accept,t.querySelector('[href="#settings"]').textContent=e.modal.buttons.settings,t.querySelector('[href="#reject"]').textContent=e.modal.buttons.reject,t}function M(e,t){var d=S(t),n=document.createElement("div");n.setAttribute("id","consent-banner-settings"),n.style.display="none",n.innerHTML='<div><form><h2></h2><div><p></p><ul></ul></div><div class="consent-banner-settings-buttons"><a class="consent-banner-button" href="#reject"></a><a class="consent-banner-button" href="#save"></a><a class="consent-banner-button" href="#accept"></a></div></form></div>',n.querySelector("h2").textContent=e.settings.title,n.querySelector("p").innerHTML=m(e.settings.description),n.querySelector('[href="#save"]').textContent=e.settings.buttons.save,n.querySelector('[href="#accept"]').textContent=e.settings.buttons.accept,n.querySelector('[href="#reject"]').textContent=e.settings.buttons.reject;var a=e.consent_types;for(var r of Object.keys(a||{})){var s=document.createElement("li"),p=document.createElement("label"),c=document.createElement("p"),l=document.createElement("input");l.setAttribute("type","hidden"),l.setAttribute("name",a[r].name),l.setAttribute("value","denied");var o=document.createElement("input");o.setAttribute("type","checkbox"),o.setAttribute("name",a[r].name),o.setAttribute("value","granted"),o.setAttribute("id",a[r].name),(d&&t[a[r].name]==="granted"||!d&&a[r].default==="granted")&&o.setAttribute("checked","checked"),(d&&t[a[r].name]==="denied"||!d&&a[r].default==="denied")&&o.removeAttribute("checked"),a[r].default==="required"&&(o.setAttribute("checked","checked"),o.setAttribute("disabled","disabled"),l.setAttribute("value","granted")),p.textContent=a[r].title,p.setAttribute("for",a[r].name),c.innerHTML=m(a[r].description),s.appendChild(l),s.appendChild(o),s.appendChild(p),s.appendChild(c),n.querySelector("ul").appendChild(s)}return n}function f(e,t,d){var n=S(d),a=t.consent_types;for(var r of Object.keys(a||{})){var s=e.querySelector('[type="checkbox"][name="'+a[r].name+'"]');(n&&d[a[r].name]==="granted"||!n&&a[r].default==="granted")&&s.setAttribute("checked","checked"),(n&&d[a[r].name]==="denied"||!n&&a[r].default==="denied")&&s.removeAttribute("checked"),a[r].default==="required"&&(s.setAttribute("checked","checked"),s.setAttribute("disabled","disabled"))}}function y(e){e.style.display="none",k(e)}function w(e){var t=e.querySelector("#consent-banner-wall");t.style.background="rgba(0, 0, 0, .7)",t.style.position="fixed",t.style.top="0",t.style.right="0",t.style.left="0",t.style.bottom="0"}function k(e){var t=e.querySelector("#consent-banner-wall");t.style.position="static",t.style.background="none"}function E(e){e.style.display="block",e.querySelector("#consent-banner-modal").style.display="block"}function _(e){e.style.display="block",e.querySelector("#consent-banner-modal").style.display="none"}function h(e){e.style.display="block",e.querySelector("#consent-banner-settings").style.display="block",w(e)}function O(e){var t=document.querySelector("body"),d=q(),n=g(e),a=L(e),r=j(e),s=M(e,d);n.appendChild(a),a.appendChild(r),a.appendChild(s),s.querySelector('[href="#accept"]').addEventListener("click",function(c){c.preventDefault();var l=e.consent_types,o={};for(var i of Object.keys(l||{})){var u=l[i].name;o[u]="granted"}f(s,e,o),b(o),y(n),document.body.dispatchEvent(new CustomEvent("consent-banner.hidden"))}),r.querySelector('[href="#accept"]').addEventListener("click",function(c){c.preventDefault();var l=e.consent_types,o={};for(var i of Object.keys(l||{})){var u=l[i].name;o[u]="granted"}f(s,e,o),b(o),y(n),document.body.dispatchEvent(new CustomEvent("consent-banner.hidden"))}),r.querySelector('[href="#settings"]').addEventListener("click",function(c){c.preventDefault(),_(n),h(n),document.body.dispatchEvent(new CustomEvent("consent-banner.shown"))}),r.querySelector('[href="#reject"]').addEventListener("click",function(c){c.preventDefault();var l=e.consent_types,o={};for(var i of Object.keys(l||{})){var u=l[i].name;o[u]="denied"}b(o),f(s,e,o),y(n),document.body.dispatchEvent(new CustomEvent("consent-banner.hidden"))}),s.querySelector('[href="#reject"]').addEventListener("click",function(c){c.preventDefault();var l=e.consent_types,o={};for(var i of Object.keys(l||{})){var u=l[i].name;o[u]="denied"}b(o),f(s,e,o),y(n),document.body.dispatchEvent(new CustomEvent("consent-banner.hidden"))}),s.querySelector('[href="#save"]').addEventListener("click",function(c){c.preventDefault(),s.querySelector("form").requestSubmit()}),s.querySelector("form").addEventListener("submit",function(c){c.preventDefault();let l=new FormData(c.target);consentState=Object.fromEntries(l),b(consentState),f(s,e,consentState),y(n),document.body.dispatchEvent(new CustomEvent("consent-banner.hidden"))});var p=t.querySelector('[href$="#consent-banner-settings"]');p!==null&&p.addEventListener("click",function(c){c.preventDefault(),h(n),document.body.dispatchEvent(new CustomEvent("consent-banner.shown"))}),t.appendChild(n),A(n,e.styles),S(d)!==!0&&(e.display.wall===!0&&w(n),e.display.mode==="bar"&&(v(r,{position:"fixed",bottom:0,left:0,right:0,"border-bottom":"none","border-left":"none","border-right":"none",padding:"5px"}),v(r.querySelector("h2"),{display:"none"}),v(r.querySelector(".consent-banner-modal-buttons"),{"margin-left":"20px"}),E(n),document.body.dispatchEvent(new CustomEvent("consent-banner.shown"))),e.display.mode==="modal"&&(v(r,{position:"fixed",top:"50%",left:"50%",transform:"translate(-50%, -50%)"}),v(r.querySelector(".consent-banner-modal-wrapper"),{display:"block"}),E(n),document.body.dispatchEvent(new CustomEvent("consent-banner.shown"))),e.display.mode==="settings"&&(h(n),document.body.dispatchEvent(new CustomEvent("consent-banner.shown"))))}window.cookiesBannerJs=function(e,t,d){q=e,b=t,C(O.bind(null,d))};})();</script>
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
