<?php

class MyGallery extends ET_Builder_Module {
	/**
	 * Private instance of MyGallery
	 *
	 * @var array
	 */
	private $photos = [];

	/**
	 * Module Slug
	 *
	 * @var string
	 */
	public $slug = 'my_gallery';

	/**
	 * VB Support
	 *
	 * @var string
	 */
	public $vb_support = 'on';

	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function init() {
		$this->name = esc_html__( 'My Gallery', 'my-gallery' );

		add_action( 'wp_enqueue_scripts', function() {
			wp_enqueue_style( 'my-gallery', plugin_dir_url( __FILE__ ). './gallery.css' );
			wp_enqueue_script( 'my-gallery', plugin_dir_url( __FILE__ ).  './gallery.js', array( 'jquery' ) );
		});
	}

	/**
	 * Get Fields
	 *
	 * @return string
	 */
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

	/**
	 * Get Photos
	 *
	 * @return string
	 */
	public function get_photos() {
		$query = new WP_Query( array( 'post_type' => 'gallery' ) );
		$posts = $query->posts;

		foreach($posts as $post) {

			if ( has_post_thumbnail( $post->ID ) ) {

				$image = wp_get_attachment_image_src( 
					get_post_thumbnail_id( $post->ID ), 
					'full'
				);

				$photo_image = $image[0];
				$photo_title = get_the_title( $post->ID );

				$photos .= sprintf( 
					'<li><img src="%1$s"><p>%2$s</p></li>',
					$photo_image,
					$photo_title
				);

			}

		}
		return $photos;
	}

	/**
	 * Get Left Arrow
	 *
	 * @return string
	 */
	public function get_overlay_left_arrow() {
		return sprintf(
			'<span class="my-gallery-arrow-left">%1$s</span>',
			'<'
		);
	}

	/**
	 * Get Right Arrow
	 *
	 * @return string
	 */
	public function get_overlay_right_arrow() {
		return sprintf(
			'<span class="my-gallery-arrow-right">%1$s</span>',
			'>'
		);
	}

	/**
	 * Get Overlay
	 *
	 * @return string
	 */
	public function get_overlay() {
		return sprintf( 
			'%1$s%3$s%2$s',
			$this->get_overlay_left_arrow(),
			$this->get_overlay_right_arrow(),
			'<img src=""/>'
		);
	}

	/**
	 * Render Method for Divi plugin
	 *
	 * @param object $unprocessed_props Props.
	 * @param string $content Content.
	 * @param string $render_slug Slug.
	 *
	 * @return string
	 */
	public function render( $unprocessed_props, $content, $render_slug ) {
		return sprintf(
			'<h1 class="my-gallery-heading">%1$s</h1>
			<div class="my-gallery-content">%2$s</div>
			<div class="my-gallery-overlay">%3$s</div>
			<div class="my-gallery-close-btn">%5$s</div>
			<ul class="my-gallery">%4$s</ul>',
			esc_html( $this->props['heading'] ),
			$this->props['content'],
			$this->get_overlay(),
			$this->get_photos(),
			esc_html( 'X' )
		);
	}
}

new MyGallery;