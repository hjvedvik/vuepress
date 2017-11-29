import PostTags from './PostTags.js'
import PostDetails from './PostDetails.js'

export default {
  template: `
    <article class="card mb-3">
      <div class="card-body">
        <h4 class="card-title"><a :href="post.permalink">{{ post.title }}</a></h4>
        <post-details :post="post"></post-details>
        <p class="card-text" v-html="post.excerpt"></p>
        <post-tags :tags="post.taxonomies.post_tag"></post-tags>
      </div>
    </article>
  `,

  props: {
    post: Object,
  },

  components: {
    PostTags,
    PostDetails,
  },
}
