export default [
  {
    path: '/companies/portcos',
    name: 'companies-portcos',
    component: () => import('@/views/companies/Portcos.vue'),
    meta: {
      action: 'manage',
      show: ['portfolio', 'date'],
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
          text: 'Companies',
        },
        {
          text: 'Data.collection',
          active: true,
        },
      ],
    }
  },
  {
    path: '/companies/spreadsheet/:selectedGroup',
    name: 'companies-spreadsheet/:selectedGroup',
    component: () => import('@/views/companies/Spreadsheet.vue'),
    meta: {
      action: 'manage',
      resource: 'Auth',
      pageTitle: 'Spreadsheet Mode',
      breadcrumb: [
        {
          text: 'Companies',
        },
        {
          text: 'Spreadsheet',
          active: true,
        },
      ],
    }
  },
  {
    path: '/companies/managematrics/:selectedGroup',
    name: 'companies-manage-matrics/:selectedGroup',
    component: () => import('@/views/companies/ManageMatrics.vue'),
    meta: {
      action: 'manage',
      resource: 'Auth',
      pageTitle: 'Manage matrics',
      breadcrumb: [
        {
          text: 'Companies',
        },
        {
          text: 'Manage matrics',
          active: true,
        },
      ],
    }
  }
]
