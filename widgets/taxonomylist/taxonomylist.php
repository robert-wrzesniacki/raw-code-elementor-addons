<?php
namespace Elementor;

class TaxonomyList extends Widget_Base {

	/**
	 * Get widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'taxonomy-list';
	}

	/**
	 * Get widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return 'Taxonomy List';
	}

	/**
	 * Get widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-editor-list-ul';
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
	protected function _register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Content', 'rawcodeplugin'),
            ]
        );

    $this->add_control(
            'heading',
            [
                'label' => __( 'Heading', 'rawcodeplugin' ),
                'type' => Controls_Manager::TEXT,
                'input_type' => 'text',
                'default' => 'Tytuł: ',
                'label_block' => true,
            ]
        );    

    // Wybór taksonomii w odpowiednim formacie
    $formatted_taxonomies = $this->get_formatted_taxonomies();
    $this->add_control(
        'taxonomy',
        [
            'label' => __('Select Taxonomy', 'rawcodeplugin'),
            'type' => Controls_Manager::SELECT,
            'options' => $formatted_taxonomies,
            'default' => key($formatted_taxonomies), // Wybieramy domyślną wartość (pierwszą) z listy
        ]
    );
    $this->add_control(
        'separator',
        [
            'label' => __( 'Separator', 'rawcodeplugin' ),
            'type' => Controls_Manager::TEXT,
            'input_type' => 'text',
            'default' => ', ',
        ]
    );    

        $this->end_controls_section();
    }

   // Funkcja pomocnicza do pobrania dostępnych typów postów
   private function get_post_types() {
    $post_types = get_post_types(['public' => true], 'objects');
    $options = [];

    foreach ($post_types as $post_type) {
        $options[$post_type->name] = $post_type->label;
    }

    return $options;
}

// Funkcja pomocnicza do pobrania dostępnych taksonomii w odpowiednim formacie (Post Type Label - Taxonomy Label)
private function get_formatted_taxonomies() {
    $taxonomies = get_taxonomies(['public' => true], 'objects');
    $options = [];

    foreach ($taxonomies as $taxonomy) {
        // Pobieramy tylko taksonomie, które mają co najmniej jeden element
        $terms = get_terms([
            'taxonomy' => $taxonomy->name,
            'hide_empty' => true,
        ]);

        if (!empty($terms)) {
            $post_type_object = get_post_type_object($taxonomy->object_type[0]);
            $post_type_label = $post_type_object->label;
            $taxonomy_label = $taxonomy->labels->name;

            $options[$taxonomy->name] = $post_type_label . ' - ' . $taxonomy_label;
        }
    }

    return $options;
}

 protected function render() {
            $settings = $this->get_settings_for_display();

            // Pobieranie listy wartości wybranej taksonomii
            $terms = get_terms([
                'taxonomy' => $settings['taxonomy'],
                'hide_empty' => true, // Ukrywa puste taksonomie
            ]);
            // Sprawdzamy, czy taksonomia zawiera jakieś elementy przed jej wyświetleniem
            echo '<div class="rcode-taxonomy-head"> '. $settings['heading'] . '</div>';
            echo '<div class="rcode-taxonomy-list">';
            if (!empty($terms)) {
                foreach ($terms as $term) {
                    // Tworzenie linku do strony taksonomii
                    $term_link = get_term_link($term);

                    echo '<span><a href="' . esc_url($term_link) . '">' . esc_html($term->name) . '</a>';

                    if(next($terms)) {
                        echo $settings['separator'];
                   }

                   echo '</span>';
                }
            } else {
                echo 'Brak wartości dla wybranej taksonomii.';
            }
            echo '</div>';
        }



}

    