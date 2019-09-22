/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
import store from './store'
import { library } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(fas)
 
// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// global登録
// 増やしすぎない
Vue.component('font-awesome-icon'               , FontAwesomeIcon);
Vue.component('example-component'               , require('./components/ExampleComponent.vue').default);
Vue.component('header-component'                , require('./components/HeaderComponent.vue').default);
Vue.component('reception-get-component'         , require('./components/ReceptionGetComponent.vue').default);
Vue.component('reception-get-min-component'     , require('./components/ReceptionGetMinComponent.vue').default);
Vue.component('reception-form-component'        , require('./components/ReceptionFormComponent.vue').default);
Vue.component('reception-confirm-component'     , require('./components/ReceptionConfirmComponent.vue').default);
Vue.component('form-input-peoples-component'    , require('./components/form/FormInputPeoplesComponent.vue').default);
Vue.component('form-seat-select-component'      , require('./components/form/FormSeatSelectComponent.vue').default);
Vue.component('form-tobacco-select-component'   , require('./components/form/FormTobaccoSelectComponent.vue').default);
Vue.component('form-input-tell-component'       , require('./components/form/FormInputTellComponent.vue').default);
Vue.component('modal-component'                 , require('./components/modal/Modalcomponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store,
});

$(function(){
    var duration = 800

    $('.container').animate({
        opacity: '1',
    },duration);
    $('.js-fade-in-out').animate({
      opacity: '1'
    },duration);

    // progressbar animarion==================
    let progressbarTime = 1000
    $('.js-progressbar').delay(300).animate({
      'height': '15px',
    },400);
    setTimeout(function(){
      $('.progressbar').addClass('move');
      setTimeout(function(){
        $('.progressbar').removeClass('move');
      },1000);
    },1300);
    // =======================================

    $('.next-form-btn').on('click', function(){
      $('.container').delay(200).animate({
        opacity: '0',
      }, 400);
        setTimeout(function(){
            location.href = '/form/peoples'
        },600)
    });
});

// btn波紋エフェクト
(() => { 
    const rippleEffect = (event) => {
  
      let target = event.target; 
      if (!target) { 
        return; 
      }
      console.log('ripple')
      const cover = document.createElement('span'); 
      const coverSize = target.offsetWidth; 
      const loc = target.getBoundingClientRect(); 
  
      const x = event.pageX - loc.left - window.pageXOffset - (coverSize / 2); 
      const y = event.pageY - loc.top - window.pageYOffset - (coverSize / 2); 
  
      const pos = `top: ${y}px; left: ${x}px; height: ${coverSize}px; width: ${coverSize}px;`; 
  
      target.appendChild(cover);
      cover.setAttribute('style', pos);
      cover.setAttribute('class', 'ripple-active');
  
      setTimeout(() => {
        cover.remove();
      }, 2000); 
    }; 
  
    document.addEventListener('DOMContentLoaded', () => { 
      Array.from(document.querySelectorAll('.ripple')).forEach((elem) => { 
        elem.addEventListener('click', rippleEffect)
      }); 
    }); 
  
  })();