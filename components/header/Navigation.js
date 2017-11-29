export default {
  template: `
    <div class="navbar navbar-light navbar-expand-sm mb-3">
      <div class="container">
        <a class="navbar-brand" :href="$root.data.baseURL" v-html="brand"></a>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item" v-for="item in menu" 
            :key="item.id" :class="{ 'active': item.active }">
            <a class="nav-link" :class="item.classNames" :href="item.url">
              {{ item.title }}
            </a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" @submit="search">
          <input class="form-control mr-sm-2" v-model="$root.data.searchQuery" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </div>
  `,

  computed: {
    brand () {
      return this.$root.data.blogName
    },
    menu () {
      return this.$root.data.navigation.primary
    }
  },

  methods: {
    search (event) {
      event.preventDefault()
      if (this.$root.data.searchQuery) {
        this.$router.push({
          path: this.$root.data.searchURL + this.$root.data.searchQuery
        })
      }
    }
  }
}
