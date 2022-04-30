import { createApp } from 'vue'
import { createRouter, createWebHistory } from 'vue-router'
import HomePage from '@/views/HomePage.vue'
import App from './App.vue'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: HomePage
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

createApp(App).use(router).mount('#app')

