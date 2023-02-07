<template>
  <!--  Add new task modal -->
  <div class="modal fade task-modal-content" id="taskPopup" tabindex="-1" role="dialog" aria-labelledby="NewTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="NewTaskModalLabel">{{$t('forms.labels.create_new_task')}}</h4>

          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="createOrUpdateTask()">

            <div class="row">
                <div class="position-relative0 mb-2 col-12 col-md-12">
                <label class="form-label" for="t-name">{{$t('forms.labels.task_title')}}</label>
                <input type="text" v-model="newTask.name" class="form-control" id="t-name"
                  :class="[ createTaskFormErrors['name'] ? 'is-invalid' : '']" placeholder="Task name">
                <div v-show="createTaskFormErrors['name']" class="text-danger invalid-feedback"> {{
                  getStringVal(createTaskFormErrors['name']) }} </div>
                </div>
            </div>

            <div class="row">
            <div class="col-12 col-md-6">
                  <div class="mb-2">
                    <label class="form-label">{{$t('forms.labels.status')}}</label>
                    <v-select v-model="selectedStatus" ref="vueDropdown" :options="taskStatuses" label="name" id="t-status"
                      @input="setSelectedStatus" :class="[ createTaskFormErrors['status_id'] ? 'is-invalid' : '']" :clearable="true"
                      :closeOnSelect="true" class="custom-v-select"></v-select>
                    <div v-show="createTaskFormErrors['status_id']" class="text-danger invalid-feedback"> {{
                      getStringVal(createTaskFormErrors['status_id']) }} </div>
                  </div>
                </div>

                 <div class="col-12 col-md-6">
                  <div class="mb-2">
                    <label for="task-priority2" class="form-label">{{$t('forms.labels.priority')}}</label>
                    <v-select v-model="newTask.priority" ref="vueDropdown" :options="priorityList" label="name" id="t-priority"
                      @input="setSelectedPriority" :class="[ createTaskFormErrors['priority'] ? 'is-invalid' : '']" :clearable="true"
                      :closeOnSelect="true" class="custom-v-select"></v-select>
                    <div v-show="createTaskFormErrors['priority']" class="text-danger invalid-feedback"> {{
                      getStringVal(createTaskFormErrors['priority']) }} </div>
                  </div>
                </div>
              </div>

            <div class="row">

              <div class="col-12">
                <div class=" mb-2">
                  <label for="task-description" class="form-label">{{$t('forms.labels.description')}}</label>
                   <textarea v-model="newTask.description" class="form-control"
                       :class="[ createTaskFormErrors['description'] ? 'is-invalid' : '']" id="t-description" rows="3"></textarea>
                  <div v-show="createTaskFormErrors['description']" class="text-danger invalid-feedback"> {{ getStringVal(createTaskFormErrors['description']) }} </div>
              </div>
            </div>

                  <div class="col-12 col-md-12">
                    <div class="mb-2">
                      <label for="t-users" class="form-label">{{$t('forms.labels.assign_to')}}</label>
                      <v-select multiple v-model="selectedUsers" ref="vueDropdown" :options="usersList" label="name" id="t-users"
                        :class="[ createTaskFormErrors['users'] ? 'is-invalid' : '']" :clearable="true" :closeOnSelect="false"
                        class="custom-v-select"></v-select>
                      <div v-show="createTaskFormErrors['users']" class="text-danger invalid-feedback"> {{
                        getStringVal(createTaskFormErrors['users']) }} </div>
                    </div>
                  </div>
          </div>

                <div class="row">

                  <div class="col-12 col-md-6">
                    <div class=" mb-2">
                      <label class="form-label" for="t-progress">{{$t('forms.labels.progress')}}</label>
                      <input type="number" v-model="newTask.progress" class="form-control" id="t-progress"
                        :class="[ createTaskFormErrors['progress'] ? 'is-invalid' : '']" placeholder="Task progress">
                      <div v-show="createTaskFormErrors['progress']" class="text-danger invalid-feedback"> {{
                        getStringVal(createTaskFormErrors['progress']) }} </div>
                    </div>
                  </div>
                
                  <div class="col-12 col-md-6">
                    <div class=" mb-2">
                        <label class="form-label" for="expiry_time"> {{$t('forms.labels.expiry_time')}}</label>
                        <datepicker v-model="expiry_time" id="expiry_time"  name="uniquename"> </datepicker>
                        <div v-show="createTaskFormErrors['expiry_time']" class="text-danger invalid-feedback"> {{
                        getStringVal(createTaskFormErrors['expiry_time']) }} </div>
                    </div>
                  </div>

                </div>
                
                <div class="row">
                  <div class="col-12 col-md-12 my-4">
                    <file-pond name="test" ref="pond" label-idle="Drop files here..." v-bind:allow-multiple="true"
                      v-bind:files="taskFiles"
                      @init="handleFilePondInit" @processfile="handleFilePondGalleryProcess"
                      @removefile="handleFilePondGalleryRemoveFile" v-on:updatefiles="handleFilesUpdated" max-files="10" />

                  </div>
                </div>
                <!--              <div class="col-md-6">-->
                <!--                <div class="mb-2">-->
                <!--                  <label for="task-priority" class="form-label">Due Date</label>-->
                <!--                  <input type="text" class="form-control form-control-light" id="birthdatepicker" data-toggle="date-picker" data-single-date-picker="true">-->
                <!--                </div>-->
                <!--              </div>-->
                <!--            </div>-->

                        <button type="button" class="btn btn-danger btn-group-lg  mx-2" data-bs-dismiss="modal">{{$t('forms.btns.cancel')}}</button>
                        <button type="submit" class="btn btn-primary btn-group-lg  mx-2">{{$t('forms.btns.save')}}</button>
          </form>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

</template>

<script>
import { ref } from 'vue';
import { mapActions, mapGetters } from "vuex";
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
import axiosIns from "../../libs/axios";
// Import FilePond
import vueFilePond, { setOptions } from 'vue-filepond';
// Import plugins
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.esm.js';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.esm.js';
// Import styles
import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';
import { isUserLoggedIn } from "../../auth/utils";
import Datepicker from 'vuejs3-datepicker';


const FilePond = vueFilePond(
    FilePondPluginFileValidateType,
    FilePondPluginImagePreview
)

let serverResponse = '';
const MediaUrl = getBaseAppUrl();

function getBaseAppUrl() {
  let appEnv = import.meta.env.VITE_APP_ENV;
  switch (appEnv) {
    case 'production':
      return import.meta.env.VITE_BASE_URL_LIVE;
    case 'development':
      return import.meta.env.VITE_BASE_URL_DEV;
    case 'local':
      return import.meta.env.VITE_BASE_URL_LOCAL;
    default:
      return  import.meta.env.VITE_BASE_URL_LIVE;
  }
}

// advance custom configs
// https://pqina.nl/filepond/docs/api/server/#advanced
setOptions({
  server: {
    url: MediaUrl + '/tasks/media_upload',
    headers: {
      'Authorization': 'Bearer ' + isUserLoggedIn(),
    },
    process: { // handle process errors
      onerror: (response) => {
        serverResponse = JSON.parse(response);
      }
    },
  },
  labelFileProcessingError: () => {
    // replaces the error on the FilePond error label
    return serverResponse.message;
  }
});

export default {
  name: "TaskPopup",

  props: [],
  components: {
    "v-select": vSelect,
    FilePond,
    Datepicker
  },
  data() {
    return {
      showTaskPriorityDropdown: false,
      showTaskPriority: true,
      currentWorkSpace: '',
      spacelists: [],
      workspacespaceUserslist: [],
      priorityList: ['normal', 'low', 'medium', 'high', 'highest'],
      selectedUsers: [],
      selectedStatus: [],
      formErrors: [],
      taskFiles: '',
      old_status_id: 0,
      expiry_time: '',
      markdwonContent: '',
      text:'',

      newTask: {
        id: "",
        name: "",
        description: "",
        space_id: "",
        status_id: "",
        priority: "normal",
        users: [],
        files: [],
      },
      formType: ""
    };
  },

  mounted() {},

  created() {
    this.getWorkspaceUsers();
    this.emitter.on('open-new-task-popup', (evt) => {
      this.showCreateNewTaskPopup(evt.type, evt.taskData);
    })
    this.emitter.on("close-task-popup", this.closePopup);
  },

  computed: {
    ...mapGetters({
      activeworkspace: "activeworkspace",
      createTaskFormErrors: "createTaskFormErrors",
      isLoading: "isLoading",
    }),

    usersList: function () {
      return  this.activeworkspace.users.map(function (item) {
        return {
          "value": item.id,
          "name": item.name + ' ' + item.father_name + ' ' + item.family_name
        }
      })
    },

    taskStatuses: function () {
      return this.spacelists.map(function (item) {
        return {
          "value": item.id,
          "name": item.name
        }
      })
    },

  },

  methods: {
    ...mapActions({
      getWorkspaceUsers: "getWorkspaceUsers",
      createNewTask: "createNewTask",
      updateTask: "updateTask",
    }),
    showCreateNewTaskPopup(type, taskData = null) {
      this.$store.state.createTaskFormErrors = {};
      if (type == 'create') {
        this.resetFormInputs();
      } else {
        // important to avoid still show errors after close popup
        this.newTask.id = taskData ? taskData.id : "";
        this.selectedStatus = (taskData && taskData.status) ? this.getSelectedStatus(taskData.status) : "";
        this.newTask.priority = taskData ? taskData.priority : "";
        this.newTask.progress = taskData ? taskData.progress : 0;
        this.newTask.name = taskData ? taskData.name : "";
        this.newTask.description = taskData ? taskData.description : "";
        this.selectedUsers = taskData ? this.getSelectedUsers(taskData.assigned_users) : "";
        this.newTask.files = taskData ? taskData.mediaFullUrls : [];
        // add files that already uploaded previously for task
        this.setUploadedFilesForTask(taskData.mediaFullUrls);
        this.old_status_id = taskData ? taskData.status_id : 0;
        this.expiry_time = taskData ? taskData.expiry_time : '';
        this.expiry_time = taskData ? taskData.expiry_time : '';
      }

      this.formType = type;
      this.newTask.space_id = this.$route.params.id;
      this.spacelists = this.activeworkspace.statuses;
      this.workspacespaceUserslist = this.activeworkspaceUsers;
      $("#taskPopup").modal("show");
    },

    createOrUpdateTask() {
      let selectedUsers = (this.selectedUsers != null || this.selectedUsers != undefined) ? this.setSelectedUsers(this.selectedUsers) : [];
      let uploadedFiles = (this.$refs.pond.getFiles() != null || this.$refs.pond.getFiles() != undefined) ? this.getUploadedFiles(this.$refs.pond.getFiles()) : [];

      if (this.formType == 'create') {
        this.createNewTask({
          name: this.newTask.name,
          description: this.newTask.description,
          priority: this.newTask.priority,
          progress: this.newTask.progress,
          users: selectedUsers,
          status_id: this.selectedStatus.value,
          space_id: this.newTask.space_id,
          attachments: uploadedFiles,
          expiry_time: this.expiry_time,
          old_status_id: this.old_status_id
        });
      } else {
        this.updateTask({
          id: this.newTask.id,
          name: this.newTask.name,
          priority: this.newTask.priority,
          description: this.newTask.description,
          progress: this.newTask.progress,
          users: selectedUsers,
          status_id: this.selectedStatus.value,
          space_id: this.newTask.space_id,
          attachments: uploadedFiles,
          expiry_time: this.expiry_time,
          old_status_id: this.old_status_id
        })
      }
    },

    closePopup() {
      $("#taskPopup").modal("hide");
      // this.resetFormInputs();
    },

    resetFormInputs() {
      this.newTask.id = "";
      this.newTask.name = "";
      this.newTask.description = "";
      this.newTask.status_id = "";
      this.newTask.priority = "";
      this.newTask.progress = "";
      this.newTask.users = [];
      this.$refs.pond.removeFiles(); // reset files
      this.old_status_id = 0;
      this.expiry_time = '';
      this.selectedStatus = "";
      this.selectedUsers = "";
    },

    // changePriority() {
    //     this.showTaskPriorityDropdown = !this.showTaskPriorityDropdown;
    //     this.showTaskPriority = !this.showTaskPriority;
    //         nextTick(() => {
    //         const input = this.$refs.vueDropdown.$el.querySelector("input");
    //         input.focus();
    //     });
    // },
    setNewPriority(e) {
      this.showTaskPriorityDropdown = !this.showTaskPriorityDropdown;
      this.showTaskPriority = !this.showTaskPriority;
    },

    setSelectedStatus(selectedItem) {
      this.selectedStatus = selectedItem;
    },

    getSelectedStatus(status) {
      return {
        "value": status.id,
        "name": status.name
      }
    },

    setSelectedPriority(selectedItem) {
      this.newTask.priority = selectedItem;
    },

    setSelectedUsers(selectedItems) {
      let newArray = [];
      if (typeof selectedItems != null && typeof selectedItems === 'object') {
        selectedItems.forEach((element) => {
          if (Number.isInteger(element.value)) {
            newArray.push(element.value);
          }
        });
      }
      return newArray;
    },

    getSelectedUsers(selectedItems = null) {
      let newArray = [];
      if (typeof selectedItems != null && typeof selectedItems === 'object') {
        selectedItems.forEach((element) => {
          newArray.push({ "value": element.id, "name": element.name + ' ' + element.father_name + ' ' + element.family_name });
        });
      }
      return newArray;
    },

    getUploadedFiles(uploadedItems) {
      let newArray = [];
      uploadedItems.forEach((element) => {
        if (element) {
          // push encrypted file id to fetch file in backend without need to send file format with rqeuset
          // muset send with this format ['asfjkdjf','ksldjfkl;j'] to decrypt it in backend
          newArray.push({ id: element.id, serverId: element.serverId });
        }
      });
      return newArray;
    },

    setUploadedFilesForTask(taskFiles) {
      let taskFilesRef = this.$refs.pond;
      if (taskFiles != undefined && typeof (taskFiles == 'Array' || taskFiles == 'Object')) {
        taskFilesRef.removeFiles(); // reset files then add new
        // taskFilesRef.addFiles(taskFiles); // it is true but we will check every item for custom logic
        taskFiles.forEach((element) => {
          if (element) {
            taskFilesRef.addFile(element);
          }
        });
      } else {
        taskFilesRef.value = [];
      }

    },

    getStringVal(val = null) {
      if (val !== null) {
        return val.toString();
      }
    },

    handleFilePondInit: function () {
    },

    // Set the server id from response
    handleFilePondGalleryProcess: function (error, file) {
      // this.newTask.files.push({id: file.id});
    },

    // Remove the server id on file remove
    handleFilePondGalleryRemoveFile: function (error, file) {
    },

    handleFilesUpdated: function (fileList) {
      this.fileList = fileList;
    },

  },  // end methods

  watch: {

    createTaskFormErrors(oldVal, newVal) {
    }

  },

};
</script>

<style lang="scss">

.vdatetime-input{
  display: block;
    width: 100%;
    padding: 0.45rem 0.9rem;
    font-size: .9rem;
    font-weight: 400;
    line-height: 1.5;
    color: var(--ct-input-color);
    background-color: var(--ct-input-bg);
    background-clip: padding-box;
    border: 1px solid var(--ct-input-border-color);
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.25rem;
    -webkit-transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
    transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
}

.vs__dropdown-menu{
  text-align: start !important;
}
.v-md-editor__toolbar-left+.v-md-editor__toolbar-right {
  margin-left: 35px;
}
div#taskPopup {
  overflow: hidden;
}

/*start responsive style*/
@media (max-width: 767.98px) {
  #taskPopup .modal-dialog.modal-dialog-centered.modal-lg {
    width: 85%;
    margin: 5% 7.5%;
    top: 20%;

  }
}

.modal-body {
  form {
    overflow-y: auto;
    max-height: 80vh;
    overflow-x: hidden;

    &::-webkit-scrollbar-track {
      box-shadow: none !important;
      border-radius: 0 !important;
      background: transparent;
      transition: .5s all ease-in-out;
    }

    &:hover::-webkit-scrollbar-track {
      transition: .5s all ease-in-out;
      background: var(--ct-thumbnail-border-color);
    }

    &::-webkit-scrollbar {
      width: 7px !important;
      transition: .5s all ease-in-out;
    }

    &::-webkit-scrollbar-thumb {
      border-radius: 35px !important;
      -webkit-box-shadow: none !important;
      background: transparent;
      box-shadow: none !important;
      transition: .5s all ease-in-out;
    }

    &:hover::-webkit-scrollbar-thumb {

      background: var(--ct-form-range-thumb-disabled-bg);
    }
  }
}
</style>
