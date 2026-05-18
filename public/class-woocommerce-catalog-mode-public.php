<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.welaunch.io
 * @since      1.0.0
 *
 * @package    WooCommerce_Catalog_Mode
 * @subpackage WooCommerce_Catalog_Mode/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WooCommerce_Catalog_Mode
 * @subpackage WooCommerce_Catalog_Mode/public
 * @author     Daniel Barenkamp <support@welaunch.io>
 */
class WooCommerce_Catalog_Mode_Public extends WooCommerce_Catalog_Mode {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	protected $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of this plugin.
	 */
	protected $version;

	/**
	 * options of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $options
	 */
	protected $options;

	/**
	 * if true this product will be excluded
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $options
	 */
	private $exclude;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) 
	{
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Enqueu Styles
	 * @author Daniel Barenkamp
	 * @version 1.0.0
	 * @since   1.0.0
	 * @link    https://www.welaunch.io
	 * @return  [type]                       [description]
	 */
	public function enqueue_styles() 
	{
		global $woocommerce_catalog_mode_options;
		$this->options = $woocommerce_catalog_mode_options;

		if (!$this->get_option('enable')) {
			return false;
		}

		if($this->get_option('performanceOnlyWooPages') && !class_exists('WooCommerce_Quick_order') && !class_exists('WooCommerce_Variations_Table') && (!is_shop() && !is_product() && !is_product_category() && !is_product_tag() && !is_product_taxonomy() && !is_cart()) ){
			return;
		}

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woocommerce-catalog-mode-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Enque JS SCripts
	 * @author Daniel Barenkamp
	 * @version 1.0.0
	 * @since   1.0.0
	 * @link    https://www.welaunch.io
	 * @return  [type]                       [description]
	 */
	public function enqueue_scripts() 
	{
		global $woocommerce_catalog_mode_options;
		$this->options = $woocommerce_catalog_mode_options;

		if (!$this->get_option('enable')) {
			return false;
		}

		if($this->get_option('performanceOnlyWooPages') && !class_exists('WooCommerce_Quick_order') && !class_exists('WooCommerce_Variations_Table') && (!is_shop() && !is_product() && !is_product_category() && !is_product_tag() && !is_product_taxonomy() && !is_cart()) ){
			return;
		}

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/woocommerce-catalog-mode-public.js', array( 'jquery' ), $this->version, true );

		$forJS = array(
			'skuField' => $this->get_option('singleProductButtonContactformSKUField') ? $this->get_option('singleProductButtonContactformSKUField') : 'sku',
			'productField' => $this->get_option('singleProductButtonContactformProductField') ? $this->get_option('singleProductButtonContactformProductField') : 'product',
			'productsField' => $this->get_option('enquiryCartContactformProductsField') ? $this->get_option('enquiryCartContactformProductsField') : 'products',
			'SKUSelector' => $this->get_option('singleProductButtonContactformSKUSelector') ? $this->get_option('singleProductButtonContactformSKUSelector') : '.sku',
			'productSelector' => $this->get_option('singleProductButtonContactformProductSelector') ? $this->get_option('singleProductButtonContactformProductSelector') : '[itemprop="name"]',
			'productSelectorFallback' => $this->get_option('singleProductButtonContactformProductSelectorFallback') ? $this->get_option('singleProductButtonContactformProductSelectorFallback') : '.single-product h1',
			'singleProductAddQuantity' => $this->get_option('singleProductAddQuantity'),
			'singleProductButtonAlwaysShow' => $this->get_option('singleProductButtonAlwaysShow'),
			
			'enquiryCartShowPrice' => $this->get_option('enquiryCartShowPrice'),
			'enquiryCartShowSKU' => $this->get_option('enquiryCartShowSKU'),
			'enquiryCartShowAttributes' => $this->get_option('enquiryCartShowAttributes'),
			'enquiryCartShowQuantity' => $this->get_option('enquiryCartShowQuantity'),
			'enquiryCartShowTotal' => $this->get_option('enquiryCartShowTotal'),
			'enquiryCartRedirect' => $this->get_option('enquiryCartRedirect'),

			'ajaxURL' => admin_url('admin-ajax.php'),
			'singleProductButtonURLFormField' => $this->get_option('singleProductButtonURLFormField'),
			'singleProductButtonCategoriesFormField' => $this->get_option('singleProductButtonCategoriesFormField'),


			'extraProductOptionsSupport' => $this->get_option('extraProductOptionsSupport'),
			
		);
		wp_localize_script($this->plugin_name, 'woocommerce_catalog_mode_options', $forJS);
		
	}

	/**
	 * Get Options
	 * @author Daniel Barenkamp
	 * @version 1.0.0
	 * @since   1.0.0
	 * @link    https://www.welaunch.io
	 * @param   [type]                       $option [description]
	 * @return  [type]                               [description]
	 */
    private function get_option($option)
    {
    	if(!is_array($this->options)) {
    		return false;
    	}
    	
    	if(!array_key_exists($option, $this->options))
    	{
    		return false;
    	}
    	return $this->options[$option];
    }
	
    /**
     * Inits the Catalog Mode
     * @author Daniel Barenkamp
     * @version 1.0.0
     * @since   1.0.0
     * @link    https://www.welaunch.io
     * @return  [type]                       [description]
     */
    public function init()
    {

		global $woocommerce_catalog_mode_options;
		$this->options = $woocommerce_catalog_mode_options;
		if (!$this->get_option('enable')) {
			return false;
		}

		// Custom Free Price
		if($this->get_option('customFreePrice') || $this->get_option('renamePrice')){
			add_filter('woocommerce_get_price_html', array($this, 'customFreePriceText')); 
			add_filter('woocommerce_cart_item_price', array($this, 'customCartFreePriceText'), 20, 3); 
			
			// add_filter('woocommerce_free_sale_price_html', array($this, 'customFreePriceText'));
			// add_filter('woocommerce_free_price_html', array($this, 'customFreePriceText'));
			// add_filter('woocommerce_variation_free_price_html', array($this, 'customFreePriceText'));
			// add_filter('woocommerce_variable_free_sale_price_html', array($this, 'customFreePriceText'));
			// add_filter('woocommerce_variable_free_price_html', array($this, 'customFreePriceText'));
			// add_filter('woocommerce_order_shipping_to_display', array($this, 'customFreePriceText'));
		}
		
		add_action( 'wp_footer', array($this,'enquiryModal'), 10 );
		add_shortcode('woocommerce_catalog_mode_button', array($this, 'button_shortcode'));

		$excludeUserRoles = $this->get_option('applyForExcludeUserRoles');
		if(is_array($excludeUserRoles) && !empty($excludeUserRoles)) {

			$currentUserRole = $this->get_user_role();
			if(in_array($currentUserRole, $excludeUserRoles))
			{
				return false;
			}
		}

		// Only not logged in
		if($this->get_option('applyForUserGroup') == 2) {
			if(is_user_logged_in()) {
				return false;
			}
		}

		// Only logged in
		if($this->get_option('applyForUserGroup') == 3) {
			if(!is_user_logged_in()) {
				return false;
			}
		}

		// Exclude countries
		if($this->get_option('excludeCountries') && class_exists('WC_Geolocation'))
		{
			$WC_Geolocation = new WC_Geolocation();
			$country = $WC_Geolocation->geolocate_ip();
			$usersCountry = $country['country'];

			$countriesToExclude = $this->get_option('countriesToExclude');
			$countriesToExcludeRevert = $this->get_option('countriesToExcludeRevert');
			
			if(!empty($countriesToExclude)){
				if($countriesToExcludeRevert) {
					if(!in_array($usersCountry, $countriesToExclude)) {
						return false;
					}
				} else {
					if(in_array($usersCountry, $countriesToExclude)) {
						return false;
					}
				}
			}
		}

		$this->hideRankMathSchema();

		if($this->get_option('hardRemovePrices') or $this->get_option('hardRemoveAddToCart')) {
			add_action('wp_head', array($this, 'hardRemove'), 100);
		}

		if($this->get_option('redirectCartAndCheckoutPages')) {
			add_action( 'wp', array($this, 'redirect_cart_and_checkout_pages'));
		}

		if($this->get_option('enquiryCartEnable')) {

			if($this->get_option('enquiryCartRemoveCoupons')) {
				add_filter( 'woocommerce_coupons_enabled' , array($this, 'remove_coupon_from_cart'));
			}

			if($this->get_option('enquiryCartRemoveCrossSells')) {
				remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
			}

			if($this->get_option('enquiryCartRemoveCheckout')) {
				remove_action('woocommerce_cart_collaterals', 'woocommerce_cart_totals');
			}

			$enquiryCartBtnActionHook = $this->get_option('enquiryCartBtnActionHook') ? $this->get_option('enquiryCartBtnActionHook') : 'woocommerce_cart_actions';

			// Go to product page
			if($this->get_option('enquiryCartBtnAction') == 1) {
				add_action($enquiryCartBtnActionHook, array($this, 'add_enquiry_cart_button'));
				add_action('wp_footer', array($this, 'enquiryCartModal'), 10 );
			}

			// Go to custom URL
			if($this->get_option('enquiryCartBtnAction') == 2) {
				add_action($enquiryCartBtnActionHook, array($this, 'add_enquiry_url_button'));
			}
		}

		add_action( 'woocommerce_before_shop_loop_item', array($this,  'check_loop' ) );
		add_action( 'woocommerce_before_single_product', array($this,  'check_single' ) );

    }

    public function maybe_remove_price($price, $product) 
    {
    	if(!is_object($product)) {
    		return $price;
    	}

    	return false;
    }

    /**
     * Check if catalog mode should apply in loop
     * @author Daniel Barenkamp
     * @version 1.0.0
     * @since   1.0.0
     * @link    https://www.welaunch.io
     * @return  [type]                       [description]
     */
    public function check_loop() 
    {
    	$apply = true;

		$excludeProductCategories = $this->get_option('excludeProductCategories');
		if(!empty($excludeProductCategories)) 
		{
			if($this->excludeProductCategories()) {
				$apply = FALSE;
			}
		}

		$excludeProducts = $this->get_option('excludeProducts');
		if(!empty($excludeProducts)) 
		{
			if($this->excludeProducts()) {
				$apply = FALSE;
			}
		}

		$includeZeroPriceProductsOnly = $this->get_option('includeZeroPriceProductsOnly');
		if(!empty($includeZeroPriceProductsOnly)) {
			if(!$this->checkZeroPriceProduct()) {
				$apply = false;
			}
		}

		if($apply) {

			$this->remove_add_to_cart();
			$this->remove_price();
			$this->showLoopButton();

			if($this->get_option('enquiryCartEnable')) {
				add_filter( 'woocommerce_product_add_to_cart_text' , array($this, 'enquiry_cart_button_text'), 10, 1);
				add_filter( 'woocommerce_product_single_add_to_cart_text' , array($this, 'enquiry_cart_button_text'), 10, 1);
			}

		} else {

			// $this->add_add_to_cart();
			// $this->add_remove_price();

			$loopButtonAlwaysShow = $this->get_option('loopButtonAlwaysShow');
			if(!$loopButtonAlwaysShow) {
				$this->hideLoopButton();
			} else {
				$this->showLoopButton();
			}
		}
		
    }

    /**
     * Check if apply on single Product
     * @author Daniel Barenkamp
     * @version 1.0.0
     * @since   1.0.0
     * @link    https://www.welaunch.io
     * @return  [type]                       [description]
     */
    public function check_single()
    {
    	$apply = true;

		$excludeProductCategories = $this->get_option('excludeProductCategories');
		if(!empty($excludeProductCategories)) {
			if($this->excludeProductCategories()) {
				$apply = false;
			}
		}

		$excludeProducts = $this->get_option('excludeProducts');
		if(!empty($excludeProducts)) {
			if($this->excludeProducts()) {
				$apply = false;
			}
		}

		$includeZeroPriceProductsOnly = $this->get_option('includeZeroPriceProductsOnly');
		if(!empty($includeZeroPriceProductsOnly)) {
			if(!$this->checkZeroPriceProduct()) {
				$apply = false;
			}
		}

		// Not in exclusion list
		if($apply) {

			if($this->get_option('enquiryCartEnable')) {
				add_filter( 'woocommerce_product_add_to_cart_text' , array($this, 'enquiry_cart_button_text'), 10, 1);
				add_filter( 'woocommerce_product_single_add_to_cart_text' , array($this, 'enquiry_cart_button_text'), 10, 1);
			}

			$this->remove_add_to_cart();
			$this->remove_price();
			$this->showSingleProductButton();
		} else {

			$singleProductButtonAlwaysShow = $this->get_option('singleProductButtonAlwaysShow');
			if($singleProductButtonAlwaysShow) {
				$this->showSingleProductButton();
			}
		}
    }

    public function hideRankMathSchema()
    {
    	if(!$this->get_option('rankMathSupport')) {
    		return;
    	}

    	add_filter( 'rank_math/json_ld', array($this, 'hideRankMathSchemaJSONLD'), 20, 2); 
		add_filter( 'rank_math/opengraph/facebook/product_price_amount', '__return_false' );
		add_filter( 'rank_math/opengraph/facebook/product_price_currency', '__return_false' );
    }

	/**
	 * Strip prices from Rank Math Product schema.
	 *
	 * Works site-wide. If you prefer per-product control, see the optional section below.
	 */
	function hideRankMathSchemaJSONLD( $data, $jsonld ) {

	    // Helper: remove price-y fields from an Offer/AggregateOffer structure.
	    $scrub_offer = function( &$offer ) {
	        // Remove common price-related fields.
	        foreach ( [ 'price', 'priceCurrency', 'lowPrice', 'highPrice', 'priceValidUntil', 'availability', 'priceSpecification' ] as $k ) {
	            if ( isset( $offer[ $k ] ) ) {
	                unset( $offer[ $k ] );
	            }
	        }
	        // If there are nested offers (AggregateOffer -> offers), scrub each.
	        if ( isset( $offer['offers'] ) && is_array( $offer['offers'] ) ) {
	            foreach ( $offer['offers'] as &$nested ) {
	                $this->__invoke($nested); // call scrub recursively
	            }
	        }
	    };

	    // Normalize to array of schemas (Rank Math may use associative keys).
	    foreach ( $data as $key => &$schema ) {
	        if ( ! is_array( $schema ) ) {
	            continue;
	        }

	        // Detect Product type (Rank Math can use '@type' as string or array).
	        $type = isset( $schema['@type'] ) ? $schema['@type'] : null;
	        $is_product = ( $type === 'Product' ) || ( is_array( $type ) && in_array( 'Product', $type, true ) );

	        if ( ! $is_product ) {
	            continue;
	        }

	        // Option A (strict): remove the entire offers block to fully hide pricing.
	        if ( isset( $schema['offers'] ) ) {
	            unset( $schema['offers'] );
	        }

	        // Option B (softer): if you prefer to keep offers but blank price fields, comment out Option A above
	        // and use the following instead:
	        /*
	        if ( isset( $schema['offers'] ) ) {
	            if ( is_array( $schema['offers'] ) && array_is_list( $schema['offers'] ) ) {
	                foreach ( $schema['offers'] as &$offer ) {
	                    $scrub_offer( $offer );
	                }
	            } else {
	                $scrub_offer( $schema['offers'] );
	            }
	        }
	        */
	    }

	    return $data;
	}

    public function checkZeroPriceProduct()
    {
    	global $product;

    	if(!$product) {
    		return false;
    	}

    	$price = $product->get_price();
    	return empty($price);
    }

    /**
     * Show Loop Button
     * @author Daniel Barenkamp
     * @version 1.0.0
     * @since   1.0.0
     * @link    https://www.welaunch.io
     * @return  [type]                       [description]
     */
	public function showLoopButton()    
	{
		if(!$this->get_option('loopButtonEnabled')) {
			return FALSE;
		}

		$loopButtonHook = $this->get_option('loopButtonHook');
		$loopButtonHookPriority = $this->get_option('loopButtonHookPriority');

		// Go to product page
		if($this->get_option('loopButtonAction') == 1) {
			add_action($loopButtonHook, array($this,'loopProductPageButton'), $loopButtonHookPriority);
		}

		// Go to custom URL
		if($this->get_option('loopButtonAction') == 2) {
			add_action($loopButtonHook, array($this,'loopCustomURLButton'), $loopButtonHookPriority);
		}

		if($this->get_option('loopButtonAction') == 3) {
			add_action($loopButtonHook, array($this,'loopEnquiryForm'), $loopButtonHookPriority);
		}
	}

	/**
	 * Hide Loop Button
	 * @author Daniel Barenkamp
	 * @version 1.0.0
	 * @since   1.0.0
	 * @link    https://www.welaunch.io
	 * @return  [type]                       [description]
	 */
	public function hideLoopButton()    
	{
		$loopButtonHook = $this->get_option('loopButtonHook');
		$loopButtonHookPriority = $this->get_option('loopButtonHookPriority');

		remove_action($loopButtonHook, array($this,'loopProductPageButton'), $loopButtonHookPriority);
		remove_action($loopButtonHook, array($this,'loopProductPageButton'), $loopButtonHookPriority);
		remove_action($loopButtonHook, array($this,'loopEnquiryForm'), $loopButtonHookPriority);
	}

	/**
	 * Show Single Product Button
	 * @author Daniel Barenkamp
	 * @version 1.0.0
	 * @since   1.0.0
	 * @link    https://www.welaunch.io
	 * @return  [type]                       [description]
	 */
    public function showSingleProductButton()
    {
    	global $product;

		// Custom Button
		if($this->get_option('singleProductButtonEnabled'))
		{
			if($this->get_option('singleProductOnlyOutOfStock') && $product->is_in_stock())  {
				return false;
			}
            $buttonPosition = $this->get_option('singleProductButtonPosition');
            !empty($buttonPosition) ? $buttonPosition = $buttonPosition : $buttonPosition = 'woocommerce_single_product_summary';

            $buttonPriority = $this->get_option('singleProductButtonPriority');
            !empty($buttonPriority) ? $buttonPriority = $buttonPriority : $buttonPriority = 30;

			// Go to product page
			if($this->get_option('singleProductButtonAction') == 1 ) {
                $modalPosition = $this->get_option('singleProductButtonModalPosition');
                !empty($modalPosition) ? $modalPosition = $modalPosition : $modalPosition = 'wp_footer';


				add_action( $buttonPosition, array($this,'enquiryButton'), $buttonPriority );
			}

			// Go to custom URL
			if($this->get_option('singleProductButtonAction') == 2) {
				add_action( $buttonPosition, array($this,'singleProductCustomURLButton'), $buttonPriority );
			}
		}
    }

    /**
     * Exclude Product Categories
     * @author Daniel Barenkamp
     * @version 1.0.0
     * @since   1.0.0
     * @link    https://www.welaunch.io
     * @return  [type]                       [description]
     */
    public function excludeProductCategories()
    {
    	global $post;

		$excludeProductCategories = $this->get_option('excludeProductCategories');
		$excludeProductCategoriesRevert = $this->get_option('excludeProductCategoriesRevert');
		$terms = get_the_terms( $post->ID, 'product_cat' );
		if($terms)
		{
			foreach ($terms as $term)
			{
				if($excludeProductCategoriesRevert) {
					if(!in_array($term->term_id, $excludeProductCategories))
					{
						return TRUE;

					}
				} else {
					if(in_array($term->term_id, $excludeProductCategories))
					{
						return TRUE;

					}
				}
			}
		}
    }

    /**
     * Exclude Products
     * @author Daniel Barenkamp
     * @version 1.0.0
     * @since   1.0.0
     * @link    https://www.welaunch.io
     * @return  [type]                       [description]
     */
    public function excludeProducts()
    {
    	global $post;

		$excludeProducts = $this->get_option('excludeProducts');
		$excludeProductsRevert = $this->get_option('excludeProductsRevert');
		if($excludeProductsRevert) {
			if(!in_array($post->ID, $excludeProducts))
			{
				return TRUE;
			}
		} else {
			if(in_array($post->ID, $excludeProducts))
			{
				return TRUE;
			}
		}
    }

    /**
     * Removes the add to cart button
     * @author Daniel Barenkamp
     * @version 1.0.0
     * @since   1.0.0
     * @link    https://www.welaunch.io
     * @return  [type]                       [description]
     */
	public function remove_add_to_cart()
	{
		if(!$this->get_option('removeAddToCart')) {
			return FALSE;
		}

		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	}

	/**
	 * [grouped_remove_quantity_field description]
	 * @author Daniel Barenkamp
	 * @version 1.0.0
	 * @since   1.0.0
	 * @link    https://www.welaunch.io
	 * @param   [type]                       $grouped_product_columns [description]
	 * @param   [type]                       $product                 [description]
	 * @return  [type]                                                [description]
	 */
	public function grouped_remove_quantity_field($grouped_product_columns, $product)
	{
		if (($key = array_search('quantity', $grouped_product_columns)) !== false) {
		    unset($grouped_product_columns[$key]);
		}
		return $grouped_product_columns;
	}

	/**
	 * Add the add to cart button
	 * @author Daniel Barenkamp
	 * @version 1.0.0
	 * @since   1.0.0
	 * @link    https://www.welaunch.io
	 */
	public function add_add_to_cart()
	{
		add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	}

	/**
	 * Removes the price
	 * @author Daniel Barenkamp
	 * @version 1.0.0
	 * @since   1.0.0
	 * @link    https://www.welaunch.io
	 * @return  [type]                       [description]
	 */
	public function remove_price()
	{
		if(!$this->get_option('removePrice')) {
			return FALSE;
		}

		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
		add_filter( 'woocommerce_get_price_html', array($this, 'remove_price_html')); 
		// add_filter('woocommerce_grouped_product_columns', array($this, 'grouped_remove_price_field'), 10, 2);
	}

	public function remove_price_html($price_html) 
	{
		global $product;

		if(!$product || !is_object($product)) {
			return $price_html;
		}

		if($this->get_option('customFreePrice') || $this->get_option('renamePrice')){
			return $price_html; 
		}

		return '';
	}

	/**
	 * [grouped_remove_quantity_field description]
	 * @author Daniel Barenkamp
	 * @version 1.0.0
	 * @since   1.0.0
	 * @link    https://www.welaunch.io
	 * @param   [type]                       $grouped_product_columns [description]
	 * @param   [type]                       $product                 [description]
	 * @return  [type]                                                [description]
	 */
	public function grouped_remove_price_field($grouped_product_columns, $product)
	{
		if (($key = array_search('price', $grouped_product_columns)) !== false) {
		    unset($grouped_product_columns[$key]);
		}
		return $grouped_product_columns;
	}

	/**
	 * Add the price
	 * @author Daniel Barenkamp
	 * @version 1.0.0
	 * @since   1.0.0
	 * @link    https://www.welaunch.io
	 */
	public function add_remove_price()
	{
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
		add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
	}

	/**
	 * Hard Remove via CSS !important
	 * @author Daniel Barenkamp
	 * @version 1.0.0
	 * @since   1.0.0
	 * @link    https://www.welaunch.io
	 * @return  [type]                       [description]
	 */
	public function hardRemove()
	{

		$excludeProductCategories = $this->get_option('excludeProductCategories');
		$excludeProducts = $this->get_option('excludeProducts');

		$excludeProductCategoriesRevert = $this->get_option('excludeProductCategoriesRevert');
		$excludeProductsRevert = $this->get_option('excludeProductsRevert');

		echo '<style type="text/css">';

		if($this->get_option('removePrice')) {
			echo '.woocommerce-cart-form .product-price, .woocommerce-cart-form .product-subtotal{ display: none; }';

			if($this->get_option('applyForUserGroup') == 2) {
				echo '.logged-in .woocommerce-cart-form .product-price, .logged-in .woocommerce-cart-form .product-subtotal{ display: block; }';					
			}

		}

		if($this->get_option('enquiryCartEnable')) {


			if($this->get_option('enquiryCartRemoveCoupons')) {
				echo 
				'.woocommerce-cart-form .coupon { display: none; }';
			}

			if($this->get_option('enquiryCartRemoveCheckout')) {
				echo 
				' .woocommerce-cart-form .cart-collaterals, .checkout, .checkout-button, .wc-checkout { display: none !important; }';
			}
		}

		if($this->get_option('hardRemoveQuantity'))
		{
			echo '.product-quantity, .quantity, .qty {
				display:none !important;
			}';

			if(!empty($excludeProducts) || !empty($excludeProductCategories)) {

				if(!empty($excludeProductCategories)) 
				{
					
					if($excludeProductCategoriesRevert) {
						$style = 'none';
						echo '.product-quantity, .quantity, .qty {
									display:block !important;
								}';
					} else {
						$style = 'block';
					}

					foreach ($excludeProductCategories as $excludeProductCategory) {
						$cat = get_term( $excludeProductCategory, 'product_cat' );
						echo '
							.term-' . $excludeProductCategory . ' .quantity,
							.term-' . $excludeProductCategory . ' .qty,
							.term-' . $excludeProductCategory . ' .product-quantity, 
							.product_cat-' . $cat->slug . '.product .quantity,
							.product_cat-' . $cat->slug . '.product .qty,
							.product_cat-' . $cat->slug . '.product .product-quantity {
							display: ' . $style . ' !important;
						}';
					}
				}
				
				if(!empty($excludeProducts)) 
				{
					
					if($excludeProductsRevert) {
						$style = 'none';
						echo '.product .single_add_to_cart_button, 
							  .product .add_to_cart_button,
							  .product .quantity {
									display:block !important;
								}';
					} else {
						$style = 'block';
					}
					foreach ($excludeProducts as $excludeProduct) {
						echo '
						.post-' . $excludeProduct . ' .quantity,
						.post-' . $excludeProduct . ' .qty,
						.post-' . $excludeProduct . ' .product-quantity,

						.postid-' . $excludeProduct . ' .quantity,
						.postid-' . $excludeProduct . ' .qty,
						.postid-' . $excludeProduct . ' .product-quantity,

						#product-' . $excludeProduct . ' .quantity,
						#product-' . $excludeProduct . ' .qty,
						#product-' . $excludeProduct . ' .product-quantity,

						li.post--' . $excludeProduct . ' .quantity,
						li.post--' . $excludeProduct . ' .qty,
						li.post--' . $excludeProduct . ' .product-quantity,

						#product-' . $excludeProduct . ' .quantity,
						#product-' . $excludeProduct . ' .qty,
						#product-' . $excludeProduct . ' .product-quantity {
							display: ' . $style . ' !important;
						}';
					}
				}
			}
		}

		// Prices
		if($this->get_option('hardRemovePrices'))
		{
			echo '.product .price, .price, .woocommerce-mini-cart__total, .woocommerce-Price-amount, .price-wrapper {
						display:none !important;
					}';

			if(!empty($excludeProducts) || !empty($excludeProductCategories)) {

				if(!empty($excludeProductCategories)) 
				{
					$excludeProductCategoriesRevert = $this->get_option('excludeProductCategoriesRevert');
					if($excludeProductCategoriesRevert) {
						$style = 'none';
						echo '.product .price, .price, .prices, .woocommerce-Price-amount, .wrapp-product-price, .woocommerce-multi-currency {
									display:block !important;
								}';
					} else {
						$style = 'block';
					}

					foreach ($excludeProductCategories as $excludeProductCategory) {
						$cat = get_term( $excludeProductCategory, 'product_cat' );
						echo '.term-' . $excludeProductCategory . ' .product .price, .term-' . $excludeProductCategory . ' .summary .prices, .term-' . $excludeProductCategory . ' .price, .product_cat-' . $cat->slug . '.product .summary .price, .product_cat-' . $cat->slug . '.product .summary .prices, .term-' . $excludeProductCategory . ' .woocommerce-Price-amount, , .term-' . $excludeProductCategory . ' .price-wrapper, .term-' . $excludeProductCategory . ' .wrapp-product-price,
							.term-' . $excludeProductCategory . ' .woocommerce-multi-currency {
							display: ' . $style . ' !important;
						}';
					}
				}
				
				if(!empty($excludeProducts)) 
				{
					if($excludeProductsRevert) {
						$style = 'none';
						echo '.product .price, .price, .prices, .woocommerce-Price-amount,  .wrapp-product-price, .woocommerce-multi-currency {
									display:block !important;
								}';
					} else {
						$style = 'block';
					}
					foreach ($excludeProducts as $excludeProduct) {
						echo '
						.post-' . $excludeProduct . ' .summary .price,
						.postid-' . $excludeProduct . ' .price,
						.post-' . $excludeProduct . ' .summary .prices, 
						#product-' . $excludeProduct . ' .summary .price, 
						li.post-' . $excludeProduct . ' .price, 
						.post-' . $excludeProduct . ' .woocommerce-Price-amount, 
						.post-' . $excludeProduct . ' .price-wrapper,
						.post-' . $excludeProduct . ' .wrapp-product-price,
						.post-' . $excludeProduct . ' .woocommerce-multi-currency {
							display: ' . $style . ' !important;
						}';
					}
				}
			}
		}

		// Add to Cart
		if($this->get_option('hardRemoveAddToCart'))
		{
			echo '.product .single_add_to_cart_button, .product .add_to_cart_button {
				display:none !important;
			}';


			if(!empty($excludeProducts) || !empty($excludeProductCategories)) {

				if(!empty($excludeProductCategories)) 
				{
					if($excludeProductCategoriesRevert) {
						$style = 'none';
						echo '.product .single_add_to_cart_button, .product .add_to_cart_button {
									display:block !important;
								}';
					} else {
						$style = 'block';
					}

					foreach ($excludeProductCategories as $excludeProductCategory) {
						$cat = get_term( $excludeProductCategory, 'product_cat' );
						echo '.term-' . $excludeProductCategory . ' .product .single_add_to_cart_button, 
							.term-' . $excludeProductCategory . ' .add_to_cart_button, 
							.product_cat-' . $cat->slug . '.product .add_to_cart_button, 
							.product_cat-' . $cat->slug . '.product .single_add_to_cart_button {
							display: ' . $style . ' !important;
						}';
					}
				}
				
				if(!empty($excludeProducts)) 
				{
					if($excludeProductsRevert) {
						$style = 'none';
						echo '.product .single_add_to_cart_button, 
							  .product .add_to_cart_button {
									display:block !important;
								}';
					} else {
						$style = 'block';
					}
					foreach ($excludeProducts as $excludeProduct) {
						echo '
						.post-' . $excludeProduct . ' .summary .single_add_to_cart_button, 
						.postid-' . $excludeProduct . ' .single_add_to_cart_button, 
						#product-' . $excludeProduct . ' .summary  .add_to_cart_button, 
						li.post-' . $excludeProduct . ' .add_to_cart_button,
						.post-' . $excludeProduct . ' .add_to_cart_button {
							display: ' . $style . ' !important;
						}';
					}
				}
			}
		}

		echo '</style>';
	}

	/**
	 * Redirects Cart & Checkout
	 * @author Daniel Barenkamp
	 * @version 1.0.0
	 * @since   1.0.0
	 * @link    https://www.welaunch.io
	 * @return  [type]                       [description]
	 */
    public function redirect_cart_and_checkout_pages()
    {
    	if(is_cart() || is_checkout())
    	{
            wp_redirect( home_url() );
            exit;
    	}
    }

    /**
     * Category pages - Go to product page button
     * @author Daniel Barenkamp
     * @version 1.0.0
     * @since   1.0.0
     * @link    https://www.welaunch.io
     * @return  [type]                       [description]
     */
    public function loopProductPageButton()
    {
    	global $product;
    	$buttonText = apply_filters('woocommerce_catalog_mode_loop_button_text', $this->get_option('loopButtonText') );

		echo ' <a href="' . 
					esc_url( $product->get_permalink( $product->get_id() ) ) . 
					'" class="btn btn-primary button button-primary woocommerce_catalog_product_button">'. 
					$buttonText. 
					'</a>
				  </a>';
    }

    /**
     * Category pages - go to custom URL
     * @author Daniel Barenkamp
     * @version 1.0.0
     * @since   1.0.0
     * @link    https://www.welaunch.io
     * @return  [type]                       [description]
     */
    public function loopCustomURLButton()
    {
    	$buttonText = apply_filters('woocommerce_catalog_mode_loop_custom_url_button_text', $this->get_option('loopButtonText') );
    	$buttonURL = apply_filters('woocommerce_catalog_mode_loop_custom_url_button_url', $this->get_option('loopButtonActionURL') );
    	$buttonTarget = apply_filters('woocommerce_catalog_mode_loop_custom_url_button_target', $this->get_option('loopButtonActionURLTarget') );

		echo ' <a target="' . $buttonTarget . '" href="' . $buttonURL . '" class="button btn btn-primary button-primary woocommerce_catalog_custom_button">' . $buttonText . '</a>';
    }

    /**
     * Category pages - enquiry form
     * @author Daniel Barenkamp
     * @version 1.0.0
     * @since   1.0.0
     * @link    https://www.welaunch.io
     * @return  [type]                       [description]
     */
    public function loopEnquiryForm()
    {
    	global $product;
    	if(!$product) {
    		return;
    	}

    	$buttonText = apply_filters('woocommerce_catalog_mode_loop_custom_url_button_text', $this->get_option('loopButtonText') );
    	$product_data = array(
    		'name' => $product->get_name(),
    		'sku' => $product->get_sku(),
    	);
    	$btnExtra = "data-products='" . json_encode($product_data). "'";

		echo '<a href="#" ' . $btnExtra . ' class="button btn btn-primary button-primary enquiryLoopButton ">' . $buttonText . '</a>';
    }
    

    /**
     * Creates the enquiry button
     * @author Daniel Barenkamp
     * @version 1.0.0
     * @since   1.0.0
     * @link    https://www.welaunch.io
     * @return  [type]                       [description]
     */
    public function enquiryButton()
    {
    	global $product, $woocommerce;
  		$buttonText = apply_filters('woocommerce_catalog_mode_enquiry_button_text', $this->get_option('singleProductButtonText') );

  		if(!$product) {
  			return;
  		}

		if($product->is_type( 'variable' ) && $this->get_option('variationsEnabled'))
		{

			wp_enqueue_script( 'wc-add-to-cart-variation' );

			// Get Available variations?
			$get_variations = count( $product->get_children() ) <= apply_filters( 'woocommerce_ajax_variation_threshold', 30, $product );

			$available_variations = $get_variations ? $product->get_available_variations() : array();
			$attributes           = $product->get_variation_attributes();
			$selected_attributes  = $product->get_default_attributes();

			$attribute_keys  = array_keys( $attributes );
			$variations_json = wp_json_encode( $available_variations );
			$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );


			do_action( 'woocommerce_before_add_to_cart_form' );
						
						
			$variationsDisplay = $this->get_option('variationsDisplay');
			if($variationsDisplay === "dropdown") {

				wp_enqueue_script( 'wc-add-to-cart-variation' );
				?>
				<form class="variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
					<?php do_action( 'woocommerce_before_variations_form' ); ?>

					<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
						<p class="stock out-of-stock"><?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'woocommerce' ) ) ); ?></p>
					<?php else : ?>
						<table class="variations" cellspacing="0">
							<tbody>
								<?php foreach ( $attributes as $attribute_name => $options ) : ?>
									<tr>
										<td class="label"><label for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>"><?php echo wc_attribute_label( $attribute_name ); // WPCS: XSS ok. ?></label></td>
										<td class="value">
											<?php
												wc_dropdown_variation_attribute_options(
													array(
														'options'   => $options,
														'attribute' => $attribute_name,
														'product'   => $product,
													)
												);
												echo end( $attribute_keys ) === $attribute_name ? wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'woocommerce' ) . '</a>' ) ) : '';
											?>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>

						<div class="single_variation_wrap">

							<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
							<input type="hidden" name="variation_id" class="variation_id" value="0" />
							<?php
								/**
								 * Hook: woocommerce_before_single_variation.
								 */
								do_action( 'woocommerce_before_single_variation' );

								/**
								 * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
								 *
								 * @since 2.4.0
								 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
								 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
								 */
								// do_action( 'woocommerce_single_variation' );

								/**
								 * Hook: woocommerce_after_single_variation.
								 */
								do_action( 'woocommerce_after_single_variation' );
							?>
						</div>
					<?php endif; ?>

					<?php do_action( 'woocommerce_after_variations_form' ); ?>
				</form>

				<?php
				do_action( 'woocommerce_after_add_to_cart_form' );
				
				
			} else {
			?>
			<h2><?php _e( 'Variations', 'woocommerce-catalog-mode' ); ?></h2>
			<table class="woocommerce-catalog-mode-variations variations-table">
		 		<thead>
		            <tr>
		            	<?php if($this->get_option('variationsShowImage')){ ?>
		                <th><?php _e( '', 'woocommerce-catalog-mode' ); ?></th>
		                <?php } ?>

		            	<?php if($this->get_option('variationsShowSKU')){ ?>
		                <th><?php _e( 'SKU', 'woocommerce-catalog-mode' ); ?></th>
		                <?php } ?>

			            <?php if($this->get_option('variationsShowPrice')){ ?>
			            <th><?php _e('Price', 'woocommerce-catalog-mode') ?></th>
			            <?php } ?>

		                <?php if($this->get_option('variationsShowDescription')){ ?>
		                <th><?php _e('Description', 'woocommerce-catalog-mode') ?></th>
		                <?php } ?>

		                <?php if($this->get_option('variationsShowAttributes')){
		                	$variation_attributes = $product->get_variation_attributes();
		                	foreach ($variation_attributes as $key => $value) {
		                		echo '<th class="variation-attribute-head-' . $key . '">' . wc_attribute_label($key) . '</th>';
		                	}
			            } ?>
						
		            </tr>
		        </thead>
				<tbody>
		        <?php foreach ($available_variations as $variation) : ?>
		            <?php
		               	$variation_product = new WC_Product_Variation( $variation['variation_id'] );
		               	$variation_product->attributes = $variation['attributes'];
		               	$description = get_post_meta( $variation_product->get_id(), '_variation_description', TRUE);
		            ?>
		            <tr>
		            <?php
					if (isset($variation['image_src'])) :
						$image = $variation['image_src'];
					else :
						$image = 0;
					endif;

					if (!$image) $image = woocommerce_placeholder_img_src();
					?>
						<?php if($this->get_option('variationsShowImage')){ ?>
						<td class="variations-image"><?php echo '<img src="'.$image.'">' ?></td>
						<?php } ?>
		            	<?php if($this->get_option('variationsShowSKU')){ ?>
		                <td class="variations-sku"><?php echo $variation_product->get_sku(); ?></td>
		                <?php } ?>

		                <?php if($this->get_option('variationsShowPrice')){ ?>
		                <td class="variations-price"><?php echo $variation_product->get_price_html() ?></td>
		                <?php } ?>

		                <?php if($this->get_option('variationsShowDescription')){ ?>
		                <td class="variations-description"><?php echo $description; ?></td>
		            	<?php } ?>

		                <?php if($this->get_option('variationsShowAttributes')){ ?>
			           		<?php foreach ($variation_product->get_variation_attributes() as $attr_name => $attr_value) : ?>
			                <td class="variations-attributes variation-attribute-value-<?php echo $attr_name ?>">
			                <?php
			                    // Get the correct variation values
			                    if (strpos($attr_name, '_pa_')){ // variation is a pre-definted attribute
			                        $attr_name = substr($attr_name, 10);
			                        $attr = get_term_by('slug', $attr_value, $attr_name);
			                        $attr_value = $attr->name;

			                        $attr_name = wc_attribute_label($attr_name);
			                    } else {
			                        $attr = maybe_unserialize( get_post_meta( $this->product->id, '_product_attributes' ) );
			                        $attr_name = substr($attr_name, 10);
			                        $attr_name = $attr[0][$attr_name]['name'];
			                    }
			                    if(empty($attr_value)) {
			                    	echo sprintf( __('Any %s', 'woocommerce-pdf-catalog'), $attr_name);
		                    	} else {
		                    		echo $attr_value;
	                    		}
			                ?>
			                </td>
				            <?php endforeach; ?>
			             <?php } ?>
		            </tr>
		        <?php endforeach;?>
		        </tbody>
		    </table>
        <?php
        	}
	    }

	    $productCategories = strip_tags( wc_get_product_category_list( $product->get_id() ) );
	    ?>


		<button id="enquiryButton" type="button" class="btn button btn-primary btn-lg" data-categories="<?php echo $productCategories ?>">
			<?php echo $buttonText ?>
		</button>

		
	<?php
	}

	/**
	 * Creates the enquiry button
	 *
	 * @since    1.0.0
	 */
    public function enquiryModal()
    {
		if($this->get_option('performanceOnlyWooPages') && !class_exists('WooCommerce_Quick_order') && !class_exists('WooCommerce_Variations_Table') && (!is_shop() && !is_product() && !is_product_category() && !is_product_tag() && !is_product_taxonomy()) ){
			return;
		}

    	global $product;
  		$contactForm =  apply_filters('woocommerce_catalog_mode_single_product_modal_contact_form', $this->get_option('singleProductButtonContactform') );
  		$modalSize = $this->get_option('singleProductButtonModalSize');
  		$modalTitle = apply_filters('woocommerce_catalog_mode_single_product_modal_title', $this->get_option('singleProductButtonModalTitle'));
  		?>

		<div id="woocommerce-catalog-mode-enquiry-popup" class="woocommerce-catalog-mode-overlay" style="display: none;"></div>
		<div id="woocommerce-catalog-mode-enquiry-popup-container" class="woocommerce-catalog-mode-popup-container" style="display: none;">
			<a href="#" class="woocommerce-catalog-mode-popup-close">x</a>
			<div class="woocommerce-catalog-mode-popup">
				<div class="woocommerce-catalog-mode-popup-title"><?php echo $modalTitle ?></div>
				<?php echo do_shortcode($contactForm) ?>
			</div>
		</div>		
	<?php
	}

	/**
	 * Custom Button on single product pages
	 * @author Daniel Barenkamp
	 * @version 1.0.0
	 * @since   1.0.0
	 * @link    https://www.welaunch.io
	 * @return  [type]                       [description]
	 */
    public function singleProductCustomURLButton()
    {
    	global $product, $woocommerce;

    	$buttonText = apply_filters('woocommerce_catalog_mode_single_product_button_text', $this->get_option('singleProductButtonText') );
    	$buttonURL = apply_filters('woocommerce_catalog_mode_single_product_button_url', $this->get_option('singleProductButtonActionURL') );
    	$buttonTarget = apply_filters('woocommerce_catalog_mode_single_product_button_target', $this->get_option('singleProductButtonActionURLTarget') );

		if($product->is_type( 'variable' ) && $this->get_option('variationsEnabled') && ($this->get_option('variationsDisplay') == "table"))
		{
			$attributes = $product->get_variation_attributes();
			$attribute_keys = array_keys( $attributes );
			$available_variations = $product->get_available_variations();

			if( version_compare( $woocommerce->version, '3.0.0', ">=" ) ) {
				$selected_attributes = $product->get_default_attributes();
			} else {
				$selected_attributes = $product->get_variation_default_attributes();
			}
			
			?>
			<h2><?php _e( 'Variations', 'woocommerce-catalog-mode' ); ?></h2>
			<table class="woocommerce-catalog-mode-variations variations-table">
		 		<thead>
		            <tr>
		            	<?php if($this->get_option('variationsShowImage')){ ?>
		                <th><?php _e( '', 'woocommerce-catalog-mode' ); ?></th>
		                <?php } ?>

		            	<?php if($this->get_option('variationsShowSKU')){ ?>
		                <th><?php _e( 'SKU', 'woocommerce-catalog-mode' ); ?></th>
		                <?php } ?>

			            <?php if($this->get_option('variationsShowPrice')){ ?>
			            <th><?php _e('Price', 'woocommerce-catalog-mode') ?></th>
			            <?php } ?>

		                <?php if($this->get_option('variationsShowDescription')){ ?>
		                <th><?php _e('Description', 'woocommerce-catalog-mode') ?></th>
		                <?php } ?>

		                <?php if($this->get_option('variationsShowAttributes')){
		                	$variation_attributes = $product->get_variation_attributes();
		                	foreach ($variation_attributes as $key => $value) {
		                		echo '<th class="variation-attribute-head-' . $key . '">' . wc_attribute_label($key) . '</th>';
		                	}
			            } ?>
						
		            </tr>
		        </thead>
				<tbody>
		        <?php foreach ($available_variations as $variation) : ?>
		            <?php
		               	$variation_product = new WC_Product_Variation( $variation['variation_id'] );
		               	$variation_product->attributes = $variation['attributes'];
		               	$description = get_post_meta( $variation_product->get_id(), '_variation_description', TRUE);
		            ?>
		            <tr>
		            <?php
					if (isset($variation['image_src'])) :
						$image = $variation['image_src'];
					else :
						$image = 0;
					endif;

					if (!$image) $image = woocommerce_placeholder_img_src();
					?>
						<?php if($this->get_option('variationsShowImage')){ ?>
						<td class="variations-image"><?php echo '<img src="'.$image.'">' ?></td>
						<?php } ?>
		            	<?php if($this->get_option('variationsShowSKU')){ ?>
		                <td class="variations-sku"><?php echo $variation_product->get_sku(); ?></td>
		                <?php } ?>

		                <?php if($this->get_option('variationsShowPrice')){ ?>
		                <td class="variations-price"><?php echo $variation_product->get_price_html() ?></td>
		                <?php } ?>

		                <?php if($this->get_option('variationsShowDescription')){ ?>
		                <td class="variations-description"><?php echo $description; ?></td>
		            	<?php } ?>

		                <?php if($this->get_option('variationsShowAttributes')){ ?>
			           		<?php foreach ($variation_product->get_variation_attributes() as $attr_name => $attr_value) : ?>
			                <td class="variations-attributes variation-attribute-value-<?php echo $attr_name ?>">
			                <?php
			                    // Get the correct variation values
			                    if (strpos($attr_name, '_pa_')){ // variation is a pre-definted attribute
			                        $attr_name = substr($attr_name, 10);
			                        $attr = get_term_by('slug', $attr_value, $attr_name);
			                        $attr_value = $attr->name;

			                        $attr_name = wc_attribute_label($attr_name);
			                    } else {
			                        $attr = maybe_unserialize( get_post_meta( $this->product->id, '_product_attributes' ) );
			                        $attr_name = substr($attr_name, 10);
			                        $attr_name = $attr[0][$attr_name]['name'];
			                    }
			                    if(empty($attr_value)) {
			                    	echo sprintf( __('Any %s', 'woocommerce-pdf-catalog'), $attr_name);
		                    	} else {
		                    		echo $attr_value;
	                    		}
			                ?>
			                </td>
				            <?php endforeach; ?>
			             <?php } ?>
		            </tr>
		        <?php endforeach;?>
		        </tbody>
		    </table>
        <?php
	    }

		echo ' <a id="woocommerce-catalog_custom_button" target="' . $buttonTarget . '" href="' . $buttonURL . '" class="woocommerce_catalog_single_custom_button btn btn-primary button">'.$buttonText.'</a>
				  </a>';
    }  

    /**
     * Custom Free Text
     * @author Daniel Barenkamp
     * @version 1.0.0
     * @since   1.0.0
     * @link    https://www.welaunch.io
     * @return  [type]                       [description]
     */
	public function customFreePriceText($priceText) {

		$customFreePriceText = apply_filters('woocommerce_catalog_mode_custom_free_price_text', $this->get_option('customFreePriceText') );

		global $product;

		if(!$product || !is_object($product)) {
			return $priceText;
		}
	

		$price = $product->get_price();

		if($this->get_option('renamePrice') ) {
			return $this->get_option('renamePriceText');
		}

		if($price != '0.00' && $price != "") {
		    return $priceText;
		}

		if(!empty($customFreePriceText)) {
			return $customFreePriceText;
		}

		return $priceText;
	}

	public function customCartFreePriceText($price_html, $cart_item, $cart_item_key ) {

		if(!isset($cart_item['product_id']) || empty($cart_item['product_id'])) {
			return $price_html;
		}

		if(isset($cart_item['variation_id']) && !empty($cart_item['variation_id'])) {
			$product = wc_get_product($cart_item['variation_id']);	
		} else {
			$product = wc_get_product($cart_item['product_id']);	
		}
		
		if(!$product) {
			return $price_html;
		}

		$price = $product->get_price();

		if($this->get_option('renamePrice') ) {
			return $this->get_option('renamePriceText');
		}

		if($price != '0.00' && $price != "") {
		    return $priceText;
		}

		if(!empty($customFreePriceText)) {
			return $customFreePriceText;
		}

		return $price_html;
	}

	/**
	 * Return the current user role
	 * @author Daniel Barenkamp
	 * @version 1.0.0
	 * @since   1.0.0
	 * @link    https://www.welaunch.io
	 * @return  [type]                       [description]
	 */
	private function get_user_role()
	{
		global $current_user;

		$user_roles = $current_user->roles;
		$user_role = array_shift($user_roles);

		return $user_role;
	}

	public function enquiry_cart_button_text($text)
	{
		global $product;
		
		if(!$product || !is_object($product)) {
			return $text;
		}

		$product_type = $product->get_type();
		
		$btnText = $this->get_option('enquiryCartBasketBtnText');

		switch ( $product_type ) {
			case 'external':
				return $btnText;
			break;
			case 'grouped':
				return $btnText;
			break;
			case 'simple':
				return $btnText;
			break;
			case 'variable':
				if(!is_product()) {
					return $text;
				}
				return $btnText;
			break;
			default:
				return $btnText;
		}
	}

	public function remove_coupon_from_cart()
	{
		return false;
	}

	public function add_enquiry_cart_button()
	{
		$btnText = $this->get_option('enquiryCartBtnText');
    	$cart = WC()->cart->get_cart();
    	$btnExtra = '';

    	if(empty($cart)) {
    		$btnExtra = 'disabled="disabled"';
    	} else {
    		$product_data = array();
    		$currency_symbol = get_woocommerce_currency_symbol();

    		if($this->get_option('enquiryCartShowTotal')) {
    			$btnExtra = "data-total='" . strip_tags( WC()->cart->get_total() ) . "'";
    		}

    		$attributes = $this->get_option('enquiryCartShowCustomAttributes');

    		foreach ($cart as $cart_key => $cart_item) {

    			if(!empty($cart_item['data'])) {
    				$product = $cart_item['data'];

    				$variationInformation = wc_get_formatted_cart_item_data( $cart_item );
    				// $variationInformation = preg_replace('/\s+/', '', $variationInformation);
    				$variationInformation = str_replace( array('	', "\n", '</p>', ':'), array('', '', "\n", ': '), $variationInformation);
    				
    				$variationInformation = strip_tags( $variationInformation);

    				if( class_exists( 'PWC_Woo_Actions_Filters' ) ) {
    					$PWC_Woo_Config = $this->PWC_Woo_add_configs_after_cart_item_name($cart_item, $cart_key);
						if(!empty($PWC_Woo_Config)) {
							$PWC_Woo_Config = str_replace( array('	', "\n", '</p>', ':'), array('', '', "\n", ': '), $PWC_Woo_Config);
							$PWC_Woo_Config = strip_tags( html_entity_decode( $PWC_Woo_Config) );
							$variationInformation .= $PWC_Woo_Config;
						}
					}

					$variationInformation = str_replace(array("'", "’", "`", "‘"), "", $variationInformation);
					if($this->get_option('enquiryCartStripWhiteSpaces')) {
						$variationInformation = preg_replace('/\s+/', ' ',  $variationInformation);
					}

					$attrText = "";
					if(!empty($attributes)) {

						$first = true;
						foreach($attributes as $attribute) {
							$attributeValue = $product->get_attribute($attribute);
							if(empty($attributeValue)) {
								continue;
							}

							$attributeObject = wc_attribute_label('pa_' . $attribute);

							if(!$first) {
								$attrText .= ' | ';
							}
							$attrText .= $attributeObject . ': ' . $attributeValue;

							$first = false;
						}
					}

    				$product_data[] = array(
    					'name' => strip_tags( str_replace(array("'", "’", "`", "‘"), "", $product->get_name() ) ),
    					'price' => strip_tags( wc_price( $product->get_price() ) ),
    					'sku' => $product->get_sku(),
    					'quantity' => $cart_item['quantity'],
    					'variationInformation' => $variationInformation,
    					'attributes' => $attrText
    				);
    			}

    		}

    		$btnExtra .= "data-products='" . json_encode( $product_data). "'";
    	}


		?>
		<button id="enquiryCartButton" type="button" <?php echo $btnExtra ?> class="btn button btn-primary btn-lg">
			<?php echo $btnText ?>
		</button>
		<?php
	}

	public function PWC_Woo_add_configs_after_cart_item_name( $cart_item, $cart_item_key ) {
		$output = '';

		// base price
		$base_price = isset( $cart_item['pwc_base_price'] ) ? $cart_item['pwc_base_price'] : '';

		$output .= '<p class="pwc-inner pwc-child"><strong>'. esc_html__( 'Base Price', 'product-woo-configurator' ) . '</strong> <span>- (' . pwc_apply_currency_postion( $base_price )  . ')</span></p>';

		// user configuration
		$active_array = isset( $cart_item['user_config'] ) && !empty( $cart_item['user_config'] ) ? $cart_item['user_config'] : '';

		if ( $active_array && ! empty( $active_array ) ) {

			foreach ( $active_array as $key => $value ) {				
				
				$value['price'] = ( $value['price'] == '' ) ? '0' : $value['price'];

				if( isset( $value['parent'] ) && $value['parent'] ) {
					$output .= '<p class="pwc-inner pwc-child">'. sprintf( '<strong>%s</strong> - %s <span>(%s)</span>', $value['parent']['parent_name'], $value['name'], pwc_apply_currency_postion( $value['price'] ) ).'</p>';
				} else {							
					$output .= '<h4 class="pwc-title pwc-parent">'. sprintf( '%s <span>(%s)</span>', $value['name'], pwc_apply_currency_postion( $value['price'] ) ) .'</h4>';
				}				

			}

		}

		return $output;
	}

    /**
     * Category pages - go to custom URL
     * @author Daniel Barenkamp
     * @version 1.0.0
     * @since   1.0.0
     * @link    https://www.welaunch.io
     * @return  [type]                       [description]
     */
    public function add_enquiry_url_button()
    {
    	$btnText = $this->get_option('enquiryCartBtnText');
    	$buttonURL = $this->get_option('enquiryCartBtnActionURL');
    	$buttonTarget = $this->get_option('enquiryCartBtnActionURLTarget');

		echo ' <a target="' . $buttonTarget . '" href="' . $buttonURL . '" class="woocommerce-catalog-mode-cart-enquiry-button btn btn-primary button">' . $btnText . '</a>';
    }

	/**
	 * Enquiry Cart Modal
	 * @author Daniel Barenkamp
	 * @version 1.0.0
	 * @since   1.0.0
	 * @link    https://www.welaunch.io
	 * @return  [type]                       [description]
	 */
    public function enquiryCartModal()
    {
    	global $product;

		if($this->get_option('performanceOnlyWooPages') && !is_cart() ){
			return;
		}

  		$contactForm =  $this->get_option('enquiryCartContactform');
  		$modalSize = $this->get_option('enquiryCartModalSize');
  		$modalTitle = $this->get_option('enquiryCartModalTitle');
  		?>

		<div id="woocommerce-catalog-mode-enquiry-cart-popup" class="woocommerce-catalog-mode-overlay" style="display: none;"></div>
		<div id="woocommerce-catalog-mode-enquiry-cart-popup-container" class="woocommerce-catalog-mode-popup-container" style="display: none;">
			<a href="#" class="woocommerce-catalog-mode-popup-close">x</a>
			<div class="woocommerce-catalog-mode-popup">
				<h4 class="woocommerce-catalog-mode-popup-title"><?php echo $modalTitle ?></h4>
				<?php echo do_shortcode($contactForm) ?>
			</div>
		</div>		
	<?php
	}

	public function enquiryCartButton()
	{

		$this->add_enquiry_cart_button();
	}

	public function button_shortcode($atts)
	{
    	global $product, $post;

    	$oldPost = $post;
    	$oldProduct = $product;

		$args = shortcode_atts( array(
	        'type' => 'enquiryButton',
	        'product_id' => '',
	    ), $atts );

	    if(!isset($args['type']) || empty($args['type'])) {
	    	return;
	    }

	    if(isset($args['product_id']) && !empty($args['product_id'])) {

	    	$product = wc_get_product($args['product_id']);
	    	$post = get_post($args['product_id']);
	    }

		$type = $args['type'];
		// Types:
		// loopProductPageButton
		// loopCustomURLButton
		// loopEnquiryForm
		// enquiryButton
		// singleProductCustomURLButton

    	$apply = true;

    	if(!empty($post) && isset($post->ID)) {
			$excludeProductCategories = $this->get_option('excludeProductCategories');
			if(!empty($excludeProductCategories)) 
			{
				if($this->excludeProductCategories()) {
					$apply = FALSE;
				}
			}

			$excludeProducts = $this->get_option('excludeProducts');
			if(!empty($excludeProducts)) 
			{
				if($this->excludeProducts()) {
					$apply = FALSE;
				}
			}

			$includeZeroPriceProductsOnly = $this->get_option('includeZeroPriceProductsOnly');
			if(!empty($includeZeroPriceProductsOnly)) {
				if(!$this->checkZeroPriceProduct()) {
					$apply = false;
				}
			}
		}

		if(!$apply) {
	    	$product = $oldProduct;
	    	$post = $oldPost;
			return;
		}

 		ob_start();

	    $this->$type();

        $output_string = ob_get_contents();
        ob_end_clean();	 

    	$product = $oldProduct;
    	$post = $oldPost;

        return $output_string;   
	}

	public function clear_cart()
	{
	    global $woocommerce;
	    $woocommerce->cart->empty_cart();

	    return true;
	}
}