export default [
  {
    path: '/user/login',
    name: 'user-login',
    component: () => import('@/views/user/Login.vue'),
    meta: {
      layout: 'full',
      resource: 'Auth',
      redirectIfLoggedIn: true,
    },
  },
  {
    path: '/user/register',
    name: 'user-register',
    component: () => import('@/views/user/Register.vue'),
    meta: {
      layout: 'full',
      resource: 'Auth',
      redirectIfLoggedIn: true,
    },
  },
  {
    path: '/user/forgot-password',
    name: 'user-forgot-password',
    component: () => import('@/views/user/ForgotPassword.vue'),
    meta: {
      layout: 'full',
      resource: 'Auth',
      redirectIfLoggedIn: true,
    },
  },
  {
    path: '/user/not-authorized',
    name: 'user-not-authorized',
    component: () => import('@/views/user/NotAuthorized.vue'),
    meta: {
      layout: 'full',
      resource: 'Auth'
    },
  }
]
