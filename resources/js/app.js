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

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component'            , require('./components/ExampleComponent.vue').default);
Vue.component('reception-get-component'      , require('./components/ReceptionGetComponent.vue').default);
Vue.component('reception-get-min-component'  , require('./components/ReceptionGetMinComponent.vue').default);
Vue.component('reception-form-component'     , require('./components/ReceptionFormComponent.vue').default);
Vue.component('reception-confirm-component'  , require('./components/ReceptionConfirmComponent.vue').default);
Vue.component('form-input-peoples'           , require('./components/form/FormInputPeoples.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

$(function(){
    var duration = 800
    $('.fade-down').animate({
        opacity: '1',
        'top': '0px'
    },duration);
    $('.fade-up').animate({
        opacity: '1',
        'top': '0px'
    },duration);
    $('.link-area').animate({
        opacity: '1',
    },duration);

    $('.btn').on('click', function(){
        setTimeout(function(){
            location.href = '/form/peoples'
        },400)
    });

});

// btn波紋エフェクト
(() => { 

    const rippleEffect = (event) => { 
  
      let target = event.target; 
  
      if (!target) { 
        return; 
      } 
  
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