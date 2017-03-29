/**
 * @author kchanto
 */
$(document).ready(function(){
	if(!locale){
		locale = 'en'
	}
    $('textarea').tinymce({
// Location of TinyMCE script
        script_url: '/js/tiny_mce/tiny_mce.js',
		language : locale,
        mode: "textareas",
       plugins: "advimage, advlink, contextmenu, fullscreen, inlinepopups, noneditable, paste, save, searchreplace, spellchecker, table, embed",
        disk_cache: true,
		width:465,
		height:300,
		convert_urls : false,
// Theme options
        theme: "advanced",
       	theme_advanced_statusbar_location : "none",
        theme_advanced_buttons1: "newdocument,|,pastetext,pasteword,|,search,replace,|,undo,redo,|,bullist,numlist,|,outdent,indent,blockquote,|,justifyleft,justifycenter,justifyright,justifyfull,|,&nbsp;,spellchecker,|,sub,sup,|,charmap,|,hr,|,cleanup,code,removeformat,|,anchor,|,fullscreen",
        theme_advanced_buttons2: "link,unlink,|,tablecontrols,|,bold,italic,underline,strikethrough,forecolor,backcolor,formatselect,fontsizeselect",
        theme_advanced_buttons3: "",
        theme_advanced_toolbar_location: "top",
        theme_advanced_toolbar_align: "left",
		extended_valid_elements: "iframe[class|src|frameborder=0|alt|title|width|height|align|name], form[name|id|action|method|enctype|accept-charset|onsubmit|onreset|target|style|class|summary],input[id|name|type|value|size|maxlength|checked|accept|src|width|height|disabled|readonly|tabindex|accesskey|onfocus|onblur|onchange|onselect|onclick|required|style|class|summary],textarea[id|name|rows|cols|disabled|readonly|tabindex|accesskey|onfocus|onblur|onchange|onselect|onclick|required|style|class|summary],option[name|id|value|selected|style|class|summary],select[id|name|type|value|size|maxlength|checked|accept|src|width|height|disabled|readonly|tabindex|accesskey|onfocus|onblur|onchange|onselect|onclick|length|options|selectedIndex|required|class|summary]"
    })
})
