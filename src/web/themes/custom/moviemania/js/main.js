jQuery( document ).ready(function() {
  if(jQuery('.hamburger').length > 0) {
    jQuery('.hamburger').navigation();
  }
  if(jQuery('.searchboxtrigger').length > 0) {
    jQuery('.searchboxtrigger').searchbox();
  }

});

/*
(function (Drupal) {
  // If we have a nice user name, let's replace the
  // site name with a greeting.

  console.log('DRUPAL SETTINGS');
  console.log(drupalSettings.icecream.name);
  if (drupalSettings.icecream.name) {
    var siteName = jQuery('#block-icecream-page-title');
    siteName.append('<h1>Howdy, ' + drupalSettings.icecream.name + '!</h1>');
  }
})(Drupal);



Drupal.behaviors.icecreamAnimation = {
  attach: function(context, settings) {
    var morelink = jQuery(context).find('.more-link a');
    console.log(morelink);
    morelink.on('click', function() {
      console.log('morelink clicked');
      alert('ready to go');
      return false;
    });
  }
}

*/