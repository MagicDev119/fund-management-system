export default [
  {
    path: '/dashboard/fund',
    name: 'fund-dashboard',
    component: () => import('@/views/dashboard/fund/Dashboard.vue'),
    meta: {
      action: 'manage',
      resource: 'Auth',
      show: ['fund', 'date'],
      pageTitle: 'Fund Dashboard',
      breadcrumb: [
        {
          text: 'Dashboard',
        },
        {
          text: 'Fund',
          active: true,
        },
      ],
    }
  }
]
