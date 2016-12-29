jQuery(document).ready(function($) {


	var ajax_url = lw_frontend_vars.ajax_url; 
	
	$( ".lw_class_on_off" ).click(function() { //2AM ON AND OFF

	  var what        = $(this).attr("data-what");
	  if (what == "parent") { what =  $(this).parent(); }
	  if (what == "this")   { what =  $(this); }
	  var what_class           = $(this).attr("data-what-class");
	  var what_class_off       = $(this).attr("data-what-class-off");
	  var remove_whos_classes  = $(this).attr("data-remove-whos-classes");
	  var remove_from_what     = $(this).attr("data-remove-from-what");
	  var has_class       = false;
	  if ($(what).hasClass( what_class )) { has_class   = true; }
      if (what_class_off != "undefined") { $( what_class_off ).removeClass( what_class ); }
      
      if (remove_whos_classes != "undefined") {
			$( remove_whos_classes ).each(function() {
			  var remove_class  = $(this).attr("data-what-class");
			  $(remove_from_what).removeClass(remove_class);
			});
      }	  
	  
	  if (has_class == false) {
	      $(what).addClass(what_class);
	  }else{
	      $(what).removeClass(what_class);
	  }
	   
	}); //2AM ON AND OFF
	
	
	var whoisit = navigator.sayswho= (function(){
	    var ua= navigator.userAgent, tem,
	    M= ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];
	    if(/trident/i.test(M[1])){
	        tem=  /\brv[ :]+(\d+)/g.exec(ua) || [];
	        return 'IE '+(tem[1] || '');
	    }
	    if(M[1]=== 'Chrome'){
	        tem= ua.match(/\b(OPR|Edge)\/(\d+)/);
	        if(tem!= null) return tem.slice(1).join(' ').replace('OPR', 'Opera');
	    }
	    M= M[2]? [M[1], M[2]]: [navigator.appName, navigator.appVersion, '-?'];
	    if((tem= ua.match(/version\/(\d+)/i))!= null) M.splice(1, 1, tem[1]);
	    return M.join('_');
	})();
	
	$('body').addClass(whoisit);
	
	
	
});