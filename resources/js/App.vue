<template>
    <div @click.right="disabled_right_click($event)">
    <v-app v-if="$route.name != 'login'" >
        <Snakbar/>
        <div v-if="user">
            <Header  />
            <Sidebar  />
        </div>
        <v-main class="">
        <v-container fluid grid-list-md text-xs-center >
            <v-slide-y-transition mode="out-in">
            <router-view></router-view>
            </v-slide-y-transition>
        </v-container>
        </v-main>
    </v-app>

    <v-app v-else-if="$route.name == 'login'" height="100%">
        <Snakbar/>
        <v-container fluid grid-list-md text-xs-center style="" >
            <v-slide-y-transition mode="out-in">
            <Login/>
            </v-slide-y-transition>
        </v-container>
    </v-app>
    </div>

    <!-- <v-app v-else-if="$route.name == 'notfound'">
        <v-container fluid grid-list-md text-xs-center >
            <v-slide-y-transition mode="out-in">
            <NotFound/>
            </v-slide-y-transition>
        </v-container>
    </v-app> -->

</template>
<script>
 import Header from './components/layouts/Header.vue'
 import Snakbar from './components/Snakbar.vue'
 import Sidebar from './components/layouts/Sidebar'
 import {mapGetters,mapActions} from 'vuex'
 import Login from './views/Login.vue'
//  import NotFound from './views/NotFound.vue'

export default {

    name: 'App',
    components : {
         Header,
         Snakbar,
         Sidebar,
         Login,
        //  NotFound
    },
     computed:{
        ...mapGetters({
            user : 'auth/user',
            // dialog : 'statusDialog/dialog',
            // currentComponent : 'component/current'
        })
    },

    methods:{
        ...mapActions({
            setAuth: 'auth/setAuth',
            setColor: 'color/setColor'
        }),
        disabled_right_click(event) {
            event.preventDefault();

        }
    },

    async created() {
        await this.axios.get('/setting-color')
        .then(ress => {
            this.setColor(ress.data.color)
        })
        .catch(err=> {

        })
    }



    // async beforeCreate(){
    //     let token = localStorage.getItem('token')

    //     console.log(token)
    //     let config = {
    //         headers: {
    //         'Authorization': 'Bearer ' + token,
    //         }
    //     }
    //     if (token != null) {
    //     await this.axios.get('/me',config)
    //         .then((ress) =>{
    //             console.log(ress)
    //             this.setAuth({
    //                 user: ress.data.user,
    //                 token : ress.data.access_token,
    //                 menu : ress.data.menu
    //             })
    //             this.$router.push('/dahsboard')
    //         }
    //             )
    //         .catch((err) =>console.log(err))
    //     }

    //     console.log(this.user)

    // }
//   components: {
//   'c-header': CHeader,
//   	Sidebar,
//     CAlert: () => import('./components/CAlert.vue'),
//     CUusers: () => import('./components/CUusers.vue'),
//     CUcategory: () => import('./components/CUcategory.vue'),
//     CUcostumer: () => import('./components/CUcostumer.vue'),
//     CUsupplier: () => import('./components/CUsupplier.vue'),
//     CUbarang: () => import('./components/CUbarang.vue'),
//   },

//   computed:{
//     ...mapGetters({
//        statusDialog: 'dialog/statusDialog',
//        currentComponent: 'dialog/currentComponent',
//     })
//   }
}
</script>
