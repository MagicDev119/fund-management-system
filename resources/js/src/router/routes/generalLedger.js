export default [
  {
    path: '/gl/edit',
    name: 'general-ledger-edit-gl',
    component: () => import('@/views/gl/Edit.vue'),
  },
  {
    path: '/gl/upload',
    name: 'general-ledger-upload',
    component: () => import('@/views/gl/Upload.vue'),
  }
]
