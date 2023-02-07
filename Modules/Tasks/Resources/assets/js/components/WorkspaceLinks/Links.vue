<template>

  <div class="col-12" v-if="workspaceLinks"> <!-- start links main div -->
    <div class="d-flex flex-row">
      <div class="p-2 bd-highlight"> {{$t('forms.labels.common_links')}}</div>
      <template  v-for="(item, index) in  workspaceLinks"   :key="index">
        <link-item
            :link="item"
        ></link-item>
      </template>
    </div>
  </div> <!-- end links main div -->

</template>

<script>
// import store from '../../store/index'
import { mapActions, mapGetters } from "vuex";
import LinkItem from './LinkItem.vue'

export default {
  name: "Links",
  props: [],
  components: {
    LinkItem,
  },
  data(){
    return{

    }
  }, // close data

  computed: {
    ...mapGetters({
      activeworkspace: "activeworkspace",
    }),

    workspaceLinks () {
      return this.$store.state.activeworkspace ? this.$store.state.activeworkspace.links : [];
    },
  }, // close computed

  methods: {
    ...mapActions({
    }),
  }, // close methods

}
</script>


<style scoped>

</style>