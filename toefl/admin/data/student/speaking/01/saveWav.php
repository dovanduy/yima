<?php

	$fileName 	= $_POST['fileName'];
	if (!$fileName) $fileName = 'sound';
	$distFile	= dirname(__FILE__).'/'.$fileName.'.wav';
	$error		= 'N';
	$message 	= '';

	if (!isset($_FILES['wav']) || $_FILES['wav']['error'] > 0) {
		$error = 'Y';
		$message = 'Error while uploading. Error code: '.$_FILES['wav']['error'];
	} else {

        $res = @move_uploaded_file($_FILES['wav']['tmp_name'], $distFile);

        if (!$res) {
			$error = 'Y';
			$message = 'Unable to create the file.';
		}
	}

	echo '
		<?xml version="1.0"?>
		<response>
		    <error value="'.$error.'" />
		    <message>'.htmlspecialchars($message).'</message>
		</response>
	';

?>