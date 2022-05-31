<template>
  <div class="bg-white overflow-hidden shadow rounded-lg px-4 py-5 sm:p-6">
    <label for="fileDrop" class="block text-sm font-medium text-gray-700">
      Client logo (automatic upload - no need to save)
    </label>
    <div class="w-1/2 mx-auto mt-2">
      <input id="customer-logo-image" type="file" name="logo" hidden @change="upload($event)" />
      <label for="customer-logo-image" class="block aspect-w-1 aspect-h-1 bg-contain bg-center bg-no-repeat rounded-md cursor-pointer" :style="`background-image: url('${logo}');`"></label>
    </div>
  </div>
</template>

<script>
  export default {
    data: () => ({
      key: null,
      customer: null,
    }),
    computed: {
      logo() {
        if(this.customer && this.customer.logo)
          return '/' + this.customer.logo
        return '/images/file-upload.png'
      },
    },
    mounted() {
     this.key = document.getElementById('upload-customer-logo').dataset.key
     this.getCustomer()
    },
    methods: {
      upload(e) {
        const formData = new FormData()
        for (let i = 0; i < e.target.files.length; i++) {
            formData.append("file[]", e.target.files[i]);
        }

        axios.post(`/api/customer/${this.key}/logo`, formData)
          .then(() => {
            this.getCustomer()
          })
      },
      getCustomer() {
         axios.get('/api/customer-info/' + this.key)
          .then((res) => {
            this.customer = res.data.data
          })
      }
    }
  }
</script>
