function face_popup_box(titulo, src, yfbml) {
	$("<div id='dialog_box_popup'><img src='icons/loading.gif'></div>").dialog({ height: 400, width: 500, draggable: false, resizable: false, title: titulo, beforeclose: function(event, ui) { $('#dialog_box_popup').empty().remove(); } });
	div_ajax_post(src,document.getElementById("dialog_box_popup"),null);
};

/* Pop up que no depende de div_ajax_post. Misma funcion que el de arriba
//function dialog_box(titulo, src) {
function face_popup_box(titulo, src, yfbml) {
	$.post(src, { <?php echo fbvars("POST") ?> }, function(data) {
//		$("<div>"+ data +"</div>").dialog({ height: 400, width: 500, draggable: false, resizable: false, title: titulo });
		$("<div id='dialog_box_popup'><img src='icons/loading.gif'></div>").dialog({ height: 400, width: 500, draggable: false, resizable: false, title: titulo, beforeclose: function(event, ui) { $('#dialog_box_popup').empty().remove(); } });
		var dialognode = document.getElementById("dialog_box_popup");
		dialognode.innerHTML = data;
//		$(dialognode).html(data) ;
		FB.XFBML.parse(dialognode);
		alert(dialognode.innerHTML);
	});
};*/

/* Popup de facebook, deja de andar desde el Javascript Sdk. (Inutil por que usa solo fbml)	
function face_popup_box(titulo, src, yfbml) {
	FB_RequireFeatures(["Connect"], function() {
		FB.Facebook.init(api_key, channel_path);
		FB.ensureInit(function() {
			var dialog = new FB.UI.FBMLPopupDialog(titulo, '');
			var fbml = "<fb:fbml>"+ "<fb:iframe frameborder='0' smartsize='true' width='500' height='300' src='"+ src +"'></fb:iframe>" +"</fb:fbml>";
			$.post(src, {'fbml' : yfbml, <?php echo fbvars("POST") ?> }, function(data) {
//				dialog.setFBMLContent(fbml);
			dialog.setFBMLContent(data);
				dialog.setContentWidth(500); 
				dialog.setContentHeight(300);
				dialog.show();
			});
		});
	});
};*/
