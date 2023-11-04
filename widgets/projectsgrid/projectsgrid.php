<?php
namespace Elementor;

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;


class ProjectsGrid extends Widget_Base {

	/**
	 * Get widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */

	public function get_name() {
		return 'projects-grid';
	}

	/**
	 * Get widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return 'Projects Grid';
	}

	/**
	 * Get widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-folder-o';
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


		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Settings', 'rawcodeplugin' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		 $this->add_control(
			'projectsgrid_style',
			[
				'label' => __( 'List Typ', 'rawcodeplugin' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '2',
				'options' => [
 
          				//	'1'  => __( 'List', 'rawcodeplugin' ),
          
          					'2'  => __( 'Grid', 'rawcodeplugin' ),
          
				]	
			]
		);      
        $this->add_responsive_control(
			'projectsgrid_amount',
			[
				'label' => __( 'Number of Items', 'rawcodeplugin' ),
				'type' => Controls_Manager::NUMBER,
				'range_type' => 'number',
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'default' => 4,
				'tablet_default' => 3,
				'mobile_default' => 1,
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail_size',
				'exclude' => [ 'custom' ],
				'default' => 'medium',
				'prefix_class' => 'rcode-projects-img--thumbnail-size-',
			]
		);
		$this->add_control(
			'item_ratio',
			[
				'label' => esc_html__( 'Item Ratio', 'rawcodeplugin' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.66,
				],
				'range' => [
					'px' => [
						'min' => 0.1,
						'max' => 2,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rcode-projects-box' => 'padding-bottom: calc( {{SIZE}} * 100% )',
					'{{WRAPPER}}:after' => 'content: "{{SIZE}}"; position: absolute; color: transparent;',
				],
				'frontend_available' => true,
			]
		);

        $this->add_control(
			'projectsgrid_limit',
			[
				'label' => __( 'Limit Posts By', 'rawcodeplugin' ),
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
            'post_cat',
            [
                'label' => __( 'Select categories', 'rawcode-plugin' ),
                'description' => __( 'Select categories of post to show', 'rawcode-plugin' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_posts_category(),
                'multiple' => true,
                'condition' => [
                    'projectsgrid_limit' => '2',
                ],
				'label_block' => true,
            ]
        );

        $this->add_control(
            'post_ids',
            [
                'label' => __( 'Select posts', 'rawcode-plugin' ),
                'description' => __( 'Select posts to show or leave empty to show all', 'rawcode-plugin' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_posts_options(),
                'multiple' => true,
                'condition' => [
                    'projectsgrid_limit' => '3',
                ],
				'label_block' => true,
            ]
        );



 		$this->add_control(
			'projectsgrid_sort',
			[
				'label'       => esc_html__( 'Sorting By', 'rawcodeplugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date'  => __( 'Date', 'rawcodeplugin' ),
					'title' => __( 'Title', 'rawcodeplugin' ),
					'rand' => __( 'Random', 'rawcodeplugin' ),
				],
			]
		);

		$this->add_control(
			'projectsgrid_order',
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

		$this->start_controls_section(
			'detail_section',
			[
				'label' => __( 'Project Detail', 'rawcodeplugin' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'projectsgrid_title',
			[
				'label' => esc_html__( 'Show Project Title', 'rawcodeplugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'rawcodeplugin' ),
				'label_off' => __( 'Hide', 'rawcodeplugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'projectsgrid_category',
			[
				'label' => esc_html__( 'Show Categories', 'rawcodeplugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'rawcodeplugin' ),
				'label_off' => __( 'Hide', 'rawcodeplugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'separator' => 'before',
			]
		);


		$this->add_control(
			'projectsgrid_catlimit',
			[
				'label' => __( 'Number of Categories', 'rawcodeplugin' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10,
						'step' => 1,
					],
				],
				'default' => [
					'size' => 2,
				],
				'condition' => [
					'projectsgrid_category' => 'yes',
				],
			]
		);

		$this->add_control(
			'projectsgrid_separator',
			[
				'label' => esc_html__( 'Show separator', 'rawcodeplugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'rawcodeplugin' ),
				'label_off' => __( 'Hide', 'rawcodeplugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'projectsgrid_likes',
			[
				'label' => esc_html__( 'Show Likes/Views', 'rawcodeplugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'rawcodeplugin' ),
				'label_off' => __( 'Hide', 'rawcodeplugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'projectsgrid_button',
			[
				'label' => esc_html__( 'Show Button', 'rawcodeplugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'rawcodeplugin' ),
				'label_off' => __( 'Hide', 'rawcodeplugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'projectsgrid_button_text',
			[
				'label' => esc_html__( 'Project Button Text', 'rawcodeplugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'See more', 'rawcodeplugin' ),
				'label_block' => true,
				'condition' => [
					'projectsgrid_button' => 'yes',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_design_layout',
			[
				'label' => esc_html__( 'Items', 'rawcodeplugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'column_gap',
			[
				'label' => esc_html__( 'Columns Gap', 'rawcodeplugin' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 25,
				],
				'selectors' => [
					'{{WRAPPER}} .rcode-projects-container.projects-grid' => 'grid-column-gap: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'row_gap',
			[
				'label' => esc_html__( 'Rows Gap', 'rawcodeplugin' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 25,
				],
				'frontend_available' => true,
				'selectors' => [
					'{{WRAPPER}} .rcode-projects-container.projects-grid' => 'grid-row-gap: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'rawcodeplugin' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .rcode-projects-container.projects-grid article' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'noimage_color',
			[
				'label' => esc_html__( 'No Image Placeholder Color', 'rawcodeplugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rcode-projects-container.projects-grid article' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_design_overlay',
			[
				'label' => esc_html__( 'Item Overlay', 'rawcodeplugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'color_background',
			[
				'label' => esc_html__( 'Background Color', 'rawcodeplugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rcode-projects-container.projects-grid article .rcode-projects-overlay' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'color_title',
			[
				'label' => esc_html__( 'Title Color', 'rawcodeplugin' ),
				'separator' => 'before',
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rcode-projects-container.projects-grid article .rcode-projects-overlay .rcode-projects-heading .rcode-projects-title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'projectsgrid_title' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_title',
				'label' => esc_html__( 'Title Typography', 'rawcodeplugin' ),
				'selector' => '{{WRAPPER}} .rcode-projects-container.projects-grid article .rcode-projects-overlay .rcode-projects-heading .rcode-projects-title',
				'condition' => [
					'projectsgrid_title' => 'yes',
				],
			]
		);

		$this->add_control(
			'color_category',
			[
				'label' => esc_html__( 'Categories Color', 'rawcodeplugin' ),
				'separator' => 'before',
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rcode-projects-container.projects-grid article .rcode-projects-overlay .rcode-projects-heading .rcode-projects-categories' => 'color: {{VALUE}};',
				],
				'condition' => [
					'projectsgrid_category' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_category',
				'label' => esc_html__( 'Categories Typography', 'rawcodeplugin' ),
				'selector' => '{{WRAPPER}} .rcode-projects-container.projects-grid article .rcode-projects-overlay .rcode-projects-heading .rcode-projects-categories',
				'condition' => [
					'projectsgrid_category' => 'yes',
				],
			]
		);



		$this->add_control(
			'color_separator',
			[
				'label' => esc_html__( 'Separator Color', 'rawcodeplugin' ),
				'separator' => 'before',
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .rcode-projects-container.projects-grid article .rcode-projects-overlay .rcode-projects-heading .rcode-projects-separator' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'projectsgrid_separator' => 'yes',
				],
			]
		);
		$this->add_control(
			'separator_height',
			[
				'label' => esc_html__( 'Separator Height', 'rawcodeplugin' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'default' => [
					'size' => 3,
				],
				'selectors' => [
					'{{WRAPPER}} .rcode-projects-container.projects-grid article .rcode-projects-overlay .rcode-projects-heading .rcode-projects-separator' => 'height: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'projectsgrid_separator' => 'yes',
				],
			]
		);
		$this->add_control(
			'separator_width',
			[
				'label' => esc_html__( 'Separator Width', 'rawcodeplugin' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 70,
				],
				'selectors' => [
					'{{WRAPPER}} .rcode-projects-container.projects-grid article .rcode-projects-overlay .rcode-projects-heading .rcode-projects-separator' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'projectsgrid_separator' => 'yes',
				],
			]
		);

		$this->add_control(
			'color_viewslikes',
			[
				'label' => esc_html__( 'Views\Likes Color', 'rawcodeplugin' ),
				'separator' => 'before',
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}   .rcode-projects-container.projects-grid article .rcode-projects-overlay .rcode-projects-heading .rcode-projects-like .post-views,
					.rcode-projects-container.projects-grid article .rcode-projects-overlay .rcode-projects-heading .rcode-projects-like .post-likes' => 'color: {{VALUE}};',
				],
				'condition' => [
					'projectsgrid_likes' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_viewslikes',
				'label' => esc_html__( 'Views\Likes Typography', 'rawcodeplugin' ),
				'selector' => '{{WRAPPER}}   .rcode-projects-container.projects-grid article .rcode-projects-overlay .rcode-projects-heading .rcode-projects-like .post-views,
				.rcode-projects-container.projects-grid article .rcode-projects-overlay .rcode-projects-heading .rcode-projects-like .post-likes',
				'condition' => [
					'projectsgrid_likes' => 'yes',
				],
			]
		);



		$this->start_controls_tabs( 
			'button_colors',
			[
				'separator' => 'before',
				'condition' => [
					'projectsgrid_button' => 'yes',
				],
			]
		);

		$this->start_controls_tab(
			'button_colors_normal',
			[
				'label' => esc_html__( 'Normal', 'rawcodeplugin' ),
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' => esc_html__( 'Color', 'rawcodeplugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rcode-projects-container.projects-grid article .rcode-projects-overlay .rcode-projects-button' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rcode-projects-container.projects-grid article .rcode-projects-overlay .rcode-projects-button i' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_colors_hover',
			[
				'label' => esc_html__( 'Hover', 'rawcodeplugin' ),
			]
		);

		$this->add_control(
			'hover_button_color',
			[
				'label' => esc_html__( 'Hover Color', 'rawcodeplugin' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rcode-projects-container.projects-grid article .rcode-projects-overlay .rcode-projects-button:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rcode-projects-container.projects-grid article .rcode-projects-overlay .rcode-projects-button:hover i' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_button',
				'label' => esc_html__( 'Button Text Typography', 'rawcodeplugin' ),
				'selector' => '{{WRAPPER}} .rcode-projects-container.projects-grid article .rcode-projects-overlay .rcode-projects-button',
				'condition' => [
					'projectsgrid_button' => 'yes',
				],
			]
		);



		$this->end_controls_section();
	}

    private function get_posts_options() {
        $posts_options = [];

		$posts = get_posts([
			'post_type' => 'projekty',
			'post_status' => 'publish',
			'numberposts' => -1,
			'order'    => 'ASC'
		]);

        if (!empty($posts)) {
            foreach ($posts as $post) {
                $posts_options[$post->ID] = $post->ID . ' - ' . $post->post_title;
            }
        }

        return $posts_options;
    } 


    private function get_posts_category() {
        $posts_category = [];

        $categories  = get_categories([
			'taxonomy' => 'projects-category',
            'post_type' => 'projekty',
            'hide_empty' => false,
			'orderby' => 'name',
            'order'   => 'ASC'
        ]);

        if (!empty($categories)) {
            foreach ( $categories as $key => $category ) {
                $posts_category[$category->term_id] = $category->name;
            }
        }

        return $posts_category;
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
        $post_ids = $this->get_settings('post_ids');
        $post_cat = $this->get_settings('post_cat');
		
		$style = $settings['projectsgrid_style'];
		if($style == 1){
			$style_container = "projects-list";
		}else if($style == 2){
			$style_container = "projects-grid";
		}else{
			$style_container = "";
		}

         $args = array(
			'post_type'			=> 'projekty',
			'post_status'		=> 'publish',
			'orderby'			=> $settings['projectsgrid_sort'],
			'order'				=> $settings['projectsgrid_order'],
			'posts_per_page'	=> $settings['projectsgrid_amount'],
		);

        if( $settings['projectsgrid_limit'] == '3' ){
            $args_select = array(
                'post__in' => $post_ids,
            );
        };

        if( $settings['projectsgrid_limit'] == '2' ){
            $args_select = array(
				'tax_query' => array(
					array(
						'taxonomy' => 'projects-category',
						'field' => 'id',
						'terms' => $post_cat,
					)
			
				)
            );
        }; 

        if( $settings['projectsgrid_limit'] == '1' ){
            $args_select = array();
        }; 

        $args = array_merge( $args, $args_select);

		$q = new \WP_Query( $args );
        ?>

        <?php if ( $q->have_posts() ) : 
			echo '<section class="rcode-projects-container '.$style_container.'">';
		?>
            <?php while ( $q->have_posts() ) : $q->the_post(); ?>
				<?php 
					require( 'style'.$style.'.php' ); 
				?>
            <?php endwhile; ?>
        </section>
        <?php endif; wp_reset_postdata(); ?>

        <?php
	}
}

