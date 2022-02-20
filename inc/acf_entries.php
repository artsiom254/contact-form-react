<?php
if (function_exists('acf_add_local_field_group')):

    acf_add_local_field_group(
        array(
            'key' => 'group_cf_entries',
            'title' => 'Entries',
            'fields' => array(
                array(
                    'key' => 'field_cf_entry_number',
                    'label' => 'Entry Number',
                    'name' => 'entry_number',
                    'type' => 'text',
                    'wrapper' => array(
                        'width' => '50',
                    ),
                ),
                array(
                    'key' => 'field_cf_entry_subject',
                    'label' => 'Entry Subject',
                    'name' => 'entry_subject',
                    'type' => 'text',
                    'wrapper' => array(
                        'width' => '50',
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'entry',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
            'show_in_rest' => 0,
        )
    );

endif;

