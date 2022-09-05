<template>
  <div class="bg-white overflow-hidden shadow rounded-lg">
    <div class="px-4 py-5 sm:p-6">
      <div class="text-lg text-black font-medium">Product Table</div>
      <div class="mt-6">
        <div class="flex items-end gap-4">
          <label>Columns <input type="number" v-model.number="nColumns" min="1" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-48 sm:text-sm border-gray-300 rounded-md" /></label>
          <label>Rows <input type="number" v-model.number="nRows" min="1" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-48 sm:text-sm border-gray-300 rounded-md" /></label>
          <div class="ml-auto text-center text-red-600 border border-red-500 px-6 py-2 text-sm font-normal rounded-md hover:bg-red-500 hover:text-white cursor-pointer" @click="resetTable">
            Reset
          </div>
        </div>
        <table class="block overflow-scroll w-full h-64 mt-4">
          <tr v-for="row in nRows" :key="row" class="block" :class="{ 'mb-3': row === 1 }">
            <td v-for="column in nColumns" :key="column" :class="{ 'bg-gray-200': row === 1 }">
              <input type="text"
                class="m-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-48 sm:text-sm border-gray-300 rounded-md"
                :class="{ 'my-2': row === 1 }"
                :placeholder="row === 1 ? 'Column name' : ''"
                :value="table?.[row-1]?.[column-1]"
                @input="updateColumn(row,column,$event)"
              />
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data: () => ({
      nColumns: 4,
      nRows: 3,
      table: [],
      table_org: [],
    }),
    watch: {
      nRows(v) {
        if(v > this.table.length) {
          this.table.push([...Array(this.nColumns - 1).keys()].map((c) => ''))
          this.updateTable()
        }
        if(v < this.table.length) {
          this.table.pop()
          this.updateTable()
        }
      },
      nColumns(v) {
         this.table.forEach((r) => {
            if(r.length > v)
              r.splice(-1)
              this.updateTable()
          })
      },
    },
    computed: {
      product() {
        return this.$store.getters.product
      }
    },
    mounted() {
      this.setTable()
    },
    methods: {
      updateColumn(row,column,e) {
        this.table[row-1].splice(column-1, 1, e.target.value)
        this.updateTable()
      },
      setTable() {
        const table = this.product?.product_table
        this.table = table ? JSON.parse(table) : [["","","",""],["","","",""],["","","",""]]
        this.table_org = _.cloneDeep(this.table)
        if(this.table.length)
          this.nRows = this.table.length
        if(this.table.length && this.table[0].length)
          this.nColumns = this.table[0].length
      },
      resetTable() {
        this.table = _.cloneDeep(this.table_org)
        if(this.table.length)
          this.nRows = this.table.length
        if(this.table.length && this.table[0].length)
          this.nColumns = this.table[0].length
        this.updateTable()
      },
      updateTable() {
        this.$store.commit('updateProductField', {key: 'product_table', value: JSON.stringify(this.table)})
      }
    }
  }
</script>
