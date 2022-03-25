<template>
  <div v-click-away="onClickOutside" :class="classes">
    <label class="text-gray-500 font-medium mt-6">
      {{ label }}
    </label>
    <div class="mt-1 relative">
      <button type="button" class="bg-white relative flex items-center border border-gray-300 rounded-md shadow-sm pl-3 pr-16 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" @click="show = !show">
        <div v-if="color && selected && selected.color" class="w-6 h-3 select-custom-color rounded-md mr-2" :class="'bg-' + selected.color.name"></div>
        <div class="truncate">
          {{ selectedText  }}
        </div>
        <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
          <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
          </svg>
        </span>
      </button>

      <ul v-show="show" class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm transition ease-in duration-100" tabindex="-1">
        <li
          v-for="(option, index) in options"
          class="text-gray-900 cursor-default select-none flex items-center relative py-2 pl-3 pr-9 hover:text-white hover:bg-primary-lighter"
          role="option"
          :class="{ 'bg-gray-100': selected && selected.id === option.id }"
          :key="index"
          @click="selectOption(option)"
        >
          <div v-if="color && option.color" class="w-6 h-3 rounded-md select-custom-color" :class="'bg-' + option.color.name"></div>
          <!-- Selected: "font-semibold", Not Selected: "font-normal" -->
          <div class="font-normal block truncate ml-2">
            {{ optionText(option) }}
          </div>

          <span v-if="selected && selected.id === option.id" class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-4">
            <!-- Heroicon name: solid/check -->
            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
          </span>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import { directive } from "vue3-click-away"

export default {
  directives: {
    ClickAway: directive
  },
  props: {
    firstDefault: {
      type: Boolean,
      default: () => false
    },
    classes: {
      type: String,
      default: () => null
    },
    label: {
      type: String,
      default: () => ''
    },
    options: {
      type: Array,
      default: () => [],
    },
    color: {
      default: () => false
    }
  },
  name: 'Select',
  data: () => ({
    show: false,
    selected: null,
  }),
  computed: {
    selectedText() {
      if(!this.selected)
        return 'Select option'
      if(!this.selected.value)
        return this.selected
      if(this.selected.value)
        return this.selected.value
    }
  },
  mounted() {
    if(this.firstDefault)
      setTimeout(() => {
        this.selected = this.options[0]
        this.$emit('selected', this.selected)
      }, 400);

  },
  methods: {
    onClickOutside() {
      this.show = false
    },
    optionText(option) {
      if(!option.value)
        return this.option
      if(option.value)
        return option.value
    },
    selectOption(option) {
      this.selected = option
      this.show = false
      this.$emit('selected', this.selected)
    }
  }
}
</script>

<style scoped>
  .min-w-36 {
    min-width: 9rem;
  }

  .select-custom-color {
    border: 1px solid #eee;
  }
</style>
