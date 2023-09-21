<?php

spl_autoload_register('classAutoloader');

// autoloader for classes
function classAutoloader($className) {
	$className = lcfirst($className);

	// $path = str_replace("\\", "/", $_SERVER["DOCUMENT_ROOT"] . "/" . $className);

	$path = str_replace("\\", "/", "../../server-files/" . $className); // an "open_basedir restriction" occurs on 000webhost if the path uses the $_SERVER["DOCUMENT_ROOT"] approach (see previously commented line) even though it works when running the project locally. Thus, the path is changed to a relative one.

	$ext = ".php";
	$fullPath = $path . $ext;

	if (file_exists($fullPath)) {
		require_once $fullPath;
	}
}
