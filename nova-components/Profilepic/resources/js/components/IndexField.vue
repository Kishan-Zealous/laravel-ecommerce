<template>        
  <div class="flex gap-2">
    <img :src="field.imgUrl" alt="hhhh" class="rounded-full w-9 h-9">
    <div>
      <h3>{{ field.firstname }} {{ field.lastname }}</h3>
      
      <div class="flex">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" role="presentation" class="fill-current mr-1"><path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2zm16 3.38V6H4v1.38l8 4 8-4zm0 2.24l-7.55 3.77a1 1 0 0 1-.9 0L4 9.62V18h16V9.62z"></path></svg>
        <img src="../../../../../public/images/skype.svg" alt="skyp">
        <img src="../../../../../public/images/phone.svg" alt="skyp">
      </div>
    </div>
</div>

</template>
<script>

export default {
  props: ['resourceName', 'field','resource'],
  computed: {
    fieldValue() {
      return this.field.displayedAs || this.field.value
    },
  },


  methods:{
    hello(){
      console.log(this.resource)
    }
  }
}
</script>
