(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[0],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Projects/PurchasedProjectDetails.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Projects/PurchasedProjectDetails.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vue_slick_carousel__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue-slick-carousel */ "./node_modules/vue-slick-carousel/dist/vue-slick-carousel.umd.js");
/* harmony import */ var vue_slick_carousel__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(vue_slick_carousel__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var vue_slick_carousel_dist_vue_slick_carousel_css__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vue-slick-carousel/dist/vue-slick-carousel.css */ "./node_modules/vue-slick-carousel/dist/vue-slick-carousel.css");
/* harmony import */ var vue_slick_carousel_dist_vue_slick_carousel_css__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(vue_slick_carousel_dist_vue_slick_carousel_css__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var vue_slick_carousel_dist_vue_slick_carousel_theme_css__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! vue-slick-carousel/dist/vue-slick-carousel-theme.css */ "./node_modules/vue-slick-carousel/dist/vue-slick-carousel-theme.css");
/* harmony import */ var vue_slick_carousel_dist_vue_slick_carousel_theme_css__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(vue_slick_carousel_dist_vue_slick_carousel_theme_css__WEBPACK_IMPORTED_MODULE_2__);
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



/* harmony default export */ __webpack_exports__["default"] = ({
  name: "PurchasedProjectDetails",
  props: ['project'],
  mounted: function mounted() {
    this.$nextTick(this.$forceUpdate);
  },
  components: {
    VueSlickCarousel: vue_slick_carousel__WEBPACK_IMPORTED_MODULE_0___default.a
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Projects/PurchasedProjectDetails.vue?vue&type=template&id=b96de4fc&":
/*!***********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Projects/PurchasedProjectDetails.vue?vue&type=template&id=b96de4fc& ***!
  \***********************************************************************************************************************************************************************************************************************************/
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
  return _c(
    "div",
    {
      staticClass: "modal fade detail-modal-block",
      attrs: {
        id: "project-details-" + _vm.project.id,
        tabindex: "-1",
        "aria-labelledby": "exampleModalLabel",
        "aria-hidden": "true"
      }
    },
    [
      _c("div", { staticClass: "modal-dialog" }, [
        _c("div", { staticClass: "modal-content" }, [
          _vm._m(0),
          _vm._v(" "),
          _c("div", { staticClass: "modal-body" }, [
            _c("h2", { staticClass: "project-title" }, [
              _vm._v(_vm._s(_vm.project.project.title))
            ]),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "preview" },
              [
                _c(
                  "VueSlickCarousel",
                  {
                    ref: "preview",
                    attrs: {
                      asNavFor: _vm.$refs.miniPreview,
                      focusOnSelect: true,
                      fade: true,
                      arrow: false
                    }
                  },
                  _vm._l(_vm.project.project.jsonImages, function(
                    image,
                    index
                  ) {
                    return _c(
                      "div",
                      { key: index, staticClass: "preview-slide" },
                      [
                        _c("img", {
                          attrs: { src: image, alt: _vm.project.project.title }
                        })
                      ]
                    )
                  }),
                  0
                )
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "mini-slider" },
              [
                _c(
                  "VueSlickCarousel",
                  {
                    ref: "miniPreview",
                    attrs: {
                      slidesToShow: 1,
                      variableWidth: true,
                      focusOnSelect: true,
                      arrow: true,
                      asNavFor: _vm.$refs.preview,
                      centerMode: true
                    },
                    scopedSlots: _vm._u([
                      {
                        key: "nextArrow",
                        fn: function() {
                          return [
                            _c("div", { staticClass: "btn-next" }, [
                              _c("i", { staticClass: "fas fa-chevron-right" })
                            ])
                          ]
                        },
                        proxy: true
                      },
                      {
                        key: "prevArrow",
                        fn: function() {
                          return [
                            _c("div", { staticClass: "btn-prev" }, [
                              _c("i", { staticClass: "fas fa-chevron-left" })
                            ])
                          ]
                        },
                        proxy: true
                      }
                    ])
                  },
                  _vm._l(_vm.project.project.jsonImages, function(
                    image,
                    index
                  ) {
                    return _c(
                      "div",
                      { key: index, staticClass: "mini-preview" },
                      [
                        _c("img", {
                          attrs: { src: image, alt: _vm.project.project.title }
                        })
                      ]
                    )
                  }),
                  0
                )
              ],
              1
            ),
            _vm._v(" "),
            _c("div", { staticClass: "card info-card" }, [
              _c("table", { staticClass: "table" }, [
                _c(
                  "tbody",
                  _vm._l(_vm.project.jsonValues, function(value, label, index) {
                    return _c("tr", { key: index }, [
                      _c("td", [_vm._v(_vm._s(label))]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(value))])
                    ])
                  }),
                  0
                )
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "price-block" }, [
                _c("table", { staticClass: "table" }, [
                  _c("tbody", [
                    _c("tr", [
                      _vm._m(1),
                      _vm._v(" "),
                      _c("td", [
                        _c("div", { staticClass: "price" }, [
                          _vm._v(_vm._s(_vm.project.price))
                        ])
                      ])
                    ]),
                    _vm._v(" "),
                    _c("tr", [
                      _vm._m(2),
                      _vm._v(" "),
                      _c("td", [
                        _c("div", { staticClass: "price" }, [
                          _vm._v(_vm._s(_vm.project.price))
                        ])
                      ])
                    ])
                  ])
                ])
              ])
            ])
          ])
        ])
      ])
    ]
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "modal-header" }, [
      _c("h5", { staticClass: "modal-title" }, [_vm._v("Подробный просмотр")]),
      _vm._v(" "),
      _c(
        "button",
        {
          staticClass: "close",
          attrs: {
            type: "button",
            "data-dismiss": "modal",
            "aria-label": "Close"
          }
        },
        [_c("span", { attrs: { "aria-hidden": "true" } }, [_vm._v("×")])]
      )
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("td", [_c("strong", [_vm._v("Стоимость проекта")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("td", [_c("strong", [_vm._v("Стоимость строительства")])])
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/Projects/PurchasedProjectDetails.vue":
/*!**********************************************************************!*\
  !*** ./resources/js/components/Projects/PurchasedProjectDetails.vue ***!
  \**********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _PurchasedProjectDetails_vue_vue_type_template_id_b96de4fc___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./PurchasedProjectDetails.vue?vue&type=template&id=b96de4fc& */ "./resources/js/components/Projects/PurchasedProjectDetails.vue?vue&type=template&id=b96de4fc&");
/* harmony import */ var _PurchasedProjectDetails_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./PurchasedProjectDetails.vue?vue&type=script&lang=js& */ "./resources/js/components/Projects/PurchasedProjectDetails.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _PurchasedProjectDetails_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _PurchasedProjectDetails_vue_vue_type_template_id_b96de4fc___WEBPACK_IMPORTED_MODULE_0__["render"],
  _PurchasedProjectDetails_vue_vue_type_template_id_b96de4fc___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Projects/PurchasedProjectDetails.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Projects/PurchasedProjectDetails.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************!*\
  !*** ./resources/js/components/Projects/PurchasedProjectDetails.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PurchasedProjectDetails_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./PurchasedProjectDetails.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Projects/PurchasedProjectDetails.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PurchasedProjectDetails_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Projects/PurchasedProjectDetails.vue?vue&type=template&id=b96de4fc&":
/*!*****************************************************************************************************!*\
  !*** ./resources/js/components/Projects/PurchasedProjectDetails.vue?vue&type=template&id=b96de4fc& ***!
  \*****************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PurchasedProjectDetails_vue_vue_type_template_id_b96de4fc___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./PurchasedProjectDetails.vue?vue&type=template&id=b96de4fc& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Projects/PurchasedProjectDetails.vue?vue&type=template&id=b96de4fc&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PurchasedProjectDetails_vue_vue_type_template_id_b96de4fc___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PurchasedProjectDetails_vue_vue_type_template_id_b96de4fc___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);