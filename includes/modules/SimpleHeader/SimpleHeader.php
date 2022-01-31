<?php

class SIMP_SimpleHeader extends ET_Builder_Module {

	public $slug       = 'simp_simple_header';
	public $vb_support = 'on';

	public function init() {
		$this->name = esc_html__( 'Simple Header', 'simp-simple-extension' );
	}

	public function get_fields() {
		return array(
			'heading'     => array(
				'label'           => esc_html__( 'Heading', 'simp-simple-extension' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Input your desired heading here.', 'simp-simple-extension' ),
				'toggle_slug'     => 'main_content',
			),
			'content'     => array(
				'label'           => esc_html__( 'Content', 'simp-simple-extension' ),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Content entered here will appear below the heading text.', 'simp-simple-extension' ),
				'toggle_slug'     => 'main_content',
			),
		);
	}

	public function render( $unprocessed_props, $content = null, $render_slug ) {
		return sprintf(
			'<h1 class="simp-simple-header-heading">%1$s</h1>
			<p>%2$s</p>',
			esc_html( $this->props['heading'] ),
			$this->props['content']
		);
	}
}

new SIMP_SimpleHeader;