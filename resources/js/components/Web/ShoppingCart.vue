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
          <div class="ml-0 sm:ml-8 text-red-400 cursor-pointer" @click="removeProduct(index)">
            <img :src="'/images/trash.svg'" alt="remove" class="w-5 h-5" />
          </div>
      </div>
      <div class="flex justify-end">
        <a href="/checkout" class="inline-block mt-4 small-caps uppercase px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 cursor-pointer">
          Útskráning
        </a>
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
        { id: 'HOP', name: 'Hópsnes (Suðurnes)' },
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
            if(this.customer.name.toLowerCase().includes('visir')
            || this.customer.email.includes('visir')) {
              this.selectedShippingCode = 'HOP'
            }
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
