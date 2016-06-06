<?php
/**
 * Handles custom post meta boxes for the projects post type.
 *
 * @package   Cherry_Projects
 * @author    Cherry Team
 * @license   GPL-2.0+
 * @link      http://www.cherryframework.com/
 * @copyright 2014 Cherry Team
 */

class Cherry_Projects_Meta_Boxes {

	/**
	 * Holds the instances of this class.
	 *
	 * @since 1.0.0
	 * @var   object
	 */
	private static $instance = null;

	/**
	 * [$metabox_format description]
	 * @var null
	 */
	public $metabox_format = null;

	/**
	 * Sets up the needed actions for adding and saving the meta boxes.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		// Initialization of modules.
		add_action( 'after_setup_theme', array( $this, 'init' ), 10 );
	}

	/**
	 * Run initialization of modules.
	 *
	 * @since 1.0.0
	 */
	public function init() {
		$prefix = CHERRY_PROJECTS_POSTMETA;

		cherry_projects()->get_core()->init_module( 'cherry-post-meta', array(
			'id'			=> 'projects-settings',
			'title'			=> esc_html__( 'Projects settings', '__tm' ),
			'page'			=> array( CHERRY_PROJECTS_NAME ),
			'context'		=> 'normal',
			'priority'		=> 'high',
			'callback_args'	=> false,
			'fields'		=> array(
				$prefix . '_details' => array(
					'type'        => 'repeater',
					'label'       => esc_html__( 'Projects Details', 'cherry-projects' ),
					'add_label'   => esc_html__( 'Add Projects Details', 'cherry-projects' ),
					'title_field' => 'detail_label',
					'fields'      => array(
						'detail_label'       => array(
							'type'        => 'text',
							'id'          => 'detail_label',
							'name'        => 'detail_label',
							'placeholder' => esc_html__( 'Enter label', 'cherry-projects' ),
							'label'       => esc_html__( 'Detail Label', 'cherry-projects' ),
						),
						'detail_info'         => array(
							'type'        => 'text',
							'id'          => 'detail_info',
							'name'        => 'detail_info',
							'placeholder' => esc_html__( 'Enter info', 'cherry-projects' ),
							'label'       => esc_html__( 'Detail Info', 'cherry-projects' ),
						),
					),
				),
				$prefix . '_skills' => array(
					'type'        => 'repeater',
					'label'       => esc_html__( 'Projects skills', 'cherry-projects' ),
					'add_label'   => esc_html__( 'Add Skill', 'cherry-projects' ),
					'title_field' => 'detail_label',
					'fields'      => array(
						'skill_label'     => array(
							'type'        => 'text',
							'id'          => 'skill_label',
							'name'        => 'skill_label',
							'placeholder' => esc_html__( 'Skill label', 'cherry-projects' ),
							'label'       => esc_html__( 'Skill Label', 'cherry-projects' ),
						),
						'skill_value'         => array(
							'type'        => 'slider',
							'id'          => 'skill_value',
							'name'        => 'skill_value',
							'label'       => esc_html__( 'Skill Value', 'cherry-projects' ),
						),
					),
				),
			),
		) );

		cherry_projects()->get_core()->init_module( 'cherry-post-meta', array(
			'id'            => 'image-format-settings',
			'title'         => esc_html__( 'Image Format Options', '__tm' ),
			'page'          => array( CHERRY_PROJECTS_NAME ),
			'context'       => 'normal',
			'priority'      => 'high',
			'callback_args' => false,
			'fields'        => array(
				$prefix . '_image_attachments_ids' => array(
					'type'          => 'media',
					'label'         => esc_html__( 'Additional images', 'cherry-projects' ),
					'description'   => esc_html__( 'Select attachments images', 'cherry-projects' ),
					'display_image' => true,
					'multi_upload'  => true,
					'upload_button_text' => __( 'Add images', 'cherry-projects' ),
					'library_type'  => 'image',
				),
				$prefix . '_listing_layout' => array(
					'type'			=> 'radio',
					'label'			=> esc_html__( 'Image listing layout', 'cherry-projects' ),
					'value'			=> 'grid-layout',
					'class'			=> '',
					'display_input'	=> false,
					'options'	=> array(
						'grid-layout' => array(
							'label'		=> esc_html__( 'Grid', 'cherry-projects' ),
							'img_src'	=> CHERRY_PROJECTS_URI . 'public/assets/images/svg/list-layout-grid.svg',
							'slave'		=> 'projects-listing-layout-grid-layout',
						),
						'masonry-layout' => array(
							'label'		=> esc_html__( 'Masonry', 'cherry-projects' ),
							'img_src'	=> CHERRY_PROJECTS_URI . 'public/assets/images/svg/list-layout-masonry.svg',
							'slave'		=> 'projects-listing-layout-masonry-layout',
						),
					),
				),
				$prefix . '_column_number' => array(
					'type'			=> 'slider',
					'label'			=> esc_html__( 'Column number', 'cherry-projects' ),
					'max_value'		=> 10,
					'min_value'		=> 1,
					'value'			=> 3,
				),
				$prefix . '_image_margin' => array(
					'type'			=> 'slider',
					'label'			=> esc_html__( 'Image margin', 'cherry-projects' ),
					'max_value'		=> 30,
					'min_value'		=> 0,
					'value'			=> 10,
				),
			),
		) );

		cherry_projects()->get_core()->init_module( 'cherry-post-meta', array(
			'id'            => 'gallery-format-settings',
			'title'         => esc_html__( 'Gallery Format Options', '__tm' ),
			'page'          => array( CHERRY_PROJECTS_NAME ),
			'context'       => 'normal',
			'priority'      => 'high',
			'callback_args' => false,
			'fields'        => array(
				$prefix . '_slider_attachments_ids' => array(
					'type'          => 'media',
					'label'         => esc_html__( 'Gallery images', 'cherry-projects' ),
					'description'   => esc_html__( 'Select gallery images', 'cherry-projects' ),
					'display_image' => true,
					'multi_upload'  => true,
					'upload_button_text' => __( 'Add images', 'cherry-projects' ),
					'library_type'  => 'image',
				),
				$prefix . '_slider_navigation' => array(
					'type'				=> 'switcher',
					'value'				=> 'true',
					'label'				=> esc_html__( 'Use navigation?', 'cherry-projects' ),
				),
				$prefix . '_slider_loop' => array(
					'type'				=> 'switcher',
					'value'				=> 'true',
					'label'				=> esc_html__( 'Use infinite scrolling?', 'cherry-projects' ),
				),
				$prefix . '_slider_thumbnails_position' => array(
					'type'			=> 'radio',
					'label'			=> esc_html__( 'Thumbnails position', 'cherry-projects' ),
					'value'			=> 'bottom',
					'display-input'	=> true,
					'options'		=> array(
						'top' => array(
							'label' => esc_html__( 'Top', 'cherry-projects' ),
						),
						'bottom' => array(
							'label' => esc_html__( 'Bottom', 'cherry-projects' ),
						),
						'right' => array(
							'label' => esc_html__( 'Right', 'cherry-projects' ),
						),
						'left' => array(
							'label' => esc_html__( 'Left', 'cherry-projects' ),
						),
					),
				),
			),
		) );
	}

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @return object
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}
}

Cherry_Projects_Meta_Boxes::get_instance();