<?php
namespace Elementor;

use ElementorPro\Modules\QueryControl\Module as Module_Query;
use ElementorPro\Modules\QueryControl\Controls\Group_Control_Related;
use Elementor\Utils;
use ElementorPro\Base\Module_Base;
use ElementorPro\Modules\Posts\Data\Controller;
use ElementorPro\Modules\Posts\Widgets\Posts_Base;
use ElementorPro\Plugin;

class PostLS extends Widget_Base {

	/**
	 * Get widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */

     /**
	 * @var \WP_Query
	 */
	private $_query = null;

	public function get_name() {
		return 'postls';
	}

	/**
	 * Get widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return 'PostLS';
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
	 * Get Query Name
	 *
	 * Returns the query control name used in the widget's main query.
	 *
	 * @since 3.8.0
	 *
	 * @return string
	 */
	public function get_query() {
		return $this->_query;
	}
    public function query_posts() {
		$query_args = [
			'posts_per_page' => '6'
		];

		/** @var Module_Query $elementor_query */
		$elementor_query = Module_Query::instance();
		$this->_query = $elementor_query->get_query( $this, 'posts', $query_args, [] );
	}
    protected function render_filter_menu() {
		// $taxonomy = 'categories';

		// if ( ! $taxonomy ) {
		// 	return;
		// }

		// $terms = [];

		// foreach ( $this->_query->posts as $post ) {
		// 	$terms += $post->tags;
		// }

		// if ( empty( $terms ) ) {
		// 	return;
		// }

		// usort( $terms, function( $a, $b ) {
		// 	return strcmp( $a->name, $b->name );
		// } );

		// ?>
		<ul class="elementor-portfolio__filters">
			<li class="elementor-portfolio__filter elementor-active" data-filter="__all"><?php echo esc_html__( 'All', 'elementor-pro' ); ?></li>
			<?php foreach ( $terms as $term ) { ?>
				<li class="elementor-portfolio__filter" data-filter="<?php echo esc_attr( $term->term_id ); ?>"><?php echo esc_html( $term->name ); ?></li>
			<?php } ?>
		</ul>
		<?php
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
         $this->query_posts();

         $wp_query = $this->get_query();
 
         if ( ! $wp_query->found_posts ) {
             return;
         }
 
        // $this->get_posts_tags();
 
        // $this->render_loop_header();
         $this->render_filter_menu();
         ?><ul><?php
         while ( $wp_query->have_posts() ) {
             $wp_query->the_post();
 
             $this->render_post();
         }
         ?></ul><?php
         //$this->render_loop_footer();
 
		

	}
    protected function render_post() {
        ?>
            <li>
                 <h3 class="rcode-projects-title"><?php echo esc_attr( get_the_title() ); ?></h3>
            </li>
     <?php
    }
}

    