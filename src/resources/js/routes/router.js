import { createRouter, createWebHashHistory } from 'vue-router'
import store from './../store'

import Login from './../pages/Login.vue'
import Register from './../pages/Register.vue'
import Home from './../pages/Home.vue'

const routes = [
    { name: 'Register', path: '/register', component: Register },
    { name: 'Login', path: '/', component: Login },
    { name: 'Home', path: '/home', component: Home },
]

const router = createRouter({
    history: createWebHashHistory(),
    routes, // short for `routes: routes`
})

router.beforeEach((to, from, next) => {
    if (to.name === 'Register' && !store.getters.loggedIn) next()
    else if (to.name !== 'Login' && !store.getters.loggedIn) next({ name: 'Login' })
    else next()
})

export default router
