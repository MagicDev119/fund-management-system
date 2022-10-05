<template>
  <b-row class="match-height">
    <b-col cols="12">
      <p class="mb-2">
        <span>A Vue.js component for ApexCharts. Read full documnetation</span>
        <b-link target="_blank" href="https://apexcharts.com/docs/installation/">
          here
        </b-link>
      </p>
    </b-col>
    <b-col cols="12">
      <b-row>
        <b-col>
          <statistic-card-vertical icon="Share2Icon" statistic="36.9k" statistic-title="Total invested" color="info" />
        </b-col>
        <b-col>
          <statistic-card-vertical icon="TrendingDownIcon" statistic="36.9k" statistic-title="Available for Drawdown"
            color="info" />
        </b-col>
        <b-col>
          <statistic-card-vertical icon="ActivityIcon" statistic="36.9k" statistic-title="Fund Gross IRR"
            color="info" />
        </b-col>
        <b-col>
          <statistic-card-vertical icon="RotateCcwIcon" statistic="36.9k" statistic-title="NET IRR" color="info" />
        </b-col>
        <b-col>
          <statistic-card-vertical icon="Link2Icon" statistic="36.9k" statistic-title="TVPI" color="info" />
        </b-col>
      </b-row>
    </b-col>
    <b-col md="6">
      <paid-in-invested-chart />
    </b-col>
    <b-col md="6">
      <line-chart />
    </b-col>
    <b-col md="6">
      <line-chart />
    </b-col>
    <b-col md="6">
      <line-chart />
    </b-col>
    <b-col md="6">
      <deal-allocation-chart />
    </b-col>
    <!-- <b-col cols="12">
      <apex-line-area-chart />
    </b-col>
    <b-col cols="12">
      <apex-data-bar-chart />
    </b-col>
    <b-col cols="12">
      <apex-scatter-chart />
    </b-col>
    <b-col cols="12">
      <apex-line-chart />
    </b-col>
    <b-col md="6">
      <apex-bar-chart />
    </b-col>
    <b-col md="6">
      <apex-candlestick-chart />
    </b-col>
    <b-col md="6">
      <apex-heat-map-chart />
    </b-col>
    <b-col md="6">
      <apex-radial-bar-chart />
    </b-col>
    <b-col md="6">
      <apex-radar-chart />
    </b-col>
    <b-col md="6">
      <apex-donut-chart />
    </b-col> -->
  </b-row>
</template>

<script>
import { BRow, BCol, BLink } from 'bootstrap-vue'
import StatisticCardVertical from '@core/components/statistics-cards/StatisticCardVertical.vue'
import LineChart from './charts/LineChart.vue'
import DealAllocationChart from './charts/DealAllocationChart.vue'
import PaidInInvestedChart from './charts/PaidInInvestedChart.vue'
// import ApexBarChart from './ApexBarChart.vue'
// import ApexCandlestickChart from './ApexCandlestickChart.vue'
// import ApexScatterChart from './ApexScatterChart.vue'
// import ApexHeatMapChart from './ApexHeatMapChart.vue'
// import ApexDonutChart from './ApexDonutChart.vue'
// import ApexRadialBarChart from './ApexRadialBarChart.vue'
// import ApexRadarChart from './ApexRadarChart.vue'

export default {
  components: {
    BRow,
    BCol,
    BLink,
    StatisticCardVertical,

    LineChart,
    DealAllocationChart,
    PaidInInvestedChart,
    // ApexBarChart,
    // ApexCandlestickChart,
    // ApexScatterChart,
    // ApexHeatMapChart,
    // ApexDonutChart,
    // ApexRadarChart,
    // ApexRadialBarChart,
  },
}
</script>

<style lang="scss">
@import '~@core/scss/vue/libs/chart-apex.scss';
</style>
