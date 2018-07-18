import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeComponent from './components/HomeComponent'
import CartComponent from './components/CartComponent'
import OrdersComponent from './components/OrdersComponent'

Vue.use(VueRouter)

const router = new VueRouter(
  {

    mode: 'history',
    routes: [
      {
        path: '/home',
        name: 'home',
        component:HomeComponent
      },
      {
        path: '/cart',
        name: 'cart',
        component:CartComponent
      },
      {
        path: '/orders',
        name: 'orders',
        component:OrdersComponent
      }
    ]
  }
)

export default router
