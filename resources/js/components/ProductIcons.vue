<template>
  <div class="bg-white overflow-hidden shadow rounded-lg mt-6">
    <div class="px-4 py-5 sm:p-6">
      <div class="text-lg text-black font-medium">Product Icons</div>
      <div class="mt-6">
        <div
          v-for="icon in icons"
          :key="icon.id"
          class="flex items-center"
          @click="addIcon(icon.id)"
        >
          <input v-if="addedIcons.indexOf(icon.id) !== -1" :id="'icon-'+icon.id" type="checkbox" :checked="true" disabled />
          <input v-else :id="'icon-'+icon.id" type="checkbox" disabled />
          <label :for="'icon-'+icon.id" class="ml-3">
            {{ icon.name }}
          </label>
        </div>
      </div>
    </div>
    <input name="product-icons" :value="addedIcons" hidden readonly/>
  </div>
</template>

<script>
  export default {
    data: () => ({
      icons: [],
      addedIcons: [],
    }),
    mounted() {
      const product = document.getElementById('product-icons').dataset['key']
      axios.get('/api/settings-icons').then((res) => this.icons = res.data)
      axios.get('/api/product-icons/'+product).then((res) => this.addedIcons = res.data)
    },
    methods: {
      addIcon(id) {
        if(this.addedIcons.find((i) => i === id))
          this.addedIcons = this.addedIcons.filter((i) => i !== id)
        else
          this.addedIcons.push(id)

      }
    }
  }
</script>

<style scoped>
  input,
  [type='checkbox']:focus {
    outline: none!important;
  }
</style>
