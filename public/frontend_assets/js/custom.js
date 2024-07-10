(function (jQuery) {
	"use strict";
	jQuery(document).ready(function () {

		function activaTab(pill) {
			jQuery(pill).addClass('active show');
		}

		/*---------------------------------------------------------------------
			Sticky Header Animation & Height
		----------------------------------------------------------------------- */
		function headerHeight() {
			var height = jQuery("#main-header").height();
			jQuery('.iq-height').css('height', height + 'px');
		}
		jQuery(function () {
			var header = jQuery("#main-header"),
				yOffset = 0,
				triggerPoint = 70;

			headerHeight();
			// console.log(headerHeight);
			jQuery(window).resize(headerHeight);
			jQuery(window).on('scroll', function () {

				yOffset = jQuery(window).scrollTop();
				// console.log(yOffset);
				if (yOffset > triggerPoint) {
					header.addClass("menu-sticky animated slideInDown");
				} else {
					header.removeClass("menu-sticky animated slideInDown");
				}

			});
		});

		// Animate on Scroll
		// AOS.init();

		/*---------------------------------------------------------------------
			Back to Top
		---------------------------------------------------------------------*/
		var btn = $('#back-to-top');
		$(window).scroll(function () {
			if ($(window).scrollTop() > 50) {
				btn.addClass('show');
			} else {
				btn.removeClass('show');
			}
		});
		btn.on('click', function (e) {
			e.preventDefault();
			$('html, body').animate({ scrollTop: 0 }, '300');
		});

		/*---------------------------------------------------------------------
			Header Menu Dropdown
		---------------------------------------------------------------------*/
		jQuery('[data-toggle=more-toggle]').on('click', function () {
			jQuery(this).next().toggleClass('show');
		});

		jQuery(document).on('click', function (e) {
			let myTargetElement = e.target;
			let selector, mainElement;
			if (jQuery(myTargetElement).hasClass('search-toggle') || jQuery(myTargetElement).parent().hasClass('search-toggle') || jQuery(myTargetElement).parent().parent().hasClass('search-toggle')) {
				if (jQuery(myTargetElement).hasClass('search-toggle')) {
					selector = jQuery(myTargetElement).parent();
					mainElement = jQuery(myTargetElement);
				} else if (jQuery(myTargetElement).parent().hasClass('search-toggle')) {
					selector = jQuery(myTargetElement).parent().parent();
					mainElement = jQuery(myTargetElement).parent();
				} else if (jQuery(myTargetElement).parent().parent().hasClass('search-toggle')) {
					selector = jQuery(myTargetElement).parent().parent().parent();
					mainElement = jQuery(myTargetElement).parent().parent();
				}
				if (!mainElement.hasClass('active') && jQuery(".navbar-list li").find('.active')) {
					jQuery('.navbar-right li').removeClass('iq-show');
					jQuery('.navbar-right li .search-toggle').removeClass('active');
				}

				selector.toggleClass('iq-show');
				mainElement.toggleClass('active');

				e.preventDefault();
			} else if (jQuery(myTargetElement).is('.search-input')) { } else {
				jQuery('.navbar-right li').removeClass('iq-show');
				jQuery('.navbar-right li .search-toggle').removeClass('active');
			}
		});

		/*---------------------------------------------------------------------
			Slick Slider
		----------------------------------------------------------------------- */
		$('#home-slider').slick({
			autoplay: false,
			autoplaySpeed: 5000,
			speed: 1000,
			lazyLoad: 'progressive',
			arrows: true,
			dots: false,
			prevArrow: '<div class="slick-nav prev-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
			nextArrow: '<div class="slick-nav next-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
			responsive: [
				{
					breakpoint: 992,
					settings: {
						dots: true,
						arrows: false,
					}
				}
			]
		}).slickAnimation();
		$('.slick-nav').on('click touch', function (e) {

			e.preventDefault();

			var arrow = $(this);

			if (!arrow.hasClass('animate')) {
				arrow.addClass('animate');
				setTimeout(() => {
					arrow.removeClass('animate');
				}, 1600);
			}

		});
		
		jQuery('.client-slider').slick({
			dots: false,
			arrows: false,
			infinite: true,
			speed: 5000,
			cssEase: 'linear',
			autoplay: true,
			slidesToShow: 4,
			slidesToScroll: 1,
			buttons: false,
			pauseOnHover: false,
			pauseOnFocus: false,
			swipe: false
			// prevArrow: '<div class="slick-nav prev-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
			// nextArrow: '<div class="slick-nav next-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
			
		});
		jQuery('.strategy-slider').slick({
			dots: false,
			infinite: true,
			speed: 300,
			autoplay: false,
			slidesToShow: 1,
			slidesToScroll: 1,
			prevArrow: '<div class="slick-nav prev-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
			nextArrow: '<div class="slick-nav next-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
			
		});
		jQuery('.team-slider').slick({
			dots: false,
			infinite: true,
			speed: 300,
			autoplay: false,
			slidesToShow: 3,
			slidesToScroll: 1,
			prevArrow: '<div class="slick-nav prev-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
			nextArrow: '<div class="slick-nav next-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
			
		});


		jQuery('.slick.marquee').slick({
			speed: 5000,
			autoplay: true,
			autoplaySpeed: 0,
			// centerMode: true,
			cssEase: 'linear',
			slidesToShow: 1,
			slidesToScroll: 1,
			variableWidth: true,
			infinite: true,
			initialSlide: 1,
			arrows: false,
			buttons: false,
			pauseOnHover: false,
			pauseOnFocus: false,
			swipe: false
		  });
		/*---------------------------------------------------------------------
			Page Loader
		----------------------------------------------------------------------- */
		jQuery("#load").fadeOut();
		jQuery("#loading").delay(5000).fadeOut("slow");

		jQuery('.widget .fa.fa-angle-down, #main .fa.fa-angle-down').on('click', function () {
			jQuery(this).next('.children, .sub-menu').slideToggle();
		});

		/*---------------------------------------------------------------------
		Mobile Menu Overlay
		----------------------------------------------------------------------- */
		jQuery(document).on("click", function (event) {
			var $trigger = jQuery(".main-header .navbar");
			if ($trigger !== event.target && !$trigger.has(event.target).length) {
				jQuery(".main-header .navbar-collapse").collapse('hide');
				jQuery('body').removeClass('nav-open');
			}
		});
		jQuery('.c-toggler').on("click", function () {
			jQuery('body').addClass('nav-open');
		});

		/*---------------------------------------------------------------------
		  Equal Height of Tab Pane
		-----------------------------------------------------------------------*/
		jQuery('.trending-content').each(function () {
			var highestBox = 0;
			jQuery('.tab-pane', this).each(function () {
				if (jQuery(this).height() > highestBox) {
					highestBox = jQuery(this).height();
				}
			});
			jQuery('.tab-pane', this).height(highestBox);
		});

		/*---------------------------------------------------------------------
				Active Class for Pricing Table
			  -----------------------------------------------------------------------*/
		jQuery("#my-table tr th").on("click", function () {
			jQuery('#my-table tr th').children().removeClass('active');
			jQuery(this).children().addClass('active');
			jQuery("#my-table td").each(function () {
				if (jQuery(this).hasClass('active')) {
					jQuery(this).removeClass('active')
				}
			});
			var col = jQuery(this).index();
			jQuery("#my-table tr td:nth-child(" + parseInt(col + 1) + ")").addClass('active');
		});

		/*---------------------------------------------------------------------
			Select 2 Dropdown
		-----------------------------------------------------------------------*/
		if (jQuery('select').hasClass('season-select')) {
			jQuery('select').select2({
				theme: 'bootstrap4',
				allowClear: false,
				width: 'resolve'
			});
		}
		if (jQuery('select').hasClass('pro-dropdown')) {
			jQuery('.pro-dropdown').select2({
				theme: 'bootstrap4',
				minimumResultsForSearch: Infinity,
				width: 'resolve'
			});
			jQuery('#lang').select2({
				theme: 'bootstrap4',
				placeholder: 'Language Preference',
				allowClear: true,
				width: 'resolve'
			});
		}

		/*---------------------------------------------------------------------
			Flatpicker
		-----------------------------------------------------------------------*/
		if (jQuery('.date-input').hasClass('basicFlatpickr')) {
			jQuery('.basicFlatpickr').flatpickr();
		}
		/*---------------------------------------------------------------------
			Custom File Uploader
		-----------------------------------------------------------------------*/
		jQuery(".file-upload").on("change", function () {
			! function (e) {
				if (e.files && e.files[0]) {
					var t = new FileReader;
					t.onload = function (e) {
						jQuery(".profile-pic").attr("src", e.target.result)
					}, t.readAsDataURL(e.files[0])
				}
			}(this)
		}), jQuery(".upload-button").on("click", function () {
			jQuery(".file-upload").click();
		});

	});
	$(".dropdown-menu a").click(function(){
            $(this).parents(".dropdown").find('.btn').html($(this).text() + ' <span class="caret"></span>');
            $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
         });
})(jQuery);