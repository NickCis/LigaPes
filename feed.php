<?php
require_once 'config.php';
require_once 'funciones.php';
?>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml"> 
<head>
	<title>Liga Pes 2009</title>
</head>
<body>

<script src="http://static.ak.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php/es_LA" type="text/javascript"></script>
<script type="text/javascript">
var api_key = '<?php echo $appapikey ?>';
var channel_path = 'xd_receiver.htm';

function ProcessLoginBox(titulo, src) {
	FB_RequireFeatures(["Connect"], function() {
		FB.Facebook.init(api_key, channel_path);
		FB.ensureInit(function() {
			var dialog = new FB.UI.FBMLPopupDialog(titulo, '');
			var fbml = "<fb:fbml>"+ "<fb:iframe frameborder='0' smartsize='true' width='500' height='300' src='"+ src +"'></fb:iframe>" +"</fb:fbml>";
			dialog.setFBMLContent(fbml);
			dialog.setContentWidth(500); 
			dialog.setContentHeight(300);
			dialog.show();
		});
	});
};

function publishFeed(attachment, action_links, target, auto) {

	/*var attachment = {
		'name':'FriendMatch',
		'href':'http://apps.facebook.com/frmatch',
		'caption':'{*actor*} is playing FriendMatch!',
		'media':[{
			'type':'image',
			'src':'http://www.ugadevelopers.com/frmatch/tile.png',
			'href':'http://apps.facebook.com/frmatch/'
	}]};
    
	var action_links = [{'text':'Match Friends','href':'http://apps.facebook.com/frmatch'}];*/

	FB_RequireFeatures(["Connect"], function() {

		/*FB.init('xxxxxxxxxx', 'xd_receiver.htm');*/
		FB.Facebook.init(api_key, channel_path);
			FB.ensureInit(function() {

			FB.Connect.streamPublish("", attachment, action_links, target, null, null, auto);
      
		});
    
	});
  
};


/*FB_RequireFeatures(["Api"], function(){
	FB.Facebook.init(api_key, channel_path);
	var message = 'Check out this cute pic.';
		var attachment = {	
			'name': 'Agregue un partido de {*actor*}',
			'href': ' http://bit.ly/187gO1',
			'caption': '{*actor*} rated the lolcat 5 stars @1365764912 {*@uid:1365764912*} - {*@uid=1365764912*} - {*@user:1365764912*} - {*@user=1365764912*} - {*@1365764912*}',
			'description': 'a funny looking cat',
			'properties': {
				'category': { 'text': 'humor', 'href': 'http://bit.ly/KYbaN'},
				'ratings': '5 stars'
			},
			'media': [{ 'type': 'image', 'src': '<?php echo $basepage . "/pes.jpg" ?>', 'href': '<?php echo $basepage ?>'}]
			}; 
		var action_links = [{'text':'Recaption this', 'href':'http://bit.ly/19DTbF'}];  
		FB.Connect.streamPublish(message, attachment, action_links);
});*/



</script>
<a href="javascript: publishFeed({'comments_xid':'prueba1', 'name' : 'Liga Pes', 'href':'http://apps.facebook.com/ligapes', 'caption':'Tal juguo contra tal', 'media':[{'type':'image','src':'http://ligapes2009.site90.com/app/pes.jpg','href':'http://apps.facebook.com/ligapes'}]},[{'text':'Liga Pes','href':'http://apps.facebook.com/ligapes'}],null,false);">Feeds ! </a>
<a href="javascript: ProcessLoginBox('Agregar Partido','http://ligapes2009.site90.com/app/agregarpartidos_form.php?liga=liga_uefa');">Pop Up ! </a>

<div class="fb_resetstyles fb_popupContainer"><table style="width: 520px; height: 320px; left: 119px; top: 106px;" id="RES_ID_fb_pop_dialog_table" class="fb_pop_dialog_table fb_popup">
       <tbody><tr>
         <td class="fb_pop_topleft"></td>
         <td class="fb_pop_border"></td>
         <td class="fb_pop_topright"></td>
       </tr>
       <tr>
         <td class="fb_pop_border"></td>

         <td class="fb_pop_content" id="pop_content">
           <div class="fb_pop_content_container">
              <h2 class="fb_resetstyles">
                <div class="fb_dialog_icon"></div>
                <span class="fb_dialog_header" id="fb_dialog_header">Agregar Partidos</span>
                <div class="fb_dialog_loading_spinner" id="fb_dialog_loading_spinner">&nbsp;</div>
                <a id="fb_dialog_cancel_button" class="fb_dialog_cancel_button" title="close dialog" href="#" onclick="return false;">&nbsp;</a>
              </h2>
              <div id="fb_dialog_content" class="fb_dialog_content"><div class=" FB_ElementReady" style="width: 498px; height: 273px;" iframeheight="300px" iframewidth="500px" fbml="&lt;fb:fbml&gt;&lt;fb:fbml&gt;&lt;fb:iframe frameborder='0' smartsize='true' width='500' height='300' src='http://ligapes2009.site90.com/app/agregarpartidos_form.php?liga=la_liga'&gt;&lt;/fb:iframe&gt;&lt;/fb:fbml&gt;&lt;/fb:fbml&gt;"><iframe style="width: 500px; height: 300px;" name="fbmlIFrame_2" src="http://ligapes2009.site90.com/app/xd_receiver.htm" class="fbmlIframe" scrolling="no" frameborder="0"></iframe></div></div>

           </div>
         </td>
         <td class="fb_pop_border"></td>
       </tr>
       <tr>
         <td class="fb_pop_bottomleft"></td>
         <td class="fb_pop_border"></td>
         <td class="fb_pop_bottomright"></td>
       </tr>

    </tbody></table></div>
</body>
</html>
