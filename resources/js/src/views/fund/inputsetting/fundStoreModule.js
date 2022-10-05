import axios from '@axios'

export default {
  namespaced: true,
  state: {},
  getters: {},
  mutations: {},
  actions: {
    fetchTasks(ctx, payload) {
      return new Promise((resolve, reject) => {
        axios
          .get('/apps/todo/tasks', { params: payload })
          .then(response => resolve({data: [
    {
      id: 1,
      title: 'Entire change break our wife wide it daughter mention member.',
      dueDate: '2020-11-25',
      description:
        '<p>Chocolate cake topping bonbon jujubes donut sweet wafer. Marzipan gingerbread powder brownie bear claw. Chocolate bonbon sesame snaps jelly caramels oat cake.</p>',
      assignee: {
        fullName: 'Jacob Ramirez',
        avatar: require('@/assets/images/avatars/12.png'),
      },
      tags: ['update'],
      isCompleted: false,
      isDeleted: false,
      isImportant: false,
    },{
      id: 2,
      title: 'Entire change break our wife wide it daughter mention member.',
      dueDate: '2020-11-25',
      description:
        '<p>Chocolate cake topping bonbon jujubes donut sweet wafer. Marzipan gingerbread powder brownie bear claw. Chocolate bonbon sesame snaps jelly caramels oat cake.</p>',
      assignee: {
        fullName: 'Jacob Ramirez',
        avatar: require('@/assets/images/avatars/12.png'),
      },
      tags: ['update'],
      isCompleted: false,
      isDeleted: false,
      isImportant: false,
    }]}))
          .catch(error => reject(error))
      })
    },
    addTask(ctx, taskData) {
      return new Promise((resolve, reject) => {
        axios
          .post('/apps/todo/tasks', { task: taskData })
          .then(response => resolve(response))
          .catch(error => reject(error))
      })
    },
    updateTask(ctx, { task }) {
      return new Promise((resolve, reject) => {
        axios
          .post(`/apps/todo/tasks/${task.id}`, { task })
          .then(response => resolve(response))
          .catch(error => reject(error))
      })
    },
    removeTask(ctx, { id }) {
      return new Promise((resolve, reject) => {
        axios
          .delete(`/apps/todo/tasks/${id}`)
          .then(response => resolve(response))
          .catch(error => reject(error))
      })
    },
  },
}
