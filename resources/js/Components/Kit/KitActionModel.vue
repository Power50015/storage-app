<template>
  <div
    class="
      bg-[#009ef7]
      border border-transparent
      rounded
      px-7
      py-2
      flex
      items-center
      justify-center
      text-lg text-white
      hover:bg-[#009ef7]
      cursor-pointer
    "
    @click="showModel = true"
  >
    استخدام / اعدام
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
        <h2 class="title font-bold mb-4">استخدام / اعدام</h2>
        <div>
          <div class="mb-5">
            <label class="px-3 dark:text-gray-300">
              البند
              <span class="text-red-800 font-bold">*</span>
            </label>
            <input
              type="text"
              v-model="form.title"
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
          <div class="mb-5">
            <label class="px-3 dark:text-gray-300">
              الكميه
              <span class="text-red-800 font-bold">*</span>
            </label>
            <input
              type="number"
              min="0"
              v-model="form.nameProductBrand"
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
          <!-- Action -->
          <div class="mb-5">
            <label class="px-3 dark:text-gray-300"
              >استخدام / اعدام
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
                v-model="form.action"
              >
                <option value="0">أستخدام</option>
                <option value="1">إعدام</option>
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
              حفظ 
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
const form = reactive({
  title: null,
  quantity: null,
  action: null,
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
  Inertia.post(route(""), productBrandForm, {
    onSuccess: () => {
      createToast(
        {
          title: "تم تسجيل  ",
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
  