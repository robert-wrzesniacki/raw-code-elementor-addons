<?php
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class GoodToKnow extends Widget_Base {

	/**
	 * Get widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'goodtoknow';
	}

	/**
	 * Get widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return 'Good To Know';
	}

	/**
	 * Get widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-icon-box';
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



		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Good To Know List', 'rawcodeplugin' ),
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
					'{{WRAPPER}} .rcode-goodtoknow-single' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .rcode-goodtoknow-single' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .rcode-goodtoknow-single',
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
					'{{WRAPPER}} .rcode-goodtoknow-single:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .rcode-goodtoknow-single:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border-hover',
				'selector' => '{{WRAPPER}} .rcode-goodtoknow-single:hover',
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
					'{{WRAPPER}} .rcode-goodtoknow-single' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$this->start_controls_tabs( 'icon_colors' );

		$this->start_controls_tab(
			'icon_colors_normal',
			[
				'label' => esc_html__( 'Normal', 'elementor' ),
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
					'{{WRAPPER}} .rcode-goodtoknow-single .elementor-icon-box-icon i' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
					'{{WRAPPER}} .rcode-goodtoknow-single .elementor-icon-box-icon svg' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_colors_hover',
			[
				'label' => esc_html__( 'Hover', 'elementor' ),
			]
		);

		$this->add_control(
			'hover_primary_color',
			[
				'label' => esc_html__( 'Primary Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-goodtoknow-single:hover .elementor-icon-box-icon i' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
					'{{WRAPPER}} .rcode-goodtoknow-single:hover .elementor-icon-box-icon svg' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'elementor' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

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
					'{{WRAPPER}} .elementor-icon-box-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-goodtoknow-single .elementor-icon-box-title ' => 'color: {{VALUE}};',
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
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-goodtoknow-single:hover .elementor-icon-box-title ' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();


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
		$this->start_controls_tabs( 'description_colors' );
		$this->start_controls_tab(
			'description_color_normal',
			[
				'label' => esc_html__( 'Normal', 'elementor' ),
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-goodtoknow-single .elementor-icon-box-description' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_TEXT,
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'description_color_hover',
			[
				'label' => esc_html__( 'Hover', 'elementor' ),
			]
		);

		$this->add_control(
			'hover_description_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-goodtoknow-single:hover .elementor-icon-box-description' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_TEXT,
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();


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
			echo '<section class="rcode-goodtoknow-container">';
			
			foreach (  $settings['list'] as $key => $item) {

				echo '<div class="rcode-goodtoknow-single ">'; 


					$this->add_render_attribute( 'icon-'. $key, 'class', [ 'elementor-icon' ] );
					
					$icon_tag = 'span';
			
					if ( ! isset( $item['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
						// add old default
						$item['icon'] = 'fa fa-star';
					}
			
					$has_icon = ! empty( $item['icon'] );
			
					if ( ! empty( $item['link']['url'] ) ) {
						$icon_tag = 'a';
						$this->add_link_attributes( 'link-'. $key, $item['link'] );
					}
			
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
					
					<<?php Utils::print_validated_html_tag( $icon_tag ); ?> <?php $this->print_render_attribute_string( 'link-' . $key ); ?>>
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
					</<?php Utils::print_validated_html_tag( $icon_tag ); ?>>
					<?php

				echo '</div>'; 

			}
			echo '</section>';
		}

	}
}

    