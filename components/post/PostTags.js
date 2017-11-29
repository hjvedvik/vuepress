export default {
  template: `
    <div>
      <a class="btn btn-sm btn-light mr-1"
        v-for="term in tags" :key="term.id"
        :href="term.permalink">
        {{ term.name }}
      </a>
    </div>
  `,

  props: {
    tags: Array,
  },
}
