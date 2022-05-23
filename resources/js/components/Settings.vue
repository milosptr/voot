<template>
  <div class="">
    <h1 class="text-lg font-medium mb-5">
      {{ settingsTitle }}
    </h1>
    <ProductIcons v-if="page === 1" @saved="saved" />
    <ProductTranslation v-if="page === 2" @saved="saved" />
  </div>
</template>

<script>
  import ProductIcons from './Settings/ProductIcons.vue'
  import ProductTranslation from './Settings/ProductTranslation.vue'

  export default {
  components: { ProductIcons, ProductTranslation },
    compontents: {
      ProductIcons,
      ProductTranslation,
    },
    data: () => ({
      page: 0,
    }),
    computed: {
      settingsTitle() {
        if(this.page === 1)
          return 'Product Icons'
        if(this.page === 2)
          return 'Product Translation'
        return 'Select settings page from the left menu'
      }
    },
    mounted() {
      if(location.pathname.includes('product-icons'))
        this.page = 1
      if(location.pathname.includes('product-translation'))
        this.page = 2
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
