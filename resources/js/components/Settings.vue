<template>
  <div class="">
    <h1 class="text-lg font-medium mb-5">
      {{ settingsTitle }}
    </h1>
    <ProductIcons v-if="page === 1" @saved="saved" />
    <ProductTranslation v-if="page === 2" @saved="saved" />
    <Staff v-if="page === 3" @saved="saved" />
    <Locations v-if="page === 4" @saved="saved" />
    <Config v-if="page === 5" @saved="saved" />
    <TermsPages v-if="page === 6" @saved="saved" />
    <Newsletter v-if="page === 7" @saved="saved" />
    <HomepageProducts v-if="page === 8" @saved="saved" />
  </div>
</template>

<script>
  import ProductIcons from './Settings/ProductIcons.vue'
  import ProductTranslation from './Settings/ProductTranslation.vue'
  import Staff from './Settings/Staff.vue'
  import Locations from './Settings/Locations.vue'
  import Config from './Settings/Config.vue'
  import TermsPages from './Settings/TermsPages.vue'
  import Newsletter from './Settings/Newsletter.vue'
  import HomepageProducts from './Settings/HomepageProducts.vue'

  export default {
    components: { ProductIcons, ProductTranslation, Staff, Locations, Config, TermsPages, Newsletter, HomepageProducts },
    data: () => ({
      page: 0,
    }),
    computed: {
      settingsTitle() {
        if(this.page === 1)
          return 'Product Icons'
        if(this.page === 2)
          return 'Product Translation'
        if(this.page === 3)
          return 'Staff Members'
        if(this.page === 4)
          return 'Locations'
        if(this.page === 5)
          return 'Config'
        if(this.page === 6)
          return 'Terms Pages'
        if(this.page === 7)
          return 'Newsletter Offer'
        if(this.page === 8)
          return 'Homepage Products'
        return 'Select settings page from the left menu'
      }
    },
    mounted() {
      if(location.pathname.includes('product-icons'))
        this.page = 1
      if(location.pathname.includes('product-translation'))
        this.page = 2
      if(location.pathname.includes('staff'))
        this.page = 3
      if(location.pathname.includes('locations'))
        this.page = 4
      if(location.pathname.includes('config'))
        this.page = 5
      if(location.pathname.includes('pages'))
        this.page = 6
      if(location.pathname.includes('newsletter'))
        this.page = 7
      if(location.pathname.includes('homepage-products'))
        this.page = 8
    },
    methods: {
      saved() {
        document.body.insertAdjacentHTML('beforeend', `
          <div class="success-alert fixed right-0 top-0 mt-10 m-10 shadow bg-green-100 border-l-4 border-green-400 text-green-700 px-4 py-3 rounded" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">Your settings are saved.</span>
          </div>
        `)
        setTimeout(() => {
          document.querySelector('.success-alert').remove()
        }, 4000);
      }
    }
  }
</script>
