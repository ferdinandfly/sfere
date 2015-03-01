var ventana={
open: function(id){
	var _elementClone = jQuery("#"+id).clone();

	
	jQuery(".pop_up_content").append(_elementClone );
	
	jQuery("#window").removeClass("ocultar");
	jQuery("#"+id).removeClass("ocultar");	
	
	var alto=jQuery(".pop_up_content").height();
	var ancho=jQuery(".pop_up_content").width();
	jQuery(".pop_up_content").css("margin-top",-(alto+60)/2);
	jQuery(".pop_up_content").css("margin-left",-(ancho+60)/2);
},

close: function(){ 
jQuery(".pop_up_content table").remove(); 
jQuery("#window").addClass("ocultar"); }
};

jQuery(window).resize(function() {
	  jQuery("#window").css('width', jQuery(window).width())
	    .css('height', jQuery(window).height());
  });





/*            VENTANA                        */
jQuery(document).ready(function(){

var mouse_is_inside = false;

    jQuery('.pop_up_content').hover(function(){ 
        mouse_is_inside=true; 
    }, function(){ 
        mouse_is_inside=false; 
    });

    jQuery("#window").mousedown(function(){ 
        if(! mouse_is_inside) ventana.close();
    });

	jQuery(window).resize();
	
	




  
  
  /*----------ACORDION-----------*/

	jQuery(".accordion .title").click(function(e) {
		
		
		if( !jQuery(this).next().is(':visible') )
		{
			var from_angle=0;
			var to_angle=45;
			jQuery(this).addClass('close');
		}
		else{
			var from_angle=45;
			var to_angle=90;
			jQuery(this).removeClass('close');
		}
				
		/*jQuery(this).find(".icon").rotate({
			angle: from_angle, 
			animateTo: to_angle,
			easing: jQuery.easing.easeInOutElastic
		});	*/
				
		jQuery(this).next().toggle('fast');
		
		
      }).append("<span class='icon'></span>");
	
	
	
/*Acordion 2.0*/

	
/*CONTENT NAVEGATOR TOP*/	
/*top_bar*/

if(jQuery('#index').length>0)
var sticky_navigation_offset_top = jQuery('#index').offset().top;
    var current_item=true; //activamos la seleccion autimatica del item por scroll
    
    var sticky_navigation = function(scroll_top){
    	  
        if (scroll_top > sticky_navigation_offset_top) { 
           // jQuery('#top_bar').css({ 'position': 'fixed', 'top':0 });
		jQuery('#top_bar').addClass("fixed_bar");
		 jQuery('#inner_top_bar').removeClass('hidden');
        } else {
            jQuery('#top_bar').removeClass("fixed_bar");
		jQuery('#inner_top_bar').addClass('hidden');
        }
    };
    
    var select_current_item = function(scroll_top){
	  jQuery("h2").each(function(index, element) {	  
			if (scroll_top+80>jQuery(this).offset().top)
			{
				var index_item=jQuery(this).attr('rel');
				jQuery(".active").removeClass("active");
				jQuery('#index li[rel="'+ index_item +'"]').addClass("active");
			}
		});
	};




	var anchor=0;
	
	jQuery("h2").each(function(index, element) {
		jQuery("#index").append(  '<li rel="'+anchor+'">' + jQuery(this).html() + '</li>' );
		jQuery(this).attr('rel',anchor++)
	});
	
	jQuery("#index li").click(function(e) {
		var id=jQuery(this).attr("rel");
		var x = jQuery('h2[rel="'+ id +'"]').offset().top;
		
		current_item=false;
		
		jQuery('html,body').animate({scrollTop: x-75}, 400, function(){ current_item=true;});
		jQuery(".active").removeClass("active");
		jQuery(this).addClass("active");
	});
	
	

	
	sticky_navigation();
	 
	jQuery(window).scroll(function() {
	var scroll_top = jQuery(window).scrollTop();
	sticky_navigation(scroll_top);
	     
	     if(current_item)
	     	select_current_item(scroll_top);
	     
	});

});