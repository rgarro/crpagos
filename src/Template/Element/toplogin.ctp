<?php
$session = $this->request->session();
?>
<form class="navbar-form navbar-right" method="post" action="/login/">
<div class="loginround">
	<div class="loginleft">
		<input class="topinput" type="text" size="15" name="Login" value="<?php echo __('Email')?>" onfocus="this.value=''">
		<input class="topinput" type="password" size="15" name="Password" value="" onfocus="this.style.background='#ffffff'"  style="background-image:url(/img/pass_<?php echo $session->read('LocaleCode'); ?>.gif);background-repeat:no-repeat;"><br>

	</div>
	<div class="loginright"><?php
		echo '<input type="image" alt="', __('LogIn'),'" src="/img/log_',$session->read('LocaleCode'),'.png" width="90" height="28">';
		?>
	</div>
	<a class="menuitemlink" href="<?php echo '/myaccount/recpass/' ?>"><?php echo __('ForgotPass') ?></a>
<?php
echo $this->element('langswitch');?>
</div>
</form>
