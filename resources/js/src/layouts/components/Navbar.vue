<template>
  <div class="navbar-container d-flex content align-items-center">

    <!-- Nav Menu Toggler -->
    <ul class="nav navbar-nav d-xl-none">
      <li class="nav-item">
        <b-link class="nav-link" @click="toggleVerticalMenuActive">
          <feather-icon icon="MenuIcon" size="21" />
        </b-link>
      </li>
    </ul>

    <!-- Left Col -->
    <div class="bookmark-wrapper align-items-center flex-grow-1 d-none d-lg-flex">
      <dark-Toggler class="d-none d-lg-block" />
    </div>

    <b-navbar-nav class="nav align-items-center ml-auto">
      <fund />
      <date-time />
      <template #button-content>
        <b-button v-ripple.400="'rgba(255, 255, 255, 0.15)'" variant="primary" class="btn-icon">
          <feather-icon icon="SettingsIcon" />
        </b-button>
      </template>
      <b-nav-item-dropdown right toggle-class="d-flex align-items-center dropdown-user-link" class="dropdown-user">
        <template #button-content>
          <div class="d-sm-flex d-none user-nav">
            <p class="user-name font-weight-bolder mb-0">
              {{ userData.name || userData.username }}
            </p>
            <span class="user-status">{{ userData.role }}</span>
          </div>
          <b-avatar size="40" variant="light-primary" badge :src="require('@/assets/images/avatars/13-small.png')"
            class="badge-minimal" badge-variant="success" />
        </template>

        <b-dropdown-item link-class="d-flex align-items-center">
          <feather-icon size="16" icon="UserIcon" class="mr-50" />
          <span>Profile</span>
        </b-dropdown-item>

        <b-dropdown-divider />

        <b-dropdown-item link-class="d-flex align-items-center" @click="logout()">
          <feather-icon size="16" icon="LogOutIcon" class="mr-50" />
          <span>
            <!-- <b-link :to="{name:'user-login'}"> -->
            <small>Logout</small>
            <!-- </b-link> -->
          </span>
        </b-dropdown-item>
      </b-nav-item-dropdown>
    </b-navbar-nav>
  </div>
</template>

<script>
import {
  BLink, BNavbarNav, BNavItemDropdown, BDropdownItem, BDropdownDivider, BAvatar,
} from 'bootstrap-vue'
import DarkToggler from '@core/layouts/components/app-navbar/components/DarkToggler.vue'
import useJwt from '@/auth/jwt/useJwt'
import Fund from './FundDropdown.vue'
import DateTime from './DateTime.vue'
import { initialAbility } from '@/libs/acl/config'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'
export default {
  components: {
    BLink,
    BNavbarNav,
    BNavItemDropdown,
    BDropdownItem,
    BDropdownDivider,
    BAvatar,
    Fund,
    DateTime,

    // Navbar Components
    DarkToggler,
  },
  data() {
    return {
      userData: JSON.parse(localStorage.getItem('userData')),
    }
  },
  props: {
    toggleVerticalMenuActive: {
      type: Function,
      default: () => { },
    },
  },
  methods: {
    logout() {
      this.$http.get('/sanctum/csrf-cookie').then(response => {
        this.$http.get('/api/auth/logout', {
          headers: {
            'Authorization': localStorage.getItem('accessToken')
          }
        }).then(response => {
          console.log('logout')
          const { userData } = response.data
          useJwt.setToken(null)
          localStorage.clear()
          this.$ability.update(initialAbility)
          console.log('logout')
          this.$router.replace({ name: 'user-login' }).then(() => {
            this.$toast({
              component: ToastificationContent,
              position: 'top-right',
              props: {
                title: ``,
                icon: 'CoffeeIcon',
                variant: 'success',
                text: `User logout successful!`,
              },
            })
          })
        })
          .catch(error => {
            useJwt.setToken(null)
            localStorage.clear()
            this.$ability.update(initialAbility)
            this.$refs.loginValidation.setErrors(error)
          })
      })
    }
  },
}
</script>
