<template>
  <b-row>
    <b-col cols="12">
      <asset-table />
    </b-col>
  </b-row>
</template>

<script>
import { BCard, BCardText, BLink, BRow, BCol } from 'bootstrap-vue'
import AssetTable from './table/AssetTable.vue'

export default {
  components: {
    BCard,
    BCardText,
    BLink,
    BRow,
    BCol,
    AssetTable,
  },
}
</script>

<style lang="scss" >
@import '~@core/scss/vue/libs/vue-good-table.scss';
</style>