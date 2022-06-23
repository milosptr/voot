<template>
  <div class="mt-6">
    <div v-for="(c,i) in config" class="" :key="i">
      <label :for="'config-'+i" class="block text-sm font-medium text-gray-700 capitalize">
        {{ parseLabel(c.key) }}
      </label>
      <input
        v-model="c.value" :id="'config-'+i" type="text"
        class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
       />
    </div>
    <div class="flex justify-end">
      <div tabindex="0" class="w-32 select-none text-center text-white border border-primary-light bg-primary-light px-6 py-2 mt-5 text-sm font-normal rounded-md hover:bg-primary-lighter hover:text-white cursor-pointer" @keydown.enter="save" @click="save">
        Save
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data: () => ({
      config: []
    }),
    mounted() {
      axios.get('/api/config')
        .then((res) => {
          this.config = res.data
        })
    },
    methods: {
      parseLabel(key) {
        return key.replaceAll('_', ' ');
      },
      save() {
        axios.post('/api/configs', this.config)
          .then((res) => {
            this.$emit('saved')
          })
      }
    }
  }
</script>
