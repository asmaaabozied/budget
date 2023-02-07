<template>
  <div>
    <!-- Modal -->
    <div
        class="modal fade task-modal-content"
        id="newListPopup"
        tabindex="-1"
        role="dialog"
        aria-labelledby="NewListkModalLabel"
        aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <form @submit.prevent="createOrUpdateList()">
            <div class="modal-header">
              <h5
                  class="modal-title"
                  id="NewListkModalLabel"
              > {{$t('forms.labels.create_new_list_tasks_status')}} </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12 position-relative mb-3">
                  <label for="l-name" class="form-label">{{$t('forms.labels.list_name')}} </label>
                  <div class="form-group">
                    <input
                        type="text"
                        v-model="newTaskList.name"
                        class="form-control"
                        id="l-name"
                        :class="[ createListFormErrors['name'] ? 'is-invalid' : '']"
                        placeholder="Task List Name"
                    />
                    <div v-show="createListFormErrors['name']" class="text-danger invalid-feedback"> {{ getStringVal(createListFormErrors['name']) }} </div>
                  </div>
                </div>

                <div class="col-12 col-md-6 position-relative mb-3">
                  <label for="l-color" class="form-label">{{$t('forms.labels.color')}} </label>
                  <div class="form-group">
                    <input
                        type="color"
                        v-model="newTaskList.color"
                        class="form-control"
                        id="l-color"
                        :class="[ createListFormErrors['color'] ? 'is-invalid' : '']"
                        placeholder="Task List Name"
                    />
                    <div v-show="createListFormErrors['color']" class="text-danger invalid-feedback"> {{ getStringVal(createListFormErrors['color']) }} </div>
                  </div>
                </div>

                <div class="col-12 col-md-6 position-relative mb-3">
                  <label for="l-position" class="form-label">{{$t('forms.labels.order')}} </label>
                  <div class="form-group">
                    <input
                        type="number"
                        v-model="newTaskList.position"
                        class="form-control"
                        id="l-position"
                        :class="[ createListFormErrors['position'] ? 'is-invalid' : '']"
                        placeholder=" List position"
                    />
                    <div v-show="createListFormErrors['position']" class="text-danger invalid-feedback"> {{ getStringVal(createListFormErrors['position']) }} </div>
                  </div>
                </div>

              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{$t('forms.btns.cancel')}}</button>
              <button type="submit" class="btn btn-primary">{{$t('forms.btns.save')}} </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";

export default {
  name: "NewTaskListPopup",
  data() {
    return {
      newTaskList: {
        id:"",
        name: "",
        color: "#1f2e6a",
        position: "",
      },
      formType: ""
    };
  },
  created() {
    this.emitter.on('open-new-list-popup', (evt) => {
      this.showCreateNewListPopup(evt.type, evt.listData);
    })
    this.emitter.on("close-list-popup", this.closePopup);
  },

  computed: {
    ...mapGetters({
      createListFormErrors: "createListFormErrors",
      isLoading: "isLoading",
    }),
  },

  methods: {
    ...mapActions({
      createNewTaskList: "createNewList",
      updateList: "updateList"
    }),

    showCreateNewListPopup(type,listData = null) {
      this.$store.state.createListFormErrors = {};
      this.formType = type;
      if(type == 'create') {
        this.resetFormInputs();
      } else {
        this.newTaskList.id = listData ? listData.id : "";
        this.newTaskList.name = listData ? listData.name : "";
        this.newTaskList.color = listData ? listData.color : "#1f2e6a";
        this.newTaskList.position = listData ? listData.position : "";
      }
      $("#newListPopup").modal("show");
    },

    createOrUpdateList() {
      if(this.formType == 'create') {
        this.createNewTaskList({
          space_id: this.$route.params.id,
          name: this.newTaskList.name,
          color: this.newTaskList.color,
          position: this.newTaskList.position,
        });
      } else {
        this.updateList({
          id: this.newTaskList.id,
          space_id: this.$route.params.id,
          name: this.newTaskList.name,
          color: this.newTaskList.color,
          position: this.newTaskList.position,
        });
      }
    },

    resetFormInputs() {
      this.newTaskList.id = "";
      this.newTaskList.space_id = "";
      this.newTaskList.name = "";
      this.newTaskList.color = "";
      this.newTaskList.position = "";
    },


    closePopup() {
      $("#newListPopup").modal("hide");
    },

    getStringVal(val=null) {
      if(val !== null) {
        return val.toString();
      }
    },
  }
};
</script>

<style>
/*start responsive style*/
@media (max-width: 767.98px) {
  #newListPopup
  .modal-dialog.modal-dialog-centered.modal-lg {
  width: 85%;
  margin: 0%7.5%;
}}
</style>