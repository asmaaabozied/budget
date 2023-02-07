<template>
  <!-- start comment item -->
   <div class="row">
    <div class="col-12  m-2" >
      <img v-if="comment.user" class="me-2 rounded-circle" :src="comment.user.image_path" :alt="comment.user.name + '  ' + comment.user.family_name" height="32">
      <div class="w-100">
        <h5 class="mt-0"> {{ comment.user.name + '  ' + comment.user.family_name }}  <small class="text-muted float-end">   {{ moment(comment.created_at).format('D-M-Y h:mm A') }}  </small></h5>
        <p v-html="replaceLinksInPlainTexts(comment.content)">  </p>
        <br/>

<!--        <a href="javascript: void(0);" @click="reply(comment.id)" v-if="getCommentType=='comment'" class="text-muted font-13 d-inline-block mt-2"><i-->
<!--            class="mdi mdi-reply" ></i> Reply </a>-->
<!--        <a href="javascript: void(0);" v-if="showCommentReplies(comment)"   class="text-muted font-13 d-inline-block m-2"><i-->
<!--            class="mdi mdi-chat" ></i> ({{ calculateCommentReplies(comment) }}) Replies </a>-->
      </div>

      <div class="col-12  mt-2" v-if="getCommentType=='reply'">
        <comment-form
            :form-type="formType"
            :comment-type="commentType"
            :current-comment="getCurrentComment"
        >
        </comment-form>
      </div>

      <div class="container">
        <template v-if="showCommentReplies(comment)">
<!--        <child-comment-->
<!--            v-for="(item, index) in comment.replies"-->
<!--            :key="index"-->
<!--            :comment="item"-->
<!--        ></child-comment>-->
        </template>
      </div>

    </div>
    <!-- end comment item -->
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import CommentForm from "../Comments/CommentForm.vue"
// import ChildComment from "../Comments/ChildComment.vue"
import Linkable from 'linkable'

  export default {
    name: "ChildComment",
    emits: ['click'],

    components: {
      CommentForm,
      // ChildComment
    },

    props: {
      comment:{
        type:Object,
        required: true
      },
    },

    data() {
      return {
        commentType:'comment',
        formType:'create'
      }
    },

    created() {
      this.emitter.on('change-comment-form-type', (evt) => {
        this.changeFormType(evt.type);
      })
      this.emitter.on('change-comment-type', (evt) => {
        this.commentTypeChanged(evt.type);
      })
    },

    computed: {
      ...mapGetters({
        activeTask: "activeTask",
      }),
      getCurrentComment() {
        return this.comment;
      },
      getCommentType() {
        return this.commentType;
      },

      getFormType() {
        return this.formType;
      },

    },

    methods: {
      ...mapActions({
      }),

      reply(){
        this.commentType = 'reply';
      },

      editComment() {
        this.formType = 'update';
      },

      changeFormType(type) {
        this.formType = type;
      },

      commentTypeChanged(type) {
        this.commentType = type;
      },

      showCommentReplies(comment) {
        if(comment.replies)
        return (typeof comment.replies === 'object' && this.calculateCommentReplies(comment.replies)) > 1 ? true : false;

      },

      calculateCommentReplies(replies) {
        return Object.keys(replies).length;
      },

      replaceLinksInPlainTexts(plainText) {
        const linkable = new Linkable()
        const text_with_links = linkable.replaceLinks(plainText);
        return text_with_links;
      }

    }, // close methods

  }
</script>

<style scoped>

</style>