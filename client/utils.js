/**
 * @author Michal Krauter <michal.krauter@seznam.cz>
 */

(function ($) {
  /**
   * Utils function - usage: u.functionName()
   */
  window.u = {

    /**
     * Get settings
     * @returns {object}
     */
    getSettings: function() {
      return settings = {
        remote_log_url: 'http://kr4u13r-remote.8u.cz',
        version: 'Log001',
        requestType: 'POST',
        contentType: "application/json",
        dataType: "json"
      }
    },

    /**
     * Add record into remote log
     *
     * @param type
     * @param code
     * @param message
     * @param customData
     */
    remoteLogAddRecord: function (type, code, message, customData) {
      var settings = this.getSettings();
      var data = {
        version: settings.version,
        type: type,
        code: code
      };

      if (typeof message !== 'undefined' && message !== null && message.length > 0) {
        data.message = message;
      }

      if (typeof navigator.userAgent !== 'undefined' && navigator.userAgent !== null) {
        data.userAgent = navigator.userAgent;
      }

      if (typeof customData !== 'undefined' && customData !== null) {
        data.custom = customData;
      }

      $.ajax({
        type: settings.requestType,
        url: settings.remote_log_url,
        data: JSON.stringify(data),
        contentType: settings.contentType,
        dataType: settings.dataType,
        success: function (data) {
          console.log('[remoteLogAddRecord] record ADDED');
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.error('[remoteLogAddRecord] adding record FAILED:', {jqXHR: jqXHR, status: textStatus, error: errorThrown});
        }
      });
    }
  };
})(jQuery);