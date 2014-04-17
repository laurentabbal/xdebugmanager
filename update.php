<?php
/**
 * Xdebug Manager for EasyPHP [ www.easyphp.org ]
 * @author  Laurent Abbal <laurent@abbal.com>
 * @version 1.2
 * @link    http://www.easyphp.org
 */

if ((isset($_POST['default_enable'])) OR (isset($_POST['auto_trace'])) OR (isset($_POST['profiler_enable']))) {

	$source = "..\..\binaries\conf_files\php.ini";
	include ("readini.php");	
	
	if (isset($_POST['default_enable'])) $xdebug_array['xdebug.default_enable'] = $_POST['default_enable'];
	if (isset($_POST['auto_trace'])) $xdebug_array['xdebug.auto_trace'] = $_POST['auto_trace'];
	if (isset($_POST['profiler_enable'])) $xdebug_array['xdebug.profiler_enable'] = $_POST['profiler_enable'];

	$xdebug_ini = '';
	foreach ($xdebug_array as $key => $value){
		$xdebug_ini .= $key . "=" . $value . "\r\n";
	}
	
	$new_phpini = $part_one[0] . ";Xdebug \r\n" . $xdebug_ini . ";/Xdebug" . $part_two[1];
	
	// Backup old php.ini
	copy($source, '..\..\binaries\conf_files\php_' . date("Y-m-d@U") . '.ini');	

	// Save new php.ini
	file_put_contents($source, $new_phpini);
}

$redirect = "http://" . $_SERVER['HTTP_HOST'] . "/home/index.php";
sleep(2);
header("Location: " . $redirect); 
exit;	
?>