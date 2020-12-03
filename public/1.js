(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[1],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/common/RecommendComponent.vue?vue&type=script&lang=js&":
/*!************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/common/RecommendComponent.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vue_slick_carousel_dist_vue_slick_carousel_css__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue-slick-carousel/dist/vue-slick-carousel.css */ "./node_modules/vue-slick-carousel/dist/vue-slick-carousel.css");
/* harmony import */ var vue_slick_carousel_dist_vue_slick_carousel_css__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(vue_slick_carousel_dist_vue_slick_carousel_css__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var vue_slick_carousel_dist_vue_slick_carousel_theme_css__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vue-slick-carousel/dist/vue-slick-carousel-theme.css */ "./node_modules/vue-slick-carousel/dist/vue-slick-carousel-theme.css");
/* harmony import */ var vue_slick_carousel_dist_vue_slick_carousel_theme_css__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(vue_slick_carousel_dist_vue_slick_carousel_theme_css__WEBPACK_IMPORTED_MODULE_1__);
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
  props: ['recommendations'],
  data: function data() {
    return {
      settings: {
        "infinite": true,
        "slidesToShow": 4,
        "slidesToScroll": 1,
        "responsive": [{
          "breakpoint": 1024,
          "settings": {
            "slidesToShow": 3,
            "infinite": true
          }
        }, {
          "breakpoint": 600,
          "settings": {
            "slidesToShow": 2
          }
        }, {
          "breakpoint": 480,
          "settings": {
            "slidesToShow": 1
          }
        }]
      }
    };
  },
  components: {
    'ProjectCardComponent': function ProjectCardComponent() {
      return Promise.resolve(/*! import() */).then(__webpack_require__.bind(null, /*! ../Projects/ProjectCardComponent */ "./resources/js/components/Projects/ProjectCardComponent.vue"));
    },
    'VueSlickCarousel': function VueSlickCarousel() {
      return __webpack_require__.e(/*! import() */ 0).then(__webpack_require__.t.bind(null, /*! vue-slick-carousel */ "./node_modules/vue-slick-carousel/dist/vue-slick-carousel.umd.js", 7));
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/common/RecommendComponent.vue?vue&type=template&id=70b297ac&":
/*!****************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/common/RecommendComponent.vue?vue&type=template&id=70b297ac& ***!
  \****************************************************************************************************************************************************************************************************************************/
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
    { staticClass: "recommend-block" },
    [
      _c("h3", { staticClass: "title" }, [_vm._v("Похожие проекты")]),
      _vm._v(" "),
      _c(
        "VueSlickCarousel",
        _vm._b(
          {
            ref: "recommend",
            scopedSlots: _vm._u([
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
              },
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
              }
            ])
          },
          "VueSlickCarousel",
          _vm.settings,
          false
        ),
        _vm._l(_vm.recommendations, function(project, index) {
          return _c("ProjectCardComponent", {
            key: index,
            attrs: { project: project, projectLink: "#", projectValues: [] }
          })
        }),
        1
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/common/RecommendComponent.vue":
/*!***************************************************************!*\
  !*** ./resources/js/components/common/RecommendComponent.vue ***!
  \***************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _RecommendComponent_vue_vue_type_template_id_70b297ac___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./RecommendComponent.vue?vue&type=template&id=70b297ac& */ "./resources/js/components/common/RecommendComponent.vue?vue&type=template&id=70b297ac&");
/* harmony import */ var _RecommendComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./RecommendComponent.vue?vue&type=script&lang=js& */ "./resources/js/components/common/RecommendComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _RecommendComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _RecommendComponent_vue_vue_type_template_id_70b297ac___WEBPACK_IMPORTED_MODULE_0__["render"],
  _RecommendComponent_vue_vue_type_template_id_70b297ac___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/common/RecommendComponent.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/common/RecommendComponent.vue?vue&type=script&lang=js&":
/*!****************************************************************************************!*\
  !*** ./resources/js/components/common/RecommendComponent.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_RecommendComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./RecommendComponent.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/common/RecommendComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_RecommendComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/common/RecommendComponent.vue?vue&type=template&id=70b297ac&":
/*!**********************************************************************************************!*\
  !*** ./resources/js/components/common/RecommendComponent.vue?vue&type=template&id=70b297ac& ***!
  \**********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_RecommendComponent_vue_vue_type_template_id_70b297ac___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./RecommendComponent.vue?vue&type=template&id=70b297ac& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/common/RecommendComponent.vue?vue&type=template&id=70b297ac&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_RecommendComponent_vue_vue_type_template_id_70b297ac___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_RecommendComponent_vue_vue_type_template_id_70b297ac___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);