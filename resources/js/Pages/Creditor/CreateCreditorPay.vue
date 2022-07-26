<template>
  <AppLayout title="إضافه دفعه دين">
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
          <h2 class="title font-bold mb-4">إضافه دفعه دين</h2>
          <form action="POST" @submit.prevent="addDebtor">
            <!-- Companies -->
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300"
                >الشركه
                <span class="text-red-800 font-bold">*</span>
              </label>
              <div v-if="errors.companies" class="text-red-800">
                {{ errors.companies }}
              </div>
              <select
                v-model="debtorAddForm.companies"
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
                <option
                  v-for="item in companies"
                  :key="item.id"
                  :value="item.id"
                >
                  {{ item.name }} | {{ item.address }} | {{ item.phone }}
                </option>
              </select>
            </div>
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300">
                بند الدين
                <span class="text-red-800 font-bold">*</span>
              </label>
              <div v-if="errors.title" class="text-red-800">
                {{ errors.title }}
              </div>

              <input
                type="text"
                v-model="debtorAddForm.title"
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
                مبلغ الدين
                <span class="text-red-800 font-bold">*</span>
              </label>
              <div v-if="errors.amount" class="text-red-800">
                {{ errors.amount }}
              </div>

              <input
                type="number"
                min="0.00"
                step="0.25"
                v-model="debtorAddForm.amount"
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
            <!--Pay Type-->
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300"
                >نوع الدفع
                <span class="text-red-800 font-bold">*</span>
              </label>
              <div v-if="errors.pay_type" class="text-red-800">
                {{ errors.pay_type }}
              </div>
              <select
                v-model="debtorAddForm.pay_type"
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
                <option :value="false">تخليص</option>
                <option :value="true">كاش</option>
              </select>
            </div>
            <!--Cash Type-->
            <div class="mb-5" v-if="debtorAddForm.pay_type">
              <label class="px-3 dark:text-gray-300"
                >نوع الكاش
                <span class="text-red-800 font-bold">*</span>
              </label>
              <div v-if="errors.cash_type" class="text-red-800">
                {{ errors.cash_type }}
              </div>
              <select
                v-model="debtorAddForm.cash_type"
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
                <option v-for="item in cash" :key="item.id" :value="item.id">
                  {{ item.title }}
                </option>
              </select>
            </div>
            <!--debtor Attach-->
            <div
              class="mb-10 dark:bg-[#fefefe0d] dark:border-0 border py-7 px-3"
            >
              <h2 class="px-3 dark:text-gray-300 title font-bold mb-4">
                الملفات
                <span class="text-red-800 font-bold">*</span>
              </h2>
              <div v-for="(i, index) in debtorAddForm.attachment" :key="index">
                <div class="w-full my-5">
                  <h3>{{ 1 + index }}</h3>
                  <label class="px-3 dark:text-gray-300"
                    >الملف
                    <span class="text-red-800 font-bold">*</span>
                  </label>
                  <div class="flex">
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
                      @change="
                        debtorAddForm.attachment[index].attachment =
                          $event.target.files[0]
                      "
                    />
                    <!-- Delete -->
                    <div class="mb-5">
                      <div
                        class="
                          bg-[#EF305E]
                          text-lg text-white
                          hover:bg-[#EF305E]
                          cursor-pointer
                          w-full
                          text-base
                          mt-3
                          focus:ring-0
                          border-0
                          py-3
                          w-[80px]
                          flex
                          items-center
                          justify-center
                          rounded-md
                        "
                        @click="
                          debtorAddForm.attachment =
                            debtorAddForm.attachment.filter(
                              (item) => item.id != i.id
                            )
                        "
                      >
                        <i class="fa-solid fa-xmark"></i>
                      </div>
                    </div>
                  </div>
                </div>

                <hr
                  v-if="
                    debtorAddForm.attachment.length > 1 &&
                    debtorAddForm.attachment.length != index
                  "
                />
              </div>

              <div>
                <!--New Item-->
                <div
                  class="
                    mt-10
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
                  @click="pushToAttachment"
                >
                  أضف ملف
                </div>
              </div>
            </div>
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300">تفاصيل الدين</label>
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
                  v-model:content="debtorAddForm.description"
                  contentType="html"
                />
              </div>
            </div>
            <div
              class="mb-10 dark:bg-[#fefefe0d] dark:border-0 border py-7 px-3"
            >
              <!--Save debtor-->
              <div>
                <button
                  type="submit"
                  class="
                    mt-10
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
                  حفظ الدفعه
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { reactive } from "vue";
import { computed, provide, readonly, ref } from "@vue/runtime-core";
import { Inertia } from "@inertiajs/inertia";
import { createToast } from "mosha-vue-toastify";
import { QuillEditor } from "@vueup/vue-quill";
import AppLayout from "@/Layouts/AppLayout.vue";

provide("title", "إضافه دفعه دين");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    {
      index: 1,
      linkTitle: "دائنون",
      linkRoute: "debtor.index",
    },
    {
      index: 2,
      linkTitle: "إضافه دفعه دين",
      linkRoute: "#",
    },
  ])
);

const props = defineProps(["errors", "cash", "companies"]);

const debtorAddForm = reactive({
  companies: null,
  title: null,
  amount: 0.0,
  description: null,
  pay_type: false,
  cash_type:null,
  attachment: [],
});

function addDebtor() {
  Inertia.post(route("creditor.store"), debtorAddForm, {
    onSuccess: () => {
      createToast(
        {
          title: "تم تسجيل الدفع " ,
          description: " تم تسجيل الدفعه ",
        },
        {
          timeout: 3000,
          transition: "slide",
          type: "success",
          showIcon: true,
        }
      );
      debtorAddForm.companies = null;
      debtorAddForm.title = null;
      debtorAddForm.description = null;
      debtorAddForm.amount = 0.0;
      debtorAddForm.attachment.length = 0;
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

function pushToAttachment() {
  debtorAddForm.attachment.push({
    id: debtorAddForm.attachment.length + 1,
    attachment: null,
  });
}
</script>
