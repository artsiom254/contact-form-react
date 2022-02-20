<?php
define('ENTRY_POST_TYPE', 'entry');

class EntryPostType
{
    public function __construct()
    {
        $this->hooks();
    }

    public function hooks()
    {
        add_action('init', [$this, 'create']);
        add_filter('manage_' . ENTRY_POST_TYPE . '_posts_columns', [$this, 'setCustomColumns']);
        add_action('manage_' . ENTRY_POST_TYPE . '_posts_custom_column', [$this, 'customColumns'], 10, 2);
    }

    public function create()
    {
        $name = 'Entry';
        $nameM = 'Entries';
        $args = array(
            'labels' => array(
                'name' => __($nameM, DOMAINNAME),
                'singular_name' => __($name, DOMAINNAME),
                'add_new' => __('Add New', DOMAINNAME),
                'add_new_item' => __('Add New ' . $name, DOMAINNAME),
                'edit_item' => __('Edit ' . $name, DOMAINNAME),
                'all_items' => __('All ' . $nameM, DOMAINNAME),
                'search_items' => __('Search ' . $name, DOMAINNAME),
            ),
            'hierarchical' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'show_in_admin_bar' => true,
            'menu_position' => 3,
            'public' => false,
            'has_archive' => false,
            'rewrite' => array('slug' => ENTRY_POST_TYPE),
            'show_in_rest' => true,
            'taxonomies' => array(),
            'supports' => array('title'),
            'exclude_from_search' => true,

        );
        register_post_type(ENTRY_POST_TYPE, $args);
    }


    public static function setCustomColumns($columns)
    {
        $newColumns = [];
        foreach ($columns as $key => $value) {
            $newColumns[$key] = $value;
            if ($key == 'title') {
                $newColumns['entry_number'] = 'Entry Number';
            }
        }
        return $newColumns;
    }

    public static function customColumns($column, $id)
    {
        switch ($column) {
            case 'entry_number' :
                $data = ACFHelper::get_fields($id);
                echo $data['entry_number'];
                break;
        }
    }
}

new EntryPostType();
