import VueRouter from 'vue-router';

let routes = [
    {
        path: '/',
        component: require('./views/Home')
    },

    {
        path: '/hotels',
        component: require('./views/Hotels')
    },

    {
        path: '/register',
        component: require('./views/Register')
    },

    {
        path: '/login',
        component: require('./views/Login')
    },

    {
        path: '/mytrip',
        component: require('./views/Mytrip')
    },
    
    {
        path: '/profile',
        component: require('./views/User')
    }
];

export default new VueRouter({
    routes,
    linkActiveClass: 'is-active'
});
