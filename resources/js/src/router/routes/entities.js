export default [
  {
    path: '/entities/fundlist',
    name: 'entities-fund-list',
    component: () => import('@/views/entities/FundList.vue'),
  },
  {
    path: '/entities/assetlist',
    name: 'entities-asset-list',
    component: () => import('@/views/entities/AssetList.vue'),
  }
]
