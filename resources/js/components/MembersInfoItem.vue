<template>
  <tr :class="{'bg-gray-100': editing}">
    <td class="whitespace-nowrap py-2 px-4 text-sm font-medium text-gray-900">
      <span v-if="!editing">{{ editMember.name }}</span>
      <input v-else type="text" v-model="editMember.name" class="block w-full py-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
    </td>
    <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-500">
      <span v-if="!editing">{{ editMember.shoe_size }}</span>
      <input v-else type="text" v-model="editMember.shoe_size" class="block w-full py-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
    </td>
    <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-500">
      <span v-if="!editing">{{ editMember.glove_size }}</span>
      <input v-else type="text" v-model="editMember.glove_size" class="block w-full py-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
    </td>
    <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-500">
      <span v-if="!editing">{{ editMember.headset_size }}</span>
      <input v-else type="text" v-model="editMember.headset_size" class="block w-full py-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
    </td>
    <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-500">
      <span v-if="!editing">{{ editMember.jacket_size }}</span>
      <input v-else type="text" v-model="editMember.jacket_size" class="block w-full py-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
    </td>
    <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-500">
      <span v-if="!editing">{{ editMember.vest_size }}</span>
      <input v-else type="text" v-model="editMember.vest_size" class="block w-full py-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
    </td>
    <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-500">
      <span v-if="!editing">{{ editMember.pants_size }}</span>
      <input v-else type="text" v-model="editMember.pants_size" class="block w-full py-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
    </td>
    <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-500">
      <span v-if="!editing">{{ editMember.shirt_size }}</span>
      <input v-else type="text" v-model="editMember.shirt_size" class="block w-full py-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
    </td>
    <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-500">
      <span v-if="!editing">{{ editMember.hat_size }}</span>
      <input v-else type="text" v-model="editMember.hat_size" class="block w-full py-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
    </td>
    <td
      class="relative whitespace-nowrap py-2 px-2 text-right text-sm font-medium cursor-pointer text-primary-lighter"
    >
      <span v-if="!editing" @click="handleEditMember">Edit</span>
      <span v-else @click="handleSaveMember">Save</span>
    </td>
    <td
      class="relative whitespace-nowrap py-2 px-2 text-right text-sm font-medium sm:pr-4 cursor-pointer text-red-500"
    >
      <span @click="handleDeleteMember">Delete</span>
    </td>
  </tr>
</template>

<script>
  export default {
    props: {
      member: {
        type: Object,
        default: () => {},
      }
    },
    data: () => ({
      editing: false,
      editMember: {},
    }),
    mounted() {
      this.editMember = {...this.member}
      if(this.member.id === 0) this.editing = true
    },
    methods: {
      handleEditMember() {
        this.editing = true
      },
      handleDeleteMember() {
        this.$emit('delete')
      },
      handleSaveMember() {
        if(this.member.id === 0) {
          axios.post('/api/members-info', this.editMember)
            .then((res) => {
              this.$emit('save')
              this.editing = false
            })
          return
        }
        axios.post('/api/members-info/' + this.member.id + '/edit', this.editMember)
          .then((res) => {
            this.$emit('save')
            this.editing = false
          })
      },
    }
  }
</script>
