<template>
  <div id="app">
    <top />
    <router-view/>
    <bottom />
  </div>
</template>

<script>
import top from '@/components/top.vue'
import bottom from '@/components/bottom.vue'

export default {
  name: 'home',
  components: {
    top,bottom
  }
}
</script>


<style>
</style>
