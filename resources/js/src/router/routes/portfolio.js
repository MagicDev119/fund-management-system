export default [
  {
    path: '/portfolio/trackrecord',
    name: 'portfolio-track-record',
    component: () => import('@/views/portfolio/TrackRecord.vue'),
  },
  {
    path: '/portfolio/crashflows',
    name: 'portfolio-crashflows',
    component: () => import('@/views/portfolio/Crashflows.vue'),
  },
  {
    path: '/portfolio/fundkpis',
    name: 'portfolio-fund-kpis',
    component: () => import('@/views/portfolio/FundKpis.vue'),
  }
]
