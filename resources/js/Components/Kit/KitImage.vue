<template>
  <div>
    <div class="flex justify-between mb-5">
      <h2 class="font-bold text-2xl my-3">صور قطعه الغيار</h2>
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
        أضف ملف
      </div>
    </div>
    <table class="w-full text-right">
      <tbody
        class="
          grid grid-cols-1
          gap-y-10
          sm:grid-cols-2
          gap-x-6
          lg:grid-cols-3
          xl:grid-cols-4 xl:gap-x-8
          mt-5
        "
      >
        <tr v-for="i in image" :key="i.index" class="">
          <td
            class="py-3 px-3 flex w-full justify-between items-center break-all"
          >
            <a
              :href="`/storage/${i.image}`"
              class="hover:text-[#0095e8]"
              target="_blank"
            >
              <img
                :src="`/storage/${i.image}`"
                :alt="`/storage/${i.image}`"
                class="w-56"
              />
            </a>
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
                mx-3
              "
              @click="deleteModelOpen(i.id, i.image)"
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
                  هل أنت متاكد من حذف الصوره .
                </h2>
                <img
                  :src="`/storage/${i.image}`"
                  :alt="`/storage/${i.image}`"
                  class="w-56"
                />
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
                    @click="deleteImage(i.id)"
                  >
                    حذف الصوره
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
          <h2 class="title font-bold mb-4">إضافه صوره</h2>
          <!--KitImages-->
          <div class="mb-5">
            <label class="px-3 dark:text-gray-300" for="file_input"
              >الصوره الرئيسيه لقطع الغيار<span class="text-red-800 font-bold"
                >*</span
              >
            </label>
            <template v-if="imgPreview">
              <img
                :src="imgPreview"
                class="img-fluid"
                height="300"
                width="300"
              />
              <p class="mb-0">أسم الملف: {{ form.image.name }}</p>
              <p class="mb-0">
                حجم الملف: {{ Math.round(form.image.size / 1024) }}KB
              </p>
            </template>
            <input
              class="
                block
                w-full
                text-sm text-gray-900
                rounded-lg
                border border-gray-300
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
          <div
            @click="addImage"
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
            حفظ الملف
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
import { createToast } from "mosha-vue-toastify";

const props = defineProps(["image", "id"]);
const image = computed(() => {
  return props.image;
});

const showModel = ref(false);

const form = reactive({
  kit_id: props.id,
  image: null,
});
const imgPreview = ref();
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

function addImage() {
  Inertia.post(route("kit-image.store"), form, {
    onSuccess: () => {
      createToast(
        {
          title: "تم تسجيل الصوره",
        },
        {
          timeout: 3000,
          transition: "slide",
          type: "success",
          showIcon: true,
        }
      );
      showModel.value = false;
      form.image = null;
      imgPreview.value = null;
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

function deleteImage(id) {
  /**
   * PUT/PATCH/DELETE method
   * https://github.com/inertiajs/inertia/issues/495
   *
   */
  Inertia.delete(route("kit-image.destroy", id), {
    onSuccess: () => {
      createToast(
        {
          title: "تم حذف الصوره",
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
  image: null,
});

function deleteModelOpen(id, note) {
  deleteModel.id = id;
  deleteModel.image = note;
}

function DetectFiles(input) {
  form.image = input[0];

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