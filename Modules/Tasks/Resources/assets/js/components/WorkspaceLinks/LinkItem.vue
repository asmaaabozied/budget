<template>

  <div class="p-0 m-1 d-inline-block bd-highlight" @click="openLink(link.link)"  @dblclick="updateLink(link)">
      <a class="shadow-none mx-2">
        <button type="button"  class="btn btn-primary mx-1 text-sm" >
          {{ link.name }}
          <span  :class="link.icon" :style="{'color':link.icon_color}"> </span>
        </button>
      </a>
  </div>

</template>

<script>
import { mapActions, mapGetters } from "vuex";

export default {
  name: "LinkItem",
  emits: ['click'],

  props: ['link'],
  components: {},
  data(){
    return{

    }
  }, // close data

  created() {
  },

  computed: {
    ...mapGetters({})
  }, // close computed

  methods: {
    ...mapActions({}),

    openLink(url) {
      window.open(url, '_blank', 'noreferrer');
    },

    updateLink(linkData){
      this.emitter.emit("open-new-link-popup", {"type":"edit","linkData":linkData});
    }

  }, // close methods


}
</script>

<style scoped>

</style>