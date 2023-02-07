<template>
  <div class="tab-pane" id="profile-b1">

    <template v-for="(item, index) in allFiles" :key="index">

        <file-item
            :file="item"
        ></file-item>
    </template>
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import FileItem from "./FileItem.vue";

export default {
  name: "Files",
  props: {
    media: {
      type: Object,
      required: false
    }
  },
  components:{
    FileItem
  },

  data() {
    return {

    }
  },

  created() {},

  computed: {
    ...mapGetters({
      activeTask: "activeTask",
    }),

    allFiles() {
      return this.activeTask ? this.activeTask.media : {} ;
    }

  },

  methods: {
    ...mapActions({}),
  },


}
</script>

<style scoped>

</style>