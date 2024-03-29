(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[1],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Projects/SaveProjectsComponent.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Projects/SavedProjectsComponent.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
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
  data: function data() {
    return {
      projects: [],
      isLoaded: false
    };
  },
  components: {
    ProjectCard: function ProjectCard() {
      return Promise.resolve(/*! import() */).then(__webpack_require__.bind(null, /*! ./ProjectCardComponent */ "./resources/js/components/Projects/ProjectCardComponent.vue"));
    }
  },
  created: function created() {
    this.csrfToken = document.querySelector('meta[name="csrf-token"]').content;
  },
  mounted: function mounted() {
    var _this = this;

    this.isLoaded = true;
    axios.get("projects/get-saved-projects", {
      '_token': this.csrfToken
    }).then(function (response) {
      if (response.status === 200) {
        _this.projects = response.data;
        _this.isLoaded = false;
      }
    })["catch"](function (err) {
      console.log(err);
    });
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Projects/SaveProjectsComponent.vue?vue&type=template&id=14e46e5c&":
/*!*********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Projects/SavedProjectsComponent.vue?vue&type=template&id=14e46e5c& ***!
  \*********************************************************************************************************************************************************************************************************************************/
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
    { staticClass: "projects-wrapper d-flex" },
    [
      _vm.isLoaded
        ? _c(
            "div",
            { staticClass: "spinner-border", attrs: { role: "status" } },
            [_c("span", { staticClass: "sr-only" }, [_vm._v("Loading...")])]
          )
        : _vm._l(_vm.projects, function(project, index) {
            return _c("ProjectCard", {
              key: index,
              attrs: { project: project.project }
            })
          })
    ],
    2
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/Projects/SaveProjectsComponent.vue":
/*!********************************************************************!*\
  !*** ./resources/js/components/Projects/SavedProjectsComponent.vue ***!
  \********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _SaveProjectsComponent_vue_vue_type_template_id_14e46e5c___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./SavedProjectsComponent.vue?vue&type=template&id=14e46e5c& */ "./resources/js/components/Projects/SaveProjectsComponent.vue?vue&type=template&id=14e46e5c&");
/* harmony import */ var _SaveProjectsComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./SavedProjectsComponent.vue?vue&type=script&lang=js& */ "./resources/js/components/Projects/SaveProjectsComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _SaveProjectsComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _SaveProjectsComponent_vue_vue_type_template_id_14e46e5c___WEBPACK_IMPORTED_MODULE_0__["render"],
  _SaveProjectsComponent_vue_vue_type_template_id_14e46e5c___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null

)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Projects/SavedProjectsComponent.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Projects/SaveProjectsComponent.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************!*\
  !*** ./resources/js/components/Projects/SavedProjectsComponent.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SaveProjectsComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./SavedProjectsComponent.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Projects/SaveProjectsComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SaveProjectsComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]);

/***/ }),

/***/ "./resources/js/components/Projects/SaveProjectsComponent.vue?vue&type=template&id=14e46e5c&":
/*!***************************************************************************************************!*\
  !*** ./resources/js/components/Projects/SavedProjectsComponent.vue?vue&type=template&id=14e46e5c& ***!
  \***************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SaveProjectsComponent_vue_vue_type_template_id_14e46e5c___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./SavedProjectsComponent.vue?vue&type=template&id=14e46e5c& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Projects/SaveProjectsComponent.vue?vue&type=template&id=14e46e5c&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SaveProjectsComponent_vue_vue_type_template_id_14e46e5c___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SaveProjectsComponent_vue_vue_type_template_id_14e46e5c___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);
