import axios from '@axios'

export default {
  namespaced: true,
  state: {},
  getters: {},
  mutations: {},
  actions: {
    fetchCompanyFields(ctx, payload) {
      return axios
        .get('/api/company/' + payload.id + '/field')
    },
    addCompanyField(ctx, payload) {
      return axios
        .post('/api/company/' + payload.id + '/field', payload)
    },
    updateCompanyField(ctx, companyFieldData) {
      return axios
        .put(`/api/company/field/${companyFieldData.id}`, companyFieldData)
    },
    removeCompanyField(ctx, { id }) {
      return axios
        .delete(`/api/company/field/${id}`)
    },
    fetchCompanyFieldGroups(ctx, payload) {
      return axios
        .get('/api/company/field/group', { params: payload })
    },
    fetchDataCollection(ctx, payload) {
      return axios
        .get('/api/asset/' + payload.id + '/datacollection')
    },
  },
}
