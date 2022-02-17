<template>
  <ProductVariations v-if="variations.length" :variations="variations" @add="addVariant()" />
</template>

<script>
import ProductOptions from './ProductOptions.vue';
import ProductVariations from './ProductVariations.vue';

export default {
  components: {
    ProductOptions,
    ProductVariations,
  },
  data: () => ({
    variations: [{}],
  }),
  watch: {
    variations: {
      deep: true,
      handler: (variations) => {
        document.getElementById('all_variations').setAttribute('value', JSON.stringify(variations))
      }
    }
  },
  mounted() {
    const productid = document.getElementById('variations-app').dataset.productid
    axios.get(`/api/product-variations/${productid}`)
      .then((res) => {
        this.variations = res.data
        this.variations.push({})

      })
  },
  methods: {
    addVariant() {
      this.variations.push({})
    },
    updateVariations() {
      if(this.optionValues[0][0]) {
        const clearedValues = this.optionValues.map((a) => a.filter((v) => v.value))
        this.optionValues = []
        this.variations +=
          clearedValues.reduce((a,b) =>
            a.flatMap((x) =>
              b.map((y) => {
                const value = x.value ? (x.value + (x ? ' / ' : '') + y.value) : y.value
                const option = x.option ? (x.option + (x ? ' // ' : '') + y.option) : y.option

                return { value, option, sku: null, name: value }
              })
            )
          ,[''])
      }
    }
  }
}
</script>
