<template>
  <div>
    <!-- Modal -->
    <div
      class="modal fade "
      id="teamPopup"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-dialog-zoom" role="document">
        <div class="modal-content">

            <div class="modal-header">
              <h5
                class="modal-title"
                id="exampleModalLabel"
              >Team Setting </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam voluptatum rem, assumenda dolorum ratione facilis facere delectus ullam quae, harum molestias praesentium et alias, numquam deserunt ab nulla soluta eius.</p>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";
export default {
  name: "TeamPopup",
  data() {
    return {
      newworkspace: {
        name: "",
        description: "",
        id: ""
      },
      formType: ""
    };
  },
  created() {
    this.emitter.on("open-team-popup", this.showTeamPopup);
    this.emitter.on("closePopup", this.closePopup);
  },
  methods: {

    showTeamPopup() {
      $("#teamPopup").modal("show");
    },

    closePopup() {
      $("#teamPopup").modal("hide");
    }
  }
};
</script>

<style scoped>


</style>
