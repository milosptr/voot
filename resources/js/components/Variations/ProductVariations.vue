<template>
  <div v-if="variations.length" class="bg-white overflow-hidden shadow rounded-lg mt-6">
    <div class="px-4 py-5 sm:p-6">
      <div class="text-lg text-black font-medium">Product Variations</div>
      <div class="">
        <div v-for="(variation, index) in variations" :key="index" class="single-variant px-4 py-5 sm:p-6 border-t border-gray-200 flex items-end justify-between">
          <div class="w-14 h-14">
            <label :for="'variation-img-'+index" class="dropzone-placeholder h-full flex items-center justify-center text-center cursor-pointer">
              <img v-if="variation.file_path" :src="variation.file_path" alt="variation-image" class="w-14 h-14 rounded-md" />
              <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-9 h-9" viewBox="0 0 24 24" fill="none" stroke="#d4d4d8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
              <input type="file" :id="'variation-img-'+index" @change="uploadImage($event,variation, index)" hidden />
            </label>
          </div>
          <div class="w-1/3 px-3">
              <label :for="'name-'+ index" class="block text-sm font-medium text-gray-700">Name</label>
              <input v-model="variation.value" type="text" :id="'name-'+ index" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"  />
          </div>
          <div class="w-1/3 px-3">
            <label :for="'sku-'+index" class="block text-sm font-medium text-gray-700">SKU</label>
            <input v-model="variation.sku" type="text" :id="'sku-'+index" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"  />
          </div>
          <div class="pl-3 mb-2 cursor-pointer" @click="removeVariant(variation,index)">
            <img src="/images/trash.svg" width="24" height="24" alt="delete" />
          </div>
          <!-- <div v-else style="width: 24px"></div> -->
        </div>
      </div>
      <div tabindex="0" class="w-1/3 text-center text-gray-600 border border-gray-400 bg-transparent px-6 py-2 mt-5 text-sm font-normal rounded-md hover:bg-gray-500 hover:text-white cursor-pointer" @keydown.enter="$emit('add')" @click="$emit('add')">
        Add another variation
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    props: {
      variations: Array,
    },
    mounted() {
    },
    methods: {
      removeVariant(variation,index) {
        this.variations.splice(index,1)
        axios.delete('/api/product-variations/'+ variation.id)
      },
      uploadImage(e, variation, index) {
        const formData = new FormData()
        formData.append('file', e.target.files[0])
        axios.post('/api/assets', formData)
          .then((response) => {
            this.variations[index].file_path = '/' + response.data.file_path
          })
      }
    }
  }
</script>
