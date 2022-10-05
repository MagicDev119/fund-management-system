import Vue from 'vue'
import VueRouter from 'vue-router'

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

  console.log('isLoggedIn', to)
  if (!canNavigate(to)) {
    // Redirect to login if not logged in
  console.log('isLoggedIn', isLoggedIn)
    if (!isLoggedIn) return next({ name: 'user-login' })

    // If logged in => not authorized
    return next({ name: 'user-not-authorized' })
  }
  // Redirect if logged in
  if (to.meta.redirectIfLoggedIn && isLoggedIn) {
    const userData = getUserData()
    next(getHomeRouteForLoggedInUser(userData ? userData.role : null))
  }

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
