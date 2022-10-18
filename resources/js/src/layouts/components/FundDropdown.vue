<template>
  <b-nav-item-dropdown id="dropdown-grouped" variant="link" class="dropdown-language" right>
    <template #button-content v-if="currentFund">
      <feather-icon size="21" :icon="`BriefcaseIcon`" />
      <span class="ml-50 text-body">{{ currentFund.name }}</span>
    </template>
    <b-dropdown-item @click="selectFund(selectAll)">
      <span class="ml-50">{{ selectAll.name }}</span>
    </b-dropdown-item>
    <b-dropdown-item v-for="fund in funds" :key="fund.id" @click="selectFund(fund)">
      <span class="ml-50">{{ fund.name }}</span>
    </b-dropdown-item>
  </b-nav-item-dropdown>
</template>

<script>
import { BNavItemDropdown, BDropdownItem, BImg } from 'bootstrap-vue'
import store from '@/store'

export default {
  components: {
    BNavItemDropdown,
    BDropdownItem,
    BImg,
  },
  computed: {
    currentFund() {
      return this.selectedFund
    },
  },
  data() {
    return {
      selectedFund: null,
      funds: [],
      selectAll: {
        id: 'all',
        name: 'Select All'
      }
    };
  },
  methods: {
    selectFund(fund) {
      store.commit('app/SELECTED_FUND', fund)
      this.selectedFund = fund
    }
  },
  created() {
    this.$http.get('/api/fund')
      .then(res => {
        this.funds = res.data
        store.commit('app/SELECTED_FUND', this.funds[0])
        this.selectedFund = this.funds[0]
      })
  },
  watch: {
    $route(to, from) {
      store.commit('app/SELECTED_FUND', this.funds[0])
      this.selectedFund = this.funds[0]
    }
  }
}
</script>

<style>

</style>
