<template>
  <div>
    <b-card no-body>
      <b-tabs card>
        <!-- Render Tabs, supply a unique `key` to each tab -->
        <b-tab class="pt-0" v-for="eachCollection in collectionData" :key="'dyn-tab-' + eachCollection.id"
          :title="eachCollection.category_name">
          <b-card-text>
            <h4 class="card-title d-flex justify-content-end align-items-center">
              <b-button variant="outline-primary" class="btn-tour-skip mr-1 d-flex align-items-center">
                <b-img :src="imgUrl" alt="xlsx" :height="18" />
                <span class="pl-75">Export</span>
              </b-button>
              <b-button variant="outline-primary" class="btn-tour-skip d-flex align-items-center">
                <feather-icon icon="SettingsIcon" size="16" class="align-text-top mr-25" />
              </b-button>
              <b-link :to="{ name: '' }" class="btn btn-primary round ml-1">
                <feather-icon icon="Edit2Icon" size="16" class="align-text-top mr-25" />
                <span>Spreadsheet mode</span>
              </b-link>
            </h4>
          </b-card-text>
          <hr />
          <b-card-text>
            <b-row class="pb-2">
              <b-col md="12">
                <b-table responsive :items="eachCollection.companyMatrics" bordered>
                  <template #head()="tableHead">{{ }}
                    <div v-if="(tableHead.label.toLowerCase() === 'matrics')">
                      {{ tableHead.label }}
                    </div>
                    <div v-else>
                      {{ tableHead.label.split('-')[1] }}
                    </div>
                  </template>
                </b-table>
              </b-col>
            </b-row>
          </b-card-text>
          <b-card-text>
            <h4 class="card-title d-flex justify-content-end align-items-center">
              <b-link :to="{ name: '' }" class="btn btn-primary round ml-1">
                <feather-icon icon="PlusCircleIcon" size="16" class="align-text-top" />
                <span class="pl-75">Add analysis</span>
              </b-link>
            </h4>
          </b-card-text>
          <hr />
          <b-card-text>
            <b-row class="pb-2">
              <b-col md="12">
                <b-table responsive :items="eachCollection.analysisComments" bordered>
                </b-table>
              </b-col>
            </b-row>
          </b-card-text>
          <b-card-text>
            <h4 class="card-title d-flex justify-content-end align-items-center">
              <b-form-select v-model="selectedMatrics" :options="eachCollection.matricsList"
                style="width: fit-content" />
              <b-link :to="{ name: '' }" class="btn btn-primary round ml-1">
                <feather-icon icon="Edit2Icon" size="16" class="align-text-top" />
                <span>Chart type</span>
              </b-link>
              <b-link :to="{ name: '' }" class="btn btn-primary round ml-1">
                <feather-icon icon="SettingsIcon" size="16" class="align-text-top" />
                <span>Chart settings</span>
              </b-link>
            </h4>
          </b-card-text>
          <hr />
          <b-card-text>
            <b-row class="pb-2">
              <b-col md="12" v-for="(barChartData, index) in eachCollection.barChartData"
                :key="'bar-chart-' + eachCollection.id + '-' + index">
                <chartjs-component-bar-chart v-if="selectedMatrics == index" style="height: 400px" :data="barChartData"
                  :options="barChartOptions" :chartId="'chart-' + eachCollection.id + '-' + index" />
              </b-col>
            </b-row>
          </b-card-text>
          <!-- <b-button size="sm" variant="danger" class="float-right" @click="closeTab(eachCollection.category_name)">
            Close tab
          </b-button> -->
        </b-tab>

        <!-- New Tab Button (Using tabs-end slot) -->
        <template #tabs-end>
          <b-nav-item role="presentation" v-b-modal.modal-new-collection>
            <feather-icon icon="PlusSquareIcon" size="16" class="align-text-bottom" />
          </b-nav-item>
        </template>

        <!-- Render this if no tabs -->
        <template #empty>
          <div class="text-center text-muted">
            There are no open tabs<br>
            Open a new tab using the <b>+</b> button above.
          </div>
        </template>
      </b-tabs>
    </b-card>

    <b-modal id="modal-new-collection" ref="modal-new-collection" cancel-variant="outline-secondary" ok-title="Create"
      cancel-title="Close" centered title="Create new collection" @show="resetModal" @hidden="resetModal"
      @ok="handleCreateNewCollection">
      <b-form>
        <b-form-group :state="newCollectionState" label="Name" label-for="name-input"
          invalid-feedback="Name is required">
          <b-form-input id="name-input" v-model="newCollection" :state="newCollectionState" required />
        </b-form-group>
      </b-form>
    </b-modal>
  </div>
</template>

<script>
import store from '@/store'
import { $themeColors } from '@themeConfig'
const chartColors = {
  primaryColorShade: '#836AF9',
  yellowColor: '#ffe800',
  successColorShade: '#28dac6',
  warningColorShade: '#ffe802',
  warningLightColor: '#FDAC34',
  infoColorShade: '#299AFF',
  greyColor: '#4F5D70',
  blueColor: '#2c9aff',
  blueLightColor: '#84D0FF',
  greyLightColor: '#EDF1F4',
  tooltipShadow: 'rgba(0, 0, 0, 0.25)',
  lineChartPrimary: '#666ee8',
  lineChartDanger: '#ff4961',
  labelColor: '#6e6b7b',
  grid_line_color: 'rgba(200, 200, 200, 0.2)',
}
import {
  ref, watch, computed, onUnmounted,
} from '@vue/composition-api'
import ChartjsComponentBarChart from '../components/chartjs/ChartjsComponentBarChart.vue'
import { BCard, BCardText, BTabs, BButton, BImg, BTab, BNavItem, BModal, BForm, BFormGroup, BFormInput, VBModal, BTable, BLink, BRow, BCol, BFormSelect } from 'bootstrap-vue'
import companyStoreModule from './companyStoreModule'

export default {
  components: {
    BCard,
    BCardText,
    BTabs,
    BButton,
    BTab,
    BNavItem,
    BModal,
    BForm,
    BFormGroup,
    BFormInput,
    BTable,
    BLink,
    BRow,
    BCol,
    BFormSelect,
    BImg,
    ChartjsComponentBarChart,
    VBModal
  },
  directives: {
    'b-modal': VBModal,
  },
  data() {
    return {
      tabs: [],
      tabCounter: 0,
      newCollectionState: null,
      newCollection: ''
    }
  },
  computed: {
    imgUrl() {
      return require('@/assets/images/icons/xlsx.svg')
    }
  },
  methods: {
    // closeTab(x) {
    //   for (let i = 0; i < this.tabs.length; i++) {
    //     if (this.tabs[i] === x) {
    //       this.tabs.splice(i, 1)
    //     }
    //   }
    // },
    resetModal() {
      this.newCollection = ''
      this.newCollectionState = null
    },
    handleCreateNewCollection() {
      this.$http.post('/api/asset/' + this.selectedAsset.id + '/matrics/category', { name: this.newCollection })
        .then(res => {
          this.$refs['modal-new-collection'].hide()
          this.fetchDataCollection()
        })
    }
  },
  setup() {
    console.log('-------------')
    const COMPANY_FIELD_STORE_MODULE_NAME = 'company-field'

    // Register module
    if (!store.hasModule(COMPANY_FIELD_STORE_MODULE_NAME)) store.registerModule(COMPANY_FIELD_STORE_MODULE_NAME, companyStoreModule)

    // UnRegister on leave
    onUnmounted(() => {
      if (store.hasModule(COMPANY_FIELD_STORE_MODULE_NAME)) store.unregisterModule(COMPANY_FIELD_STORE_MODULE_NAME)
    })

    const selectedAsset = computed(() => store.state.app.selectedPortfolio)

    const collectionData = ref([])
    const selectedMatrics = ref('')
    const barChartOptions = ref({
      elements: {
        rectangle: {
          borderWidth: 2,
          borderSkipped: 'bottom',
        },
      },
      responsive: true,
      maintainAspectRatio: false,
      responsiveAnimationDuration: 500,
      legend: {
        display: false,
      },
      tooltips: {
        // Updated default tooltip UI
        shadowOffsetX: 1,
        shadowOffsetY: 1,
        shadowBlur: 8,
        shadowColor: chartColors.tooltipShadow,
        backgroundColor: $themeColors.light,
        titleFontColor: $themeColors.dark,
        bodyFontColor: $themeColors.dark,
      },
      scales: {
        xAxes: [
          {
            display: true,
            gridLines: {
              display: true,
              color: chartColors.grid_line_color,
              zeroLineColor: chartColors.grid_line_color,
            },
            scaleLabel: {
              display: false,
            },
            ticks: {
              fontColor: chartColors.labelColor,
            },
          },
        ],
        yAxes: [
          {
            display: true,
            gridLines: {
              color: chartColors.grid_line_color,
              zeroLineColor: chartColors.grid_line_color,
            },
            ticks: {
              // stepSize: 100,
              // min: 0,
              // max: 400,
              fontColor: chartColors.labelColor,
            },
          },
        ],
      },
    })
    // data: {
    //   labels: ['7/12', '8/12', '9/12', '10/12', '11/12', '12/12', '13/12', '14/12', '15/12', '16/12', '17/12'],
    //     datasets: [
    //       {
    //         data: [275, 90, 190, 205, 125, 85, 55, 87, 127, 150, 230, 280, 190],
    //         backgroundColor: chartColors.successColorShade,
    //         borderColor: 'transparent',
    //       },
    //     ],
    //     },
    const fetchDataCollection = () => {
      if (!selectedAsset.value) return
      store.dispatch('company-field/fetchDataCollection', {
        id: selectedAsset.value.id
      })
        .then(response => {
          if (response.data) {
            collectionData.value = response.data.map(each => {
              let eachCollection = each
              eachCollection.barChartData = []
              eachCollection.matricsList = []
              eachCollection.companyMatrics = eachCollection.company_matrics.map(eachMatrics => {
                eachCollection.matricsList.push({
                  value: eachCollection.matricsList.length,
                  text: eachMatrics.matrics_resource.name
                })
                selectedMatrics.value = '0'
                let customMatrics = eachMatrics
                customMatrics.dataByYear = {}
                customMatrics.datas.map(eachData => {
                  const dataYear = eachData.set_date.split('-')[0]
                  customMatrics.dataByYear['year-' + dataYear] = customMatrics.dataByYear['year-' + dataYear] ? customMatrics.dataByYear['year-' + dataYear] : 0
                  customMatrics.dataByYear['year-' + dataYear] += eachData.value
                })

                let labels = []
                let datas = []
                for (const [key, value] of Object.entries(customMatrics.dataByYear)) {
                  labels.push(key)
                  datas.push(value)
                }

                eachCollection.barChartData.push({
                  labels: labels,
                  datasets: [
                    {
                      data: datas,
                      backgroundColor: chartColors.successColorShade,
                      borderColor: 'transparent'
                    }
                  ]
                })

                return {
                  Matrics: customMatrics.matrics_resource.name,
                  ...customMatrics.dataByYear
                }
              })

              eachCollection.analysisComments = eachCollection.comments.map(eachComment => {
                return {
                  'Comment': eachComment.content,
                  'Last updated': eachComment.created_at,
                  'User': eachComment.user.email,
                  'Period': eachComment.period
                }
              })
              return eachCollection
            })
            console.log(collectionData)
          }
        })
    }
    watch([selectedAsset], () => {
      if (selectedAsset) {
        fetchDataCollection()
      }
    }, {
      deep: true,
    })
    fetchDataCollection()

    return {
      selectedAsset,
      collectionData,
      selectedMatrics,
      fetchDataCollection,
      barChartOptions
    }
  },
}
</script>

<style>

</style>
