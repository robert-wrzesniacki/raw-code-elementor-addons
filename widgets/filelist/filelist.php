<?php
namespace Elementor;


class FileList extends Widget_Base {
	/**
	 * Get widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'filelist';
	}

	/**
	 * Get widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return 'File List';
	}

	/**
	 * Get widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-file-download';
	}

	/**s
	 * Get widget categories.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'raw-code-plugin' ];
	}

	/**
	 * Register widget controls.
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		/**
		 *  Here you can add your controls. The controls below are only examples.
		 *  Check this: https://developers.elementor.com/elementor-controls/
		 *
		 **/


		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Settings', 'rawcodeplugin' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
  
        $this->add_responsive_control(
			'filelist_amount',
			[
				'label' => __( 'Files Per Page', 'rawcodeplugin' ),
				'type' => Controls_Manager::NUMBER,
				'range_type' => 'number',
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'default' => -1,
				'tablet_default' => -1,
				'mobile_default' => -1,
			]
		);

        $this->add_control(
			'filelist_limit',
			[
				'label' => __( 'Limit Files By', 'rawcodeplugin' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
 
          					'1'  => __( 'No Limit', 'rawcodeplugin' ),
          
          					'2'  => __( 'Category', 'rawcodeplugin' ),
                              
                            '3'  => __( 'Select', 'rawcodeplugin' ),
				]	
			]
		);    

        $this->add_control(
            'file_cat',
            [
                'label' => __( 'Select categories', 'rawcode-plugin' ),
                'description' => __( 'Select categories of files to show', 'rawcode-plugin' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_files_category(),
                'multiple' => true,
                'condition' => [
                    'filelist_limit' => '2',
                ],
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
            ]
        );

 
        $this->add_control(
            'file_ids',
            [
                'label' => __( 'Select files', 'rawcode-plugin' ),
                'description' => __( 'Select files to show or leave empty to show all', 'rawcode-plugin' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_files_options(),
                'multiple' => true,
                'condition' => [
                    'filelist_limit' => '3',
                ],
				'label_block' => true,
            ]
        );

 		$this->add_control(
			'filelist_sort',
			[
				'label'       => esc_html__( 'Sorting By', 'rawcodeplugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'title',
				'options' => [
					'title' => __( 'Title', 'rawcodeplugin' ),
					'date'  => __( 'Date', 'rawcodeplugin' ),
					'rand' => __( 'Random', 'rawcodeplugin' ),
				],
			]
		);
		$this->add_control(
			'filelist_order',
			[
				'label'       => esc_html__( 'Order', 'rawcodeplugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'asc',
				'options' => [
					'asc'  => __( 'ASC', 'rawcodeplugin' ),
					'desc' => __( 'DESC', 'rawcodeplugin' ),
				],
			]
	
		);

		$this->end_controls_section();
	}


    private function get_files_options() {
        $files_options = [];

        $files = get_posts([
            'post_type' => 'pliki',
            'numberposts' => -1,
        ]);

        if (!empty($files)) {
            foreach ($files as $file) {
                $files_options[$file->ID] = $file->ID . ' - ' . $file->post_title;
            }
        }

        return $files_options;
    } 


    private function get_files_category() {
        $files_category = [];

        $categories  = get_terms([
            'post_type' => 'pliki',
            'hide_empty' => true,
			'taxonomy'  => 'files-category'
        ]);

        if (!empty($categories)) {
            foreach ( $categories as $key => $category ) {
                $files_category[$category->term_id] = $category->name;
            }
        }

        return $files_category;
    }
    
    
	/**
	 * Render widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
        $file_ids = $this->get_settings('file_ids');
        $file_cat = $this->get_settings('file_cat');
 	
		//$paged = get_query_var('paged') ? get_query_var('paged') : 1;

		$args = array(
			'post_type'			=> 'pliki',
			'post_status'		=> 'publish',
			'orderby'			=> $settings['filelist_sort'],
			'order'				=> $settings['filelist_order'],
			'posts_per_page'	=> $settings['filelist_amount'],
		);

		if( $settings['filelist_limit'] == '3' ){
            $args_select = array(
                'post__in' => $file_ids,
            );
        };
		if( $settings['filelist_limit'] == '2' ){
            $args_select = array(
                'tax_query' => array(
					array(
						'taxonomy' => 'files-category', 
						'field'    => 'id', 
						'terms'    =>  $file_cat, 
					),
				),
            );
        }; 
		if( $settings['filelist_limit'] == '1' ){
            $args_select = array();
        }; 

		$args = array_merge( $args, $args_select );
		$q = new \WP_Query( $args );
		?>
		
		<?php if ( $q->have_posts() ) : 
			echo '<section class="rcode-filelist-container">';
		?>

			<?php while ( $q->have_posts() ) : $q->the_post(); ?>
				<?php 
					require( 'style.php' ); 
				?>
            <?php endwhile; ?>

		<?php
			echo '</section>';
		endif; wp_reset_postdata(); 
	}

}