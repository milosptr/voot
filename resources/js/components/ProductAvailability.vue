<template>
  <div class="bg-white overflow-hidden shadow rounded-lg">
    <div class="px-4 py-5 sm:p-6">
      <div class="flex flex-col sm:flex-row items-center justify-between">
        <div class="text-lg font-medium text-black">Product status</div>
        <div class="text-sm cursor-pointer font-medium text-red-500 underline" @click="deleteProduct">Delete</div>
      </div>
      <div class="mt-5">
        <select id="available" @input="updateField('available', $event)" :value="product.available" name="available" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
          <option value="1">Available</option>
          <option value="0">Not Available</option>
        </select>
        <div class="text-gray-500 text-sm mt-2 pl-1">
          By selecting "Not Available", product will be hidden on the webpage
        </div>
        <div class="mt-6 flex justify-between">
          <div class="w-2/5 text-center text-white border border-primary-lighter bg-primary-lighter px-6 py-2 text-sm font-normal rounded-md hover:bg-primary-light cursor-pointer" @click="updateProduct">
            Update
          </div>
          <a :href="product.url" target="_blank" class="w-2/5 text-center text-gray-600 border border-gray-200  px-6 py-2 text-sm font-normal rounded-md hover:bg-gray-200 hover:text-white cursor-pointer">
            Preview
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    computed: {
      product() {
        return this.$store.getters.product
      }
    },
    methods: {
      updateField(key, evt) {
        this.$store.commit('updateProductField', {key, value: parseInt(evt.target.value)})
      },
      updateProduct() {
        this.$store.dispatch('updateProduct')
      },
      deleteProduct() {
        axios.delete('/api/products/' + this.product.id)
          .then(() => {
            window.open('/backend/products/', '_self')
          })
      }
    }
  }
</script>
