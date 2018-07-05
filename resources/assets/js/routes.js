import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeComponent from './components/HomeComponent'

Vue.use(VueRouter)

const router = new VueRouter(
  {
    mode: 'history',
    routes: [
      {
        path: "/home",
        component:HomeComponent
      }
    ]
  }
)

export default router
