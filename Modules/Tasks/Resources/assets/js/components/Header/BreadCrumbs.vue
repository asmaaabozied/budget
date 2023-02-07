<template>
  <div class="row">
    <div class="col-12 d-block">
      <div class="page-title-box">
        <div class="page-title-right">
          <ol class="breadcrumb m-0">
            <li class="breadcrumb-item" v-if="this.homeLink"><a  :href="this.homeLink">  {{ this.homeTitle }} </a></li>
            <li class="breadcrumb-item" v-if="this.mainTitle"> <a :href="this.taskLink"> {{ this.mainTitle }} </a>  </li>
            <li class="breadcrumb-item" v-if="this.subTitle"> <router-link :to="{ name: 'workspaces'}">  <a > {{ this.subTitle }} </a> </router-link> </li>
            <li class="breadcrumb-item" v-if="this.subSubTitle">  <a > {{ this.subSubTitle }} </a> </li>
            <li class="breadcrumb-item active" v-if="this.pageTitle"> {{ this.pageTitle }} </li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "BreadCrumbs",

  props: {
    homeLink: String,
    homeTitle: String,
    mainTitle: String,
    taskLink: String,
    subTitle: String,
    subSubTitle: String,
    pageTitle: String,
    curentSpace: [String, Number],
  },

  data() {
    return {}
    },


}
</script>

<style scoped>

</style>