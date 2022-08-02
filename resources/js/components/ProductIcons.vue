<template>
  <div class="bg-white overflow-hidden shadow rounded-lg">
    <div class="px-4 py-5 sm:p-6">
      <div class="text-lg text-black font-medium">Product Icons</div>
      <div class="mt-6">
        <div
          v-for="icon in icons"
          :key="icon.id"
          class="flex items-center"
          @click="addIcon(icon)"
        >
          <svg v-if="isAdded(icon)" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#1d68a7" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><polyline points="172 104 113.3 160 84 132" fill="none" stroke="#1d68a7" stroke-linecap="round" stroke-linejoin="round" stroke-width="24"></polyline><rect x="40" y="40" width="176" height="176" rx="8" fill="none" stroke="#1d68a7" stroke-linecap="round" stroke-linejoin="round" stroke-width="18"></rect></svg>
          <svg v-else xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#555555" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><rect x="42" y="42" width="176" height="176" rx="8" fill="none" stroke="#555555" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></rect></svg>
          <label :for="'icon-'+icon.id" class="ml-3 text-gray-600 select-none">
            {{ icon.name }}
          </label>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    computed: {
      productIcons() {
        return this.$store.getters.product.icons
      },
      icons() {
        return this.$store.getters.icons
      },
    },
    methods: {
      isAdded(icon) {
        return this.productIcons.some((i) => i.id === icon.id)
      },
      addIcon(icon) {
        this.isAdded(icon) ? this.$store.commit('removeIcon', icon.id) : this.$store.commit('addIcon', icon)
      }
    }
  }
</script>
