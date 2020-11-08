export default {
    path:'/aktivasi',
    component:() => import('../views/index.vue'),
    meta:{auth:true},
    children:[
        {
            path:'',
            name:'aktivasi.index',
            component : () => import('../views/aktivasi/index.vue')
        },
        {
            path:'create',
            name:'aktivasi.create',
            component : () => import('../views/aktivasi/create.vue')
        },

    ]
}

