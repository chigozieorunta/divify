<?php

class Search extends ET_Builder_Module {

	/**
	 * Module Slug
	 *
	 * @var string
	 */
	public $slug = 'realify_search_module';

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
		$this->name = esc_html__( 'Realify Search', 'realify-search' );

		add_action( 'wp_enqueue_scripts', function() {
			wp_enqueue_style( 'realify-search', plugin_dir_url( __FILE__ ). './search.css' );
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

			$options[$post_type_obj->name] = esc_html__( $labels->name , 'realify-search' );
		}

		return $options;
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
				'label'           => esc_html__( 'Result Page', 'realify-search' ),
				'type'            => 'select',
				'option_category' => 'basic_option',
				'options'         => $this->get_pages(),
				'description'     => esc_html__( 'Select your desired result page', 'realify-search' ),
				'toggle_slug'     => 'main_content',
			)
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
			'<form>
				<ul class="realify_search">
					<li>
						<select>
							<option>Property</option>
							<option>1 Room Apartment</option>
							<option>2 Room Apartment</option>
							<option>3 Room Apartment</option>
							<option>4 Room Apartment</option>
							<option>5 Room Apartment</option>
							<option>6 Room Apartment</option>
						</select>
					</li>
					<li>
						<select>
							<option>Location</option>
							<option>Lagos</option>
							<option>Abuja</option>
							<option>Port Harcourt</option>
							<option>Kano</option>
						</select>
					</li>
					<li>
						<select>
							<option>Budget (N)</option>
							<option>10 million</option>
							<option>25 million</option>
							<option>50 million</option>
							<option>75 million</option>
							<option>100 million</option>
						</select>
					</li>
					<li>
						<button type="submit">Search</button>
					</li>
				</ul>
			</form>',
			$this->get_custom_posts()
		);
	}
}

new Search;