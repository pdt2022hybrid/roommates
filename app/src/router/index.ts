import { createRouter, createWebHistory } from '@ionic/vue-router';
import { RouteRecordRaw } from 'vue-router';
import TabsPage from '../views/tabs/TabsPage.vue'

const routes: Array<RouteRecordRaw> = [
  { path: '/', redirect: '/splash' },
  { path: '/splash', component: () => import('@/views/SplashScreen.vue') },
  { path: '/login', component: () => import('@/views/LoginScreen.vue') },
  { path: '/signUp', component: () => import('@/views/SignUpScreen.vue') },
  { path: '/chooseTypeOfPlace', component: () => import('@/views/ChooseTypeScreen.vue') },
  { path: '/createRoom', component: () => import('@/views/CreateRoomScreen.vue') },
  {
    path: '/tabs/',
    component: TabsPage,
    children: [
      //{ path: '', redirect: '/tabs/tab1' },
      { path: 'tab1', component: () => import('@/views/tabs/Tab1Page.vue') },
      { path: 'tab2', component: () => import('@/views/tabs/Tab2Page.vue') },
      { path: 'tab3', component: () => import('@/views/tabs/Tab3Page.vue') }
    ]
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
