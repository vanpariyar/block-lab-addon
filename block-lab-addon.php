<?php
/**
 * Block Lab Addon
 *
 * @package           Block Lab Addon
 * @author            Ronak Vanpariya
 * @copyright         creole studios
 * @license           GPL-2.0-or-later
 *
 * @block-lab-addon
 * Plugin Name:       Block Lab Addon
 * Plugin URI:        https://www.creolestudios.com
 * Description:       Description of the plugin.
 * Version:           1.0.0
 * Requires at least: 5.4
 * Requires PHP:      7.2
 * Author:            Ronak Vanpariya
 * Author URI:        https://github.com/vanpariyar
 * Text Domain:       block-lab-addon
 * Domain path:       languages
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */


if ( !function_exists( 'add_action' ) ) {
	echo __('Hi there!  I\'m just a plugin, not much I can do when called directly.', 'block-lab-addon');
	exit;
}

/* Plugin Constants */
if (!defined('BLOCK_LAB_ADDON_URL')) {
    define('BLOCK_LAB_ADDON_URL', plugin_dir_url(__FILE__));
}

if (!defined('BLOCK_LAB_ADDON_PLUGIN_PATH')) {
    define('BLOCK_LAB_ADDON_PLUGIN_PATH', plugin_dir_path(__FILE__));
}

class Block_lab_addon_init {
    function __construct(){
        add_action('plugins_loaded', array( $this,'check_some_other_plugin'), 10 );
        add_filter( 'block_lab_template_path', array( $this,'add_template_path'), 10 , 1 );  
        add_action( 'block_lab_add_blocks', array( $this,'add_block_lab_layout'), 10 );  
        add_action('wp_enqueue_scripts', array($this, 'enqueue_addons_scripts'));
        add_action('after_setup_theme', array($this, 'the_slider_config') );
    } 
    
    public function check_some_other_plugin() {
		if ( ! function_exists( 'block_lab' ) ) {
			add_action( 'admin_notices', function() {				
				echo '<div class="error"><p><strong>' . esc_html__( 'Block Lab Addons plugin require Block lab Plugin installed / activated', 'block-lab-addon' ) . '</strong><code>Link:- https://wordpress.org/plugins/block-lab/</code></p></div>';
			} );
			return;
		}
    }
    
    /**
     * adding template path for our plugin
     */
    function add_template_path( $template_path ){
        return BLOCK_LAB_ADDON_PLUGIN_PATH;
    }

    /**
     * adding template path for our plugin
     */
    function add_block_lab_layout(){
        block_lab_add_block(
            'plugin-slider', 
            array( 
                'title'    => 'Plugin Slider', 
                'category' => 'common', 
                'icon'     => 'waves', 
                //'excluded' => array( 'page' ), 
                'keywords' => array( 'slider plugin', 'plugin', ), 
                'fields'   => array( 
                    'title' => array( 
                        'label'   => 'Title', 
                        'control' => 'text', 
                        'width'   => '100', 
                        'default' => true, 
                    ), 
                    'image-1' => array( 
                        'label'   => 'Image 1', 
                        'control' => 'image', 
                        'width'   => '25', 
                        'default' => '', 
                    ),
                    'image-2' => array( 
                        'label'   => 'Image 2', 
                        'control' => 'image', 
                        'width'   => '25', 
                        'default' => '', 
                    ),
                    'image-3' => array( 
                        'label'   => 'Image 3', 
                        'control' => 'image', 
                        'width'   => '25', 
                        'default' => '', 
                    ),
                    'image-4' => array( 
                        'label'   => 'Image 4', 
                        'control' => 'image', 
                        'width'   => '25', 
                        'default' => '', 
                    ),
                    'image-5' => array( 
                        'label'   => 'Image 5', 
                        'control' => 'image', 
                        'width'   => '25', 
                        'default' => '', 
                    ),
                    'item-per-slide' => array( 
                        'label'   => 'item per slide', 
                        'control' => 'range',
                        'step'    => '1',  
                        'max'     => '15',   
                        'width'   => '100',
                        'location'=> 'inspector',
                        'default' => '1', 
                    ),
                    'show-navigation' => array( 
                        'label'   => 'Show navigation', 
                        'control' => 'toggle',   
                        'width'   => '100',
                        'location'=> 'inspector',
                    ),  
                    'show-dots' => array( 
                        'label'   => 'Show Dots', 
                        'control' => 'toggle',   
                        'width'   => '100',
                        'location'=> 'inspector',
                    ), 
                    'auto-play' => array( 
                        'label'   => 'Auto Play', 
                        'control' => 'toggle',   
                        'width'   => '100',
                        'location'=> 'inspector',
                    ), 
                ), 
            ) 
        ); 
    }

    /**
     * slider image config
     */
    static function the_slider_config( ){
        if( function_exists("block_value") ){
            $return_array = [
                'items' => block_value('item-per-slide'),
                'nav' => (block_value('show-navigation')) ? 1 : 0,
                'dots' => (block_value('show-dots')) ? 1 : 0,
                'autoplay' => (block_value('auto-play')) ? 1 : 0,
            ];
            return json_encode($return_array);
        }
    }    

    function enqueue_addons_scripts(){
        wp_enqueue_style( 'owl-style-min',  BLOCK_LAB_ADDON_URL.'/assets/owlslider/owl.carousel.min.css',
           '',
            '' // this only works if you have Version in the style header
        );
        wp_enqueue_style( 'owl-style-min-theme',  BLOCK_LAB_ADDON_URL.'/assets/owlslider/owl.theme.default.min.css',
           '',
            '' // this only works if you have Version in the style header
        );
        wp_enqueue_script('owl-theme-min-js', BLOCK_LAB_ADDON_URL.'/assets/owlslider/owl.carousel.min.js', 
            array('jquery'),
            '',
            false
        );

        /**Fancy Box Slider */
        wp_enqueue_style( 'fancybox-min-style',  BLOCK_LAB_ADDON_URL.'/assets/fancybox/jquery.fancybox.min.css', '',
            '' // this only works if you have Version in the style header
        );
        wp_enqueue_script('fancybox-min-js', BLOCK_LAB_ADDON_URL.'/assets/fancybox/jquery.fancybox.min.js', 
            array('jquery'),
            '',
            false
        );

        wp_enqueue_script('blocklabaddon-custom-js', BLOCK_LAB_ADDON_URL.'/assets/custom.js', 
            array('jquery'),
            '',
            false
        );
    }

    
}

$block_lab_addon_init = new Block_lab_addon_init();