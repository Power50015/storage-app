<template>
  <div
    class="flex content-center items-center justify-between mt-6 hover:gray-500"
  >
    <Link
      :href="route('warehouse.show', props.id)"
      class="data hover:text-[#009ef7]"
    >
      <h3 class="pb-3">{{ props.name }}</h3>
      <div v-html="props.address" class="text-xs"></div>
    </Link>
    <div class="action">
      <div
        class="
          bg-[#009ef7]
          border border-transparent
          rounded-md
          py-2
          px-2
          flex
          items-center
          justify-center
          text-base
          font-medium
          text-white
          hover:bg-[#0095e8]
          focus:outline-none
          focus:ring-2
          focus:ring-offset-2
          focus:ring-[#0095e8]
          cursor-pointer
        "
        @click="showModel = true"
      >
        <i class="fa-solid fa-pen-to-square"></i>
        <span class="mx-3">تعديل</span>
      </div>
    </div>
  </div>
</template>
  
  <script setup >
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { onMounted, onUnmounted, reactive, ref } from "@vue/runtime-core";
import { createToast } from "mosha-vue-toastify";
import { QuillEditor } from "@vueup/vue-quill";

const props = defineProps({
  id: {},
  name: {
    default: null,
  },
  address: {
    default: "",
  },
});

const showModel = ref(false);

const closeOnEscape = (e) => {
  if (showModel.value && e.key === "Escape") {
    showModel.value = false;
  }
};

onMounted(() => document.addEventListener("keydown", closeOnEscape));
onUnmounted(() => document.removeEventListener("keydown", closeOnEscape));

const warehouseAddFormEdit = reactive({
  id: props.id,
  nameEdit: props.name,
  address: props.address,
});

function editWarehouse() {
  Inertia.put(route("warehouse.update", props.id), warehouseAddFormEdit, {
    onSuccess: () => {
      createToast(
        {
          title: "تم تعديل المخزن",
          description: " تم تعديل المخزن " + warehouseAddFormEdit.nameEdit,
        },
        {
          timeout: 3000,
          transition: "slide",
          type: "success",
          showIcon: true,
        }
      );
      showModel.value = false;
    },
    onError: (errors) => {
      for (const [key, value] of Object.entries(errors)) {
        for (const key in errors) {
          createToast(
            {
              title: value,
            },
            {
              timeout: 3000,
              transition: "slide",
              type: "danger",
              showIcon: true,
            }
          );
        }
      }
    },
  });
}
</script>
  