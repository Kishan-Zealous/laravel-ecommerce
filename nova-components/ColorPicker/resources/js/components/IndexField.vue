<template>
  <span>{{ fieldValue }}</span>
  <button @click="increment">Hello</button>
</template>

<script>
export default {
  props: ['resourceName', 'field'],
  computed: {
    fieldValue() {
      return this.field.displayedAs || this.field.value
    },
  },
  methods: {
    increment() {
      console.log(this.field)
    }
  },

}
</script>
