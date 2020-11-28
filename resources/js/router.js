import Vue from 'vue'
import Router from 'vue-router'
import store from './stores'
import axios from 'axios'

import UserRouter from './routes/users'
import MasterDataRouter from './routes/Masterdata'
import MenuRouter from './routes/Menu'
import RoleManagementRouter from './routes/RoleManagement'
import BookRouter from './routes/Book'
import AktivasiRouter from './routes/Aktivasi'
// import Vuetify from 'vuetify'
// Vue.use(Vuetify)
import './plugins/vuetify.js'
Vue.use(Router)
const router = new Router({
  mode: 'history',
  routes: [
    {
        path:'',
        name:'index',
        component:()=>import('./views/index.vue'),
        children:[
            {
                path: '/dahsboard',
                name: 'dashboard',
                component:()=>import('./views/dashboard/index.vue'),
                meta:{auth:true}

            },
            {
                path: '/mencoba',
                name: 'mencoba',
                component:()=>import('./views/mencoba/index.vue')
            },

            UserRouter,
            MasterDataRouter,
            MenuRouter,
            RoleManagementRouter,
            BookRouter,
            AktivasiRouter,

            {
                path: '/color',
                name: 'color',
                component:()=>import('./views/setting/color.vue'),
                meta:{auth:true}

            },
            {
                path:'my-book',
                name:'mybook',
                meta:{auth:true},
                component : () => import('./views/books/view.vue')
            },
            {
                path:'my-book/activation',
                name:'mybook.aktivasi',
                meta:{auth:true},
                component : () => import('./views/aktivasi/aktive.vue')
            },
            {
                path:'my-book/:kode/read',
                name:'mybook.read',
                meta:{auth:true},
                component : () => import('./views/books/read.vue')
            },



            {
                path:'books-list/:category',
                name:'book.list',
                meta:{auth:true},
                component : () => import('./views/books/list.vue')
            }


        ]

    },


    {
        path: '/login',
        name: 'login',
        component:()=>import('./views/Login.vue')
    },
    {
        path: '/register',
        name: 'register',
        component:()=>import('./views/Register.vue')
    },
    {
        path: '/reset-password',
        name: 'reset-password',
        component:()=>import('./views/password-reset.vue')
    },
    {
        path: '/reset-password/:token',
        name: 'reset-password.reset',
        component:()=>import('./views/password-reset.vue')
    },
    {
        path: '/404',
        name: 'notfound',
    },


    {
      path: '*',
      redirect: {
        name: 'notfound'
      }
    },

  ]
})



router.beforeEach(async (to,from,next) => {
    if( to.name != 'login') store.dispatch('BeforeUrl/setUrl',to.path)
    if (to.matched.some(record => record.meta.auth)) {

        if (store.getters['auth/user']) {
            next()
        }else{
            next('/login')
        }
    }else if(to.name === 'login'){
        if (store.getters['auth/user'] == null) {
            next()
        }else{
            if (store.getters['BeforeUrl/url'] || to.name !== 'login') {
                router.push(store.getters['BeforeUrl/url'])
            } else {
                router.push('/dahsboard')
            }

        }
    }else{
        next()
    }
})
// router.beforeEach((to,from,next) =>{
//     if(to.matched.some(record => record.meta.auth)){
//         //cek jika ada users maka kehalaman yg di tuju
//         if (store.getters['auth/user']) {
//             next()
//         }else{
//             next('/login')
//         }
//     }else if(to.name == 'login'){
//         //cek jika tidak ada users maka kehalaman login
//         if (!store.getters['auth/user']) {
//             next()
//         }else{

//             next('/dashboard')
//         }
//     }
//     else{
//         next()
//     }
// })
export default router
