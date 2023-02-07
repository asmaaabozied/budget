<template>

  <div class="card tab-pane fade show active" id="comments" role="tabpanel" aria-labelledby="comments-tab">
    <div class="card-header p-2">
<!--      <h4 class="m-0">  </h4>-->
    </div>
    <div class="card-body p-2">
      <template v-for="(item, index) in comments"  :key="index">
        <comment
            :comment="item"
        ></comment>
      </template>

<!--      <div class="text-center mt-2">-->
<!--        <a href="javascript:void(0);" class="text-danger"><i class="mdi mdi-spin mdi-loading me-1"></i> Load more </a>-->
<!--      </div>-->

      <comment-form
       :comment-type="commentType"
       :form-type="formType"
      > </comment-form>

    </div> <!-- end card-body-->
  </div>
  <!-- end card-->

</template>

<script>
import { mapActions, mapGetters } from "vuex";
import Comment from "../Comments/Comment.vue"
import CommentForm from "../Comments/CommentForm.vue"

export default {
  name: "Comments",

  components: {
    Comment,
    CommentForm
  },

  props: {},

  data() {
    return {
      commentType:'comment',
      formType:'create',
    }
  },

  computed: {
    ...mapGetters({
      activeTask: "activeTask",
    }),

    comments () {
      return this.activeTask ? this.activeTask.comments : {} ;
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