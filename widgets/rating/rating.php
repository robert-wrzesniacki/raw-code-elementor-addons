<?php
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Rating extends Widget_Base {

	/**
	 * Get widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'rating';
	}

	/**
	 * Get widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return 'Rating';
	}

	/**
	 * Get widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-rating';
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

		$this->add_control(
			'opinion_rate',
			[
				'label' => esc_html__( 'Rating - x / 5.0', 'rawcodeplugin' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 5,
				'step' => 0.1,
				'default' => 5.0,

			]
		);
		$this->add_control(
			'opinion_description',
			[
				'label' => esc_html__( 'Description', 'rawcodeplugin' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,

			]
		);
		$this->add_control(
			'opinion_link',
			[
				'label' => esc_html__( 'Opinion Link', 'rawcodeplugin' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'elementor' ),
				'separator' => 'before',

			]
		);

		$this->add_control(
			'opinion_link_text',
			[
				'label' => esc_html__( 'Opinion Link Text', 'rawcodeplugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'See opinions', 'rawcodeplugin' ),
				'label_block' => true,

			]
		);
		$this->end_controls_section();






		$this->start_controls_section(
			'section_style_opinion',
			[
				'label' => esc_html__( 'Box', 'rawcodeplugin' ),
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
				'global' => [
					'default' => '',
				],
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



		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_style_rate',
			[
				'label' => esc_html__( 'Rate', 'rawcodeplugin' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_style_maxrate',
			[
				'label' => esc_html__( 'Max Rate', 'rawcodeplugin' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_style_description',
			[
				'label' => esc_html__( 'Description', 'rawcodeplugin' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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


		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_style_button',
			[
				'label' => esc_html__( 'Button', 'rawcodeplugin' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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

			echo '<section class="rcode-opinion-container">';

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
			
			echo '</section>';

	}
}

    