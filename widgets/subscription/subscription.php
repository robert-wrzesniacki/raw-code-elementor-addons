<?php
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Subscription extends Widget_Base {

	/**
	 * Get widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'subscription';
	}

	/**
	 * Get widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return 'Subscription';
	}

	/**
	 * Get widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-price-table';
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
            'hours',
            [
                'label' => esc_html__( 'Number of hours', 'rawcodeplugin' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1000,
                'step' => 1,
                'default' => 10,
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
			'subtitle_text',
			[
				'label' => '',
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'This is the subheading', 'elementor' ),
				'placeholder' => esc_html__( 'Enter your subtitle', 'elementor' ),
                'separator' => 'none',
				'show_label' => false,
                'label_block' => true,
			]
		);
        $repeater->add_control(
			'description_text',
			[
				'label' => esc_html__( 'Description', 'elementor' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => '',
				'separator' => 'none',
				//'show_label' => false,
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
				'label' => esc_html__( 'Subscription List', 'rawcodeplugin' ),
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
			'subtitle_size',
			[
				'label' => esc_html__( 'Sub Title HTML Tag', 'elementor' ),
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
				'default' => 'h4',
			]
		);
        $this->add_control(
			'hours_text',
			[
				'label' => esc_html__( 'Hours sufix', 'rawcodeplugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'h / miesiąc', 'rawcodeplugin' ),
				'placeholder' => esc_html__( 'Enter hours sufix', 'rawcodeplugin' ),
                'separator' => 'none',
				'show_label' => true,
                'label_block' => true,
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

        $this->start_controls_tabs( 'box' );

	    $this->start_controls_tab(
			'box_normal',
			[
				'label' => esc_html__( 'Normal', 'elementor' ),
			]
		);
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background-normal',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rcode-subscription-single',
			]
		); 
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border-normal',
                'label' => esc_html__( 'Border', 'elementor' ),
				'selector' => '{{WRAPPER}} .rcode-subscription-single',
			]
		);
        $this->add_responsive_control(
            'border_radius_normal',
            [
                'label' => __( 'Border Radius', 'elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .rcode-subscription-single' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->add_responsive_control(
            'triangle_space_normal',
            [
                'label' => esc_html__( 'Triangle Distance', 'rawcodeplugin' ),
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
					'{{WRAPPER}} .rcode-subscription-single a::before' => 'top: {{SIZE}}{{UNIT}}; right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rcode-subscription-single span::before' => 'top: {{SIZE}}{{UNIT}}; right: {{SIZE}}{{UNIT}};',
				],
            ]
        );
		$this->add_responsive_control(
            'triangle_size_normal',
            [
                'label' => esc_html__( 'Triangle Size', 'rawcodeplugin' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'default' => [
					'size' => 35,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rcode-subscription-single a::before' => 'border-top-width: {{SIZE}}{{UNIT}}; border-left-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rcode-subscription-single span::before' => 'border-top-width: {{SIZE}}{{UNIT}}; border-left-width: {{SIZE}}{{UNIT}};',
				],
            ]
        );
		$this->add_control(
			'triangle_color_normal',
			[
				'label' => esc_html__( 'Triangle Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-subscription-single a::before ' => 'border-top-color: {{VALUE}};',
					'{{WRAPPER}} .rcode-subscription-single span::before ' => 'border-top-color: {{VALUE}};',
				],
 				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				], 
			]
		);


        $this->end_controls_tab();

	    $this->start_controls_tab(
			'box_hover',
			[
				'label' => esc_html__( 'Hover', 'elementor' ),
			]
		);
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background-hover',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rcode-subscription-single:hover',
			]
		); 
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border-hover',
                'label' => esc_html__( 'Border', 'elementor' ),
				'selector' => '{{WRAPPER}} .rcode-subscription-single:hover',
			]
		);
        $this->add_responsive_control(
            'border_radius_hover',
            [
                'label' => __( 'Border Radius', 'elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .rcode-subscription-single:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'triangle_space_hover',
            [
                'label' => esc_html__( 'Triangle Distance', 'rawcodeplugin' ),
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
					'{{WRAPPER}} .rcode-subscription-single:hover a::before' => 'top: {{SIZE}}{{UNIT}}; right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rcode-subscription-single:hover span::before' => 'top: {{SIZE}}{{UNIT}}; right: {{SIZE}}{{UNIT}};',
				],
            ]
        );
		$this->add_responsive_control(
            'triangle_size_hover',
            [
                'label' => esc_html__( 'Triangle Size', 'rawcodeplugin' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'default' => [
					'size' => 35,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rcode-subscription-single:hover a::before' => 'border-top-width: {{SIZE}}{{UNIT}}; border-left-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rcode-subscription-single:hover span::before' => 'border-top-width: {{SIZE}}{{UNIT}}; border-left-width: {{SIZE}}{{UNIT}};',
				],
            ]
        );
		$this->add_control(
			'triangle_color_hover',
			[
				'label' => esc_html__( 'Triangle Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-subscription-single:hover a::before' => 'border-top-color: {{VALUE}};',
					'{{WRAPPER}} .rcode-subscription-single:hover span::before' => 'border-top-color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				], 
			]
		);
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'box_space',
            [
                'label' => esc_html__( 'Box Padding', 'elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'isLinked' => 'true',
                'selectors' => [
                    '{{WRAPPER}} .rcode-subscription-single span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rcode-subscription-single a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
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
					'{{WRAPPER}} .rcode-subscription-single' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'heading_sufix',
			[
				'label' => esc_html__( 'Hours suffix', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->start_controls_tabs( 'sufix_colors' );
		$this->start_controls_tab(
			'sufix_color_normal',
			[
				'label' => esc_html__( 'Normal', 'elementor' ),
			]
		);

		$this->add_control(
			'sufix_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-subscription-hours' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_TEXT,
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'sufix_color_hover',
			[
				'label' => esc_html__( 'Hover', 'elementor' ),
			]
		);

		$this->add_control(
			'hover_sufix_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-subscription-single:hover .rcode-subscription-hours' => 'color: {{VALUE}};',
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
				'name' => 'sufix_typography',
				'selector' => '{{WRAPPER}} .rcode-subscription-hours',
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
					'{{WRAPPER}} .rcode-subscription-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .rcode-subscription-title' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
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
					'{{WRAPPER}} .rcode-subscription-single:hover .rcode-subscription-title ' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .rcode-subscription-title',

			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'text_stroke',
				'selector' => '{{WRAPPER}} .rcode-subscription-title',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .rcode-subscription-title',
			]
		);

		$this->add_control(
			'heading_subtitle',
			[
				'label' => esc_html__( 'Sub Title', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'subtitle_bottom_space',
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
					'{{WRAPPER}} .rcode-subscription-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->start_controls_tabs( 'subtitle_colors' );

		$this->start_controls_tab(
			'subtitle_colors_normal',
			[
				'label' => esc_html__( 'Normal', 'elementor' ),
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-subscription-subtitle' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'subtitle_colors_hover',
			[
				'label' => esc_html__( 'Hover', 'elementor' ),
			]
		);

		$this->add_control(
			'hover_subtitle_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-subscription-single:hover .rcode-subscription-subtitle ' => 'color: {{VALUE}};',
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
				'name' => 'subtitle_typography',
				'selector' => '{{WRAPPER}} .rcode-subscription-subtitle',
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
					'{{WRAPPER}} .rcode-subscription-description' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .rcode-subscription-single:hover .rcode-subscription-description' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .rcode-subscription-description',
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
            echo '<section class="rcode-subscription-container">';

            foreach (  $settings['list'] as $key => $item) {
                echo '<div class="rcode-subscription-single">';

                $blok_tag = 'span';
                if ( ! empty( $item['link']['url'] ) ) {
                    $blok_tag = 'a';
                    $this->add_link_attributes( 'link-'. $key, $item['link'] );
                }
                ?>
                <<?php Utils::print_validated_html_tag( $blok_tag ); ?> <?php $this->print_render_attribute_string( 'link-' . $key ); ?>>
                <p class="rcode-subscription-hours">
                    <?php echo $item['hours'];?><?php echo $settings['hours_text'];?> 
                </p>
                
                <<?php Utils::print_validated_html_tag( $settings['title_size'] ); ?> class="rcode-subscription-title">
                    <?php echo $item['title_text']; ?>
				</<?php Utils::print_validated_html_tag( $settings['title_size'] ); ?>>
                
                <<?php Utils::print_validated_html_tag( $settings['subtitle_size'] ); ?> class="rcode-subscription-subtitle">
                    <?php echo $item['subtitle_text']; ?>
				</<?php Utils::print_validated_html_tag( $settings['subtitle_size'] ); ?>>
                
                <div class="rcode-subscription-description">
                    <?php echo $item['description_text'];?>
                </div>
                </<?php Utils::print_validated_html_tag( $blok_tag ); ?>>
				<?php
                echo '</div>';
            }
            echo '</section>';
        }

	} 
}

    