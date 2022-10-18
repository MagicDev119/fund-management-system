export default [
  {
    path: '/companies/portcos',
    name: 'companies-portcos',
    component: () => import('@/views/companies/Portcos.vue'),
    meta: {
      action: 'manage',
      show: ['fund', 'date'],
      resource: 'Auth'
    }
  },
  {
    path: '/companies/datacollection',
    name: 'companies-data-collection',
    component: () => import('@/views/companies/DataCollection.vue'),
    meta: {
      action: 'manage',
      resource: 'Auth',
      pageTitle: 'Company metrics',
      show: ['portfolio'],
      breadcrumb: [
        {
          text: 'companies',
        },
        {
          text: 'Data.collection',
          active: true,
        },
      ],
    }
  }
]
