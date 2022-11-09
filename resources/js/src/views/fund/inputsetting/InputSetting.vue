<template>
  <!-- Need to add height inherit because Vue 2 don't support multiple root ele -->
  <div style="height: inherit">
    <!-- <div class="body-content-overlay" :class="{'show': true}" /> -->
    <div class="mt-25 ml-2 d-flex justify-content-between">
      <span>
        <feather-icon icon="MenuIcon" size="18" class="mr-25" />
        <span>{{ selectedGroup }}</span>
      </span>
      <b-link v-b-modal.modal-new-field class="d-flex align-items-center mb-1 cursor-pointer">
        <span class="p-25 text-white line-height-1 text-center rounded-pill bg-primary cart-item-count mr-50">
          <feather-icon icon="PlusIcon" role="button" size="15" stroke-width="3" />
        </span>
        <span class="text-primary">New field</span>
      </b-link>
    </div>
    <div class="todo-app-list mt-1 ml-2">

      <!-- Todo List -->
      <vue-perfect-scrollbar :settings="perfectScrollbarSettings" class="todo-task-list-wrapper list-group scroll-area">
        <draggable v-model="fundFields" handle=".draggable-task-handle" tag="ul" class="todo-task-list media-list">
          <li v-for="fundField in fundFields" :key="fundField.id" class="todo-item px-1"
            :class="{ 'completed': fundField.isVisible }">
            <div class="todo-title-wrapper">
              <div class="todo-title-area">
                <div class="title-wrapper">
                  <feather-icon icon="ListIcon" class="d-inline" size="17" />
                  <span class="todo-title text-dark">{{ fundField.name }}</span>
                </div>
              </div>
              <div class="todo-item-action">
                <span class="font-italic text-secondary">{{ fundField.field_type.name }}</span>
                <div class="content-header-title pr-0 mx-1">&nbsp;</div>
                <b-button v-if="fundField.isRequired" variant="outline-primary p-75 mr-1"
                  @click="updateFundField({ id: fundField.id, isRequired: !fundField.isRequired })">
                  <small class="font-weight-bolder">Required</small>
                </b-button>
                <b-button v-if="!fundField.isRequired" variant="outline-secondary p-75 mr-1" class="light-grey-button"
                  @click="updateFundField({ id: fundField.id, isRequired: !fundField.isRequired })">
                  <small>Required</small>
                </b-button>
                <div>
                  <b-form-checkbox v-model="fundField.isVisible" class="custom-control-primary" name="check-button"
                    switch @change="updateFundField({ id: fundField.id, isVisible: $event })">
                    <span class="switch-icon-left">
                      <feather-icon icon="CheckIcon" />
                    </span>
                    <span class="switch-icon-right">
                      <feather-icon icon="XIcon" />
                    </span>
                  </b-form-checkbox>
                </div>
                <div class="content-header-title pr-0">&nbsp;</div>
                <b-button variant="flat-dark" class="btn-icon" @click="removeFundField(fundField.id)">
                  <feather-icon icon="Trash2Icon" size="17" />
                </b-button>
              </div>
            </div>

          </li>
        </draggable>
        <div class="no-results" :class="{ 'show': !fundFields.length }">
          <h5>No Items Found</h5>
        </div>
      </vue-perfect-scrollbar>
    </div>

    <!-- Sidebar -->
    <portal to="content-renderer-sidebar-left">
      <fund-input-setting-left-sidebar :field-groups="fieldGroups"
        :is-fund-field-handler-sidebar-active.sync="isFundFieldHandlerSidebarActive" :class="{ 'show': true }" />
    </portal>

    <!-- modal new field-->
    <b-modal id="modal-new-field" ref="modal-new-field" cancel-variant="outline-secondary" ok-title="Create"
      cancel-title="Close" centered title="Create new field" @show="resetModal" @hidden="resetModal" @ok="addFundField">
      <b-form>
        <b-form-group :state="nameState" label="Name" label-for="name-input" invalid-feedback="Name is required">
          <b-form-input id="name-input" v-model="name" @change="changeFieldName($event)" :state="nameState" required />
        </b-form-group>
        <b-form-group :state="typeState" label="Type" label-for="type-input" invalid-feedback="Type is required">
          <b-form-select v-model="selectedFieldType" @change="changeFieldType($event)" :options="fieldType"
            :state="typeState" />
        </b-form-group>
      </b-form>
    </b-modal>
  </div>
</template>

<script>
import store from '@/store'
import {
  ref, watch, computed, onUnmounted,
} from '@vue/composition-api'
import {
  BLink, BButton, BFormCheckbox, BModal, BForm, BFormGroup, BFormInput, VBModal, BFormSelect
} from 'bootstrap-vue'
import { useRouter } from '@core/utils/utils'
import VuePerfectScrollbar from 'vue-perfect-scrollbar'
import draggable from 'vuedraggable'
import FundInputSettingLeftSidebar from './FundInputSettingLeftSidebar.vue'
import fundStoreModule from './fundStoreModule'

export default {
  components: {
    draggable,
    BLink,
    BButton,
    BFormCheckbox,
    BModal,
    BForm,
    BFormGroup,
    BFormSelect,
    BFormInput,
    VBModal,
    VuePerfectScrollbar,

    // App SFC
    FundInputSettingLeftSidebar,
  },
  directives: {
    'b-modal': VBModal,
  },
  data() {
    return {
      name: '',
      nameState: null,
      typeState: null,
      selectedFieldType: null
    }
  },
  methods: {
    // checkFormValidity() {
    //   const valid = this.$refs.form.checkValidity()
    //   this.nameState = valid
    //   this.typeState = valid
    //   return valid
    // },
    resetModal() {
      this.name = ''
      this.nameState = null
      this.typeState = null
      this.selectedFieldType = null
    },
    handleCreateNewField(bvModalEvt) {
      // Prevent modal from closing
      bvModalEvt.preventDefault()
      // Trigger submit handler
      this.handleSubmit()
    },
    handleSubmit() {

      // this.submittedNames.push(this.name)

    },
    handleCreateNewGroup(bvModalEvt) {
      // Prevent modal from closing
      bvModalEvt.preventDefault()
      // Trigger submit handler
      this.handleSubmit()
    },
    handleGroupSubmit() {

      // this.submittedNames.push(this.name)

    },
  },
  setup() {
    const FUND_FIELD_STORE_MODULE_NAME = 'fund-field'

    // Register module
    if (!store.hasModule(FUND_FIELD_STORE_MODULE_NAME)) store.registerModule(FUND_FIELD_STORE_MODULE_NAME, fundStoreModule)

    // UnRegister on leave
    onUnmounted(() => {
      if (store.hasModule(FUND_FIELD_STORE_MODULE_NAME)) store.unregisterModule(FUND_FIELD_STORE_MODULE_NAME)
    })

    const { route } = useRouter()
    const routeParams = computed(() => route.value.params)
    const selectedGroup = ref('')
    watch(routeParams, () => {

      const selected = fieldGroups.value.filter(each => each.slug == routeParams.value.group_slug)
      if (selected.length !== 0) {
        selectedGroup.value = selected[0].name
        fetchFundFields(selected[0].id)
      }
    })

    const fundFields = ref([])
    const fieldType = ref([])
    const newFieldName = ref('')
    const newFieldType = ref('')

    const changeFieldType = (e) => {
      newFieldType.value = e
    }

    const changeFieldName = (e) => {
      newFieldName.value = e
    }

    const addFundField = () => {
      if (fieldGroups.value.length == 0) return
      let selected = fieldGroups.value.filter(each => each.slug == routeParams.value.group_slug)
      selected = (selected.length !== 0) ? selected : [fieldGroups.value[0]]

      store.dispatch('fund-field/addFundField', {
        id: selected[0].id,
        name: newFieldName.value,
        type: newFieldType.value
      })
        .then(() => {
          fetchFundFields(selected[0].id)
        })
    }
    const removeFundField = (id) => {
      let selected = fieldGroups.value.filter(each => each.slug == routeParams.value.group_slug)
      selected = (selected.length !== 0) ? selected : [fieldGroups.value[0]]

      store.dispatch('fund-field/removeFundField', { id })
        .then(() => {
          // eslint-disable-next-line no-use-before-define
          fetchFundFields(selected[0].id)
        })
    }
    const updateFundField = fundFieldData => {
      let selected = fieldGroups.value.filter(each => each.slug == routeParams.value.group_slug)
      selected = (selected.length !== 0) ? selected : [fieldGroups.value[0]]
      console.log(fundFieldData.isRequired)
      console.log(fundFieldData.isVisible)
      store.dispatch('fund-field/updateFundField', fundFieldData)
        .then(() => {
          // eslint-disable-next-line no-use-before-define
          fetchFundFields(selected[0].id)
        })
    }

    const perfectScrollbarSettings = {
      maxScrollbarLength: 150,
    }

    const isFundFieldHandlerSidebarActive = ref(false)

    const fieldGroups = ref([
    ])

    const fetchFundFields = (id) => {
      store.dispatch('fund-field/fetchFundFields', {
        id
      })
        .then(response => {
          if (response.data)
            fundFields.value = response.data.map(each => {
              return { ...each, isVisible: each.isVisible ? true : false }
            })
        })
    }

    const fetchFundFieldGroups = () => {
      store.dispatch('fund-field/fetchFundFieldGroups', {
      })
        .then(response => {
          if (response.data) {
            fieldGroups.value = response.data.fieldGroups.map(each => {
              return {
                name: each.group_name,
                slug: each.slug,
                fieldCnt: each.fieldCnt,
                id: each.id,
                route: { name: 'fund-inputsetting-group', params: { group_slug: each.slug } }
              }
            });
            console.log(fieldGroups.value[0])
            fieldType.value = response.data.fieldType.map(each => {
              return {
                value: each.id,
                text: each.cate_name ? each.name + ' / ' + each.cate_name : each.name
              }
            })
            const selected = fieldGroups.value.filter(each => each.slug == routeParams.value.group_slug)
            selectedGroup.value = selected.length === 0 ? fieldGroups.value[0].name : selected[0].name
            fetchFundFields(selected.length === 0 ? fieldGroups.value[0].id : selected[0].id);
          }
        })
    }

    fetchFundFieldGroups()

    return {
      fundFields,
      removeFundField,
      addFundField,
      updateFundField,
      fieldGroups,
      fieldType,
      fetchFundFields,
      perfectScrollbarSettings,
      fetchFundFieldGroups,
      changeFieldName,
      changeFieldType,
      selectedGroup,
      isFundFieldHandlerSidebarActive,
    }
  },
}
</script>

<style lang="scss" scoped>
.draggable-task-handle {
  position: absolute;
  left: 8px;
  top: 50%;
  transform: translateY(-50%);
  visibility: hidden;
  cursor: move;

  .todo-task-list .todo-item:hover & {
    visibility: visible;
  }
}
</style>

<style lang="scss">
@import "~@core/scss/base/pages/app-todo.scss";
</style>
