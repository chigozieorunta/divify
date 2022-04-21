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

			$post_image   = $image[0];
			$post_title   = get_the_title( $post->ID );
			$post_excerpt = get_the_excerpt( $post->ID );
			$post_url     = get_the_permalink( $post->ID );

			$post_image = sprintf( 
				'<a href="%2$s"><img src="%1$s"></a>',
				$post_image,
				$post_url
			);

			$post_title = sprintf( 
				'<a href="%2$s">%1$s</a>',
				$post_title,
				$post_url
			);

			$post_details = sprintf(
				'<div><h3>%1$s</h3><div>%2$s</div></div>',
				$post_title,
				$post_excerpt
			);

			$custom_posts .= sprintf( 
				'<div>%1$s%2$s</div>',
				$post_image,
				$post_details
			);

		}

		return $custom_posts;
	}

	public function render( $unprocessed_props, $content, $render_slug ) {
		return sprintf(
			'<section class="combo-box">%1$s</section>',
			$this->get_custom_posts()
		);
	}
}

new ComboBox;