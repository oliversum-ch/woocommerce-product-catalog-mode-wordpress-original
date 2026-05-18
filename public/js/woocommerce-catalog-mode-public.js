(function( $ ) {
	'use strict';

	// Create the defaults once
	var pluginName = "WooCommerceCatalogMode",
		defaults = {
			'modalHeightAuto' : '1',
		};

	// The actual plugin constructor
	function Plugin ( element, options ) {
		this.element = element;
		
		this.settings = $.extend( {}, defaults, options );
		this._defaults = defaults;
		this.trans = this.settings.trans;
		this._name = pluginName;
		this.init();
	}

	// Avoid Plugin.prototype conflicts
	$.extend( Plugin.prototype, {
		init: function() {
			this.window = $(window);
			this.documentHeight = $( document ).height();
			this.windowHeight = this.window.height();
			this.product = {};
			this.elements = {};

			this.singleProductEnquiry();
			this.loopProductEnquiry();
			this.variationsProductEnquiry();
			this.cartEnquiry();
		},
		singleProductEnquiry : function() {

			// var enquiryButton = $('#enquiryButton');
			// if(enquiryButton.length < 1) {
			// 	return;
			// }

			var that = this;
			var overlay = $('#woocommerce-catalog-mode-enquiry-popup');
			var popup = $('#woocommerce-catalog-mode-enquiry-popup-container');

			var toggler = '#enquiryButton';
			$(document).on('click', toggler, function(e) {
				e.preventDefault();

				var $this = $(this);

				// Insert SKU into form
				var sku = $(that.settings.SKUSelector).first().text().trim();
				var enquiryModalSKU = popup.find('input[name*="' + that.settings.skuField + '"]');
				
			    if(typeof sku != "undefined"){
			    	enquiryModalSKU.val(sku);
			    	enquiryModalSKU.attr('value', sku);
			    }

			    // Insert Product into form
		    	var product = $(that.settings.productSelector).first().text().trim();
				var enquiryModalProduct = popup.find('[name*="' + that.settings.productField + '"]');

				if(!product || product == ""){
					product = $(that.settings.productSelectorFallback).first().text().trim();
				}

				if(that.settings.singleProductAddQuantity == "1") {
					var quantityField = $('input[name="quantity"]');
					if(quantityField.length > 0) {
						product = $(quantityField).val() + ' x ' + product;
					}
				}

	            if(that.settings.extraProductOptionsSupport == "1") {

	            	var extraProductOptionsContainer = $('#tm-extra-product-options-fields');
	            	if(extraProductOptionsContainer.length > 0) {
	            		var extraProductOptionsFields = extraProductOptionsContainer.find('input, select :selected');
	            		if(extraProductOptionsFields.length > 0) {
	            			var extraProductOptionsString = "\r\n";
	            			
	            			$.each(extraProductOptionsFields, function(i, index) {

	            				var $this = $(this);
	            				if($this.is('option')) {
	            					var val = $this.text();
            					} else {
            						var val = $this.val();
            					}

	            				if(val && val != "") {

	            					var label = $(this).parents('.tc-row').first().find('.tm-epo-element-label').text();
	            					extraProductOptionsString += label + ': ' + val + "\r\n";
	            				}
	            			});

	            			product += extraProductOptionsString;
	            		}
	            	}
	            }

	            if(enquiryModalProduct.is('textarea')) {
	            	enquiryModalProduct.text(product);	
	            } else {
	            	enquiryModalProduct.val(product);	
	            	enquiryModalProduct.attr('value', product);
	            }

		    	if(that.settings.singleProductButtonURLFormField) {
		    		var URLFormField = $(that.settings.singleProductButtonURLFormField);
		    		if(URLFormField.length > 0) {
		    			URLFormField.val(location.protocol + '//' + location.host + location.pathname);
		    		}
		    	}

		    	if(that.settings.singleProductButtonCategoriesFormField) {
		    		var categoriesFormField = $(that.settings.singleProductButtonCategoriesFormField);
		    		if(categoriesFormField.length > 0) {

		    			categoriesFormField.val( $this.data('categories') );
		    		}
		    	}

		    	
		    	$('.mfp-wrap').removeAttr('tabindex');
				overlay.fadeIn();
				popup.fadeIn();
			});

			$('.woocommerce-catalog-mode-popup-close').on('click', function(e) {
				e.preventDefault();
				overlay.fadeOut();
				popup.fadeOut();
			});

			overlay.on('click', function(e) {
				$(this).fadeOut();
				popup.fadeOut();
			});

		},
		loopProductEnquiry : function() {

			var that = this;
			// var enquiryLoopButton = $('.enquiryLoopButton');
			// if(enquiryLoopButton.length < 1) {
			// 	return;
			// }

			var overlay = $('#woocommerce-catalog-mode-enquiry-popup');
			var popup = $('#woocommerce-catalog-mode-enquiry-popup-container');

			var toggler = '.enquiryLoopButton';
			$(document).on('click', toggler, function(e) {
				e.preventDefault();

		    	var data = $(this).data('products');

				var enquiryModalSKU = popup.find('input[name*="' + that.settings.skuField + '"]');
			    if(typeof data.sku != "undefined"){
			    	enquiryModalSKU.val(data.sku);
			    	enquiryModalSKU.attr('value', data.sku);
			    }

				var enquiryModalProduct = popup.find('input[name*="' + that.settings.productField + '"]');
				if(typeof data.name != "undefined" && data.name != ""){
			    	enquiryModalProduct.val(data.name);
			    	enquiryModalProduct.attr('value', data.name);
			    }

			    $('.mfp-wrap').removeAttr('tabindex');
				overlay.fadeIn();
				popup.fadeIn();
			});

			$('.woocommerce-catalog-mode-popup-close').on('click', function(e) {
				e.preventDefault();
				overlay.fadeOut();
				popup.fadeOut();
			});

			overlay.on('click', function(e) {
				$(this).fadeOut();
				popup.fadeOut();
			});
		},
		variationsProductEnquiry : function() {
		
			var that = this;
			var enquiryButton = $('#enquiryButton');
		    var checkVariations = $('.variations_form');
		    if(checkVariations.length < 1 || enquiryButton.length < 1) {
		    	return;
	    	} 

	    	if(that.settings.singleProductButtonAlwaysShow != "1") {
	    		enquiryButton.hide();
	    	}

	    	var availableVariations = $(checkVariations.data('product_variations'));
	    	var variationText = $('<div id="variationText"></div>');
	    	variationText.insertBefore(enquiryButton);

		    $(document).on('change', '.variations select', function(e) {
		    	var _this = $(this);
		    	var optionSelected = _this.find('option:selected');
		    	var sku = $('.sku').text();

		    	if(sku.length > 0 && sku !== "N/A") {
		    		availableVariations.each(function(i, val) {

		    			if(val.sku === sku) {
		    				var description = val.variation_description;
		    				var price = val.price_html;
		    				var newText = "";
		    				if(price && price !== "") {
		    					newText += price;
		    				}

		    				if(description && description !== "" && description != "null") {
		    					newText += description;
		    				}

		    				variationText.html(newText);

		    				variationText.fadeIn();
		    				enquiryButton.fadeIn();
		    				return false;
		    			}
		    		});
		    		
		    	} else {
		    		variationText.hide();
		    		enquiryButton.hide();
		    	}

		    })
			setTimeout( function() {
				$('.variations select').trigger('change');
			}, 150 );
		},
	    cartEnquiry : function() {


			var that = this;
			var overlay = $('#woocommerce-catalog-mode-enquiry-cart-popup');
			var popup = $('#woocommerce-catalog-mode-enquiry-cart-popup-container');

			if(popup.length < 1) {
				return;
			}

			var toggler = '#enquiryCartButton';
			$(document).on('click', toggler, function(e) {
				e.preventDefault();

		    	var products = $(this).data('products');
		    	if(products == "") {
		    		return false;
		    	}
		    	
		    	var products_txt = "";
		    	$.each(products, function(i, index) {

					if(that.settings.enquiryCartShowQuantity == 1) {
						products_txt += index.quantity + ' x ' + index.name;
					} else {
						products_txt += index.name;
					}

					if(that.settings.enquiryCartShowPrice == 1 && that.settings.enquiryCartShowSKU == 1) {
						if(index.sku !== "") {
							products_txt += ' (' + index.price + ' / ' + index.sku + ')\n';
						} else {
							products_txt += ' (' + index.price + ')\n';	
						}
						
					} else if(that.settings.enquiryCartShowPrice == 1) {
						products_txt += ' (' + index.price + ')\n';
					} else if(that.settings.enquiryCartShowSKU == 1 && index.sku !== "") {
						products_txt += ' (' + index.sku + ')\n';
		    		} else {
		    			products_txt += '\n';
		    		}
		    		
		    		if(index.attributes !== "") {
		    			products_txt += index.attributes + '\n';
		    		}

		    		if(index.variationInformation) {
		    			products_txt += index.variationInformation + '\n';
		    		}


		    	});

		    	if(that.settings.enquiryCartShowTotal == 1) {
		    		products_txt += '______________\n' + $(this).data('total');
	    		}

		    	var enquiryCartModalProducts = popup.find('[name="' + that.settings.productsField + '"]');

		    	enquiryCartModalProducts.val(products_txt);

		    	$('.mfp-wrap').removeAttr('tabindex');
				overlay.fadeIn();
				popup.fadeIn();
			});

			overlay.on('click', function(e) {
				$(this).fadeOut();
				popup.fadeOut();
			});

			$('.woocommerce-catalog-mode-popup-close').on('click', function(e) {
				e.preventDefault();
				overlay.fadeOut();
				popup.fadeOut();
			});
				
			if(that.settings.enquiryCartRedirect == "1") {
				document.addEventListener( 'wpcf7mailsent', function( event ) {
					if($('.woocommerce-cart').length > 0) {
						$.ajax({
					        url: that.settings.ajaxURL,
					        data: {
					            'action':'woocommerce_catalog_mode_clear_cart',
					        },
					        success:function(data) {
					            var delay = 1500; 
								setTimeout(function(){ location.reload(); }, delay);			            
					        },
					        error: function(errorThrown){
					            console.log(errorThrown);
					        }
					    });
					}
				    
				}, false );
			}
		},
	} );

	// Constructor wrapper
	$.fn[ pluginName ] = function( options ) {
		return this.each( function() {
			if ( !$.data( this, "plugin_" + pluginName ) ) {
				$.data( this, "plugin_" +
					pluginName, new Plugin( this, options ) );
			}
		} );
	};

	$(document).ready(function() {

		$( "body" ).WooCommerceCatalogMode( 
			woocommerce_catalog_mode_options
		);

	} );

})( jQuery );