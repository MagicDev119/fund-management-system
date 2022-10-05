<template>
  <b-row>
    <b-col cols="12">
      <good-table-basic />
    </b-col>
  </b-row>
</template>

<script>
import { BCard, BCardText, BLink, BRow, BCol } from 'bootstrap-vue'
import GoodTableBasic from './table/GoodTableBasic.vue'

export default {
  components: {
    BCard,
    BCardText,
    BLink,
    BRow,
    BCol,
    GoodTableBasic,
  },
}
</script>

<style lang="scss" >
@import '~@core/scss/vue/libs/vue-good-table.scss';
</style>