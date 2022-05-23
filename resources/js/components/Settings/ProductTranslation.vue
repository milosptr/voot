<template>
  <div class="mt-6">
    <div class="flex items-center mb-10">
      <div class="font-medium mr-3">
        Search for product:
      </div>
      <div class="relative w-1/3">
        <input v-model="search" type="text" id="products-category-search" name="search" placeholder="Type to search..."
          class="w-full group px-3 pl-10 py-2 text-sm font-normal rounded-md border-gray-500 bg-transparent"
          @input="searchProduct"
        />
        <div class="text-gray-500 absolute left-0 top-0 mt-2 ml-2">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>
      </div>
    </div>
    <div
      v-for="(product, index) in products"
      :key="product.id"
      class="flex items-center py-2 px-2 border-t border-b border-gray-100 hover:bg-gray-50 cursor-pointer"
      @click="openProductModal(product)"
    >
      <div class="w-10 mr-2">{{ index }}.</div>
      <div class="font-medium">
        {{ product.name }}
      </div>
      <div class="ml-auto">
        <span class="text-gray-600">EN name: </span>
        <span class="font-medium" :class="[ hasName(product.english_name) ? 'text-green-500' : 'text-red-500']">{{ hasName(product.english_name) ? 'Yes' : 'No' }}</span>
      </div>
      <div class="ml-2">
        <span class="text-gray-600">EN desc: </span>
        <span class="font-medium" :class="[ hasDesc(product.english_description)  ? 'text-green-500' : 'text-red-500']">{{ hasDesc(product.english_description) ? 'Yes' : 'No' }}</span>
      </div>
    </div>
    <ProductTranslationModal v-if="showModal" :product="activeProduct" @close="showModal = false" />
  </div>
</template>

<script>
import ProductTranslationModal from './ProductTranslationModal.vue'
  export default {
  components: { ProductTranslationModal },
    data: () => ({
      search: '',
      products: [],
      activeProduct: {},
      showModal: false,
    }),
    mounted() {
    },
    methods: {
      hasName(name) {
        return name && name.length
      },
      hasDesc(desc) {
        return desc && desc.length
      },
      openProductModal(product) {
        this.activeProduct = product
        this.showModal = true
      },
      searchProduct() {
        if(this.search.length > 3)
          axios.post('/api/products/search', { s: this.search, type: 'json' })
            .then((res) => {
              this.products = res.data
            })
      }
    }
  }
</script>

<style scoped>
  input,
  [type='checkbox']:focus {
    outline: none!important;
  }
</style>
