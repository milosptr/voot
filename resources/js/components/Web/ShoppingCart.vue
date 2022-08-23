<template>
  <div class="flex flex-col sm:flex-row items-start">
    <div class="w-full sm:w-2/3 pr-0 sm:pr-6">
      <div v-if="!cart.length" class="">
        <h1>Shopping cart is empty. Please add some products!</h1>
        <a href="/vorur" class="block w-2/5 mt-6 text-center text-gray-600 border border-gray-200  px-6 py-2 text-sm font-normal rounded-md hover:bg-gray-200 cursor-pointer">
          View Products
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
            <select class="block w-full pl-3 pr-8 py-1.5 text-sm border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
              @change="updateProductQty($event, product)">
              <option v-for="option in Array.from({length: 100}, (_, i) => i + 1)" :key="option" :value="option" :selected="product.qty === option">
                {{ option }}
              </option>
            </select>
          </div>
          <div class="ml-0 sm:ml-8 text-red-400 cursor-pointer" @click="removeProduct(index)">
            <img src="/images/trash.svg" alt="remove" class="w-5 h-5" />
          </div>
      </div>
      <div  v-if="products.length" class="text-base font-medium text-gray-900 pb-3 mt-10">
        Leave a note
      </div>
      <textarea
        v-if="products.length"
        v-model="note"
        class="w-full border border-gray-300 outline-none rounded-md"
        placeholder="Your note..."
      ></textarea>
    </div>
    <div class="w-full sm:w-1/3 pl-0 sm:pl-6">
      <div v-if="customer" class="bg-gray-100 rounded-md p-6">
        <h3 class="text-base font-medium text-gray-900 border-b border-gray-200 pb-3 mb-6">Customer info</h3>
        <div class="flex justify-between">
          <p class="text-sm text-gray-500 font-medium">Name:</p>
          <p class="text-sm text-gray-500">{{ customer.name }}</p>
        </div>
        <div class="flex justify-between mt-3">
          <p class="text-sm text-gray-500 font-medium">Address:</p>
          <p class="text-sm text-gray-500">{{ customer.street }}, {{ customer.city }} {{ customer.zip }}, {{ customer.country }}</p>
        </div>
        <div class="flex justify-between mt-3">
          <p class="text-sm text-gray-500 font-medium">Email:</p>
          <p class="text-sm text-gray-500">{{ customer.email }}</p>
        </div>
        <div class="flex justify-between mt-3">
          <p class="text-sm text-gray-500 font-medium">Phone:</p>
          <p class="text-sm text-gray-500">{{ customer.phone }}</p>
        </div>
        <div class="flex justify-between mt-3">
          <p class="text-sm text-gray-500 font-medium">SSN:</p>
          <p class="text-sm text-gray-500">{{ customer.ssn }}</p>
        </div>
        <h3 class="text-base font-medium text-gray-900 border-b border-gray-200 pb-3 my-6">Order info</h3>
        <div class="mt-3">
          <p class="text-sm text-gray-500 font-medium">Shipping method:</p>
          <div class="flex gap-6 text-sm mt-3">
            <div class="w-1/2 border-2 border-gray-200 justify-center py-2 rounded-md flex gap-2 cursor-pointer text-gray-400" :class="{ 'bg-gray-200 text-gray-900': shippingMethod === 1 }" @click="changeShippingMethod(1)">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><path d="M176,80h42.6a7.9,7.9,0,0,1,7.4,5l14,35" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path><line x1="16" y1="144" x2="176" y2="144" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></line><circle cx="188" cy="192" r="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></circle><circle cx="68" cy="192" r="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></circle><line x1="164" y1="192" x2="92" y2="192" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></line><path d="M44,192H24a8,8,0,0,1-8-8V72a8,8,0,0,1,8-8H176V171.2" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path><path d="M176,120h64v64a8,8,0,0,1-8,8H212" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path></svg>
              <span>Delivery</span>
            </div>
            <div class="w-1/2 border-2 border-gray-200 justify-center py-2 rounded-md flex gap-2 cursor-pointer text-gray-400" :class="{ 'bg-gray-200 text-gray-900': shippingMethod === 2 }" @click="changeShippingMethod(2)">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><path d="M48,139.6V208a8,8,0,0,0,8,8H200a8,8,0,0,0,8-8V139.6" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path><path d="M54,40H202a8.1,8.1,0,0,1,7.7,5.8L224,96H32L46.3,45.8A8.1,8.1,0,0,1,54,40Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path><path d="M96,96v16a32,32,0,0,1-64,0V96" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path><path d="M160,96v16a32,32,0,0,1-64,0V96" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path><path d="M224,96v16a32,32,0,0,1-64,0V96" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path></svg>
              <span>Pickup</span>
            </div>
          </div>
        </div>
        <div v-if="shippingMethod === 1">
          <div class="flex flex-col mt-3">
            <p class="text-sm text-gray-500 font-medium">Shipping to:</p>
            <p class="text-sm text-gray-500 w-2/3">{{ shippingAddress }}</p>
          </div>
          <div class="flex justify-between mt-3">
            <p v-if="!changeShipping" class="text-sm text-primary-lighter font-medium underline cursor-pointer" @click="changeShipping = true">Change Shipping Address</p>
            <p v-if="changeShipping" class="text-sm text-gray-500 font-medium">New address:</p>
            <p v-if="changeShipping" class="text-sm text-gray-500 w-2/3">
              <input v-model="newShippingAddress" type="text" name="address" placeholder="Shipping to..." class="w-full border-t-0 border-l-0 border-r-0 outline-none bg-transparent text-sm p-0 m-0 mb-0 px-1 border-gray-200 placeholder-gray-300" />
            </p>
          </div>
        </div>
        <div v-if="shippingMethod === 2" class="mt-3">
          <p class="text-sm text-gray-500 font-medium">Pickup in:</p>
          <div class="flex flex-col gap-2 mt-3">
            <div v-for="l in pickupLocations" :key="l.id" class="text-sm text-gray-500 flex gap-2 items-center cursor-pointer" @click="selectPickupLocation(l.id)">
              <input type="radio" name="pickup" :id="'pickup-' + l.id" class="focus:ring-0 h-4 w-4 text-primary-lighter border-gray-300" />
              <label :for="'pickup-' + l.id">{{ l.address }}, {{ l.zip }}, {{ l.city }}</label>
            </div>
          </div>
        </div>
        <div class="flex justify-between mt-3 relative">
          <p class="text-sm text-gray-500 font-medium">{{ shippingMethod === 1 ? 'Shipping' : 'Pickup' }} date:</p>
          <p class="text-sm text-gray-500 w-2/3">{{ shippingDateText }} <span class="underline text-primary-lighter cursor-pointer font-medium" @click="showCalendar = true">(change)</span></p>
          <div v-if="showCalendar" class="absolute bottom-0 right-0">
            <DatePicker
              v-model="shippingDate"
              :min-date="new Date()"
              @dayclick="calendarClick"
            />
          </div>
        </div>
        <div class="mt-6">
          <div
            v-if="requestingOrder"
            class="flex justify-center items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 cursor-pointer"
          >
            Requesting...
          </div>
          <div
            v-else
            class="flex justify-center items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 cursor-pointer"
            @click="requestOrder"
          >
            Request Order
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import dayjs from 'dayjs'
  import { Calendar, DatePicker } from 'v-calendar'

  export default {
    data: () => ({
      cart: [],
      user_id: null,
      customer: null,
      products: [],
      note: '',
      pickupLocation: 1,
      pickupLocations: [],
      shippingMethod: 1,
      changeShipping: false,
      newShippingAddress: null,
      shippingDate: null,
      showCalendar: false,
      requestingOrder: false,
    }),
    components: {
      Calendar,
      DatePicker,
    },
    computed: {
      shippingAddress() {
        return this.customer.street + ', ' + this.customer.city + ' ' + this.customer.zip + ', ' + this.customer.country
      },
      shippingDateText() {
        if(this.shippingDate)
          return dayjs(this.shippingDate).format('DD MMMM YYYY')
        return 'To Be Determined'
      }
    },
    mounted() {
      if(document.getElementById('cart').value) {
        const cart = JSON.parse(document.getElementById('cart').value)
        this.cart = cart ? JSON.parse(cart.cart) : []
        this.user_id = cart.user_id
        const skus = this.cart.map((c) => c.sku).join(',')
        axios.get(`/api/cart-products/?p=${skus}`)
          .then((res) => {
            this.products = res.data.map((product) => {
              const sku = this.getSKU(product)
              const qty = this.cart.find((p) => p.sku === sku)
              product.qty = qty ? qty.qty : 1
              return product;
            })
          })
        axios.get(`/api/customer-info/${cart.user_id}`)
          .then((res) => {
            this.customer = res.data.data
          })
        axios.get('/api/locations')
          .then((res) => {
            this.pickupLocations = res.data
          })
      }
    },
    methods: {
      selectPickupLocation(id) {
        this.pickupLocation = id
      },
      changeShippingMethod(method) {
        this.shippingMethod = method
      },
      calendarClick(e) {
        this.showCalendar = false
      },
      featuredImage(product) {
        if(product.featured_image)
          return product.featured_image.file_path
        if(product.media.length)
          return product.media[0].file_path
        return 'images/product-placeholder.png'
      },
      variantsText(variants) {
        return variants.map((v) => v.name).join(' / ')
      },
      getSKU(product) {
        return product.product_variations ? product.product_variations.sku : product.sku
      },
      updateProductQty(e, product) {
        const sku = this.getSKU(product)
        const currentQty = this.cart.find((c) => c.sku === sku).qty
        axios.post('/api/add-to-cart', { user_id: this.user_id, sku, qty: e.target.value - currentQty })
          .then((r) => location.reload() )
      },
      removeProduct(index) {
       this.cart.splice(index, 1)

        axios.post(`/api/add-to-cart/${this.user_id}`, this.cart)
          .then((r) => location.reload() )
      },
      requestOrder() {
        this.requestingOrder = true
        const data = {
          shippingMethod: this.shippingMethod,
          shippingAddress: this.newShippingAddress,
          shippingDate: this.shippingDate,
          pickupLocation: this.shippingMethod === 2 ? this.shippingMethod : null,
          note: this.note,
        }
        axios.post(`/api/request-order/${this.customer.id}`, data)
          .then(() => {
            location.href = '/thank-you'
          })
      }
    }

  }
</script>
