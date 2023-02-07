<template>

  <div class="card mb-1 shadow-none border">
    <div class="p-2">
      <div class="align-items-center justify-content-center row">
        <div class="col-auto">
          <div class="avatar-sm">
                                                        <span class="avatar-title rounded">
                                                            .{{ file.mime_type }}
                                                        </span>
          </div>
        </div>
        <div class="col ps-0">
          <a href="javascript:void(0);" class="font-12 mb-1 mt-2 text-muted "> {{ file.file_name }} </a>
          <p class="font-12 mb-1 mt-2 text-muted "> {{ moment(file.created_at).format('D-M-Y h:mm A') }} </p>
        </div>
        <div class="col col-3 text-center">
          <!-- Button -->
          <a :href="file.custom_properties.full_url" target="_blank" class="btn btn-link btn-lg text-muted p-0">
            <span class=""> {{ file.custom_properties.human_readable_size }} </span>  &nbsp   <i class="pl-2 ri-download-2-line"></i>
          </a>
        </div>
      </div>
    </div>
  </div>

</template>
<script>
import { mapActions, mapGetters } from "vuex";

export default {
  name: "FileItem",

  props: {
    file:{
      type:Object,
      required: true
    },
  },

  data() {
    return {

    }
  },

  methods: {
    ...mapActions({}),
  },

}
</script>

<style scoped>

</style>