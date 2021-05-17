<?php
// Section HTML, displayed before the first option

function style_section_text_fn() {
	?>
	<h2>Default CSS (styling) values:</h2>
	<p>These are the default CSS settings and associated classes for all thermometers on the site.</p>
	N.B. Text colors can be defined using the <i>fill</i> property, for example: fill: #32373c;
	<?php
}

function target_style_fn($options) {
	$value = (isset(get_option('thermometer_style')[$options['type']])) ? get_option('thermometer_style')[$options['type']] : $options['default'];
	echo "<div class='form-item'><label for='targetStyle'></label>";
	echo '<textarea type="text" id="'.$options['type'].'" style="width: 400px;" name="thermometer_style['.$options['type'].']">'.sanitize_text_field($value)."</textarea>";
	echo "<br/>Default: <code>".sanitize_text_field($options['default'])."</code></div>";
}
function raised_style_fn($options) {
	$value = (isset(get_option('thermometer_style')[$options['type']])) ? get_option('thermometer_style')[$options['type']] : $options['default'];
	echo "<div class='form-item'><label for='raisedStyle'></label>";
	echo '<textarea type="text" id="'.$options['type'].'" style="width: 400px;" name="thermometer_style['.$options['type'].']">'.sanitize_text_field($value)."</textarea>";
	echo "<br/>Default: <code>".sanitize_text_field($options['default'])."</code></div>";
}
function percent_style_fn($options) {
	$value = (isset(get_option('thermometer_style')[$options['type']])) ? get_option('thermometer_style')[$options['type']] : $options['default'];
	echo "<div class='form-item'><label for='percentStyle'></label>";
	echo '<textarea type="text" id="'.$options['type'].'" style="width: 400px;" name="thermometer_style['.$options['type'].']">'.sanitize_text_field($value)."</textarea>";
	echo "<br/>N.B. The plugin automatically calculates this font-size depending on the value length. If you want to override this, use the <i>!important</i> rule.";
	echo "<br/>Default: <code>".sanitize_text_field($options['default'])."</code></div>";
}
function subTarget_style_fn($options) {
	$value = (isset(get_option('thermometer_style')[$options['type']])) ? get_option('thermometer_style')[$options['type']] : $options['default'];
	echo "<div class='form-item'><label for='subTargetStyle'></label>";
	echo '<textarea type="text" id="'.$options['type'].'" style="width: 400px;" name="thermometer_style['.$options['type'].']">'.sanitize_text_field($value)."</textarea>";
	echo "<br/>Default: <code>".sanitize_text_field($options['default'])."</code></div>";
}
function legend_style_fn($options) {
	$value = (isset(get_option('thermometer_style')[$options['type']])) ? get_option('thermometer_style')[$options['type']] : $options['default'];
	echo "<div class='form-item'><label for='legendStyle'></label>";
	echo '<textarea type="text" id="'.$options['type'].'" style="width: 400px;" name="thermometer_style['.$options['type'].']">'.sanitize_text_field($value)."</textarea>";
	echo "<br/>Default: <code>".sanitize_text_field($options['default'])."</code></div>";
}
function border_style_fn($options) {
	$value = (isset(get_option('thermometer_style')[$options['type']])) ? get_option('thermometer_style')[$options['type']] : $options['default'];
	echo "<div class='form-item'><label for='borderStyle'></label>";
	echo '<textarea type="text" id="'.$options['type'].'" style="width: 400px;" name="thermometer_style['.$options['type'].']">'.sanitize_text_field($value)."</textarea>";
	echo "<br/>Default: <code>".sanitize_text_field($options['default'])."</code></div>";
}
function fill_style_fn($options) {
	$value = (isset(get_option('thermometer_style')[$options['type']])) ? get_option('thermometer_style')[$options['type']] : $options['default'];
	echo "<div class='form-item'><label for='fillStyle'></label>";
	echo '<textarea type="text" id="'.$options['type'].'" style="width: 400px;" name="thermometer_style['.$options['type'].']">'.sanitize_text_field($value)."</textarea>";
	echo "<br/>Default: <code>".sanitize_text_field($options['default'])."</code></div>";
}
function majorTick_style_fn($options) {
	$value = (isset(get_option('thermometer_style')[$options['type']])) ? get_option('thermometer_style')[$options['type']] : $options['default'];
	echo "<div class='form-item'><label for='majorTickStyle'></label>";
	echo '<textarea type="text" id="'.$options['type'].'" style="width: 400px;" name="thermometer_style['.$options['type'].']">'.sanitize_text_field($value)."</textarea>";
	echo "<br/>Default: <code>".sanitize_text_field($options['default'])."</code></div>";
}
function minorTick_style_fn($options) {
	$value = (isset(get_option('thermometer_style')[$options['type']])) ? get_option('thermometer_style')[$options['type']] : $options['default'];
	echo "<div class='form-item'><label for='minorTickStyle'></label>";
	echo '<textarea type="text" id="'.$options['type'].'" style="width: 400px;" name="thermometer_style['.$options['type'].']">'.sanitize_text_field($value)."</textarea>";
	echo "<br/>Default: <code>".sanitize_text_field($options['default'])."</code></div>";
}

	
function help_section_text_fn() {
	?>
	<h3>Basic usage & sizing</h3>
	<p>Thermometers can be placed in a page, post or widget with the shortcode <code>[thermometer]</code>. Default values for the amount raised and target can be set on the settings tab or in the shortcode:
	<code>[thermometer raised=1523 target=5000]</code>.<br/>
	Individual thermometers can be sized using <code>height=200</code> (pixels), or <code>width=20%</code> (percentage of parent container). Set only width OR height as the aspect ratio remains constant.
	
	<h3>Independent shortcode parameters</h3>
	<p>
		These additional parameters can be used within the <code>[thermometer]</code> shortcode to construct unique thermometers. Examples show the default settings:
	</p>
	<p><ul>
		<li><b>target:</b> the target value can be removed from individual thermometers by placing ';off' after the last value: <code>target=500;off</code></li>
		<li><b>raised:</b> the raised value can be removed from individual thermometers by placing ';off' after the last value: <code>raised=250;off</code>. Custom shortcodes can also be used here (without brackets): <code>raised='sc name="dyn_raised"'</code></li>
		<li><b>targetlabels:</b> sub target labels can be on/off (will disappear to avoid overlap with raised value): <code>targetlabels=on</code></li>
		<li><b>fill:</b> custom fill color (hex values): <code>fill=#d7191c</code></li>
		<li><b>align:</b> alignment within the parent container (left/right/center): <code>align=left</code></li>
		<li><b>sep:</b> thousands separator: <code>sep=,</code></li>
		<li><b>currency:</b> raised/target value units: <code>currency=$</code> (or <code>currency=null</code>)</li>
		<li><b>trailing:</b> currency symbols follow numeric values (true/false): <code>trailing=false</code></li>
		<li><b>alt:</b> the default alt and title attributes of the image can be modified, or toggled off. Use apostrophes to input a custom string: <code>alt='Raised £1523 towards the £2000 target.'</code> (or <code>alt=off</code>)</li>
		<li><b>ticks:</b> alignment of ticks and the raised value (left/right): <code>ticks=right</code></li>
		<li><b>colorRamp:</b> the sequence of fill colors (hex values) used for multiple categories: <code>colorRamp='#d7191c; #fdae61; #abd9e9; #2c7bb6'</code></li>
		<li><b>percentColor:</b> the color of the percentage value: <code>percentColor=#000000</code></li>
		<li><b>targetColor:</b> the color of the target value: <code>targetColor=#000000</code></li>
		<li><b>raisedColor:</b> the color of the raised value: <code>raisedColor=#000000</code></li>
		<li><b>subTargetColor:</b> the color of the sub-target values: <code>subTargetColor=#000000</code></li>
		</ul>
	</p>
	
	<h3>Multiple categories/targets</h3>
	<p><ul>
		<li>The total raised in the thermometer can be partitioned into multiple categories by separating raised values with a semicolon (bottom to top):<br/><code>[thermometer raised=732;234;100]</code>.</li>
		<li>The colors for each category are set using the default global option below, or can be set for individual thermometers using the <code>colorRamp</code> parameter, separating hex values using a semicolon:<br/>
			<code>[thermometer raised=732;234;100 colorRamp='#d7191c; #fdae61; #abd9e9']</code>.</li>
		<li>Incrementing target levels can be set by separating values with a semicolon (bottom to top):<br/><code>[thermometer raised=500 target=600;1000]</code>.</li>
		<li>A legend can be placed below the thermometer by defining labels separated by semicolons (bottom to top):<br/><code>legend='Source A; Source B; Source C'</code>.</li>
	</p>
	
	<h3>Custom CSS</h3>
	<p>
		You can further customise each SVG element of the thermometer using CSS code from the tab above. These edits will apply to all thermometers on the site.<br/> 		
		If you want to apply custom CSS rules to thermometers on individual pages/posts then you can <a href="https://wordpress.org/plugins/wp-add-custom-css/" target="_blank">use a plugin such as this</a>.
	</p>
	<?php
}


function preview_section_text_fn() {
	?>
	<p><b>Shortcode example</b>:<br/>So far we have raised £<code>[therm_r]</code> towards our £<code>[therm_t]</code> target! That's <code>[therm_%]</code> of the total!<br/>
	<?php
	echo 'So far we have raised £'.do_shortcode('[therm_r]').' towards our £'.do_shortcode('[therm_t]').' target! That\'s '.do_shortcode('[therm_%]').' of the total!'
	?>
	</p>
	<p>Based on the plugin settings defined on this options page, the shortcode <code>[thermometer]</code> will produce an SVG image like this:</p>
	
	<?php
	echo do_shortcode('[thermometer]');
}

function  section_text_fn() {
	?>
	<h2>Default plugin values:</h2>
	<p>These are the default settings for all thermometers on the site, unless modified within the <code>[thermometer]</code> shortcode independently:</p>
	<?php
	
}


// TEXTBOX - Name: plugin_options[fill_colour]
function fill_colour_fn($options) {
	$value = (isset(get_option('thermometer_options')[$options['type']])) ? get_option('thermometer_options')[$options['type']] : $options['default'];
	echo "<div class='form-item' style='display: inline;'>";
	echo '<input id="'.$options['type'].'" type="text" name="thermometer_options['.$options['type'].']" value="'.sanitize_text_field($value).'" class="colorwell"/>';
	echo "  e.g., red hex value = <code>#d7191c</code>";
	echo '<div id="picker" style="display: inline; position: absolute; margin-left:100px;"></div>';
}

// DROP-DOWN-BOX - Name: plugin_options[currency]
function  setting_dropdown_fn($options) {
	$value = (isset(get_option('thermometer_options')[$options['type']])) ? get_option('thermometer_options')[$options['type']] : $options['default'];
	echo '<input id="'.$options['type'].'" type="text" size="5" name="thermometer_options['.$options['type'].']" value="'.sanitize_text_field($value).'" />';
	echo ' define a custom global currency value (also works by entering <code>currency=$</code> in the shortcode)';
}
    
function  setting_thousands_fn($options) {
	$value = (isset(get_option('thermometer_options')[$options['type']])) ? get_option('thermometer_options')[$options['type']] : $options['default'];
	$sep = substr(sanitize_text_field($value),0,1);
	$items = array(", (comma)",". (point)"," (space)","(none)");
	echo '<select id="'.$options['type'].'" name="thermometer_options['.$options['type'].']">';
	foreach($items as $item) {
		$selected = (substr($item,0,1)==$sep) ? 'selected="selected"' : '';
		echo "<option value='".$item."' ".$selected.">$item</option>";
	}
	echo "</select>";
	echo "  ie. £1,000 or €1.000 or $1000";
}


// tick alignment
function  tick_align_fn($options) {
	$value = (isset(get_option('thermometer_options')[$options['type']])) ? get_option('thermometer_options')[$options['type']] : $options['default'];
	$items = array("right","left");
	echo '<select id="'.$options['type'].'" name="thermometer_options['.$options['type'].']">';
	foreach($items as $item) {
		$selected = ($item == sanitize_text_field($value)) ? 'selected="selected"' : '';
		echo "<option value='".$item."' ".$selected.">$item</option>";
	}
	echo "</select>";
	echo ' the raised value will also shift accordingly';
}

// CHECK-BOX - Name: thermometer_options[trailing]
function setting_trailing_fn($options) {
	$value = (isset(get_option('thermometer_options')[$options['type']])) ? get_option('thermometer_options')[$options['type']] : $options['default'];
	$items = array("false","true");
	echo '<select id="'.$options['type'].'" name="thermometer_options['.$options['type'].']">';
	foreach($items as $item) {
		$selected = ($item == sanitize_text_field($value)
					 or (sanitize_text_field($value) == '1' && $item == 'true')
					 or (sanitize_text_field($value) == '2' && $item == 'false')
					 or (sanitize_text_field($value) == '0' && $item == 'false')) ? 'selected="selected"' : '';
		echo "<option value='".$item."' ".$selected.">$item</option>";
	}
	echo "</select>";
	echo "  ie. £1,000 (false) or 1.000 NOK (true)";
}

// CHECKBOX - Name: plugin_options[chkbox1] show percentage
function setting_chk1_fn($options) {
	$value = (isset(get_option('thermometer_options')[$options['type']])) ? get_option('thermometer_options')[$options['type']] : $options['default'];
	$items = array("true","false");
	echo '<select id="'.$options['type'].'" name="thermometer_options['.$options['type'].']">';
	foreach($items as $item) {
		$selected = ($item == sanitize_text_field($value)
					 or (sanitize_text_field($value) == '1' && $item == 'true')
					 or (sanitize_text_field($value) == '0' && $item == 'false')) ? 'selected="selected"' : '';
		echo "<option value='".$item."' ".$selected.">$item</option>";
	}
	echo "</select>";
}
// TEXTBOX - Name: plugin_options[text_colour] 
function text_colour_fn($options) {
	$value = (isset(get_option('thermometer_options')[$options['type']])) ? get_option('thermometer_options')[$options['type']] : $options['default'];
	echo "<div class='form-item'>";
	echo '<input id="'.$options['type'].'" type="text" name="thermometer_options['.$options['type'].']" value="'.sanitize_text_field($value).'" class="colorwell" />';
	echo "  e.g., black hex value = <code>#000000</code>";
}
// CHECKBOX - Name: plugin_options[chkbox2] show target
function setting_chk2_fn($options) {
	$value = (isset(get_option('thermometer_options')[$options['type']])) ? get_option('thermometer_options')[$options['type']] : $options['default'];
	$items = array("true","false");
	echo '<select id="'.$options['type'].'" name="thermometer_options['.$options['type'].']">';
	foreach($items as $item) {
		$selected = ($item == sanitize_text_field($value)
					 or (sanitize_text_field($value) == '1' && $item == 'true')
					 or (sanitize_text_field($value) == '0' && $item == 'false')) ? 'selected="selected"' : '';
		echo "<option value='".$item."' ".$selected.">$item</option>";
	}
	echo "</select>";
}

// CHECKBOX - Name: plugin_options[targetlabels] show sub-targets
function setting_chk4_fn($options) {
	$value = (isset(get_option('thermometer_options')[$options['type']])) ? get_option('thermometer_options')[$options['type']] : $options['default'];
	$items = array("true","false");
	echo '<select id="'.$options['type'].'" name="thermometer_options['.$options['type'].']">';
	foreach($items as $item) {
		$selected = ($item == sanitize_text_field($value)
					 or (sanitize_text_field($value) == '1' && $item == 'true')
					 or (sanitize_text_field($value) == '0' && $item == 'false')) ? 'selected="selected"' : '';
		echo "<option value='".$item."' ".$selected.">$item</option>";
	}
	echo "</select>";
	echo " sub-target values adjacent to the thermometer";
}

// TEXTBOX - Name: plugin_options[subtarget_colour] 
function subtarget_colour_fn($options) {
	$value = (isset(get_option('thermometer_options')[$options['type']])) ? get_option('thermometer_options')[$options['type']] : $options['default'];
	echo "<div class='form-item'>";
	echo '<input id="'.$options['type'].'" type="text" name="thermometer_options['.$options['type'].']" value="'.sanitize_text_field($value).'" class="colorwell"/>';
	echo "  e.g., grey hex value = <code>#8a8a8a</code>";
}

// CHECKBOX - Name: plugin_options[chkbox3] show raised
function setting_chk3_fn($options) {
	$value = (isset(get_option('thermometer_options')[$options['type']])) ? get_option('thermometer_options')[$options['type']] : $options['default'];
	$items = array("true","false");
	echo '<select id="'.$options['type'].'" name="thermometer_options['.$options['type'].']">';
	foreach($items as $item) {
		$selected = ($item == sanitize_text_field($value)
					 or (sanitize_text_field($value) == '1' and $item == 'true')
					 or (sanitize_text_field($value) == '0' and $item == 'false')) ? 'selected="selected"' : '';
		echo "<option value='".$item."' ".$selected.">$item</option>";
	}
	echo "</select>";
} 
// TEXTBOX - Name: plugin_options[target_colour] 
function target_colour_fn($options) {
	$value = (isset(get_option('thermometer_options')[$options['type']])) ? get_option('thermometer_options')[$options['type']] : $options['default'];
	echo "<div class='form-item'>";
	echo '<input id="'.$options['type'].'" type="text" name="thermometer_options['.$options['type'].']" value="'.sanitize_text_field($value).'" class="colorwell" />';
	echo "  e.g., black hex value = <code>#000000</code>";
}
// TEXTBOX - Name: plugin_options[raised_colour] 
function raised_colour_fn($options) {
	$value = (isset(get_option('thermometer_options')[$options['type']])) ? get_option('thermometer_options')[$options['type']] : $options['default'];
	echo "<div class='form-item'>";
	echo '<input id="'.$options['type'].'" type="text" name="thermometer_options['.$options['type'].']" value="'.sanitize_text_field($value).'" class="colorwell" />';
	echo "  e.g., black hex value = <code>#000000</code>";
}
// TEXTBOX - Name: plugin_options[color_ramp]
function color_ramp_fn($options) {
	$value = (isset(get_option('thermometer_options')[$options['type']])) ? get_option('thermometer_options')[$options['type']] : $options['default'];
	echo '<textarea id="color_ramp" rows="3" col="15" name="thermometer_options['.$options['type'].']" style="margin-right: 20px;">'.sanitize_text_field($value).'</textarea>';
	echo "<div id='rampPreview' style='display: inline-block;'></div>";
	echo '<p>a list of hex colors for multiple thermometer categories (bottom to top), separated by semicolons<br/>
	(e.g., <code>#d7191c; #fdae61; #abd9e9; #2c7bb6</code>).
	This default color ramp is red-green color-blind friendly. Source: <a href="http://colorbrewer2.org" target="_blank">ColorBrewer 2.0</a>.</p>';

}
// TEXTBOX - Name: plugin_options[target_string]
function target_string_fn($options) {
	$value = (isset(get_option('thermometer_options')[$options['type']])) ? get_option('thermometer_options')[$options['type']] : $options['default'];
	echo '<input id="'.$options['type'].'" type="text" name="thermometer_options['.$options['type'].']" value="'.sanitize_text_field($value).'" />';
	echo ' separate incrementing target values with a semi-colon for multiple categories. <code>[therm_t]</code>';
}
// TEXTBOX - Name: plugin_options[raised_string]
function raised_string_fn($options) {
	$value = (isset(get_option('thermometer_options')[$options['type']])) ? get_option('thermometer_options')[$options['type']] : $options['default'];
	echo '<input id="'.$options['type'].'" type="text" name="thermometer_options['.$options['type'].']" value="'.sanitize_text_field($value).'" />';
	echo '  separate raised values with a semi-colon for multiple categories. <code>[therm_r]</code> is cumulative.
	<p><b>Shortcode example</b>: So far we have raised £<code>[therm_r]</code> towards our £<code>[therm_t]</code> target! That\'s <code>[therm_%]</code> of the total!</p>';


}

// Validate user data for some/all of your input fields
function thermometer_options_validate($input) {

	// Check for missed entries - input default
	if (empty($input['colour_picker1']) || strlen($input['colour_picker1']) !=  7){
		$input['colour_picker1'] = '';
	}
	if (empty($input['colour_picker2']) || strlen($input['colour_picker2']) !=  7){
	    $input['colour_picker2'] = '';
	}
	if (empty($input['colour_picker3']) || strlen($input['colour_picker3']) !=  7){
	    if (empty($input['colour_picker4'])){
			$input['colour_picker3'] = '';
	    }
	    else{
			$input['colour_picker3'] = ($input['colour_picker4']); // if 4 not empty make the same
	    }
	}
	if (empty($input['colour_picker4']) || strlen($input['colour_picker4']) !=  7){
	    $input['colour_picker4'] = '';
	}
	
	return $input; // return validated input
}


?>
