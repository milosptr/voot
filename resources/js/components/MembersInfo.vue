<template>
  <div class="mt-8">
    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
          <table class="min-w-full divide-y divide-gray-300">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="w-48 whitespace-nowrap py-3.5 px-4 text-left text-sm font-semibold text-gray-900">{{ translateItem('name') }}</th>
                <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">{{ translateItem('shoe_size') }}</th>
                <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">{{ translateItem('glove_size') }}</th>
                <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">{{ translateItem('suit_size') }}</th>
                <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">{{ translateItem('jacket_size') }}</th>
                <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">{{ translateItem('vest_size') }}</th>
                <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">{{ translateItem('pants_size') }}</th>
                <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">{{ translateItem('head_size') }}</th>
                <th scope="col" class="relative whitespace-nowrap py-3.5 px-2">
                  <span class="sr-only">{{ translateItem('edit') }}</span>
                </th>
                <th scope="col" class="relative whitespace-nowrap py-3.5 px-2 sm:pr-4">
                  <span class="sr-only">{{ translateItem('delete') }}</span>
                </th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
              <members-info-item v-for="(member, index) in members" :key="member.id" :member="member" @delete="handleDelete(member, index)" @save="handleSave" />
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="mt-6">
      <div
        class="text-white border border-primary-lighter bg-primary-lighter group inline-block cursor-pointer px-6 py-2 text-sm font-normal rounded-md hover:bg-primary-light"
        :class="{'cursor-not-allowed border-primary-lightest bg-primary-lightest hover:bg-primary-lightest': addingNewMember}"
        @click="addMember"
      >
        {{ translateItem('add_new_member') }}
      </div>
    </div>
  </div>
</template>

<script>
  import MembersInfoItem from './MembersInfoItem.vue'
  export default {
    components: { MembersInfoItem },
    data: () => ({
      user_id: null,
      members: [],
    }),
    computed: {
      addingNewMember() {
        return this.members.some((m) => m.id === 0)
      }
    },
    mounted() {
      this.user_id = document.getElementById('members-info').dataset.key
      axios.get('/api/members-info/' + this.user_id)
        .then((res) => {
          this.members = res.data
        })
    },
    methods: {
      addMember() {
        if(!this.addingNewMember)
          this.members.push({ id: 0, user_id: this.user_id })
      },
      handleDelete(member, index) {
        if(member.id)
          axios.delete('/api/members-info/' + member.id)
        this.members.splice(index, 1)
      },
      handleSave() {
        axios.get('/api/members-info/' + this.user_id)
          .then((res) => {
            this.members = res.data
          })
      },
      translateItem(item) {
        const translation = {
          'is': {
            'name': 'Nafn',
            'shoe_size': 'Skóstærð',
            'glove_size': 'Hanskastærð',
            'jacket_size': 'Jakkastærð',
            'vest_size': 'Buxnastærð',
            'pants_size': 'Vestisstærð',
            'head_size': 'Húfustærð',
            'add_new_member': 'Bæta við Nýjum Meðlim',
            'save': 'Vista',
            'edit': 'Breyta',
            'delete': 'Eyða',
          },
          'en': {
            'name': 'Name',
            'shoe_size': 'Shoe size',
            'glove_size': 'Glove size',
            'jacket_size': 'Jacket size',
            'vest_size': 'Vest size',
            'pants_size': 'Pants size',
            'shirt_size': 'Shirt size',
            'head_size': 'Head size',
            'add_new_member': 'Add New Member',
            'save': 'Save',
            'edit': 'Edit',
            'delete': 'Delete',
          }
        }

        return translation[current_locale][item]
      },
    }
  }
</script>
