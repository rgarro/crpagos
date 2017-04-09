<?php
$session = $this->request->session();
?>
<div class="langchange">
	<?php
	if (count(explode("/", $this->request->here())) < 4) {
		$ThisLink = '';
		$i = false;
		//Once to Get The IDX
		foreach ($session->read('Languages') as $ThisLanguage) {
			if ($session -> read('LocaleCode') == $ThisLanguage['LocaleCode']) {
				$LinkMenu = 'MenuLinks_' . $ThisLanguage['LocaleCode'];
				$item = str_replace("/", "", $this->request -> here());
				$item = str_replace(".htm", "", $item);
				$i = array_search($item, $_SESSION[$LinkMenu]);
			}
		}
		//Again to dispaly it
		foreach ($session->read('Languages') as $ThisLanguage) {
			if ($session -> read('LocaleCode') != $ThisLanguage['LocaleCode']) {
				//Not Found, set it to root
				if ($i !== false) {
					$LinkMenu = 'MenuLinks_' . $ThisLanguage['LocaleCode'];
					$ThisLink = "/" . $_SESSION[$LinkMenu][$i] . ".htm";
				}

				echo '<a href="', $ThisLink, '?Lang=', $ThisLanguage['LocaleCode'], '"><b>', $ThisLanguage['Locale'], '</b></a>&nbsp;';
			}

		}
	}
?>
</div>
