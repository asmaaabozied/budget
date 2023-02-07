<template>
  <div>
    <!-- Modal -->
    <div
        class="modal fade task-modal-content"
        id="linkPopup"
        tabindex="-1"
        role="dialog"
        aria-labelledby="NewListkModalLabel"
        aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <form @submit.prevent="createOrUpdateLink()">
            <div class="modal-header">
              <h5
                  class="modal-title"
                  id="NewListkModalLabel"
              > {{$t('forms.labels.create_new_link')}} </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
              <div class="row">

                <div class="col-12 col-md-12 position-relative mb-3">
                  <label for="l-name" class="form-label">{{$t('forms.labels.name')}}</label>
                  <div class="form-group">
                    <input
                        type="text"
                        v-model="LinkItems.name"
                        class="form-control"
                        id="l-name"
                        :class="[ linkFormErrors['name'] ? 'is-invalid' : '']"
                        placeholder="Link Name"
                    />
                    <div v-show="linkFormErrors['name']" class="text-danger invalid-feedback"> {{ getStringVal(linkFormErrors['name']) }} </div>
                  </div>
                </div>

                <div class="col-12 col-md-6 position-relative mb-3">

                  <label for="l-icon" class="form-label"> {{$t('forms.labels.link_icon')}} <i class="text-xxl-center picked-icon"
                      :class="selectedIcon"> </i>
                  </label>
                  <div class="form-group">
                    <vanilla-icon-picker :model-value="LinkItems.icon" > </vanilla-icon-picker>
                  
                    <div v-show="linkFormErrors['icon']" class="text-danger invalid-feedback"> {{ getStringVal(linkFormErrors['icon']) }}
                    </div>
                  </div>
                  </div>
                  
                  <div class="col-12 col-md-6 position-relative mb-3">
                    <label for="l-icon_color" class="form-label"> {{$t('forms.labels.color')}}</label>
                    <div class="form-group">
                      <input type="color" v-model="picedIcon.icon_color" class="form-control" id="l-icon_color"
                        :class="[ linkFormErrors['icon_color'] ? 'is-invalid' : '']" placeholder="Select Icon Color" />
                      <div v-show="linkFormErrors['color']" class="text-danger invalid-feedback"> {{
                        getStringVal(linkFormErrors['icon_color']) }} </div>
                    </div>
                  </div>
                  
                  <div class="col-md-12 position-relative mb-3">
                    <label for="l-link" class="form-label">{{$t('forms.labels.URL')}} </label>
                    <div class="form-group">
                      <input type="text" v-model="LinkItems.link" class="form-control" id="l-link"
                        :class="[ linkFormErrors['link'] ? 'is-invalid' : '']" placeholder="Link Url" />
                      <div v-show="linkFormErrors['link']" class="text-danger invalid-feedback"> {{ getStringVal(linkFormErrors['link'])
                        }} </div>
                    </div>
                  </div>
                  
                  <div class="col-md-12 position-relative mb-3">
                    <label for="l-notes" class="form-label"> {{$t('forms.labels.notes')}} </label>
                    <div class="form-group">
                      <input type="text" v-model="LinkItems.notes" class="form-control" id="l-notes"
                        :class="[ linkFormErrors['notes'] ? 'is-invalid' : '']" placeholder="Link Notes" />
                      <div v-show="linkFormErrors['notes']" class="text-danger invalid-feedback"> {{ getStringVal(linkFormErrors['notes'])
                        }} </div>
                    </div>
                  </div>
                  
                  </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{$t('forms.btns.cancel')}}</button>
                    <button type="submit" class="btn btn-primary">{{$t('forms.btns.save')}}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import vanillaIconPicker from '../AddOns/vanilla-icon-picker/vanillaIconPicker.vue'

export default {
  name: "LinkPopup",
  emits: ['click'],

  components: {
    'vanilla-icon-picker':vanillaIconPicker
  },
  data() {
    return {
      picedIcon: {
        class: undefined,
        unicode: undefined,
        icon_color: '#000',
      },
      LinkItems: {
        id:"",
        name: "",
        link: "#",
        icon: "",
        icon_color: "icon_color",
        space_id: "",
        parent_id: null,
        notes: "",
      },
      formType: ""
    };
  },

  created() {
    this.emitter.on('open-new-link-popup', (evt) => {
      this.setupLinkItem(evt.type, evt.linkData);
    })
    this.emitter.on("close-link-popup", this.closePopup);

    this.emitter.on('update-icon-value', (evt) => {
      this.updateIconValue(evt.iconVal);
    })
  },

  computed: {
    ...mapGetters({
      linkFormErrors: "linkFormErrors",
      isLoading: "isLoading",
    }),

    selectedIcon() {
      return 'fab fa-' + this.picedIcon.class;
    },

  }, //close computed

  methods: {
    ...mapActions({
      createNewLink: "createNewLink",
      updateLink: "updateLink"
    }),

    setupLinkItem(type,LinkData = null) {
      this.$store.state.linkFormErrors = {};
      this.formType = type;
      if(type == 'create') {
        this.resetFormInputs();
      } else {
        this.LinkItems.id = LinkData ? LinkData.id : "";
        this.LinkItems.name = LinkData ? LinkData.name : "";
        this.LinkItems.link = LinkData ? LinkData.link : "#";
        this.LinkItems.icon = LinkData ? LinkData.icon : "";
        this.LinkItems.icon_color = LinkData ? LinkData.icon_color : "";
        this.picedIcon.class = LinkData ? LinkData.icon : "";
        this.picedIcon.icon_color = LinkData ? LinkData.icon_color : "";
        this.LinkItems.parent_id = LinkData ? LinkData.parent_id : null;
        this.LinkItems.notes = LinkData ? LinkData.notes : "";
      }
      $("#linkPopup").modal("show");
    },

    createOrUpdateLink() {
      if(this.formType == 'create') {
        this.createNewLink({
          space_id: this.$route.params.id,
          name: this.LinkItems.name,
          link: this.LinkItems.link,
          icon: this.LinkItems.icon,
          icon_color: this.LinkItems.icon_color,
          parent_id: this.LinkItems.parent_id,
          notes: this.LinkItems.notes,
        });
      } else {
        this.updateLink({
          id: this.LinkItems.id,
          space_id: this.$route.params.id,
          name: this.LinkItems.name,
          link: this.LinkItems.link,
          icon: pickedIconClass,
          icon_color: this.LinkItems.icon_color,
          parent_id: this.LinkItems.parent_id,
          notes: this.LinkItems.notes,
        });
      }
    },

    resetFormInputs() {
      this.LinkItems.id = "";
      this.LinkItems.space_id = "";
      this.LinkItems.name = "";
      this.LinkItems.link = "";
      this.LinkItems.icon = "";
      this.LinkItems.icon_color = "";
      this.LinkItems.parent_id = "";
      this.LinkItems.notes = "";
    },

    closePopup() {
      $("#linkPopup").modal("hide");
    },

    getStringVal(val=null) {
      if(val !== null) {
        return val.toString();
      }
    },

    updateIconValue(iconVal) {
      // update icon val from child
      this.LinkItems.icon = iconVal ? iconVal.value : "";

    }


  }, // close methods

  watch: {

   'picedIcon.class'(newValue) {
    }

  }

};
</script>

<style scoped>
/*for font aweasome icons picker*/
.picked-icon {
  font-size: 2em !important;
}

input.form-control[type="color"] {
  width:100% !important;
}
/*start responsive style*/
@media (max-width: 767.98px) {
  #linkPopup .modal-dialog.modal-dialog-centered.modal-lg{
    width: 85%;
    margin: 5% 7.5%;
}
}

</style>