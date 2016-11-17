jQuery(document).ready(function() {

  jQuery(window).scroll(function() {    
      var scroll = jQuery(window).scrollTop();

      if (scroll >= 30) {
          jQuery("#article-anchor").show();

      } else {
          jQuery("#article-anchor").hide();
      }
  });

  jQuery(".search-component__reset").click(function() {
      if(!jQuery('div#checkboxes').attr('data-category-slug')) {
          jQuery('#checkboxes input:checkbox').attr('checked', true);
      }else{
jQuery('#checkboxes input:checkbox').attr('checked', true);
jQuery('#checkboxes input:checkbox[data-clear-checkbox="true"]').attr('checked', false);
}
    jQuery('.search-component__time select option:first-child').attr("selected", "selected");
    jQuery('#checkboxes').hide();
		jQuery(".search-component__search-area input[type=text]").val("");
  });

});

jQuery(window).scroll(function() {    
    var scroll = jQuery(window).scrollTop();

    if (scroll >= 540) {
        jQuery(".navigation--homepage").addClass("sticky__homepage-menu");
        jQuery(".header__logotype--homepage").addClass("header__logotype--homepage-sticky");
        jQuery(".homepage-social").addClass("homepage-social--sticky");
    } else {
        jQuery(".navigation--homepage").removeClass("sticky__homepage-menu");
        jQuery(".header__logotype--homepage").removeClass("header__logotype--homepage-sticky");
        jQuery(".homepage-social").removeClass("homepage-social--sticky");
    }
});

jQuery(window).scroll(function() {    
    var scroll = jQuery(window).scrollTop();

    if (scroll >= 30) {
        jQuery(".articles-navigation").addClass("articles-navigation--sticky");
        jQuery(".header__logotype--subpage").addClass("header__logotype--subpage-sticky");
        jQuery(".articles-navigation__social-area").show();
        jQuery(".articles-navigation__social-area-subscribe").show();
				jQuery("h2.page-title").addClass("page-title--sticky");
				jQuery(".search-component-top").addClass("search-component-top--sticky");

    } else {
        jQuery(".articles-navigation").removeClass("articles-navigation--sticky");
        jQuery(".header__logotype--subpage").removeClass("header__logotype--subpage-sticky");
        jQuery(".articles-navigation__social-area").hide();
        jQuery(".articles-navigation__social-area-subscribe").hide();
				jQuery("h2.page-title").removeClass("page-title--sticky");
				jQuery(".search-component-top").removeClass("search-component-top--sticky");
    }
});

jQuery(window).scroll(); 

//wyrownanie column
function equalHeight(group) {
   tallest = 0;
   group.each(function() {
      thisHeight = jQuery(this).height();
      if(thisHeight > tallest) {
         tallest = thisHeight;
      }
   });
   group.height(tallest);
}
jQuery(document).ready(function() {
   equalHeight(jQuery(".column"));
});

var expanded = false;
function showCheckboxes() {
    var checkboxes = document.getElementById("checkboxes");
    if (!expanded) {
        checkboxes.style.display = "block";
        expanded = true;
    } else {
        checkboxes.style.display = "none";
        expanded = false;
    }
}
	jQuery("#fancybox-frame").contents().find('.custom-close').on('click', function() {
		jQuery('#fancybox-wrap').hide();
	});




//homepage__box-image Crop
// jQuery(window).load(function() {
//     jQuery('.homepage__boxes-image').find('img').each(function() {
//         var imgClass = (this.width / this.height > 1) ? 'wide' : 'tall';
//         jQuery(this).addClass(imgClass);
//     })
// })