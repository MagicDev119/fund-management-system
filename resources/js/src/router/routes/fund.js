export default [
  {
    path: '/fund/create',
    name: 'fund-create',
    component: () => import('@/views/fund/Create.vue'),
    meta: {
      action: 'manage',
      resource: 'Auth',
      pageTitle: 'Fund Create',
      breadcrumb: [
        {
          text: 'Fund',
          to: '/entities/fundlist'
        },
        {
          text: 'Create',
          active: true,
        },
      ],
    }
  },
  {
    path: '/fund/edit',
    name: 'fund-edit',
    component: () => import('@/views/fund/Edit.vue'),
    meta: {
      action: 'manage',
      resource: 'Auth',
      pageTitle: 'Fund Edit',
      breadcrumb: [
        {
          text: 'Fund',
          to: '/entities/fundlist'
        },
        {
          text: 'Edit',
          active: true,
        },
      ],
    }
  },
  {
    path: '/fund/inputsetting',
    name: 'fund-inputsetting',
    component: () => import('@/views/fund/inputsetting/InputSetting.vue'),
    meta: {
      action: 'manage',
      resource: 'Auth',
      pageTitle: 'Input Setting',
      contentRenderer: 'sidebar-left',
      contentClass: 'todo-application',
      breadcrumb: [
        {
          text: 'Fund',
          to: '/entities/fundlist'
        },
        {
          text: 'Input Setting',
          active: true,
        },
      ],
    }
  },
  {
    path: '/fund/inputsetting/:group_slug',
    name: 'fund-inputsetting-group',
    component: () => import('@/views/fund/inputsetting/InputSetting.vue'),
    meta: {
      action: 'manage',
      resource: 'Auth',
      pageTitle: 'Input Setting',
      contentRenderer: 'sidebar-left',
      contentClass: 'todo-application',
      breadcrumb: [
        {
          text: 'Fund',
          to: '/entities/fundlist'
        },
        {
          text: 'Input Setting',
          active: true,
        },
      ],
    }
  }
]
