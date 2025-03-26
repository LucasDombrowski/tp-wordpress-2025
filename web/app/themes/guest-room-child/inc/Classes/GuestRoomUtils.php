<?php

/**
 * The GuestRoomUtils class provides the core utils of the Guest Room Utils.
 */

namespace GuestRoomChild\Classes;

use GuestRoomChild\Enums\GuestRoomChildTexts;

class GuestRoomUtils{
    public static function instance(){
        return new self();
    }

    public static function theme_uri() : string{
        return get_stylesheet_directory_uri();
    }

    public static function theme_path() : string{
        return get_stylesheet_directory();
    }

    public static function parent_theme_uri() : string{
        return get_template_directory_uri();
    }

    public static function parent_theme_path() : string{
        return get_template_directory();
    }

    public function theme_file_uri(string $file) : string{
        return self::theme_uri() . '/' . $file;
    }

    public static function prefix_text(string $text){
        return GuestRoomChildTexts::THEME_PREFIX->value . '-' . $text;
    }

    public function register_style(string $handle, string $src, array $deps = [], string | bool $ver = false, string $media = 'all'){
        wp_register_style(self::prefix_text($handle), $this->theme_file_uri($src), $deps, $ver, $media);
    }

    public function enqueue_style(string $handle){
        wp_enqueue_style(self::prefix_text($handle));
    }

    public function register_script(string $handle, string $src, array $deps = [], string | bool $ver = false, bool $in_footer = true){
        wp_register_script(self::prefix_text($handle), $this->theme_file_uri($src), $deps, $ver, $in_footer);
    }

    public function enqueue_script(string $handle){
        wp_enqueue_script(self::prefix_text($handle));
    }

    public static function get_template_part(string $slug, string $name = '', array $args = []){
        $template_dir = "template-parts";
        get_template_part($template_dir."/".$slug, $name, $args);
    }

    public static function prefix_classes(string $classes, array $ignore = []){
        return implode(' ', array_map(function(string $class) use ($ignore){
            if(in_array($class, $ignore)){
                return $class;
            }
            return self::prefix_text($class);
        }, explode(' ', $classes)));
    }
}