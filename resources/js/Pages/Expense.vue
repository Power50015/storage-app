<template>
  <AppLayout title="المصاريف">
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
          <h2 class="title font-bold mb-4">إضافه مصروف</h2>
          <form action="POST" @submit.prevent="addExpense" autocomplete="off">
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300">
                بند المصروف
                <span class="text-red-800 font-bold">*</span>
              </label>
              <div v-if="errors.title" class="text-red-800">
                {{ errors.title }}
              </div>

              <input
                type="text"
                v-model="expensesAddForm.title"
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
                name="name"
              />
            </div>
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300">
                مبلغ المصروف
                <span class="text-red-800 font-bold">*</span>
              </label>
              <div v-if="errors.amount" class="text-red-800">
                {{ errors.amount }}
              </div>

              <input
                type="number"
                min="0.00"
                step="0.25"
                v-model="expensesAddForm.amount"
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
              <label class="px-3 dark:text-gray-300">
                تاريخ المصروف
                <span class="text-red-800 font-bold">*</span>
              </label>
              <div v-if="errors.date" class="text-red-800">
                {{ errors.date }}
              </div>

              <input
                type="date"
                v-model="expensesAddForm.date"
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
                  cursor-pointer
                "
              />
            </div>
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300">تفاصيل المصروف</label>
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
                  v-model:content="expensesAddForm.description"
                  contentType="html"
                />
              </div>
            </div>
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
                حفظ المصروف
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { reactive } from "vue";
import { computed, provide, readonly } from "@vue/runtime-core";
import { Inertia } from "@inertiajs/inertia";
import { createToast } from "mosha-vue-toastify";
import { QuillEditor } from "@vueup/vue-quill";

import AppLayout from "@/Layouts/AppLayout.vue";

provide("title", "المصاريف");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    { index: 1, linkTitle: "المصاريف", linkRoute: "#" },
  ])
);

const props = defineProps(["errors", "warehouse"]);
const warehouseData = computed(() => {
  return props.warehouse;
});

const expensesAddForm = reactive({
  title: null,
  description: null,
  date: new Date().toISOString().slice(0, 10),
  amount: 0.0,
});

function addExpense() {
  Inertia.post(route("expense.store"), expensesAddForm, {
    onSuccess: () => {
      createToast(
        {
          title: "تم تسجيل المصروف",
          description: " تم تسجيل المصروف " + expensesAddForm.title,
        },
        {
          timeout: 3000,
          transition: "slide",
          type: "success",
          showIcon: true,
        }
      );
      expensesAddForm.title = null;
      expensesAddForm.description = null;
      expensesAddForm.date = new Date().toISOString().slice(0, 10);
      expensesAddForm.amount = 0.0;
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
</script>

<style scoped>
/*================== || Date Picker ||==============================*/

/*-------Removes the // Before dd - day------------------------*/
input[type="date"]::-webkit-datetime-edit-text {
  color: transparent;
}

/*------- DatePicker ------------------------*/
input[type="date"] {
  font-weight: 900;
}

/*------- DatePicker - Focus ------------------------*/
input[type="date"]:focus {
  outline: none;
  box-shadow: 0 0 0 3px rgba(21, 156, 228, 0.4);
}

input[type="date"]::-webkit-datetime-edit,
input[type="date"]::-webkit-inner-spin-button,
input[type="date"]::-webkit-clear-button {
  color: #fff;
  position: relative;
}

/*------- Year ------------------------*/
input[type="date"]::-webkit-datetime-edit-year-field {
  @apply dark:text-gray-300 text-black;
  position: absolute !important;
  border-left: 1px solid #8c8c8c;
  padding: 2px;
  /* color: #000; */
  left: 56px;
}

/*------- Month ------------------------*/
input[type="date"]::-webkit-datetime-edit-month-field {
  @apply dark:text-gray-300 text-black;
  position: absolute !important;
  border-left: 1px solid #8c8c8c;
  padding: 2px;
  left: 26px;
}

/*------- Day ------------------------*/
input[type="date"]::-webkit-datetime-edit-day-field {
  @apply dark:text-gray-300 text-black;
  position: absolute !important;
  padding: 2px;
  left: 4px;
}
</style>