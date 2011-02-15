function submitForm(varForm, url, target){
	getElementsByType(varForm,'input','submit')[0].disabled = true;
	var ele = document.getElementById(target);
	ele.innerHTML = '<img src="icons/loading.gif" >' ;
	var formdata = $(varForm).serialize();
	$.post(url, formdata , function(data) {
		ele.innerHTML = data;
		FB.XFBML.parse(ele);
//		return false;
	});
	setTimeout(function(thisform) { getElementsByType(thisform,'input','submit')[0].disabled = false; }, 3000, varForm );
	return false;
};
