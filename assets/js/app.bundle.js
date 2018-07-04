webpackJsonp([0],[
/* 0 */,
/* 1 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return Helper; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_jquery__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_jquery___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_jquery__);
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }


var Helper = function () {
    function Helper() {
        _classCallCheck(this, Helper);
    }

    _createClass(Helper, null, [{
        key: 'isTouch',
        value: function isTouch() {
            // return 'ontouchstart' in window || 'DocumentTouch' in window && document instanceof DocumentTouch;
            return 'ontouchstart' in window || 'DocumentTouch' in window;
        }
    }, {
        key: 'handleCustomCSS',
        value: function handleCustomCSS($container) {
            var $elements = typeof $container !== 'undefined' ? $container.find('[data-css]') : __WEBPACK_IMPORTED_MODULE_0_jquery___default()('[data-css]');
            if ($elements.length) {
                $elements.each(function (index, obj) {
                    var $element = __WEBPACK_IMPORTED_MODULE_0_jquery___default()(obj);
                    var css = $element.data('css');
                    if (typeof css !== 'undefined') {
                        $element.replaceWith('<style type="text/css">' + css + '</style>');
                    }
                });
            }
        }
        /**
         * Search every image that is alone in a p tag and wrap it
         * in a figure element to behave like images with captions
         *
         * @param $container
         */

    }, {
        key: 'unwrapImages',
        value: function unwrapImages() {
            var $container = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : Helper.$body;

            $container.find('p > img:first-child:last-child, p > a:first-child:last-child > img').each(function (index, obj) {
                var $obj = __WEBPACK_IMPORTED_MODULE_0_jquery___default()(obj);
                var $image = $obj.closest('img');
                var className = $image.attr('class');
                var $p = $image.closest('p');
                var $figure = __WEBPACK_IMPORTED_MODULE_0_jquery___default()('<figure />').attr('class', className);
                console.log($figure, $p, __WEBPACK_IMPORTED_MODULE_0_jquery___default.a.trim($p.text()).length);
                if (__WEBPACK_IMPORTED_MODULE_0_jquery___default.a.trim($p.text()).length) {
                    return;
                }
                $figure.append($image.removeAttr('class')).insertAfter($p);
                $p.remove();
            });
        }
    }, {
        key: 'wrapEmbeds',
        value: function wrapEmbeds() {
            var $container = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : Helper.$body;

            $container.children('iframe, embed, object').wrap('<p>');
        }
        /**
         * Initialize video elements on demand from placeholders
         *
         * @param $container
         */

    }, {
        key: 'handleVideos',
        value: function handleVideos() {
            var $container = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : Helper.$body;

            $container.find('.video-placeholder').each(function (index, obj) {
                var $placeholder = __WEBPACK_IMPORTED_MODULE_0_jquery___default()(obj);
                var video = document.createElement('video');
                var $video = __WEBPACK_IMPORTED_MODULE_0_jquery___default()(video).addClass('c-hero__video');
                // play as soon as possible
                video.onloadedmetadata = function () {
                    return video.play();
                };
                video.src = $placeholder.data('src');
                video.poster = $placeholder.data('poster');
                video.muted = true;
                video.loop = true;
                $placeholder.replaceWith($video);
            });
        }
    }, {
        key: 'smoothScrollTo',
        value: function smoothScrollTo() {
            var to = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;
            var duration = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 1000;
            var easing = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 'swing';

            __WEBPACK_IMPORTED_MODULE_0_jquery___default()('html, body').stop().animate({
                scrollTop: to
            }, duration, easing);
        }
        // Returns a function, that, as long as it continues to be invoked, will not
        // be triggered. The function will be called after it stops being called for
        // N milliseconds. If `immediate` is passed, trigger the function on the
        // leading edge, instead of the trailing.

    }, {
        key: 'debounce',
        value: function debounce(func, wait, immediate) {
            var _this = this,
                _arguments = arguments;

            var timeout = void 0;
            return function () {
                var context = _this;
                var args = _arguments;
                var later = function later() {
                    timeout = null;
                    if (!immediate) {
                        func.apply(context, args);
                    }
                };
                var callNow = immediate && !timeout;
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
                if (callNow) {
                    func.apply(context, args);
                }
            };
        }
        // Returns a function, that, when invoked, will only be triggered at most once
        // during a given window of time. Normally, the throttled function will run
        // as much as it can, without ever going more than once per `wait` duration;
        // but if you'd like to disable the execution on the leading edge, pass
        // `{leading: false}`. To disable execution on the trailing edge, ditto.

    }, {
        key: 'throttle',
        value: function throttle(callback, limit) {
            var wait = false;
            return function () {
                if (!wait) {
                    callback();
                    wait = true;
                    setTimeout(function () {
                        wait = false;
                    }, limit);
                }
            };
        }
    }, {
        key: 'mq',
        value: function mq(direction, query) {
            var $temp = __WEBPACK_IMPORTED_MODULE_0_jquery___default()('<div class="u-mq-' + direction + '-' + query + '">').appendTo('body');
            var response = $temp.is(':visible');
            $temp.remove();
            return response;
        }
    }, {
        key: 'below',
        value: function below(query) {
            return Helper.mq('below', query);
        }
    }, {
        key: 'above',
        value: function above(query) {
            return Helper.mq('above', query);
        }
    }, {
        key: 'getParamFromURL',
        value: function getParamFromURL(param, url) {
            var parameters = url.split('?');
            if (typeof parameters[1] === 'undefined') {
                return parameters[1];
            }
            parameters = parameters[1].split('&');
            var _iteratorNormalCompletion = true;
            var _didIteratorError = false;
            var _iteratorError = undefined;

            try {
                for (var _iterator = Array.from(Array(parameters.length).keys())[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
                    var i = _step.value;

                    var parameter = parameters[i].split('=');
                    if (parameter[0] === param) {
                        return parameter[1];
                    }
                }
            } catch (err) {
                _didIteratorError = true;
                _iteratorError = err;
            } finally {
                try {
                    if (!_iteratorNormalCompletion && _iterator.return) {
                        _iterator.return();
                    }
                } finally {
                    if (_didIteratorError) {
                        throw _iteratorError;
                    }
                }
            }
        }
    }, {
        key: 'reloadScript',
        value: function reloadScript(filename) {
            var $old = __WEBPACK_IMPORTED_MODULE_0_jquery___default()('script[src*="' + filename + '"]');
            var $new = __WEBPACK_IMPORTED_MODULE_0_jquery___default()('<script>');
            var src = $old.attr('src');
            if (!$old.length) {
                return;
            }
            $old.replaceWith($new);
            $new.attr('src', src);
        }
        /**
         * returns version of IE or false, if browser is not Internet Explorer
         */

    }, {
        key: 'getIEversion',
        value: function getIEversion() {
            var ua = window.navigator.userAgent;
            var msie = ua.indexOf('MSIE ');
            if (msie > 0) {
                // IE 10 or older => return version number
                return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
            }
            var trident = ua.indexOf('Trident/');
            if (trident > 0) {
                // IE 11 => return version number
                var rv = ua.indexOf('rv:');
                return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
            }
            var edge = ua.indexOf('Edge/');
            if (edge > 0) {
                // Edge (IE 12+) => return version number
                return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
            }
            // other browser
            return false;
        }
    }, {
        key: 'markFirstWord',
        value: function markFirstWord($el) {
            var text = $el.text().trim().split(' ');
            var first = text.shift();
            $el.html((text.length > 0 ? '<span class="first-word">' + first + '</span> ' : first) + text.join(' '));
        }
    }, {
        key: 'fitText',
        value: function fitText($el) {
            var currentFontSize = parseFloat($el.css('fontSize'));
            var currentLineHeight = parseFloat($el.css('lineHeight'));
            var parentHeight = $el.parent().outerHeight() || 1;
            $el.css('fontSize', currentFontSize * parentHeight / currentLineHeight);
        }
    }]);

    return Helper;
}();
Helper.$body = __WEBPACK_IMPORTED_MODULE_0_jquery___default()('body');

/***/ }),
/* 2 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return WindowService; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_rx_dom__ = __webpack_require__(3);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_rx_dom___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_rx_dom__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_jquery__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_jquery___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1_jquery__);
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }



var WindowService = function () {
    function WindowService() {
        _classCallCheck(this, WindowService);
    }

    _createClass(WindowService, null, [{
        key: 'onLoad',
        value: function onLoad() {
            return __WEBPACK_IMPORTED_MODULE_0_rx_dom__["DOM"].fromEvent(this.getWindowEl(), 'load');
        }
    }, {
        key: 'onResize',
        value: function onResize() {
            return __WEBPACK_IMPORTED_MODULE_0_rx_dom__["DOM"].resize(this.getWindowEl());
        }
    }, {
        key: 'onScroll',
        value: function onScroll() {
            return __WEBPACK_IMPORTED_MODULE_0_rx_dom__["DOM"].scroll(this.getWindowEl());
        }
    }, {
        key: 'getWindow',
        value: function getWindow() {
            return WindowService.$window;
        }
    }, {
        key: 'getScrollY',
        value: function getScrollY() {
            return (window.pageYOffset || document.documentElement.scrollTop) - (document.documentElement.clientTop || 0);
        }
    }, {
        key: 'getWidth',
        value: function getWidth() {
            return WindowService.$window.width();
        }
    }, {
        key: 'getHeight',
        value: function getHeight() {
            return WindowService.$window.height();
        }
    }, {
        key: 'getWindowEl',
        value: function getWindowEl() {
            return WindowService.$window[0];
        }
    }, {
        key: 'getOrientation',
        value: function getOrientation() {
            return WindowService.getWidth() > WindowService.getHeight() ? 'landscape' : 'portrait';
        }
    }]);

    return WindowService;
}();
WindowService.$window = __WEBPACK_IMPORTED_MODULE_1_jquery___default()(window);

/***/ }),
/* 3 */,
/* 4 */,
/* 5 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return BaseComponent; });
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var BaseComponent = function BaseComponent() {
    _classCallCheck(this, BaseComponent);
};

/***/ }),
/* 6 */,
/* 7 */,
/* 8 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__Noto__ = __webpack_require__(9);

new __WEBPACK_IMPORTED_MODULE_0__Noto__["a" /* Noto */]();

/***/ }),
/* 9 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return Noto; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_jquery__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_jquery___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_jquery__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__components_base_ts_BaseTheme__ = __webpack_require__(10);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__components_base_ts_services_Helper__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__components_base_ts_components_SearchOverlay__ = __webpack_require__(14);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__components_base_ts_components_ProgressBar__ = __webpack_require__(15);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__Header__ = __webpack_require__(16);
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _get = function get(object, property, receiver) { if (object === null) object = Function.prototype; var desc = Object.getOwnPropertyDescriptor(object, property); if (desc === undefined) { var parent = Object.getPrototypeOf(object); if (parent === null) { return undefined; } else { return get(parent, property, receiver); } } else if ("value" in desc) { return desc.value; } else { var getter = desc.get; if (getter === undefined) { return undefined; } return getter.call(receiver); } };

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }







var cq = __webpack_require__(21)({});
var Noto = function (_BaseTheme) {
    _inherits(Noto, _BaseTheme);

    function Noto() {
        _classCallCheck(this, Noto);

        var _this = _possibleConstructorReturn(this, (Noto.__proto__ || Object.getPrototypeOf(Noto)).call(this));

        _this.mouseX = 0;
        _this.mouseY = 0;
        _this.handleContent();
        function loop() {
            requestAnimationFrame(loop);
        }
        requestAnimationFrame(loop);
        _this.initProgressBar();
        _this.initMobileNavigation();
        return _this;
    }

    _createClass(Noto, [{
        key: 'initMobileNavigation',
        value: function initMobileNavigation() {
            var $nav = __WEBPACK_IMPORTED_MODULE_0_jquery___default()('<div class="c-navbar__content">');
            var $shadow = __WEBPACK_IMPORTED_MODULE_0_jquery___default()('<div class="c-navbar__shadow">');
            __WEBPACK_IMPORTED_MODULE_0_jquery___default()('.c-navbar__zone--left, .c-navbar__zone--right').clone().appendTo($nav);
            $nav.appendTo('.c-noto');
            $shadow.appendTo('.c-noto');
        }
    }, {
        key: 'initProgressBar',
        value: function initProgressBar() {
            var content = __WEBPACK_IMPORTED_MODULE_0_jquery___default()('.content-area');
            if (content.length) {
                var contentAreaHeight = content.outerHeight();
                var offsetTop = content.offset().top;
                this.ProgressBar = new __WEBPACK_IMPORTED_MODULE_4__components_base_ts_components_ProgressBar__["a" /* ProgressBar */]({
                    canShow: true,
                    max: contentAreaHeight - offsetTop,
                    offset: offsetTop
                });
            }
        }
    }, {
        key: 'updateCardsPosition',
        value: function updateCardsPosition() {
            var $container = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : this.$body;

            var $noto = $container.find('.c-noto--body');
            var $posts = $noto.children('.post');
            var $widgets = $noto.children('.widget--misto');
            var step = $posts.length / $widgets.length;
            console.log($posts.length, $widgets.length);
            $widgets.each(function (i, obj) {
                var $widget = __WEBPACK_IMPORTED_MODULE_0_jquery___default()(obj);
                $widget.insertAfter($posts.eq(i * step));
            });
        }
    }, {
        key: 'bindEvents',
        value: function bindEvents() {
            _get(Noto.prototype.__proto__ || Object.getPrototypeOf(Noto.prototype), 'bindEvents', this).call(this);
            var that = this;
            __WEBPACK_IMPORTED_MODULE_0_jquery___default()('body').on('mousemove', function (e) {
                that.mouseX = e.pageX;
                that.mouseY = e.pageY;
            });
        }
    }, {
        key: 'onLoadAction',
        value: function onLoadAction() {
            _get(Noto.prototype.__proto__ || Object.getPrototypeOf(Noto.prototype), 'onLoadAction', this).call(this);
            this.SearchOverlay = new __WEBPACK_IMPORTED_MODULE_3__components_base_ts_components_SearchOverlay__["a" /* SearchOverlay */]();
            this.Header = new __WEBPACK_IMPORTED_MODULE_5__Header__["a" /* NotoHeader */]();
            this.adjustLayout();
        }
    }, {
        key: 'onResizeAction',
        value: function onResizeAction() {
            _get(Noto.prototype.__proto__ || Object.getPrototypeOf(Noto.prototype), 'onResizeAction', this).call(this);
            this.adjustLayout();
        }
    }, {
        key: 'onJetpackPostLoad',
        value: function onJetpackPostLoad() {
            var $container = __WEBPACK_IMPORTED_MODULE_0_jquery___default()('#posts-container');
            this.handleContent($container);
            this.adjustLayout();
        }
    }, {
        key: 'appendSvgToIntro',
        value: function appendSvgToIntro() {
            var $container = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : this.$body;

            var $intro = $container.find('.intro, .post-it');
            var $waveTemplate = __WEBPACK_IMPORTED_MODULE_0_jquery___default()('.js-wave-intro-template');
            $intro.each(function (i, obj) {
                var $obj = __WEBPACK_IMPORTED_MODULE_0_jquery___default()(obj);
                var $wave = $waveTemplate.clone();
                var $pattern = $wave.find('pattern');
                var patternID = $pattern.attr('id');
                $pattern.attr('id', patternID + i);
                $wave.find('rect').css('fill', 'url(#wavePattern-intro' + i + ')');
                if ($obj.is('.intro')) {
                    $wave.prependTo($obj).show();
                } else {
                    $wave.appendTo($obj).show();
                }
            });
        }
    }, {
        key: 'appendSvgToBlockquote',
        value: function appendSvgToBlockquote() {
            var $container = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : this.$body;

            var $blockquote = $container.find('.content-area blockquote');
            var $waveTemplate = __WEBPACK_IMPORTED_MODULE_0_jquery___default()('.js-wave-quote-template');
            $blockquote.each(function (i, obj) {
                var $obj = __WEBPACK_IMPORTED_MODULE_0_jquery___default()(obj);
                var $wave = $waveTemplate.clone();
                var $pattern = $wave.find('pattern');
                var patternID = $pattern.attr('id');
                $pattern.attr('id', patternID + i);
                $wave.find('rect').css('fill', 'url(#wavePattern-quote' + i + ')');
                $wave.prependTo($obj).show();
            });
        }
    }, {
        key: 'handleContent',
        value: function handleContent() {
            var $container = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : this.$body;

            __WEBPACK_IMPORTED_MODULE_2__components_base_ts_services_Helper__["a" /* Helper */].unwrapImages($container.find('.entry-content'));
            __WEBPACK_IMPORTED_MODULE_2__components_base_ts_services_Helper__["a" /* Helper */].wrapEmbeds($container.find('.entry-content'));
            __WEBPACK_IMPORTED_MODULE_2__components_base_ts_services_Helper__["a" /* Helper */].handleVideos($container);
            __WEBPACK_IMPORTED_MODULE_2__components_base_ts_services_Helper__["a" /* Helper */].handleCustomCSS($container);
            this.appendSvgToIntro($container);
            this.appendSvgToBlockquote($container);
            this.eventHandlers($container);
            this.updateCardsPosition($container);
            $container.find('.sharedaddy').each(function (i, obj) {
                var $sharedaddy = __WEBPACK_IMPORTED_MODULE_0_jquery___default()(obj);
                if ($sharedaddy.find('.sd-social-official').length) {
                    $sharedaddy.addClass('sharedaddy--official');
                }
            });
        }
    }, {
        key: 'adjustLayout',
        value: function adjustLayout() {
            cq.reevaluate(false, function () {
                // Do something after all elements were updated
            });
        }
    }]);

    return Noto;
}(__WEBPACK_IMPORTED_MODULE_1__components_base_ts_BaseTheme__["a" /* BaseTheme */]);

/***/ }),
/* 10 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return BaseTheme; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_jquery__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_jquery___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_jquery__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__services_Helper__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__services_window_service__ = __webpack_require__(2);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__services_global_service__ = __webpack_require__(13);
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }





var BaseTheme = function () {
    function BaseTheme() {
        _classCallCheck(this, BaseTheme);

        this.$body = __WEBPACK_IMPORTED_MODULE_0_jquery___default()('body');
        this.$window = __WEBPACK_IMPORTED_MODULE_0_jquery___default()(window);
        this.$html = __WEBPACK_IMPORTED_MODULE_0_jquery___default()('html');
        this.ev = __WEBPACK_IMPORTED_MODULE_0_jquery___default()({});
        this.frameRendered = false;
        this.subscriptionActive = true;
        this.$html.toggleClass('is-IE', __WEBPACK_IMPORTED_MODULE_1__services_Helper__["a" /* Helper */].getIEversion() && __WEBPACK_IMPORTED_MODULE_1__services_Helper__["a" /* Helper */].getIEversion() < 12);
        this.bindEvents();
        this.renderLoop();
    }

    _createClass(BaseTheme, [{
        key: 'bindEvents',
        value: function bindEvents() {
            __WEBPACK_IMPORTED_MODULE_3__services_global_service__["a" /* GlobalService */].onReady().take(1).subscribe(this.onReadyAction.bind(this));
            __WEBPACK_IMPORTED_MODULE_2__services_window_service__["a" /* WindowService */].onLoad().take(1).subscribe(this.onLoadAction.bind(this));
            __WEBPACK_IMPORTED_MODULE_2__services_window_service__["a" /* WindowService */].onResize().debounce(500).subscribe(this.onResizeAction.bind(this));
            __WEBPACK_IMPORTED_MODULE_2__services_window_service__["a" /* WindowService */].onScroll().subscribe(this.onScrollAction.bind(this));
            // Leave comments area visible by default and
            // show it only if the URL links to a comment
            if (window.location.href.indexOf('#comment') === -1) {
                __WEBPACK_IMPORTED_MODULE_0_jquery___default()('.trigger-comments').removeAttr('checked');
            }
            this.$window.on('beforeunload', this.fadeOut.bind(this));
            this.ev.on('render', this.update.bind(this));
        }
    }, {
        key: 'onScrollAction',
        value: function onScrollAction() {
            this.frameRendered = false;
        }
    }, {
        key: 'onReadyAction',
        value: function onReadyAction() {
            this.$html.addClass('is-ready');
        }
    }, {
        key: 'onLoadAction',
        value: function onLoadAction() {
            this.$html.addClass('is-loaded');
            this.fadeIn();
        }
    }, {
        key: 'onResizeAction',
        value: function onResizeAction() {}
    }, {
        key: 'destroy',
        value: function destroy() {
            this.subscriptionActive = false;
        }
    }, {
        key: 'renderLoop',
        value: function renderLoop() {
            var _this = this;

            if (this.frameRendered === false) {
                this.ev.trigger('render');
            }
            requestAnimationFrame(function () {
                _this.renderLoop();
                _this.frameRendered = true;
                _this.ev.trigger('afterRender');
            });
        }
    }, {
        key: 'update',
        value: function update() {
            this.backToTop();
        }
    }, {
        key: 'backToTop',
        value: function backToTop() {
            __WEBPACK_IMPORTED_MODULE_0_jquery___default()('.back-to-top').toggleClass('is-visible', __WEBPACK_IMPORTED_MODULE_2__services_window_service__["a" /* WindowService */].getScrollY() >= __WEBPACK_IMPORTED_MODULE_2__services_window_service__["a" /* WindowService */].getHeight());
        }
    }, {
        key: 'eventHandlers',
        value: function eventHandlers($container) {
            $container.find('.back-to-top').on('click', function (e) {
                e.preventDefault();
                __WEBPACK_IMPORTED_MODULE_1__services_Helper__["a" /* Helper */].smoothScrollTo(0, 1000);
            });
        }
    }, {
        key: 'fadeOut',
        value: function fadeOut() {
            this.$html.removeClass('fade-in').addClass('fade-out');
        }
    }, {
        key: 'fadeIn',
        value: function fadeIn() {
            this.$html.removeClass('fade-out no-transitions').addClass('fade-in');
        }
    }]);

    return BaseTheme;
}();

/***/ }),
/* 11 */,
/* 12 */,
/* 13 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return GlobalService; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_rx_dom__ = __webpack_require__(3);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_rx_dom___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_rx_dom__);
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }


var GlobalService = function () {
    function GlobalService() {
        _classCallCheck(this, GlobalService);
    }

    _createClass(GlobalService, null, [{
        key: 'onCustomizerRender',
        value: function onCustomizerRender() {
            var exWindow = window;
            return __WEBPACK_IMPORTED_MODULE_0_rx_dom__["Observable"].create(function (observer) {
                if (exWindow.wp && exWindow.wp.customize && exWindow.wp.customize.selectiveRefresh) {
                    exWindow.wp.customize.selectiveRefresh.bind('partial-content-rendered', function (placement) {
                        observer.onNext($(placement.container));
                    });
                }
            });
        }
    }, {
        key: 'onCustomizerChange',
        value: function onCustomizerChange() {
            var exWindow = window;
            return __WEBPACK_IMPORTED_MODULE_0_rx_dom__["Observable"].create(function (observer) {
                if (exWindow.wp && exWindow.wp.customize) {
                    exWindow.wp.customize.bind('change', function (setting) {
                        observer.onNext(setting);
                    });
                }
            });
        }
    }, {
        key: 'onReady',
        value: function onReady() {
            return __WEBPACK_IMPORTED_MODULE_0_rx_dom__["DOM"].ready();
        }
    }]);

    return GlobalService;
}();

/***/ }),
/* 14 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return SearchOverlay; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_jquery__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_jquery___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_jquery__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_rx_dom__ = __webpack_require__(3);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_rx_dom___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1_rx_dom__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__models_DefaultComponent__ = __webpack_require__(5);
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }




var activeClass = 'show-search-overlay';
var openClass = '.js-search-trigger';
var closeClass = '.js-search-close';
var escKeyCode = 27;
var SearchOverlay = function (_BaseComponent) {
    _inherits(SearchOverlay, _BaseComponent);

    function SearchOverlay() {
        _classCallCheck(this, SearchOverlay);

        var _this = _possibleConstructorReturn(this, (SearchOverlay.__proto__ || Object.getPrototypeOf(SearchOverlay)).call(this));

        _this.$body = __WEBPACK_IMPORTED_MODULE_0_jquery___default()('body');
        _this.$document = __WEBPACK_IMPORTED_MODULE_0_jquery___default()(document);
        _this.$searchField = __WEBPACK_IMPORTED_MODULE_0_jquery___default()('.c-search-overlay').find('.search-field');
        _this.subscriptionActive = true;
        _this.keyupSubscriptionActive = true;
        _this.bindEvents();
        return _this;
    }

    _createClass(SearchOverlay, [{
        key: 'destroy',
        value: function destroy() {
            this.subscriptionActive = false;
            this.keyupSubscriptionActive = false;
            this.$document.off('click.SearchOverlay');
        }
    }, {
        key: 'bindEvents',
        value: function bindEvents() {
            var _this2 = this;

            this.$document.on('click.SearchOverlay', openClass, this.open.bind(this));
            this.closeSub = __WEBPACK_IMPORTED_MODULE_1_rx_dom__["DOM"].click(document.querySelector(closeClass));
            this.keyupSub = __WEBPACK_IMPORTED_MODULE_1_rx_dom__["DOM"].keyup(document.querySelector('body'));
            this.closeSub.takeWhile(function () {
                return _this2.subscriptionActive;
            }).subscribe(this.close.bind(this));
        }
    }, {
        key: 'createKeyupSubscription',
        value: function createKeyupSubscription() {
            var _this3 = this;

            this.keyupSubscriptionActive = true;
            this.keyupSub.takeWhile(function () {
                return _this3.keyupSubscriptionActive;
            }).subscribe(this.closeOnEsc.bind(this));
        }
    }, {
        key: 'open',
        value: function open() {
            this.$searchField.focus();
            this.$body.addClass(activeClass);
            this.createKeyupSubscription();
        }
    }, {
        key: 'close',
        value: function close() {
            this.$body.removeClass(activeClass);
            this.$searchField.blur();
            this.keyupSubscriptionActive = false;
        }
    }, {
        key: 'closeOnEsc',
        value: function closeOnEsc(e) {
            if (e.keyCode === escKeyCode) {
                this.close();
            }
        }
    }]);

    return SearchOverlay;
}(__WEBPACK_IMPORTED_MODULE_2__models_DefaultComponent__["a" /* BaseComponent */]);

/***/ }),
/* 15 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ProgressBar; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_jquery__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_jquery___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_jquery__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__models_DefaultComponent__ = __webpack_require__(5);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__services_window_service__ = __webpack_require__(2);
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }




var ProgressBar = function (_BaseComponent) {
    _inherits(ProgressBar, _BaseComponent);

    function ProgressBar(options) {
        _classCallCheck(this, ProgressBar);

        var _this = _possibleConstructorReturn(this, (ProgressBar.__proto__ || Object.getPrototypeOf(ProgressBar)).call(this));

        _this.$progressBar = __WEBPACK_IMPORTED_MODULE_0_jquery___default()('.js-reading-progress');
        _this.subscriptionActive = true;
        _this.scrollPosition = 0;
        _this.max = 0;
        _this.setOptions(options);
        _this.init();
        _this.bindEvents();
        return _this;
    }

    _createClass(ProgressBar, [{
        key: 'init',
        value: function init() {
            this.max = this.options.max > __WEBPACK_IMPORTED_MODULE_2__services_window_service__["a" /* WindowService */].getHeight() ? this.options.max - __WEBPACK_IMPORTED_MODULE_2__services_window_service__["a" /* WindowService */].getHeight() : this.options.max;
            this.$progressBar.attr('max', this.max);
        }
    }, {
        key: 'destroy',
        value: function destroy() {
            this.subscriptionActive = false;
        }
    }, {
        key: 'bindEvents',
        value: function bindEvents() {
            var _this2 = this;

            __WEBPACK_IMPORTED_MODULE_2__services_window_service__["a" /* WindowService */].onScroll().takeWhile(function () {
                return _this2.subscriptionActive;
            }).subscribe(function () {
                _this2.onScroll();
            });
        }
    }, {
        key: 'change',
        value: function change(value) {
            this.$progressBar.attr('value', value);
        }
    }, {
        key: 'setOptions',
        value: function setOptions(options) {
            this.options = Object.assign({}, this.options, options);
        }
    }, {
        key: 'isCloseToEnd',
        value: function isCloseToEnd() {
            return this.max <= this.scrollPosition - this.options.offset;
        }
    }, {
        key: 'onScroll',
        value: function onScroll() {
            this.scrollPosition = __WEBPACK_IMPORTED_MODULE_2__services_window_service__["a" /* WindowService */].getScrollY();
            if (this.options.canShow && this.scrollPosition > this.options.offset) {
                this.change(this.scrollPosition - this.options.offset);
            }
        }
    }]);

    return ProgressBar;
}(__WEBPACK_IMPORTED_MODULE_1__models_DefaultComponent__["a" /* BaseComponent */]);

/***/ }),
/* 16 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return NotoHeader; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_jquery__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_jquery___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_jquery__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_imagesloaded__ = __webpack_require__(17);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_imagesloaded___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1_imagesloaded__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_jquery_hoverintent__ = __webpack_require__(19);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_jquery_hoverintent___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2_jquery_hoverintent__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__components_base_ts_models_DefaultComponent__ = __webpack_require__(5);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__components_base_ts_services_Helper__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__components_base_ts_services_window_service__ = __webpack_require__(2);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6_gsap__ = __webpack_require__(20);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6_gsap___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_6_gsap__);
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }








var NotoHeader = function (_BaseComponent) {
    _inherits(NotoHeader, _BaseComponent);

    function NotoHeader() {
        _classCallCheck(this, NotoHeader);

        var _this = _possibleConstructorReturn(this, (NotoHeader.__proto__ || Object.getPrototypeOf(NotoHeader)).call(this));

        _this.$body = __WEBPACK_IMPORTED_MODULE_0_jquery___default()('body');
        _this.$document = __WEBPACK_IMPORTED_MODULE_0_jquery___default()(document);
        // private documentHeight = $( document ).height();
        _this.windowHeight = __WEBPACK_IMPORTED_MODULE_0_jquery___default()(window).height();
        _this.adminBarHeight = __WEBPACK_IMPORTED_MODULE_0_jquery___default()('#wpadminbar').outerHeight() || 0;
        _this.$headerGrid = __WEBPACK_IMPORTED_MODULE_0_jquery___default()('.c-noto--header');
        _this.headerHeight = _this.$headerGrid.outerHeight();
        _this.$bodyGrid = __WEBPACK_IMPORTED_MODULE_0_jquery___default()('.c-noto--body');
        _this.$footer = __WEBPACK_IMPORTED_MODULE_0_jquery___default()('.site-footer');
        _this.footerOffset = _this.$footer.offset();
        _this.footerHeight = _this.$footer.outerHeight();
        _this.$mainMenu = __WEBPACK_IMPORTED_MODULE_0_jquery___default()('.menu--primary');
        _this.$mainMenuItems = _this.$mainMenu.find('li');
        _this.$menuToggle = __WEBPACK_IMPORTED_MODULE_0_jquery___default()('#menu-toggle');
        _this.isMobileHeaderInitialised = false;
        _this.isDesktopHeaderInitialised = false;
        _this.areMobileBindingsDone = false;
        _this.subscriptionActive = true;
        _this.preventOneSelector = 'a.prevent-one';
        __WEBPACK_IMPORTED_MODULE_0_jquery___default()('.c-navbar__zone').each(function (i, obj) {
            var $obj = __WEBPACK_IMPORTED_MODULE_0_jquery___default()(obj);
            if ($obj.find('.c-branding').length) {
                $obj.addClass('c-navbar__zone--branding');
            }
            if ($obj.find('.jetpack-social-navigation').length) {
                $obj.addClass('c-navbar__zone--social');
            }
        });
        __WEBPACK_IMPORTED_MODULE_1_imagesloaded__(__WEBPACK_IMPORTED_MODULE_0_jquery___default()('.c-navbar .c-logo'), function () {
            _this.bindEvents();
            _this.eventHandlers();
            _this.updateOnResize();
            _this.toggleNavStateClass();
        });
        return _this;
    }

    _createClass(NotoHeader, [{
        key: 'destroy',
        value: function destroy() {
            this.subscriptionActive = false;
        }
    }, {
        key: 'bindEvents',
        value: function bindEvents() {
            var _this2 = this;

            this.$menuToggle.on('change', this.onMenuToggleChange.bind(this));
            this.$mainMenuItems.hoverIntent({
                out: function out(e) {
                    return _this2.toggleSubMenu(e, false);
                },
                over: function over(e) {
                    return _this2.toggleSubMenu(e, true);
                },
                timeout: 300
            });
            var $accentLayer = __WEBPACK_IMPORTED_MODULE_0_jquery___default()('.c-footer-layers__accent');
            var $darkLayer = __WEBPACK_IMPORTED_MODULE_0_jquery___default()('.c-footer-layers__dark');
            var timeline = new __WEBPACK_IMPORTED_MODULE_6_gsap__["TimelineMax"]({ paused: true });
            timeline.to($accentLayer, 1, { rotation: 0, y: this.headerHeight * 0.64, x: -10 }, 0);
            timeline.to($darkLayer, 1, { rotation: 0 }, 0);
            timeline.to(__WEBPACK_IMPORTED_MODULE_0_jquery___default()('.c-navbar__zone--right'), .5, { opacity: 0 }, 0);
            timeline.to(__WEBPACK_IMPORTED_MODULE_0_jquery___default()('.c-navbar__zone--left'), 0, { opacity: 0 }, 1);
            timeline.to($darkLayer, 1, { rotation: 1 }, 1);
            timeline.to($accentLayer, 1, { rotation: 1, y: 0, x: 0 }, 1);
            var footerPinned = false;
            __WEBPACK_IMPORTED_MODULE_5__components_base_ts_services_window_service__["a" /* WindowService */].onScroll().takeWhile(function () {
                return _this2.subscriptionActive;
            }).subscribe(function () {
                var scroll = window.scrollY;
                var progressTop = scroll / (3 * _this2.headerHeight);
                var progressBottom = (scroll + _this2.windowHeight - _this2.footerOffset.top) / Math.min(_this2.footerHeight, _this2.windowHeight);
                var progress = 0.5 * Math.max(0, Math.min(1, progressTop));
                progress = progress + 0.5 * Math.max(0, Math.min(1, progressBottom));
                if (scroll >= _this2.footerOffset.top) {
                    if (!footerPinned) {
                        __WEBPACK_IMPORTED_MODULE_6_gsap__["TweenLite"].set(__WEBPACK_IMPORTED_MODULE_0_jquery___default()('.c-noto--body'), { marginBottom: 0 });
                        __WEBPACK_IMPORTED_MODULE_6_gsap__["TweenLite"].set(__WEBPACK_IMPORTED_MODULE_0_jquery___default()('.site-footer'), { position: 'static' });
                        footerPinned = true;
                    }
                } else if (footerPinned) {
                    __WEBPACK_IMPORTED_MODULE_6_gsap__["TweenLite"].set(__WEBPACK_IMPORTED_MODULE_0_jquery___default()('.c-noto--body'), { marginBottom: _this2.footerHeight });
                    __WEBPACK_IMPORTED_MODULE_6_gsap__["TweenLite"].set(__WEBPACK_IMPORTED_MODULE_0_jquery___default()('.site-footer'), { position: 'fixed' });
                    footerPinned = false;
                }
                timeline.progress(progress);
            });
            __WEBPACK_IMPORTED_MODULE_5__components_base_ts_services_window_service__["a" /* WindowService */].onResize().takeWhile(function () {
                return _this2.subscriptionActive;
            }).subscribe(function () {
                _this2.windowHeight = __WEBPACK_IMPORTED_MODULE_0_jquery___default()(window).height();
                _this2.adminBarHeight = __WEBPACK_IMPORTED_MODULE_0_jquery___default()('#wpadminbar').outerHeight() || 0;
                _this2.updateOnResize();
            });
        }
    }, {
        key: 'eventHandlers',
        value: function eventHandlers() {
            if (__WEBPACK_IMPORTED_MODULE_4__components_base_ts_services_Helper__["a" /* Helper */].below('lap') && !this.areMobileBindingsDone) {
                this.$document.on('click', this.preventOneSelector, this.onMobileMenuExpand.bind(this));
                this.areMobileBindingsDone = true;
            }
            if (__WEBPACK_IMPORTED_MODULE_4__components_base_ts_services_Helper__["a" /* Helper */].above('lap') && this.areMobileBindingsDone) {
                this.$document.off('click', this.preventOneSelector, this.onMobileMenuExpand.bind(this));
                this.areMobileBindingsDone = false;
            }
        }
    }, {
        key: 'updateOnResize',
        value: function updateOnResize() {
            this.eventHandlers();
            this.$headerGrid.css({
                height: '',
                left: '',
                position: '',
                top: '',
                width: ''
            });
            this.$footer.css({
                bottom: '',
                height: '',
                left: '',
                position: '',
                width: ''
            });
            if (__WEBPACK_IMPORTED_MODULE_4__components_base_ts_services_Helper__["a" /* Helper */].below('lap')) {
                this.prepareMobileMenuMarkup();
            } else {
                this.prepareDesktopMenuMarkup();
            }
        }
    }, {
        key: 'prepareDesktopMenuMarkup',
        value: function prepareDesktopMenuMarkup() {
            var headerWidth = this.$headerGrid.outerWidth();
            var headerHeight = this.$headerGrid.outerHeight();
            var footerWidth = this.$footer.outerWidth();
            var footerHeight = this.$footer.outerHeight();
            this.$headerGrid.css({
                height: headerHeight,
                left: this.$headerGrid.offset().left,
                position: 'fixed',
                top: this.adminBarHeight,
                width: headerWidth
            });
            this.$footer.css({
                bottom: this.windowHeight - footerHeight,
                height: footerHeight,
                left: this.footerOffset.left,
                position: 'fixed',
                width: footerWidth
            });
            this.$bodyGrid.css({
                marginBottom: footerHeight,
                marginTop: headerHeight
            });
            if (this.isDesktopHeaderInitialised) {
                return;
            }
            this.isDesktopHeaderInitialised = true;
        }
    }, {
        key: 'prepareMobileMenuMarkup',
        value: function prepareMobileMenuMarkup() {
            // If if has not been done yet, prepare the mark-up for the mobile navigation
            if (this.isMobileHeaderInitialised) {
                return;
            }
            // Append the branding
            var $branding = __WEBPACK_IMPORTED_MODULE_0_jquery___default()('.c-branding');
            $branding.clone().addClass('c-branding--mobile');
            $branding.find('img').removeClass('is--loading');
            // Create the mobile site header
            var $siteHeaderMobile = __WEBPACK_IMPORTED_MODULE_0_jquery___default()('<div class="site-header-mobile  u-header-sides-spacing"></div>');
            // Append the social menu
            var $searchTrigger = __WEBPACK_IMPORTED_MODULE_0_jquery___default()('.js-mobile-search-trigger');
            $siteHeaderMobile.append($branding.clone());
            $siteHeaderMobile.append($searchTrigger.clone().show());
            $siteHeaderMobile.appendTo('.c-navbar');
            // Handle sub menus:
            // Make sure there are no open menu items
            __WEBPACK_IMPORTED_MODULE_0_jquery___default()('.menu-item-has-children').removeClass('hover');
            // Add a class so we know the items to handle
            __WEBPACK_IMPORTED_MODULE_0_jquery___default()('.menu-item-has-children > a').each(function (index, element) {
                __WEBPACK_IMPORTED_MODULE_0_jquery___default()(element).addClass('prevent-one');
            });
            this.isMobileHeaderInitialised = true;
        }
    }, {
        key: 'toggleSubMenu',
        value: function toggleSubMenu(e, toggle) {
            __WEBPACK_IMPORTED_MODULE_0_jquery___default()(e.currentTarget).toggleClass('hover', toggle);
        }
    }, {
        key: 'onMobileMenuExpand',
        value: function onMobileMenuExpand(e) {
            e.preventDefault();
            e.stopPropagation();
            var $button = __WEBPACK_IMPORTED_MODULE_0_jquery___default()(e.currentTarget);
            var activeClass = 'active';
            var hoverClass = 'hover';
            if ($button.hasClass(activeClass)) {
                window.location.href = $button.attr('href');
                return;
            }
            __WEBPACK_IMPORTED_MODULE_0_jquery___default()(this.preventOneSelector).removeClass(activeClass);
            $button.addClass(activeClass);
            // When a parent menu item is activated,
            // close other menu items on the same level
            $button.parent().siblings().removeClass(hoverClass);
            // Open the sub menu of this parent item
            $button.parent().addClass(hoverClass);
        }
    }, {
        key: 'toggleNavStateClass',
        value: function toggleNavStateClass() {
            var isMenuOpen = this.$menuToggle.prop('checked');
            this.$body.toggleClass('nav--is-open', isMenuOpen);
            return isMenuOpen;
        }
    }, {
        key: 'onMenuToggleChange',
        value: function onMenuToggleChange(e) {
            var _this3 = this;

            if (!this.toggleNavStateClass()) {
                setTimeout(function () {
                    // Close the open submenus in the mobile menu overlay
                    _this3.$mainMenuItems.removeClass('hover');
                    _this3.$mainMenuItems.find('a').removeClass('active');
                }, 300);
            }
        }
    }]);

    return NotoHeader;
}(__WEBPACK_IMPORTED_MODULE_3__components_base_ts_models_DefaultComponent__["a" /* BaseComponent */]);

/***/ })
],[8]);
//# sourceMappingURL=app.bundle.js.map