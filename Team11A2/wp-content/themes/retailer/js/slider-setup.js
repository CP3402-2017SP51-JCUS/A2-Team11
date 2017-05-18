jQuery(window).load(function() {
  // The slider being synced must be initialized first
  dataSlide = jQuery('#slider').data('slide');
  jQuery('#carousel').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: dataSlide,
    itemWidth: 200,
    asNavFor: '#slider'
  });
 
  jQuery('#slider').flexslider({
    animation: "slide",
    directionNav: false, 
    controlNav: false,
    animationLoop: false,
    slideshow: dataSlide,
    sync: "#carousel"
  });
});