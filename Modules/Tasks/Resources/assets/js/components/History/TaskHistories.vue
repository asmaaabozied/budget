<template>
  <div class="tab-pane fade" id="changlogs" role="tabpanel" aria-labelledby="changlogs-tab">
    <div class="card">
      <div class="card-body pb-1">
        <template v-for="(item, index) in formattedHistories"  :key="index">
            <history-item
                :historyItem="item"
            ></history-item>
        </template>
      </div>
    </div>
</div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import HistoryItem from "../History/HistoryItem.vue"

export default {
  name: "TaskHistories",

  components: {
    HistoryItem
  },

  props: {},

  data() {
    return {
     }
  },

  computed: {
    ...mapGetters({
      activeTask: "activeTask",
    }),

    formattedHistories () {
      return this.activeTask ? this.activeTask.formattedHistories : {} ;
    }

  },

  methods: {
    ...mapActions({

    }),

  },


}
</script>

<style scoped>

</style>