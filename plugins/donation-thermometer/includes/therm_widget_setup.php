<?PHP

class Thermometer_dashboard_widget{
	/**
     * The id of this widget.
     */
    const wid = 'thermometer_widget';

    /**
     * Hook to wp_dashboard_setup to add the widget.
     */
	
	public static function therm_widget_init() {
        
        //Register the widget...
		


        wp_add_dashboard_widget(
            self::wid,                                  //A unique slug/ID
            __( 'Donation Thermometer', 'nouveau' ),//Visible name for the widget
            array('Thermometer_dashboard_widget','therm_widget'),      //Callback for the main widget content
            array('Thermometer_dashboard_widget','therm_widget_config')       //Optional callback for widget configuration content
        );
    }

    /**
     * Load the widget code
     */
    public static function therm_widget() {
        require_once( 'therm_widget.php' );
    }

    public static function therm_widget_config() {
        require_once( 'therm_widget-config.php' );
    }

    public static function get_thermometer_widget_option($option, $default=NULL ) {
		global $defaults;
		$opts = wp_parse_args( get_option('thermometer_options',$defaults), $defaults);
        //$opts = self::get_thermometer_widget_options($widget_id);

        //If widget opts dont exist, return false
        if ( ! $opts )
            return false;

        //Otherwise fetch the option or use default
        if ( isset( $opts[$option] ) && ! empty($opts[$option]) )
            return $opts[$option];
        /*else
            return ( isset($default) ) ? $default : false;*/

    }

    /**
     * Saves an array of options for a single dashboard widget to the database.
     * Can also be used to define default values for a widget.
     *
     * @param string $widget_id The name of the widget being updated
     * @param array $args An associative array of options being saved.
     * @param bool $add_only If true, options will not be added if widget options already exist
     */
    public static function update_thermometer_widget_options($args=array(), $add_only=false )
    {
        //Fetch ALL dashboard widget options from the db...
        global $defaults;
		$opts = wp_parse_args( get_option('thermometer_options',$defaults), $defaults);

		//Merge new options with existing ones, and add it back to the widgets array
		$opts = array_merge($opts,$args);

        //Save the entire widgets array back to the db
        return update_option('thermometer_options', $opts); //also gets validated below
    }
}
?>