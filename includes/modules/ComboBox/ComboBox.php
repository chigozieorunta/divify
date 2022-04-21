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

	public function get_custom_post_types() {
		$args = array(
			'public' => true,
		);

		$post_types = get_post_types( $args, 'objects' );
 
		foreach ( $post_types as $post_type_obj ) {
			$labels = get_post_type_labels( $post_type_obj );

			$options[$post_type_obj->name] = esc_html__( $labels->name , 'combo-box' );
		}

		return $options;
	}

	public function get_fields() {
		return array(
			'post_type' => array(
				'label'           => esc_html__( 'Post Type', 'combo-box' ),
				'type'            => 'select',
				'option_category' => 'basic_option',
				'options'         => $this->get_custom_post_types(),
				'description'     => esc_html__( 'Select your desired custom post type', 'combo-box' ),
				'toggle_slug'     => 'main_content',
			)
		);
	}

	public function get_custom_posts() {
		$query = new WP_Query( array( 'post_type' => $this->props['post_type'] ) );
		$posts = $query->posts;

		foreach($posts as $post) {

			$image = wp_get_attachment_image_src( 
				get_post_thumbnail_id( $post->ID ), 
				'medium'
			);

			$post_image = $image[0];
			$post_title = get_the_title( $post->ID );

			$custom_posts .= sprintf( 
				'<div><img src="%1$s"><p>%2$s</p></div>',
				$post_image,
				$post_title
			);

		}

		return $custom_posts;
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