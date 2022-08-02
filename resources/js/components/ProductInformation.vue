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
