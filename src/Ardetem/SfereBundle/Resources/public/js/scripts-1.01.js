// JavaScript Document
jQuery(window).resize(function() {
	  jQuery("#window").css('width', jQuery(window).width())
	    .css('height', jQuery(window).height());
  });



$(document).ready(function() {
	


var position=0;

	$("#arrow_l").click(function () {
	   if(position>0)
	    {
		    console.debug(position + "/" + $("#hide_scroll").scrollLeft());
		    //$('#product_menu ul').css("marginLeft", position+=160);
		    $("#hide_scroll").scrollLeft( position-=160 );
		    $("#arrow_r").css("visibility","visible");
	    }
	    
	    if(position<=0)
	    {
		$("#arrow_l").css("visibility","hidden");
	    }
	});


	$("#arrow_r").click(function () {
		if( position <  ($("#hide_scroll")[0].scrollWidth - $("#hide_scroll").width())  )
		{
			console.debug(position + "/" + ($("#hide_scroll")[0].scrollWidth - $("#hide_scroll").width()) );
		    //$('#product_menu ul').css("marginLeft", position-=160);
		    $("#hide_scroll").scrollLeft( position+=160 );
		    $("#arrow_l").css("visibility","visible");
		
		}
		
		if( position >= ($("#hide_scroll")[0].scrollWidth - $("#hide_scroll").width())  )
		{
			$("#arrow_r").css("visibility","hidden");
		}
	});


$('#hide_scroll').scroll(function() {
// console.debug('evento:'+ $("#hide_scroll").scrollLeft() + "/" +  ($("#hide_scroll")[0].scrollWidth - $("#hide_scroll").width())  );
});

/*-------------------------------------------------------------------------------------*/

$("#menu_icon").click(function () {

$( "#menu" ).toggle( "blind", 300 );

});


/*--------------------------------------------------------------*/
$('#control_slider li').click(function(e) {
	
      height= $('#control_slider li').attr("val");
});

/*------------POP UP en las Demos---------------------------------------------*/

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
	
/*--------------Tabs de productos------------------------------------------*/


jQuery('#product_tab li').click(function(){
	
	$( "#content_tabs .active").removeClass("active");
   	$( "#content_tabs [rel='"+ $(this).attr('id') +"']").addClass("active");
	
	$( "#product_tab .active").removeClass("active");
	$(this).addClass("active");
    });


/*--------------Enviar Formulario-------------------------------------------*/


	jQuery("#send_form").click(function(){
		
		
			//removemos todos los errores
			$('form .error').removeClass("error");  
			
			//vemos que valores requieres que estan completos
			$("form [rel='enviar']").each(function(index, element) {			
				if( $(this).val() == "" && $(this).hasClass('required') ){
                        	$(this).addClass("error");
					 
				}
                  }); 
			
			//si no hay errores
			if($("form .error").length==0)
				$.ajax({
				     dataType: "text",
				     async: false,
				     type: 'GET',
				     url:"/index.php?option=com_sendform&task=send&format=raw&" + $("form [rel='enviar']").serialize(),
				     success: function(data) {
					     if(data=="")
							$("form").hide( "drop", { direction: "right" }, "fast",function(){$("#success").removeClass('hidden');} );
						else
                                                {
							$("#code").addClass("error");
                                                        $("#code").val("");
                                                }
								  
				     }
				    });
			    
			    //recargamos el captcha
			   $('#captcha').attr("src",'/index.php?option=com_sendform&task=show&' + Math.random());

	});
	
	jQuery("#puesto").change(function(){

	 if( $(this).val()=="otro")
	 {
	 	$("#otro_puesto").removeClass("hidden");
		$("#label_otro_puesto").removeClass("hidden");
	 
	 }
	 else{
	 	$("#otro_puesto").addClass("hidden");
		$("#label_otro_puesto").addClass("hidden");
	 }
	});

	
	
	

});