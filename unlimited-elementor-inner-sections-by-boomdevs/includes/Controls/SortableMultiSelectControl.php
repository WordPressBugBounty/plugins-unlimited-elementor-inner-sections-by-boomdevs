<?php

namespace PrimeElementorAddons\Controls;

use Elementor\Base_Data_Control;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class SortableMultiSelectControl extends Base_Data_Control {

    public function get_type() {
        return 'sortable_multiselect';
    }

    public function enqueue() {

        wp_enqueue_script(
            'sortable-multiselect-control',
            PEA_CONTROLS_URL . 'assets/js/sortable-multiselect.js',
            ['jquery','jquery-ui-sortable'],
            '1.0',
            true
        );

        wp_enqueue_style(
            'sortable-multiselect-control',
            PEA_CONTROLS_URL . 'assets/css/sortable-multiselect.css',
            [],
            '1.0'
        );
    }

    protected function get_default_settings() {
        return [
            'options' => [],
            'multiple' => true,
            'placeholder' => __('Select items…', 'unlimited-elementor-inner-sections-by-boomdevs'),
            'hideSelected' => true, // flag for JS to know
        ];
    }

    public function content_template() {

        ?>
        <div class="elementor-control-field">

            <label class="elementor-control-title">{{{ data.label }}}</label>

            <select class="elementor-control-input sortable-multiselect" multiple>

                <# _.each( data.options, function( label, value ) { #>

                    <option value="{{ value }}">
                        {{{ label }}}
                    </option>

                <# }); #>

            </select>

        </div>
        <?php
    }
}