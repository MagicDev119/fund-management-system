<template>
  <!-- Need to add height inherit because Vue 2 don't support multiple root ele -->
  <div style="height: inherit">
    <!-- <div class="body-content-overlay" :class="{'show': true}" /> -->
    <div class="mt-25 ml-2 d-flex justify-content-between">
      <span>
        <feather-icon icon="MenuIcon" size="18" class="mr-25" />
        <span>aaa</span>
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
        <draggable v-model="tasks" handle=".draggable-task-handle" tag="ul" class="todo-task-list media-list">
          <li v-for="task in tasks" :key="task.id" class="todo-item px-1" :class="{ 'completed': task.isCompleted }">
            <div class="todo-title-wrapper">
              <div class="todo-title-area">
                <div class="title-wrapper">
                  <feather-icon icon="ListIcon" class="d-inline" size="17" />
                  <span class="todo-title text-dark">{{ task.title }}</span>
                </div>
              </div>
              <div class="todo-item-action">
                <span class="font-italic text-secondary">{{ task.title }}</span>
                <div class="content-header-title pr-0 mx-1">&nbsp;</div>
                <b-button variant="outline-primary p-75 mr-1">
                  <small>Required</small>
                </b-button>
                <div>
                  <b-form-checkbox checked="true" class="custom-control-primary" name="check-button" switch>
                    <span class="switch-icon-left">
                      <feather-icon icon="CheckIcon" />
                    </span>
                    <span class="switch-icon-right">
                      <feather-icon icon="XIcon" />
                    </span>
                  </b-form-checkbox>
                </div>
                <div class="content-header-title pr-0">&nbsp;</div>
                <b-button variant="flat-dark" class="btn-icon">
                  <feather-icon icon="Trash2Icon" size="17" />
                </b-button>
              </div>
            </div>

          </li>
        </draggable>
        <div class="no-results" :class="{'show': !tasks.length}">
          <h5>No Items Found</h5>
        </div>
      </vue-perfect-scrollbar>
    </div>

    <!-- Sidebar -->
    <portal to="content-renderer-sidebar-left">
      <todo-left-sidebar :task-tags="taskTags" :is-task-handler-sidebar-active.sync="isTaskHandlerSidebarActive"
        :class="{'show': true}" />
    </portal>

    <!-- modal new field-->
    <b-modal id="modal-new-field" cancel-variant="outline-secondary" ok-title="Create" cancel-title="Close" centered
      title="Create new field" @show="resetModal" @hidden="resetModal" @ok="handleCreateNewField">
      <b-form>
        <b-form-group :state="nameState" label="Name" label-for="name-input" invalid-feedback="Name is required">
          <b-form-input id="name-input" v-model="name" :state="nameState" required />
        </b-form-group>
        <b-form-group :state="typeState" label="Type" label-for="type-input" invalid-feedback="Type is required">
          <b-form-input id="type-input" v-model="type" :state="typeState" required />
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
  BLink, BButton, BFormCheckbox, BModal, BForm, BFormGroup, BFormInput, VBModal
} from 'bootstrap-vue'
import VuePerfectScrollbar from 'vue-perfect-scrollbar'
import draggable from 'vuedraggable'
import TodoLeftSidebar from './TodoLeftSidebar.vue'
import todoStoreModule from './fundStoreModule'

export default {
  components: {
    draggable,
    BLink,
    BButton,
    BFormCheckbox,
    BModal,
    BForm,
    BFormGroup,
    BFormInput,
    VBModal,
    VuePerfectScrollbar,

    // App SFC
    TodoLeftSidebar,
  },
  directives: {
    'b-modal': VBModal,
  },
  data() {
    return {
      name: '',
      nameState: null,
      groupName: '',
      groupNameState: null,
      type: '',
      typeState: null,
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
      this.groupName = ''
      this.groupNameState = null
      this.type = ''
      this.typeState = null
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
    const TODO_APP_STORE_MODULE_NAME = 'app-todo'

    // Register module
    if (!store.hasModule(TODO_APP_STORE_MODULE_NAME)) store.registerModule(TODO_APP_STORE_MODULE_NAME, todoStoreModule)

    // UnRegister on leave
    onUnmounted(() => {
      if (store.hasModule(TODO_APP_STORE_MODULE_NAME)) store.unregisterModule(TODO_APP_STORE_MODULE_NAME)
    })

    const routeParams = computed(() => { })
    watch(routeParams, () => {
      // eslint-disable-next-line no-use-before-define
      fetchTasks()
    })

    const tasks = ref([])

    const addTask = val => {
      store.dispatch('app-todo/addTask', val)
        .then(() => {
          // eslint-disable-next-line no-use-before-define
          fetchTasks()
        })
    }
    const removeTask = () => {
      store.dispatch('app-todo/removeTask', { id: task.value.id })
        .then(() => {
          // eslint-disable-next-line no-use-before-define
          fetchTasks()
        })
    }
    const updateTask = taskData => {
      store.dispatch('app-todo/updateTask', { task: taskData })
        .then(() => {
          // eslint-disable-next-line no-use-before-define
          fetchTasks()
        })
    }

    const perfectScrollbarSettings = {
      maxScrollbarLength: 150,
    }

    const isTaskHandlerSidebarActive = ref(false)

    const taskTags = [
      { title: 'Team', color: 'primary', route: { name: 'apps-todo-tag', params: { tag: 'team' } } },
      { title: 'Low', color: 'success', route: { name: 'apps-todo-tag', params: { tag: 'low' } } },
      { title: 'Medium', color: 'warning', route: { name: 'apps-todo-tag', params: { tag: 'medium' } } },
      { title: 'High', color: 'danger', route: { name: 'apps-todo-tag', params: { tag: 'high' } } },
      { title: 'Update', color: 'info', route: { name: 'apps-todo-tag', params: { tag: 'update' } } },
    ]

    const fetchTasks = () => {
      store.dispatch('app-todo/fetchTasks', {
      })
        .then(response => {
          tasks.value = response.data
        })
    }

    fetchTasks()

    return {
      tasks,
      removeTask,
      addTask,
      updateTask,
      taskTags,
      fetchTasks,
      perfectScrollbarSettings,

      isTaskHandlerSidebarActive,
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
