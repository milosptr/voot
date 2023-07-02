<template>
  <div class="">
    <table class="min-w-full divide-y divide-gray-300">
      <thead>
        <tr>
          <th
            scope="col"
            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">
            ID
          </th>
          <th
            scope="col"
            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
            Skammstöfun
          </th>
          <th
            scope="col"
            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
            Nafn
          </th>
          <!-- <th
            scope="col"
            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
            Short name
          </th> -->
          <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 lg:pr-8">
            <span class="sr-only">Edit</span>
          </td>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-200 bg-white">
        <tr
          v-for="(method, idx) in shippingMethods"
          :key="method.id"
          class="hover:bg-gray-50">
          <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
            {{ idx + 1 }}
          </td>
          <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 font-medium">
            {{ method.key }}
          </td>
          <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            {{ method.name }}
          </td>
          <!-- <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            {{ method.shortname }}
          </td> -->
          <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 lg:pr-8">
            <div class="flex items-center justify-end gap-4">
              <div
                class="text-indigo-600 hover:text-indigo-900 cursor-pointer"
                @click="updateMethod(method)">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-5 h-5">
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                </svg>
              </div>
              <div
                class="text-red-600 hover:text-red-900 cursor-pointer"
                @click="deleteMethod(method.id)">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-5 h-5">
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
              </div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <div
      @click="addNewMethod"
      class="mt-5 ml-auto w-48 select-none text-center text-white border border-primary-light px-6 py-2 text-sm font-normal rounded-md hover:text-white cursor-pointer bg-primary-light hover:bg-primary-lighter">
      Bæta við nýju
    </div>
    <ShippngMethodAddModal
      v-if="showAddNewModal"
      :method="editingMethod"
      @close="closeAddNewModal"
      @saved="addNewMethodSaved" />
  </div>
</template>

<script>
import ShippngMethodAddModal from './ShippingMethodAddModal.vue'
export default {
  components: {
    ShippngMethodAddModal
  },
  data: () => ({
    shippingMethods: [],
    showAddNewModal: false,
    editingMethod: null
  }),
  mounted() {
    this.fetchShippingMethods()
  },
  methods: {
    fetchShippingMethods() {
      axios.get('/api/shipping-methods').then((res) => {
        this.shippingMethods = res.data
      })
    },
    addNewMethod() {
      this.showAddNewModal = true
    },
    updateMethod(method) {
      this.editingMethod = method
      this.showAddNewModal = true
    },
    deleteMethod(id) {
      axios.delete(`/api/shipping-methods/${id}`).then((res) => {
        this.fetchShippingMethods()
      })
    },
    closeAddNewModal() {
      this.showAddNewModal = false
      this.editingMethod = null
    },
    addNewMethodSaved() {
      this.showAddNewModal = false
      this.editingMethod = null
      this.fetchShippingMethods()
      this.$emit('saved')
    }
  }
}
</script>
