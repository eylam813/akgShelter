<?php
/////////////////////////////// shortcode stuff...
		
function thermometer_graphic($atts){
	$atts = (shortcode_atts(
		array(
			'width' => '',
			'height' => '',
			'align' => '',
			'target' => '',
			'raised' => '',
			'alt' =>'',
			'currency' =>'',
			'sep' =>'',
			'trailing' =>'',
			'fill' =>'',
			'colorramp' => '',
			'legend' => '',
			'ticks' => '',
			'targetlabels' => '',
			'percentcolor' => '',
			'targetcolor' => '',
			'raisedcolor' => '',
			'subtargetcolor' => ''			
		), $atts));
	global $thermDefaults;
	$options = wp_parse_args( get_option('thermometer_options',$thermDefaults), $thermDefaults);
	$thermProperties = array();
	//width
		//width value
	if($atts['width'] != '' && $atts['height'] != ''){
	    return '<p style="color:red;">Use only width OR height parameter values.</p>';
	}
	
	if (!empty($atts['width'])){
	    $thermProperties['width'] = $atts['width'];
		$thermProperties['height'] = '';
	}
	else{
		$thermProperties['width'] = "200";
		$thermProperties['height'] = '';
	}

	//height
	if (!empty($atts['height'])){
	    $thermProperties['height'] = $atts['height'];
		$thermProperties['width'] = '';
	}
	elseif(empty($atts['height']) && !empty($atts['width'])){
		$thermProperties['width'] = $atts['width'];
		$thermProperties['height'] = '';
	}
	else{
		$thermProperties['height'] = "533";
		$thermProperties['width'] = '';
	}
	//currency value to use
	if (empty($atts['currency'])){
	    $thermProperties['currency'] = $options['currency'];
	}
	elseif(strtolower($atts['currency']) == 'null'){ //get user to enter null for no value
	    $thermProperties['currency'] = '';
	}
	else{
	    $thermProperties['currency'] = $atts['currency']; //set currency to default or shortcode value
	}
	
	//target value
	if ($atts['target'] == '' && !empty($options['target_string'])){
	    $thermProperties['target'] = $options['target_string'];
	}
	elseif($atts['target'] == 'off'){
	    $thermProperties['target'] = $options['target_string'].';'.strval($atts['target']);
	}
	else{
		$thermProperties['target'] = strval($atts['target']);
	}
	
	//sub target labels
	if (!empty($atts['targetlabels'])){
	    $thermProperties['targetlabels'] = ($atts['targetlabels'] == 'off') ? 0 : 1;
	}
	else{
		$thermProperties['targetlabels'] = ($options['targetlabels'] == 'true') ? 1 : 0;
	}
	
	
	//raised value
	if ($atts['raised'] == '' && !empty($options['raised_string'])){
	    $thermProperties['raised'] = $options['raised_string'];
	}
	else{
        // if shortcode present
		if (!is_numeric(str_replace(",", ".", $atts['raised'])) && (strpos($atts['raised'], ';') === false) ) {
			$shortcode = "[".strval($atts['raised'])."]";
			$atts['raised'] = do_shortcode( $shortcode);
		}
	    $thermProperties['raised'] = strval($atts['raised']);
	}
	
	//align position
	if (strtolower($atts['align']) == 'center' || strtolower($atts['align']) == 'centre'){
	    $thermProperties['align'] = 'display:block; margin-left:auto; margin-right:auto;';
	}
	elseif (strtolower($atts['align']) == 'left'){
	    $thermProperties['align'] = 'display:block; float:left;';
	}
	elseif (!empty($atts['align'])){
	    $thermProperties['align'] = 'display:block; float:'.strtolower($atts['align']).';';
	}
	else{
		$thermProperties['align'] = 'display:block; float:left;';
	}

	
	//thousands separator
	if(!empty($atts['sep'])){
	    $thermProperties['sep'] = $atts['sep'];
	}
	else{
		if($options['thousands'] == ' (space)'){
			$thermProperties['sep'] = ' ';
		}
		elseif($options['thousands'] == '(none)'){
			$thermProperties['sep'] = '';
		}
		else{
			$thermProperties['sep'] = substr($options['thousands'],0,1);
		}
	}
	if(empty($atts['fill'])){
	    $thermProperties['fill'] = $options['colour_picker1'];
	}
	else{
	    $thermProperties['fill'] = $atts['fill'];
	}
	
	// currency before or after number
	if(strtolower($atts['trailing']) == 'true'){
		$thermProperties['trailing'] = 'true';
	}
	elseif(strtolower($atts['trailing']) == 'false'){
		$thermProperties['trailing'] = 'false';
	}
	elseif(isset($options['trailing']) && ($options['trailing'] == "on" or $options['trailing'] == "true")){
		$thermProperties['trailing'] = 'true';
	}
	else{
		$thermProperties['trailing'] = 'false';
	}
	
	//title text
	if (!empty($atts['alt'])){
	    $thermProperties['title'] = $atts['alt'];
	}
	else{
	    $thermProperties['title'] = '';
	}	
	
	//legend
	if(!empty($atts['legend'])){
	    $thermProperties['legend'] = $atts['legend'];
	}
	else{
		$thermProperties['legend'] = '';
	}
	
	//tick alignment
	if(!empty($atts['ticks'])){
	    $thermProperties['ticks'] = $atts['ticks'];
	}
	else{
		$thermProperties['ticks'] = $options['tick_align'];
	}
	
	// color ramp
	if(!empty($atts['colorramp'])){
	    $thermProperties['colorList'] = $atts['colorramp'];
	}
	else{
	    $thermProperties['colorList'] = $options['color_ramp'];
	}

	$thermProperties['showPercent'] = ($options['chkbox1'] == 1 or $options['chkbox1'] == 'true') ? 1 : 0;
	$thermProperties['showTarget'] = ($options['chkbox2'] == 1 or $options['chkbox2'] == 'true') ? 1 : 0;
	$thermProperties['showRaised'] = ($options['chkbox3'] == 1 or $options['chkbox3'] == 'true') ? 1 : 0;
	
	$thermProperties['percentageColor'] = (empty($atts['percentcolor'])) ? $options['colour_picker2'] : $atts['percentcolor'];
	$thermProperties['targetColor'] = (empty($atts['targetcolor'])) ? $options['colour_picker3'] : $atts['targetcolor'];
	$thermProperties['raisedColor'] = (empty($atts['raisedcolor'])) ? $options['colour_picker4'] : $atts['raisedcolor'];
	$thermProperties['subtargetColor'] = (empty($atts['subtargetcolor'])) ? $options['colour_picker5'] : $atts['subtargetcolor'];
	//print_r($thermProperties);
	//print_r($atts);
    // create a custom thermometer from shortcode parameters
	return thermhtml($thermProperties);
}

add_shortcode( 'thermometer','thermometer_graphic');

/*
// Additional shortcodes 
*/

add_shortcode( 'therm_r','therm_raised');

function therm_raised(){
	global $thermDefaults;
    $options = wp_parse_args( get_option('thermometer_options',$thermDefaults), $thermDefaults);
    $raisedA = explode(';',$options['raised_string']);
	$raised = array_sum($raisedA);
    if($options['thousands'] == ' (space)'){
		$sep = ' ';
	}
	elseif($options['thousands'] == '(none)'){
		$sep = '';
	}
	else{
		$sep = substr($options['thousands'],0,1);
	}
    if ($raised != ''){
		$raisedA = explode(';',$raised);
		if (end($raisedA) == 'off'){
			array_splice($raisedA,-1);
		}

		$raised = end($raisedA);
		return number_format($raised, 0,'.',$sep);
	}
    else{
	return '<b>[Value missing on settings page]</b>';
    }
}

add_shortcode( 'therm_t','therm_target');

function therm_target(){
	global $thermDefaults;
    $options = wp_parse_args( get_option('thermometer_options',$thermDefaults), $thermDefaults);
    $target = $options['target_string'];
    if($options['thousands'] == ' (space)'){
		$sep = ' ';
	}
	elseif($options['thousands'] == '(none)'){
		$sep = '';
	}
	else{
		$sep = substr($options['thousands'],0,1);
	}
    if ($target != ''){
		$targetA = explode(';',$target);
		if (end($targetA) == 'off'){
			array_splice($targetA,-1);
		}

		$target = end($targetA);
		return number_format($target, 0,'.',$sep);
	}
    else{
		return '<b>[Value missing on settings page]</b>';
    }
}


add_shortcode( 'therm_%','therm_percent');

function therm_percent(){
	$target = therm_target();
	$raised = therm_raised();
	$div = (int) str_replace(',', '', $raised) / (int) str_replace(',', '', $target);
    return ($target > 0) ? number_format(($div * 100),0).'%' : 'unknown%';
}
?>