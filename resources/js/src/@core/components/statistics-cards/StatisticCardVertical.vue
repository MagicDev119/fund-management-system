<template>
  <b-card class="text-center">
    <b-avatar class="mb-1" :variant="`light-${color}`" size="45">
      <feather-icon size="21" :icon="icon" />
    </b-avatar>
    <div class="truncate">
      <h6 class="mb-1 font-weight-bolder">
        {{ statisticTitle }}
      </h6>
      <h2>{{ statistic }}</h2>
    </div>
  </b-card>
</template>

<script>
import { BCard, BAvatar } from 'bootstrap-vue'

export default {
  components: {
    BCard,
    BAvatar,
  },
  props: {
    icon: {
      type: String,
      required: true,
    },
    statistic: {
      type: [Number, String],
      required: true,
    },
    statisticTitle: {
      type: String,
      default: '',
    },
    color: {
      type: String,
      default: 'primary',
    },
  },
}
</script>
