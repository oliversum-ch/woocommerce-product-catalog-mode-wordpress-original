# Changelog
======
1.8.11
======
- NEW:	Hook into get_price_html to remove price
- NEW:	Rank Math Schema Support
		https://imgur.com/a/gJoXptc
- FIX:	Loop enquiry button not hidden when categories were excluded

======
1.8.10
======
- FIX:	global $post was overwritten 

======
1.8.9
======
- FIX:	ADmin panel not showing

======
1.8.8
======
- NEW:	Exclusion settings now will be used also for the shortcode
- NEW:	Shortcode accepts product_id parameter

======
1.8.7
======
- NEW:	Added more classes to enquiry cart checkout remove
- FIX:	Regular / Discount price fix in enquiry cart
- FIX:	PHP 8.2 notices

======
1.8.6
======
- NEW:	Option to disable cart redirect
		https://imgur.com/a/Sxa5FSk
- NEW:	Single product name enquiry field accepts textarea
- NEW:	Remove quantity field
- FIX:	Cart price not shown when excluded
- FIX:	Removed h4 from popup title for SEO
- FIX:	Added ajax on product categories exclude (performance)
- FIX:	Extra product options text wrong
- FIX:	Removed tabindex when popup opened on flatsome
- FIX:	get_categories deprecated
- FIX:	improved woodmart support

======
1.8.5
======
- NEW:	Extra product options plugin support
		https://imgur.com/a/ZGC9SIS
- NEW:	Show custom attributes in the enquiry cart
		https://imgur.com/a/aCP96x8
- NEW:	Strip white spaces from variation data
		https://imgur.com/a/waIz99N
- NEW: 	Show current URL in form fields
		https://imgur.com/a/uzhhBUb
- FIX:	Single Enquiry button hidden on variables even tough always show was enabled
- FIX:	VariationText "null" appeared
- FIX:	Removed validate URL from fields you can use local scroll links

======
1.8.4
======
- NEW:	Show Quantity in single product enquiry form
		https://imgur.com/a/EaItVhZ
- NEW:	Added support for custom Avada / Enfold live editor
- NEW:	Added a close icon to popups
- FIX:	Simplified the settings description
- FIX:	Removed duplicate white spaces from variation information
- FIX:	Added strip tags on product name

======
1.8.3
======
- NEW:	Show cart total in enquiry cart form
		https://imgur.com/a/7tBXBms
- NEW:	Added 4 new hook options to enquiry button
- FIX:	Show enquiry only when "Out of stock" not working

======
1.8.2
======
- NEW:	Added Translation files for
		Italian, German, French, Spanish, Dutch
- NEW:	Added output buffering to button shortcode
- FIX:	Product type not available

======
1.8.1
======
- NEW:	Added support for our plugins:
		WooCommerce Variations Table https://www.welaunch.io/en/product/woocommerce-variations-table/
		WooCommerce Quick Order https://www.welaunch.io/en/product/woocommerce-quick-order/
		https://imgur.com/a/MAQmKSK
- NEW:	Porto support
- NEW:	Woodmart support
- FIX:	Error when exporting variations table PDF (2 other our plugins) with catalog mode enabled
- FIX:	Variable enquiry cart button text in loop will not change anymore (stays select options)

======
1.8.0
======
- NEW:	Performance option (enabled by default) will onyl execute JS & CSS on woo pages
		https://imgur.com/a/aOyn9oJ
- NEW:	Completely revamped the frontend JS
- NEW:	Removed Bootstrap requirement
- NEW:	Removed custom JS function
- NEW:	Moved debug section to Advanced settings
- FIX:	Popup not aligned properly
- FIX:	Currency position in cart not displayed correctly
- FIX:	Enquiry Cart form only gets executed on cart pages (performance)

======
1.7.5
======
- NEW:	Shortcodes to support custom template builder like Elementor:
		https://www.welaunch.io/en/knowledge-base/faq/shortcodes-for-woocommerce-catalog-mode-plugin/
		https://imgur.com/a/eea8puJ
- NEW:	Choose the category loop hook & priority

======
1.7.4
======
- FIX:	Moved updater into weLaunch framework

======
1.7.3
======
- NEW:	Dropped Redux Framework support and added our own framework 
		Read more here: https://www.welaunch.io/en/2021/01/switching-from-redux-to-our-own-framework
		This ensure auto updates & removes all gutenberg stuff
		You can delete Redux (if not used somewhere else) afterwards
		https://www.welaunch.io/updates/welaunch-framework.zip
		https://imgur.com/a/BIBz6kz

======
1.7.2
======
- NEW:	Added support for our variations plugin 
		https://codecanyon.net/item/woocommerce-show-variations-as-single-products/25330620
- FIX:	Updated variations dropdown functionality to latest Woo version

======
1.7.1
======
- FIX:	Removed depreacted URLs

======
1.7.0
======
- NEW:	Performance increase in admin panel through AJAX loading
		!! MAKE SURE YOU ARE ON LATEST VERSION OF REDUX FRAMEWORK !!
- NEW:	Exclusions now enabled by default all time

======
1.6.13
======
- FIX:	Added trim to selectors to remove white spaces

======
1.6.12
======
- FIX:	Modal issues with height & scrolling
- FIX:	Fade issue with some themes

======
1.6.11
======
- FIX:	Added backwards capability for old bootstrap JS
- FIX:	PHP notice on ninja wp tables pro plugin

======
1.6.10
======
- NEW:	Hard remove price Flatsome removes now cart subtotal also
- FIX:	Added support for backdrop / modal theme css
- FIX:	Remove price and apply for not logged in users removed price in the cart

======
1.6.9
======
- NEW:	Performance boost through making exlusions optional. get_posts for exlusions 
		was a performance killer. 
		Demo: https://imgur.com/a/8uswUtq

======
1.6.8
======
- NEW:	Updated bootstrap js to 4.4.0

======
1.6.7
======
- FIX:	Added more strange sign replacements

======
1.6.6
======
- FIX:	Apostroph ' signs breaking enquiry cart

======
1.6.5
======
- NEW:	Added support for WooCommerce Product Configurator Plugin in Enquiry Cart
		https://wpconfigurator.com/
- NEW:	Added transient caching for product exclusions (1 Day)

======
1.6.4
======
- FIX:	Free price text no longer working

======
1.6.3
======
- NEW:	Support for porto theme
- FIX:	CSS modal not showing

======
1.6.2
======
- NEW:	Created 3 new selector fields for the single enquiry button for better theme compatibility
		SKU Selector (.sku)
		Product Selector

======
1.6.1
======
- NEW:	Show send enquiry button ONLY when product is out of stock
		See single product pages > Only Out of Stock

======
1.6.0
======
- NEW:	Show send enquiry form button within the archive / category pages
		See Settings > Product Categories > Button Action > Enquiry Form
		It uses the single modal 
		Demo: https://welaunch.io/plugins/woocommerce-catalog-mode/demo/

======
1.5.16
======
- FIX:	Line breaks not displayed in enquiry cart form

======
1.5.15
======
- NEW:	Added support for variationInformation via wc_get_formatted_cart_item_data
		This will show variation data in the enquiry cart
- NEW:	Added an option to show / hide SKU or Quantity in Enquiry Cart
- FIX:	Increased Z-Index to 9999999

======
1.5.14
======
- NEW:	Avada "support" or added an option to specify the enquiry cart button action hook
		By default it is set to "woocommerce_cart_actions", but Avada does not have this
		so you can now choose to set it to "woocommerce_after_cart"
		See Settings > Enquiry Cart > Button Action Hook

======
1.5.13
======
- FIX:	When variations are set to talbe & single product button is set to URL
		table not displayed

======
1.5.12
======
- FIX:	Added jQuery Live support (this also fixes Ninja Forms Bug)

======
1.5.11
======
- NEW:	Added an Option to set the button priority on single product pages

======
1.5.10
======
- NEW:	Option to disable to send price to Enquiry Cart Form

======
1.5.9
======
- FIX:	Redux Framework Performance

======
1.5.8
======
- NEW:	3 Enquiry Cart options to hide / show:
		- Checkout
		- Coupon
		- Cross Sells
- FIX:	Updated WPML Keys

======
1.5.7
======
- FIX:	Added exclude product categories & product keys to WPML config

======
1.5.6
======
- NEW:	Enquiry Cart now clears the cart after successfull 
		Enquiry send (only works with CF7 currently)

======
1.5.5
======
- FIX:	Order shipping free text issue

======
1.5.4
======
- FIX:	Add to Enquiry Button was not clickable after cart update

======
1.5.3
======
- NEW:	JetPack support
- FIX:	Only first element found will be copied to form

======
1.5.2
======
- NEW:	Contact form fields now use regular expressions to find SKU & Product field by input name!

======
1.5.1
======
- NEW:	Set the Contact Form field names for SKU & Product in Plugin settings (for Gravity Forms)
		See Settings > Single Product > Contact Form Field names

======
1.5.0
======
- NEW:	Add to Enquiry Basket Functionality
		Example: https://www.welaunch.io/woocommerce-catalog-mode/product/product-with-enquiry-cart/
		Documentation: https://www.welaunch.io/woocommerce-catalog-mode/faq/enquiry-cart-basket/

======
1.4.6
======
- FIX:	Add to Enquiry in Variations Table not working when responsive enabled

======
1.4.5
======
- NEW:	Added support for our Variations Table Plugin to send enquiry
		https://codecanyon.net/item/woocommerce-variations-table/21414430

======
1.4.4
======
- FIX:	Fallback Product Name issue

======
1.4.3
======
- FIX:	If itemprop name not found our plugin takes H1 to contact form product

======
1.4.2
======
- NEW:	Variation Table attributes not display in their own columns

======
1.4.1
======
- FIX:  Product title selector for contact form JS

======
1.4.0
======
- FIX:  Exclude User Roles description

======
1.3.9
======
- NEW:  Exclude User Roles from appliance
- NEW:  Splitted section Exclusions & Limitations from General Settings tab
- FIX:  Code Documentation

======
1.3.8
======
- FIX:  ID was called indirectly

======
1.3.7
======
- NEW:  Updated Documentation
		See: https://www.welaunch.io/docs/woocommerce-catalog-mode/
- FIX: Variations Table display
- FIX: Spelling error
- FIX: Enquiry Modal Size -> Normal default value set

======
1.3.6
======
- FIX: Categories revert exclusions function
- FIX: Added some more CSS classes to remove button & quantity

=====
1.3.5
======
- NEW: 	The following filters are now available:
		woocommerce_catalog_mode_loop_button_text (Loop Button Text)
		woocommerce_catalog_mode_loop_custom_url_button_text (Loop Custom Url Button Text)
		woocommerce_catalog_mode_loop_custom_url_button_url (Loop Custom Url Button Url)
		woocommerce_catalog_mode_loop_custom_url_button_target (Loop Custom Url Button Target)
		woocommerce_catalog_mode_enquiry_button_text (Enquiry Button Text)
		woocommerce_catalog_mode_single_product_modal_contact_form (Single Product Modal Contact Form)
		woocommerce_catalog_mode_single_product_modal_title (Single Product Modal Title)
		woocommerce_catalog_mode_single_product_button_text (Single Product Button Text)
		woocommerce_catalog_mode_single_product_button_url (Single Product Button Url)
		woocommerce_catalog_mode_single_product_button_target (Single Product Button Target)
		woocommerce_catalog_mode_custom_free_price_text (Custom Free Price Text)

=====
1.3.4
======
- NEW: WPML Support (see string translations > admin_texts_woocommerce_catalog_mode_options)

=====
1.3.3
======
- FIX: "PHP Notice: id was called incorrectly"

=====
1.3.2
======
- FIX: Plugin activation check
- FIX: WooCommerce 3.0 compatibility

=====
1.3.1
======
- FIX: In the variation dropdown now also the variation price + description shows up

=====
1.3.0
======
- NEW: Variations can now be shown like you know from the regular add to cart button > see dropdown in Variations admin section
- NEW: you can now send the SKU & Product name from inside your Contact Forms -> make sure you add the following fields there:
		[text sku class:hidden]
		[text product class:hidden]

=====
1.2.2
======
- NEW: Hard remove via CSS now respects exclusions and inclusions (revert exclusions)

=====
1.2.1
======
- NEW: Better plugin activation
- FIX: Better advanced settings page (ACE Editor for CSS and JS )
- FIX array key exists

=====
1.2.0
======
- FIX: Redux Error

=====
1.1.9
======
- NEW: Removed the embedded Redux Framework for update consistency
//* PLEASE MAKE SURE YOU INSTALL THE REDUX FRAMEWORK PLUGIN *//

=====
1.1.8
======
- NEW: always show the loop button (even if the product is in the exclusion list)
- NEW: always show the single product button (even if the product is in the exclusion list)
- NEW: revert product category exclusions
- NEW: revert product category exclusions
- NEW: revert product exclusions
- NEW: revert country exclusions
- FIX: add to cart / read more on product categories now appear as they should

======
1.1.7
======
- FIX: width of variations table (colspan)

======
1.1.6
======
- FIX: free price text not shown

======
1.1.5
======
- NEW: remove the "Free"-Text if there is no price and show a custom text instead

======
1.1.4
======
- NEW: you can now specify where the modal HTML should be placed (useful to debug special mail tags from CF7)
- NEW: you can now specify where the single product button should be placed 

======
1.1.3
======
- NEW: exclude some countries and show users from this country the price / add to cart button

======
1.1.2
======
- fixed end of file error

======
1.1.1
======
- fixed PHP 5.2 errors
- removed unneeded admin JS and admin CSS

======
1.1.0
======
- moved modal HTML to the footer
- added variation display support
- added variation settings in admin panel
- fixed issue with The7 Theme
- moved to local bootstrap js

======
1.0.4
======
- moved JS to footer

======
1.0.3
======
- fixed an issue with the CSS namespace (backdrop & modal to show)
- added new settings page: debug
- added 3 new option to "debug"-settings:
--> hard remove prices
--> hard remove add to cart
--> disable the load of bootstrap.js
- added "button"-class to buttons
- removed data-options and added javascript to call the modal

======
1.0.2
======
- added namespace for public CSS 

======
1.0.1
======
- fix for category button
add_filter('woocommerce_loop_add_to_cart_link', array($this,'loopProductPageButton'),10); become
add_action('woocommerce_after_shop_loop_item', array($this,'loopProductPageButton'),10);
- added hard remove setting inside options panel (can be used for non WooCommerce standard compliant themes still showing price / add to cart button)
- tested plugin with the following themes: Storefront, Bridge, Dante, Onetake, The7, Total, Twenty Sixteen, Universal

======
1.0
======
- Inital release