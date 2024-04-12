<form id="module_form_4" class="defaultForm form-horizontal" action="{$form_action_url}" method="post" enctype="multipart/form-data" novalidate>
    <input type="hidden" name="tc_gtmcmb_submit_consent_types" value="1" />
    <div class="panel">
        <div class="panel-heading"><i class="icon-cogs"></i>Consent Types</div>
        <div id="fields-container" class="form-wrapper">
            <div class="form-group">
                <div class="col-lg-2">
                    <strong>Consent Type</strong>
                </div>
                <div class="col-lg-2">
                    <strong>Title</strong>
                </div>
                <div class="col-lg-3">
                    <strong>Description</strong>
                </div>
                <div class="col-lg-2">
                    <strong>Default</strong>
                </div>
                <div class="col-lg-2">
                    <strong>Additional Types - <a href="https://tagconcierge.com/consent-mode-banner#prestashop" target="_blank">Upgrade to PRO</a></strong>
                </div>
                <div class="col-lg-1">
                    &nbsp;
                </div>
            </div>

            {foreach from=$consent_types key=index item=consent_type}
                <div class="form-group">
                    <div class="col-lg-2">
                        <input type="text" class="form-control" name="TC_GTMCMB_CONSENT_TYPES[{$index}][name]" value="{$consent_type.name}" />
                    </div>
                    <div class="col-lg-2">
                        <input type="text" class="form-control" name="TC_GTMCMB_CONSENT_TYPES[{$index}][title]" value="{$consent_type.title}" />
                    </div>
                    <div class="col-lg-3">
                        <textarea class="form-control" name="TC_GTMCMB_CONSENT_TYPES[{$index}][description]">{$consent_type.description}</textarea>
                    </div>
                    <div class="col-lg-2">
                        <select name="TC_GTMCMB_CONSENT_TYPES[{$index}][default]" class="fixed-width-xl" value="{$consent_type.default}">
                            <option value="denied"{if $consent_type.default eq 'denied'} selected="selected"{/if}>Denied</option>
                            <option value="granted"{if $consent_type.default eq 'granted'} selected="selected"{/if}>Granted</option>
                            <option value="required"{if $consent_type.default eq 'required'} selected="selected"{/if}>Required</option>
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <input type="text" class="form-control" disabled="disabled" />
                    </div>
                    <div class="col-lg-1">
                        <a class="remove-consent-type" href="#" style=" pointer-events: none; color: gray">remove</a> <a href="https://tagconcierge.com/consent-mode-banner#prestashop" target="_blank">Upgrade to PRO</a>
                    </div>
                </div>
            {/foreach}
            <div style="text-align: center">
                <button type="submit" class="btn btn-default" disabled="disabled">
                    <i class="process-icon-new"></i> Add new consent type
                </button><br />
                <a href="https://tagconcierge.com/consent-mode-banner#prestashop" target="_blank">Upgrade to PRO</a>
            </div>
        </div>

        <div class="panel-footer">
            <button type="submit" value="1"	id="module_form_submit_btn_3" name="tc_gtmcmb_submit_consent_types" class="btn btn-default pull-right">
                <i class="process-icon-save"></i> Save
            </button>
        </div>
    </div>
</form>
<script>
  const removeLinks = document.querySelectorAll('.remove-consent-type');

  removeLinks.forEach(function(link) {
    link.addEventListener('click', function(event) {
      event.preventDefault();
    });
  });
</script>
