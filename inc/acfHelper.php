<?php
if (!class_exists('ACFHelper')) {
    class ACFHelper
    {
        public static function get_field($selector, $post_id = false, $format_value = true)
        {
            if (function_exists('get_field')) {
                return get_field($selector, $post_id, $format_value);
            }
            return '';
        }

        public static function acf_get_fields($parent)
        {
            if (function_exists('acf_get_fields')) {
                return acf_get_fields($parent);
            }
            return [];
        }

        public static function get_fields($post_id = false, $format_value = true)
        {
            if (function_exists('get_fields')) {
                return get_fields($post_id, $format_value);
            }
            return [];
        }

        public static function update_field($selector, $value, $post_id = false)
        {
            if (function_exists('update_field')) {
                return update_field($selector, $value, $post_id);
            }
        }

        public static function add_row($selector, $row = false, $post_id = false)
        {
            if (function_exists('add_row')) {
                return add_row($selector, $row, $post_id);
            }
        }

        public static function have_rows($selector, $post_id = false)
        {
            if (function_exists('have_rows')) {
                return have_rows($selector, $post_id);
            }
            return false;
        }

        public static function the_row()
        {
            if (function_exists('the_row')) {
                return the_row();
            }
        }
    }
}
