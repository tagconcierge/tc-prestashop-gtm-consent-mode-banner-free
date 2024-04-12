<style>
    .gtmcmb-notifications {
        position: relative;
        background-color: #f3d8be !important;
        border-color: #d7c025 !important;
        min-height: 70px;
        font-weight: 400;
        font-size: 14px;
    }

    .gtmcmb-notifications .dismiss {
        position: absolute;
        right: 8px;
        top: 3px;
    }
</style>
<div class="gtmcmb-notifications alert" style="padding-top:5px; display: none;">
    <a href="https://tagconcierge.com" target="_blank">
        <img alt="" src="https://assets.tagconcierge.com/img/logo.png" style="float:left; margin-right:15px; width: 60px;" />
    </a>
    <p id="gtmcmb-notification-container" style="padding-top:8px;">

    </p>
    <a href="#" class="dismiss">x</a>
</div>
<script>
  String.prototype.hash = function() {
    var hash = 0,
      i, chr;
    if (this.length === 0) return hash;
    for (i = 0; i < this.length; i++) {
      chr = this.charCodeAt(i);
      hash = ((hash << 5) - hash) + chr;
      hash |= 0; // Convert to 32bit integer
    }
    return hash;
  }

  try {
    const xhr = new XMLHttpRequest();

    xhr.open('GET', 'https://api.tagconcierge.com/v3/public/notifications/{$tc_gtmcb_notification_key nofilter}', true);

    xhr.onload = function () {
      if (xhr.status >= 200 && xhr.status < 300) {
        const data = JSON.parse(xhr.responseText);
        const message = data.message ?? '';

        if (message.length > 0) {
          const messageId = message.hash();

          if (localStorage.getItem('gtmcmb_notification_'+messageId) === '1') {
            return;
          }

          document.getElementById('gtmcmb-notification-container').innerHTML = message;

          const messageWrapper = document.querySelector('.gtmcmb-notifications');
          messageWrapper.style.display = 'block';
          messageWrapper.setAttribute('data-message-id', messageId);
        }
      }
    };

    xhr.send();

    document.querySelector('.gtmcmb-notifications .dismiss').addEventListener('click', function (e) {
      e.preventDefault();
      const parent = this.parentNode;
      const messageId = parent.dataset.messageId;

      localStorage.setItem('gtmcmb_notification_'+messageId, '1');
      parent.style.display = 'none';
    });

  } catch (e) {}
</script>
