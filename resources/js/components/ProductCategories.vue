<template>
  <div class="bg-white overflow-hidden shadow rounded-lg">
    <div class="px-4 py-5 sm:p-6">
      <div class="text-lg font-medium text-black">Organization</div>
      <div class="mt-6">
        <label for="categories" class="block text-sm font-medium text-gray-700">Choose categories</label>
        <select
          id="categories"
          name="categories"
          ref="categoriesSelect"
          class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
          @change="addCategory"
        >
          <option value="" disabled selected>Categories</option>
          <template v-for="category in categories" :key="category.id">
            <option :value="category.id">{{ category.name }}</option>
            <template v-for="subcategory in category.children" :key="subcategory.id">
              <option :value="subcategory.id">-- {{ subcategory.name }}</option>
              <template v-for="subsubcategory in subcategory.children" :key="subsubcategory.id">
                <option :value="subsubcategory.id">---- {{ subsubcategory.name }}</option>
              </template>
            </template>
          </template>
        </select>
      </div>
      <div class="mt-3 pl-1 text-sm text-gray-500">
        <div v-for="category in product.categories" :key="category.id" class="flex justify-between items-center selected-category-item py-1 border-b border-gray-100">
          <div class="pl-2">{{ category.name }}</div>
          <div class="pr-2 tracking-widest text-3xl font-thin leading-none text-gray-400 cursor-pointer hover:text-rose-500" @click="$store.commit('removeCategory', category.id)">×</div>
        </div>
      </div>
      <ProductTags />
    </div>
  </div>
</template>

<script>
  import ProductTags from './ProductTags.vue'

  export default {
  components: { ProductTags },
    computed: {
      product() {
        return this.$store.getters.product
      },
      categories() {
        return this.$store.getters.categories
      },
    },
    methods: {
      addCategory(evt) {
        axios.get('/api/product-categories/' + evt.target.value)
          .then((res) => {
            this.$store.commit('addCategory', res.data.data)
            this.$refs.categoriesSelect.value = ""
          })
      }
    },
  }
</script>
