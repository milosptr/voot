<template>
  <div class="bg-white overflow-hidden shadow rounded-lg mt-6">
    <div class="px-4 py-5 sm:p-6">
      <div class="text-lg text-black font-medium">Product Options</div>
    </div>
    <div
      v-for="(option, index) in options"
      :key="index"
      class="border-t border-b border-gray-200"
    >
      <div class="single-option px-4 py-5 sm:p-6">
        <label for="option_name" class="block text-sm font-medium text-gray-700">Option name</label>
        <div class="flex">
          <input v-model="option.name" type="text" name="option_name" id="option_name" placeholder="Size, Color, Material, Length, Weight..." class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
          <img v-if="index > 0" :src="'/images/trash.svg'" width="24" height="24" alt="remove" class="ml-6 cursor-pointer" @click="removeOption(index)" />
        </div>
        <div class="pl-4 mt-3">
          <div class="block text-sm font-medium text-gray-700">Option values</div>
          <div v-for="(value, i) in optionValues[index]" :key="i" class="single-variant flex items-center">
            <input v-model="optionValues[index][i].value" @input="addValue(index, i, option.name)" type="text" name="option_1_values" placeholder="Add option value" class="mt-1 mr-6 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            <div style="width: 24px;">
            <img v-if="i > 0" :src="'/images/trash.svg'" width="24" height="24" alt="remove" class="cursor-pointer" @click="removeOptionValue(index, i)" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="px-4 py-5 sm:p-6">
      <div class="flex justify-between items-center">
        <div tabindex="0" class="text-center text-gray-600 border border-gray-400 bg-transparent px-6 py-2 text-sm font-normal rounded-md hover:bg-gray-500 hover:text-white cursor-pointer" @keydown.enter="$emit('save')" @click="$emit('save')">
          Save
        </div>
        <div tabindex="0" class="text-primary-lighter border-primary-lighter border font-normal rounded-md text-sm flex items-center px-6 py-2 cursor-pointer" @keydown.enter="addOption()" @click="addOption()">
          {{ options.length ? 'Add another option' : 'Add option' }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: {
      options: Array,
      optionValues: Array,
    },
    data: () => ({}),
    methods: {
      addOption() {
        this.options.push({ name: '' })
        this.optionValues.push([{value: '', option: ''}])
      },
      removeOption(index) {
        this.options.splice(index, 1)
        this.optionValues.splice(index, 1)
      },
      removeOptionValue(index, i) {
        this.optionValues[index].splice(i, 1)
      },
      addValue(index, i, optionName) {
        this.optionValues[index][i].option = optionName
        if(this.optionValues[index][i+1] === undefined)
          this.optionValues[index].push({value: '', option: optionName})
      },
    }
  }
</script>
