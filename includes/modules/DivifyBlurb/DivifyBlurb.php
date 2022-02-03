<?php

class DIVIFY_Blurb extends ET_Builder_Module {

	public $slug       = 'divify_blub_world';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => 'https://github.com/chigozieorunta/divify',
		'author'     => 'Chigozie Orunta',
		'author_uri' => 'https://linkedin.com/in/chigozieorunta',
	);

	public function init() {
		$this->name = esc_html__( 'Divify Blurb', 'divi-divify' );
	}

	public function get_fields() {
		return array(
			'content' => array(
				'label'           => esc_html__( 'Content', 'divi-divify' ),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Content entered here will appear inside the module.', 'divi-divify' ),
				'toggle_slug'     => 'main_content',
			),
		);
	}

	public function render( $attrs, $content = null, $render_slug ) {
		return sprintf( '<h1>Hello %1$s</h1>', $this->props['content'] );
	}
}

new DIVIFY_Blurb;
