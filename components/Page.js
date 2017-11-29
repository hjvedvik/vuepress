import Navigation from './header/Navigation.js'

export default {
  template: `
    <div>
      <navigation></navigation>
      <div class="container">
        <h1 class="post__title">{{ post.title }}</h1>
        <div class="post__content" v-html="post.content"></div>
      </div>
    </div>
  `,

  props: {
    post: Object,
  },

  components: {
    Navigation,
  },
}
