<template>
  <div class="border rounded">
    <form @submit.prevent="createOrUpdateComment()" class="comment-area-box">
      <textarea v-model="content" rows="3" class="form-control border-0 resize-none"
                :class="[ createCommentFormErrors['content'] ? 'is-invalid' : '']"
                placeholder="Your comment ..">
      </textarea>
      <div v-show="createCommentFormErrors['content']" class="text-danger invalid-feedback"> {{ getStringVal(createCommentFormErrors['content']) }} </div>
      <div class="p-2 bg-light d-flex justify-content-between align-items-center">
        <div>
          <!--              <a href="#" class="btn btn-sm px-1 btn-light"><i class='mdi mdi-upload'></i></a>-->
          <!--              <a href="#" class="btn btn-sm px-1 btn-light"><i class='mdi mdi-at'></i></a>-->
        </div>
        <div class="text-center">
          <a class="btn btn-sm btn-danger mx-2" v-if="commentType=='reply'" @click="cancelReply()"><i class='uil uil-message me-1'></i>cancel</a>
          <a class="btn btn-sm btn-danger mx-2" v-if="commentType=='comment'" @click="clearComment()"><i class='uil uil-cancel me-1'></i>clear</a>
          <button type="submit" class="btn btn-sm btn-success"><i class='uil uil-message me-1'></i>Submit</button>
        </div>
      </div>
    </form>
  </div> <!-- end border-->
</template>

<script>
import { mapActions, mapGetters } from "vuex";

export default {
  name: "CommentForm",
  emits: ['click'],

  props: {
    commentType:{
      type:String,
      required: true,
      default:'comment'
    },
    formType:{
      type:String,
      required: true,
      default:'create'
    },
    oldComment:{
      type:Object,
      required: false,
    },
    currentComment:{
      type:Object,
      required: false,
    },
  },

  data() {
    return {
        id:"",
        content:"",
        task_id:"",
        parent_id:"",
    }
  },

  created() {
    this.setCommentData();
    this.emitter.on('reset-comment-form-content', (evt) => {
      this.resetCommentForm(evt);
    })
  },

  computed: {
    ...mapGetters({
      activeTask: "activeTask",
      createCommentFormErrors: "createCommentFormErrors",
    }),
  },

  methods: {
    ...mapActions({
      createTaskComment: "createTaskComment",
      updateTaskComment: "updateTaskComment",
    }),

    createOrUpdateComment() {
      if(this.formType == 'create') {

        if(this.commentType == 'reply') {
          this.parent_id = this.currentComment.id;
        }
        this.createTaskComment({
          content : this.content,
          task_id : this.activeTask.id,
          // Temp , TO DO make it according to auth
          // it is important to push sub comments to parent
          // because it it is not returned from db like structure here , becuase it is from different transformer
          parent:this.currentComment
        })
        } else {
        this.updateTaskComment({
          id : this.oldComment.id,
          content : this.content,
          task_id : this.activeTask.id,
        });
      }
    },

    resetCommentForm() {
      this.id = "";
      this.task_id = this.activeTask.id;
      this.content = "";
    },

    setCommentData() {
      if(this.commentType == 'reply') {
        this.parentId  = this.parentId
      }
      if(this.formType == 'create') {
            this.id = this.oldComment ? this.oldComment.id : "";
            this.task_id = this.oldComment ? this.oldComment.task_id  : "";
            this.content = this.oldComment ? this.oldComment.content  : "";
      } else {
              this.id = "";
              this.task_id = this.activeTask.id;
              this.content = "";
      }
    },

    getStringVal(val=null) {
      if(val !== null) {
        return val.toString();
      }
    },

    cancelReply() {
      let formType = 'comment';
      this.emitter.emit('change-comment-type',{'type':'comment'});
    },

  }
}
</script>

<style scoped>

</style>