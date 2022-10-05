export default [
  {
    path: '/asset/create',
    name: 'asset-create',
    component: () => import('@/views/asset/Create.vue'),
    meta: {
      action: 'manage',
      resource: 'Auth',
      pageTitle: 'Asset Create',
      breadcrumb: [
        {
          text: 'Asset',
          to: '/entities/assetlist'
        },
        {
          text: 'Create',
          active: true,
        },
      ],
    }
  },
  {
    path: '/asset/edit',
    name: 'asset-edit',
    component: () => import('@/views/asset/Edit.vue'),
    meta: {
      action: 'manage',
      resource: 'Auth',
      pageTitle: 'Asset Edit',
      breadcrumb: [
        {
          text: 'Asset',
          to: '/entities/assetlist'
        },
        {
          text: 'Edit',
          active: true,
        },
      ],
    }
  },
  {
    path: '/asset/inputsetting',
    name: 'asset-inputsetting',
    component: () => import('@/views/asset/InputSetting.vue'),
    meta: {
      action: 'manage',
      resource: 'Auth',
      pageTitle: 'Input Setting',
      breadcrumb: [
        {
          text: 'Asset',
          to: '/entities/assetlist'
        },
        {
          text: 'Input Setting',
          active: true,
        },
      ],
    }
  }
]
