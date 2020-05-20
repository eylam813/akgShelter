(function($, blocks, editor, element, components) {
 
 	const el = element.createElement;
 
	const { registerBlockType } = blocks;
 
	const { InspectorControls } = editor;
	const { Fragment, RawHTML } = element;
	const { Panel, PanelBody, PanelRow, SelectControl, Placeholder, Button } = components;

	// Buld icon
 	const icon = el(

		'svg',
		{ width: 20, height: 20 },
		el(
			'path',
			{ fill: '#002E5D', d: 'M0 0v20h20V0zm8.785 13.555h-.829l-1.11-4.966c-.01-.036-.018-.075-.026-.115l-.233-1.297h-.014l-.104.574-.17.838-1.147 4.966h-.836L2.57 6.224h.703l.999 4.27.466 2.23h.044q.133-.966.43-2.243l.998-4.257h.74l1.006 4.27q.119.48.422 2.23h.044q.022-.223.219-1.121t1.254-5.379h.695zm5.645-.389a2.105 2.105 0 0 1-1.54.524 3.26 3.26 0 0 1-.961-.129 2.463 2.463 0 0 1-.644-.283l.309-.534a1.274 1.274 0 0 0 .416.186 2.78 2.78 0 0 0 .925.152 1.287 1.287 0 0 0 .977-.372 1.377 1.377 0 0 0 .355-.993 1.313 1.313 0 0 0-.255-.821 3.509 3.509 0 0 0-.973-.76 6.51 6.51 0 0 1-1.121-.757 2.121 2.121 0 0 1-.466-.635 1.94 1.94 0 0 1-.167-.838A1.67 1.67 0 0 1 11.87 6.6a2.161 2.161 0 0 1 1.487-.517 2.76 2.76 0 0 1 1.567.446l-.31.534a2.425 2.425 0 0 0-1.287-.372 1.422 1.422 0 0 0-.991.334 1.132 1.132 0 0 0-.37.882 1.298 1.298 0 0 0 .252.814 3.792 3.792 0 0 0 1.065.794 6.594 6.594 0 0 1 1.095.767 1.896 1.896 0 0 1 .44.635 2.076 2.076 0 0 1 .144.8 1.94 1.94 0 0 1-.532 1.45zm2.375.598a.671.671 0 1 1 .672-.671.671.671 0 0 1-.672.67zm0-3.242a.671.671 0 1 1 .672-.671.671.671 0 0 1-.672.67zm0-3.284a.671.671 0 1 1 .672-.672.671.671 0 0 1-.672.672z' }
		)
	);

 	const loader = el(

 		'svg',
 		{ width: 64, height: 64, viewBox: '0 0 91.3 91.1', className: 'wsf-block-loader' },
		el(
			'circle',
			{ fill: '#a3a3a3', cx: '45.7', cy: '45.7', r: '45.7' },
		),
		el(
			'circle',
			{ fill: '#fff', cx: '45.7', cy: '24.4', r: '12.5' }
		)
 	);

	registerBlockType('wsf-block/form-add', {

		title: wsf_settings_block.form_add.label,

		icon: icon,

		category: wsf_settings_block.form_add.category,

		keywords: wsf_settings_block.form_add.keywords,

		description: wsf_settings_block.form_add.description,

		supports: {

			html: false,
		},

		attributes: {

			form_id: {

				type: 'string'
			},

			preview: {

				type: 'boolean'
			}
		},

		example: {

			attributes: {

				'preview' : true,
			}
		},

		edit: function (props) {

			// Show preview SVG
			var preview = props.attributes.preview;
			if(preview) {

				return(

					el('div', { className: 'wsf-block-form-add-preview' }, 

						el(RawHTML, null, wsf_settings_block.form_add.preview)
					)
				);
			}

			// Get attribute values
			var form_id = props.attributes.form_id;

			// Create form selector options
			var options = [];

			// Select... option
			options.push({

				value: 0,
				label: wsf_settings_block.form_add.options_select
			});

			// Add forms to options
			var form_id_found = false;
			var form_count = 0;
			for(var form_index in wsf_settings_block.forms) {

				var form = wsf_settings_block.forms[form_index];

				if(form.id == form_id) { form_id_found = true; }

				options.push({

					value: form.id,
					label: form.label + ' (' + wsf_settings_block.form_add.id + ': ' + form.id + ')'
				});

				form_count++;
			}
			if(!form_id_found) {

				form_id = 0;
				props.setAttributes({form_id: form_id});
			}

			function fragment_rendered(props) {

				var ws_props = props;

				// Show loader, hide form, delete any messages
				$('.block-editor [data-type="wsf-block/form-add"').each(function() {

					$('svg.wsf-block-loader', $(this)).show();
					$('form', $(this)).hide();
					$('[data-wsf-message]', $(this)).remove();
				});

				// Hate using setTimeout, but apparently no way of firing this after the block is fully re-renedered
				setTimeout(function() {

					// Set data-id
					var id = 'block-' + props.clientId;
					var block_wrapper_obj = $('#' + id);
					$('form.wsf-form', block_wrapper_obj).attr('data-id', form_id);

					// Reset each form
					var instance_id = 1;
					$('.wsf-form').each(function() {

						$(this).html('').attr('data-instance-id', instance_id).attr('id', 'ws-form-' + instance_id);
						instance_id++;
					});

					// Render each form
					$('.wsf-form').each(function() {

						// Reset events and HTML
						$(this).off().html('');

						// Get attributes
						var id = $(this).attr('id');
						var form_id = $(this).attr('data-id');
						var instance_id = $(this).attr('data-instance-id');

						if(id && form_id && instance_id) {

							// Render form
							var ws_form = new $.WS_Form();
							window.wsf_form_instances[instance_id] = ws_form;

							ws_form.render({

								'obj' : 		'#' + id,
								'form_id':		form_id
							});
						}
					});

					// Hide loader, show form
					$('.block-editor [data-type="wsf-block/form-add"').each(function() {

						$('svg.wsf-block-loader', $(this)).hide();
						$('form', $(this)).show();
					});


				}, 200);
			}

			return (

				el(Fragment, {},

					// Sidebar
					el(InspectorControls, {},

						el(Panel, {

							title: 'test'
						}, 

							el(PanelBody, {

								title: wsf_settings_block.form_add.label,

								initialOpen: true
							},

								// Form selector
								el(SelectControl, {

									label: wsf_settings_block.form_add.options_label,

									value: form_id,

									options: options,

									onChange: (value) => { props.setAttributes({form_id: value}); }
								}),

								// Add new form button
								el(Button, {

									isSecondary: true,
									href: wsf_settings_block.form_add.url_add

								}, wsf_settings_block.form_add.add)
							)
						)
					),

					// Block

					(form_count == 0) ? el(Placeholder, {

						// Render no form placeholder
						icon: icon,

						label: wsf_settings_block.form_add.label,

						instructions: wsf_settings_block.form_add.no_forms

					},

						// Add new form button
						el(Button, {

							isSecondary: true,
							href: wsf_settings_block.form_add.url_add

						}, wsf_settings_block.form_add.add)

					) : parseInt(form_id) ? el('div', null, 

						// Render WS Form
						el('form', {

							action: wsf_settings_block.form_add.form_action,
							className: 'wsf-form wsf-form-canvas',
							method: 'POST'

						}),

						loader

					// If form ID not set
					) : el(Placeholder, {

						// Render no form selected
						icon: icon,

						label: wsf_settings_block.form_add.label,

						instructions: wsf_settings_block.form_add.form_not_selected
					}),

					fragment_rendered(props)
				)
			);
		},

		save: function () { null; }
	});
})(
	jQuery,
	window.wp.blocks,
	window.wp.blockEditor,
	window.wp.element,
	window.wp.components
);

