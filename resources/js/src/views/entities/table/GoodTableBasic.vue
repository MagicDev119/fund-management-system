<template>
  <b-card-code title="List" class="position-relative">
    <!-- Add Button -->
    <div class="custom-search d-flex position-absolute position-top-0 position-right-0 mr-2 mt-1">
      <b-link :to="{name:'fund-create'}" class="btn btn-primary">
        Add
      </b-link>

      <b-link class="ml-1 btn btn-primary py-0 d-flex align-items-center" :to="{name:'fund-inputsetting'}">
        <feather-icon icon="SettingsIcon" class="" size="21" />
      </b-link>
    </div>

    <!-- search input -->
    <div class="custom-search d-flex justify-content-end">
      <b-form-group>
        <div class="d-flex align-items-center">
          <label class="mr-1">Search</label>
          <b-form-input v-model="searchTerm" placeholder="Search" type="text" class="d-inline-block" />
        </div>
      </b-form-group>
    </div>

    <!-- table -->
    <vue-good-table :columns="columns" :rows="rows" :rtl="direction" :search-options="{
    enabled: true,
    externalQuery: searchTerm }" :select-options="{
      enabled: true,
      selectOnCheckboxOnly: true, // only select when checkbox is clicked instead of the row
      selectionInfoClass: 'custom-class',
      selectionText: 'rows selected',
      clearSelectionText: 'clear',
      disableSelectInfo: true, // disable the select info panel on top
      selectAllByGroup: true, // when used in combination with a grouped table, add a checkbox in the header row to check/uncheck the entire group
    }" :pagination-options="{
      enabled: true,
      perPage:pageLength
    }">
      <template slot="table-row" slot-scope="props">

        <!-- Column: Action -->
        <span v-if="props.column.field === 'action'">
          <span>
            <b-dropdown variant="link" toggle-class="text-decoration-none" no-caret>
              <template v-slot:button-content>
                <feather-icon icon="MoreVerticalIcon" size="16" class="text-body align-middle mr-25" />
              </template>
              <b-dropdown-item>
                <feather-icon icon="Edit2Icon" class="mr-50" />
                <span>Edit</span>
              </b-dropdown-item>
              <b-dropdown-item>
                <feather-icon icon="TrashIcon" class="mr-50" />
                <span>Delete</span>
              </b-dropdown-item>
            </b-dropdown>
          </span>
        </span>

        <!-- Column: Common -->
        <span v-else>
          {{ props.formattedRow[props.column.field] }}
        </span>
      </template>

      <!-- pagination -->
      <template slot="pagination-bottom" slot-scope="props">
        <div class="d-flex justify-content-between flex-wrap">
          <div class="d-flex align-items-center mb-0 mt-1">
            <span class="text-nowrap ">
              Showing 1 to
            </span>
            <b-form-select v-model="pageLength" :options="['3','5','10']" class="mx-1"
              @input="(value)=>props.perPageChanged({currentPerPage:value})" />
            <span class="text-nowrap"> of {{ props.total }} entries </span>
          </div>
          <div>
            <b-pagination :value="1" :total-rows="props.total" :per-page="pageLength" first-number last-number
              align="right" prev-class="prev-item" next-class="next-item" class="mt-1 mb-0"
              @input="(value)=>props.pageChanged({currentPage:value})">
              <template #prev-text>
                <feather-icon icon="ChevronLeftIcon" size="18" />
              </template>
              <template #next-text>
                <feather-icon icon="ChevronRightIcon" size="18" />
              </template>
            </b-pagination>
          </div>
        </div>
      </template>
    </vue-good-table>

  </b-card-code>
</template>

<script>
import BCardCode from '@core/components/b-card-code/BCardCode.vue'
import {
  BAvatar, BBadge, BPagination, BFormGroup, BFormInput, BFormSelect, BDropdown, BDropdownItem, BButton, BLink
} from 'bootstrap-vue'
import { VueGoodTable } from 'vue-good-table'
import store from '@/store/index'

export default {
  components: {
    BCardCode,
    VueGoodTable,
    BAvatar,
    BBadge,
    BPagination,
    BFormGroup,
    BFormInput,
    BFormSelect,
    BDropdown,
    BDropdownItem,
    BButton,
    BLink
  },
  data() {
    return {
      pageLength: 3,
      dir: false,
      columns: [
        {
          label: 'Vehicle Name',
          field: 'name',
        },
        {
          label: 'Currency',
          field: 'currency',
        },
        {
          label: 'Vehicle Type',
          field: 'type',
        },
        {
          label: 'Legal Name',
          field: 'legal_name',
        },
        {
          label: 'Created_at',
          field: 'created_at',
        },
        {
          label: 'Action',
          field: 'action',
        },
      ],
      rows: [],
      searchTerm: '',
      status: [{
        1: 'Current',
        2: 'Professional',
        3: 'Rejected',
        4: 'Resigned',
        5: 'Applied',
      },
      {
        1: 'light-primary',
        2: 'light-success',
        3: 'light-danger',
        4: 'light-warning',
        5: 'light-info',
      }],
    }
  },
  computed: {
    statusVariant() {
      const statusColor = {
        /* eslint-disable key-spacing */
        Current: 'light-primary',
        Professional: 'light-success',
        Rejected: 'light-danger',
        Resigned: 'light-warning',
        Applied: 'light-info',
        /* eslint-enable key-spacing */
      }

      return status => statusColor[status]
    },
    direction() {
      if (store.state.appConfig.isRTL) {
        // eslint-disable-next-line vue/no-side-effects-in-computed-properties
        this.dir = true
        return this.dir
      }
      // eslint-disable-next-line vue/no-side-effects-in-computed-properties
      this.dir = false
      return this.dir
    },
  },
  created() {
    this.$http.get('/api/fund')
      .then(res => {
        this.rows = res.data.map(each => {
          each.type = each.fund_type.type

          const date = new Date(each.created_at);

          const year = date.toLocaleString("default", { year: "numeric" });
          const month = date.toLocaleString("default", { month: "2-digit" });
          const day = date.toLocaleString("default", { day: "2-digit" });

          var formattedDate = year + "-" + month + "-" + day;

          each.created_at = formattedDate
          return each
        })
      })
  },
}
</script>
