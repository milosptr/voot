<template>
  <div class="">
    <div class="mb-4">
      <label for="content" class="block text-sm font-medium text-gray-700 mt-6 mb-1">Selected products</label>
      <div class="grid grid-cols-2 sm:grid-cols-3 gap-5 mt-2">
        <div v-for="product in addedProducts" class="relative rounded-md border border-gray-200 px-6 py-3 grid grid-cols-1 sm:grid-cols-2 justify-between items-center" :key="product.id">
          <div class="w-20 h-20 bg-contain bg-center bg-no-repeat rounded-md" :style="`background-image: url('/${product.featured_image ? product.featured_image.file_path : 'images/product-placeholder.png'}');`"></div>
          <h4 class="font-medium text-sm text-gray-800">{{ product.name }}</h4>
          <div class="absolute top-0 right-0 py-2 px-3 cursor-pointer" @click="removeProduct(product.id)">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#C70000" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><line x1="216" y1="56" x2="40" y2="56" fill="none" stroke="#C70000" stroke-linecap="round" stroke-linejoin="round" stroke-width="14"></line><line x1="104" y1="104" x2="104" y2="168" fill="none" stroke="#C70000" stroke-linecap="round" stroke-linejoin="round" stroke-width="14"></line><line x1="152" y1="104" x2="152" y2="168" fill="none" stroke="#C70000" stroke-linecap="round" stroke-linejoin="round" stroke-width="14"></line><path d="M200,56V208a8,8,0,0,1-8,8H64a8,8,0,0,1-8-8V56" fill="none" stroke="#C70000" stroke-linecap="round" stroke-linejoin="round" stroke-width="14"></path><path d="M168,56V40a16,16,0,0,0-16-16H104A16,16,0,0,0,88,40V56" fill="none" stroke="#C70000" stroke-linecap="round" stroke-linejoin="round" stroke-width="14"></path></svg>
          </div>
        </div>
      </div>
    </div>
   <div class="flex justify-between">
    <div tabindex="0" class="w-48 mr-3 text-center text-gray-600 border border-gray-400 bg-transparent px-6 py-2 mt-5 text-sm font-normal rounded-md hover:bg-gray-500 hover:text-white cursor-pointer" @keydown.enter="openModal" @click="openModal">
      Add product
    </div>
    <div tabindex="0" class="w-32 select-none text-center text-white border border-primary-light bg-primary-light px-6 py-2 mt-5 ml-auto text-sm font-normal rounded-md hover:bg-primary-lighter hover:text-white cursor-pointer" @keydown.enter="save" @click="save">
      Save
    </div>
   </div>
    <div v-if="showModal" class="fixed left-0 top-0 w-full h-screen flex items-center justify-center z-10">
      <div class="absolute left-0 top-0 bg-black opacity-50 w-full h-screen z-10"  @click="closeModal"></div>
      <div class="relative bg-white rounded-md w-full sm:w-1/2 p-12 z-20 search-product-modal-body">
        <div class="absolute top-0 right-0 inline-block z-20 p-3 cursor-pointer" @click="closeModal">
          <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#000000" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><line x1="200" y1="56" x2="56" y2="200" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="14"></line><line x1="200" y1="200" x2="56" y2="56" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="14"></line></svg>
        </div>
        <div>
          <input v-model="search" type="text" id="search" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Search for a product ..."  />
        </div>
        <div class="mt-6 overflow-scroll h-80p">
          <div v-for="product in products" class="flex items-center justify-between border-b border-gray-200 text-sm py-1" :key="product.id">
            <div class="w-14 font-medium">{{ product.id }}</div>
            <div class="mr-auto">{{ product.name }}</div>
            <div v-if="isAdded(product)" class="w-16 text-center py-1 bg-green-600 text-white rounded-md text-xs uppercase font-medium tracking-wider">Added</div>
            <div v-else class="w-16 text-center py-1 bg-primary-light text-white rounded-md text-xs uppercase font-medium tracking-wider cursor-pointer" @click="addProduct(product);">Add</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data: () => ({
      id: null,
      showModal: false,
      search: '',
      products: [],
      addedProducts: [],
    }),
    watch: {
      search(newValue) {
        if(newValue.length > 3)
          this.searchProducts()
        if(!newValue.length)
          this.products = []
      }
    },
    mounted() {
      axios.get('/api/config/homepage_products')
        .then((res) => {
          if(res.data.length) {
            let data = res.data.at(-1)
            this.id = data.id
            axios.post('/api/products/search', {ids: data.value, rawsearch: true})
              .then((res) => {
                this.addedProducts = res.data.data
              })
          }

        })
    },
    methods: {
      openModal() {
        this.showModal = true
        document.body.style.overflow = 'hidden'
      },
      closeModal() {
        this.showModal = false
        document.body.style.overflow = ''
      },
      addProduct(product) {
        this.addedProducts.push(product)
      },
      removeProduct(id) {
        this.addedProducts = this.addedProducts.filter((p) => p.id !== id)
      },
      isAdded(product) {
        return this.addedProducts.find((p) => p.id === product.id)
      },
      searchProducts() {
        axios.post('/api/products/search', { s: this.search, rawsearch: true })
          .then((res) => {
            this.products = res.data.data
          })
      },
      save() {
        axios.post('/api/config', { id: this.id, key: 'homepage_products', value: JSON.stringify(this.addedProducts.map((p) => p.id))})
          .then((res) => {
            this.$emit('saved')
          })
      },
    }
  }
</script>

<style scoped>
  .search-product-modal-body {
    height: 80vh;
    max-height: 80vh;
  }
  .h-80p {
    height: 80%;
    max-height: 80%;
  }
</style>
