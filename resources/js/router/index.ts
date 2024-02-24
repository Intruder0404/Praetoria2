// Composables
import {createRouter, createWebHistory, RouteRecordRaw} from 'vue-router'
import {UserNavigator, AppBar, Footer} from "@/components";
import {authStore} from "@/store/auth";

const routes: Array<RouteRecordRaw> = [
    {
        path: '/',
        name: 'home',
        components: {
            AppBar: AppBar,
            content: () => import('@/pages/Home.vue'),
            footer: Footer
        }
    },
    {
        path: '/login',
        name: 'login',
        components: {
            content: () => import('@/pages/auth/Login.vue')
        },
        meta: {requiresAuth: false},
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        components: {
            UserNavigator,
            content: () => import('@/pages/administration/Dashboard.vue')
        },
        meta: {requiresAuth: true},
    },
    {
        path: '/admin/:name',
        name: 'admin',
        components: {
            UserNavigator,
            content: () => import('@/pages/administration/Admin.vue'),
        },
        meta: {requiresAuth: true},
    },
    {
        path: '/character',
        name: 'character',
        components: {
            UserNavigator,
            content: () => import('@/pages/administration/Character.vue'),
        },
        meta: {requiresAuth: true},
    },
    {
        path: '/account',
        name: 'account',
        components: {
            UserNavigator,
            content: () => import('@/pages/administration/Account.vue'),
        },
        meta: {requiresAuth: true},
    },
    {
        path: '/registration',
        name: 'registration',
        components: {
            AppBar,
            content: () => import('@/pages/auth/Registration.vue'),
        },
        meta: {requiresAuth: false},
    },
    {
        path: '/guild',
        name: 'guild',
        components: {
            AppBar,
            content: () => import('@/pages/Guild.vue'),
            footer: Footer
        },
        meta: {requiresAuth: false},
    },
    {
        path: '/families',
        name: 'families',
        components: {
            AppBar,
            content: () => import('@/pages/Families.vue'),
            footer: Footer
        },
        meta: {requiresAuth: false},
    },
    {
        path: '/religions',
        name: 'religions',
        components: {
            AppBar,
            content: () => import('@/pages/Religions.vue'),
            footer: Footer
        },
        meta: {requiresAuth: false},
    },
    {
        path: '/politics',
        name: 'politics',
        components: {
            AppBar,
            content: () => import('@/pages/Politics.vue'),
            footer: Footer
        },
        meta: {requiresAuth: false},
    },
    {
        path: '/merchants',
        name: 'merchants',
        components: {
            AppBar,
            content: () => import('@/pages/Merchants.vue'),
            footer: Footer
        },
        meta: {requiresAuth: false},
    },
    {
        path: '/Bicolline',
        name: 'bicolline',
        components: {
            AppBar,
            content: () => import('@/pages/Bicolline.vue'),
        },
        meta: {requiresAuth: false},
    },
    {path: '/:pathMatch(.*)*', redirect: '/'},
]

const router = createRouter({
    history: createWebHistory(import.meta.env.APP_API_URL),
    routes,
    scrollBehavior(to, from, savedPosition) {
        return {top: 0}
    },
});

router.beforeEach(async (to, from, next) => {
    if (to.matched.some((record) => record.meta.requiresAuth)) {
        if (authStore().isAuthenticated) {
            next();
            return;
        }
        next("/home");
    } else if (!to.matched.some((record) => record.name)) {
        next("/home");
    } else {
        next();
    }
});

export default router
