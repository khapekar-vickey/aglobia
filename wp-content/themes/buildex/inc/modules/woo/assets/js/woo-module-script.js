;var Buildex_Woo_Module;


(function ($) {
	"use strict";


	Buildex_Woo_Module = {

		init: function () {
			this.wooHeaderCart();
		},

		wooHeaderCart: function () {
			var headerCartButton = $('.header-cart__link-wrap'),

			toggleButton = function (e){
				e.preventDefault();
				$('.header-cart__content').toggleClass('show');
			};

			headerCartButton.on('click', toggleButton );

		}

	};

	Buildex_Woo_Module.init();

	$("div[id='tab-description']:not(:has(.elementor))") .addClass('container');

}(jQuery));