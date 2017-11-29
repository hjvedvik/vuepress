import Navigation from './header/Navigation.js'
import PostCard from './post/PostCard.js'

export default {
  template: `
    <div>
      <navigation></navigation>
      <div class="container">
        <transition-group name="list" tag="div">
          <post-card class="list-item" v-for="post in posts" :key="post.id" :post="post"></post-card>
        </transition-group>
      </div>
    </div>
  `,

  props: {
    posts: Array,
  },

  components: {
    Navigation,
    PostCard,
  },
}
