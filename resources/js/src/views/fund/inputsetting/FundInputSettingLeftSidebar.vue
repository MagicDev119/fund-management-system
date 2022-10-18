<template>
  <div class="sidebar-left">
    <div class="sidebar">
      <div class="sidebar-content todo-sidebar">
        <div class="todo-app-menu">
          <!-- <div class="add-task">
            <b-button v-ripple.400="'rgba(255, 255, 255, 0.15)'" variant="primary" block
              @click="$emit('update:is-task-handler-sidebar-active', true); $emit('close-left-sidebar')">
              Add Task
            </b-button>
          </div> -->
          <vue-perfect-scrollbar :settings="perfectScrollbarSettings" class="sidebar-menu-list scroll-area">
            <!-- <b-list-group class="list-group-filters">
              <b-list-group-item v-for="filter in taskFilters" :key="filter.title + $route.path" :to="filter.route"
                :active="isDynamicRouteActive(filter.route)" @click="$emit('close-left-sidebar')">
                <feather-icon :icon="filter.icon" size="18" class="mr-75" />
                <span class="align-text-bottom line-height-1">{{ filter.title }}</span>
              </b-list-group-item>
            </b-list-group> -->

            <!-- Tags -->
            <div class="border-bottom mt-2 px-2 d-flex justify-content-between">
              <h5 class="mb-1">
                Field groups
              </h5>
              <b-link class="d-flex align-items-center mb-1 cursor-pointer" v-b-modal.modal-new-group>
                <span class="p-25 text-white line-height-1 text-center rounded-pill bg-primary cart-item-count mr-50">
                  <feather-icon icon="PlusIcon" role="button" size="15" stroke-width="3" />
                </span>
                <span class="text-primary">New group</span>
              </b-link>
            </div>

            <b-list-group class="mt-1 list-group-labels">
              <b-list-group-item class="d-flex align-items-center" v-for="group in groupList"
                :key="group.slug + $route.path" :to="group.route" :active="isDynamicRouteActive(group.route)"
                @click="$emit('close-left-sidebar')">
                <feather-icon icon="MenuIcon" size="18" class="mr-75 text-secondary" />
                <span class="d-flex flex-column">
                  <span class="d-flex align-items-center">
                    <feather-icon icon="ApertureIcon" size="18" class="mr-25" />
                    {{ group.name }}
                  </span>
                  <span class="text-secondary">
                    <small>There are {{ group.fieldCnt }} fields.</small>
                  </span>
                </span>
              </b-list-group-item>
            </b-list-group>

          </vue-perfect-scrollbar>
        </div>
      </div>
    </div>

    <!-- modal new group-->
    <b-modal id="modal-new-group" ref="modal-new-group" cancel-variant="outline-secondary" ok-title="Create"
      cancel-title="Close" centered title="Create new group" @show="resetModal" @hidden="resetModal"
      @ok="handleCreateNewGroup">
      <b-form>
        <b-form-group :state="nameState" label="Name" label-for="name-input" invalid-feedback="Name is required">
          <b-form-input id="name-input" v-model="name" :state="nameState" required />
        </b-form-group>
      </b-form>
    </b-modal>
  </div>
</template>

<script>
import VuePerfectScrollbar from 'vue-perfect-scrollbar'
import { BButton, BListGroup, BListGroupItem, BLink, BModal, BForm, BFormGroup, BFormInput, VBModal } from 'bootstrap-vue'
import { isDynamicRouteActive } from '@core/utils/utils'
import Ripple from 'vue-ripple-directive'
import {
  ref, computed
} from '@vue/composition-api'

export default {
  directives: {
    Ripple,
  },
  components: {
    BButton,
    BListGroup,
    BListGroupItem,
    BLink,
    BModal,
    BForm,
    BFormGroup,
    BFormInput,
    VBModal,
    VuePerfectScrollbar,
  },
  props: {
    fieldGroups: {
      type: Array,
      required: true,
    },
  },
  directives: {
    'b-modal': VBModal,
  },
  data() {
    return {
      name: '',
      nameState: null
    }
  },
  methods: {
    resetModal() {
      this.name = ''
      this.nameState = null
    },
    handleCreateNewGroup() {
      this.$http.post('/api/fund/field/group', { name: this.name })
        .then(res => {
          if (res.data && res.data.id) {
            this.groupList.push({
              name: res.data.group_name,
              slug: res.data.slug,
              id: res.data.id,
              fieldCnt: 0,
              route: { name: 'fund-inputsetting-group', params: { group_slug: res.data.slug } }
            })
          }
          this.$refs['modal-new-group'].hide()
        })
    }
  },
  setup(props) {

    const groupList = ref(computed(() => props.fieldGroups))

    const perfectScrollbarSettings = {
      maxScrollbarLength: 60,
    }

    return {
      perfectScrollbarSettings,
      isDynamicRouteActive,
      groupList
    }
  },
}
</script>

<style>

</style>
