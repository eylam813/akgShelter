<?php

	/**
	 * Manages plugin customization
	 */

	class WS_Form_Customize {

		public function __construct($wp_customize) {

			// Add WS Form panel
			self::add_panel($wp_customize);

			// Add sections, settings and controls
			self::add_sections($wp_customize);

			// Add scripts
			wp_add_inline_script('customize-controls', self::customize_controls_after());
		}

		public function add_panel($wp_customize) {

			$wp_customize->add_panel('wsform_panel', array(

				'priority'       	=> 200,
				'theme_supports'	=> '',
				'title'          	=> __('WS Form', 'ws-form'),
			));
		}

		public function add_sections($wp_customize) {

			// Get customize
			$sections = WS_Form_Config::get_customize();

			// Run through each group
			foreach($sections as $section_id => $section) {

				$section_id = WS_FORM_OPTION_PREFIX . '_section_' . $section_id;

				// Add section
				$wp_customize->add_section(

					$section_id,

					array(
						'title'    => $section['heading'],
						'priority' => 10,
						'panel'    => 'wsform_panel',
					)
				);

				$fields = $section['fields'];

				foreach($fields as $field_id => $field) {

					$setting_id = WS_FORM_OPTION_PREFIX . '[' . $field_id . ']';
					$control_id = WS_FORM_OPTION_PREFIX . '_control_' . $field_id;

					switch($field['type']) {

						case 'checkbox' :

							$wp_customize->add_setting(

								$setting_id,

								array(
									'default'           => isset($field['default']) ? $field['default'] : '',
									'type'              => 'option',
									'sanitize_callback' => array($this, 'sanitize_callback_checkbox'),
								)
							);

						default :

							$wp_customize->add_setting(

								$setting_id,

								array(
									'default'           => isset($field['default']) ? $field['default'] : '',
									'type'              => 'option'
								)
							);
					}

					switch($field['type']) {

						case 'select' :

							$wp_customize->add_control(

								$control_id,

								array(
									'label'			=> $field['label'],
									'description'	=> isset($field['description']) ? $field['description'] : '',
									'section'		=> $section_id,
									'settings'		=> $setting_id,
									'type'			=> 'select',
									'choices'		=> $field['choices']
								)
							);

							break;

						case 'color' :

							$wp_customize->add_control(

								new WP_Customize_Color_Control( 

									$wp_customize, 
									$control_id,

									array(
										'label'			=> $field['label'],
										'description'	=> isset($field['description']) ? $field['description'] : '',
										'section'		=> $section_id,
										'settings'		=> $setting_id,
									)
								)
							);

							break;

						default :

							$wp_customize->add_control(

								$control_id,

								array(
									'label'       => $field['label'],
									'description' => isset($field['description']) ? $field['description'] : '',
									'section'     => $section_id,
									'settings'    => $setting_id,
									'type'        => $field['type']
								)
							);
					}
				}
			}
		}

		public function sanitize_callback_checkbox( $checked ) {

			// Boolean check (Have to use strings because WordPress saves false as 1 in preview pane)
			return ((isset($checked) && true == $checked) ? 'true' : 'false');
		}

		public function customize_controls_after() {

			// Work out which form to use for the preview
			$form_id = intval(WS_Form_Common::get_query_var('wsf_preview_form_id'));
			if($form_id === 0) {

				// Find a default form to use
				$ws_form_form = new WS_Form_Form();
				$form_id = $ws_form_form->db_get_preview_form_id();
			}

			// Determine if we should automatically open the WS Form panel
			$wsf_panel_open = WS_Form_Common::get_query_var('wsf_panel_open');

			$return_script = "wp.customize.bind('ready', function() {\n";

			if($form_id > 0) {

				$form_preview_url = WS_Form_Common::get_preview_url($form_id);
				$return_script .= sprintf("	wp.customize.previewer.previewUrl('%s');\n", esc_js($form_preview_url));
			}

			if($wsf_panel_open === 'true') {

				$return_script .= "	wp.customize.panel('wsform_panel').expand();\n";
			}

			$return_script .= '});';

			return $return_script;
		}
	}
