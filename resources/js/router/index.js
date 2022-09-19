import {createRouter, createWebHistory} from 'vue-router'

const routes = [
  { path: '/', name: 'users', component: () => import('@/views/user/index.vue') },
  { path: '/create', name: 'userCreate', component: () => import('@/views/user/create.vue') },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
