<script type="text/javascript">
	var locale = 'es';

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

  $("#ThermForm").on("submit",function(){
    var terms_datos = $("#ThermForm").serializeHash();
    $.ajax({
      url:"/dashboard/saveterms",
      data:terms_datos,
      type:"GET",
      dataType:"json",
      success:function(dat){
        var data = dat.__serialize;
        CRContactos_Manager.check_errors(data);
        if(data.is_success == 1){
          new Noty({
              text: data.flash,
              type:'success',
              timeout:4000,
                layout:'top',
              animation: {
                  open: 'animated bounceInLeft', // Animate.css class names
                  close: 'animated bounceOutLeft', // Animate.css class names
              }
          }).show();
          loadStage("/dashboard/terms");
        }
      }
    });
    return false;
  });

</script>
<div class="panel panel-primary">
<div class="panel-heading">
  <i class="fa fa-book fa-fw"></i> <?= __('Terms') ?>
</div>
  <div class="panel-body">
    <form method="post" action="/mycompany/terms/" id="ThermForm" name="ThermForm" enctype="multipart/form-data">
  	<table border="0" class="zebra" align="center" width="600">
  		<?php
  			foreach ($LocalesQ as $ThisLocale) {
  				echo '<tr>';
  				echo '<th valign="top">',$ThisLocale['Locale'],':</th>';
  				$ThisOne = $ThisLocale['LocaleCode'];
  				echo '<input type="hidden" name="Locales[]" value="',$ThisOne,'">';
  				if(is_null($TermsQ[$ThisLocale['LocaleCode']])){
  					$FieldName = $ThisOne.'_New';
  				}else{
  					$FieldName = $ThisOne.'_Content';
  				}
  				echo '<td>';
  				echo '<textarea name="',$FieldName,'" rows="20" cols="80">',$TermsQ[$ThisLocale['LocaleCode']],'</textarea>';
  				echo '</td>';
  				echo '</tr>';
  			}
  		?>
  		<tr>
  			<th colspan="2" align="center">
  				<input type="submit" value="<?php echo __('Save') ?>" id="Sumbmit" name="Submit" tabindex="9">
  			</th>
  		</tr>
  	</table>
  </form>
  </div>
    <!-- /.panel-body -->
</div>
