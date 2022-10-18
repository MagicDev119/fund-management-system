import Vue from 'vue'
import ability from './ability'

export const canNavigate = to => {
  return to.matched.some(route => ability.can(route.meta.action || 'read', route.meta.resource))
}
Vue.prototype.$ability = ability
export const _ = undefined
