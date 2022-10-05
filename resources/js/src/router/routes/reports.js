export default [
  {
    path: '/reports/library',
    name: 'reports-library',
    component: () => import('@/views/reports/Library.vue'),
    meta: {
      action: 'manage',
      resource: 'Auth',
      pageTitle: 'Library',
      breadcrumb: [
        {
          text: 'Reports',
        },
        {
          text: 'Library',
          active: true,
        },
      ],
    }
  },
  {
    path: '/reports/tearsheet',
    name: 'reports-tearsheet',
    component: () => import('@/views/reports/Tearsheet.vue'),
    meta: {
      action: 'manage',
      resource: 'Auth',
      pageTitle: 'Tearsheet',
      breadcrumb: [
        {
          text: 'Reports',
        },
        {
          text: 'Tearsheet',
          active: true,
        },
      ],
    }
  },
  {
    path: '/reports/custom',
    name: 'reports-custom',
    component: () => import('@/views/reports/Custom.vue'),
    meta: {
      action: 'manage',
      resource: 'Auth',
      pageTitle: 'Custom',
      breadcrumb: [
        {
          text: 'Reports',
        },
        {
          text: 'Custom',
          active: true,
        },
      ],
    }
  }
]
