<template>
  <div class="mt-6">
     <div v-for="(s, index) in staff" :key="index" class="single-variant py-5 border-t border-gray-200 grid grid-cols-2 gap-3">
        <div class="">
          <label :for="'name-'+ index" class="block text-sm font-medium text-gray-700">Name</label>
          <input v-model="s.name" type="text" :id="'name-'+ index" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"  />
        </div>
        <div class="">
          <label :for="'email-'+ index" class="block text-sm font-medium text-gray-700">Email</label>
          <input v-model="s.email" type="text" :id="'email-'+ index" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"  />
        </div>
        <div class="">
          <label :for="'role-'+ index" class="block text-sm font-medium text-gray-700">Role</label>
          <input v-model="s.role" type="text" :id="'role-'+ index" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"  />
        </div>
        <div class="flex items-end">
          <div class="w-full">
            <label :for="'phone-'+ index" class="block text-sm font-medium text-gray-700">Phone</label>
            <input v-model="s.phone" type="text" :id="'phone-'+ index" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"  />
          </div>
          <div class="px-3 ml-5 mb-3 cursor-pointer" @click="deleteStaffMember(index, s.id)">
            <img :src="'/images/trash.svg'" width="24" height="24" alt="delete">
          </div>
        </div>
     </div>
     <div class="flex justify-between">
      <div tabindex="0" class="w-48 mr-3 text-center text-gray-600 border border-gray-400 bg-transparent px-6 py-2 mt-5 text-sm font-normal rounded-md hover:bg-gray-500 hover:text-white cursor-pointer" @keydown.enter="addStaff" @click="addStaff">
        Add staff member
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
    staff: []
  }),
  mounted() {
    axios.get('/api/staff')
      .then((res) => {
        this.staff = res.data
        if(res.data.length === 0) this.addStaff()
      })
  },
  methods: {
    addStaff() {
       this.staff.push({name: '', email: '', phone: '', role: ''})
    },
    save() {
      this.staff = this.staff.filter((i) => {
          if(i.name !== '')
            return i
        })

      axios.post('/api/staff', this.staff)
        .then((res) => {
          this.$emit('saved')
          this.staff = res.data
        })
    },
    deleteStaffMember(index, id) {
      if(id !== undefined)
        axios.delete('/api/staff/' + id)
      this.staff.splice(index, 1)
    }
  }
}
</script>
