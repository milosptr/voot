<template>
  <div>
    <div class="text-gray-500 font-medium">{{ variation[0].option }}</div>
      <div class="flex items-center gap-2 mt-1">
        <div v-for="(variant, i) in variations" :key="'variant-' + i">
          {{ variant[0] }}
          <div
              class="border border-transparent bg-gray-50 py-1 px-8 text-sm uppercase text-gray-600 font-medium tracking-wider text-center rounded-md cursor-pointer"
              :class="{ 'border-primary-lighter text-primary-lighter': isSelected(variant.value), 'opacity-25 select-none': isDisabled(variant) }"
              @click="selectVariant(variant)"
              >
              {{ variant.value }}
          </div>
        </div>
      </div>
  </div>
</template>

<script>
  export default {
    props: {
      variation: Object,
      selected: Object,
    },
    data: () => ({
      options: [],
      disabled: [],
    }),
    computed: {
      variations() {
        return Object.entries(_.groupBy(this.variation, 'value')).map((v) => {
          return { option: this.variation[0].option, value: v[0], skus: v[1].map((s) => s.sku)}
        })
      }
    },
    mounted() {
    },
    methods: {
      isSelected(value) {
        return this.options.value === value
      },
      isDisabled(variant) {
        if(this.selected.length && this.selected[0].option !== variant.option) {
          return !this.selected[0].skus.some((s) => variant.skus.includes(s))
        }
        return false
      },
      selectVariant(v) {
        if(!this.isDisabled(v)) {
          this.options = v
          this.$emit('select', v)
        }
      },
    }
  }
</script>
