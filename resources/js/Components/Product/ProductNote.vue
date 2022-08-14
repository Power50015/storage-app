<template>
  <div>
    <div class="flex justify-between mb-5">
      <h2 class="font-bold text-2xl my-3">الملاحظات</h2>
      <div
        class="
          print:hidden
          bg-[#009ef7]
          border border-transparent
          rounded-md
          py-3
          px-3
          flex
          items-center
          justify-center
          text-base text-white
          hover:bg-[#009ef7]
          focus:outline-none
          focus:ring-2
          focus:ring-offset-2
          focus:ring-[#009ef7]
          cursor-pointer
        "
        @click="showModel = true"
      >
        أضف ملاحظه
      </div>
    </div>
    <table
      class="border border-dashed border-slate-700 w-full text-right"
      id="xyz"
    >
      <tbody>
        <tr v-for="i in note" :key="i.index" class="">
          <td
            class="
              border border-dashed border-slate-700
              py-3
              px-3
              flex
              w-full
              justify-between
              items-center
              break-all	
            "
          >
            <div v-html="i.note"></div>
            <div
              class="
                bg-[#EF305E]
                text-white
                hover:bg-[#EF305E]
                cursor-pointer
                text-base
                mt-3
                focus:ring-0
                border-0
                py-3
                px-8
                w-[80px]
                flex
                items-center
                justify-center
                rounded-md
              "
              @click="deleteModelOpen(i.id, i.note)"
            >
              <i class="fa-solid fa-xmark"></i>
            </div>
          </td>
          <div class="model" v-if="deleteModel.id == i.id">
            <div class="model-overlay" @click="deleteModel.id = null"></div>
            <div
              class="
                model-content
                mx-auto
                sm:px-6
                lg:px-8
                z-10
                md:w-[750px]
                w-full
              "
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
                <h2 class="title font-bold mb-4">
                  هل أنت متاكد من حذف الملاحظه .
                </h2>
                <div v-html="i.note"></div>
                <div class="flex justify-between px-6">
                  <div
                    class="
                      mt-6
                      bg-[#EF305E]
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
                      hover:bg-[#EF305E]
                      focus:outline-none
                      focus:ring-2
                      focus:ring-offset-2
                      focus:ring-[#EF305E]
                      cursor-pointer
                    "
                    @click="deleteNote(i.id)"
                  >
                    حذف الملاحظات
                  </div>
                  <div
                    class="
                      mt-6
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
                    @click="deleteModel.id = null"
                  >
                    إلغاء
                  </div>
                </div>
              </div>
            </div>
          </div>
        </tr>
      </tbody>
    </table>
    <div class="model" v-if="showModel">
      <div class="model-overlay" @click="showModel = false"></div>
      <div
        class="model-content mx-auto sm:px-6 lg:px-8 z-10 md:w-[750px] w-full"
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
          <h2 class="title font-bold mb-4">إضافه ملاحظه</h2>
          <div class="mb-5">
            <label class="px-3 dark:text-gray-300">ملاحظه</label>
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
                v-model:content="form.note"
                contentType="html"
              />
            </div>
          </div>
          <div
            @click="addNote"
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
            حفظ الملاحظه
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { reactive, ref } from "vue";
import {
  computed,
  onMounted,
  onUnmounted,
  provide,
  readonly,
} from "@vue/runtime-core";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { QuillEditor } from "@vueup/vue-quill";
import { createToast } from "mosha-vue-toastify";

const props = defineProps(["note", "id"]);
const note = computed(() => {
  return props.note;
});

function dateFormat(x) {
  var options = {
    weekday: "long",
    year: "numeric",
    month: "long",
    day: "numeric",
  };
  var today = new Date(x);
  return today.toLocaleDateString("ar-EG", options);
}

const showModel = ref(false);

const form = reactive({
  product_id: props.id,
  note: null,
});

const closeOnEscape = (e) => {
  if (showModel.value && e.key === "Escape") {
    showModel.value = false;
  }
  if (deleteModel.id != null && e.key === "Escape") {
    deleteModel.id = null;
  }
};

onMounted(() => document.addEventListener("keydown", closeOnEscape));
onUnmounted(() => document.removeEventListener("keydown", closeOnEscape));

function addNote() {
  Inertia.post(route("product-note.store"), form, {
    onSuccess: () => {
      createToast(
        {
          title: "تم تسجيل ملاحظه المنتج",
        },
        {
          timeout: 3000,
          transition: "slide",
          type: "success",
          showIcon: true,
        }
      );
      showModel.value = false;
      form.note = null;
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

function deleteNote(id) {
  /**
   * PUT/PATCH/DELETE method
   * https://github.com/inertiajs/inertia/issues/495
   *
   */
  Inertia.delete(route("product-note.destroy", id), {
    onSuccess: () => {
      createToast(
        {
          title: "تم حذف الملاحظه",
        },
        {
          timeout: 3000,
          transition: "slide",
          type: "success",
          showIcon: true,
        }
      );
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

const deleteModel = reactive({
  id: null,
  note: "",
});
function deleteModelOpen(id, note) {
  deleteModel.id = id;
  deleteModel.note = note;
}
</script>
<style>
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