<?php
/**
 * This file could be used to catch submitted form data. When using a non-configuration
 * view to save form data, remember to use some kind of identifying field in your form.
 */

if(self::get_thermometer_widget_option('thousands') == ' (space)'){
	$sep = ' ';
}
elseif(self::get_thermometer_widget_option('thousands') == '(none)'){
	$sep = '';
}
else{
	$sep = substr(self::get_thermometer_widget_option('thousands'),0,1);
}

$raisedA = explode(';',self::get_thermometer_widget_option('raised_string'));
$raised = array_sum($raisedA);
$targetA = explode(';',self::get_thermometer_widget_option('target_string'));
$target = array_sum($targetA);
$currency = self::get_thermometer_widget_option('currency');
$trailing = self::get_thermometer_widget_option('trailing');
?>
<p>Target amount: <b><span style="color: <?php echo self::get_thermometer_widget_option('colour_picker3'); ?>;" title="Target text color on thermometers = <?php echo self::get_thermometer_widget_option('colour_picker3'); ?>">
<?php
if($trailing == 'false'){
    echo $currency.number_format($target,0,'.',$sep);
}
else{
    echo number_format($target,0,'.',$sep).$currency;
}?>
</b>
<span style="padding-left: 40px;" title="Use this shortcode to insert the target value in posts/pages">Shortcode: <code style="font-family: monospace;">[therm_t]</code></span></p></p>

<p>Total raised: <b><span style="color: <?php echo self::get_thermometer_widget_option('colour_picker4'); ?>;" title="Raised text color on thermometers = <?php echo self::get_thermometer_widget_option('colour_picker4'); ?>">
<?php
if($trailing == 'false'){
        echo $currency.number_format($raised,0,'.',$sep);
}
else{
    echo number_format($raised,0,'.',$sep).$currency;
}?>
</span></b>
<span style="padding-left: 40px;" title="Use this shortcode to insert the raised value in posts/pages">Shortcode: <code style="font-family: monospace;">[therm_r]</code></span></p>

<p>Percent raised: <b><span style="color: <?php echo self::get_thermometer_widget_option('colour_picker2'); ?>;" title="Percent raised text color on thermometers = <?php echo self::get_thermometer_widget_option('colour_picker2'); ?>">
<?php

echo ($target > 0) ? number_format(($raised/$target * 100),0).'%' : 'unknown%';

?>
</span></b>
<span style="padding-left: 40px;" title="Use this shortcode to insert the percent raised value in posts/pages">Shortcode: <code style="font-family: monospace;">[therm_%]</code></span></p>



<p style="font-style: italic;font-size: 9pt;">To change these global values, hover over the widget title and click on the "Configure</span>" link, or visit the <a href="options-general.php?page=thermometer-settings.php&tab=settings">plugin settings</a> page.</p>

