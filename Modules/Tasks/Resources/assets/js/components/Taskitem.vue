<template>
  <!-- Task Item -->
  <div class="card mb-0">
    <div class="card-body p-1">
      <div class="align-items-center d-flex date-task justify-content-between">
        <small class="float-end text-muted"
          >{{$t('forms.labels.since')}} {{ moment(item.created_at).format("D-M-Y h:m a") }}
        </small>
        <small class="float-end text-muted" v-if="item.creator">
        {{$t('forms.labels.auther')}} {{ item.creator.name }}
        </small>
        <div class="dropdown float-end ">
          <a
            href="#"
            class="dropdown-toggle text-muted arrow-none"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
            <i class="mdi mdi-dots-vertical font-18"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-end">
            <!-- item-->
            <a class="dropdown-item" @click="editTaskItem(item)"
              ><i class="mdi mdi-pencil me-1"></i> {{$t('forms.btns.edit')}}</a
            >
            <!-- item-->
            <a class="dropdown-item" @click="deleteTaskItem(item)"
              ><i class="mdi mdi-delete me-1"></i>{{$t('forms.btns.delete')}}</a
            >
            <!-- item-->
            <!--          <a   class="dropdown-item"><i class="mdi mdi-plus-circle-outline me-1"></i>Add user</a>-->
            <!-- item-->
            <!--          <a   class="dropdown-item"><i class="mdi mdi-exit-to-app me-1"></i>Leave</a>-->
          </div>
        </div>
      </div>

<!--      <router-link :to="{ name: 'task', params: { taskSlug: item.slug } }">-->
        <h5 class="task-title" @click="openTaskDetailPopoup(item.slug)">
          <a class="font-20 text-capitalize"> {{ item.name }} </a>
        </h5>
<!--      </router-link>-->
      <p>
         <span class="pe-1 text-nowrap d-inline-block" v-if="item.expiry_time">
              <small class="float-end text-muted">
                {{ moment(item.expiry_time).format("D-M-Y h:m a") }}
            </small>
        </span>
        <span class="pe-1 text-nowrap d-inline-block">
          <i class="mdi mdi-progress-clock text-primary"></i>
          <b> {{ item.progress }} </b>
        </span>
        <span class="pe-1 text-nowrap d-inline-block">
          <i class="mdi mdi-comment-multiple-outline text-primary"></i>
          <b> {{ comments }} </b>
        </span>
        <span class="badge  float-end  m-0 task-priority" :class="item.priority">
          {{ item.priority }}
        </span>
      </p>

      <!--      <p class="mb-0">-->

      <!--&lt;!&ndash;        will used later to show total time &ndash;&gt;-->
      <!--             <span class="pe-1 text-nowrap mb-2 d-inline-block">-->
      <!--               <i class="mdi mdi-progress-clock text-primary"></i>-->
      <!--               <b> {{ item.progress }} </b>-->
      <!--             </span>-->
      <!--            <span class="text-nowrap mb-2 d-inline-block">-->
      <!--             <i class="mdi mdi-comment-multiple-outline text-primary"></i>-->
      <!--&lt;!&ndash;             <b> {{ item.comments_count }} </b> Comments&ndash;&gt;-->
      <!--             <b> {{ comments }} </b>-->
      <!--            </span>-->
      <!--      </p>-->

      <p class="">
        <template v-for="(user, id) in item.assigned_users"  :key="id">
          <img
            :src="user.image_path"
            :alt="user.name"
            class="avatar-xs rounded-circle me-1"
          >
        </template>
      </p>
    </div> <!-- end card-body -->

      <ul class="list-group list-group-flush">
        <li class="list-group-item p-2">
          <div class="progress progress-xl">
            <div class="progress-bar text-xl-center" :class="progressClass" role="progressbar" :style="{'width': item.progress + '%'}"  :aria-valuenow="item.progress" aria-valuemin="0"
                 aria-valuemax="100">
              {{ item.progress + ' % ' }}
            </div>
          </div>
        </li>
      </ul>

  </div>
  <!-- Task Item End -->
</template>

<script>
// // import store from "./../store/index";
import { mapActions, mapGetters } from "vuex";
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
import TaskDetailPopup from "./popups/TaskDetailPopup.vue";
import { Tooltip, Toast, Popover } from "bootstrap";
import { nextTick } from 'vue'

export default {
  name: "Taskitem",
  emits: ['click'],

  props: ["item", "list", "workspace", "parentId"],
  components: {
    "v-select": vSelect,
    TaskDetailPopup,
    Tooltip,
    Toast,
    Popover,
  },
  data() {
    return {
      showTaskPriorityDropdown: false,
      showTaskPriority: true,
    };
  },

  computed: {
    ...mapGetters({
      activeworkspaceUsers: "activeworkspaceUsers",
    }),

    comments() {
      return this.item.comments ? this.item.comments.length : 0;
    },

    progressClass() {
      return this.getProgressBarClass(this.item.progress);
    },

  },

  created() {

  },

  methods: {
    ...mapActions({
      deleteTask: "deleteTask",
    }),

    assignUser(user) {
      this.item.assignedUsers.push(user);
    },
    changePriority() {
      this.showTaskPriorityDropdown = !this.showTaskPriorityDropdown;
      this.showTaskPriority = !this.showTaskPriority;
      nextTick(() => {
        const input = this.$refs.vueDropdown.$el.querySelector("input");
        input.focus();
      });
    },
    setNewPriority(e) {
      this.showTaskPriorityDropdown = !this.showTaskPriorityDropdown;
      this.showTaskPriority = !this.showTaskPriority;
    },

    editTaskItem(taskData) {
      this.emitter.emit("open-new-task-popup",{"type":" edit","taskData":taskData});
    },

    deleteTaskItem(taskData) {
      this.deleteTask({
        id: taskData.id,
        status_id: taskData.status_id,
        space_id: taskData.space_id,
      });
    },

    openTaskDetailPopoup(taskSlug) {
      this.emitter.emit("open-task-detail-popup", {'taskSlug':taskSlug});
    },

    getProgressBarClass(progressVal) {
      switch (true) {
        case (progressVal > 0 && progressVal <= 25):
          return 'bg-secondary';
        case progressVal <= 50:
          return 'bg-warning';
        case progressVal <= 75:
          return 'bg-info';
        case progressVal <= 99:
          return 'bg-success';
        case progressVal == 100:
           return 'bg-primary';
        default:
          return 'bg-white'; // also if value 0 will return white progress
      }
    },

  }, // close functions

};
</script>

<style scoped lang="scss" >

.task-title {

}

.task-title:hover {
  cursor: pointer !important;
}

</style>