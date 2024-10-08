(function ($, window, document, undefined) {
    var pluginName = "zoomSlider",
        defaults = { src: null, src2: null, speed: 12000, initzoom: 1.2, switchSpeed: 1000, interval: 4600, autoplay: true, bullets: false, overlay: "plain" };
    function Plugin(element, options) {
        this.element = element;
        this.$el = $(element);
        this._defaults = defaults;
        this._name = pluginName;
        var elData = this.$el.data();
        var elDataObj = {};
        for (var key in elData) {
            if (elData.hasOwnProperty(key)) {
                if (key.match(/zs[A-Z]/)) {
                    var keyName = key.substr(2);
                    keyName = keyName.charAt(0).toLowerCase() + keyName.slice(1);
                    elDataObj[keyName] = elData[key];
                }
            }
        }
        this.settings = $.extend({}, defaults, elDataObj, options);
        if (this.settings.src == null || this.settings.src.length < 1) {
            console.log("ZoomSlider terminated - invalid input.");
            return;
        }
        this.init();
    }
    $.extend(Plugin.prototype, {
        init: function () {
            if ($.isArray(this.settings.src) == false) {
                this.settings.src = [this.settings.src];
            }
            if ($.isArray(this.settings.src2) == false) {
                this.settings.src2 = [this.settings.src2];
            }
            this.transEndEventNames = { WebkitTransition: "webkitTransitionEnd", MozTransition: "transitionend", OTransition: "oTransitionEnd", msTransition: "MSTransitionEnd", transition: "transitionend" };
            this.transEndEventName = this.transEndEventNames[Modernizr.prefixed("transition")];
            this.support = Modernizr.csstransitions && Modernizr.csstransforms;
            var transformPrefixed = Modernizr.prefixed("transform");
            transformPrefixed = transformPrefixed
                .replace(/([A-Z])/g, function (transformPrefixed, m1) {
                    return "-" + m1.toLowerCase();
                })
                .replace(/^ms-/, "-ms-");
            this.transitionProp = { transition: transformPrefixed + " " + this.settings.speed + "ms ease-out, opacity " + this.settings.switchSpeed + "ms" };
            this.numSlides = this.settings.src.length;
            switch (this.$el.css("position")) {
                case "relative":
                case "absolute":
                case "fixed":
                    break;
                default:
                    this.$el.css("position", "relative");
                    break;
            }
            var self = this;
            var $img = $("<img />");
            if (self.numSlides == 1) {
                self.initSingle();
            } else {
                self.initSlideshow();
            }
            $img.attr("src", this.settings.src[0]);
        },
        initSlideshow: function () {
            var self = this;
            var $slideshow = $('<div class="zs-slideshow"></div>'),
                $slidesWrap = $('<div class="zs-slides"></div>'),
                $arrowsWrap = $('<div class="zs-arrows"></div>'),
                $zslayer = $('<div class="zs-layer"></div>'),
                $bulletsWrap = $('<div class="zs-bullets"></div>');
            for (i = 0; i < this.numSlides; i++) {
                var $slide = $('<div class="zs-slide zs-slide-' + i + '"></div>');
                $slide.css({ "background-image": "url('" + this.settings.src[i] + "')" }).appendTo($slidesWrap);
                var $bullet = $('<div class="zs-bullet zs-bullet-' + i + '"></div>');
                $bullet.appendTo($bulletsWrap);
                if (i == 0) {
                    $slide.addClass("active").css("opacity", 1);
                    $bullet.addClass("active");
                    $(".zs-enabled .ltx-zs-slider-inner.ltx-zs-slide-" + i).addClass("visible");
                }
            }
            self._promoteChildren();
            $slideshow.append($zslayer);
            $slideshow.append($slidesWrap).prependTo(this.$el);
            if (this.settings.bullets == true) {
                $slideshow.append($bulletsWrap);
                $slideshow.on("click", ".zs-bullet", function (e) {
                    self.jump($(this).index());
                });
            }
            if (this.settings.arrows == true) {
                $('<div class=""><span class="ltx-arrow-right">' + this.settings.next + '</span><span class="ltx-arrow-left">' + this.settings.prev + "</span></div>").appendTo($arrowsWrap);
                this.$el.append($arrowsWrap);
                this.$el.on("click", ".ltx-arrow-left", function (e) {
                    self.prev();
                });
                this.$el.on("click", ".ltx-arrow-right", function (e) {
                    self.next();
                });
            }
            this.pos = 0;
            this.pending = null;
            this.switching = false;
            this.$slideshow = $slideshow;
            this.$slides = $slidesWrap.children(".zs-slide");
            this.$bullets = $bulletsWrap.children(".zs-bullet");
            this.$el.addClass("zs-enabled");
            var $firstBlock = $(".zs-enabled .ltx-zs-slider-inner");
            var minHeight = 0;
            $(".ltx-zs-slider-inner").each(function (i, el) {
                if ($(el).height() > minHeight) {
                    minHeight = $(el).height();
                }
            });
            if (this.support) {
                var $firstSlide = this.$slides.eq(0);
                var $initzoom = this.settings.initzoom;
                $firstSlide.css("opacity", 0).css(this.transitionProp);
                $(".ltx-zs-slider-wrapper").css("min-height", minHeight + "px");
                $(".zs-slideshow").css("min-height", minHeight + "px");
                jQuery(window).on("resize", function () {
                    $(".ltx-zs-slider-wrapper").css("min-height", minHeight + "px");
                    $(".zs-slideshow").css("min-height", minHeight + "px");
                });
                setTimeout(function () {
                    $firstSlide.css({ opacity: 1.0, transform: "scale(" + $initzoom + ", " + $initzoom + ")", "z-index": 2 });
                }, 50);
            }
            if (this.settings.autoplay == true) {
                this.play();
            }
        },
        initSingle: function () {
            var self = this;
            var $slideshow = $('<div class="zs-slideshow"></div>'),
                $slidesWrap = $('<div class="zs-slides"></div>'),
                $slide = $('<div class="zs-slide zs-slide-0"></div>');
            $slide.css({ "background-image": "url('" + this.settings.src[0] + "')" }).appendTo($slidesWrap);
            $slide.addClass("active").css("opacity", 1);
            $(".zs-enabled .ltx-zs-slider-inner.ltx-zs-slide-0").addClass("visible");
            self._promoteChildren();
            $slideshow.append($slidesWrap).prependTo(this.$el);
            this.$el.addClass("zs-enabled");
            if (this.settings.overlay == "dots") {
                this.$el.addClass("overlay-dots");
            } else if (this.settings.overlay == "plain") {
                this.$el.addClass("overlay-plain");
            }
            if (this.support) {
                $slide.css("opacity", 1).css(this.transitionProp);
                if (this.settings) {
                    setTimeout(function () {
                        $slide.css({ opacity: 1.0, transform: "scale(1)", "z-index": 2 });
                    }, 50);
                }
            }
        },
        _promoteChildren: function () {
            this.$el.children().each(function (index) {
                $this = $(this);
                if ($this.css("z-index") == "auto") {
                    $this.css("z-index", 2);
                }
                if ($this.css("position") == "static") {
                    $this.css("position", "relative");
                }
            });
        },
        jump: function (pos) {
            if (pos >= this.numSlides) {
                console.log("ZoomSlider: jump(pos) aborted. supplied index out of range.");
                return;
            }
            if (this.pos == pos) return;
            if (this.switching) {
                this.pending = pos;
                return;
            }
            var self = this;
            var $lastSlide = this.$slides.eq(this.pos);
            console.log($lastSlide);
            var $nowSlide = this.$slides.eq(pos);
            $(".zs-enabled .ltx-zoompages .current").html(pos + 1);
            $(".zs-enabled .ltx-zs-slider-inner.visible").removeClass("visible");
            $(".zs-enabled .ltx-zs-slider-inner.ltx-zs-slide-" + pos).addClass("visible");
            //--
            $(".zs-description").removeClass("active");
            $(".zs-description.zs-" + pos).addClass("active");
            //--
            if (this.support) {
                this.switching = true;
                $lastSlide.css("z-index", 1);
                $nowSlide
                    .addClass("active")
                    .css(this.transitionProp)
                    .css({ opacity: 1.0, transform: "scale(" + this.settings.initzoom + ", " + this.settings.initzoom + ")", "z-index": 2 })
                    .on(this.transEndEventName, function (e) {
                        if (e.originalEvent.propertyName == "opacity") {
                            lastSlideBg = $lastSlide.css("background-image");
                            $lastSlide.removeClass("active").removeAttr("style").css("background-image", lastSlideBg);
                            $nowSlide.off(self.transEndEventName);
                            self.switching = false;
                            if (self.pending != null) {
                                setTimeout(function () {
                                    var newPos = self.pending;
                                    self.pending = null;
                                    self.$bullets.eq(newPos).click();
                                }, 30);
                            }
                        }
                    });
            } else {
                $lastSlide.removeClass("active");
                $nowSlide.addClass("active");
            }
            this.$bullets.eq(this.pos).removeClass("active");
            this.$bullets.eq(pos).addClass("active");
            this.pos = pos;
            if (this.settings.autoplay) {
                this.play();
            }
        },
        prev: function () {
            var posPrev = this.pos - 1;
            if (posPrev < 0) posPrev = this.numSlides - 1;
            this.jump(posPrev);
        },
        next: function () {
            var posNext = this.pos + 1;
            if (posNext >= this.numSlides) posNext = 0;
            this.jump(posNext);
        },
        play: function () {
            if (this.timer != null) {
                clearInterval(this.timer);
            }
            var self = this;
            this.settings.autoplay = true;
            this.timer = setInterval(function () {
                self.next();
            }, this.settings.interval);
        },
        stop: function () {
            this.settings.autoplay = false;
            clearInterval(this.timer);
            this.timer = null;
        },
    });
    $.fn[pluginName] = function (options) {
        return this.each(function () {
            if (!$.data(this, "plugin_" + pluginName)) {
                $.data(this, "plugin_" + pluginName, new Plugin(this, options));
            }
        });
    };
    var $instances = $("[data-zs-src]");
    if ($instances.length > 0) {
        $instances.each(function (index) {
            var $this = $(this);
            $this.zoomSlider();
        });
    }
})(jQuery, window, document);
