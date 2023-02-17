<template>
  <img :src="field.value" />
  <PanelItem :index="index" :field="field" />
  <button @click="increment">Click</button>
</template>

<script>
export default {
  props: ['index', 'resource', 'resourceName', 'resourceId', 'field'],

  methods: {
    increment() {
      console.log(this.field)
    }
  },
  mounted(){
    alert(this.field)
  }
}

</script>
