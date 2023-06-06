import { createRouter, createWebHashHistory } from '@ionic/vue-router';
import { RouteRecordRaw } from 'vue-router';
import TabsPage from '../views/tabs/TabsPage.vue'

const routes: Array<RouteRecordRaw> = [
  { path: '/', redirect: '/splash' },
  { path: '/splash', name: 'splash', component: () => import('@/views/SplashScreen.vue') },
  { path: '/login', name: 'login', component: () => import('@/views/LoginScreen.vue') },
  { path: '/signUp', name: 'signup', component: () => import('@/views/SignUpScreen.vue') },
  { path: '/chooseTypeOfPlace', name: 'chooseTypeOfPlace', component: () => import('@/views/ChooseTypeScreen.vue') },
  { path: '/createRoom', name: 'createRoom', component: () => import('@/views/CreateRoomScreen.vue') },
  { path: '/shareRoom', name: 'shareRoom', component: () => import('@/views/ShareRoomScreen.vue') },
  { path: '/setProfilePicture', name: 'setProfilePicture', component: () => import('@/views/SetProfilePictureScreen.vue') },
  { path: '/joinRoom', name: 'joinRoom', component: () => import('@/views/joinRoomScreen.vue') },
  {
    path: '/tabs/',
    component: TabsPage,
    children: [
      { path: 'home', name: 'home', component: () => import('@/views/tabs/TabHome.vue') },
      { path: 'tasks', name: 'tasks', component: () => import('@/views/tabs/TabTasks.vue') },
      { path: 'add', name: 'add', component: () => import('@/views/tabs/TabAdd.vue') },
      { path: 'calendar', name: 'calendar', component: () => import('@/views/tabs/TabCalendar.vue') },
      { path: 'profile', name: 'profile', component: () => import('@/views/tabs/TabProfile.vue') }
    ]
  }
]

const router = createRouter({
  history: createWebHashHistory(process.env.BASE_URL),
  routes
})

export default router
