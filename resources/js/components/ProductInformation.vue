<template>
<div class="bg-white overflow-hidden shadow rounded-lg">
    <div class="px-4 py-5 sm:p-6">
      <div class="text-lg text-black font-medium">Product Information</div>
      <div class="mt-6">
        <div v-for="(info, index) in information" :key="index" class="flex items-end gap-5 mb-5">
          <div class="w-1/2">
              <label :for="'name-'+ index" class="block text-sm font-medium text-gray-700">Name</label>
              <input :value="info.name" @input="updateInformation(index, 'name', $event)" type="text" :id="'name-'+ index" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"  />
          </div>
          <div class="w-1/2">
              <label :for="'label-'+ index" class="block text-sm font-medium text-gray-700">Value</label>
              <input :value="info.value" @input="updateInformation(index, 'value', $event)" type="text" :id="'label-'+ index" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"  />
          </div>
          <div class="mb-2 cursor-pointer" @click="$store.commit('removeProductInformation', info)">
            <svg width="24" height="24" fill="none" stroke="#dc2626" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
          </div>
        </div>
        <div
          class="w-2/5 text-center text-gray-600 border border-gray-200  px-6 py-2 text-sm font-normal rounded-md hover:bg-gray-200 cursor-pointer"
          @click="$store.commit('addInformation')"
        >
          Add
        </div>
      </div>
    </div>
</div>
</template>

<script>
  export default {
    computed: {
      information() {
        return this.$store.getters.product.informations
      }
    },
    methods: {
      updateInformation(index, key, evt) {
        this.$store.commit('setInformation', {index, key, value: evt.target.value})
      }
    }
  }
</script>
