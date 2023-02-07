<template>
  <div class="content-page0">
    <div class="content">

      <!-- Start Content-->
      <div class="container-fluid">

        <bread-crumbs
            :home-link="homeLink"
            :home-title="homeTitle"
            :main-title="mainTitle"
            :task-link="taskLink"
            :sub-title="subTitle"
            :sub-sub-title="getworkspacename"
            :page-title="pageTitle"
            :curent-space="$route.params.id"
        ></bread-crumbs>

        <navbar
            parent-page="workspace"
        ></navbar>
        <div class="row">

          <links> </links>

          <div class="col-12 mb-4">

            <div class="board">
              <!--              <draggable-->
              <!--                  v-model="spacelists"-->
              <!--                  :list="spacelists"-->
              <!--                  :id="'workspace'+getworkspace"-->
              <!--                  class="row flex-nowrap"-->
              <!--              >-->
              <!--                <transition-group>-->
              <template v-for="(listItem, index) in spacelists"  :key="index">
                <list
                    :workspace="getworkspace"
                    :list="listItem"
                    :list-id="listItem.id"
                ></list>
              </template>
              <!--                </transition-group>-->
              <!--              </draggable>-->
            </div>
          </div> <!-- end .board-->
        </div>

      </div> <!-- container -->

    </div> <!-- content -->

    <new-task-list-popup> </new-task-list-popup>
    <task-popup> </task-popup>
    <task-detail-popup> </task-detail-popup>
    <Link-popup> </Link-popup>

  </div>
</template>

<script>
import {ref, computed, watch, onMounted, toRefs, toRef, defineEmits, inject, watchEffect} from "vue";
import {useStore} from "vuex";
import {useI18n} from 'vue-i18n'
import {useRouter, useRoute} from 'vue-router'
import draggable from "vuedraggable";
import Taskitem from "./Taskitem.vue";
import list from "./Tasklist.vue";
import TaskDetailPopup from './popups/TaskDetailPopup.vue'
import BreadCrumbs from "./Header/BreadCrumbs.vue";
import Navbar from "./Header/Navbar.vue";
import NewTaskListPopup from "./popups/NewTaskListPopup.vue";
import TaskPopup from "./popups/TaskPopup.vue"
import LinkPopup from "./popups/LinkPopup.vue"
import Links from "./WorkspaceLinks/Links.vue"

export default {
  name: "Workspace",
  props: ["workspace"],

  components: {
    Taskitem,
    list,
    TaskDetailPopup,
    BreadCrumbs,
    Navbar,
    NewTaskListPopup,
    TaskPopup,
    draggable,
    LinkPopup,
    Links
  },

  setup(props, context) {

    const router = useRouter()
    const route = useRoute()
    const store = useStore()
    const {t} = useI18n()
    const emitter = inject('emitter');
    const showAlertMsg = true
    const currentBoard = 'workspace'
    const currentPage = t('breadcrumbs.workspace')
    const parentPage = 'workspace'
    const homeLink = window.dashboardUrl + '/ar/dashboard'
    const homeTitle = t('breadcrumbs.home')
    const taskLink = window.dashboardUrl + '/ar/dashboard/tasks'
    const mainTitle = t('breadcrumbs.tasks_app')
    const subTitle = t('breadcrumbs.workspaces')
    const subSubTitle = ''
    const pageTitle = t('breadcrumbs.tasks_list')
    // const showModal = route.meta.showModal
    const showModal = route.params.taskSlug
    const param = route.params.id
    const taskSlug = route.params.taskSlug
    const boardName = ref('')

    const getActiveWorkspace = store.dispatch('getActiveWorkspace', {
      space_id: route.params.id,
    });

    const getworkspace = computed(() => {
      return store.getters ? store.getters.activeworkspace
          : store.getters.allworkspaces.find(b => b.id == param);
    })

    const getworkspacename = store.getters.activeworkspace ? store.getters.activeworkspace.name : ref('');

    const spacelists = computed(() => {

      // with fallback to avoid any errors
      return store.getters.activeworkspace ? store.getters.activeworkspace.statuses
          : store.getters.allworkspaces.find(b => b.id == param).lists;
    })

    const openTaskDetailPopoup = (taskSlug) => {
      if ((typeof taskSlug != undefined && typeof taskSlug == 'string')) {
        this.emitter.emit("open-task-detail-popup", {"taskSlug": taskSlug});
      }
    }

    onMounted(() => {
      openTaskDetailPopoup(route.params.taskSlug);
    }) // onMounted

    // watchers
    watch(currentBoard, (currentValue, oldValue) => {
      getActiveWorkspace({
        workspace: currentValue
      });
    });

    // watch(activeworkspace, (currentValue, oldValue) => {
    // });

    watch(route, (currentValue, oldValue) => {
      if(currentValue.params.taskSlug != undefined) {
            openTaskDetailPopoup(currentValue);
      }
    })

    return {
      showAlertMsg,
      currentBoard,
      currentPage,
      parentPage,
      homeLink,
      homeTitle,
      taskLink,
      mainTitle,
      subTitle,
      subSubTitle,
      pageTitle,
      showModal,
      param,
      taskSlug,
      boardName,
      getworkspace,
      spacelists,
      openTaskDetailPopoup,
      getActiveWorkspace
    }
  }
}

</script>

<style lang="scss" scoped>
@media (max-width: 767.98px){
  .tasks {
    display: inline-block;
    width: 16rem;
    padding: 0 0.3rem 0.3rem 0.6rem;
  }
  .font-20 {
    font-size: 14px!important;
  }
  .tasks.tasks:not(:last-child) {
    //margin-right: 1rem;
  }
  span.badge.task-priority {
    padding: 2px 5px !important;
    border-radius: 2px;
  }
}

</style>