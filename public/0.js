(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[0],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/MessagesComponent.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/MessagesComponent.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vue_scroll_loader__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue-scroll-loader */ "./node_modules/vue-scroll-loader/dist/scroll-loader.umd.min.js");
/* harmony import */ var vue_scroll_loader__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(vue_scroll_loader__WEBPACK_IMPORTED_MODULE_0__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

Vue.use(vue_scroll_loader__WEBPACK_IMPORTED_MODULE_0___default.a);
/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      messages: [],
      loadMore: false,
      batch: 0,
      pageSize: 10,
      disable: false
    };
  },
  methods: {
    getMessages: function getMessages() {
      var _this = this;

      axios.get("/notifications?batch=".concat(this.batch++)).then(function (res) {
        _this.messages.concat(res.data);

        res.data.length < _this.pageSize && (_this.loadMore = false);
        _this.disable = res.data.length < _this.pageSize;
      })["catch"](function (error) {
        console.log(error);
        _this.disable = false;
      });
    }
  },
  mounted: function mounted() {
    this.getMessages();
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/MessagesComponent.vue?vue&type=template&id=2626cdb6&":
/*!********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/MessagesComponent.vue?vue&type=template&id=2626cdb6& ***!
  \********************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c(
      "a",
      {
        staticClass: "nav-link dropdown-toggle messages-btn",
        class: { active: _vm.messages != [] },
        attrs: {
          id: "navbarDropdownMessage",
          href: "#",
          role: "button",
          "data-toggle": "dropdown",
          "aria-haspopup": "true",
          "aria-expanded": "false"
        }
      },
      [_c("i", { staticClass: "fas fa-bell" })]
    ),
    _vm._v(" "),
    _c(
      "div",
      {
        staticClass: "dropdown-menu dropdown-menu-right messages-block",
        attrs: { "aria-labelledby": "navbarDropdownMessage" }
      },
      [
        _vm._l(_vm.messages, function(message, index) {
          return _c(
            "a",
            {
              key: index,
              staticClass: "dropdown-item message-block",
              attrs: { href: "#" }
            },
            [
              _c("h5", { staticClass: "title" }, [
                _vm._v(_vm._s(message.title))
              ]),
              _vm._v(
                "\n            " + _vm._s(message.message) + "\n            "
              ),
              _c("span", { staticClass: "date text-muted" }, [
                _vm._v(_vm._s(message.date))
              ])
            ]
          )
        }),
        _vm._v(" "),
        (_vm.messages = [])
          ? _c("div", { staticClass: "dropdown-item" }, [
              _vm._v("Пока сообщений нет")
            ])
          : _vm._e(),
        _vm._v(" "),
        _c(
          "scroll-loader",
          {
            attrs: {
              "loader-method": _vm.getMessages,
              "loader-disable": _vm.disable
            }
          },
          [
            _c(
              "div",
              { staticClass: "spinner-border", attrs: { role: "status" } },
              [_c("span", { staticClass: "sr-only" }, [_vm._v("Loading...")])]
            )
          ]
        )
      ],
      2
    )
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/MessagesComponent.vue":
/*!*******************************************************!*\
  !*** ./resources/js/components/MessagesComponent.vue ***!
  \*******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _MessagesComponent_vue_vue_type_template_id_2626cdb6___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./MessagesComponent.vue?vue&type=template&id=2626cdb6& */ "./resources/js/components/MessagesComponent.vue?vue&type=template&id=2626cdb6&");
/* harmony import */ var _MessagesComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./MessagesComponent.vue?vue&type=script&lang=js& */ "./resources/js/components/MessagesComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _MessagesComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _MessagesComponent_vue_vue_type_template_id_2626cdb6___WEBPACK_IMPORTED_MODULE_0__["render"],
  _MessagesComponent_vue_vue_type_template_id_2626cdb6___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/MessagesComponent.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/MessagesComponent.vue?vue&type=script&lang=js&":
/*!********************************************************************************!*\
  !*** ./resources/js/components/MessagesComponent.vue?vue&type=script&lang=js& ***!
  \********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_MessagesComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./MessagesComponent.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/MessagesComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_MessagesComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/MessagesComponent.vue?vue&type=template&id=2626cdb6&":
/*!**************************************************************************************!*\
  !*** ./resources/js/components/MessagesComponent.vue?vue&type=template&id=2626cdb6& ***!
  \**************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_MessagesComponent_vue_vue_type_template_id_2626cdb6___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./MessagesComponent.vue?vue&type=template&id=2626cdb6& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/MessagesComponent.vue?vue&type=template&id=2626cdb6&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_MessagesComponent_vue_vue_type_template_id_2626cdb6___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_MessagesComponent_vue_vue_type_template_id_2626cdb6___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);