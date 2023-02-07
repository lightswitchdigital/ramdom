import SequentialEntrance from 'vue-sequential-entrance'
import 'vue-sequential-entrance/vue-sequential-entrance.css'
// import VueCookies from 'vue-cookies'

require('./bootstrap');

import VueRouter from 'vue-router'
import Vuelidate from 'vuelidate'
import VueTheMask from 'vue-the-mask'
import ProjectCardComponent from "./components/Projects/ProjectCardComponent";
import ProjectComponent from "./components/Projects/ProjectComponent";
import AdviceComponent from "./components/AdviceComponent"
import Recommend from './components/Projects/RecommendationsComponent'
import PurchasedProjectCardComponent from "./components/Projects/PurchasedProjectCardComponent";
import MyProjectsComponent from "./components/Projects/MyProjectsComponent";
import AddBalanceComponent from "./components/AddBalanceComponent";
import NotificationsComponent from "./components/NotificationsComponent"
import PurchasedProjectDetails from "./components/Projects/PurchasedProjectDetails";
import OrderProjectComponent from "./components/OrderProjectComponent";
import PreloaderComponent from "./components/PreloaderComponent";
import SavedProjectCardComponent from "./components/Projects/SavedProjectCardComponent";
import DeveloperComponent from "./components/DevelopersComponent"
import EditorComponent from "./components/EditorComponent"
import PricelistComponent from "./components/PricelistComponent"
import LoginComponent from "./components/Auth/LoginComponent";
import RegisterComponent from "./components/Auth/RegisterComponent";
import SmetaComponent from "./components/SmetaComponent";
import DeveloperRequestComponent from "./components/DeveloperRequestComponent";
/**
 * Using plugins
 */

Vue.use(VueRouter)
Vue.use(Vuelidate)
Vue.use(SequentialEntrance);
Vue.use(VueTheMask)
// Vue.use(VueCookies)

/**
 * Loading all the components
 */

Vue.component('login', LoginComponent);
Vue.component('register', RegisterComponent);

Vue.component('project-card', ProjectCardComponent);
Vue.component('purchased-project-card', PurchasedProjectCardComponent);
Vue.component('saved-project-card', SavedProjectCardComponent);
Vue.component('purchased-project-details', PurchasedProjectDetails);
Vue.component('my-projects', MyProjectsComponent);
Vue.component('project', ProjectComponent);
Vue.component('recommendations', Recommend);
Vue.component('my-projects', MyProjectsComponent);
Vue.component('advice', AdviceComponent);
Vue.component('add-balance', AddBalanceComponent);
Vue.component('notifications', NotificationsComponent);
Vue.component('preloader', PreloaderComponent);
Vue.component('order', OrderProjectComponent);
Vue.component('developers', DeveloperComponent);
Vue.component('editor', EditorComponent);
Vue.component('pricelist', PricelistComponent);
Vue.component('smeta', SmetaComponent);
Vue.component('developer-request', DeveloperRequestComponent);

const app = new Vue({
    el: '#app',
});

if (document.querySelector('.dropzone-hide')) {
    const inputs = document.querySelectorAll('.dropzone-hide')

    inputs.forEach((element) => {
        const label = element.nextElementSibling

        element.oninput = (e) => {
            let fileName = ''

            fileName = e.target.value.split('\\').pop()

            if (e.target.files.length > 1) {
                fileName = (e.target.getAttribute('data-multiple-caption') || '').replace('{count}', e.target.files.length)
            }
            label.innerHTML = fileName;
        }

        label.ondragover = evt => {
            evt.preventDefault()
        };
        label.ondragenter = evt => {
            evt.preventDefault()
        };
        label.ondragend = evt => {
            evt.preventDefault()
        }
        label.ondrop = evt => {
            evt.preventDefault()
            element.files = evt.dataTransfer.files
        }

    });
}
