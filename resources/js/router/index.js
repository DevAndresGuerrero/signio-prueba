import {createRouter, createWebHistory} from 'vue-router'

const routes = [
  { path: '/', name: 'home', component: () => import('@/views/Home.vue') },
  { path: '/users', name: 'users', component: () => import('@/views/Users.vue') },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
