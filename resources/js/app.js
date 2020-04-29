require('./bootstrap');

window.Vue = require('vue');
import VeeValidate from 'vee-validate';
import { Validator } from 'vee-validate';
import ru from 'vee-validate/dist/locale/ru';

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


const app = new Vue({
    el: '#app',
});
