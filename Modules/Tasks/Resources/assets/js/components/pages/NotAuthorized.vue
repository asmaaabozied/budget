<template>
  <div class="container">
      You don’t have permission to access this page. Go Home!!
  </div>
</template>

<script>
/* eslint-disable global-require */
import { getHomeRouteForLoggedInUser } from '../../auth/utils'

export default {
  components: {
  },
  data() {
    return {
    }
  },
  computed: {

  },
  methods: {
    loginRoute() {
      const user = JSON.parse(localStorage.getItem('userData'))
      return getHomeRouteForLoggedInUser(user ? user.role : null)
    },
  },
}
</script>

<style lang="scss">

</style>
