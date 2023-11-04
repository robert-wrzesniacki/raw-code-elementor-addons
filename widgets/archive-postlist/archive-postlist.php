<?php
namespace Elementor;


class Archive_PostList extends Widget_Base {
	const LOAD_MORE_ON_CLICK = 'load_more_on_click';
	const LOAD_MORE_INFINITE_SCROLL = 'load_more_infinite_scroll';
	/**
	 * Get widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'archive-postlist';
	}

	/**
	 * Get widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return 'Archive Post List';
	}

	/**
	 * Get widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-post-list';
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

		 $this->add_control(
			'postlist_style',
			[
				'label' => __( 'List Typ', 'rawcodeplugin' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
 
          					'1'  => __( 'List', 'rawcodeplugin' ),
          
          					'2'  => __( 'Grid', 'rawcodeplugin' ),
          
				]	
			]
		);      

 		$this->add_control(
			'postlist_sort',
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
			'postlist_order',
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
		
        $this->add_control(
			'postlist_author',
			[
				'label' => esc_html__( 'Show Author', 'rawcodeplugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'rawcodeplugin' ),
				'label_off' => __( 'Hide', 'rawcodeplugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
			'postlist_data',
			[
				'label' => esc_html__( 'Show Data', 'rawcodeplugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'rawcodeplugin' ),
				'label_off' => __( 'Hide', 'rawcodeplugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'date_format',
			[
				'label' => __( 'Date Format', 'rawcodeplugin' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'd.m.Y',
				'options' => [
					'd.m.Y' => __( '01.01.2023', 'rawcodeplugin' ),
					'F j, Y' => __( 'January 1, 2023', 'rawcodeplugin' ),
					'j F Y' => __( '1 January 2023 ', 'rawcodeplugin' ),
					'd/m/Y' => __( '01/01/2023', 'rawcodeplugin' ),
					'm/d/Y' => __( '01/30/2023', 'rawcodeplugin' ),
				],
				'description' => __( 'Select the format for the date display.', 'rawcodeplugin' ),
				'condition' => [
					'postlist_data' => 'yes',
				],
			]
		);

        $this->add_control(
			'postlist_tag',
			[
				'label' => esc_html__( 'Show Tags', 'rawcodeplugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'rawcodeplugin' ),
				'label_off' => __( 'Hide', 'rawcodeplugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'postlist_taglimit',
			[
				'label' => __( 'Number of Tags', 'rawcodeplugin' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10,
						'step' => 1,
					]
				],
				'default' => [
					'size' => 3,
				],
				'condition' => [
					'postlist_tag' => 'yes',
				],
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'section_pagination',
			[
				'label' => esc_html__( 'Pagination', 'rawcodeplugin' ),
			]
		);
        $this->add_control(
			'pagination_on',
			[
				'label' => esc_html__( 'Show Pagination', 'rawcodeplugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'rawcodeplugin' ),
				'label_off' => __( 'Hide', 'rawcodeplugin' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);
		$this->add_control(
			'pagination_type',
			[
				'label' => esc_html__( 'Pagination', 'rawcodeplugin' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					//'' => esc_html__( 'None', 'rawcodeplugin' ),
					'numbers' => esc_html__( 'Numbers', 'rawcodeplugin' ),
					'prev_next' => esc_html__( 'Previous/Next', 'rawcodeplugin' ),
					'numbers_and_prev_next' => esc_html__( 'Numbers', 'rawcodeplugin' ) . ' + ' . esc_html__( 'Previous/Next', 'rawcodeplugin' ),
					// self::LOAD_MORE_ON_CLICK => esc_html__( 'Load on Click', 'elementor-pro' ),
					// self::LOAD_MORE_INFINITE_SCROLL => esc_html__( 'Infinite Scroll', 'elementor-pro' ),
				],
				'frontend_available' => true,
				'condition' => [
					'pagination_on' => [
						'yes',
					],
				],
			]
		);

		// $this->add_control(
		// 	'pagination_page_limit',
		// 	[
		// 		'label' => esc_html__( 'Page Limit', 'rawcodeplugin' ),
		// 		'default' => '5',
		// 	]
		// );

		$this->add_control(
			'pagination_numbers_shorten',
			[
				'label' => esc_html__( 'Shorten', 'rawcodeplugin' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => '',
				'condition' => [
					'pagination_type' => [
						'numbers',
						'numbers_and_prev_next',
					],
					'pagination_on' => [
						'yes',
					],
				],
			]
		);

		$this->add_control(
			'pagination_prev_label',
			[
				'label' => esc_html__( 'Previous Label', 'rawcodeplugin' ),
				'default' => esc_html__( '&laquo; Previous', 'rawcodeplugin' ),
				'condition' => [
					'pagination_type' => [
						'prev_next',
						'numbers_and_prev_next',
					],
					'pagination_on' => [
						'yes',
					],
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'pagination_next_label',
			[
				'label' => esc_html__( 'Next Label', 'rawcodeplugin' ),
				'default' => esc_html__( 'Next &raquo;', 'rawcodeplugin' ),
				'condition' => [
					'pagination_type' => [
						'prev_next',
						'numbers_and_prev_next',
					],
								'pagination_on' => [
						'yes',
					],
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'pagination_align',
			[
				'label' => esc_html__( 'Alignment', 'rawcodeplugin' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'rawcodeplugin' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'rawcodeplugin' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'rawcodeplugin' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .rcode-postlist-pagination' => 'justify-content: {{VALUE}};',
				],
				'condition' => [
					'pagination_on' => [
						'yes',
					],
				],
			]
		);




		$this->end_controls_section();

	 	$this->start_controls_section(
			'postlist_Style',
			[
				'label' => __( 'Post Style','rawcodeplugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


		 // Data STYLE
		$this->add_control(
			'post_data',
			[
				'label' => esc_html__( 'Data', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);


		$this->add_control(
			'data_color',
			[
				'label' => esc_html__( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rcode-postlist-container.post-grid article .rcode-postlist-img .rcode-data' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rcode-postlist-container.post-list article .rcode-postlist-img .rcode-data' => 'color: {{VALUE}};',
				],
			]
		); 

		$this->add_control(
			'data_color_bg',
			[
				'label' => esc_html__( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rcode-postlist-container.post-grid article .rcode-postlist-img .rcode-data' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .rcode-postlist-container.post-list article .rcode-postlist-img .rcode-data' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'data_typography',
				'selector' => '{{WRAPPER}} .rcode-postlist-container.post-list article .rcode-postlist-img .rcode-data,
							   {{WRAPPER}} .rcode-postlist-container.post-grid article .rcode-postlist-img .rcode-data',
			]
		);
		
		$this->add_responsive_control(
            'data_space',
            [
                'label' => esc_html__( 'Data Padding', 'rawcodeplugin' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'isLinked' => 'true',
                'selectors' => [
                    '{{WRAPPER}} .rcode-postlist-container.post-grid article .rcode-postlist-img .rcode-data' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rcode-postlist-container.post-list article .rcode-postlist-img .rcode-data' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


		// Tag STYLE
		$this->add_control(
			'post_tag',
			[
				'label' => esc_html__( 'Tag', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);


		$this->start_controls_tabs( 'tag_colors' );

		$this->start_controls_tab(
			'tag_colors_normal',
			[
				'label' => esc_html__( 'Normal', 'elementor' ),
			]
		);

		$this->add_control(
			'tag_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rcode-postlist-container.post-grid article .rcode-postlist-content .rcode-postlist-taglist a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rcode-postlist-container.post-list article .rcode-postlist-content .rcode-postlist-taglist a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tag_colors_hover',
			[
				'label' => esc_html__( 'Hover', 'elementor' ),
			]
		);

		$this->add_control(
			'hover_tag_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rcode-postlist-container.post-grid article .rcode-postlist-content .rcode-postlist-taglist a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rcode-postlist-container.post-list article .rcode-postlist-content .rcode-postlist-taglist a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tag_typography',
				'selector' => 
					'{{WRAPPER}} .rcode-postlist-container.post-grid article .rcode-postlist-content .rcode-postlist-taglist span,
					 {{WRAPPER}} .rcode-postlist-container.post-list article .rcode-postlist-content .rcode-postlist-taglist span,
					 {{WRAPPER}} .rcode-postlist-container.post-grid article .rcode-postlist-content .rcode-postlist-taglist a,
					 {{WRAPPER}} .rcode-postlist-container.post-list article .rcode-postlist-content .rcode-postlist-taglist a',
			]
		);


		// Title STYLE
		$this->add_control(
			'post_title',
			[
				'label' => esc_html__( 'Title', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);


		$this->start_controls_tabs( 'title_colors' );

		$this->start_controls_tab(
			'title_colors_normal',
			[
				'label' => esc_html__( 'Normal', 'elementor' ),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rcode-postlist-container.post-grid article .rcode-postlist-content .rcode-postlist-title a h3' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rcode-postlist-container.post-list article .rcode-postlist-content .rcode-postlist-title a h3' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_colors_hover',
			[
				'label' => esc_html__( 'Hover', 'elementor' ),
			]
		);

		$this->add_control(
			'hover_title_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rcode-postlist-container.post-grid article .rcode-postlist-content .rcode-postlist-title a:hover h3' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rcode-postlist-container.post-list article .rcode-postlist-content .rcode-postlist-title a:hover h3' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => 
					'{{WRAPPER}} .rcode-postlist-container.post-grid article .rcode-postlist-content .rcode-postlist-title a h3,
					 {{WRAPPER}} .rcode-postlist-container.post-list article .rcode-postlist-content .rcode-postlist-title a h3',
			]
		);


		// Author STYLE
		$this->add_control(
			'post_author',
			[
				'label' => esc_html__( 'Author', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);


		$this->add_control(
			'author_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rcode-postlist-container.post-grid article .rcode-postlist-content .rcode-postlist-autor h4' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rcode-postlist-container.post-list article .rcode-postlist-content .rcode-postlist-autor h4' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'author_typography',
				'selector' => 
					'{{WRAPPER}} .rcode-postlist-container.post-grid article .rcode-postlist-content .rcode-postlist-autor h4,
					 {{WRAPPER}} .rcode-postlist-container.post-list article .rcode-postlist-content .rcode-postlist-autor h4',
			]
		);

		// Likes STYLE
		$this->add_control(
			'post_likes',
			[
				'label' => esc_html__( 'Views / Likes', 'rawcodeplugin' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
                    'postlist_style' => '1',
                ],
			]
		);


		$this->add_control(
			'likes_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rcode-postlist-container.post-list article .rcode-postlist-content .rcode-bottom-content .rcode-bottom-like .post-views' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rcode-postlist-container.post-list article .rcode-postlist-content .rcode-bottom-content .rcode-bottom-like .post-likes' => 'color: {{VALUE}};',
				],
				'condition' => [
                    'postlist_style' => '1',
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'likes_typography',
				'selector' => 
					'{{WRAPPER}} .rcode-postlist-container.post-list article .rcode-postlist-content .rcode-bottom-content .rcode-bottom-like .post-views,
					 {{WRAPPER}} .rcode-postlist-container.post-list article .rcode-postlist-content .rcode-bottom-content .rcode-bottom-like .post-likes',
				'condition' => [
                    'postlist_style' => '1',
                ],
			]
		);

		$this->add_responsive_control(
			'likes_space',
			[
				'label' => esc_html__( 'Space Between', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'default' => [
					'size' => 20,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rcode-postlist-container.post-list article .rcode-postlist-content .rcode-bottom-content .rcode-bottom-like' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
                    'postlist_style' => '1',
                ],
			]
		); 


		$this->end_controls_section();

		$this->start_controls_section(
			'postlist_pag_style',
			[
				'label' => __( 'Pagination Style','rawcodeplugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'postlist_pag_tabs' );

		$this->start_controls_tab(
			'postlist_pag_normal',
			[
				'label' => esc_html__( 'Normal', 'elementor' ),
			]
		);
		$this->add_control(
			'postlist_pag_color',
			[
				'label' => esc_html__( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rcode-postlist-container.post-grid .rcode-postlist-pagination span' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rcode-postlist-container.post-list .rcode-postlist-pagination span' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rcode-postlist-container.post-grid .rcode-postlist-pagination a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rcode-postlist-container.post-list .rcode-postlist-pagination a' => 'color: {{VALUE}};',
				],
			]
		); 
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'postlist_pag_typography',
				'selector' => 
					'{{WRAPPER}} .rcode-postlist-container.post-list .rcode-postlist-pagination span,
					 {{WRAPPER}} .rcode-postlist-container.post-list .rcode-postlist-pagination span,
					 {{WRAPPER}} .rcode-postlist-container.post-grid .rcode-postlist-pagination a,
					 {{WRAPPER}} .rcode-postlist-container.post-list .rcode-postlist-pagination a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'postlist_pag_hover',
			[
				'label' => esc_html__( 'Hover', 'elementor' ),
			]
		);
		$this->add_control(
			'postlist_pag_color_hover',
			[
				'label' => esc_html__( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rcode-postlist-container.post-grid .rcode-postlist-pagination a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rcode-postlist-container.post-list .rcode-postlist-pagination a:hover' => 'color: {{VALUE}};',
				],
			]
		); 
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'postlist_pag_typography_hover',
				'selector' => 
					'{{WRAPPER}} .rcode-postlist-container.post-grid .rcode-postlist-pagination a:hover,
					 {{WRAPPER}} .rcode-postlist-container.post-list .rcode-postlist-pagination a:hover',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'postlist_pag_active',
			[
				'label' => esc_html__( 'Active', 'elementor' ),
			]
		);
		$this->add_control(
			'postlist_pag_color_active',
			[
				'label' => esc_html__( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rcode-postlist-container.post-grid .rcode-postlist-pagination span.current' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rcode-postlist-container.post-list .rcode-postlist-pagination span.current' => 'color: {{VALUE}};',
				],
			]
		); 
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'postlist_pag_typography_active',
				'selector' => 
					'{{WRAPPER}} .rcode-postlist-container.post-grid .rcode-postlist-pagination span.current,
					 {{WRAPPER}} .rcode-postlist-container.post-list .rcode-postlist-pagination span.current',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'postlist_pag_space',
			[
				'label' => esc_html__( 'Space Between', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rcode-postlist-container.post-grid .rcode-postlist-pagination' => 'gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rcode-postlist-container.post-list .rcode-postlist-pagination' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		); 

		$this->end_controls_section();
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
		
		$style = $settings['postlist_style'];
		if($style == 1){
			$style_container = "post-list";
		}else if($style == 2){
			$style_container = "post-grid";
		}else{
			$style_container = "";
		}
		// Get the current page number
		$paged = get_query_var('paged') ? get_query_var('paged') : 1;

         $args = array(
			'post_type'			=> 'post',
			'post_status'		=> 'publish',
			'orderby'			=> $settings['postlist_sort'],
			'order'				=> $settings['postlist_order'],
		);


        // Wykorzystujemy kontekst strony archiwum, aby dostosować zapytanie do typu archiwum.
        if (is_category()) {
            $args['category__in'] = get_queried_object_id();
        } elseif (is_tag()) {
            $args['tag_id'] = get_queried_object_id();
        } elseif (is_author()) {
            $args['author'] = get_queried_object_id();
        } elseif (is_date()) {
            $args['year'] = get_query_var('year');
            $args['monthnum'] = get_query_var('monthnum');
            $args['day'] = get_query_var('day');
        }


		if( $settings['pagination_on']){
            $args_pagination = array(
                'paged' => $paged,
            );
        }else{
			$args_pagination = array();
		};

        $args = array_merge( $args, $args_pagination );

		$q = new \WP_Query( $args );
        ?>

        <?php if ( $q->have_posts() ) : 
			echo '<section class="rcode-postlist-container '.$style_container.'">';
			echo '<div class="rcode-postlist-article">';
		?>
            <?php while ( $q->have_posts() ) : $q->the_post(); ?>
				<?php 
					require( 'style'.$style.'.php' ); 
				?>
            <?php endwhile; ?>
			
		<?php
		echo '</div>';
		$page_limit = $q->max_num_pages;
		
		if( $settings['pagination_on'] && $page_limit > 1){

			
			$has_numbers = in_array( $settings['pagination_type'], [ 'numbers', 'numbers_and_prev_next' ] );
			$has_prev_next = in_array( $settings['pagination_type'], [ 'prev_next', 'numbers_and_prev_next' ] );
			$has_prev_next_only = in_array( $settings['pagination_type'], [ 'prev_next' ] );
			$current_page = max(1, $paged);
			$next_page = intval( $current_page ) + 1;
			$links = [];
			$page_url = get_permalink();

			$paginate_args = [];



			 if ( $has_numbers ) {
				$paginate_args = [
					'type' => 'array',
					'current' => max(1, $paged),
					'total' => $page_limit,
					'prev_next' => false,
					'end_size'     => 0,
					'mid_size'     => 0,
					'show_all' => 'yes' !== $settings['pagination_numbers_shorten'],
					'before_page_number' => '<span class="elementor-screen-only">' . esc_html__( 'Page', 'elementor-pro' ) . '</span>',
				];

				$links = paginate_links( $paginate_args ); 
			}

			 if ( $has_prev_next ) {

				$link_template = '<a class="page-numbers %s" href="%s">%s</a>';
				$disabled_template = '<span class="page-numbers %s">%s</span>';

				if ( $paged > 1 ) {
					$next_page = intval( $paged ) - 1;
						if ( $next_page < 1 ) {
								$next_page = 1;
						}
				
						$prev_next['prev'] = sprintf( $link_template, 'prev', get_previous_posts_page_link(), $settings['pagination_prev_label'] );
				} else {
						$prev_next['prev'] = sprintf( $disabled_template, 'prev', $settings['pagination_prev_label'] );
				}
				
				$next_page = intval( $paged ) + 1;
		
				if ( $next_page <= $page_limit ) {
						$prev_next['next'] = sprintf( $link_template, 'next', get_next_posts_page_link(), $settings['pagination_next_label'] );
				} else {
						$prev_next['next'] = sprintf( $disabled_template, 'next', $settings['pagination_next_label'] );
				}

				array_unshift( $links, $prev_next['prev'] );
				$links[] = $prev_next['next'];
			}

			// PHPCS - Seems that `$links` is safe.
			?>
			<nav class="rcode-postlist-pagination" aria-label="<?php esc_attr_e( 'Pagination', 'elementor-pro' ); ?>">
				<?php echo implode( PHP_EOL, $links ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</nav>
			<?php

			
		};
		
		?>  
		</section>
        <?php endif; wp_reset_postdata(); ?>

        <?php
		
	}

}

    