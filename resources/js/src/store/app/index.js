import { $themeBreakpoints } from '@themeConfig'

export default {
  namespaced: true,
  state: {
    windowWidth: 0,
    shallShowOverlay: false,
    showFundDropdown: false,
    showPortfolioDropdown: false,
    showDateDropdown: false,
    showDateQuarterDropdown: false,
    selectedFund: null,
    selectedPortfolio: null,
    selectedDate: (new Date()).getFullYear() + '-' + ('0' + ((new Date()).getMonth() + 1)).slice(-2) + '-' + ('0' + (new Date()).getDate()).slice(-2),
    selectedDateQuarter: (new Date()).getFullYear() + '-' + ('0' + ((new Date()).getMonth() + 1)).slice(-2) + '-' + ('0' + (new Date()).getDate()).slice(-2)
  },
  getters: {
    currentBreakPoint: state => {
      const { windowWidth } = state
      if (windowWidth >= $themeBreakpoints.xl) return 'xl'
      if (windowWidth >= $themeBreakpoints.lg) return 'lg'
      if (windowWidth >= $themeBreakpoints.md) return 'md'
      if (windowWidth >= $themeBreakpoints.sm) return 'sm'
      return 'xs'
    },
  },
  mutations: {
    UPDATE_WINDOW_WIDTH(state, val) {
      state.windowWidth = val
    },
    TOGGLE_OVERLAY(state, val) {
      state.shallShowOverlay = val !== undefined ? val : !state.shallShowOverlay
    },
    SHOW_FUND_DROPDOWN(state, val) {
      state.showFundDropdown = val !== undefined ? val : state.showFundDropdown
    },
    SHOW_PORTFOLIO_DROPDOWN(state, val) {
      state.showPortfolioDropdown = val !== undefined ? val : state.showPortfolioDropdown
    },
    SHOW_DATE_DROPDOWN(state, val) {
      state.showDateDropdown = val !== undefined ? val : state.showDateDropdown
    },
    SHOW_DATE_QUARTER_DROPDOWN(state, val) {
      state.showDateQuarterDropdown = val !== undefined ? val : state.showDateQuarterDropdown
    },
    SELECTED_FUND(state, val) {
      console.log('selectedFund', val)
      state.selectedFund = val !== undefined ? val : state.selectedFund
    },
    SELECTED_PORTFOLIO(state, val) {
      state.selectedPortfolio = val !== undefined ? val : state.selectedPortfolio
    },
    SELECTED_DATE(state, val) {
      state.selectedDate = val !== undefined ? val : state.selectedDate
    },
    SELECTED_DATEQUARTER(state, val) {
      state.selectedDateQuarter = val !== undefined ? val : state.selectedDateQuarter
    },
    INIT_NAV_STATE(state) {
      state.showFundDropdown = false
      state.showPortfolioDropdown = false
      state.showDateDropdown = false
      state.showDateQuarterDropdown = false
      state.selectedFund = null
      state.selectedPortfolio = null
      state.selectedDate = (new Date()).getFullYear() + '-' + ('0' + ((new Date()).getMonth() + 1)).slice(-2) + '-' + ('0' + (new Date()).getDate()).slice(-2)
      state.selectedDateQuarter = (new Date()).getFullYear() + '-' + ('0' + ((new Date()).getMonth() + 1)).slice(-2) + '-' + ('0' + (new Date()).getDate()).slice(-2)
    }
  },
  actions: {},
}
