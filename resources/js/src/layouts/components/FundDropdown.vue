<template>
  <b-nav-item-dropdown id="dropdown-grouped" variant="link" class="dropdown-language" right>
    <template #button-content>
      <feather-icon size="21" :icon="`BriefcaseIcon`" />
      <span class="ml-50 text-body">{{ currentFund.name }}</span>
    </template>
    <b-dropdown-item v-for="fund in funds" :key="fund.locale" @click="selectFund(fund)">
      <span class="ml-50">{{ fund.name }}</span>
    </b-dropdown-item>
  </b-nav-item-dropdown>
</template>

<script>
import { BNavItemDropdown, BDropdownItem, BImg } from 'bootstrap-vue'

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
      selectedFund: this.funds[0],
    };
  },
  methods: {
    selectFund(fund) {
      this.selectedFund = fund
    }
  },
  setup() {
    /* eslint-disable global-require */
    const funds = [
      {
        locale: 'en',
        img: require('@/assets/images/flags/en.png'),
        name: 'English',
      },
      {
        locale: 'fr',
        img: require('@/assets/images/flags/fr.png'),
        name: 'French',
      },
      {
        locale: 'de',
        img: require('@/assets/images/flags/de.png'),
        name: 'German',
      },
      {
        locale: 'pt',
        img: require('@/assets/images/flags/pt.png'),
        name: 'Portuguese',
      },
    ]
    /* eslint-disable global-require */

    return {
      funds,
    }
  },
}
</script>

<style>

</style>
