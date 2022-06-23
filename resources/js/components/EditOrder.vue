<template>
  <div class="">
     <div v-for="product in products" :key="product.id">
        <div v-if="!product.edit" class="flex items-center gap-4 border-b border-gray-200 text-gray-700 py-1 px-3">
          <img :src="productFeaturedImage(product)" width="24" :alt="product.name" />
          <a :href="'/product/'+ product.slug" target="_blank">{{ product.name }} <span class="font-medium">x {{ product.qty }}</span></a>
          <div class="flex items-center justify-center ml-auto">
            <div class="flex items-center justify-center cursor-pointer" @click="product.edit = true;editing = true">
              <svg class="w-5 h-5 text-primary-lighter" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            </div>
            <div class="ml-5 flex items-center justify-center cursor-pointer" @click="removeProduct(product)">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><line x1="216" y1="56" x2="40" y2="56" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line><line x1="104" y1="104" x2="104" y2="168" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line><line x1="152" y1="104" x2="152" y2="168" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line><path d="M200,56V208a8,8,0,0,1-8,8H64a8,8,0,0,1-8-8V56" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><path d="M168,56V40a16,16,0,0,0-16-16H104A16,16,0,0,0,88,40V56" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path></svg>
            </div>
          </div>
        </div>
        <div v-else class="flex items-center gap-4 border-b border-gray-200 text-gray-700 py-1 px-3">
          <img :src="productFeaturedImage(product)" width="24" :alt="product.name" />
          <input
            v-model="product.sku"
            type="text"
            class="sm:text-sm py-0 px-4 border-1 border-gray-200 rounded-md text-gray-700"
            @input="checkSKU($event, product)"
          />
          <input
            v-model="product.qty"
            type="text"
            class="w-24 sm:text-sm py-0 px-4 border-1 border-gray-200 rounded-md text-gray-700"
          />
          <div v-if="product.sku_not_valid" class="text-red-500 text-sm ml-auto font-medium">SKU not valid</div>
        </div>
      </div>
      <div
        v-if="!hasInvalidSKU"
        class="absolute bottom-0 left-0 mb-6 ml-4 w-24 text-center text-white border border-primary-lighter bg-primary-lighter px-6 py-2 text-sm font-normal rounded-md hover:bg-primary-light"
        @click="updateOrder"
      >
        Save
      </div>
      <div
        v-else
        class="edit-order-save-btn absolute bottom-0 left-0 mb-6 ml-4 w-24 text-center text-white bg-primary-lighter bg-opacity-50 px-6 py-2 text-sm font-normal rounded-md"
      >
        Save
        <div class="w-64 relative">
          <div class="tooltip-left-arrow absolute top-0 left-0 -mt-6 ml-24 w-full py-1 px-3 rounded-md bg-gray-400 text-sm text-white">
            Can't save with invalid SKU
          </div>
        </div>
      </div>
  </div>
</template>

<script>
  export default {
    data: () => ({
      orderId: null,
      order: [],
      products: [],
      editing: false,
    }),
    computed: {
      hasInvalidSKU() {
        return !!this.products.find((p) => p.sku_not_valid)
      },
    },
    mounted() {
      this.orderId = document.getElementById('edit-order').dataset.order
      this.getOrder()
    },
    methods: {
      productFeaturedImage(product) {
        const media = product.media.find((m) => m.featured_image)
        if(media && media.featured_image)
          return '/' + media.file_path
        return '/images/product-placeholder.png'
      },
      getOrder() {
        axios.get(`/api/orders/${this.orderId}/products`)
        .then((res) => {
          this.products = res.data.data.products.map((p) => {
            p.qty = res.data.data.order.find((o) => o.sku === p.sku).qty
            return p
          })
          this.order = res.data.data.order
        })
      },
      checkSKU(e,p) {
        axios.get('/api/check-sku/' + e.target.value)
          .then((res) => {
            p.sku_not_valid = !res.data.status
          })
      },
      removeProduct(product) {
        this.products = this.products.filter((p) => p.id !== product.id)
      },
      updateOrder() {
        const order = this.products.map((p) => ({ 'sku': p.sku, 'qty': p.qty }))
        axios.post(`/api/request-order/change/${this.orderId}`, order)
          .then(() => {
            this.getOrder()
          })
      },
    }
  }
</script>

<style scoped>
  .tooltip-left-arrow {
    opacity: 0;
    transition: all .3s ease-in-out;
  }
  .edit-order-save-btn:hover .tooltip-left-arrow {
    opacity: 1;
  }
  .tooltip-left-arrow:before {
    content: '';
    position: absolute;
    left: -9px;
    top: 8px;
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 6px 10px 6px 0;
    border-color: transparent #a1a1aa transparent transparent;
  }
</style>
