<template>
  <li class="nav-item nav-search">
    <div class="d-flex align-items-center position-relative">
      <flat-pickr v-model="fundDate" :config="config" class="align-middle ml-50" placeholder="Select date" name="date"
        @input="onDateChange">
      </flat-pickr>
      <feather-icon icon="CalendarIcon" size="21" class="input-inner-icon" />
    </div>
  </li>
</template>

<script>
import {
  BLink, BAvatar,
} from 'bootstrap-vue'
import flatPickr from 'vue-flatpickr-component'
import store from '@/store'
export default {
  components: {
    BLink,
    BAvatar,
    flatPickr,
  },
  data() {
    return {
      fundDate: new Date(),
      config: {
        wrap: true, // set wrap to true only when using 'input-group'
        altFormat: 'M j, Y',
        altInput: true,
        dateFormat: 'Y-m-d'
      },
    }
  },
  methods: {
    onDateChange() {
      console.log(this.fundDate)
      store.commit('app/SELECTED_DATE', this.fundDate)
    }
  },
  watch: {
    $route(to, from) {
      this.fundDate = new Date()
      store.commit('app/SELECTED_DATE', this.fundDate)
    }
  }
}
</script>

<style lang="scss">
@import '~@core/scss/vue/libs/vue-flatpicker.scss';

.input-inner-icon {
  position: absolute;
  right: 5px;
}
</style>
