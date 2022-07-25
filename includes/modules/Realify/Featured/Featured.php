<?php

class Featured extends ET_Builder_Module {

	/**
	 * Module Slug
	 *
	 * @var string
	 */
	public $slug = 'realify_featured_module';

	/**
	 * VB Support
	 *
	 * @var string
	 */
	public $vb_support = 'on';

	/**
	 * Init function to fire when module loads
	 *
	 * @return void
	 */
	public function init() {
		$this->name = esc_html__( 'Realify Featured', 'realify-featured' );

		add_action( 'wp_enqueue_scripts', function() {
			wp_enqueue_style( 'realify-featured', plugin_dir_url( __FILE__ ). './featured.css' );
		});
	}

	/**
	 * Get all post types names and slugs
	 *
	 * @return array
	 */
	public function get_custom_post_types() {
		$args = array(
			'public' => true,
		);

		$post_types = get_post_types( $args, 'objects' );
 
		foreach ( $post_types as $post_type_obj ) {
			$labels = get_post_type_labels( $post_type_obj );

			$options[$post_type_obj->name] = esc_html__( $labels->name , 'realify-featured' );
		}

		return $options;
	}

	/**
	 * Get all categories of properties
	 *
	 * @return array
	 */
	public function get_categories() {
		$args = array(
			'taxonomy'   => 'property_category',
			'hide_empty' => false,
		);

		$custom_terms = get_terms( $args );

		foreach ( $custom_terms as $custom_term ) {
			$options .= sprintf( 
				'<option value="%1$s">%1$s</div>',
				esc_html__( $custom_term->name , 'realify-search' )
			);
		}

		$categories = sprintf(
			'<select name="property_category">
				<option>Property</option>
				%1$s
			</select>',
			$options
		);

		return $categories;
	}

	/**
	 * Get all locations of properties
	 *
	 * @return array
	 */
	public function get_locations() {
		$args = array(
			'taxonomy'   => 'property_city',
			'hide_empty' => false,
			'orderby'    => 'ID',
            'order'      => 'ASC',
		);

		$custom_terms = get_terms( $args );

		foreach ( $custom_terms as $custom_term ) {
			$options .= sprintf( 
				'<option value="%1$s">%1$s</div>',
				esc_html__( $custom_term->name , 'realify-search' )
			);
		}

		$locations = sprintf(
			'<select name="property_city">
				<option>Location</option>
				%1$s
			</select>',
			$options
		);

		return $locations;
	}

	/**
	 * Get Fields for user selection
	 *
	 * @return array
	 */
	public function get_fields() {
		return array(
			'post_type' => array(
				'label'           => esc_html__( 'Post Type', 'realify-search' ),
				'type'            => 'select',
				'option_category' => 'basic_option',
				'options'         => $this->get_custom_post_types(),
				'description'     => esc_html__( 'Select your desired custom post type', 'realify-search' ),
				'toggle_slug'     => 'main_content',
			),
			'result_page' => array(
				'label'           => esc_html__( 'Search Results Page', 'realify-search' ),
				'type'            => 'select',
				'option_category' => 'basic_option',
				'options'         => $this->get_pages(),
				'description'     => esc_html__( 'Select your desired result page', 'realify-search' ),
				'toggle_slug'     => 'main_content',
			),
		);
	}

	/**
	 * Get CPT data (title, featured image, permalink)
	 *
	 * @return string
	 */
	public function get_custom_posts() {
		$query = new WP_Query( array( 'post_type' => $this->props['post_type'] ) );
		$posts = $query->posts;

		foreach($posts as $post) {

			$image = wp_get_attachment_image_src( 
				get_post_thumbnail_id( $post->ID ), 
				'large'
			);

			$post_image   = $image[0];
			$post_title   = get_the_title( $post->ID );
			$post_excerpt = get_the_excerpt( $post->ID );
			$post_url     = get_the_permalink( $post->ID );

			$custom_posts .= sprintf(
				'<li>
					<a href="%1$s">
						<div class="realify_featured__img" style="background-image: url(%2$s);">
						</div>
						<div class="realify_featured__title">
							<h2>%3$s</h2>
							<p>
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
									<path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
									<path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
								</svg>
								<span>Lekki, Lagos</span>
							</p>
						</div>
					</a>
				</li>',
				$post_url,
				$post_image,
				$post_title
			);
		}

		return $custom_posts;
	}

	/**
	 * Render Method
	 *
	 * @param object $unprocessed_props
	 * @param string $content
	 * @param string $render_slug
	 * @return void
	 */
	public function render( $unprocessed_props, $content, $render_slug ) {
		return sprintf(
			'<ul class="realify_featured">
				%1$s
			</ul>',
			$this->get_custom_posts()
		);
	}
}

new Featured;