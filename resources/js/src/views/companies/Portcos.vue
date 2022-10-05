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
    <b-card title="Kick start your project 🚀">
      <b-card-text>All the best for your new project.</b-card-text>
      <b-card-text>Please make sure to read our <b-link
          href="https://pixinvent.com/demo/vuexy-vuejs-admin-dashboard-template/documentation/" target="_blank">
          Template Documentation
        </b-link> to understand where to go from here and how to use our template.</b-card-text>
    </b-card>

    <b-card title="Want to integrate JWT? 🔒">
      <b-card-text>We carefully crafted JWT flow so you can implement JWT with ease and with minimum efforts.
      </b-card-text>
      <b-card-text>Please read our JWT Documentation to get more out of JWT authentication.</b-card-text>
    </b-card>
  </div>
</template>

<script>
import { BBreadcrumb, BBreadcrumbItem, BRow, BCol, BDropdown, BDropdownItem, BButton, BCard, BCardText, BLink } from 'bootstrap-vue'

export default {
  components: {
    BCard,
    BCardText,
    BLink,
    BBreadcrumb,
    BBreadcrumbItem,
    BRow,
    BCol,
    BDropdown,
    BDropdownItem,
    BButton,
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
    ]
  })
}
</script>

<style>

</style>
