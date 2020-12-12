export default {
    path:'/artikel',
    component:() => import('../views/index.vue'),
    meta:{auth:true},
    children:[
        {
            path:'',
            name:'artikel.index',
            component : () => import('../views/artikel/index.vue')
        },
        {
            path:'create',
            name:'artikel.create',
            component : () => import('../views/artikel/create.vue')
        },
        {
            path:':id/edit',
            name:'artikel.edit',
            component: () => import('../views/artikel/edit.vue')
        }

    ]
}

