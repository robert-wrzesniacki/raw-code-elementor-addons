<?php
namespace Elementor;

class Opinions extends Widget_Base {

	/**
	 * Get widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'opinions';
	}

	/**
	 * Get widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return 'Opinions';
	}

	/**
	 * Get widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-editor-quote';
	}

	/**
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
			'opinions_style',
			[
				'label' => __( 'Style', 'rawcodeplugin' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
 
          					'1'  => __( 'Style 1', 'rawcodeplugin' ),
          
          					'2'  => __( 'Style 2', 'rawcodeplugin' ),
          
          			//		'3'  => __( 'Style 3', 'rawcodeplugin' ),       
				]	
			]
		);      

		$this->add_control(
			'opinions_limit',
			[
				'label'       => __( 'Number of Items', 'rawcodeplugin' ),
				'type'        => Controls_Manager::NUMBER,
				'placeholder' => 8,
				'default'     => 8,
			]
		);

 		$this->add_control(
			'opinions_sort',
			[
				'label'       => esc_html__( 'Sorting By', 'rawcodeplugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'menu_order',
				'options' => [
					'date'  => __( 'Date', 'rawcodeplugin' ),
					'title' => __( 'Title', 'rawcodeplugin' ),
					'rand' => __( 'Random', 'rawcodeplugin' ),
					'menu_order' => __( 'Order', 'rawcodeplugin' ),
				],
			]
		);
		$this->add_control(
			'opinions_order',
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
			'opinions_author',
			[
				'label' => esc_html__( 'Show Author', 'rawcodeplugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'rawcodeplugin' ),
				'label_off' => __( 'Hide', 'rawcodeplugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'query_section',
			[
				'label' => __( 'Query Settings', 'rawcodeplugin' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'opinion_limitby',
			[
				'label' => __( 'Limit Opinions By', 'rawcodeplugin' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
 
          					'1'  => __( 'No Limit', 'rawcodeplugin' ),
                              
                            '2'  => __( 'Select', 'rawcodeplugin' ),
				]	
			]
		);    

        $this->add_control(
            'opinion_ids',
            [
                'label' => __( 'Select opinions', 'rawcode-plugin' ),
                'description' => __( 'Select opinions to show or leave empty to show all', 'rawcode-plugin' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_posts_options(),
                'multiple' => true,
                'condition' => [
                    'opinion_limitby' => '2',
                ],
				'label_block' => true,
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'slider_section',
			[
				'label' => __( 'Slider Settings', 'rawcodeplugin' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'opinions_style' => array('2')
				],
			]
		);

		$this->add_control( 'autoplay',
			[
				'label' => esc_html__( 'Autoplay', 'rawcodeplugin' ),
				'type' => Controls_Manager::SWITCHER,
			]
		); 
		$this->add_control( 'loop',
			[
				'label' => esc_html__( 'Loop', 'rawcodeplugin' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'slider_speed',
			[
				'label' => __( 'Slider Speed', 'rawcodeplugin' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 500,
			]
		);
		$this->add_control(
			'slider_delay',
			[
				'label' => __( 'Slider Delay', 'rawcodeplugin' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 3000,
			]
		);




		$this->end_controls_section();
	   

	
	 	$this->start_controls_section(
			'Opinions_Style',
			[
				'label' => __( 'Style','rawcodeplugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		 $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'text_typography',
				'label'     => __( 'Text Typography', 'rawcodeplugin' ),
				'selector'  => '{{WRAPPER}} .rcode-opinions-single .rcode-quote .quote',
			]
		);
		$this->add_control(
			'text_color',
			[
				'label' => __( 'Text Color', 'rawcodeplugin' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-opinions-single .rcode-quote .quote' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'author_typography',
				'label'     => __( 'Author Typography', 'rawcodeplugin' ),
				'selector'  => '{{WRAPPER}} .rcode-opinions-single .rcode-quote .quote-author',
			]
		);
		$this->add_control(
			'author_color',
			[
				'label' => __( 'Author Color', 'rawcodeplugin' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-opinions-single .rcode-quote .quote-author' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rcode-opinions-single .rcode-quote .quote-author::before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
 



	}


	private function get_posts_options() {
        $posts_options = [];

		$posts = get_posts([
			'post_type' => 'opinie',
			'post_status' => 'publish',
			'numberposts' => -1,
			'orderby' => 'name',
			'order'    => 'ASC'
		]);

        if (!empty($posts)) {
            foreach ($posts as $post) {
                $posts_options[$post->ID] = $post->ID . ' - ' . $post->post_title;
            }
        }

        return $posts_options;
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
		
		$opinion_ids = $this->get_settings('opinion_ids');
		
		$speed    = $settings['slider_speed'] ? $settings['slider_speed'] : 500;
		$autoplay = 'yes' == $settings['autoplay'] ? 'true' : 'false';
		$loop     = 'yes' == $settings['loop'] ? 'true'     : 'false';
		$delay    = $settings['slider_delay'] ? $settings['slider_delay'] : 3000;
		
		$args = array(
			'posts_per_page' => $settings['opinions_limit'],
			'post_type' =>  'opinie',
			'suppress_filters' => false,
			'order_by' => $settings['opinions_sort'],
			'order' => $settings['opinions_order'],
		);
		if( $settings['opinion_limitby'] == '2' ){
            $args_select = array(
                'post__in' => $opinion_ids,
            );
        }else{
			$args_select = array();
		};

		$args = array_merge( $args, $args_select);

		$style = $settings['opinions_style'];
		require( 'style'.$style.'.php' );

	}
}

    