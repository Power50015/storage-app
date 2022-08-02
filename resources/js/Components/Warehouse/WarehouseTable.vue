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
  <div class="model" v-if="showModel">
    <div class="model-overlay" @click="showModel = false"></div>
    <div
      class="model-content max-w-7xl mx-auto sm:px-6 lg:px-8 z-10 lg:w-[750px]"
    >
      <div
        class="
          dark:bg-[#1e1e2d]
          bg-white
          dark:text-white
          text-black
          overflow-hidden
          shadow-xl
          rounded-md
          p-4
        "
      >
        <h2 class="title font-bold mb-4">تعديل بيانات المخزن</h2>
        <div>
          <div class="mb-5">
            <label class="px-3 dark:text-gray-300">
              أسم المخزن
              <span class="text-red-800 font-bold">*</span>
            </label>
            <input
              type="text"
              v-model="warehouseAddFormEdit.nameEdit"
              class="
                w-full
                text-base
                dark:bg-[#1b1b29]
                bg-[#f5f8fa]
                dark:active:bg-[#1b1b29]
                active:bg-[#f5f8fa]
                dark:focus:bg-[#1b1b29]
                focus:bg-[#f5f8fa]
                mt-3
                focus:ring-0
                border-0
                shadow-sm
                rounded-md
                py-2
              "
            />
          </div>
          <div class="mb-5">
            <label class="px-3 dark:text-gray-300">عنوان المخزن</label>
            <div
              class="
                w-full
                text-base
                dark:bg-[#1b1b29]
                bg-[#f5f8fa]
                dark:active:bg-[#1b1b29]
                active:bg-[#f5f8fa]
                dark:focus:bg-[#1b1b29]
                focus:bg-[#f5f8fa]
                mt-3
                focus:ring-0
                border-0
                shadow-sm
                py-2
                min-h-[100px]
              "
            >
              <QuillEditor
                theme="snow"
                toolbar="minimal"
                v-model:content="warehouseAddFormEdit.address"
                contentType="html"
              />
            </div>
          </div>
          <div>
            <div
              @click="editWarehouse"
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
                focus:outline-none
                focus:ring-2
                focus:ring-offset-2
                focus:ring-[#0095e8]
                cursor-pointer
              "
            >
              حفظ التعديل
            </div>
          </div>
        </div>
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

<style scoped>
.model {
  width: 100%;
  height: 100%;
  min-height: 100vh;
  position: fixed;
  right: 0px;
  z-index: 82;
  display: flex;
  align-items: center;
  justify-content: center;
  align-content: center;
  top: 0;
}

.model-overlay {
  width: 100%;
  height: 100%;
  position: absolute;
  background: #eeeeee26;
  z-index: 1;
}
</style>