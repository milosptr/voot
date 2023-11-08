<template>
  <div class="flex flex-col sm:flex-row items-start">
    <div class="w-full pr-0 sm:pr-6">
      <div v-if="!cart.length" class="">
        <div class="font-bold">Innkaupakarfan er tóm. Vinsamlegast bættu við nokkrum vörum!</div>
        <a href="/vorur" class="small-caps uppercase block w-2/5 mt-6 text-center text-gray-600 border border-gray-200  px-6 py-2 text-sm font-normal rounded-md hover:bg-gray-200 cursor-pointer">
          Skoða vörur
        </a>
      </div>
      <div v-for="(product, index) in products" :key="index"
        class="w-full flex items-center border-b border-gray-200 py-2" :class="{'border-t': index === 0}">
          <div class="w-16 h-16 bg-center bg-contain bg-no-repeat" :style="`background-image: url('/${featuredImage(product)}')`" ></div>
          <div class="flex flex-col ml-10">
            <a :href="'product/' + product.slug" target="_blank" class="font-medium tracking-wide text-gray-800 hover:text-primary-lighter duration-300 ease-in-out">
              {{ product.name }}
            </a>
            <div class="flex flex-col sm:flex-row">
              <div v-for="(c, i) in product.categories" :key="i">
                <a v-if="c.available" :href="c.slug" target="_blank" class="text-sm mr-2 text-gray-400 hover:text-primary-lighter duration-300 ease-in-out">
                  {{ c.name }}{{ i <  product.categories.length - 1? ', ' : '' }}
                </a>
              </div>
            </div>
          </div>
          <div class="ml-auto">
            <input type="number" v-model="product.qty" @blur="updateProductQty(product)" class="block w-32 pl-3 pr-3 py-1.5 text-sm border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md appearance-none" />
          </div>
          <div class="ml-0 sm:ml-8 text-red-400 cursor-pointer" @click="removeProduct(product)">
            <img :src="'/images/trash.svg'" alt="remove" class="w-5 h-5" />
          </div>
      </div>
      <div v-if="cart.length" class="flex justify-end">
        <a href="/checkout" class="inline-block mt-4 small-caps uppercase px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 cursor-pointer">
          Panta
        </a>
      </div>
    </div>
  </div>
</template>

<script>
  import 'v-calendar/dist/style.css'

  export default {
    data: () => ({
      cart: [],
      user_id: null,
      products: [],
      skus: []
    }),
    mounted() {
      if(document.getElementById('cart').value) {
        const cart = document.getElementById('cart').value
        const key = document.getElementById('cart').dataset.key
        this.cart = cart ? JSON.parse(cart) : []
        this.user_id = key
        this.skus = this.cart.map((c) => c.sku)
        this.fetchProducts()
      }
    },
    methods: {
      fetchProducts() {
        axios.get(`/api/cart-products`)
          .then((res) => {
            this.products = res.data.map((product) => {
              const sku = this.getSKU(product)
              const qty = this.cart.find((p) => p.sku === sku)
              product.qty = qty ? qty.quantity : 1
              product.cart = this.cart.find((p) => p.sku === sku)?.id
              return product;
            })
          })
      },
      featuredImage(product) {
        if(typeof product.product_variations === 'object' && product.product_variations?.file_path)
          return product.product_variations.file_path.replace(/^\/|\/$/g, '')
        if(product.featured_image)
          return product.featured_image.file_path
        if(product.media.length)
          return product.media[0].file_path
        return 'images/product-placeholder.png'
      },
      getSKU(product) {
        return product.product_variations ? product.product_variations.sku : product.sku
      },
      updateProductQty(product) {
        const sku = this.getSKU(product)
        const cart = this.cart.find((c) => c.sku === sku)
        const currentQty = cart ? cart.quantity : 0
        cart.quantity = product.qty
        if(currentQty !== product.qty)
          axios.post(`/api/update-cart/${cart.id}`, cart)
            .then((r) => this.fetchProducts())
      },
      removeProduct(product) {
        axios.delete(`/api/remove-cart/${product.cart}`)
          .then((r) => {
            this.skus = this.skus.filter((s) => s !== product.sku)
            this.fetchProducts()
          })
      },
    },
  }
</script>
