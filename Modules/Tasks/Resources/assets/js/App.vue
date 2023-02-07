<template>
  <div class="row">
    <div class="col-12">
      <router-view> </router-view>
    </div>
  </div>
</template>

<script>
import WorkSpaces from './components/WorkSpaces.vue'
import { mapGetters,  mapActions} from 'vuex'
import { isUserLoggedIn, getUserData, getHomeRouteForLoggedInUser } from './auth/utils'

export default {
  name: 'app',

  components: {
    WorkSpaces,
  },

  data () {
    return {
      msg: 'Welcome to Your Kanban App',
      // projects:[]
    }
  },

  created() {
    this.goToWorkspaces();
    this.fetchData();
    this.fetchCompanyUsers({});

    this.emitter.on("open-toast-msg", msgData => {
      this.showToastMsg(msgData)
    });

  },

  computed: {
    ...mapGetters({
      showResponseMsg: "showResponseMsg",
    }),

    getResponseMsg() {
      // control by show or hide and more
      return this.showResponseMsg
    }

  },

  methods: {
    ...mapActions({
      fetchData: "fetchData",
      fetchCompanyUsers: "fetchCompanyUsers",
    }),

    goToWorkspaces() {
      const isLoggedIn = isUserLoggedIn()
      if (isLoggedIn) {
        this.$router.push('/')
      } else {
        this.$router.push('/auth-login')
      }
    },

    showToastMsg(msgData) {
      // best paractice to show toast msg for all app, as reusable
      let msgText =  msgData.message ? msgData.message : this.$t('messages.default_msg');
      this.$toast.show(msgText, {
            type: msgData.type ? msgData.type : 'success',
            position: msgData.position ? msgData.position : 'top',
            duration: msgData.duration ? msgData.duration : 8000,
            dismissible: msgData.dismissible ? msgData.dismissible : true,
            queue: msgData.queue ? msgData.queue : false,
            pauseOnHover: msgData.pauseOnHover ? msgData.pauseOnHover : true,
      });
    },

  }
}
</script>

<style lang="scss">

</style>
