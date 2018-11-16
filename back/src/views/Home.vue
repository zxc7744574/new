<template>
  <div class="home">
    <login />
  </div>
</template>

<script>
// @ is an alias to /src
import login from '@/views/login.vue'

export default {
  name: 'home',
  components: {
    login
  }
}
</script>
