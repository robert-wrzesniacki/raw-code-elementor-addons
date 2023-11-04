<?php
namespace Elementor;
use Elementor\Modules\DynamicTags\Module as TagsModule;

class HeadingH extends Widget_Base {

	/**
	 * Get widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'headingh';
	}

	/**
	 * Get widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return 'Heading';
	}

	/**
	 * Get widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-heading';
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
				'label' => __( 'Title', 'rawcodeplugin' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title_style',
			[
				'label' => __( 'Style', 'rawcodeplugin' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
 
          					'1'  => __( 'H1', 'rawcodeplugin' ),
          
          					'2'  => __( 'H2', 'rawcodeplugin' ),
          
          			//		'3'  => __( 'Style 3', 'rawcodeplugin' ),       
				]	
			]
		);      

		$this->add_control(
			'title_text',
			[
				'label' => __( 'Title text', 'rawcodeplugin' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'text',
				'dynamic' => [
					'active' => true,
					'categories' => [
						TagsModule::TEXT_CATEGORY,
					],
				],
			]
		);    
		
		


		$this->add_responsive_control(
			'align_title',
			[
				'label' => __( 'Title Alignment', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'elementor' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'elementor' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-h1' => 'text-align: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_section();
	   

	
		$this->start_controls_section(
			'heading_settings',
			[
				'label' => __( 'Settings','rawcodeplugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		 $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'title_typography',
				'label'     => __( 'Typography', 'rawcodeplugin' ),
				'selector'  => '{{WRAPPER}} .rcode-h1',
			]
		);
		$this->add_control(
			'heading_color',
			[
				'label' => __( 'Text Color', 'rawcodeplugin' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-h1' => 'color: {{VALUE}};',
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

		$style = $settings['title_style'];
		require( 'style'.$style.'.php' );

	}
}

    