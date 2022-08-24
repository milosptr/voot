<template>
  <div class="mt-6">
    <div v-for="(l, index) in locations" :key="index" class="single-variant py-5 border-t border-gray-200 ">
      <div class="grid grid-cols-3 gap-3">
        <div class="">
          <label :for="'name-'+ index" class="block text-sm font-medium text-gray-700">Name</label>
          <input v-model="l.name" type="text" :id="'name-'+ index" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"  />
        </div>
        <div class="">
          <label :for="'address-'+ index" class="block text-sm font-medium text-gray-700">Address</label>
          <input v-model="l.address" type="text" :id="'address-'+ index" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"  />
        </div>
        <div class="">
          <label :for="'city-'+ index" class="block text-sm font-medium text-gray-700">City</label>
          <input v-model="l.city" type="text" :id="'city-'+ index" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"  />
        </div>
        <div class="">
          <label :for="'zip-'+ index" class="block text-sm font-medium text-gray-700">Zip</label>
          <input v-model="l.zip" type="text" :id="'zip-'+ index" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"  />
        </div>
        <div class="">
          <label :for="'state-'+ index" class="block text-sm font-medium text-gray-700">State</label>
          <input v-model="l.state" type="text" :id="'state-'+ index" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"  />
        </div>
        <div class="">
          <label :for="'country-'+ index" class="block text-sm font-medium text-gray-700">Country</label>
          <input v-model="l.country" type="text" :id="'country-'+ index" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"  />
        </div>
        <div class="">
          <label :for="'phone-'+ index" class="block text-sm font-medium text-gray-700">Phone</label>
          <input v-model="l.phone" type="text" :id="'phone-'+ index" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"  />
        </div>
        <div class="">
          <label :for="'email-'+ index" class="block text-sm font-medium text-gray-700">Email</label>
          <input v-model="l.email" type="text" :id="'email-'+ index" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"  />
        </div>
        <div class="">
          <div class="px-3 mt-8 ml-3 cursor-pointer" @click="deleteLocation(index, l.id)">
            <img :src="'/images/trash.svg'" width="24" height="24" alt="delete">
          </div>
        </div>
      </div>
    </div>
    <div class="flex justify-between">
      <div tabindex="0" class="w-48 mr-3 text-center text-gray-600 border border-gray-400 bg-transparent px-6 py-2 mt-5 text-sm font-normal rounded-md hover:bg-gray-500 hover:text-white cursor-pointer" @keydown.enter="addLocation" @click="addLocation">
        Add location
      </div>
      <div tabindex="0" class="w-32 select-none text-center text-white border border-primary-light bg-primary-light px-6 py-2 mt-5 text-sm font-normal rounded-md hover:bg-primary-lighter hover:text-white cursor-pointer" @keydown.enter="save" @click="save">
        Save
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data: () => ({
      locations: []
    }),
    mounted() {
      axios.get('/api/locations')
        .then((res) => {
          this.locations = res.data
        })
      if(this.locations.length === 0)
        this.addLocation()
    },
    methods: {
      addLocation() {
        this.locations.push({})
      },
      save() {
        this.locations = this.locations.filter((i) => {
            if(i.name !== '')
              return i
          })

        axios.post('/api/locations', this.locations)
          .then((res) => {
            this.$emit('saved')
            this.locations = res.data
          })
      },
      deleteLocation(index, id) {
        if(id !== undefined)
          axios.delete('/api/locations/' + id)
        this.locations.splice(index, 1)
      }
    }
  }
</script>
