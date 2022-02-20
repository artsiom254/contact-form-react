<?php

/*
Plugin Name: Contact Form
Description: Contact Form
Version: 1.0
Author: Artem
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!class_exists('CFContactForm')) :

    class CFContactForm
    {

        public string $shortcodeName = 'react_contact_form';

        public function __construct()
        {
            // Do nothing.
        }

        public function initialize()
        {
            $this->define('CF_PLUGIN_DIR', plugin_dir_path(__FILE__));
            $this->define('CF_PLUGIN_URL', plugin_dir_url(__FILE__));
            $this->define('DOMAINNAME', 'company');

            add_action('plugins_loaded', function () {
                $this->loadIncludes();
                $this->initReactShortcode();
            });
        }

        public function loadIncludes()
        {
            foreach (glob(CF_PLUGIN_DIR . "/inc/*.php") as $function) {
                $function = basename($function);
                require_once CF_PLUGIN_DIR . '/inc/' . $function;
            }
        }

        public function define($name, $value = true)
        {
            if (!defined($name)) {
                define($name, $value);
            }
        }

        public function initReactShortcode()
        {
            $name = $this->getShortcodeName();
            add_shortcode($name, [$this, 'addReactShortcode']);
        }

        public function getShortcodeName()
        {
            return $this->shortcodeName;
        }

        public function addReactShortcode()
        {
            $pathPrefix = CF_PLUGIN_DIR . 'react-app';
            $urlPrefix = CF_PLUGIN_URL . 'react-app';
            $name = $this->getShortcodeName();
            $asset = $pathPrefix . '/build/asset-manifest.json';
            if (file_exists($asset)) {
                $string = file_get_contents($asset);
                $entrypoints = json_decode($string, true)["entrypoints"];
                foreach ($entrypoints as $key => $filename) {
                    $type = pathinfo($filename, PATHINFO_EXTENSION);
                    if ($type == 'js') {
                        wp_enqueue_script(
                            'react-js-' . $name . $key,
                            $urlPrefix . '/build/' . $filename,
                            [],
                            '',
                            true
                        );
                    }
                    if ($type == 'css') {
                        wp_enqueue_style('react-css-' . $name . $key, $urlPrefix . '/build/' . $filename);
                    }
                }
                $apiUrl = get_rest_url();
                return '<div id="root_cf" data-api="' . $apiUrl . '"></div>';
            }
        }
    }
endif;

if (!function_exists('cfContactForm')):
    function cfContactForm()
    {
        global $cfContactForm;
        if (!isset($cfContactForm)) {
            $cfContactForm = new cfContactForm();
            $cfContactForm->initialize();
        }
        return $cfContactForm;
    }
endif;

cfContactForm();

