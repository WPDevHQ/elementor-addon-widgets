<?php

    class Elementor_Addon_Widgets {

        /**
         * A reference to an instance of this class.
         */
        private static $instance;

        /**
         * Returns an instance of this class. 
         */
        public static function get_instance() {

                if( null == self::$instance ) {
                        self::$instance = new Elementor_Addon_Widgets();
                } 

                return self::$instance;

        }

        public function eaw_load_plugin_textdomain() {
		    load_plugin_textdomain( 'elementor-addon-widgets' );
	    }
		
		/**
	     * Cloning is forbidden.
	     *
	     * @since 1.0.0
	     */
	    public function __clone() {
		    _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'elementor-addon-widgets' ), '1.0.0' );
	    }

	    /**
	     * Unserializing instances of this class is forbidden.
	     *
	     * @since 1.0.0
	     */
	    public function __wakeup() {
		   _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'elementor-addon-widgets' ), '1.0.0' );
	    }
		
        /**
         * Initializes the plugin by setting filters and administration functions.
         */
        private function __construct() {

                add_action( 'init', array( $this, 'eaw_load_plugin_textdomain' ) );
				
				add_action( 'widgets_init', array( $this, 'eaw_addon_woo_widgets' ) );
				
				add_action( 'widgets_init', array( $this, 'eaw_addon_posts_widgets' ) );
				
				add_action( 'wp_enqueue_scripts', array( $this, 'eaw_styles' ), 999 );
				
        }

        /**
	     * WooCommerce Widget section
	     * @since   1.0.0
	     * @return 	void
	     */
	    public static function eaw_addon_woo_widgets() {	        
		    if ( is_woocommerce_activated() ) { // Lets not do anything unless WooCommerce is active!
			    include_once( plugin_dir_path( __FILE__ ) . 'widgets/woo/products-categories.php' );
			    include_once( plugin_dir_path( __FILE__ ) . 'widgets/woo/recent-products.php' );
			    include_once( plugin_dir_path( __FILE__ ) . 'widgets/woo/featured-products.php' );
			    include_once( plugin_dir_path( __FILE__ ) . 'widgets/woo/popular-products.php' );
			    include_once( plugin_dir_path( __FILE__ ) . 'widgets/woo/sale-products.php' );
			    include_once( plugin_dir_path( __FILE__ ) . 'widgets/woo/best-products.php' );
			
			    register_widget( 'Woo_Product_Categories' );
			    register_widget( 'Woo_Recent_Products' );
			    register_widget( 'Woo_Featured_Products' );
			    register_widget( 'Woo_Popular_Products' );
			    register_widget( 'Woo_Sale_Products' );
			    register_widget( 'Woo_Best_Products' );
			}
			include_once( plugin_dir_path( __FILE__ ) . 'widgets/wp/eaw-posts-widget.php');
			register_widget( 'EAW_Recent_Posts' );
	    }
		
		/**
	     * Posts Widget section
	     * @since   1.0.0
	     * @return 	void
	     */
	    public static function eaw_addon_posts_widgets() {
			
		}
		
		/**
	     * Enqueue CSS and custom styles.
	     * @since   1.0.0
	     * @return  void
	     */
	    public function eaw_styles() {
		    wp_enqueue_style( 'eaw-styles', plugins_url( '/css/eaw.css', __FILE__  ) );		
	    }
    }
add_action( 'plugins_loaded', array( 'Elementor_Addon_Widgets', 'get_instance' ) );