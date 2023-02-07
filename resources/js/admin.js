import PricelistComponent from "./components/PricelistComponent";

require('./bootstrap')

Vue.component('pricelist', PricelistComponent);

const app = new Vue({
    el: '#app',
});
