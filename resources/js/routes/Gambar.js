export default {
    path:'/gambar-landing',
    component:() => import('../views/index.vue'),
    meta:{auth:true},
    children:[
        {
            path:'',
            name:'gambar.index',
            component : () => import('../views/gambar/index.vue')
        },
        {
            path:'create',
            name:'gambar.create',
            component : () => import('../views/gambar/create.vue')
        },

    ]
}

