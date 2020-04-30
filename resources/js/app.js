require('./bootstrap');

window.Vue = require('vue');
import VeeValidate from 'vee-validate';
import { Validator } from 'vee-validate';
import ru from 'vee-validate/dist/locale/ru';
import Toaster from 'v-toaster'

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
                surname:" ",
                description:' ',
                name:" ",
                patronymic:" ",
                email:' ',
                birthday:' ',
                address:" ",
                role:" ",
                grade:" ",
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


const app = new Vue({
    el: '#app',
});
