import { createApp } from 'vue'
import { createRouter, createWebHistory } from 'vue-router'
import axios from 'axios'
import VueAxios from 'vue-axios'

import App from './App.vue'

import HomePage from '@/views/HomePage.vue'
import GamePage from '@/views/GamePage.vue'
import BackOffice from '@/views/BackOffice.vue'


// Router front
const routes = [
  {
    path: '/',
    name: 'Home',
    component: HomePage,
  },
  {
    path: '/game',
    name: 'game',
    component: GamePage,
    beforeEnter: (to, from, next) => {
      if(!localStorage.getItem('accessToken') ) {
        window.alert('You need to be connected');
        next({ name: 'Home' });
      }
      else next()
    },
  },
  {
    path: '/questions-list',
    name: 'questionsList',
    component: BackOffice
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

createApp(App).use(router, VueAxios, axios).mount('#app')

