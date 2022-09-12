<template>
  <TransitionRoot as="template" :show="show">
    <Dialog as="div" class="relative z-10" @close="$emit('close')">
      <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"/>
      </TransitionChild>

      <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center text-center sm:items-center p-0">
          <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <DialogPanel class="h-screen lg:h-auto relative transformoverflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl sm:p-6">
              <div>
                <div class="">
                  <DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900">List of duplicated SKUs</DialogTitle>
                  <div class="h-96 lg:h-64 overflow-scroll mt-6">
                    <a
                      v-for="(product,index) in products"
                      :key="index"
                      :href="'/backend/products/edit/' + product.id"
                      target="_blank"
                      class="flex gap-3 border-t border-gray-100 py-2 cursor-pointer hover:bg-gray-50 ring-0 outline-none text-gray-500 hover:text-gray-900"
                    >
                      <p class="text-sm w-10 text-center">{{ index }}</p>
                      <p class="text-sm">{{ product.name }}</p>
                      <p class="text-sm ml-auto pr-4">{{ product.sku }}</p>
                    </a>
                  </div>
                </div>
              </div>
              <div class="mt-5 sm:mt-6">
                <button type="button" class="inline-flex w-auto justify-center rounded-md border px-8 py-2 text-base font-medium border-gray-300 hover:border-gray-400 hover:bg-gray-50 text-gray-500 shadow-sm focus:outline-none focus:ring-0 focus:ring-offset-0 sm:text-sm transition-all duration-300" @click="$emit('close')">Close</button>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script>
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'

export default {
  props: {
    show: {
      type: Boolean,
      default: () => false,
    },
    products: {
      type: Array,
      default: () => []
    }
  },
  components: {
    Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot
  },
}
</script>
