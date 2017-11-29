export default {
  template: `
    <div class="text-muted mb-2">
      By <a :href="post.author.url">{{ post.author.name }}</a> - {{ post.date }}
    </div>
  `,

  props: {
    post: Object,
  },
}
