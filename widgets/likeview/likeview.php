<?php
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class LikeView extends Widget_Base {

	/**
	 * Get widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'likeview';
	}

	/**
	 * Get widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return 'Like/Views';
	}

	/**
	 * Get widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-heart-o';
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
			'button_on',
			[
				'label' => esc_html__( 'Show Like Button', 'rawcodeplugin' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rawcodeplugin' ),
				'label_off' => esc_html__( 'Hide', 'rawcodeplugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'text_on',
			[
				'label' => esc_html__( 'Show Text', 'rawcodeplugin' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rawcodeplugin' ),
				'label_off' => esc_html__( 'Hide', 'rawcodeplugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'likeview_text',
			[
				'label' => esc_html__( 'Like Text', 'rawcodeplugin' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Did you like this project?<br> Let me know about it!', 'rawcodeplugin' ),
				'rows' => 10,
				'condition' => [
					'text_on' => 'yes',
				],
			]
		);

		$this->add_control(
			'likes_on',
			[
				'label' => esc_html__( 'Show Likes Count', 'rawcodeplugin' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rawcodeplugin' ),
				'label_off' => esc_html__( 'Hide', 'rawcodeplugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'views_on',
			[
				'label' => esc_html__( 'Show Views Count', 'rawcodeplugin' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rawcodeplugin' ),
				'label_off' => esc_html__( 'Hide', 'rawcodeplugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);


		$this->end_controls_section();

		//   Style Control Section 

		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__( 'Box', 'rawcodeplugin' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
// Icon Size
// Icon Color
// Text Color
// Text Typo
// LikeView Color 
// LikeView Typo
// LikeView Spacing

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'rawcodeplugin' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .like-button .like-button-inner i' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .like-button .like-button-inner i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'rawcodeplugin' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-likeview-box .rcode-likeview-text' => 'color: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'selector' => '{{WRAPPER}} .rcode-likeview-box .rcode-likeview-text',
			]
		);
		$this->add_control(
			'likeview_color',
			[
				'label' => esc_html__( 'Likes/Views Color', 'rawcodeplugin' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rcode-likeview-box .rcode-likeview-count .post-views' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rcode-likeview-box .rcode-likeview-count .post-likes' => 'color: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'likeview_typography',
				'selector' => '{{WRAPPER}} .rcode-likeview-box .rcode-likeview-count .post-views, 
								{{WRAPPER}} .rcode-likeview-box .rcode-likeview-count .post-likes',
			]
		);
		$this->add_responsive_control(
			'likeview_spacing',
			[
				'label' => esc_html__( 'Spacing', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rcode-likeview-box .rcode-likeview-count' => 'gap: {{SIZE}}{{UNIT}};',
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

		?>

 		<section class="rcode-likeview-box">
			<?php if($settings['button_on'] == 'yes'){ ?>
				<div class="rcode-likeview-button">
					<?php add_like_button(); ?>
				</div>
				<div class="rcode-likeview-info"></div>
			<?php } ?>
			<?php if($settings['text_on'] == 'yes'){ ?>
				<div class="rcode-likeview-text"><?php echo $settings['likeview_text']; ?></div>
			<?php } ?>
			<?php if($settings['likes_on'] == 'yes' || $settings['views_on'] == 'yes'){ ?>
				<div class="rcode-likeview-count">
					<?php if($settings['views_on'] == 'yes'){ ?>
					<div>
						<span class="post-views">
							<i class="fa fa-eye"></i>
								<?php 
								$postviews = get_post_meta( get_the_ID(), 'post_views_count', true );
								echo ($postviews) ? $postviews : '0';
								echo ' ';
								echo __( 'Views', 'rawcodeplugin' ); 
								?>
						</span>
					</div>
					<?php } ?>
					<?php if($settings['likes_on'] == 'yes'){ ?>
					<div>
						<span class="post-likes">
							<i class="fa fa-heart"></i>
							<span class="like-count">
								<?php 
									$postlikes = get_post_meta( get_the_ID(), '_likes', true );
									echo ($postlikes) ? $postlikes : '0';
								?>
							</span>
								<?php 
								echo ' ';
								echo __( 'Likes', 'rawcodeplugin' );
								?>
						</span>                
					</div>
					<?php } ?>
				</div>
			<?php } ?>
		</section>	

		<?php
	}
}

    