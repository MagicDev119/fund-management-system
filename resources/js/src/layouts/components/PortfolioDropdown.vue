<template>
  <b-nav-item-dropdown id="dropdown-grouped" variant="link" class="dropdown-language" right>
    <template #button-content v-if="currentAsset">
      <feather-icon size="21" :icon="`BriefcaseIcon`" />
      <span class="ml-50 text-body">{{ currentAsset.name }}</span>
    </template>
    <b-dropdown-item @click="selectAsset(selectAll)">
      <span class="ml-50">{{ selectAll.name }}</span>
    </b-dropdown-item>
    <b-dropdown-group v-for="fund in funds" :key="fund.id" :header="fund.name">
      <b-dropdown-item v-for="asset in fund.assets" :key="asset.id" @click="selectAsset(asset)">
        <span class="ml-50">{{ asset.name }}</span>
      </b-dropdown-item>
    </b-dropdown-group>
  </b-nav-item-dropdown>
</template>

<script>
import {
  BNavItemDropdown, BDropdownItem, BImg, BDropdownGroup
} from 'bootstrap-vue'
import store from '@/store'

export default {
  components: {
    BNavItemDropdown,
    BDropdownItem,
    BImg,
    BDropdownGroup,
  },
  computed: {
    currentAsset() {
      return this.selectedAsset
    },
  },
  data() {
    return {
      selectedAsset: null,
      funds: [],
      selectAll: {
        id: 'all',
        name: 'Select All'
      }
    };
  },
  methods: {
    selectAsset(asset) {
      store.commit('app/SELECTED_PORTFOLIO', asset)
      this.selectedAsset = asset
    }
  },
  created() {
    this.$http.get('/api/fund')
      .then(res => {
        this.funds = res.data
        store.commit('app/SELECTED_PORTFOLIO', this.funds[0]?.assets[0])
        this.selectedAsset = this.funds[0]?.assets[0]
      })
  },
  watch: {
    $route(to, from) {
      store.commit('app/SELECTED_PORTFOLIO', this.funds[0]?.assets[0])
      this.selectedAsset = this.funds[0]?.assets[0]
    }
  }
}
</script>

<style>

</style>
