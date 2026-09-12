<?php

	$path = "..";
	$subtitle = ": Glossary";
	$README = "README";
	$language = "";

	if ( !empty($_GET['lan']) ) {
		if (file_exists($README.'-'.$_GET['lan'].'.md')) {
			$language = '-'.$_GET['lan'];
			$README .= $language;
		}
	}

	// An entry is a directory name, so allow only the characters a GLSL
	// identifier can contain. is_string() first: ?search[]= is an array.
	$search = '';
	if ( isset($_GET['search']) && is_string($_GET['search'])
	     && preg_match('/\A[A-Za-z_][A-Za-z0-9_]*\z/', $_GET['search']) ) {
		$search = $_GET['search'];
		$subtitle = ": ".htmlspecialchars($search, ENT_QUOTES, 'UTF-8');
	}

	include($path."/header.php");
	include($path."/src/parsedown/Parsedown.php");
?>
	<div class="header">
		<p class="subtitle"><a href="https://thebookofshaders.com/">The Book of Shaders</a> by <a href="http://patriciogonzalezvivo.com">Patricio Gonzalez Vivo</a></p>
	</div>
	<hr>
	<div id="content">

<?php
	$Parsedown = new Parsedown();
	if ($search === '')
		echo $Parsedown->text(file_get_contents($README.'.md'));
	else
		echo $Parsedown->text(file_get_contents($search.'/'.$README.'.md'));

	echo '
	</div>
	<hr>';

	include($path."/footer.php");
?>
