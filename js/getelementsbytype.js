function getElementsByType(node, tag, type) {
	var node_list = node.getElementsByTagName(tag);
	var ret = new Array();
	var r = 0 ;
	for (var i = 0; i < node_list.length; i++) {
		var node = node_list[i];
		if (node.getAttribute('type') == type) {
			ret[r] = node ;
			r++ ;
		}
	} 
	return ret ;
}
 

