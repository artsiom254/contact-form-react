<?php

if (function_exists("acf_add_options_page")) {

    $page = acf_add_options_page([
        'page_title' => __('Contact Form Settings'),
        'menu_title' => __('CF Settings'),
        "menu_slug" => "cf-settings",
        "capability" => "edit_posts",
        "redirect"   => false,
        'position'   => 2,
    ]);
}


if (function_exists("acf_add_local_field_group")):

    acf_add_local_field_group(
        [
            "key" => "cf_settings_acf",
            "title" => "CF Settings",
            "fields" => [
                [
                    "key" => "field_cf_title",
                    "label" => "Title",
                    "type" => "text",
                    "name" => "cf_settings_title",
                ],
            ],
            "location" => [
                [
                    [
                        "param" => "options_page",
                        "operator" => "==",
                        "value" => "cf-settings",
                    ],
                ],
            ],
            "menu_order" => 0,
            "position" => "normal",
            "style" => "default",
            "label_placement" => "top",
            "instruction_placement" => "label",
            "hide_on_screen" => "",
            "active" => true,
            "description" => "",
        ]
    );

endif;
