<template>
  <div>
    <div class="flex gap-10 mt-8">
      <Select v-if="variations.length" :label="currentLocale == 'is' ? 'Veldu' : 'Select'" :options="variations" :color="true" classes="min-w-150" :firstDefault="true" @selected="selectVariant($event)" />
      <Select :label="quantityTranslated" :options="qtyOptions" :firstDefault="true" @selected="qty = $event.value" />
      <div class="w-auto flex flex-col items-center cursor-pointer">
        <label class="text-gray-500 font-medium hidden lg:block">
          {{ currentLocale == 'is' ? 'Uppáhaldsvörur' : 'Favourites' }}
        </label>
        <div class="mt-6 lg:mt-0">
          <svg v-if="favourite" xmlns="http://www.w3.org/2000/svg" class="mt-1.5 w-8 h-8 inline-block" fill="#000000" viewBox="0 0 256 256" @click="removeFromFavourites"><rect width="256" height="256" fill="none"></rect><path d="M239.2,97.4A16.4,16.4,0,0,0,224.6,86l-59.4-4.1-22-55.5A16.4,16.4,0,0,0,128,16h0a16.4,16.4,0,0,0-15.2,10.4L90.4,82.2,31.4,86A16.5,16.5,0,0,0,16.8,97.4,16.8,16.8,0,0,0,22,115.5l45.4,38.4L53.9,207a18.5,18.5,0,0,0,7,19.6,18,18,0,0,0,20.1.6l46.9-29.7h.2l50.5,31.9a16.1,16.1,0,0,0,8.7,2.6,16.5,16.5,0,0,0,15.8-20.8l-14.3-58.1L234,115.5A16.8,16.8,0,0,0,239.2,97.4Z"></path></svg>
          <svg v-else xmlns="http://www.w3.org/2000/svg" class="mt-1.5 w-8 h-8 inline-block" fill="#000000" viewBox="0 0 256 256" @click="addToFavourites"><rect width="256" height="256" fill="none"></rect><path d="M132.4,190.7l50.4,32c6.5,4.1,14.5-2,12.6-9.5l-14.6-57.4a8.7,8.7,0,0,1,2.9-8.8l45.2-37.7c5.9-4.9,2.9-14.8-4.8-15.3l-59-3.8a8.3,8.3,0,0,1-7.3-5.4l-22-55.4a8.3,8.3,0,0,0-15.6,0l-22,55.4a8.3,8.3,0,0,1-7.3,5.4L31.9,94c-7.7.5-10.7,10.4-4.8,15.3L72.3,147a8.7,8.7,0,0,1,2.9,8.8L61.7,209c-2.3,9,7.3,16.3,15,11.4l46.9-29.7A8.2,8.2,0,0,1,132.4,190.7Z" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path></svg>
        </div>
      </div>
    </div>
    <div v-if="error" class="mt-3 mb-3 text-sm border border-red-600 bg-red-400 text-white rounded-md px-4 py-2">
      {{ error }}
    </div>
    <div class="flex items-center gap-2">
      <button type="submit" class="mt-8 w-full lg:w-1/2 text-center text-white border border-primary-lighter bg-primary-lighter px-6 py-2 font-medium rounded-md hover:bg-primary-light cursor-pointer shadow-sm" @click="addToCart">
        {{ addToCartLabel }}
      </button>
    </div>
  </div>
</template>

<script>
import SingleProductVariationsItem from './SingleProductVariationsItem.vue'
import Select from './common/Select.vue'

  export default {
  components: { SingleProductVariationsItem, Select },
    data: () => ({
      variations: [],
      selected: null,
      defaultSKU: null,
      error: null,
      user_id: null,
      product_id: null,
      favourite: false,
      quantityTranslated: 'Quantity',
      qty: 1,
      qtyOptions: [],
      addToCartLabel: 'Add to Cart',
    }),
    watch: {
      selected: {
        handler() {
          this.error = null
        },
        deep: true,
      }
    },
    computed: {
      currentLocale() {
        return window.current_locale
      },
    },
    mounted() {
      this.user_id = document.getElementById('single-product-variations').getAttribute('key')
      this.product_id = document.getElementById('single-product-variations').getAttribute('index')
      this.defaultSKU = document.getElementById('single-product-variations').getAttribute('sku')
      this.quantityTranslated = document.getElementById('single-product-variations').getAttribute('qty')
      this.variations = JSON.parse(document.getElementById('single-product-variations').getAttribute('variations'))
      this.addToCartLabel = document.getElementById('single-product-variations').getAttribute('addtocart')
      if(this.variations.length)
        this.selectVariant(this.variations[0].sku)
      axios.get('/api/favourites/' + this.product_id + '/' + this.user_id)
        .then((res) => {
          this.favourite = res.data.length
        })
      this.qtyOptions = Array.from({length: 100}, (_, i) => ({ id: i, value: i + 1 }))
    },
    methods: {
      addToFavourites() {
        axios.post('/api/favourites', { product_id: this.product_id, user_id: this.user_id })
          .then(() => {
            this.favourite = !this.favourite
          })
      },
      removeFromFavourites() {
        axios.delete('/api/favourites/' + this.product_id + '/' + this.user_id)
          .then(() => {
            this.favourite = false
          })
      },
      selectVariant(variant) {
        document.getElementById('single-product-sku').innerHTML = variant.sku
        this.selected = variant
        if(variant.file_path) {
          document.querySelector('.single-product-bigimage-url').dataset.zoom = variant.file_path
          document.querySelector('.single-product-bigimage-url').style = `background-image: url('${variant.file_path}')`
        }
      },
      addToCart() {
        this.error = null
        axios.post('/api/add-to-cart', { user_id: this.user_id, sku: this.selected ? this.selected.sku : this.defaultSKU, qty: this.qty })
          .then((r) => location.reload() )
      }
    }
  }
</script>
