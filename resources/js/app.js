require('./bootstrap');

window.Vue = require('vue');
import VeeValidate from 'vee-validate';
import { Validator } from 'vee-validate';
import ru from 'vee-validate/dist/locale/ru';
import Toaster from 'v-toaster'
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
import Paginate from 'vuejs-paginate'

Vue.component('paginate', Paginate)
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component("v-select", vSelect);
// You need a specific loader for CSS files like https://github.com/webpack/css-loader
import 'v-toaster/dist/v-toaster.css'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Install BootstrapVue
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
// optional set default imeout, the default is 10000 (10 seconds).
Vue.use(Toaster, {timeout: 5000})
Vue.use(VeeValidate, {
    fieldsBagName: 'veeFields',
    locale: 'ru',
    dictionary: {
        ru: {
            messages:{
                confirmed: 'Пароли не совдают'
            },
            attributes:{
                education:" ",
                description:' ',
                specialty:" ",
                experience:" ",
                email:' ',
                birthday:' ',
                address:" ",
                role:" ",
                skills:" ",
                sex:" ",
                number:" ",
                day:" ",
                grade_id:" ",
                classroom_id:" ",
                semester:" ",
                'confirm-password': " ",
                password: " ",
            }
        }
    }
});
Validator.localize('ru', ru);


// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('employer-header', require('./components/employer/blocks/header/EmployerHeader.vue').default);
Vue.component('footer-component', require('./components/blocks/footer/FooterComponent.vue').default);
Vue.component('create-bid', require('./components/employer/forms/CreateBid.vue').default);
Vue.component('employee-header', require('./components/employee/blocks/EmployeeHeader.vue').default);
Vue.component('create-resume', require('./components/employee/forms/CreateResume.vue').default);
Vue.component('manager-header', require('./components/manager/blocks/ManagerHeader.vue').default);
Vue.component('search-for-bid', require('./components/employee/SearchForBid.vue').default);
Vue.component('index-bids', require('./components/employer/IndexBids.vue').default);
Vue.component('search-for-resumes', require('./components/employer/SearchForResumes.vue').default);
Vue.component('manager-index-bids', require('./components/manager/ManagerIndexBids.vue').default);
Vue.component('index-resumes', require('./components/manager/IndexResumes.vue').default);
Vue.component('employee-resume', require('./components/employee/EmployeeResume.vue').default);
Vue.component('edit-bid', require('./components/employer/forms/EditBid.vue').default);
Vue.component('publish-refuse', require('./components/manager/blocks/PublishRefuse.vue').default);
Vue.component('edit-resume', require('./components/employee/forms/EditResume.vue').default);
Vue.component('watch-bid', require('./components/employee/WatchBid.vue').default);
Vue.component('watch-offer', require('./components/employee/WatchOffer.vue').default);
Vue.component('offers-list', require('./components/employee/OffersList').default);
Vue.component('show-bid', require('./components/manager/ShowBid').default);
Vue.component('show-resume', require('./components/manager/ShowResume').default);
Vue.component('table-manager', require('./components/forms/TableAdmin').default);
Vue.component('index-specialties', require('./components/manager/IndexSpecialties').default);
Vue.component('create-specialty', require('./components/manager/CreateSpecialty').default);
Vue.component('edit-specialty', require('./components/manager/EditSpecialty').default);
Vue.component('bid-offer-list', require('./components/employer/BidOfferList').default);
Vue.component('send-resume-index', require('./components/employee/SendResumeIndex').default);
Vue.component('send-resume', require('./components/employee/SendResume').default);
Vue.component('create-offer', require('./components/employer/forms/CreateOffer').default);
Vue.component('watch-resume', require('./components/employer/WatchResume').default);
Vue.component('watch-bid-offer', require('./components/employer/WatchBidOffer').default);
Vue.component('send-bid-index', require('./components/employer/SendBidIndex').default);

const app = new Vue({
    el: '#app',
});
