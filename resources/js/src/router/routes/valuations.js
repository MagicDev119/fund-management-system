export default [
  {
    path: '/valuations/tool',
    name: 'valuations-tool',
    component: () => import('@/views/valuations/Tool.vue'),
  },
  {
    path: '/valuations/historical',
    name: 'valuations-historical',
    component: () => import('@/views/valuations/Historical.vue'),
  }
]
