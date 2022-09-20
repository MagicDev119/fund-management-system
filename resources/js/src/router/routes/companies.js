export default [
  {
    path: '/companies/portcos',
    name: 'companies-portcos',
    component: () => import('@/views/companies/Portcos.vue'),
  },
  {
    path: '/companies/datacollection',
    name: 'companies-data-collection',
    component: () => import('@/views/companies/DataCollection.vue'),
  }
]
