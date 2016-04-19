<?php
/**
 * Xdebug Manager for EasyPHP [ www.easyphp.org ]
 * @author  Laurent Abbal <laurent@abbal.com>
 * @version 1.2
 * @link    http://www.easyphp.org
 */

$phpini = file_get_contents($source);

$part_one = explode(";Xdebug", $phpini);
$part_two = explode(";/Xdebug", $part_one[1]);
$xdebug_settings = $part_two[0];

$xdebug_settings_array = explode("<br />",nl2br(trim($xdebug_settings)));

$xdebug_array = array();
foreach ($xdebug_settings_array as $value){
	if (strstr($value, '=')){
		$parameter = explode("=",trim($value));
		if ($parameter[0] == ';xdebug.default_enable') $parameter[0] = 'xdebug.default_enable';
		if (($parameter[0] == 'xdebug.default_enable') AND ($parameter[1] == 'Off')) $parameter[1] = 0;
		$xdebug_array = $xdebug_array + array(trim($parameter[0], ';') => trim($parameter[1]));
	}
}
?>
