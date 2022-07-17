<template>
  <div
    class="
      w-[20px]
      border border-transparent
      rounded-l-md
      px-7
      flex
      items-center
      justify-center
      text-lg
    "
    @click="openOnEscape"
    :class="{
      'bg-slate-50 text-slate-500 cursor-default': productBrand === null,
      'bg-[#009ef7] hover:bg-[#009ef7] text-white cursor-pointer':
        productBrand != null,
    }"
  >
    <i class="fa-solid fa-plus"></i>
  </div>
  <div class="model" v-if="showModel">
    <div class="model-overlay" @click="showModel = false"></div>
    <div class="model-content max-w-7xl mx-auto sm:px-6 lg:px-8 z-10">
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
        <h2 class="title font-bold mb-4">إضافه عائله منتج</h2>
        <div>
          <div class="mb-5">
            <label class="px-3 dark:text-gray-300">
              عائله المنتج
              <span class="text-red-800 font-bold">*</span>
            </label>
            <input
              type="text"
              v-model="productCollectionForm.nameProductCollection"
              class="
                w-full
                text-base
                dark:bg-[#1b1b29]
                bg-[#f5f8fa]
                dark:active:bg-[#1b1b29]
                active:bg-[#f5f8fa]
                dark:focus:bg-[#1b1b29]
                focus:bg-[#f5f8fa]
                mt-1
                focus:ring-0
                border-0
                shadow-sm
                rounded-md
                py-2
              "
            />
          </div>
          <div>
            <div
              @click="addProductCollection"
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
                hover:bg-[#009ef7]
                focus:outline-none
                focus:ring-2
                focus:ring-offset-2
                focus:ring-[#009ef7]
                cursor-pointer
              "
            >
              حفظ النوع
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive, ref } from "@vue/reactivity";
import { onMounted, onUnmounted } from "@vue/runtime-core";
import { Inertia } from "@inertiajs/inertia";
import { createToast } from "mosha-vue-toastify";
const props = defineProps({
  productBrand: {
    default: null,
  },
});
const showModel = ref(false);
const closeOnEscape = (e) => {
  if (showModel.value && e.key === "Escape") {
    showModel.value = false;
  }
};

const openOnEscape = () => {
  if (props.productBrand != null) {
    showModel.value = true;
  }
};

const emit = defineEmits(["productCollectionSaveSuccess"]);

onMounted(() => document.addEventListener("keydown", closeOnEscape));
onUnmounted(() => document.removeEventListener("keydown", closeOnEscape));

const productCollectionForm = reactive({
  nameProductCollection: null,
  productBrand: null,
});

function addProductCollection() {
  productCollectionForm.productBrand = props.productBrand;
  Inertia.post(route("product-collection.store"), productCollectionForm, {
    onSuccess: () => {
      createToast(
        {
          title: "تم تسجيل نوع منتجات جديد",
          description: " تم تسجيل النوع " + productCollectionForm.nameProductCollection,
        },
        {
          timeout: 5000,
          transition: "slide",
          type: "success",
          showIcon: true,
        }
      );
      productCollectionForm.nameProductCollection = "";
      showModel.value = false;
      emit("productCollectionSaveSuccess");
    },
    onError: (errors) => {
      for (const [key, value] of Object.entries(errors)) {
        for (const key in errors) {
          createToast(
            {
              title: value,
            },
            {
              timeout: 5000,
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
