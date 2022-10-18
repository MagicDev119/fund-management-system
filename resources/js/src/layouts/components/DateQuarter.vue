<template>
  <b-nav-item-dropdown id="dropdown-grouped" variant="link" class="dropdown-language" right>
    <template #button-content v-if="currentQuarter">
      <feather-icon size="21" :icon="`CalendarIcon`" />
      <span class="ml-50 text-body" v-show="currentQuarter">{{ currentQuarter.name }}</span>
    </template>
    <b-dropdown-item v-for="quarter in quarters" :key="quarter.id" @click="selectQuarter(quarter)">
      <span class="ml-50">{{ quarter.name }}</span>
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
    currentQuarter() {
      return this.selectedQuarter
    },
  },
  data() {
    return {
      selectedQuarter: null,
      quarters: []
    };
  },
  methods: {
    selectQuarter(quarter) {
      store.commit('app/SELECTED_DATEQUARTER', quarter)
      this.selectedQuarter = quarter
    }
  },
  created() {
    this.quarters = [
      {
        id: 1,
        name: 'Quarter-1'
      }, {
        id: 2,
        name: 'Quarter-2'
      }, {
        id: 3,
        name: 'Quarter-3'
      }, {
        id: 4,
        name: 'Quarter-4'
      }
    ]
    store.commit('app/SELECTED_DATEQUARTER', this.quarters[0])
    this.selectedQuarter = this.quarters[0]
  },
  watch: {
    $route(to, from) {
      store.commit('app/SELECTED_DATEQUARTER', this.quarters[0])
      this.selectedQuarter = this.quarters[0]
    }
  }
}
</script>

<style>

</style>
