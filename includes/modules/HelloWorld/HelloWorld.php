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
				'description'     => esc_html__( 'Content entered here will appear inside the module.', 'uad-my-extension' ),
				'toggle_slug'     => 'main_content',
			),
			'icon' => array(
				'label'               => esc_html__( 'Icon', 'uad-my-extension' ),
				'type'                => 'select_icon',
				'option_category'     => 'basic_option',
				'toggle_slug'         => 'main_content',
				'description'         => esc_html__( 'Choose an icon to display with your text.', 'uad-my-extension' ),
				'hover'               => 'tabs',
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
		);
	}

	public function render( $attrs, $content = null, $render_slug ) {

		$icon_color_uad = $this->props['icon_color_uad'];
		$title_text_color = $this->props['title_text_color'];
		ET_Builder_Element::set_style( $render_slug, array(
			'selector'    => '%%order_class%% .uad-wrap .uad-heading',
			'declaration' => sprintf(
				'color: %1$s;',
				esc_attr( $title_text_color )
			),
		) );

		ET_Builder_Element::set_style( $render_slug, array(
			'selector'    => '%%order_class%% .uad-wrap .uad-icon',
			'declaration' => sprintf(
				'color: %1$s;',
				esc_attr( $icon_color_uad )
			),
		) );

		$multi_view                      = et_pb_multi_view_options( $this );
			
		$icon = $multi_view->render_element( array(
			'tag'     => 'span',
			'content' => '{{icon}}',
			'attrs'   => array(
				'class' => 'uad-icon',
			),
		) );

		return sprintf( '<div class="uad-wrap">%1$s<h1 class="uad-heading">%2$s</h1><p>%3$s</p></div>', 
		$icon,$this->props['heading'],
		$this->props['content'] );
	}
	public function multi_view_filter_value( $raw_value, $args, $multi_view ) {
		$name = isset( $args['name'] ) ? $args['name'] : '';
		$mode = isset( $args['mode'] ) ? $args['mode'] : '';
		 
		if ( $raw_value && 'icon' === $name ) {

			$processed_value = html_entity_decode( et_pb_process_font_icon( $raw_value ) );

			return $processed_value;
		}

		return $raw_value;
	}
}

new UAD_HelloWorld;
