/**
 * Summary: Init Lightbox
 *
 * Description: To init the Lightbox
 *
 * DATE: 20.09.17
 *
 * @author
 * oaltmann <Oliver.Altmann@tandem-kommunikation.de>
 *
 * @copyright
 * © by TANDEM Kommunikation GmbH: This Software is the property of
 * TANDEM Kommuniktion GmbH and is protected by copyright law – it is NOT Freeware.
 *
 */
;(function ($) {
  "use strict";

  /**
   * Summary: Main Object
   *
   * Description: All functions and Settings
   *
   */
  $.fn.navigation = function (options) {
    /**
     * Summary: Settings
     *
     * Description: Plugin settings
     *
     */
    options = $.extend({}, $.fn.navigation.defaults, options);

    var publicFunctions = {
      /**
       * Summary: Init Function
       *
       * Description: To control the functions
       *
       */
      init: function () {
        /**
         * Summary: Init functions
         */
        this.initNavigation();
      },

      // Trigger function
      initNavigation: function () {

        jQuery(options.trigger).click(function(){
          if(jQuery(this).hasClass('is-active')){
            jQuery(this).removeClass('is-active');
            console.log('navigation not active');
            jQuery('.block-moviemania-main-menu').hide();
          }else{
            jQuery(this).addClass('is-active');
            console.log('navigation active');
            jQuery('.block-moviemania-main-menu').show();
          }
        });
      }
    };

    //Our output is ready, if we want our plugin to execute a
    //function whenever it called we do it now
    publicFunctions.init();

    //And the final critical step, return our object output to
    //the plugin
    return publicFunctions;
  };

  /**
   * Summary:Public variable for the Plugin
   *
   * Description: All public variable
   *
   */
  $.fn.navigation.defaults = {
    // Trigger classes
    trigger : '.hamburger',
    // options
    autoplay : false,
    progressbar: true,
    videoMaxWidth: '800px'
  };

})(jQuery);