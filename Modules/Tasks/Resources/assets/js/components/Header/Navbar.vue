<template>
  <div class="row mb-2">

    <div class="col-12"> <!-- start buttons main div -->
      <div class="row mb-2">
          <!-- buttons  for md and lg screens -->
          <!--    add workspace -->
            <div class="d-none  d-md-block text-center col-md-2" v-if="this.parentPage == 'workspaces'">
                <a @click="addNewWorkspace" class="btn btn-primary rounded-pill w-100 shadow-none "><i class="mdi mdi-plus"></i> {{ $t('modules.workspace')}}  </a>
            </div>
            <!--    add list  -->
            <div class="d-none d-md-block text-center col-md-2" v-if="this.parentPage == 'workspace'">
              <a @click="addNewList" class="btn btn-primary rounded-pill w-100 shadow-none"><i class="mdi mdi-plus"></i>   {{ $t('modules.list')}}
              </a>
            </div>
            <!-- add link -->
            <div class="d-none d-md-block text-center col-md-2" v-if="this.parentPage == 'workspace'">
              <a @click="addNewNewLink" class="btn btn-outline-primary m-0 rounded-pill shadow-none w-100"><i class="mdi mdi-plus"></i>
                {{ $t('modules.link')}}
              </a>
            </div>
            <!--    add task -->
            <div class="d-none d-md-block text-center col-md-2" v-if="this.parentPage == 'workspace'">
              <a @click="addNewNewTask" class="btn btn-outline-primary m-0 rounded-pill shadow-none w-100"><i class="mdi mdi-plus"></i>  {{ $t('modules.task')}}
              </a>
          </div>

          <!--  buttons for sm screens -->
          <!--    add workspace from mobile -->
          <div class="col-6 col-md-6 d-block d-md-none mt-1 text-center" v-if="this.parentPage == 'workspaces'">
            <a  @click="addNewWorkspace" class="btn btn-primary rounded-pill w-100 shadow-none "><i class="mdi mdi-plus"></i> {{ $t('modules.workspace')}}  </a>
          </div>
          <!--    add list from mobile -->
          <div class="col-4 col-md-4 d-block d-md-none mt-1 text-center" v-if="this.parentPage == 'workspace'">
            <a  @click="addNewList" class="btn btn-primary rounded-pill w-100 shadow-none "><i class="mdi mdi-plus"></i>  {{ $t('modules.list')}}  </a>
          </div>
        <!--    add link from mobile -->
        <div class="col-4 col-md-4 d-block d-md-none mt-1 text-center " v-if="this.parentPage == 'workspace'">
          <a  @click="addNewNewLink" class="btn btn-outline-primary m-0 rounded-pill shadow-none w-100 "><i class="mdi mdi-plus"></i>  {{ $t('modules.link')}}  </a>
        </div>
          <!--    add task from mobile  -->
          <div class="col-4 col-md-4 d-block d-md-none mt-1 text-center " v-if="this.parentPage == 'workspace'">
            <a  @click="addNewNewTask" class="btn btn-outline-primary m-0 rounded-pill shadow-none w-100"><i class="mdi mdi-plus"></i> {{ $t('modules.task')}} </a>
          </div>

          <div class="col-6">
            <div class="text-sm-end">
<!--                      <div class="btn-group mb-3">-->
<!--                        <button type="button" class="btn btn-primary">All</button>-->
<!--                      </div>-->
<!--                      <div class="btn-group mb-3 ms-1">-->
<!--                        <button type="button" class="btn btn-light">Ongoing</button>-->
<!--                        <button type="button" class="btn btn-light">Finished</button>-->
<!--                      </div>-->
<!--                      <div class="btn-group mb-3 ms-2 d-none d-sm-inline-block">-->
<!--                        <button type="button" class="btn btn-secondary"><i class="ri-function-line"></i></button>-->
<!--                      </div>-->
<!--                      <div class="btn-group mb-3 d-none d-sm-inline-block">-->
<!--                        <button type="button" class="btn btn-link text-muted"><i class="ri-list-check-2"></i></button>-->
<!--                      </div>-->
            </div>
          </div><!-- end col-->

      </div>
    </div> <!-- end buttons main div -->

  </div>
  <!-- end row-->
</template>

<script>
import { mapActions, mapGetters } from "vuex";

export default {
  name: "Navbar",
  emits: ['click'],

  props: {

    parentPage: {
      type: String,
      required: true
    },

  },

  computed: {
    ...mapGetters({
      activeworkspace: "activeworkspace",
    }),
  },

  created() {},

  methods: {
    ...mapActions({
      getActiveWorkspace: "getActiveWorkspace",
    }),

    addNewWorkspace(e) {
      e.preventDefault();
      this.emitter.emit("open-new-workspace-popup",{"type":"create","spaceData":null});
    },

    addNewList(e) {
      e.preventDefault();
      this.emitter.emit("open-new-list-popup", {"type":"create","listData":null});
    },

    addNewNewTask(e) {
      e.preventDefault();
      this.emitter.emit("open-new-task-popup", {"type":"create","taskData":null});
    },

    addNewNewLink(e) {
      e.preventDefault();
      this.emitter.emit("open-new-link-popup",{"type":"create","linkData":null});
    },
  } ,


}
</script>

<style scoped>

</style>