<template>
  <!--  to do : data containers just for first list to make drugable works propably -->
  <div class="tasks bg-light">

    <div :style="{ 'border-color': list.color + '!important' }"
      class="align-items-center bg-white border-4 border-top d-flex justify-content-between p-2 rounded-2 task-header text-capitalize text-center">
      <h5 class="m-0 font-14 text-dark" :class="list.color" > {{ list.name }} ( {{ listCount }} ) </h5>
      <div class="dropdown card-widgets">
        <a href="#" class="text-muted dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="font-18 mdi mdi-dots-vertical"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
          <a href="javascript:void(0);" @click="editListItem(list)" class="dropdown-item"><i
              class="mdi mdi-pencil me-1"></i> {{$t('forms.btns.edit')}}</a>
          <a href="javascript:void(0);" @click="deleteList(list)" class="dropdown-item"><i
              class="mdi mdi-delete me-1"></i>{{$t('forms.btns.delete')}}</a>
        </div>
      </div>

    </div>

    <div class="task-list-items">
      <draggable v-model="tasks" :list="tasks" group="taskList" :animation="300" :id="'list-' + listId"
                 @add="onAdd" @change="onUpdate" @remove="onRemove">
            <template #item="{ element: taskItem }">
                <Taskitem :item="taskItem" :parent-id="listId"  :list="list"  :workspace="workspace" />
            </template>
      </draggable>
    </div> <!-- end company-list-1-->
  </div> <!-- end col -->

</template>

<script>
import { ref, computed, watch, onMounted, toRefs, toRef,defineEmits,inject, watchEffect } from "vue";
import draggable from "vuedraggable";
import Taskitem from "./Taskitem.vue";
import { useStore } from "vuex";

export default {
  name :"Tasklist",
  emits: ['click'],

  components: {
    Taskitem,
    draggable,
  },

  props: {
    workspace: {
      type: Object,
      required:false
    },
    list: {
      type: Object,
      required: false
    },
    listId: {
      type: Object,
      required: false
    },
    ind: {
      type: Number,
      required: false
    },
  },

  setup(props, context) {

    const store = useStore()
    const emitter = inject('emitter');
    const currentList = ref('')
    const newOrderedTasks = ref('')

    // const { listtt } = toRefs(props)
    const list = toRef(props, 'list')

    const draft = ref([])

    const tasks = computed(() => props.list.tasks)
    const listCount = computed(() => props.list.tasks.length)
    onMounted(() =>
        console.log("mounted"),
    )

    const editListItem = (listData) => (
        emitter.emit("open-new-list-popup", {"type": "edit", "listData": listData})
    );

    const onAdd = (event) => {
      console.log('this is list on add', tasks);
      store.dispatch("reorderListTasks", ({
        "tasks": tasks.value , "new_status_id":props.listId,"space_id": props.workspace.id
      }))
    };

    const onRemove = (event) => {
      store.dispatch("reorderListTasks",({
        "tasks": tasks.value , "new_status_id":props.listId,"space_id": props.workspace.id
      }))
  };

    const onUpdate = (event) => {
      // to avoid issues , do not make any changes for lists here
      store.dispatch("reorderListTasks", ({
        "tasks": tasks.value , "new_status_id":props.listId,"space_id": props.workspace.id
      }))
    };

    return {
      currentList,
      newOrderedTasks,
      tasks,
      draft,
      list,
      listCount,
      editListItem,
      onAdd,
      onRemove,
      onUpdate,

      activeworkspace: computed(() => store.getters.activeworkspace),
      isLoading: computed(() => store.state.isLoading),

      reorderListTasks: () => store.dispatch('reorderListTasks'),
      deleteList: (listData) => store.dispatch('deleteList',{
        id: listData.id,
        space_id: listData.space_id,
      }),

    }

  }, // setup

}

</script>

<style lang="scss">
.tasks {
border: 1px solid var(--ct-input-border-color);
  padding: 0 !important;
  transition: .5s all ease-in-out;
    .task-header {
      position: sticky;
      top: 0px;
      z-index: 5;
      margin: 0;
    }
  
  
  
    .card-widgets.dropdown {
      line-height: 12px;
    }
  
    box-shadow: var(--ct-box-shadow-sm);
  }
  
  .avatar-xs {
    object-fit: cover;
    border: 1px solid var(--ct-card-border-color);
  }
  
  span.badge.task-priority {
  
    color: #fff;
    text-transform: capitalize;
    padding: 5px 12px !important;
    border-radius: 3px;
  
    &.high {
      background: orange;
    }
  
    &.medium {
      background: #b7b706;
    }
  
    &.low {
      background: #047104;
    }
  
    &.normal {
      background: gray;
    }
  
    &.highest {
      background: red;
  }

}
.task-list-items {
  min-height: 100px;
  position: relative;
  border: 1px solid var(--ct-input-border-color);
  max-height: 75vh;
  overflow-y: auto;
  overflow-x: hidden;
  transition: .5s all ease-in-out;
  padding: 0 10px 10px;
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
.board{
  &::-webkit-scrollbar-track {
    box-shadow: none !important;
    border-radius: 0 !important;
    background: var(--ct-thumbnail-border-color);
  }

  

  &::-webkit-scrollbar {
    width: 7px !important;
    height: 4px !important;
  }

  &::-webkit-scrollbar-thumb {
    border-radius: 35px !important;
    -webkit-box-shadow: none !important;
    background: transparent;
    box-shadow: none !important;
  }

   &::-webkit-scrollbar-track {
    box-shadow: none !important;
    border-radius: 0 !important;
    background: var(--ct-thumbnail-border-color);
  }



  &::-webkit-scrollbar {
    width: 7px !important;
  }

  &::-webkit-scrollbar-thumb {
    border-radius: 35px !important;
    -webkit-box-shadow: none !important;
    background: var(--ct-form-range-thumb-disabled-bg);
    box-shadow: none !important;
  }

  
}
@media (max-width: 767.98px){
  .font-20 {
    font-size: 15px!important;
}
}
</style>
