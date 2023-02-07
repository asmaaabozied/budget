<template>
  <div class="workspaces-page">
    <div class="content">
      <!-- Start Content-->
      <div class="container-fluid">
        <bread-crumbs
            :home-link="homeLink"
            :home-title="homeTitle"
            :task-link="taskLink"
            :main-title="mainTitle"
            :page-title="pageTitle"
        ></bread-crumbs>
        <navbar
            parent-page="workspaces"
        ></navbar>
<!--        <toast-notification/>-->

        <div class="row">
            <!-- start workspace item card -->
          <template v-for="workspace in allworkspaces"  :key="workspace.id">
              <div class="col-12 col-md-6 col-xxl-3" >
                  <div class="card d-block">
                    <div class="card-body">
                      <div class="dropdown card-widgets">
                        <a href="#" class="dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="ri-more-fill"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                          <!-- item-->
                          <a href="javascript:void(0);" @click="editWorkSpace(workspace)" class="dropdown-item"><i
                              class="mdi mdi-pencil me-1"></i>{{$t('forms.btns.edit')}}</a>
                          <!-- item-->
                          <a href="javascript:void(0);" @click="deleteWorkSpaceItem(workspace)" class="dropdown-item"><i
                              class="mdi mdi-delete me-1"></i>{{$t('forms.btns.delete')}}</a>
    <!--                      &lt;!&ndash; item&ndash;&gt;-->
    <!--                      <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-email-outline me-1"></i>Invite</a>-->
    <!--                      &lt;!&ndash; item&ndash;&gt;-->
    <!--                      <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-exit-to-app me-1"></i>Leave</a>-->
                        </div>
                      </div>
                      <!-- project title-->
                      <h4 class="mt-0">
                          <div  class="project-card">
                            <a @click="goToWorkspace(workspace.id)" class="text-title">   {{ workspace.name }} </a>
                            <i class="ri-notification-3-fill  color-danger"></i>
                            <span class="color-danger"> {{ workspace.notifications_count }} </span>
                          </div>
                      </h4>
    <!--                  <div class="badge bg-success">Finished</div>-->

                      <p class="text-muted font-13 ">
                        {{ workspace.description }}
    <!--                    <a class="fw-bold text-muted">view more</a>-->
                      </p>

                      <!-- workspace counts -->
                          <p class="mb-1">
                               <span class="pe-1 text-nowrap mb-1 d-inline-block">
                                   <i class="mdi mdi-format-list-bulleted-type text-muted"></i>
                                   <b>  {{ workspace.all_tasks_count }} </b> Tasks
                               </span>
                               <span class="pe-1  text-nowrap mb-1  d-inline-block">
                                   <i class="mdi mdi-comment-multiple-outline text-muted"></i>
                                   <b>{{ workspace.statuses_count }}</b> Lists
                               </span>
                             <span class="pe-1  text-nowrap mb-1  d-inline-block">
                                   <i class="mdi mdi-account-multiple-outline text-muted"></i>
                                   <b>{{ workspace.all_users_count }}</b> Users
                             </span>
                        </p>

                      <div id="tooltip-container">
                        <template v-for="(user, id) in workspace.users" :key="id">
                          <a
                                 data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="top" :title="user.name + user.father_name" class="d-inline-block">
                              <img :src="user.image_path" class="rounded-circle avatar-xs" :alt="user.name" >
                            </a>
                        </template>

                        <a class="d-inline-block text-muted fw-bold ms-2">
                          + {{ workspace.all_users_count }} more
                        </a>
                      </div>

                    </div> <!-- end card-body-->
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item p-3">
                        <!-- project progress-->
    <!--                    <p class="mb-2 fw-bold">Progress <span class="float-end">100%</span></p>-->
                        <div class="progress progress-sm">
                          <!-- <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                                                </div> -->
                          <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0"
                            aria-valuemax="100"></div><!-- /.progress-bar -->
                        </div><!-- /.progress -->

                      </li>
                    </ul>
                  </div> <!-- end card-->
            </div> <!-- end workspace item card -->
        </template>

        </div> <!-- end row -->

        <new-work-space-popup></new-work-space-popup>

      </div> <!-- container -->
    </div> <!-- content -->
  </div>
  <!-- END wrapper -->

</template>

<script>
import { mapGetters, mapActions } from "vuex";
import BreadCrumbs from "./Header/BreadCrumbs.vue";
import Navbar from "./Header/Navbar.vue";
import NewWorkSpacePopup from "./popups/NewWorkSpacePopup.vue";
import workSpace from "./WorkSpace.vue";

export default {
  name: "WorkSpaces",
  emits: ['click'],

  components: {
    Navbar,
    BreadCrumbs,
    NewWorkSpacePopup,
  },
  data() {
    return {
      documents: [],
      homeLink: window.dashboardUrl+'/ar/dashboard',
      homeTitle: this.$t('breadcrumbs.home'),
      taskLink: window.dashboardUrl+'/ar/dashboard/tasks',
      currentPage: this.$t('breadcrumbs.workspaces'),
      mainTitle: this.$t('breadcrumbs.tasks_app'),
      subTitle:  this.$t('breadcrumbs.workspaces'),
      subSubTitle: '',
      pageTitle: this.$t('breadcrumbs.workspaces'),
    }
  },

  mounted() {
    this.emitter.on("close-workspace-popup", Data => {
      this.closeWorkspacePopup(Data)
    });
  },

  created() {},

  computed: {
    ...mapGetters({
      allworkspaces: "allworkspaces",
      activeworkspace: "activeworkspace",
      unarchivedworkspaces: "unarchivedworkspaces",
      archivedworkspaces: "archivedworkspaces"
    })
  },

  methods: {
    ...mapActions({
      getActiveWorkspace: "getActiveWorkspace",
      deleteWorkSpace: "deleteWorkSpace",
      archiveWorkspace: "archiveWorkspace",
      restoreWorkspace: "restoreWorkspace",
    }),
    totalItems(lists) {
      let count = 0;
      lists.forEach(element => {
        if (element.items)
          count += element.items.length;
      });
      return count;
    },
    handleArchiveWorkspace(workspace) {
      this.archiveWorkspace({ workspaceId: workspace.id });
    },
    handleRestoreWorkspace(workspace) {
      this.restoreWorkspace({ workspaceId: workspace.id });
    },

    editWorkSpace(spaceData) {
      this.emitter.emit("open-new-workspace-popup", {'type':'edit', 'spaceData':spaceData});
    },

    deleteWorkSpaceItem(workspaceItem) {
      this.deleteWorkSpace({
        id: workspaceItem.id,
      })
    },

    async goToWorkspace(spaceId) {
      this.$router.push({ name: 'workspace', params: { id: spaceId } })
    },

    closeWorkspacePopup() {
      $("#newSpacePopup").modal("hide");
    },


  },

}
</script>

<style scoped>

p.text-muted.font-13 {
  max-height: 20px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  margin: 10px 0 !important;
}

.avatar-xs {
  object-fit: cover;
  border: 1px solid var(--ct-card-border-color);
}

:root .card, :root .card-header {
  --ct-card-box-shadow: var(--ct-box-shadow-lg);}
/* end task items style */
.color-danger{
  color:#d81a1a;
}

.text-title {
  cursor: pointer !important;
  color: var(--ct-primary) !important;
}

.text-title:hover {
  color: var(--ct-secondary) !important;
}

</style>