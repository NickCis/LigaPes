<!--
function submitForm(varForm, url, target){
// Build the AJAX object to request the dialog contents. 
	var ajax = new Ajax(); 
	ajax.responseType = Ajax.FBML; 
	ajax.requireLogin = true; 
	ajax.ondone = function(data) { 
		document.getElementById(target).setInnerFBML(data);
	}; 
	ajax.post(url, varForm.serialize()); 
	return false;
	// the above url must be the full url of your server containing the ajax.php (the second file), NOT something like http://apps.facebook... 
} 


/*function submitForm(url, form_id, target_id) {
	var form = document.getElementById(form_id);
	// var target = document.getElementById(target_id);
	var params = form ? form.serialize() : null;
	var target = form ;
	// Set up an AJAX object.  Typically, an FBML response is desired.
	var ajax = new Ajax();
	ajax.responseType = Ajax.FBML;
	ajax.requireLogin = true;
	ajax.ondone = function(data) {
		// When the FBML response is returned, populate the data into the target element.
		if (target) target.setInnerFBML(data);
		//return true;
		//location.href=url +"?rta=" + data ;
		//setLocation = url +"?rta=" + data ;
	}
	//ajax.post(url, params);
	//return false;
};*/
//-->

