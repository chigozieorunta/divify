<?php

class ComboBox extends ET_Builder_Module {

	public $slug       = 'combo_box';
	public $vb_support = 'on';

	public function init() {
		$this->name = esc_html__( 'Combo Box', 'combo-box' );

		add_action( 'wp_enqueue_scripts', function() {
			wp_enqueue_style( 'combo-box', './combo-box.css' );
		});
	}

	public function get_fields() {
		return array(
			'heading'     => array(
				'label'           => esc_html__( 'Heading', 'combo-box' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Input your desired heading here.', 'combo-box' ),
				'toggle_slug'     => 'main_content',
			),
			'content'     => array(
				'label'           => esc_html__( 'Content', 'combo-box' ),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Content entered here will appear below the heading text.', 'combo-box' ),
				'toggle_slug'     => 'main_content',
			),
		);
	}

	public function get_cpt() {
		$query = new WP_Query( array( 'post_type' => 'property' ) );
		$posts = $query->posts;

		foreach($posts as $post) {

			if ( has_post_thumbnail( $post->ID ) ) {

				$image = wp_get_attachment_image_src( 
					get_post_thumbnail_id( $post->ID ), 
					'medium'
				);

				$photo_image = $image[0];
				$photo_title = get_the_title( $post->ID );

				$photos .= sprintf( 
					'<div><img src="%1$s"><p>%2$s</p></div>',
					$photo_image,
					$photo_title
				);

			}

		}
		return $photos;
	}

	public function render( $unprocessed_props, $content, $render_slug ) {
		return sprintf(
			'<h1 class="combo-box-heading">%1$s</h1>
			<div class="combo-box-content">%2$s</div>
			<div class="combo-box">%3$s</div>',
			esc_html( $this->props['heading'] ),
			$this->props['content'],
			$this->get_cpt()
		);
	}
}

new ComboBox;