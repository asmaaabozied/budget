<template>

    <div class="input-group">
      <button type="button" @click="openIconPicker" class="btn btn-primary mx-1 text-sm" >
        <span v-if="! selectedIconPreview"> {{ label }} </span>
        <span  v-else :class="selectedIconPreview" > </span>
      </button>
      <input type="text"  @click="openIconPicker" :value="modelValue" v-model="selectedIcon"
             id="icon-picker" class="form-control"
      >
    </div>

</template>

<script>
import {ref, computed, watch, onMounted, defineEmits } from "vue";
// vanilla icon picker , to customize it we will not use the default from node_modules folder
// must import css files to make it work propaply , It should be imported here unless it will never appear
import 'vanilla-icon-picker/dist/themes/default.min.css'; // 'default' theme
import 'vanilla-icon-picker/dist/themes/bootstrap-5.min.css'; // 'bootstrap-5' theme
import IconPicker from 'vanilla-icon-picker';

export default {
  name: "vanillaIconPicker",
  emit: ['click','update:model-value','submit'],

  props: {
    modelValue: {
      type: String,
      default: '',
      required: true
    },
    label: {
      type: String,
      default: 'Choose Icon',
      required: false,
    },
  },

  setup() {
    const vanillaIconPicker = new IconPicker('input', {
      theme: 'bootstrap-5',
      // theme: 'default' | 'bootstrap-5',
      // iconSource: [
      //   'FontAwesome Brands 5',
      //   'FontAwesome Solid 5',
      //   'FontAwesome Regular 5',
      //   'Material Design Icons',
      //   'Iconoir',
      //   {
      //     key: 'academicons',
      //     prefix: 'ai ai-',
      //     url: 'https://raw.githubusercontent.com/iconify/icon-sets/master/json/academicons.json'
      //   }
      // ],

      iconSource: ['FontAwesome Brands 5', 'FontAwesome Solid 5', 'FontAwesome Regular 5'],

      // Close icon picker modal when icon is selected
      // If is `false` save button appear
      closeOnSelect: true,

      // Set a default value, preselect for example
      // icon's value and icon's name work
      defaultValue: null,

      // Translatable text
      i18n: {
        'input:placeholder': 'Search icon…',
        'text:title': 'Select icon',
        'text:empty': 'No results found…',
        'btn:save': 'Save'
      }
    });

    const selectedIcon = ref('')
    // const selectedIcon = ref(props.selectedIcon ?? null)

    const selectedIconPreview = computed(() => {
      if(selectedIcon != "" || selectedIcon != undefined) {
          return selectedIcon.value;
      }
      return null;
    })

    const openIconPicker = () => {
      // it is best icon picker for me,  https://github.com/AppoloDev/vanilla-icon-picker
          vanillaIconPicker.show();
    }

    const iconElementInput = document.querySelector('.input-group-text');

    vanillaIconPicker.on('select', (icon) => {
      selectedIcon.value = icon.value;
      handleChange(icon);

      // if (iconElementInput.innerHTML !== '') {
      //     iconElementInput.innerHTML = '';
      // }
      //
      // iconElementInput.className = `input-group-text ${icon.name}`;
      // iconElementInput.innerHTML = icon.svg;
    });

// Icon picker with `default` theme
    const iconPickerButton = new IconPicker('.btn', {
      theme: 'default',
      iconSource: ['FontAwesome Brands 5', 'FontAwesome Solid 5', 'FontAwesome Regular 5'],
      closeOnSelect: true
    });

    const iconElementButton = document.querySelector('.icon-selected-text');

    iconPickerButton.on('select', (icon) => {
      // iconElementButton.innerHTML = `Icon selected – name: <b>${icon.name}</b> & value: <b>${icon.value}</b>`;
    });

    const handleChange = (iconVal) => {
      emitter.emit("update-icon-value", {"iconVal":iconVal})
    }

    // watch(selectedIcon, (newVal) => emitter.emit('update:modelValue', newVal), { immediate: true })

    return {
      vanillaIconPicker,
      selectedIcon,
      selectedIconPreview,
      openIconPicker,
      iconElementInput,
      iconPickerButton,
      handleChange,

    }

  }, // setup

  mounted() {
    // mounted should be like this to define emits
  },

}
</script>

<style scoped>

</style>