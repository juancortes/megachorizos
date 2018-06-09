/**
*	Jean Carlos Rodríguez
* 	Version 0.1 - Enero 2014
*/

(function($){  
	$.fn.showPass = function(){  
		var objeto = $(this);
		var objetoToInsert='<span style="display:block;"><input type="checkbox" name="check_sp" value="1" id="_SP_check_" />Mostrar password</span>';
		objeto.after(objetoToInsert);
		var SP_check=$('#_SP_check_');
		SP_check.click(function(event) {
			if(SP_check.is(':checked')){
				objeto.attr('type', 'text');
			}else{
				objeto.attr('type', 'password');
			}

		});
	};  
})(jQuery);  