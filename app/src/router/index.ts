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
  { path: '/shareRoom', component: () => import('@/views/ShareRoomScreen.vue') },
  { path: '/test', component: () => import('@/components/TaskFilter.vue') },
  {
    path: '/tabs/',
    component: TabsPage,
    children: [
      { path: 'home', component: () => import('@/views/tabs/TabHome.vue') },
      { path: 'tasks', component: () => import('@/views/tabs/TabTasks.vue') },
      { path: 'add', component: () => import('@/views/tabs/TabAdd.vue') },
      { path: 'calendar', component: () => import('@/views/tabs/TabCalendar.vue') },
      { path: 'profile', component: () => import('@/views/tabs/TabProfile.vue') }
    ]
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
