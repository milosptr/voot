<template>
  <div
    class="relative z-10"
    aria-labelledby="modal-title"
    role="dialog"
    aria-modal="true">
    <div
      class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
      @click="$emit('close')"></div>

    <div class="fixed inset-0 z-10 overflow-y-auto">
      <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div
          class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
          <h3
            class="text-lg leading-6 font-medium text-gray-900"
            id="modal-title">
            Ný sendingaraðferð
          </h3>
          <div class="mt-6">
            <label
              for="key"
              class="block text-sm font-medium text-gray-700"
              >Skammstöfun / Upphafsstafir
              <span class="font-normal text-gray-500">(til dæmis: HOP, SS, VM, PO)</span> </label
            ><input
              v-model="key"
              type="text"
              id="key"
              class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
          </div>
          <div class="mt-3">
            <label
              for="name"
              class="block text-sm font-medium text-gray-700"
              >Name</label
            ><input
              v-model="name"
              type="text"
              id="name"
              class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
          </div>

          <div
            v-if="showError"
            class="mt-3">
            <div class="text-red-500 text-sm font-medium">
              <p>Það verður að fylla út bæði skammstöfun/upphafsstafi og nafn.</p>
            </div>
          </div>

          <div class="mt-10 flex flex-col sm:flex-row justify-between">
            <div
              @click="$emit('close')"
              class="w-48 select-none text-center text-gray-500 border border-gray-400 px-6 py-2 text-sm font-normal rounded-md hover:text-white cursor-pointer bg-transparent hover:bg-gray-400">
              Hætta við
            </div>
            <div
              @click="addNew"
              class="w-48 select-none text-center text-white border border-primary-light px-6 py-2 text-sm font-normal rounded-md hover:text-white cursor-pointer bg-primary-light hover:bg-primary-lighter">
              {{ method && method.id ? 'Vista' : 'Bæta við nýju' }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    method: {
      type: Object,
      default: () => ({})
    }
  },
  data: () => ({
    key: '',
    name: '',
    showError: false
  }),
  mounted() {
    if(this.method) {
      this.key = this.method.key || ''
      this.name = this.method.name || ''
    }
  },
  methods: {
    reset() {
      this.key = ''
      this.name = ''
      this.showError = false
    },
    addNew() {
      if (!this.key || !this.name) {
        this.showError = true
        return
      }
      const url = this.method && this.method.id ? `/api/shipping-methods/${this.method.id}` : '/api/shipping-methods'
      axios
        .post(url, {
          key: this.key,
          name: this.name
        })
        .then(() => {
          this.reset()
          this.$emit('close')
          this.$emit('saved')
        })
    }
  }
}
</script>
