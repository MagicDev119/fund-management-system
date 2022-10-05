export default [
  {
    path: '/valuations/tool',
    name: 'valuations-tool',
    component: () => import('@/views/valuations/Tool.vue'),
    meta: {
      action: 'manage',
      resource: 'Auth',
      pageTitle: 'Valuation',
      breadcrumb: [
        {
          text: 'Valuations',
        },
        {
          text: 'Valuation',
          active: true,
        },
      ],
    }
  },
  {
    path: '/valuations/historical',
    name: 'valuations-historical',
    component: () => import('@/views/valuations/Historical.vue'),
    meta: {
      action: 'manage',
      resource: 'Auth',
      pageTitle: 'Historical',
      breadcrumb: [
        {
          text: 'Valuations',
        },
        {
          text: 'Historical',
          active: true,
        },
      ],
    }
  }
]
