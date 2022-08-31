<template>
  <div class="bg-white overflow-hidden shadow rounded-lg">
    <div class="px-4 py-5 sm:p-6">
      <div class="text-lg text-black font-medium">Media</div>
      <div class="text-gray-500 text-sm">(Media are saved automatically)</div>
      <div class="mt-6">
        <div class="block text-sm font-medium text-gray-700">Featured image</div>
        <label for="upload_featured_image" class="dropzone-placeholder flex items-center justify-center py-3 mt-2 cursor-pointer">
          <div v-if="feature_image" class="w-1/3 gap-4 bg-cover bg-center bg-no-repeat" :style="`aspect-ratio: 1/1; background-image: url('/${feature_image.file_path}')`" />
          <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-9 h-9" viewBox="0 0 24 24" fill="none" stroke="#d4d4d8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
          <input type="file" name="upload_featured_image" id="upload_featured_image" hidden @change="uploadAssets($event, 1)">
        </label>
      </div>
      <div class="mt-6">
        <div class="block text-sm font-medium text-gray-700">Gallery</div>
        <label for="upload_media" class="dropzone-placeholder flex items-center justify-center py-3 mt-2 cursor-pointer">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-9 h-9" viewBox="0 0 24 24" fill="none" stroke="#d4d4d8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
          <input type="file" name="upload_media" id="upload_media" multiple hidden @change="uploadAssets($event, 0)">
        </label>
        <div class="mt-2 flex flex-wrap">
          <div v-for="(item, index) in gallery" :key="index" class="w-1/3 p-2 hover-remove-image" @click="removeImage(item)">
            <div class="bg-cover bg-center bg-no-repeat" :style="`aspect-ratio: 1/1; background-image: url('/${item.file_path}')`" />
          </div>
        </div>
      </div>
      <input type="text" name="featured_image_id" :value="featured_image_id" hidden>
      <input type="text" name="media_ids" :value="media_ids" hidden>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'Media',
    data: () => ({
      featured_image_id: null,
      feature_image: null,
      media_ids: [],
      gallery: [],
    }),
    computed: {
      product() {
        return this.$store.getters.product
      },
    },
    mounted() {
      axios.get(`/api/product-media/${document.getElementById('editSingleProduct').dataset.key}`)
        .then((res) => {
          this.feature_image = res.data.reverse().find((d) => !!d.featured_image)
          this.gallery = res.data.filter((d) => !d.featured_image || d.featured_image === "0")
        })
    },
    methods: {
      uploadAssets(e, featured) {
        const formData = new FormData()
        for (let i = 0; i < e.target.files.length; i++) {
            formData.append("file[]", e.target.files[i]);
        }

        if(featured) {
          if(this.feature_image && this.feature_image.id)
            this.removeImage(this.feature_image)
          formData.append('featured_image', 'true')
        }
        formData.append('product_id', this.product.id)

        axios.post('/api/assets/new-product', formData)
          .then((response) => {
            const ids = response.data.map((i) => i.id)
            if(featured) {
              this.feature_image = response.data[0]
              this.featured_image_id = ids
            }
            if(!featured) {
              this.gallery.push(...response.data)
              this.media_ids.push(...ids)
            }
          })
      },
      removeImage(img) {
        this.media_ids = this.media_ids.filter((i) => img.id !== i)
        this.gallery = this.gallery.filter((item) => item.id !== img.id)
        axios.delete(`/api/assets/${img.id}`)
      }
    }
  }
</script>
