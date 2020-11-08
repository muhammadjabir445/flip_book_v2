export default {
    path:'/books',
    component:() => import('../views/index.vue'),
    meta:{auth:true},
    children:[
        {
            path:'',
            name:'book.index',
            component : () => import('../views/books/index.vue')
        },
        {
            path:'create',
            name:'book.create',
            component : () => import('../views/books/create.vue')
        },
        {
            path:':id/edit',
            name:'book.edit',
            component: () => import('../views/books/edit.vue')
        }

    ]
}

