import { setBodyClass, setTitle } from './utils/dom.js'

const components = {}

export default new Vue({
  el: '#app',

  router: new VueRouter({
    mode: 'history',
    scrollBehavior (to, from, savedPosition) {
      return savedPosition || { x: 0, y: 0 }
    },
  }),

  template: `
    <transition name="component">
      <component id="app" :is="component" v-bind="data.componentProps"></component>
    </transition>
  `,

  data: {
    isLoading: true,
    component: null,
    data: {},
  },

  async created () {
    // Start app with initial data
    await this.init(__INITIAL_STATE__)

    // Fetch new data whenever the route changes.
    // The json parameter is added to let the server
    // know it should deliver json instaed og html.
    this.$router.beforeEach(async (to, from, next) => {
      this.isLoading = true

      const data = await this.fetch(to.path)
      await this.init(data)

      next()
    })
  },

  mounted () {
    // Listen for click events to let
    // the Vue router handle url changes.
    document.addEventListener('click', (event) => {
      const $link = event.target.closest('a')
      if (!$link || !$link.pathname) return
      this.$router.push({ path: $link.pathname })
      event.preventDefault()
    }, false)
  },

  methods: {
    async fetch (path) {
      const response = await fetch(`${path}?json`)
      const { data } = await response.json()
      return data
    },
    async init (data) {
      const url = data.componentURL

      // Set body classes
      setBodyClass(data.bodyClass)

      // Set document title
      setTitle(data.title)

      // Load Vue component if not loaded before
      if (!components.hasOwnProperty(url)) {
        let component = await import(url)
        components[url] = Vue.extend(component.default)
      }

      this.isLoading = false
      this.component = components[url]
      this.data = data
    }
  }
})


