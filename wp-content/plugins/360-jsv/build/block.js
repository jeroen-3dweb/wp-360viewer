/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/ShortCode.js":
/*!**************************!*\
  !*** ./src/ShortCode.js ***!
  \**************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ ShortCode)
/* harmony export */ });
/* harmony import */ var _wordpress_shortcode__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/shortcode */ "@wordpress/shortcode");
/* harmony import */ var _wordpress_shortcode__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_shortcode__WEBPACK_IMPORTED_MODULE_0__);

class ShortCode {
  constructor(content) {
    this.content = content;
    this.dirty = false;
    let code = content;
    code = code.replace('[360-jsv', '');
    code = code.replace(']', '');
    this.sc = new (_wordpress_shortcode__WEBPACK_IMPORTED_MODULE_0___default())({
      attrs: code,
      tag: '360-jsv',
      content: '',
      type: 'single'
    });
  }
  getShortCodeText() {
    return this.sc.string().replace(/"|'/g, '');
  }
  setValue(key, value, defaults) {
    console.log('setValue', key, value, defaults);
    const oldValue = this.sc.get(key);
    if (typeof oldValue === 'undefined' && value === defaults) {
      return false;
    }
    this.dirty = true;
    this.sc.set(key, value);
    return true;
  }
  isDirty() {
    return this.dirty;
  }
}

/***/ }),

/***/ "@wordpress/block-editor":
/*!*************************************!*\
  !*** external ["wp","blockEditor"] ***!
  \*************************************/
/***/ ((module) => {

module.exports = window["wp"]["blockEditor"];

/***/ }),

/***/ "@wordpress/blocks":
/*!********************************!*\
  !*** external ["wp","blocks"] ***!
  \********************************/
/***/ ((module) => {

module.exports = window["wp"]["blocks"];

/***/ }),

/***/ "@wordpress/components":
/*!************************************!*\
  !*** external ["wp","components"] ***!
  \************************************/
/***/ ((module) => {

module.exports = window["wp"]["components"];

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/***/ ((module) => {

module.exports = window["wp"]["element"];

/***/ }),

/***/ "@wordpress/shortcode":
/*!***********************************!*\
  !*** external ["wp","shortcode"] ***!
  \***********************************/
/***/ ((module) => {

module.exports = window["wp"]["shortcode"];

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!**********************!*\
  !*** ./src/block.js ***!
  \**********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/blocks */ "@wordpress/blocks");
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _ShortCode__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./ShortCode */ "./src/ShortCode.js");





(0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__.registerBlockType)('jsviewer/default-viewer', {
  icon: {
    src: (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("svg", {
      version: "1.1",
      xmlns: "http://www.w3.org/2000/svg",
      viewBox: "0 0 250 250",
      enableBackground: "new 0 0 512 512"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("g", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("g", {
      fill: "#a0a5aa"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
      d: "m105.46 1.5998c28.676 0 54.644 11.628 73.434 30.418 18.794 18.794 30.422 44.758 30.422 73.434 0 28.68-11.628 54.644-30.422 73.438-18.794 18.794-44.758 30.422-73.434 30.422-28.68 0-54.644-11.628-73.438-30.422-18.79-18.79-30.418-44.758-30.418-73.438 0-28.676 11.624-54.64 30.418-73.434 18.794-18.794 44.758-30.418 73.438-30.418zm66.873 36.982c-17.112-17.116-40.759-27.698-66.873-27.698-26.118 0-49.761 10.582-66.873 27.698-17.112 17.112-27.698 40.755-27.698 66.87 0 26.118 10.586 49.761 27.698 66.877 17.112 17.112 40.755 27.698 66.873 27.698 26.114 0 49.761-10.586 66.873-27.698 17.112-17.116 27.698-40.759 27.698-66.877 0-26.114-10.586-49.757-27.698-66.87"
    }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
      d: "m179.1 153.95c-2.2571 6.2408-12.064 15.894-18.339 20.822-38.254 30.045-90.569 25.05-122.36-11.515-11.244-12.933-21.758-36.723-20.551-54.049 8.37 8.9831 28.187 15.709 40.116 19.189 39.066 11.394 99.458 11.921 135.27-19.174 0.13542 4.202-3.9048 11.684-7.0834 16.059-20.156 27.739-56.848 35.15-88.383 33.081-19.49-1.2791-28.055-5.4697-33.766-6.2672 7.7079 6.4101 24.312 9.8596 33.551 11.406l21.077 1.7718c42.305-0.43294 50.506-8.0691 60.467-11.323",
      fillRule: "evenodd"
    }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
      d: "m32.371 88.572c25.731 11.345 40.729 14.487 69.71 12.621 17.47-1.1248 38.013-6.2295 55.55-16.157 22.804-14.475 18.147-25.7 19.456-31.339 21.559 41.071-44.506 71.053-77.008 70.575-33.668 0.67285-52.15-4.4879-82.297-16.059-0.79762-11.692 2.7686-30.045 8.0804-41.007 22.247-45.932 78.117-62.517 118.93-41.974 7.106 3.5776 19.377 10.492 22.469 20.953 8.6371 29.195-48.813 45.089-67.934 47.538-27.028 3.4646-41.432 0.12049-66.952-5.1499",
      fillOpacity: ".48",
      fillRule: "evenodd"
    }))))
  },
  attributes: {
    code: {
      type: 'string',
      default: '[360-jsv total-frames=72 main-image-url=https://cdn1.360-javascriptviewer.com/images/blue-shoe-small/20180906-001-blauw.jpg image-url-format=20180906-0xx-blauw.jpg speed=90 inertia=12 zoom=true reverse=true auto-rotate=1 notification-config_drag-to-rotate_show-start-to-rotate-default-notification=true ]',
      source: 'text'
    },
    useWooCommerceProduct: {
      type: 'boolean',
      default: false
    },
    useACFProduct: {
      type: 'boolean',
      default: false
    },
    reference: {
      type: 'string',
      default: ''
    }
  },
  edit: props => {
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__.useBlockProps)(), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.Card, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.CardHeader, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.Flex, {
      align: true
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.FlexItem, {
      height: "50px"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("svg", {
      height: "50px",
      version: "1.1",
      xmlns: "http://www.w3.org/2000/svg",
      viewBox: "0 0 250 250",
      enableBackground: "new 0 0 512 512"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("g", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("g", {
      fill: "#a0a5aa"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
      d: "m105.46 1.5998c28.676 0 54.644 11.628 73.434 30.418 18.794 18.794 30.422 44.758 30.422 73.434 0 28.68-11.628 54.644-30.422 73.438-18.794 18.794-44.758 30.422-73.434 30.422-28.68 0-54.644-11.628-73.438-30.422-18.79-18.79-30.418-44.758-30.418-73.438 0-28.676 11.624-54.64 30.418-73.434 18.794-18.794 44.758-30.418 73.438-30.418zm66.873 36.982c-17.112-17.116-40.759-27.698-66.873-27.698-26.118 0-49.761 10.582-66.873 27.698-17.112 17.112-27.698 40.755-27.698 66.87 0 26.118 10.586 49.761 27.698 66.877 17.112 17.112 40.755 27.698 66.873 27.698 26.114 0 49.761-10.586 66.873-27.698 17.112-17.116 27.698-40.759 27.698-66.877 0-26.114-10.586-49.757-27.698-66.87"
    }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
      d: "m179.1 153.95c-2.2571 6.2408-12.064 15.894-18.339 20.822-38.254 30.045-90.569 25.05-122.36-11.515-11.244-12.933-21.758-36.723-20.551-54.049 8.37 8.9831 28.187 15.709 40.116 19.189 39.066 11.394 99.458 11.921 135.27-19.174 0.13542 4.202-3.9048 11.684-7.0834 16.059-20.156 27.739-56.848 35.15-88.383 33.081-19.49-1.2791-28.055-5.4697-33.766-6.2672 7.7079 6.4101 24.312 9.8596 33.551 11.406l21.077 1.7718c42.305-0.43294 50.506-8.0691 60.467-11.323",
      fillRule: "evenodd"
    }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
      d: "m32.371 88.572c25.731 11.345 40.729 14.487 69.71 12.621 17.47-1.1248 38.013-6.2295 55.55-16.157 22.804-14.475 18.147-25.7 19.456-31.339 21.559 41.071-44.506 71.053-77.008 70.575-33.668 0.67285-52.15-4.4879-82.297-16.059-0.79762-11.692 2.7686-30.045 8.0804-41.007 22.247-45.932 78.117-62.517 118.93-41.974 7.106 3.5776 19.377 10.492 22.469 20.953 8.6371 29.195-48.813 45.089-67.934 47.538-27.028 3.4646-41.432 0.12049-66.952-5.1499",
      fillOpacity: ".48",
      fillRule: "evenodd"
    }))))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.FlexItem, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h5", null, "360 Javascript Viewer")))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.CardBody, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextareaControl, {
      label: 'Enter shortcode',
      onChange: value => props.setAttributes({
        code: value
      }),
      value: props.attributes.code
    }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
      label: 'Enter reference',
      help: 'It can be useful if you need to acces the viewer from your website.',
      onChange: value => props.setAttributes({
        reference: value
      }),
      value: props.attributes.reference
    }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.CheckboxControl, {
      label: "Use WooCommerce Product if there is one",
      help: "It will override the default code.",
      checked: props.attributes.useWooCommerceProduct,
      onChange: value => props.setAttributes({
        useWooCommerceProduct: value
      })
    }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.CheckboxControl, {
      label: "Use ACF Field if there is one",
      help: "It will override the default code.",
      checked: props.attributes.useACFProduct,
      onChange: value => props.setAttributes({
        useACFProduct: value
      })
    }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, "You can find the shortcode on ", (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
      className: "is_link",
      target: "_blank",
      href: "https://www.360-javascriptviewer.com/wordpress?utm_source=wordpress&utm_medium=gutenberg&utm_campaign=plugin"
    }, "360-javascriptviewer.com "), "or on ", (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
      target: "_blank",
      href: "https://3dweb.io/?utm_source=wordpress&utm_medium=gutenberg&utm_campaign=plugin"
    }, "3DWeb.io"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("br", null), "Check for more examples on ", (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
      target: "_blank",
      href: "https://wordpress.360-javascriptviewer.com?utm_source=wordpress&utm_medium=gutenberg&utm_campaign=plugin"
    }, "wordpress.360-javascriptviewer.com"))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.CardFooter, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.__experimentalText, null, "The shortcode is placed into the source. Then it will be converted to a 360 presentation."))));
  },
  save: props => {
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, props.attributes.code);
  }
});
})();

/******/ })()
;
//# sourceMappingURL=block.js.map