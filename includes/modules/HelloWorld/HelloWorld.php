<?php

class UAD_HelloWorld extends ET_Builder_Module {

	public $slug       = 'uad_hello_world';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => 'http://localhost/dev/',
		'author'     => 'Mangesh Sonule',
		'author_uri' => '',
	);

	public function init() {
		$this->name = esc_html__( 'Hello World', 'uad-my-extension' );
		$this->advanced_fields = array(
			'borders'               => array(
				'default' => false,
			),
			'box_shadow'           => array(
				// Text Shadow settings are already included on button's advanced style
				'default' => false,
			),
			'module'           => array(
				// Text Shadow settings are already included on button's advanced style
				'default' => false,
			),
		);
	}
	public function get_fields() {
		return array(
			'heading'     => array(
				'label'           => esc_html__( 'Heading', 'uad-my-extension' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Input your desired heading here.', 'uad-my-extension' ),
				'toggle_slug'     => 'main_content',
			),
			'content' => array(
				'label'           => esc_html__( 'Content', 'uad-my-extension' ),
				'type'            => 'tiny_mce',
				//'option_category' => 'basic_option',
				'description'     => esc_html__( 'Content entered here will appear inside the module.', 'uad-my-extension' ),
				'toggle_slug'     => 'main_content',
			),
			'icon' => array(
				'label'               => esc_html__( 'Icon', 'uad-my-extension' ),
				'type'                => 'select_icon',
				'option_category'     => 'basic_option',
				'class'               => array( 'uad-font-icon' ),
				'toggle_slug'         => 'main_content',
				'description'         => esc_html__( 'Choose an icon to display with your text.', 'uad-my-extension' ),
				'hover'               => 'tabs',
				//'default'	=> 'P',
				//'default_on_front' => 'P',
			),
			'icon_color_uad' => array(
				'label'             => esc_html__( 'Icon Color', 'uad-my-extension' ),
				'description'       => esc_html__( 'icon color', 'uad-my-extension' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'icon',
				'hover'             => 'tabs',
				'mobile_options'    => true,
			),
			'title_text_color' => array(
				'label'             => esc_html__( 'Title Text Color', 'uad-my-extension' ),
				'description'       => esc_html__( 'You can pick unique text colors for Heading. Choose the open state title color here.', 'uad-my-extension' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'toggle',
				'hover'             => 'tabs',
				'mobile_options'    => true,
			),
			// 'open_toggle_background_color' => array(
			// 	'label'             => esc_html__( 'Open Toggle Background Color', 'uad-my-extension' ),
			// 	'description'       => esc_html__( 'You can pick unique background colors for toggles when they are in their open and closed states. Choose the open state background color here.', 'uad-my-extension' ),
			// 	'type'              => 'color-alpha',
			// 	'custom_color'      => true,
			// 	'tab_slug'          => 'advanced',
			// 	'toggle_slug'       => 'toggle_layout',
			// 	'hover'             => 'tabs',
			// 	'mobile_options'    => true,
			// ),
			'description_text_color' => array(
				'label'             => esc_html__( 'Description Text Color', 'uad-my-extension' ),
				'description'       => esc_html__( 'You can pick unique text colors for description.', 'uad-my-extension' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'toggle',
				'hover'             => 'tabs',
				'mobile_options'    => true,
			),
			// 'closed_toggle_background_color' => array(
			// 	'label'             => esc_html__( 'Closed Toggle Background Color', 'uad-my-extension' ),
			// 	'description'       => esc_html__( 'You can pick unique background colors for toggles when they are in their open and closed states. Choose the closed state background color here.', 'uad-my-extension' ),
			// 	'type'              => 'color-alpha',
			// 	'custom_color'      => true,
			// 	'tab_slug'          => 'advanced',
			// 	'toggle_slug'       => 'toggle_layout',
			// 	'hover'             => 'tabs',
			// 	'mobile_options'    => true,
			// ),
		);
	}

	public function render( $attrs, $content = null, $render_slug ) {
		//$title_text_color = $this->props['title_text_color'];
		$title_text_color = et_pb_responsive_options()->get_property_values( $this->props, 'title_text_color' );
		et_pb_responsive_options()->generate_responsive_css( $title_text_color, '%%order_class%% .uad_hello_world .uad-heading',
		'color', $render_slug,' !important;', 'color' );
		//var_dump( $title_text_color );

		// if ( '' !== $title_text_color ) {
		// 	ET_Builder_Element::set_style( $render_slug, array(
		// 		'selector'    => '%%order_class%%.uad_hello_world .uad-headingh1',
		// 		'declaration' => sprintf(
		// 			'color: %1$s;',
		// 			esc_html( $title_text_color )
		// 		),
		// 	) );
		// }
		$multi_view                      = et_pb_multi_view_options( $this );
			// vl( $multi_view );
		$icon = $multi_view->render_element( array(
			'tag'     => 'span',
			'content' => '{{icon}}',
			'attrs'   => array(
				'class' => 'uad-icon',
			),
		) );
			//vl($icon );
		return sprintf( '<div class="uad-wrap">%1$s</i><h1 class="uad-heading">%2$s</h1><p>%3$s</p></div>', 
		$icon,$this->props['heading'],
		$this->props['content'] );
	}
	public function multi_view_filter_value( $raw_value, $args, $multi_view ) {
		$name = isset( $args['name'] ) ? $args['name'] : '';
		$mode = isset( $args['mode'] ) ? $args['mode'] : '';
		// vl( $raw_value && 'icon' === $name );
		if ( $raw_value && 'icon' === $name ) {
			$processed_value = html_entity_decode( et_pb_process_font_icon( $raw_value ) );
			// vl( $processed_value );
			vl( '%%1%%' === $raw_value );
			if ( '%%1%%' === $raw_value ) {
				$processed_value = "\"";
			}
			// vl( $processed_value );
			return $processed_value;
		}

		$fields_need_escape = array(
			'button_text',
		);

		if ( $raw_value && in_array( $name, $fields_need_escape, true ) ) {
			return $this->_esc_attr( $multi_view->get_name_by_mode( $name, $mode ) );
		}
		// vl( $raw_value );
		return $raw_value;
	}
}

new UAD_HelloWorld;
