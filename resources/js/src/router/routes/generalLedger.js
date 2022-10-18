export default [
  {
    path: '/gl/edit',
    name: 'general-ledger-edit-gl',
    component: () => import('@/views/gl/Edit.vue'),
    meta: {
      action: 'manage',
      resource: 'Auth',
      show: ['fund'],
      pageTitle: 'Edit GL',
      breadcrumb: [
        {
          text: 'GL',
        },
        {
          text: 'Edit',
          active: true,
        },
      ],
    }
  },
  {
    path: '/gl/upload',
    name: 'general-ledger-upload',
    component: () => import('@/views/gl/Upload.vue'),
    meta: {
      action: 'manage',
      resource: 'Auth',
      pageTitle: 'Upload GL',
      breadcrumb: [
        {
          text: 'GL',
        },
        {
          text: 'Upload',
          active: true,
        },
      ],
    }
  }
]
