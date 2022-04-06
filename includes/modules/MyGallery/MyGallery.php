<?php

class MyGallery extends ET_Builder_Module {

	public $slug       = 'my_gallery';
	public $vb_support = 'on';

	public function init() {
		$this->name = esc_html__( 'My Gallery', 'my-gallery' );

		add_action( 'wp_enqueue_scripts', function() {
			wp_enqueue_style( 'my-gallery', './gallery.css' );
		});
	}

	public function get_fields() {
		return array(
			'heading'     => array(
				'label'           => esc_html__( 'Heading', 'my-gallery' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Input your desired heading here.', 'my-gallery' ),
				'toggle_slug'     => 'main_content',
			),
			'content'     => array(
				'label'           => esc_html__( 'Content', 'my-gallery' ),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Content entered here will appear below the heading text.', 'my-gallery' ),
				'toggle_slug'     => 'main_content',
			),
		);
	}

	public function get_photos() {
		$query = new WP_Query( array( 'post_type' => 'gallery' ) );
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

	public function register_api_endpoint() {
		register_rest_route(
			'divify/v1',
			'/my-gallery',
			array(
				'methods' => WP_REST_Server::READABLE,
				'callback' => [ $this, 'get_json_response' ],
				'permission_callback' => '__return_true'
			)
		);
	}

	public function render( $unprocessed_props, $content, $render_slug ) {
		return sprintf(
			'<h1 class="my-gallery-heading">%1$s</h1>
			<div class="my-gallery-content">%2$s</div>
			<div class="my-gallery">%3$s</div>',
			esc_html( $this->props['heading'] ),
			$this->props['content'],
			$this->get_photos()
		);
	}
}

new MyGallery;