import VueRouter from 'vue-router';

let routes = [
    {
        path: '/',
        component: require('./views/Home')
    },

    {
        path: '/about',
        component: require('./views/About')
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
        path: '/profile',
        component: require('./views/User')
    }
];

export default new VueRouter({
    routes,
    linkActiveClass: 'is-active'
});
