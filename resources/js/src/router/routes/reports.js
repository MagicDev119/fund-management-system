export default [
  {
    path: '/reports/library',
    name: 'reports-library',
    component: () => import('@/views/reports/Library.vue'),
  },
  {
    path: '/reports/tearsheet',
    name: 'reports-tearsheet',
    component: () => import('@/views/reports/Tearsheet.vue'),
  },
  {
    path: '/reports/custom',
    name: 'reports-custom',
    component: () => import('@/views/reports/Custom.vue'),
  }
]
