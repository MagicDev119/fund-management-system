<template>
  <div class="app-content content"
    :class="[{'show-overlay': $store.state.app.shallShowOverlay}, $route.meta.contentClass]">
    <div class="content-overlay" />
    <div class="header-navbar-shadow" />
    <slot name="breadcrumb">
      <app-breadcrumb />
    </slot>
    <transition :name="routerTransition" mode="out-in">

      <div class="content-area-wrapper border-0" :class="contentWidth === 'boxed' ? 'container p-0' : null">
        <portal-target name="content-renderer-sidebar-left" slim />
        <div class="content-right border-0">
          <div class="content-wrapper">
            <div class="content-body">
              <slot />
            </div>
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
import AppBreadcrumb from '@core/layouts/components/AppBreadcrumb.vue'
import useAppConfig from '@core/app-config/useAppConfig'

export default {
  components: {
    AppBreadcrumb,
  },
  setup() {
    const { routerTransition, contentWidth } = useAppConfig()

    return {
      routerTransition, contentWidth,
    }
  },
}
</script>

<style>

</style>
