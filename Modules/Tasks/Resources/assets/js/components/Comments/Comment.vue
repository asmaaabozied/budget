<template>
  <!-- start comment item -->
  <div class="container" :id="comment.id" >
  <div class="row">
    <div class="col-12  mt-3">
      <img v-if="comment.user" class="me-2 rounded-circle" :src="comment.user.image_path" :alt="comment.user.name + '  ' + comment.user.family_name" height="32">
      <div class="w-100 contain-links">
        <h5 class="mt-0 "> {{ comment.user.name + '  ' + comment.user.family_name }}  <small class="text-muted float-end">
           {{moment(comment.created_at).format('D-M-Y h:mm A') }}  </small></h5>
          <p v-html="replaceLinksInPlainTexts(comment.content)">  </p>
        <br/>

        <a href="javascript: void(0);" @click="reply(comment.id)" v-if="getCommentType=='comment'" class="text-muted font-13 d-inline-block m-2"><i
            class="mdi mdi-reply" ></i> {{$t('forms.labels.reply')}} </a>

        <a href="javascript: void(0);" v-if="showCommentReplies(comment)"  class="text-muted font-13 d-inline-block m-2"><i
            class="mdi mdi-chat" ></i> ({{ calculateCommentReplies(comment) }}) {{$t('forms.labels.replies')}} </a>
      </div>

      <div class="col-12  mt-2" v-if="getCommentType=='reply'">
        <comment-form
            :form-type="formType"
            :comment-type="commentType"
            :current-comment="getCurrentComment"
        >
        </comment-form>
      </div>

    </div>
    <!-- end comment item -->
  </div>
    <div class="container">
      <template v-if="showCommentReplies(comment)">
          <template v-for="(item, index) in comment.replies" :key="index">
            <child-comment
                  :comment="item"
            ></child-comment>
          </template>
      </template>
    </div>
</div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import CommentForm from "../Comments/CommentForm.vue"
import ChildComment from "./ChildComment.vue";
import Linkable from 'linkable'


  export default {
    name: "Comment",
    emits: ['click'],

    components: {
      ChildComment,
      CommentForm
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

    mounted() {},

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
        return this.calculateCommentReplies(comment) > 1 ? true : false;
      },

      calculateCommentReplies(comment) {
        return Object.keys(comment.replies).length;
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