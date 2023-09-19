<template>
  <div>
    <div class="w-full sm:w-1/3 ml-auto relative mb-4">
      <div class="text-gray-500 absolute left-0 top-0 mt-2 ml-2">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
      </div>
      <input type="text" id="clients-search" name="search" v-model="searchTerm" @input="handleInput" placeholder="Type to search..." class="w-full group px-3 pl-10 py-2 text-sm font-normal rounded-md border-gray-500 bg-transparent">
    </div>
    <table class="min-w-full divide-y divide-gray-200 overflow-x-scroll border border-gray-200 rounded-md">
      <thead class="bg-gray-50">
        <tr>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              n
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Full name
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              KEY ID
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              SSN
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Phone
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Status
          </th>
      </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <tr v-for="(client, idx) in clients" :key="idx" class="cursor-pointer hover:bg-gray-50 text-sm" @click="navigateToCustomer(client.id)">
          <td class="px-6 py-2 whitespace-nowrap">{{ (idx+1) + (15*(currentPage-1)) }}.</td>
          <td class="px-6 py-2 whitespace-nowrap font-semibold text-gray-700">{{ client.name }}</td>
          <td class="px-6 py-2 whitespace-nowrap">#{{ client.key }}</td>
          <td class="px-6 py-2 whitespace-nowrap">{{ client.ssn }}</td>
          <td class="px-6 py-2 whitespace-nowrap">{{ client.phone }}</td>
          <td class="px-6 py-2 whitespace-nowrap font-semibold" :class="client.email_verified_at ? 'text-green-600' : 'text-orange-500'">
            {{ client.email_verified_at ? 'Verified' : 'Not verified' }}
          </td>
        </tr>
      </tbody>
    </table>
    <div class="flex items-center gap-5 mt-4 justify-end">
      <button @click="prevPage" :disabled="currentPage === 1" class="relative w-32 cursor-pointer px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md leading-5" :class="totalPages !== 1 ? 'hover:bg-slate-50': 'bg-slate-100 hover:bg-slate-100 cursor-not-allowed'">Previous</button>
      <button @click="nextPage" :disabled="currentPage === totalPages" class="relative w-32 cursor-pointer px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md leading-5" :class="totalPages !== 1 ? 'hover:bg-slate-50': 'bg-slate-100 hover:bg-slate-100 cursor-not-allowed'">Next</button>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data: () => ({
    clients: [],
    currentPage: 1,
    totalPages: 0,
    searchTerm: '',
    searchTimeout: null
  }),
  mounted() {
    this.fetchClients();
  },
  methods: {
    fetchClients() {
      axios.get(`/api/clients?page=${this.currentPage}${this.searchTerm ? '&search='+this.searchTerm : ''}`)
        .then(response => {
          this.clients = response.data.data;
          this.totalPages = response.data.last_page;
        })
        .catch(error => {
          console.log(error);
        })
    },
    handleInput() {
        clearTimeout(this.searchTimeout);
        this.searchTimeout = setTimeout(this.search, 500);
    },
    search() {
      this.currentPage = 1;
      this.fetchClients();
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
        this.fetchClients();
      }
    },
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
        this.fetchClients();
      }
    },
    navigateToCustomer(id) {
      window.open(`/backend/settings/clients/${id}`, '_self')
    }
  }
}
</script>
