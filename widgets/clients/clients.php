<?php
namespace Elementor;

class Clients extends Widget_Base {

	/**
	 * Get widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'clients';
	}

	/**
	 * Get widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return 'Clients';
	}

	/**
	 * Get widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-person';
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
			'clients_style',
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
			'clients_gallery',
			[
				'label' => __( 'Add Clients Logo', 'rawcodeplugin' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'show_label' => false,
				'default' => [],
			]
		);

		$this->end_controls_section();


	 	$this->start_controls_section(
			'slider_section',
			[
				'label' => __( 'Slider Settings', 'rawcodeplugin' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'clients_style' => array('2')
				],
			]
		);

		$this->add_control( 
            'autoplay',
			[
				'label' => esc_html__( 'Autoplay', 'rawcodeplugin' ),
				'type' => Controls_Manager::SWITCHER,
			]
		); 
		$this->add_control( 
            'loop',
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
				'min' => 0,
				'max' => 100000,
				'step' => 50,
			]
		);
		$this->add_control(
			'slider_delay',
			[
				'label' => __( 'Slider Delay', 'rawcodeplugin' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 3000,
				'min' => 0,
				'max' => 100000,
				'step' => 100,
			]
		);   

		$slides_per_view = range( 1, 10 );

		$slides_per_view = array_combine( $slides_per_view, $slides_per_view );

		$this->add_responsive_control(
			'slider_slide',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__( 'Slides Per View', 'elementor-pro' ),
				'options' => $slides_per_view,
				'frontend_available' => true,
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => '6',
				'tablet_default' => '3',
				'mobile_default' => '1',
			]
		);

		$this->add_responsive_control(
			'slider_space',
			[
				'label' => __( 'Space Between', 'rawcodeplugin' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'number' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'range_type' => 'number',
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'default' => [
					'unit' => '',
					'size' => 50,
				],
				'tablet_default' => [
					'unit' => '',
					'size' => 50,
				],
				'mobile_default' => [
					'unit' => '',
					'size' => 25,
				],
				'frontend_available' => true,
			]
		);
	



		$this->end_controls_section();
	   

	
	 	$this->start_controls_section(
			'clients_Style',
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
				'selector'  => '{{WRAPPER}} .rcode-clients-single .rcode-quote .quote',
			]
		);
		$this->add_control(
			'text_color',
			[
				'label' => __( 'Text Color', 'rawcodeplugin' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-clients-single .rcode-quote .quote' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'author_typography',
				'label'     => __( 'Author Typography', 'rawcodeplugin' ),
				'selector'  => '{{WRAPPER}} .rcode-clients-single .rcode-quote .quote-author',
			]
		);
		$this->add_control(
			'author_color',
			[
				'label' => __( 'Author Color', 'rawcodeplugin' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-clients-single .rcode-quote .quote-author' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rcode-clients-single .rcode-quote .quote-author::before' => 'background-color: {{VALUE}};',
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

		$style = $settings['clients_style'];
		require( 'style'.$style.'.php' );

	}
}

    