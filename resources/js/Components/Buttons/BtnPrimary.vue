<template>
  <button
    :type="type"
    class="
      mt-6
      w-full
      bg-[#009ef7]
      border border-transparent
      rounded-md
      py-3
      px-8
      flex
      items-center
      justify-center
      text-base
      font-medium
      text-white
      hover:bg-[#0095e8]
      focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0095e8]
    "
  >
    {{ title }}
  </button>
</template>
  <script setup>
const props = defineProps({
  type: {
    type: String,
    required: true,
  },
  title: {
    type: String,
    required: true,
  },
});
</script>