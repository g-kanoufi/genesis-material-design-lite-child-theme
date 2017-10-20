// @codekit-prepend "../node_modules/material-design-lite/src/mdlComponentHandler.js";
// @codekit-prepend "../node_modules/material-design-lite/src/third_party/**/*.js";
// @codekit-prepend "../node_modules/material-design-lite/src/button/button.js";
// @codekit-prepend "../node_modules/material-design-lite/src/checkbox/checkbox.js";
// @codekit-prepend "../node_modules/material-design-lite/src/icon-toggle/icon-toggle.js";
// @codekit-prepend "../node_modules/material-design-lite/src/menu/menu.js";
// @codekit-prepend "../node_modules/material-design-lite/src/progress/progress.js";
// @codekit-prepend "../node_modules/material-design-lite/src/radio/radio.js";
// @codekit-prepend "../node_modules/material-design-lite/src/slider/slider.js";
// @codekit-prepend "../node_modules/material-design-lite/src/spinner/spinner.js";
// @codekit-prepend "../node_modules/material-design-lite/src/switch/switch.js";
// @codekit-prepend "../node_modules/material-design-lite/src/tabs/tabs.js";
// @codekit-prepend "../node_modules/material-design-lite/src/textfield/textfield.js";
// @codekit-prepend "../node_modules/material-design-lite/src/tooltip/tooltip.js";
// @codekit-prepend "../node_modules/material-design-lite/src/layout/layout.js";
// @codekit-prepend "../node_modules/material-design-lite/src/data-table/data-table.js";
// @codekit-prepend "../node_modules/material-design-lite/src/ripple/ripple.js";
// @codekit-prepend "../node_modules/featherlight/src/featherlight.js";
// @codekit-prepend "../node_modules/featherlight/src/featherlight.gallery.js";

(function($){
  
  $(function(){
    $('.gallery-item').find('a').featherlightGallery({
      previousIcon: '<i class="material-icons">keyboard_arrow_left</i>',
      nextIcon: '<i class="material-icons">keyboard_arrow_right</i>',
      closeIcon:      '<button class="mdl-button mdl-js-ripple-effect mdl-js-button  mdl-button--fab mdl-button--mini-fab mdl-color--accent"><i class="material-icons mdl-color-text--white" role="presentation">clear</i></button>',
    });
  });

})(jQuery);
