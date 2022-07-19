<template>
  <AppLayout title="كاش">
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
          <h2 class="title font-bold mb-4">إضافه كاش</h2>
          <form action="POST" @submit.prevent="addCash">
            <!-- Title -->
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300">
                البند
                <span class="text-red-800 font-bold">*</span>
              </label>
              <div v-if="errors.title" class="text-red-800">
                {{ errors.title }}
              </div>
              <input
                type="text"
                v-model="cashAddForm.title"
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
            <!-- Attachment -->
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300" for="file_input">ملف</label>
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
                @change="cashAddForm.attachment = ($event.target.files)[0]"
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
                حفظ بند الكاش
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { computed, provide, readonly, ref, reactive } from "@vue/runtime-core";
import { Inertia } from "@inertiajs/inertia";
import { createToast } from "mosha-vue-toastify";
import AppLayout from "@/Layouts/AppLayout.vue";

provide("title", "الكاش");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    { index: 1, linkTitle: "الكاش", linkRoute: "#" },
  ])
);

const props = defineProps(["errors", "cash"]);


const cashAddForm = reactive({
  title: null,
  attachment: null,
});

function addCash() {
  Inertia.post(route("cash.store"), cashAddForm, {
    onSuccess: () => {
      createToast(
        {
          title: "تم تسجيل بند الكاش .",
          description: `تم تسجيل ${cashAddForm.title}`,
        },
        {
          timeout: 3000,
          transition: "slide",
          type: "success",
          showIcon: true,
        }
      );
      cashAddForm.title = null;
      attachment.length = 0;
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

/*const warehouseData = computed(() => {
    return props.warehouse;
});*/
</script>
