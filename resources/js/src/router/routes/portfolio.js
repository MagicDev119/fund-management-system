export default [
  {
    path: '/portfolio/trackrecord',
    name: 'portfolio-track-record',
    component: () => import('@/views/portfolio/TrackRecord.vue'),
    meta: {
      action: 'manage',
      resource: 'Auth',
      pageTitle: 'Track Record',
      breadcrumb: [
        {
          text: 'Portfolio',
        },
        {
          text: 'Track.Record',
          active: true,
        },
      ],
    }
  },
  {
    path: '/portfolio/crashflows',
    name: 'portfolio-crashflows',
    component: () => import('@/views/portfolio/Crashflows.vue'),
    meta: {
      action: 'manage',
      resource: 'Auth',
      pageTitle: 'Cashflows',
      breadcrumb: [
        {
          text: 'Portfolio',
        },
        {
          text: 'Cashflows',
          active: true,
        },
      ],
    }
  },
  {
    path: '/portfolio/fundkpis',
    name: 'portfolio-fund-kpis',
    component: () => import('@/views/portfolio/FundKpis.vue'),
    meta: {
      action: 'manage',
      resource: 'Auth',
      pageTitle: 'Fund KPIs',
      breadcrumb: [
        {
          text: 'Portfolio',
        },
        {
          text: 'Fund.KPIs',
          active: true,
        },
      ],
    }
  }
]
