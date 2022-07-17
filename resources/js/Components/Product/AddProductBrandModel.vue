<template>
  <div
    class="
      w-[20px]
      bg-[#009ef7]
      border border-transparent
      rounded-l-md
      px-7
      flex
      items-center
      justify-center
      text-lg text-white
      hover:bg-[#009ef7]
      cursor-pointer
    "
    @click="showModel = true"
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
        <h2 class="title font-bold mb-4">إضافه ماركه</h2>
        <div>
          <div class="mb-5">
            <label class="px-3 dark:text-gray-300">
              أسم الماركه
              <span class="text-red-800 font-bold">*</span>
            </label>
            <input
              type="text"
              v-model="productBrandForm.nameProductBrand"
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
          <!-- Brand Image -->
          <div class="mb-5">
            <label
              class="
                block
                mb-2
                text-sm
                font-medium
                text-gray-900
                dark:text-gray-300
              "
              for="file_input"
              >شعار الماركه <span class="text-red-800 font-bold">*</span>
            </label>
            <template v-if="imgPreview">
              <img
                :src="imgPreview"
                class="img-fluid"
                height="300"
                width="300"
              />
              <p class="mb-0">أسم الملف: {{ imgData.value.name }}</p>
              <p class="mb-0">
                حجم الملف: {{ Math.round(imgData.value.size / 1024) }}KB
              </p>
            </template>
            <input
              class="
                block
                w-full
                text-sm text-gray-900
                rounded-lg
                border border-gray-300
                cursor-pointer
                dark:text-gray-400
                focus:outline-none
                dark:bg-[#1b1b29]
                bg-[#f5f8fa]
                dark:border-gray-600 dark:placeholder-gray-400
                cursor-pointer
              "
              id="file_input"
              type="file"
              @change="DetectFiles($event.target.files)"
            />
          </div>
          <!-- Product Country -->
          <div class="mb-5">
            <label class="px-3 dark:text-gray-300">
              بلد الماركه
              <span class="text-red-800 font-bold">*</span>
            </label>
            <div class="flex">
              <select
                class="
                  w-full
                  text-base
                  dark:bg-[#1b1b29]
                  bg-[#f5f8fa]
                  dark:active:bg-[#1b1b29]
                  active:bg-[#f5f8fa]
                  dark:focus:bg-[#1b1b29]
                  focus:bg-[#f5f8fa] focus:ring-0
                  border-0
                  shadow-sm
                  rounded-r-md
                  py-2
                "
                v-model="productBrandForm.countryProductBrand"
              >
                <option disabled selected>اختار بلد الماركه</option>
                <option
                  v-for="item in productCountry"
                  :value="item.id"
                  :key="item.id"
                >
                  {{ item.name }}
                </option>
              </select>
            </div>
          </div>
          <div>
            <div
              @click="addProductBrand"
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
              حفظ الماركه
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
  productCountry: {
    default: null,
  },
});

const showModel = ref(false);
const productBrandForm = reactive({
  nameProductBrand: null,
  countryProductBrand: null,
  imageProductBrand: null,
});

const imgData = reactive([]);
const imgPreview = ref("");

const closeOnEscape = (e) => {
  if (showModel.value && e.key === "Escape") {
    showModel.value = false;
  }
};

onMounted(() => document.addEventListener("keydown", closeOnEscape));
onUnmounted(() => document.removeEventListener("keydown", closeOnEscape));

function addProductBrand() {
  productBrandForm.imageProductBrand = imgData.value;
  Inertia.post(route("product-brand.store"), productBrandForm, {
    onSuccess: () => {
      createToast(
        {
          title: "تم تسجيل ماركه جديدة",
          description: " تم تسجيل الماركه " + productBrandForm.nameProductBrand,
        },
        {
          timeout: 3000,
          transition: "slide",
          type: "success",
          showIcon: true,
        }
      );
      productBrandForm.nameProductBrand = "";
      showModel.value = false;
    },
    onError: (errors) => {
      for (const [key, value] of Object.entries(errors)) {
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
    },
  });
}

function DetectFiles(input) {
  imgData.value = input[0];

  imgPreview.value = input[0];
  if (input) {
    var reader = new FileReader();
    reader.onload = (e) => {
      imgPreview.value = e.target.result;
    };
    reader.readAsDataURL(input[0]);
  }
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
