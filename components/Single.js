import Navigation from './header/Navigation.js'
import PostTags from './post/PostTags.js'
import PostDetails from './post/PostDetails.js'

export default {
  template: `
    <div>
      <navigation></navigation>
      <div class="container">
        <div class="row">
          <div class="col-8">
            <h1>{{ post.title }}</h1>
            <post-details :post="post"></post-details>
            <div v-html="post.content"></div>
            <post-tags :tags="post.taxonomies.post_tag"></post-tags>
          </div>
          <div class="col">
            <ul class="list-group">
              <a class="list-group-item" v-for="post in posts" :key="post.id" :href="post.permalink">
                <div>{{ post.title }}</div>
                <small class="text-muted">{{ post.date }}</small>
              </a>
            </ul>
          </div>
        </div>
      </div>
    </div>
  `,

  props: {
    post: Object,
    posts: Array,
  },

  components: {
    Navigation,
    PostTags,
    PostDetails,
  },
}
