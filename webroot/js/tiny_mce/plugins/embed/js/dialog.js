tinyMCEPopup.requireLangPack();

var EmbedDialog = {
	init : function() {
		var f = document.forms[0];

		// Get the selected contents as text and place it in the input
		f.embedcode.value = tinyMCEPopup.editor.selection.getContent({format : 'html'});
	},

	insert : function() {
		// Insert the contents from the input into the document
		code = document.forms[0].embedcode.value;
	  	isIfr = code.indexOf('iframe')
	  	if(isIfr == -1){
	  		alert('Please Use the iframe option');
	  		document.forms[0].embedcode.value = null;
	  		return false
	  	}else{
		  	regexS = 'src="([^ #]*)"';
	 		regex = new RegExp( regexS );
	  		results = regex.exec(code);
			src = results[1];
			hasQs = src.indexOf('?')
			if(hasQs == -1){
				newSrc = src+'?wmode=transparent'
			}else{
				newSrc = src+'&wmode=transparent'
			}
			newCode = code.replace(src, newSrc)	  		
	  	}

		tinyMCEPopup.editor.execCommand('mceInsertContent', false, newCode);
		tinyMCEPopup.close();
	}
};

tinyMCEPopup.onInit.add(EmbedDialog.init, EmbedDialog);
