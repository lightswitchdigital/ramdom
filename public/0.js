(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[0],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Projects/BouthProjectsComponent.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Projects/BouthProjectsComponent.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _PurchasedProjectDetails__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./PurchasedProjectDetails */ "./resources/js/components/Projects/PurchasedProjectDetails.vue");
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
  data: function data() {
    return {
      projects: [],
      isLoaded: false,
      modalProject: {},
      pageNumber: 1
    };
  },
  components: {
    ProjectCard: function ProjectCard() {
      return Promise.resolve(/*! import() */).then(__webpack_require__.bind(null, /*! ./PurchasedProjectCardComponent */ "./resources/js/components/Projects/PurchasedProjectCardComponent.vue"));
    },
    Modal: _PurchasedProjectDetails__WEBPACK_IMPORTED_MODULE_0__["default"]
  },
  created: function created() {
    this.csrfToken = document.querySelector('meta[name="csrf-token"]').content;
  },
  mounted: function mounted() {
    this.getProjects();
  },
  methods: {
    getProject: function getProject(project) {
      this.modalProject = project;
    },
    getProjects: function getProjects() {
      var _this = this;

      this.isLoaded = true;
      axios.get("projects/get-purchased-projects?batch=".concat(this.pageNumber), {
        '_token': this.csrfToken
      }).then(function (response) {
        if (response.status === 200) {
          _this.projects = response.data;
          _this.isLoaded = false;
        }
      })["catch"](function (err) {
        console.log(err);
      });
    },
    getMore: function getMore() {
      this.pageNumber += 1;
      this.getProjects();
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Projects/BouthProjectsComponent.vue?vue&type=template&id=7b338481&":
/*!**********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Projects/BouthProjectsComponent.vue?vue&type=template&id=7b338481& ***!
  \**********************************************************************************************************************************************************************************************************************************/
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
      _vm.modalProject != {}
        ? _c("Modal", { attrs: { project: _vm.modalProject.project } })
        : _vm._e(),
      _vm._v(" "),
      _vm.isLoaded
        ? _c(
            "div",
            { staticClass: "spinner-border", attrs: { role: "status" } },
            [_c("span", { staticClass: "sr-only" }, [_vm._v("Loading...")])]
          )
        : _vm._l(_vm.projects, function(project, index) {
            return _c("ProjectCard", {
              key: index,
              attrs: { project: project },
              on: { postModal: _vm.getProject }
            })
          })
    ],
    2
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/Projects/BouthProjectsComponent.vue":
/*!*********************************************************************!*\
  !*** ./resources/js/components/Projects/BouthProjectsComponent.vue ***!
  \*********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _BouthProjectsComponent_vue_vue_type_template_id_7b338481___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./BouthProjectsComponent.vue?vue&type=template&id=7b338481& */ "./resources/js/components/Projects/BouthProjectsComponent.vue?vue&type=template&id=7b338481&");
/* harmony import */ var _BouthProjectsComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./BouthProjectsComponent.vue?vue&type=script&lang=js& */ "./resources/js/components/Projects/BouthProjectsComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _BouthProjectsComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _BouthProjectsComponent_vue_vue_type_template_id_7b338481___WEBPACK_IMPORTED_MODULE_0__["render"],
  _BouthProjectsComponent_vue_vue_type_template_id_7b338481___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Projects/BouthProjectsComponent.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Projects/BouthProjectsComponent.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************!*\
  !*** ./resources/js/components/Projects/BouthProjectsComponent.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_BouthProjectsComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./BouthProjectsComponent.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Projects/BouthProjectsComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_BouthProjectsComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Projects/BouthProjectsComponent.vue?vue&type=template&id=7b338481&":
/*!****************************************************************************************************!*\
  !*** ./resources/js/components/Projects/BouthProjectsComponent.vue?vue&type=template&id=7b338481& ***!
  \****************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_BouthProjectsComponent_vue_vue_type_template_id_7b338481___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./BouthProjectsComponent.vue?vue&type=template&id=7b338481& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Projects/BouthProjectsComponent.vue?vue&type=template&id=7b338481&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_BouthProjectsComponent_vue_vue_type_template_id_7b338481___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_BouthProjectsComponent_vue_vue_type_template_id_7b338481___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);