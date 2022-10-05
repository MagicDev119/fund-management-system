export default [
  {
    path: '/entities/fundlist',
    name: 'entities-fund-list',
    component: () => import('@/views/entities/FundList.vue'),
    meta: {
      action: 'manage',
      resource: 'Auth',
      pageTitle: 'Fund vehicle',
      breadcrumb: [
        {
          text: 'Entities',
        },
        {
          text: 'FundList',
          active: true,
        },
      ],
    }
  },
  {
    path: '/entities/assetlist',
    name: 'entities-asset-list',
    component: () => import('@/views/entities/AssetList.vue'),
    meta: {
      action: 'manage',
      resource: 'Auth',
      pageTitle: 'Asset',
      breadcrumb: [
        {
          text: 'Entities'
        },
        {
          text: 'AssetList',
          active: true,
        },
      ],
    }
  }
]
