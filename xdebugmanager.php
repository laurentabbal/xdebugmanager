<?php
/**
 * Xdebug Manager for EasyPHP [ www.easyphp.org ]
 * @author  Laurent Abbal <laurent@abbal.com>
 * @version 1.2
 * @link    http://www.easyphp.org
 */

$source = $easyphp_path . "binaries\conf_files\php.ini";

include ("readini.php");

$trace_dir = str_replace('${path}', $easyphp_path, $xdebug_array['xdebug.trace_output_dir']);
$profiler_dir = str_replace('${path}', $easyphp_path, $xdebug_array['xdebug.profiler_output_dir']);

$trace_dir = str_replace('\\\\', '\\', $trace_dir);
$profiler_dir = str_replace('\\\\', '\\', $profiler_dir);

$weeds = array('.', '..');
$trace_files = array_diff(scandir(str_replace('\'', '', $trace_dir)), $weeds); 
$profiler_files = array_diff(scandir(str_replace('\'', '', $profiler_dir)), $weeds); 

$sizes = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");

// Trace dir size
$trace_dir_size = 0;
foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(str_replace('\'', '', $trace_dir))) as $files){
	$trace_dir_size+=$files->getSize();
}
if ($trace_dir_size == 0) {
	$trace_dir_size = '0 Bytes';
} else {
	$trace_dir_size = round($trace_dir_size/pow(1024, ($i = floor(log($trace_dir_size, 1024)))), $i > 1 ? 2 : 0) . $sizes[$i];
}

// Profiler dir size
$profiler_dir_size = 0;
foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(str_replace('\'', '', $profiler_dir))) as $files){
	$profiler_dir_size+=$files->getSize();
}
if ($profiler_dir_size == 0) {
	$profiler_dir_size = '0 Bytes';
} else {
	$profiler_dir_size = round($profiler_dir_size/pow(1024, ($i = floor(log($profiler_dir_size, 1024)))), $i > 1 ? 2 : 0) . $sizes[$i];
}

$action = "http://" . $_SERVER['HTTP_HOST'] . "/modules/xdebugmanager/update.php";	

if ($xdebug_array['xdebug.default_enable'] == 0) { ?>

	<form method="post" action="<?php echo $action; ?>" style="float:right;padding:0px;margin:0px;cursor:pointer">
		<input type="hidden" name="default_enable" value="1" />
		<input type="submit" value="<?php echo $module_i18n[$lang]['startxdebug']; ?>" alt="<?php echo $module_i18n[$lang]['startxdebug']; ?>" title="<?php echo $module_i18n[$lang]['startxdebug']; ?>" class="start" />
	</form>
	
<?php } elseif ($xdebug_array['xdebug.default_enable'] == 1) { ?>

	<form method="post" action="<?php echo $action; ?>" style="float:right;padding:0px;margin:0px;cursor:pointer">
		<input type="hidden" name="default_enable" value="0" />
		<input type="hidden" name="auto_trace" value="0" />
		<input type="hidden" name="profiler_enable" value="0" />
		<input type="submit" value="<?php echo $module_i18n[$lang]['stopxdebug']; ?>" alt="<?php echo $module_i18n[$lang]['stopxdebug']; ?>" title="<?php echo $module_i18n[$lang]['stopxdebug']; ?>" class="stop" />
	</form>
	
<?php } 

echo '<br style="clear:both;" />';

if ($xdebug_array['xdebug.default_enable'] == 1) { ?>

	<div style="clear:both;padding:15px 0px 0px 20px;margin:2px;">
		<div style="float:left;width:40px;">Trace</div>
		
		<?php if ($xdebug_array['xdebug.auto_trace'] == 0) { ?>
		
			<form method="post" action="<?php echo $action; ?>" style="float:left;padding:0px;margin:0px;">
				<input type="hidden" name="auto_trace" value="1" />
				<input type="submit" value="<?php echo $module_i18n[$lang]['start']; ?>" alt="<?php echo $module_i18n[$lang]['start']; ?>" title="<?php echo $module_i18n[$lang]['start']; ?>" class="start" style="width:60px;" />
			</form>
			
		<?php } elseif ($xdebug_array['xdebug.auto_trace'] == 1) { ?>
		
			<form method="post" action="<?php echo $action; ?>" style="float:left;padding:0px;margin:0px;">
				<input type="hidden" name="auto_trace" value="0" />
				<input type="submit" value="<?php echo $module_i18n[$lang]['stop']; ?>" alt="<?php echo $module_i18n[$lang]['stop']; ?>" title="<?php echo $module_i18n[$lang]['stop']; ?>" class="stop" style="width:60px;" />
			</form>
			
		<?php } ?>
		
		<div style="float:left;width:30px;text-align:right;font-style:italic;color:gray;"><img src="../modules/xdebugmanager/images/directory.png" width="16" height="11" alt="Trace folder" /></div>		
		<div style="float:left;margin:0px;padding:0px;"><input value=<?php echo $trace_dir;?> type="text" readonly="readonly" style="font-family:arial, helvetica, sans-serif;color:#808080;font-style:normal;margin:0px 0px 0px 0px;padding:0px 0px 0px 0px;width:450px;border:0px;font-size:100%;background-color:#EEEEEE;-moz-border-radius: 2px;-khtml-border-radius: 2px;-webkit-border-radius: 2px;border-radius: 2px;" /></div>
		<div style="float:right;color:gray;font-size:10px;width:130px;margin:0px;padding:0px;text-align:right;"><?php echo count($trace_files) . " " . $module_i18n[$lang]['files'] . " / " . $trace_dir_size; ?></div>
	</div>
	
	
	<div style="clear:both;padding:2px 0px 5px 20px;margin:2px;">
		<div style="float:left;width:40px;">Profiler</div>
		
		<?php if ($xdebug_array['xdebug.profiler_enable'] == 0) { ?>
		
			<form method="post" action="<?php echo $action; ?>" style="float:left;padding:0px;margin:0px;">
				<input type="hidden" name="profiler_enable" value="1" />
				<input type="submit" value="<?php echo $module_i18n[$lang]['start']; ?>" alt="<?php echo $module_i18n[$lang]['start']; ?>" title="<?php echo $module_i18n[$lang]['start']; ?>"  class="start" style="width:60px;" />
			</form>
			
		<?php } elseif ($xdebug_array['xdebug.profiler_enable'] == 1) { ?>
		
			<form method="post" action="<?php echo $action; ?>" style="float:left;padding:0px;margin:0px;">
				<input type="hidden" name="profiler_enable" value="0" />
				<input type="submit" value="<?php echo $module_i18n[$lang]['stop']; ?>" alt="<?php echo $module_i18n[$lang]['stop']; ?>" title="<?php echo $module_i18n[$lang]['stop']; ?>"  class="stop" style="width:60px;" />
			</form>	
			
		<?php } ?>
		
		<div style="float:left;width:30px;text-align:right;font-style:italic;color:gray;"><img src="../modules/xdebugmanager/images/directory.png" width="16" height="11" alt="Profiler folder" /></div>	
		<div style="float:left;margin:0px;padding:0px;"><input value=<?php echo $profiler_dir; ?> type="text" readonly="readonly" style="font-family:arial, helvetica, sans-serif;color:#808080;font-style:normal;margin:0px 0px 0px 0px;padding:0px 0px 0px 0px;width:450px;border:0px;font-size:100%;background-color:#EEEEEE;-moz-border-radius: 2px;-khtml-border-radius: 2px;-webkit-border-radius: 2px;border-radius: 2px;" /></div>
		<div style="float:right;color:gray;font-size:10px;width:130px;margin:0px;padding:0px;text-align:right;"><?php echo count($profiler_files) . " " . $module_i18n[$lang]['files'] . " / " . $profiler_dir_size; ?></div>
	</div>
	<br style="clear:both"; />
	
<?php } ?>