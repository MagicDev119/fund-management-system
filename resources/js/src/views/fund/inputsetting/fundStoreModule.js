import axios from '@axios'

export default {
  namespaced: true,
  state: {},
  getters: {},
  mutations: {},
  actions: {
    fetchFundFields(ctx, payload) {
        return axios
          .get('/api/fund/' + payload.id + '/field')
    },
    addFundField(ctx, payload) {
      return axios
          .post('/api/fund/' + payload.id + '/field', payload)
    },
    updateFundField(ctx, fundFieldData) {
      return axios
          .put(`/api/fund/field/${fundFieldData.id}`, fundFieldData)
    },
    removeFundField(ctx, { id }) {
      return axios
          .delete(`/api/fund/field/${id}`)
    },
    fetchFundFieldGroups(ctx, payload) {
      return axios
          .get('/api/fund/field/group', { params: payload })
    },
  },
}
