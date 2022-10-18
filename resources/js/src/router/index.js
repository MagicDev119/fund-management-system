import Vue from 'vue'
import VueRouter from 'vue-router'
import axios from '@axios'

import { canNavigate } from '@/libs/acl/routeProtection'
import { isUserLoggedIn, getUserData, getHomeRouteForLoggedInUser } from '@/auth/utils'

import dashboard from './routes/dashboard'
import entities from './routes/entities'
import companies from './routes/companies'
import portfolio from './routes/portfolio'
import valuations from './routes/valuations'
import reports from './routes/reports'
import generalLedger from './routes/generalLedger'
import user from './routes/user'
import fund from './routes/fund'
import asset from './routes/asset'
import store from '@/store'

Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  scrollBehavior() {
    return { x: 0, y: 0 }
  },
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('@/views/Home.vue'),
      meta: {
        layout: 'full',
        action: 'read',
        resource: 'Auth',
        pageTitle: 'Home',
        breadcrumb: [
          {
            text: 'Home',
            active: true,
          },
        ],
      },
    },
    ...dashboard,
    ...entities,
    ...companies,
    ...portfolio,
    ...valuations,
    ...reports,
    ...generalLedger,
    ...user,
    ...fund,
    ...asset,
    {
      path: '/second-page',
      name: 'second-page',
      component: () => import('@/views/SecondPage.vue'),
      meta: {
        pageTitle: 'Second Page',
        breadcrumb: [
          {
            text: 'Second Page',
            active: true,
          },
        ],
      },
    },
    {
      path: '/error-404',
      name: 'error-404',
      component: () => import('@/views/error/Error404.vue'),
      meta: {
        layout: 'full',
        action: 'read',
        resource: 'Auth'
      },
    },
    {
      path: '*',
      redirect: 'error-404',
    },
  ],
})

router.beforeEach((to, _, next) => {
  const isLoggedIn = isUserLoggedIn()
  store.commit('app/INIT_NAV_STATE')
  if (to.meta.show) {
    to.meta.show.forEach(each => {
      switch (each) {
        case 'fund':
          store.commit('app/SHOW_FUND_DROPDOWN', true)
          break;
        case 'portfolio':
          store.commit('app/SHOW_PORTFOLIO_DROPDOWN', true)
          break;
        case 'date':
          store.commit('app/SHOW_DATE_DROPDOWN', true)
          break;
        case 'quarter':
          store.commit('app/SHOW_DATE_QUARTER_DROPDOWN', true)
          break;
        default:
          break;
      }
    })
  }
  if (to.name == 'home') {
    return next({ name: 'user-login' })
  }
  
  if (to.meta.redirectIfLoggedIn && isLoggedIn) {
    const userData = getUserData()
    next({name: 'fund-dashboard'})
  } else if (!canNavigate(to)) {
    if (!isLoggedIn) return next({ name: 'user-login' })

    return next({ name: 'user-not-authorized' })
  }
  // console.log('isLoggedIn', to)
  // if (!canNavigate(to)) {
  //   // Redirect to login if not logged in
  // console.log('isLoggedIn', isLoggedIn)
  //   if (!isLoggedIn) return next({ name: 'user-login' })

  //   // If logged in => not authorized
  //   return next({ name: 'user-not-authorized' })
  // }
  // // Redirect if logged in
  // if (to.meta.redirectIfLoggedIn && isLoggedIn) {
  //   const userData = getUserData()
  //   next(getHomeRouteForLoggedInUser(userData ? userData.role : null))
  // }
  
  // axios.get('/api/auth/user')
  // .then((res) => console.log('aaaaaaaaaaaaaaa', res))
  return next()
})

// ? For splash screen
// Remove afterEach hook if you are not using splash screen
router.afterEach(() => {
  // Remove initial loading
  const appLoading = document.getElementById('loading-bg')
  if (appLoading) {
    appLoading.style.display = 'none'
  }
})

export default router
