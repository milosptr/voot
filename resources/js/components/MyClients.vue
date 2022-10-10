<template>
  <div class="grid sm:grid-cols-3 gap-6">
    <div class="sm:col-span-2 grid grid-cols-1 gap-6">
      <div class="bg-white overflow-hidden shadow rounded-lg px-4 py-5 sm:p-6">
        <div class="text-lg font-medium text-black mb-4">My List</div>
        <div class="vh-70 overflow-scroll">
          <div
            v-for="(client, index) in filteredClients"
            :key="client.id"
            class="text-base py-1 border-t border-gray-100 flex items-center gap-2"
            :class="{'border-b': index === filteredClients.length - 1}"
          >
            <div>{{ client.name }} ({{ client.ssn }})</div>
            <div class="ml-auto text-red-500 cursor-pointer text-sm" @click="removeClient(client.id)">Remove</div>
          </div>
        </div>
        <div
          class="w-32 select-none text-center text-white border border-primary-light bg-primary-light px-6 py-2 mt-5 text-sm font-normal rounded-md hover:bg-primary-lighter hover:text-white cursor-pointer"
          @click="save"
        >
          Save
        </div>
      </div>
    </div>
    <div class="flex flex-col gap-6">
      <div class="bg-white overflow-hidden shadow rounded-lg px-4 py-5 sm:p-6">
        <div class="text-lg font-medium text-black mb-2">Clients</div>
        <div class="mb-4">
          <input type="text" v-model="search" name="search" placeholder="Search name or kennitala" class="w-full group px-3 py-2 text-sm font-normal rounded-md border-gray-400">
        </div>
        <div class="vh-70 overflow-scroll">
          <div
            v-for="customer in filteredCustomers"
            :key="customer.id"
            class="text-sm py-1 border-t border-gray-100 flex items-center gap-2 cursor-pointer"
            @click="addCustomer(customer.id)"
          >
            <div class="text-gray-500">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
              </svg>
            </div>
            <div>{{ customer.name }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data: () => ({
      customers: [],
      clients: [],
      search: '',
    }),
    computed: {
      filteredCustomers() {
        if(this.search && this.search.length > 2)
          return this.customers.filter((c) => {
            if(!c.name || !c.ssn) return false
            const name = c.name.toLowerCase()
            const ssn = c.ssn.toLowerCase()
            const search = this.search.toLowerCase()

            return name.includes(search) || ssn.includes(search)
          })
        return this.customers
      },
      filteredClients() {
        return this.customers.filter((c) => this.clients.find((cl) => cl === c.id))
      }
    },
    mounted() {
      axios.get('/api/my-clients')
        .then((res) => {
          this.customers = res.data.customers
          this.clients = res.data.clients
        })
    },
    methods: {
      addCustomer(id) {
        if(!this.clients.some((c) => c === id))
          this.clients.push(id)
      },
      removeClient(id) {
        this.clients = this.clients.filter((c) => c !== id)
      },
      save() {
        axios.post('/api/my-clients', this.clients)
          .then((res) => {

          })
      },
    }
  }
</script>

<style scoped>
  .vh-70 {
    max-height: 70vh;
  }
</style>
