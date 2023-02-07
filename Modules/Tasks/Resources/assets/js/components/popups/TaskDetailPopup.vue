<template>
  <div>
    <!-- Modal -->
    <div
      class="modal fade"
      id="taskDetailPopup"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div
        class="modal-dialog modal-fullscreen modal-dialog-centered modal-dialog-zoom task-detail-modal"
        role="document"
      >
        <div class="modal-content" v-if="isLoading">...</div>
        <div class="modal-content" v-else>

          <div class="modal-header bg-primary">
            <h4 class="modal-title text-light" id="exampleModalLabel">{{$t('forms.labels.task_details')}}</h4>
            <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close" @click="closePopup">
            </button>
          </div>
          <div class="modal-body">

              <div class="row">
                <div class="col-12 col-md-7 col-xxl-7">
                    <!-- project card -->
                    <div class="card d-block">
                      <div class="card-body p-2">
<!--                        <div class="dropdown card-widgets">-->
<!--                          <a href="#" class="dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false">-->
<!--                            <i class='uil uil-ellipsis-h'></i>-->
<!--                          </a>-->
<!--                          <div class="dropdown-menu dropdown-menu-end">-->
<!--                            &lt;!&ndash; item&ndash;&gt;-->
<!--                            <a href="javascript:void(0);" class="dropdown-item">-->
<!--                              <i class='uil uil-edit me-1'></i>Edit-->
<!--                            </a>-->
<!--                            <div class="dropdown-divider"></div>-->
<!--                            &lt;!&ndash; item&ndash;&gt;-->
<!--                            <a href="javascript:void(0);" class="dropdown-item text-danger">-->
<!--                              <i class='uil uil-trash-alt me-1'></i>Delete-->
<!--                            </a>-->
<!--                          </div> &lt;!&ndash; end dropdown menu&ndash;&gt;-->
<!--                        </div> &lt;!&ndash; end dropdown&ndash;&gt;-->

<!--                        <div class="form-check float-start">-->
<!--                          <input type="checkbox" class="form-check-input" id="completedCheck">-->
<!--                          <label class="form-check-label" for="completedCheck">-->
<!--                            Mark as completed-->
<!--                          </label>-->
<!--                        </div> &lt;!&ndash; end form-check&ndash;&gt;-->

                        <div class="clearfix"></div>

                        <h4 class="m-0"> {{ activeTaskDetails.name }} </h4>

                        <div class="row">
                          <div class="col-md-9 col-12">
                            <!-- assignee -->
                            <p class="mt-2 mb-1 text-muted fw-bold font-12 text-uppercase" v-if="activeTaskDetails.assigned_users">{{$t('forms.labels.assigned_to')}}</p>
                            <div class="d-flex py-2">
                              <div v-for="(user, id) in activeTaskDetails.assigned_users" :key="id">
                              <img :src="user.image_path" :alt="user.name"  class="rounded-circle me-2" height="24" />
                              <div>
<!--                                <h5 class="mt-1 font-14">-->
<!--                                 {{ user.name }}-->
<!--                                </h5>-->
                              </div>
                            </div>
                          </div>
                            <!-- end assignee -->
                          </div> <!-- end col -->

                          <div class="col-md-3 col-12">
                            <!-- start due date -->
                              <p class="mt-2 mb-1 text-muted font-10 ">{{$t('forms.labels.created_at')}} </p>
                              <div class="d-flex">
                                <i class='uil uil-schedule font-14 text-success me-1'></i>
                                <div>
                                  <h5 class="mt-1 font-12">
                                    {{ moment(activeTaskDetails.created_at).format('D-M-Y h:m a') }}
                                  </h5>
                                </div>
                              </div>
                            <!-- end due date -->

                            <!-- start due date -->
                            <p class="mt-2 mb-1 text-muted  font-10 " v-if="activeTaskDetails.expiry_time != undefined"> {{ $t('forms.labels.expiry_at') }} </p>
                            <div class="d-flex">
                              <i class='uil uil-schedule font-14 text-danger me-1'></i>
                              <div>
                                <h5 class="mt-1 font-12">
                                  {{ moment(activeTaskDetails.expiry_time).format('D-M-Y h:m a') }}
                                </h5>
                              </div>
                            </div>
                            <!-- end due date -->

                          </div> <!-- end col -->
                        </div> <!-- end row -->

                        <hr/>
                        <p class="text-muted mb-1 mt-1 mx-2" v-if="activeTaskDetails.description" v-html="replaceLinksInPlainTexts(activeTaskDetails.description)">
                        </p>
                        <!-- task files -->
                        <files> </files>

                      </div> <!-- end card-body-->
                    </div> <!-- end card-->

                  </div>

                <div class="col-12 col-md-5">
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="comments-tab" data-bs-toggle="tab"
                              data-bs-target="#comments" type="button" role="tab" aria-controls="comments" aria-selected="true"> Comments ({{ comments  ? comments.length : '' }}) </button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="changlogs-tab" data-bs-toggle="tab" data-bs-target="#changlogs" type="button" role="tab" aria-controls="changlogs"
                              aria-selected="false"> Changlogs ({{ changlogs  ? changlogs.length : '' }})  </button>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                      <task-histories> </task-histories>
                      <comments> </comments>
                  </div>
                </div>

                 </div>
            </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" @click="closePopup">{{$t('forms.btns.close')}}</button>
              </div>

           </div>
          </div>
        </div>
      </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import Comments from "../Comments/Comments.vue"
import Files from "../TaskFiles/Files.vue"
import TaskHistories from "../History/TaskHistories.vue"
import router from "../../router";
import Linkable from 'linkable'

export default {
  name: "TaskDetailPopup",
  components: {
    Comments,
    Files,
    TaskHistories
  },

  data() {
    return {
      isLoading: false,
    };
  },

  created() {
    this.emitter.on('open-task-detail-popup', (evt) => {
      this.showTaskDetailPopupPopup(evt.taskSlug);
    })
    this.emitter.on("close-task-details-popup", this.closePopup);
  },

  mounted() {
    // modal should be show here , to open when page created or reloaded with taslSlug
    this.showTaskDetailPopupPopup(this.$route.params.taskSlug);
  },

    computed: {
    ...mapGetters({
      activeTask: "activeTask",
      activeworkspace: "activeworkspace",
    }),

    activeTaskDetails() {
          return this.activeTask ? this.activeTask : '';
    },

    comments () {
      return this.activeTask ? this.activeTask.comments : {} ;
    },

    changlogs () {
      return this.activeTask ? this.activeTask.formattedHistories : {} ;
    }

  },

  methods: {

    ...mapActions({
      fetchActiveTask: "fetchActiveTask",
      resetActiveTask: "resetActiveTask",
    }),

    showTaskDetailPopupPopup(taskSlug) {
      // this.isLoading = true;
      if((typeof taskSlug != undefined && typeof taskSlug == 'string')) {
        this.fetchActiveTask({slug: taskSlug});
          // must push route to change url in page
          router.push({ name: 'task', params: { taskSlug: taskSlug } })
        $("#taskDetailPopup").modal("show");
      }
    },

    closePopup() {
      let currentRouteName = this.$route.name;
      let spaceID =  this.$route.params.id;
        // return to workspace ,
        router.push({ name: 'workspace', params: { id:  spaceID} })
      this.resetActiveTask();
      // this.isLoading = true;
      $("#taskDetailPopup").modal("hide");
    },

    replaceLinksInPlainTexts(plainText) {
      const linkable = new Linkable()
      const text_with_links = linkable.replaceLinks(plainText);
      return text_with_links;
    },

  },

  watch: {

  },

};
</script>

<style scoped lang="scss">
.btn-close {
  color: #fff !important;
  font-size: 1.2rem !important;
}
div#taskDetailPopup.modal.fade.show {
  display: block;
  padding-left: 0;
  width: 70%;
  right: 14%;
  left: auto;
  top: 10%;
  height: 80vh;
  border-radius: 5px;
}

.modal.show .modal-dialog {

  width: 100%;
  height: 100%;
  border-radius: 5px;
}

.modal-fullscreen .modal-footer,
.modal-fullscreen .modal-header {
  border-radius: 5px;
}

body.show.modal-open {
  overflow: hidden !important;

}

body {
  overflow-x: hidden !important;
  overflow-y: hidden !important;
}
    // start responsive style
    @media (max-width: 767.98px) {
      div#taskDetailPopup.modal.fade.show {
  
        padding: 0;
        width: 80%;
        right: 10%;
      }
      .modal-fullscreen .modal-header{
       
        padding: 10px;
    }
    .modal-title {
 
      font-size: 16px;
    }
    .btn-close {
      
      font-size: .7rem !important;
  }
  #taskDetailPopup{
    .card-body {
    padding: 1px 10px;
    .font-12 {
      font-size: 10px!important;
      margin: 2px 0 !important;
  }
  .font-14 {
    font-size: 12px!important;
}
.card-header {
  padding: 4px 7px;

}

  }
  h4.my-1 {
    font-size: 14px;
}
.modal-body .card-body {
  padding: 0 10px;
}

    .modal-footer{button.btn.btn-primary {
      padding: 2px 10px;
  }}


}




    }


</style>
