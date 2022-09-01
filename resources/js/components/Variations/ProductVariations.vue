<template>
  <div class="bg-white overflow-hidden shadow rounded-lg">
    <div class="px-4 py-5 sm:p-6">
      <div class="flex flex-col sm:flex-row items-start justify-between">
        <div class="text-lg text-black font-medium">Product Variations</div>
        <div
          class="inline-flex items-center border border-gray-200 rounded px-2 text-sm font-sans font-medium text-gray-400 cursor-pointer hover:bg-gray-200 hover:text-gary-900"
          @click="toggleAvailableColors"
        >
          Available Colors
        </div>
      </div>
      <div class="border-t border-gray-200">
        <draggable
          v-model="variations"
          :group="variations"
          @start="drag=true"
          @end="onDragEnd"
          item-key="id"
          handle=".handle"
        >
          <template #item="{element, index}">
            <div class="single-variant px-4 py-5 sm:p-6 border-b border-gray-200 flex items-end justify-between">
              <div v-if="element.id" class="handle w-8 h-14 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#111" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><circle cx="92" cy="60" r="10"></circle><circle cx="164" cy="60" r="10"></circle><circle cx="92" cy="128" r="10"></circle><circle cx="164" cy="128" r="10"></circle><circle cx="92" cy="196" r="10"></circle><circle cx="164" cy="196" r="10"></circle></svg>
              </div>
              <div class="w-14 h-14">
                <label :for="'variation-img-'+index" class="dropzone-placeholder h-full flex items-center justify-center text-center cursor-pointer">
                  <img v-if="element.file_path" :src="element.file_path" alt="variation-image" class="w-14 h-14 rounded-md" />
                  <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-9 h-9" viewBox="0 0 24 24" fill="none" stroke="#d4d4d8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                  <input type="file" :id="'variation-img-'+index" @change="uploadImage($event,element, index)" hidden />
                </label>
              </div>
              <div class="w-1/3 px-3">
                  <label :for="'name-'+ index" class="block text-sm font-medium text-gray-700">Name</label>
                  <input :value="element.value" @input="updateVariantField(index, 'value', $event)" type="text" :id="'name-'+ index" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"  />
              </div>
              <div class="w-1/3 px-3">
                <label :for="'sku-'+index" class="block text-sm font-medium text-gray-700">SKU</label>
                <input :value="element.sku" @input="updateVariantField(index, 'sku', $event)" type="text" :id="'sku-'+index" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"  />
              </div>
              <div class="pl-3 mb-2 cursor-pointer" @click="removeVariant(element,index)">
                <img :src="'/images/trash.svg'" width="24" height="24" alt="delete" />
              </div>
            </div>
          </template>
        </draggable>
      </div>
      <div tabindex="0" class="w-1/3 text-center text-gray-600 border border-gray-400 bg-transparent px-6 py-2 mt-5 text-sm font-normal rounded-md hover:bg-gray-500 hover:text-white cursor-pointer" @keydown.enter="addVariation" @click="addVariation">
        Add another variation
      </div>
    </div>
    <div v-if="showAvailableColors" class="fixed left-0 top-0 w-full h-screen z-40 flex items-center justify-center">
      <div class="absolute left-0 top-0 w-full h-screen bg-black bg-opacity-50" @click="toggleAvailableColors"></div>
      <div class="relative w-full sm:w-1/2 xl:w-1/3 z-50 my-32 h-full" style="height: 90vh;">
        <div class="bg-white p-12 overflow-y-scroll h-full rounded-md">
          <div class="py-1 border-b border-gray-100 grid grid-cols-3 gap-3 text-sm font-bold">
            <div class="font-bold text-sm text-gray-600">Name</div>
            <div class="font-bold text-sm text-gray-600">Name english</div>
            <div class="font-bold text-sm text-gray-600 text-center">Color</div>
          </div>
          <div v-for="color in availableColors" :key="color.id" class="py-1 border-t border-b border-gray-100 grid grid-cols-3 gap-3 text-sm">
              <div>{{ color.name }}</div>
              <div>{{ color.name_en }}</div>
              <div class="flex items-center justify-center">
                <div class="w-12 h-4 rounded-sm border border-gray-100" :style="'background:' + color.hex"></div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import draggable from 'vuedraggable'
  export default {
    components: {
      draggable,
    },
    data: () => ({
      showAvailableColors: false,
      availableColors: [],
      drag: false,
      variations: [],
    }),
    mounted() {
      axios.get('/api/colors')
        .then((res) => {
          this.availableColors = res.data
          this.variations = this.$store.getters.product.variations
        })
    },
    methods: {
      addVariation() {
        this.variations.push({})
      },
      removeVariant(variant, index) {
        this.$store.commit('removeVariant', index)
        if(variant.id) axios.delete('/api/product-variations/'+ variant.id)
      },
      updateVariantField(index, key, evt) {
        this.$store.commit('updateVariantField', { index, key, value: evt.target.value})
      },
      uploadImage(e, variation, index) {
        const formData = new FormData()
        formData.append('file', e.target.files[0])
        axios.post('/api/assets', formData)
          .then((response) => {
            this.$store.commit('updateVariantField', { index, key: 'file_path', value: '/' + response.data.file_path})
          })
      },
      toggleAvailableColors() {
        this.showAvailableColors = !this.showAvailableColors
      },
      onDragEnd() {
        const variants = this.variations.map((v, i) => {
          v.order = i
          return v
        })
        axios.post('/api/product-variations/reorder', {variants})
      }
    }
  }
</script>
