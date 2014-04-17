<style type="text/css" media="all">
#xdm_module {clear:both;margin:2px 0px 2px 0px;padding:5px;background-color:#EEEEEE;-moz-border-radius:2px;-khtml-border-radius:2px;-webkit-border-radius:2px;border-radius:2px;}
#xdm_module .module_name {clear:both;float:left;width:500px;margin:0px;padding:0px;color:#306085;font-size:11px;}

#xdm_module .module_infobulle {margin:0px 4px 0px 4px;padding:0px;}
#xdm_module .module_infobulle pre {margin:0px;padding:0px;font-size:11px;}
#xdm_module .module_infobulle .info {position:relative;z-index:24;margin:0px 0px 0px 0px;padding:0px 2px 0px 2px;text-align:center;color:#cfcfcf;font-size:11px;font-weight:bold;background-color:#dfdfdf;text-decoration:none;-moz-border-radius:2px;-khtml-border-radius:2px;-webkit-border-radius:2px;border-radius:2px;}
#xdm_module .module_infobulle .info:hover{z-index:25;background-color:#FBD825;color:#895902;}
#xdm_module .module_infobulle .info .info_frame{display:none;}
#xdm_module .module_infobulle .info:hover .info_frame{display:block;position:absolute;top:0px;left:9px;width:400px;text-align:left;margin:0px;padding:0px 15px 15px 15px;background-color:#FBD825;color:black;font-size:9px;font-weight:normal;-moz-border-radius:3px;-khtml-border-radius:3px;-webkit-border-radius:3px;border-radius:3px;}

#xdm_module .start {width:120px;text-align:center;padding:0px 0px 1px 0px;margin:0px 0px 0px 4px;border:0px;font-size:11px;color:white;background-color:#9f9f9f;-moz-border-radius:2px;-khtml-border-radius:2px;-webkit-border-radius:2px;border-radius:2px;cursor:pointer;}
#xdm_module .start:hover {background-color:black;}
#xdm_module .stop {width:120px;text-align:center;padding:0px 0px 1px 0px;margin:0px 0px 0px 4px;border:0px;font-size:11px;color:white;background-color:#8F381A;-moz-border-radius:2px;-khtml-border-radius:2px;-webkit-border-radius:2px;border-radius:2px;cursor:pointer;}
#xdm_module .stop:hover {background-color:black;}
</style>

<?php
$module_version = '1.3';

$module_info = array();
$module_info = array(
	"module_name" 		=> "Xdebug Manager",
	"module_version" 	=> $module_version,
	"en"	=>	array(
		"Application"	=>	array(
				"Name"		=>	"Xdebug Manager",
				"Version"	=>	$module_version,
				"Installation date"	=>	"${date}",
				"Website"	=>	"<a href='http://www.easyphp.org/' target='_blank'>www.easyphp.org</a>"
		),
		"How to uninstall this module ?"	=>	array(
				"If you want to uninstall this module, you just have to<br />delete the folder"	=>	"<br />[modules folder]\\xdebugmanager",
		),	
	),
	"fr"	=>	array(
		"Application"	=>	array(
				"Nom"		=>	"Xdebug Manager",
				"Version"	=>	$module_version,
				"Date d'installation"	=>	"${date}",
				"Site web"	=>	"<a href='http://www.easyphp.org/' target='_blank'>www.easyphp.org</a>"
		),
		"Comment d&eacute;sinstaller ce module ?"	=>	array(
				"Si vous voulez d&eacute;sinstaller ce module, il suffit de supprimer le r&eacute;pertoire"	=>	"<br />[modules folder]\\xdebugmanager",
		),
	),	
);

$module_i18n = array();
$module_i18n = array(
	"en"	=>	array(
		"startxdebug"	=>	"start xdebug",
		"stopxdebug"	=>	"stop xdebug",
		"start"			=>	"start",
		"stop"			=>	"stop",
		"outputdir"		=>	"Directory",
		"files"			=>	"file(s)",
	),
	"fr"	=>	array(
		"startxdebug"	=>	"d&eacute;marrer xdebug",
		"stopxdebug"	=>	"arr&ecirc;ter xdebug",
		"start"			=>	"d&eacute;marrer",
		"stop"			=>	"arr&ecirc;ter",
		"outputdir"		=>	"R&eacute;pertoire",
		"files"			=>	"fichier(s)",		
	),
);

/* -- INFO -- */
$infobulle = '<pre>';
foreach($module_info[$lang] as $section_name => $section) {
	$infobulle .= '<br /><b style="color:#AF2D00">' . $section_name . '</b><br />';
	foreach($section as $title => $text) {
		$infobulle .= '<b>' . $title . '</b> : ' . $text . '<br />';
	}
}
$infobulle .= '</pre>';
/* ---------- */

echo '<div id="xdm_module">';
	echo '<div class="module_name" style="width:480px;padding:2px 0px 0px 24px;background-image:url(../modules/' . $file . '/favicon.png);background-repeat:no-repeat;">';
		echo $module_info['module_name'] . ' ' . $module_info['module_version'];
		echo '<span class="module_infobulle"><span class="info">?<span class="info_frame">' . $infobulle . '</span></span></span>';
	echo "</div>";
	
	include ("xdebugmanager.php");
	
echo "</div>";
?>