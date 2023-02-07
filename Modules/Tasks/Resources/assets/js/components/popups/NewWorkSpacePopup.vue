<template>
  <div>
    <!-- Modal -->
    <div
        class="modal fade task-modal-content"
        id="newSpacePopup"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <form @submit.prevent="createOrUpdateWorkspace()">
            <div class="modal-header">
              <h5
                  class="modal-title"
                  id="exampleModalLabel"
              >{{$t('forms.labels.create_new_workspace')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-12  position-relative mb-3">
                  <label for="w-name" class="form-label"> {{$t('forms.labels.Workspace_name')}}</label>
                  <div class="form-group">
                    <input
                        type="text"
                        v-model="newWorkspace.name"
                        class="form-control"
                        id="w-name"
                        :class="[ createSpaceFormErrors['name'] ? 'is-invalid' : '']"
                        placeholder="Workspace Name"
                    />
                    <div v-show="createSpaceFormErrors['name']" class="text-danger invalid-feedback"> {{ getStringVal(createSpaceFormErrors['name']) }} </div>
                  </div>
                </div>
                <div class="col-12 position-relative mb-3">
                  <label for="w-description" class="form-label">{{$t('forms.labels.Workspace_description')}}</label>
                  <div class="form-group">
                                        <textarea
                                            v-model="newWorkspace.description"
                                            type="text"
                                            rows="3"
                                            class="form-control"
                                            id="w-description"
                                            :class="[ createSpaceFormErrors['description'] ? 'is-invalid' : '']"
                                            placeholder="Workspace Description"
                                        />
                    <div v-show="createSpaceFormErrors['description']" class="text-danger invalid-feedback"> {{ getStringVal(createSpaceFormErrors['description']) }} </div>
                  </div>
                </div>

                <div class="col-12 position-relative mb-3">
                  <label for="w-users" class="form-label">{{$t('forms.labels.users')}}</label>
                  <v-select
                      multiple
                      v-model="selectedUsers"
                      ref="vueDropdown"
                      :options="usersList"
                      label="name"
                      :clearable="true"
                      :closeOnSelect="false"
                      id="w-users"
                      class="custom-v-select"
                      :class="[ createSpaceFormErrors['users'] ? 'is-invalid' : '']"
                  ></v-select>
                  <div v-show="createSpaceFormErrors['users']" class="text-danger invalid-feedback"> {{ getStringVal(createSpaceFormErrors['users']) }} </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{$t('forms.btns.cancel')}}</button>
              <button type="submit" class="btn btn-primary"> {{$t('forms.btns.save')}} </button>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import vSelect from "vue-select";

export default {
  name: "NewWorkSpacePopup",
  props: [],
  components: {
    "v-select": vSelect,
  },
  data() {
    return {
      companyUserslist:[],
      selectedUsers:[],
      newWorkspace: {
        id:'',
        name: "",
        description: "",
        users: [],
        assign_all:false,
      },
      formType: ""
    };
  },

  mounted() {
  },

  created() {
    this.getCompanyUsers();
    this.emitter.on('open-new-workspace-popup', (evt) => {
      this.showCreateNewWorkSpacePopup(evt.type, evt.spaceData);
    })
    this.emitter.on("close-workspace-popup", this.closePopup);
  },
  computed: {
    ...mapGetters({
      companyUsers:"companyUsers",
      createSpaceFormErrors:"createSpaceFormErrors",
    }),

    usersList: function () {
      // this.companyUserslist.push({"id": 0 , "name": "Select " , "family_name":" All" });
      return this.companyUserslist.map(function (item) {
        return  {
          "value":item.id,
          "name":item.name + ' ' + item.father_name + ' ' + item.family_name
        }
      })
    }
  },
  methods: {
    ...mapActions({
      saveWorkspace: "saveWorkspace",
      UpdateWorkspace: "UpdateWorkspace",
      getCompanyUsers: "getCompanyUsers",
    }),
    showCreateNewWorkSpacePopup(type = null,spaceData = null) {
      this.$store.state.createSpaceFormErrors = {};
      this.formType = type;
      if(type == 'create') {
        this.resetFormInputs();
      } else {
        this.newWorkspace.id = spaceData ? spaceData.id : null;
        this.newWorkspace.name = spaceData ? spaceData.name : null;
        this.newWorkspace.description = spaceData ? spaceData.description : null;
      }
      this.companyUserslist = this.companyUsers;
      this.selectedUsers = spaceData ? this.getSelectedUsers(spaceData.users) : [];
      $("#newSpacePopup").modal("show");
    },

    createOrUpdateWorkspace() {
      let  selectedUsers = (this.selectedUsers != null || this.selectedUsers != undefined) ? this.setSelectedUsers(this.selectedUsers) : [];
      if(this.formType == 'create') {
        this.saveWorkspace({
          name: this.newWorkspace.name,
          description: this.newWorkspace.description,
          users: selectedUsers,
          assign_all: this.newWorkspace.assign_all
        });
      } else {
        this.UpdateWorkspace({
          id: this.newWorkspace.id,
          name: this.newWorkspace.name,
          description: this.newWorkspace.description,
          users: selectedUsers,
          assign_all: this.newWorkspace.assign_all
        });
      }
    },

    resetFormInputs() {
      this.newWorkspace.name = "";
      this.newWorkspace.description = "";
      this.newWorkspace.users = [];
    },


    setSelectedUsers(selectedItems=null) {
      let newArray = [];
      if(typeof selectedItems != null && typeof selectedItems === 'object') {
        selectedItems.forEach((element) => {
          if(Number.isInteger(element.value)) {
            newArray.push(element.value);
          }
        });
      }
      return newArray;
    },

    getSelectedUsers(selectedItems=null) {
      let newArray = [];
      if(typeof selectedItems != null && typeof selectedItems === 'object') {
        selectedItems.forEach((element) => {
          newArray.push({ "value":element.id, "name":element.name + ' ' + element.father_name + ' ' + element.family_name });
        });
      }
      return newArray;
    },

    getStringVal(val=null) {
      if(val !== null) {
        return val.toString();
      }
    },

    closePopup() {
      $("#newSpacePopup").modal("hide");
    },


  } ,

  watch: {
    'newWorkspace.users'(newValue)  {
      if(newValue == 0) {
        // this.newWorkspace.assign_all = true;
      }
    },

  }

};
</script>

<style>
div#TaskDetailPopup.modal.fade.show {
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
/*start responsive style*/
@media (max-width: 767.98px) {
  #newSpacePopup .modal-dialog.modal-dialog-centered.modal-lg{
    width: 85%;
    margin: 5% 7.5%;
}
}
</style>