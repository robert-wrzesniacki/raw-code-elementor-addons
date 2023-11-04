<?php
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Services extends Widget_Base {

	/**
	 * Get widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'services';
	}

	/**
	 * Get widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return 'Services';
	}

	/**
	 * Get widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-info-box';
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

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'rawcodeplugin' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'selected_icon',
			[
				'label' => esc_html__( 'Icon', 'elementor' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
			]
		);

		$repeater->add_control(
			'title_text',
			[
				'label' => esc_html__( 'Title & Description', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__( 'This is the heading', 'elementor' ),
				'placeholder' => esc_html__( 'Enter your title', 'elementor' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'description_text',
			[
				'label' => '',
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor' ),
				'placeholder' => esc_html__( 'Enter your description', 'elementor' ),
				'rows' => 10,
				'separator' => 'none',
				'show_label' => false,
			]
		);

		$repeater->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'elementor' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'elementor' ),
				'separator' => 'before',
			]
		);

		$repeater->add_control(
			'link_text',
			[
				'label' => esc_html__( 'Link Text', 'rawcodeplugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'See More', 'elementor' ),
				'label_block' => true,
			]
		);


		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Services List', 'rawcodeplugin' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ title_text }}}',
			]
		);

	
		$this->add_control(
			'title_size',
			[
				'label' => esc_html__( 'Title HTML Tag', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h3',
			]
		);
		$this->add_control(
			'box_col_style',
			[
				'label' => __( 'Number of columns', 'rawcodeplugin' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'auto',
				'options' => [
							'1'  => __( '1', 'rawcodeplugin' ),
							'2'  => __( '2', 'rawcodeplugin' ),
							'3'  => __( '3', 'rawcodeplugin' ),
							'4'  => __( '4', 'rawcodeplugin' ),
							'auto'  => __( 'Auto', 'rawcodeplugin' ),
				]	
			]
		);      
		$this->end_controls_section();
		$this->start_controls_section(
			'opinion_section',
			[
				'label' => __( 'Opinion Box', 'rawcodeplugin' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'opinion_on',
			[
				'label' => esc_html__( 'Show Opinion Box', 'rawcodeplugin' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rawcodeplugin' ),
				'label_off' => esc_html__( 'Hide', 'rawcodeplugin' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_control(
			'opinion_rate',
			[
				'label' => esc_html__( 'Rating - x / 5.0', 'rawcodeplugin' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 5,
				'step' => 0.1,
				'default' => 5.0,
				'condition' => [
					'opinion_on' => 'yes',
				],
			]
		);
		$this->add_control(
			'opinion_description',
			[
				'label' => esc_html__( 'Description', 'rawcodeplugin' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'condition' => [
					'opinion_on' => 'yes',
				],
			]
		);
		$this->add_control(
			'opinion_link',
			[
				'label' => esc_html__( 'Opinion Link', 'rawcodeplugin' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'elementor' ),
				'separator' => 'before',
				'condition' => [
					'opinion_on' => 'yes',
				],
			]
		);

		$this->add_control(
			'opinion_link_text',
			[
				'label' => esc_html__( 'Opinion Link Text', 'rawcodeplugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'See opinions', 'rawcodeplugin' ),
				'label_block' => true,
				'condition' => [
					'opinion_on' => 'yes',
				],
			]
		);
		$this->end_controls_section();




		$this->start_controls_section(
			'section_style_box',
			[
				'label' => esc_html__( 'Box', 'elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'box_colors' );

		$this->start_controls_tab(
			'box_bg_colors_normal',
			[
				'label' => esc_html__( 'Normal', 'elementor' ),
			]
		);

		$this->add_control(
			'box_primary_color',
			[
				'label' => esc_html__( 'Primary Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => '',
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-services-single' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .rcode-services-single' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .rcode-services-single',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'box_bg_colors_hover',
			[
				'label' => esc_html__( 'Hover', 'elementor' ),
			]
		);

		$this->add_control(
			'box_hover_primary_color',
			[
				'label' => esc_html__( 'Primary Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-services-single:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .rcode-services-single:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border-hover',
				'selector' => '{{WRAPPER}} .rcode-services-single:hover',
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'box_space',
			[
				'label' => esc_html__( 'Box Padding', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .rcode-services-single' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => esc_html__( 'Icon', 'elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'primary_color',
			[
				'label' => esc_html__( 'Primary Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-services-single .elementor-icon-box-icon i' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
					'{{WRAPPER}} .rcode-services-single .elementor-icon-box-icon svg' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);


		$this->add_responsive_control(
			'icon_space',
			[
				'label' => esc_html__( 'Spacing', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'default' => [
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-icon i' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-icon-box-icon svg' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Size', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-icon i' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-icon-box-icon svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => esc_html__( 'Padding', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-icon' => 'padding: {{SIZE}}{{UNIT}};',
				],
				'range' => [
					'em' => [
						'min' => 0,
						'max' => 5,
					],
				],
			]
		);

		$active_breakpoints = Plugin::$instance->breakpoints->get_active_breakpoints();

		$rotate_device_args = [];

		$rotate_device_settings = [
			'default' => [
				'unit' => 'deg',
			],
		];

		foreach ( $active_breakpoints as $breakpoint_name => $breakpoint ) {
			$rotate_device_args[ $breakpoint_name ] = $rotate_device_settings;
		}

		$this->add_responsive_control(
			'rotate',
			[
				'label' => esc_html__( 'Rotate', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'deg', 'grad', 'rad', 'turn' ],
				'default' => [
					'unit' => 'deg',
				],
				'tablet_default' => [
					'unit' => 'deg',
				],
				'mobile_default' => [
					'unit' => 'deg',
				],
				'device_args' => $rotate_device_args,
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-icon i' => 'transform: rotate({{SIZE}}{{UNIT}});',
					'{{WRAPPER}} .elementor-icon-box-icon svg' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__( 'Content', 'elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'text_align',
			[
				'label' => esc_html__( 'Alignment', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'elementor' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'elementor' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'heading_title',
			[
				'label' => esc_html__( 'Title', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_bottom_space',
			[
				'label' => esc_html__( 'Spacing', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-services-single .elementor-icon-box-title ' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .elementor-icon-box-title',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'text_stroke',
				'selector' => '{{WRAPPER}} .elementor-icon-box-title',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .elementor-icon-box-title',
			]
		);

		$this->add_control(
			'heading_description',
			[
				'label' => esc_html__( 'Description', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'description_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-services-single .elementor-icon-box-description' => 'color: {{VALUE}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .elementor-icon-box-description',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'description_shadow',
				'selector' => '{{WRAPPER}} .elementor-icon-box-description',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_button',
			[
				'label' => esc_html__( 'Button', 'elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'button_colors' );

		$this->start_controls_tab(
			'button_bg_colors_normal',
			[
				'label' => esc_html__( 'Normal', 'elementor' ),
			]
		);

		$this->add_control(
			'button_primary_color',
			[
				'label' => esc_html__( 'Primary Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-services-single .rcode-service-box-button .rcode-service-button' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_text_primary_color',
			[
				'label' => esc_html__( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-services-single .rcode-service-box-button .rcode-service-button' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button-border',
				'selector' => '{{WRAPPER}} .rcode-services-single .rcode-service-box-button .rcode-service-button',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_bg_colors_hover',
			[
				'label' => esc_html__( 'Hover', 'elementor' ),
			]
		);

		$this->add_control(
			'button_hover_primary_color',
			[
				'label' => esc_html__( 'Primary Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-services-single .rcode-service-box-button .rcode-service-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_text_colors_hover',
			[
				'label' => esc_html__( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-services-single .rcode-service-box-button .rcode-service-button:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button-border-hover',
				'selector' => '{{WRAPPER}} .rcode-services-single .rcode-service-box-button .rcode-service-button:hover',
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->add_responsive_control(
			'button_space',
			[
				'label' => esc_html__( 'Box Padding', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .rcode-service-box-button .rcode-service-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_button_typography',
				'selector' => '{{WRAPPER}} .rcode-services-single .rcode-service-box-button .rcode-service-button',
				'default' => '',
			]
		);
		$this->add_responsive_control(
			'button_align',
			[
				'label' => esc_html__( 'Alignment', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'elementor' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'elementor' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rcode-service-box-button' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();


		
		$this->start_controls_section(
			'section_style_opinion',
			[
				'label' => esc_html__( 'Opinions', 'rawcodeplugin' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'opinion_text_align',
			[
				'label' => esc_html__( 'Alignment', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'elementor' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'elementor' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .opinion-box-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'rate_box',
			[
				'label' => esc_html__( 'Box', 'rawcodeplugin' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs( 'rate_box_colors' );

		$this->start_controls_tab(
			'rate_box_bg_colors_normal',
			[
				'label' => esc_html__( 'Normal', 'elementor' ),
			]
		);

		$this->add_control(
			'rate_box_primary_color',
			[
				'label' => esc_html__( 'Primary Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-opinion-single' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'rate_border',
				'selector' => '{{WRAPPER}} .rcode-opinion-single',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'rate_box_bg_colors_hover',
			[
				'label' => esc_html__( 'Hover', 'elementor' ),
			]
		);

		$this->add_control(
			'rate_box_hover_primary_color',
			[
				'label' => esc_html__( 'Primary Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-opinion-single:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'rate_border-hover',
				'selector' => '{{WRAPPER}} .rcode-opinion-single:hover',
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'rate_box_space',
			[
				'label' => esc_html__( 'Box Padding', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .rcode-opinion-single' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'rate_title',
			[
				'label' => esc_html__( 'Rate', 'rawcodeplugin' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'rate_bottom_space',
			[
				'label' => esc_html__( 'Spacing', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .opinion-box-rate' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'rate_color_tabs' );

		$this->start_controls_tab(
			'rate_color_normal',
			[
				'label' => esc_html__( 'Normal', 'elementor' ),
			]
		);
		$this->add_control(
			'rate_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-opinion-single .rcode-opinion-rating ' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'rate_typography',
				'selector' => '{{WRAPPER}} .rcode-opinion-single .rcode-opinion-rating',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'rate_color_normal_hover',
			[
				'label' => esc_html__( 'Hover', 'elementor' ),
			]
		);
		$this->add_control(
			'rate_color_h',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-opinion-single:hover .rcode-opinion-rating ' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'rate_typography_h',
				'selector' => '{{WRAPPER}} .rcode-opinion-single:hover .rcode-opinion-rating',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'rate_stroke',
				'selector' => '{{WRAPPER}} .rcode-opinion-single .rcode-opinion-rating',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'rate_shadow',
				'selector' => '{{WRAPPER}} .rcode-opinion-single .rcode-opinion-rating',
			]
		);
		$this->add_control(
			'maxrate_title',
			[
				'label' => esc_html__( 'Max Rate', 'rawcodeplugin' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs( 'maxrate_box_colors' );

		$this->start_controls_tab(
			'maxrate_color_normal',
			[
				'label' => esc_html__( 'Normal', 'elementor' ),
			]
		);

		$this->add_control(
			'maxrate_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-opinion-single .rcode-opinion-maxrate ' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'maxrate_typography',
				'selector' => '{{WRAPPER}} .rcode-opinion-single .rcode-opinion-maxrate',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'maxrate_color_hover',
			[
				'label' => esc_html__( 'Hover', 'elementor' ),
			]
		);

		$this->add_control(
			'maxrate_color_h',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-opinion-single:hover .rcode-opinion-maxrate ' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'maxrate_typography_h',
				'selector' => '{{WRAPPER}} .rcode-opinion-single:hover .rcode-opinion-maxrate',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();



		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'maxrate_stroke',
				'selector' => '{{WRAPPER}} .rcode-opinion-single .rcode-opinion-maxrate',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'maxrate_shadow',
				'selector' => '{{WRAPPER}} .rcode-opinion-single .rcode-opinion-maxrate',
			]
		);

		$this->add_control(
			'rate_heading_description',
			[
				'label' => esc_html__( 'Description', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->start_controls_tabs( 'rate_description_colors' );

		$this->start_controls_tab(
			'rate_description_normal',
			[
				'label' => esc_html__( 'Normal', 'elementor' ),
			]
		);
		$this->add_control(
			'rate_description_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-opinion-single .rcode-opinion-description' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'rate_description_typography',
				'selector' => '{{WRAPPER}} .rcode-opinion-single .rcode-opinion-description',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'rate_description_hover',
			[
				'label' => esc_html__( 'Hover', 'elementor' ),
			]
		);

		$this->add_control(
			'rate_description_color_hover',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-opinion-single:hover .rcode-opinion-description' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'rate_description_typography_hover',
				'selector' => '{{WRAPPER}} .rcode-opinion-single:hover .rcode-opinion-description',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'rate_description_shadow',
				'selector' => '{{WRAPPER}} .rcode-opinion-single .rcode-opinion-description',
			]
		);



		$this->add_control(
			'rate_section_style_button',
			[
				'label' => esc_html__( 'Button', 'rawcodeplugin' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);



		$this->start_controls_tabs( 'rate_button_colors' );

		$this->start_controls_tab(
			'rate_button_bg_colors_normal',
			[
				'label' => esc_html__( 'Normal', 'elementor' ),
			]
		);

		$this->add_control(
			'rate_button_primary_color',
			[
				'label' => esc_html__( 'Primary Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => '',
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-opinion-single .rcode-opinion-box-button .rcode-opinion-button' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'rate_button_text_primary_color',
			[
				'label' => esc_html__( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => '',
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-opinion-single .rcode-opinion-box-button .rcode-opinion-button' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'rate_button-border',
				'selector' => '{{WRAPPER}} .rcode-opinion-single .rcode-opinion-box-button .rcode-opinion-button',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'rate_button_bg_colors_hover',
			[
				'label' => esc_html__( 'Hover', 'elementor' ),
			]
		);

		$this->add_control(
			'rate_button_hover_primary_color',
			[
				'label' => esc_html__( 'Primary Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-opinion-single .rcode-opinion-box-button .rcode-opinion-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'rate_button_text_colors_hover',
			[
				'label' => esc_html__( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => '',
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-opinion-single .rcode-opinion-box-button .rcode-opinion-button:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'rate_button-border-hover',
				'selector' => '{{WRAPPER}} .rcode-opinion-single .rcode-opinion-box-button .rcode-opinion-button:hover',
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->add_responsive_control(
			'rate_button_space',
			[
				'label' => esc_html__( 'Box Padding', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .rcode-opinion-single .rcode-opinion-box-button .rcode-opinion-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'rate_text_button_typography',
				'selector' => '{{WRAPPER}} .rcode-opinion-single .rcode-opinion-box-button .rcode-opinion-button',
				'default' => '',
			]
		);
		$this->add_responsive_control(
			'rate_button_align',
			[
				'label' => esc_html__( 'Alignment', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'elementor' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'elementor' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rcode-opinion-single .rcode-opinion-box-button' => 'text-align: {{VALUE}};',
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

		 if ( $settings['list'] ) {
			echo '<section class="rcode-services-container column-grid-' . $settings['box_col_style'] . '">';
			
			foreach (  $settings['list'] as $key => $item) {

				echo '<div class="rcode-services-single ">'; 


					$this->add_render_attribute( 'icon-'. $key, 'class', [ 'elementor-icon' ] );
				
			
					if ( ! isset( $item['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
						// add old default
						$item['icon'] = 'fa fa-star';
					}
			
					$has_icon = ! empty( $item['icon'] );
			
			
					if ( $has_icon ) {
						$this->add_render_attribute( 'i-'. $key, 'class', $item['icon'] );
						$this->add_render_attribute( 'i-'. $key, 'aria-hidden', 'true' );
					}
		

					$this->add_render_attribute( 'description_text-'. $key, 'class', 'elementor-icon-box-description' );

					$this->add_inline_editing_attributes( 'title_text', 'none' );
					$this->add_inline_editing_attributes( 'description_text' );
	

					if ( ! $has_icon && ! empty( $item['selected_icon']['value'] ) ) {
						$has_icon = true;
					}
					$migrated = isset( $item['__fa4_migrated']['selected_icon'] );
					$is_new = ! isset( $item['icon'] ) && Icons_Manager::is_migration_allowed();
		
					?>
					
						<div class="elementor-icon-box-wrapper">
				
								<?php if ( $has_icon ) : ?>
								<div class="elementor-icon-box-icon">
									<?php
									if ( $is_new || $migrated ) {
										Icons_Manager::render_icon( $item['selected_icon'], [ 'aria-hidden' => 'true' ] );
									} elseif ( ! empty( $item['icon'] ) ) {
										?><i <?php $this->print_render_attribute_string( 'i-' . $key ); ?>></i><?php
									}
									?>
								</div>
								<?php endif; ?>
								<div class="elementor-icon-box-content">
									<<?php Utils::print_validated_html_tag( $settings['title_size'] ); ?> class="elementor-icon-box-title">
											<?php echo $item['title_text']; ?>
									</<?php Utils::print_validated_html_tag( $settings['title_size'] ); ?>>
									
									<?php if ( ! Utils::is_empty( $item['description_text'] ) ) : ?>
										<p <?php $this->print_render_attribute_string( 'description_text-' . $key ); ?>>
											<?php echo $item['description_text'];?>
										</p>
									<?php endif; ?>
								</div>
							</div>
				
					
							<div class="rcode-service-box-button">
								<a role="button" href="<?php echo $item['link']['url'];?>" class="rcode-service-button"><?php echo $item['link_text'];?>
								<i class="fas fa-long-arrow-alt-right"></i>
							</a>
							</div>
					<?php

				echo '</div>'; 

			}

			if($settings['opinion_on'] == 'yes'){
				
				$opinionRateValue = $this->get_settings( 'opinion_rate' );
				$opinionRate = number_format( $opinionRateValue, 1 );

				?>
				<div class="rcode-opinion-single rcode-opinion-box">
				
				<div class="opinion-box-wrapper">
					<div class="opinion-box-rate">
						<span class="rcode-opinion-rating"><?php echo $opinionRate; ?></span><span class="rcode-opinion-maxrate"> / 5.0</span>
					</div>
					<div class="rcode-opinion-description">
						<?php echo $settings['opinion_description']; ?>
					</div>
				</div>
				<div class="rcode-opinion-box-button">
					<a role="button" href="<?php echo $settings['opinion_link']['url'];?>" class="rcode-opinion-button"><?php echo $settings['opinion_link_text'];?>
						<i class="fas fa-long-arrow-alt-right"></i>
					</a>
				</div>

				</div>
				<?php
			}
		


			echo '</section>';
		}

	}
}

    