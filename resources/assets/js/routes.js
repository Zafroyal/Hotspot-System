import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeComponent from './components/HomeComponent'
import CartComponent from './components/CartComponent'
import OrdersComponent from './components/OrdersComponent'
import EmployeeComponent from './components/EmployeeComponent'
import ProcessingComponent from './components/ProcessingComponent'
import ReadyComponent from './components/ReadyComponent'

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
      },
      {
        path: '/employee',
        name: 'employee',
        component:EmployeeComponent
      },
      {
        path: '/processing',
        name: 'processing',
        component:ProcessingComponent
      },
      {
        path: '/ready',
        name: 'ready',
        component:ReadyComponent
      }
    ]
  }
)

export default router
