<template>
  <div class="flex flex-col sm:flex-row items-start">
    <div class="w-full sm:w-2/3 pr-0 sm:pr-6">
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
          <div class="ml-0 sm:ml-8 text-red-400 cursor-pointer" @click="removeProduct(index)">
            <img :src="'/images/trash.svg'" alt="remove" class="w-5 h-5" />
          </div>
      </div>
      <div  v-if="products.length" class="text-base font-medium text-gray-900 pb-3 mt-10">
        {{ translateItem('leave_a_note') }}
      </div>
      <textarea
        v-if="products.length"
        v-model="note"
        class="w-full border border-gray-300 outline-none rounded-md"
        :placeholder="translateItem('your_note') + '...'"
      ></textarea>
    </div>
    <div v-if="products.length" class="w-full sm:w-1/3 pl-0 sm:pl-6">
      <div v-if="customer" class="bg-gray-100 rounded-md p-6">
        <div class="text-base font-medium text-gray-900 border-b border-gray-200 pb-3 mb-6">{{ translateItem('customer_info') }}</div>
        <div class="flex items-center justify-between">
          <p class="text-sm text-gray-500 font-medium">{{ translateItem('name') }}:</p>
          <p v-if="companies.length > 1" class="text-sm text-gray-500" @change="selectDifferentCompany">
            <select class="block w-full pl-3 pr-8 py-1.5 ml-4 text-sm border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
              <option v-for="c in companies" :key="c.id" :value="c.key">{{ c.name }}</option>
            </select>
          </p>
          <p v-else class="text-sm text-gray-500">{{ customer.name }}</p>
        </div>
        <div class="flex justify-between mt-3">
          <p class="text-sm text-gray-500 font-medium">{{ translateItem('address') }}:</p>
          <p class="text-sm text-gray-500 text-right">{{ customer.street }}</p>
        </div>
        <div class="flex justify-between mt-3">
          <p class="text-sm text-gray-500 font-medium">Borg, zip, land:</p>
          <p class="text-sm text-gray-500 text-right">{{ customer.city }} {{ customer.zip }}, {{ customer.country }}</p>
        </div>
        <div class="flex justify-between mt-3">
          <p class="text-sm text-gray-500 font-medium">{{ translateItem('email') }}:</p>
          <p class="text-sm text-gray-500">{{ customer.email }}</p>
        </div>
        <div class="flex justify-between mt-3">
          <p class="text-sm text-gray-500 font-medium">{{ translateItem('phone') }}:</p>
          <p class="text-sm text-gray-500">{{ customer.phone }}</p>
        </div>
        <div class="flex justify-between mt-3">
          <p class="text-sm text-gray-500 font-medium">{{ translateItem('ssn') }}:</p>
          <p class="text-sm text-gray-500">{{ customer.ssn }}</p>
        </div>
        <div class="text-base font-medium text-gray-900 border-b border-gray-200 pb-3 my-6">{{ translateItem('order_info') }}</div>
        <div class="mt-3">
          <p class="text-sm text-gray-500 font-medium">{{ translateItem('shipping_method') }}:</p>
          <div class="flex gap-6 text-sm mt-3">
            <div class="w-1/2 border-2 border-gray-200 justify-center py-2 rounded-md flex gap-2 cursor-pointer text-gray-400" :class="{ 'bg-gray-200 text-gray-900': shippingMethod === 1 }" @click="changeShippingMethod(1)">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><path d="M176,80h42.6a7.9,7.9,0,0,1,7.4,5l14,35" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path><line x1="16" y1="144" x2="176" y2="144" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></line><circle cx="188" cy="192" r="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></circle><circle cx="68" cy="192" r="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></circle><line x1="164" y1="192" x2="92" y2="192" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></line><path d="M44,192H24a8,8,0,0,1-8-8V72a8,8,0,0,1,8-8H176V171.2" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path><path d="M176,120h64v64a8,8,0,0,1-8,8H212" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path></svg>
              <span>{{ translateItem('delivery') }}</span>
            </div>
            <div class="w-1/2 border-2 border-gray-200 justify-center py-2 rounded-md flex gap-2 cursor-pointer text-gray-400" :class="{ 'bg-gray-200 text-gray-900': shippingMethod === 2 }" @click="changeShippingMethod(2)">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><path d="M48,139.6V208a8,8,0,0,0,8,8H200a8,8,0,0,0,8-8V139.6" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path><path d="M54,40H202a8.1,8.1,0,0,1,7.7,5.8L224,96H32L46.3,45.8A8.1,8.1,0,0,1,54,40Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path><path d="M96,96v16a32,32,0,0,1-64,0V96" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path><path d="M160,96v16a32,32,0,0,1-64,0V96" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path><path d="M224,96v16a32,32,0,0,1-64,0V96" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path></svg>
              <span>{{ translateItem('pickup') }}</span>
            </div>
          </div>
        </div>
        <div v-if="shippingMethod === 1" class="my-3">
          <select
            class="block w-full pl-3 pr-8 py-1.5 text-sm border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
            @change="updateShippingCode"
          >
            <option v-for="code in shippingCodes" :key="code.id" :value="code.id" :selected="selectedShippingCode === code.id">{{ code.name }}</option>
          </select>
        </div>
        <div v-if="shippingMethod === 1">
          <div class="flex flex-col mt-3">
            <p class="text-sm text-gray-500 font-medium">{{ translateItem('shipping_to') }}:</p>
            <p class="text-sm text-gray-500 w-2/3">{{ shippingAddress }}</p>
          </div>
          <div class="flex justify-between mt-3">
            <p v-if="!changeShipping" class="text-sm text-primary-lighter font-medium underline cursor-pointer" @click="changeShipping = true">
              {{ translateItem('change_shipping_address') }}
            </p>
            <p v-if="changeShipping" class="text-sm text-gray-500 font-medium">{{ translateItem('new_address') }}:</p>
          </div>
          <p v-if="changeShipping" class="text-sm text-gray-500 mt-1">
            <input v-model="newShippingAddress" type="text" name="address" :placeholder="translateItem('shipping_to') + '...'" class="w-full border-t-0 border-l-0 border-r-0 bg-transparent text-sm p-0 m-0 mb-0 px-1 border-gray-200 placeholder-gray-300 outline-none focus:ring-0 focus:outline-none" />
          </p>
        </div>
        <div v-if="shippingMethod === 2" class="mt-3">
          <p class="text-sm text-gray-500 font-medium">{{ translateItem('pickup_in') }}:</p>
          <div class="flex flex-col gap-2 mt-3">
            <div v-for="l in pickupLocations" :key="l.id" class="text-sm text-gray-500 flex gap-2 items-center cursor-pointer" @click="selectPickupLocation(l.id)">
              <input type="radio" name="pickup" :id="'pickup-' + l.id" class="focus:ring-0 h-4 w-4 text-primary-lighter border-gray-300" />
              <label :for="'pickup-' + l.id">{{ l.address }}, {{ l.zip }}, {{ l.city }}</label>
            </div>
          </div>
        </div>
        <div class="flex flex-col justify-between mt-3 relative">
          <p class="text-sm text-gray-500 font-medium">{{ shippingMethod === 1 ? translateItem('delivery_date') : translateItem('pickup_date') }}:</p>
          <p class="text-sm text-gray-500 w-2/3">{{ shippingDateText }} <span class="underline text-primary-lighter cursor-pointer font-medium" @click="showCalendar = true">({{ translateItem('change') }})</span></p>
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
            class="flex justify-center items-center small-caps uppercase px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 cursor-pointer"
            @click="requestOrder"
          >
            {{ translateItem('request_order') }}
          </div>
        </div>
      </div>
    </div>
    <div v-if="requestingOrder" class="fixed left-0 top-0 w-full h-screen z-50 flex items-center justify-center">
      <div class="absolute left-0 top-0 w-full h-screen bg-black opacity-10"></div>
      <div class="relative flex flex-col items-center justify-center gap-5 bg-white rounded-lg shadow p-10">
        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
          width="40" height="50" viewBox="0 0 24 30" style="enable-background:new 0 0 50 50;" xml:space="preserve">
          <rect x="0" y="13" width="4" height="5" fill="#4f46e5">
            <animate attributeName="height" attributeType="XML"
              values="5;21;5"
              begin="0s" dur="0.6s" repeatCount="indefinite" />
            <animate attributeName="y" attributeType="XML"
              values="13; 5; 13"
              begin="0s" dur="0.6s" repeatCount="indefinite" />
          </rect>
          <rect x="10" y="13" width="4" height="5" fill="#4f46e5">
            <animate attributeName="height" attributeType="XML"
              values="5;21;5"
              begin="0.15s" dur="0.6s" repeatCount="indefinite" />
            <animate attributeName="y" attributeType="XML"
              values="13; 5; 13"
              begin="0.15s" dur="0.6s" repeatCount="indefinite" />
          </rect>
          <rect x="20" y="13" width="4" height="5" fill="#4f46e5">
            <animate attributeName="height" attributeType="XML"
              values="5;21;5"
              begin="0.3s" dur="0.6s" repeatCount="indefinite" />
            <animate attributeName="y" attributeType="XML"
              values="13; 5; 13"
              begin="0.3s" dur="0.6s" repeatCount="indefinite" />
          </rect>
        </svg>
        <div class="font-semibold">Sendir pöntun...</div>
      </div>
    </div>
  </div>
</template>

<script>
  import 'v-calendar/dist/style.css'
  import dayjs from 'dayjs'
  import { Calendar, DatePicker } from 'v-calendar'

  export default {
    data: () => ({
      cart: [],
      user_id: null,
      customer: null,
      selectedCustomer: null,
      selectedShippingCode: 'VM',
      products: [],
      companies: [],
      note: '',
      pickupLocation: 1,
      pickupLocations: [],
      shippingCodes: [
        { id: 'VM', name: 'Flytjandi' },
        { id: 'HOP', name: 'Suðurnes' },
        { id: 'SS', name: 'Sent með sölumanni' },
        { id: 'PO', name: 'Póstur' },
      ],
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
        return this.translateItem('tbd')
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
            this.selectedCustomer = this.customer.key
          })
        axios.get('/api/locations')
          .then((res) => {
            this.pickupLocations = res.data
          })
        axios.get('/api/customer/'+ this.user_id +'/companies')
          .then((res) => {
            this.companies = res.data.data
          })
      }
    },
    methods: {
      selectDifferentCompany(e) {
        this.selectedCustomer = e.target.value
      },
      selectPickupLocation(id) {
        this.pickupLocation = id
      },
      changeShippingMethod(method) {
        this.shippingMethod = method
        this.selectedShippingCode = method === 1 ? 'VM' : 'VS'
      },
      calendarClick(e) {
        this.showCalendar = false
      },
      updateShippingCode(e) {
        this.selectedShippingCode = e.target.value
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
      variantsText(variants) {
        return variants.map((v) => v.name).join(' / ')
      },
      getSKU(product) {
        return product.product_variations ? product.product_variations.sku : product.sku
      },
      updateProductQty(product) {
        const sku = this.getSKU(product)
        const currentQty = this.cart.find((c) => c.sku === sku).qty
        if(currentQty !== product.qty)
          axios.post('/api/add-to-cart', { user_id: this.user_id, sku, qty: product.qty - currentQty })
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
          shippingMethodCode: this.selectedShippingCode,
          shippingDate: this.shippingDate,
          pickupLocation: this.shippingMethod === 2 ? this.pickupLocation : null,
          note: this.note,
          customer_key: this.selectedCustomer
        }

        axios.post(`/api/request-order/${this.customer.id}`, data)
          .then(() => {
            window.open('/thanks', '_self')
          })
          .catch((e) => {
            location.reload()
          })
      },
      translateItem(item) {
        const translation = {
          'is': {
            'leave_a_note': 'Skilaboð',
            'your_note': 'Skrifa hér',
            'customer_info': 'Upplýsingar um viðskiptavin',
            'name': 'Nafn',
            'email': 'Tölvupóstur',
            'address': 'Heimilisfang',
            'phone': 'Sími',
            'ssn': 'Kennitala',
            'order_info': 'Upplýsingar um pöntun',
            'shipping_to': 'Afhendingarstaður',
            'shipping_method': 'Afhendingarmáti',
            'shipping_date': 'Afhendingardagsetning',
            'pickup_in': 'Sækja inn',
            'delivery': 'Senda',
            'pickup': 'Sækja',
            'new_address': 'Annar afgreiðslustaður',
            'request_order': 'Panta',
            'requesting': 'Vinsamlegast bíðið...',
            'tbd': 'Að vera ákveðinn',
            'change_shipping_address': 'Breyta Sendingarstað',
            'change': 'Breyta',
            'pickup_date': 'Afhendingardagur',
            'delivery_date': 'Dagsetning sendingar',
          },
          'en': {
            'leave_a_note': 'Leave a note',
            'your_note': 'Your Note',
            'customer_info': 'Customer info',
            'name': 'Name',
            'email': 'Email',
            'address': 'Address',
            'phone': 'Phone',
            'ssn': 'SSN',
            'order_info': 'Order Info',
            'shipping_method': 'Shipping Method',
            'shipping_date': 'Shipping date',
            'shipping_to': 'Shipping to',
            'pickup_in': 'Pickup in',
            'delivery': 'Delivery',
            'pickup': 'Pickup',
            'new_address': 'New Address',
            'request_order': 'Request order',
            'requesting': 'Requesting...',
            'tbd': 'To Be Determined',
            'change_shipping_address': 'Change Shipping Address',
            'change': 'Change',
            'pickup_date': 'Pickup date',
            'delivery_date': 'Delivery date',
          }
        }

        return translation[current_locale][item]
      },
    },
  }
</script>
