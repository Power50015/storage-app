<template>
  <AppLayout title="المنتجات">
    <div class="py-6">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
          <h2 class="title font-bold mb-4">إضافه شركه</h2>
          <form action="POST" @submit.prevent="addPeople">
            <!--Name-->
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300">
                أسم الشركه
                <span class="text-red-800 font-bold">*</span>
              </label>
              <div v-if="errors.name" class="text-red-800">
                {{ errors.name }}
              </div>
              <input
                type="text"
                v-model="peopleAddForm.name"
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
            <!--Type-->
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300"
                >نوع الشركه
                <span class="text-red-800 font-bold">*</span>
              </label>
              <div v-if="errors.type" class="text-red-800">
                {{ errors.type }}
              </div>
              <select
                v-model="peopleAddForm.type"
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
              >
                <option value="عميل">عميل</option>
                <option value="مورد">مورد</option>
              </select>
            </div>
            <!--Phone-->
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300"> رقم الهاتف </label>
              <div v-if="errors.phone" class="text-red-800">
                {{ errors.phone }}
              </div>
              <input
                type="text"
                v-model="peopleAddForm.phone"
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
            <!--Address-->
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300">عنوان الشركه</label>
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
                  rounded-r-md
                "
                dir="ltr"
              >
                <QuillEditor
                  theme="snow"
                  toolbar="minimal"
                  v-model:content="peopleAddForm.address"
                  contentType="html"
                />
              </div>
            </div>
            <!--Logo-->
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300" for="file_input"
                >شعار الشركه
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
            <!--Button-->
            <div>
              <button
                type="submit"
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
                "
              >
                حفظ الشركه
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import axios from "axios";
import { computed, provide, readonly, ref, reactive } from "@vue/runtime-core";
import { Inertia } from "@inertiajs/inertia";
import { createToast } from "mosha-vue-toastify";
import { QuillEditor } from "@vueup/vue-quill";

import AppLayout from "@/Layouts/AppLayout.vue";

provide("title", "العملاء و الموردين");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    { index: 1, linkTitle: "العملاء و الموردين", linkRoute: "#" },
  ])
);

const props = defineProps(["errors", "people"]);

const imgData = reactive([]);
const imgPreview = ref();

const peopleAddForm = reactive({
  name: null,
  phone: null,
  address: null,
  type: null,
  logo: null,
});

function addPeople() {
  peopleAddForm.logo = imgData.value;
  Inertia.post(route("people.store"), peopleAddForm, {
    onSuccess: () => {
      createToast(
        {
          title: "تم تسجيل " + peopleAddForm.type,
          description: `تم تسجيل ${peopleAddForm.type}  ${peopleAddForm.name}`,
        },
        {
          timeout: 3000,
          transition: "slide",
          type: "success",
          showIcon: true,
        }
      );
      peopleAddForm.name = null;
      peopleAddForm.phone = null;
      peopleAddForm.address = null;
      peopleAddForm.type = null;
      peopleAddForm.logo = null;
      imgData.length = 0;
      imgPreview.value = null;
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
/*const warehouseData = computed(() => {
    return props.warehouse;
});*/
</script>
