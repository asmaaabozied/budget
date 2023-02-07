<template>
  <div class="d-flex">
    <img class="me-2 rounded" :src="historyItem.user.image_path" :alt="historyItem.user.name + ' ' + historyItem.user.father_name + ' ' + historyItem.user.family_name" height="16">
    <div class="w-100">
      <h6 class="m-0">
        {{ historyItem.message }}
      </h6>
      <p class="text-muted"><small> By : {{ historyItem.user.name + ' ' + historyItem.user.father_name + ' ' + historyItem.user.family_name   }} <span class="">⚬</span>
        <span> {{ historyItem.performed_at }} </span> </small>
      </p>
<!--      <p class="text-muted" v-for="(item, index) in historyItem.meta">-->
<!--          <small v-for="(subItem, subIndex) in item['old']">  <span>  </span>-->
<!--            <small  v-for="(subSubItem, subSubIndex) in subItem">-->
<!--                {{ subSubItem }}-->
<!--            </small>-->
<!--          </small>-->
<!--      </p>-->
    </div>
  </div>
</template>

<script>
export default {
  name: "HistoryItem",

  props: {
    historyItem:{
      type:Object,
      required: true
    },
  },

  data() {
    return {
    }
  },

}
</script>


<style scoped>

</style>