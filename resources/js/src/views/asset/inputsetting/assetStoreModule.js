import axios from '@axios'

export default {
  namespaced: true,
  state: {},
  getters: {},
  mutations: {},
  actions: {
    fetchAssetFields(ctx, payload) {
        return axios
          .get('/api/asset/' + payload.id + '/field')
    },
    addAssetField(ctx, payload) {
      return axios
          .post('/api/asset/' + payload.id + '/field', payload)
    },
    updateAssetField(ctx, assetFieldData) {
      return axios
          .put(`/api/asset/field/${assetFieldData.id}`, assetFieldData)
    },
    removeAssetField(ctx, { id }) {
      return axios
          .delete(`/api/asset/field/${id}`)
    },
    fetchAssetFieldGroups(ctx, payload) {
      return axios
          .get('/api/asset/field/group', { params: payload })
    },
  },
}
