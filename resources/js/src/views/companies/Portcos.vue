<template>
  <div>
    <div class="content-header">

      <!-- Content Left -->
      <div class="content-header-left mb-2" cols="12" md="9">
        <div class="breadcrumbs-top">
          <div cols="12">
            <h2 class="content-header-title float-left pr-1 mb-0">
              {{ pageTitle }}
            </h2>
            <div class="breadcrumb-wrapper">
              <b-breadcrumb>
                <b-breadcrumb-item to="/dashboard/fund">
                  <feather-icon icon="HomeIcon" size="16" class="align-text-top" />
                </b-breadcrumb-item>
                <b-breadcrumb-item v-for="item in breadcrumb" :key="item.text" :active="item.active" :to="item.to">
                  {{ item.text }}
                </b-breadcrumb-item>
              </b-breadcrumb>
            </div>
          </div>
        </div>
      </div>
    </div>
    <b-card v-if="selectedAsset">
      <b-tabs>
        <b-tab active title="Overview">
          <b-card-text>
            <h4 class="card-title pt-1 d-flex justify-content-between align-items-center">
              <span>About</span>
              <b-link variant="flat-dark" class="btn-icon" :to="{ name: 'asset-edit' }">
                <feather-icon icon="Edit2Icon" class="" size="21" />
              </b-link>
            </h4>
          </b-card-text>
          <hr />
          <b-card-text>
            <h5 class="px-1">Description:</h5>
          </b-card-text>
          <b-card-text class="bg-light-secondary p-2 rounded">
            <b-row class="pb-2">
              <b-col md="12">
                <b-alert variant="primary" show>
                  <div class="alert-body">
                    <span>
                      <feather-icon icon="TrelloIcon" size="18" class="mr-25" /> <span>Asset information</span>
                    </span>
                  </div>
                </b-alert>
                <b-row class="px-2">
                  <b-col md="6">
                    <b-row>
                      <b-col md="5">
                        <span class="d-flex align-items-center">
                          <span class="pr-50">Name </span>
                          <feather-icon icon="InfoIcon" size="16" class="align-text-top" />
                        </span>
                      </b-col>
                      <b-col md="7">{{ selectedAsset.name }}</b-col>
                    </b-row>
                  </b-col>
                  <b-col md="6">
                    <b-row>
                      <b-col md="5">
                        <span class="d-flex align-items-center">
                          <span class="pr-50">Legal name </span>
                          <feather-icon icon="InfoIcon" size="16" class="align-text-top" />
                        </span>
                      </b-col>
                      <b-col md="7">{{ selectedAsset.legal_name }}</b-col>
                    </b-row>
                  </b-col>
                </b-row>
              </b-col>
            </b-row>
            <b-row v-if="selectedAsset.asset_field_groups">
              <b-col md="12" v-for="asset_field_group in selectedAsset.asset_field_groups" :key="asset_field_group.id">
                <b-alert variant="primary" show>
                  <div class="alert-body">
                    <span>
                      <feather-icon icon="TrelloIcon" size="18" class="mr-25" /> <span>{{ asset_field_group.group_name
                      }}</span>
                    </span>
                  </div>
                </b-alert>
                <b-row class="px-2">
                  <b-col class="" md="6" v-for="asset_field in asset_field_group.asset_fields" :key="asset_field.id">
                    <b-row>
                      <b-col md="5">
                        <span class="d-flex align-items-center">
                          <span class="pr-50">{{ asset_field.name }} </span>
                          <feather-icon icon="InfoIcon" size="16" class="align-text-top" />
                        </span>
                      </b-col>
                      <b-col md="7">{{ asset_field.asset_data.value }}</b-col>
                    </b-row>
                    <hr />
                  </b-col>
                </b-row>
              </b-col>
            </b-row>
          </b-card-text>
        </b-tab>
        <b-tab title="Deal cash flow">
          <b-card-text>
            <h4 class="card-title pt-1 d-flex justify-content-between align-items-center">
              <span>Deal cash flow</span>
              <b-link :to="{ name: '' }" class="btn btn-primary">
                Export
              </b-link>
            </h4>
          </b-card-text>
          <hr />
          <b-card-text>
            <b-row class="pb-2">
              <b-col md="12">
                <b-table responsive :items="cashFlowData" bordered>
                </b-table>
              </b-col>
            </b-row>
          </b-card-text>
        </b-tab>
        <b-tab title="Cap table">
          <b-card-text>
            <h4 class="card-title pt-1 d-flex justify-content-end align-items-center">
              <b-link :to="{ name: '' }" class="btn btn-primary">
                Export
              </b-link>
              <b-link :to="{ name: '' }" class="btn btn-primary round ml-1">
                <feather-icon icon="PlusCircleIcon" size="16" class="align-text-top" />
                <span>Add</span>
              </b-link>
            </h4>
          </b-card-text>
          <hr />
          <b-card-text>
            <b-row class="pb-2">
              <b-col md="12">
                <b-table responsive :items="cashFlowData" bordered>
                  <template #head(IssuedOwnership)>
                    <span>
                      Issued ownership (%)
                      <feather-icon icon="InfoIcon" size="18" class="mr-25" />
                    </span>
                  </template>
                </b-table>
              </b-col>
            </b-row>
          </b-card-text>
        </b-tab>
      </b-tabs>
    </b-card>
  </div>
</template>

<script>
import store from '@/store'
import {
  ref, watch, computed, onUnmounted,
} from '@vue/composition-api'
import { BTabs, BCardText, BTab, BBreadcrumb, BBreadcrumbItem, BRow, BCol, BAlert, BTable, BButton, BCard, BLink } from 'bootstrap-vue'
import companyStoreModule from './companyStoreModule'

export default {
  components: {
    BCard,
    BBreadcrumb,
    BBreadcrumbItem,
    BTabs,
    BCardText,
    BCol,
    BRow,
    BAlert,
    BLink,
    BTable,
    BTab
  },
  data: () => ({
    pageTitle: 'Portfolio',
    breadcrumb: [
      {
        text: 'companies',
      },
      {
        text: 'Portfolio',
        active: true,
      },
    ],
    cashFlowData: [
      {
        Name: 'Collapse',
        Instruments: 'ChevronDownIcon',
        'Issued # of shares': 'Collapse card content using collapse action.',
        'IssuedOwnership': 'ChevronDownIcon',
        'Fully diluted # of shares': 'Collapse',
        'Fully diluted ownership (%)': 'Collapse card content using collapse action.',
        'Capital contribution': 'Collapse card content using collapse action.'
      },
    ],
  }),
  setup() {
    const COMPANY_FIELD_STORE_MODULE_NAME = 'company-field'

    // Register module
    if (!store.hasModule(COMPANY_FIELD_STORE_MODULE_NAME)) store.registerModule(COMPANY_FIELD_STORE_MODULE_NAME, companyStoreModule)

    // UnRegister on leave
    onUnmounted(() => {
      if (store.hasModule(COMPANY_FIELD_STORE_MODULE_NAME)) store.unregisterModule(COMPANY_FIELD_STORE_MODULE_NAME)
    })

    const selectedAsset = computed(() => store.state.app.selectedPortfolio)

    watch([selectedAsset], () => {
      console.log(selectedAsset.value.asset_field_groups)
    }, {
      deep: true,
    })
    return {
      selectedAsset
    }
  },
}
</script>

<style>

</style>
