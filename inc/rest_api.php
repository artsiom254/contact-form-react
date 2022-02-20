<?php

class EntryRouter
{
    public string $routePrefix = 'cf/v1';
    public string $route = '/entry';

    public function __construct()
    {
        $this->hooks();
    }

    public function hooks()
    {
        add_action('rest_api_init', [$this, 'registerRoutes']);
    }

    public function registerRoutes()
    {
        register_rest_route($this->routePrefix, $this->route . '/variables', array(
            'methods' => 'GET',
            'callback' => [$this, 'getVariables'],
            'permission_callback' => '__return_true',
        ));

        register_rest_route($this->routePrefix, $this->route . '/create', array(
            'methods' => 'POST',
            'callback' => [$this, 'createEntry'],
            'permission_callback' => '__return_true',
        ));
    }

    public function getVariables()
    {
        $fields = ACFHelper::acf_get_fields('cf_settings_acf');
        $acfFields = [];
        foreach ($fields as $field) {
            if ($field['name'] != '') {
                $acfFields[$field['name']] = ACFHelper::get_field($field['name'], 'option');
            }
        }

        $data = wp_json_encode($acfFields);
        if (wp_doing_ajax()) {
            echo $data;
            wp_die();
        } else {
            return $data;
        }
    }

    public function createEntry($params)
    {
        $postData = $params->get_json_params();
        if ($postData) {
            $id = wp_insert_post([
                'post_title' => 'CF',
                'post_type' => 'entry'
            ]);
            $title = 'CF' . sprintf("%06d", $id);
            wp_update_post([
                'ID' => $id,
                'post_title' => $title
            ]);
            ACFHelper::update_field('entry_number', $title, $id);
            foreach ($postData as $key => $value) {
                ACFHelper::update_field($key, $value, $id);
            }

            $data =  $title;
            if (wp_doing_ajax()) {
                echo $data;
                wp_die();
            } else {
                return $data;
            }
        }
    }
}

new EntryRouter();




