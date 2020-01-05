/**************************************************************
 * function for an option in  dropdown to be default selected *
 **************************************************************/
 
 function defaultSelect(selectId, optionValue){ 
   $('#' + selectId + ' option[value="' + optionValue +'"]').attr("selected",true);
 }
