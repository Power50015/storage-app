<template>
  <AppLayout title="قطع غيار">
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
          <h2 class="title font-bold mb-4">قطع غيار</h2>
          <form action="POST" @submit.prevent="addKit">
            <!-- Kit Title -->
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
                v-model="kitAddForm.title"
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
            <!-- Kit Product -->
            <div class="w-full my-5">
              <label class="px-3 dark:text-gray-300"
                >المنتج
                <span class="text-red-800 font-bold">*</span>
              </label>
              <div v-if="errors.product" class="text-red-800">
                {{ errors.product }}
              </div>
              <select
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
                v-model="kitAddForm.product"
              >
                <option
                  v-for="product in products"
                  :key="product.index"
                  :value="product.id"
                >
                  <template v-if="product.product_brand"
                    >{{ product.product_brand.name }} |</template
                  >
                  <template v-if="product.product_category">
                    {{ product.product_category.name }}</template
                  >
                  <template v-if="product.product_type">
                    |{{ product.product_type.name }}
                  </template>
                  <template v-if="product.product_collection">
                    |{{ product.product_collection.name }}
                  </template>
                  <template v-if="product.product_model">
                    |{{ product.product_model.name }}
                  </template>
                  <template v-if="product.product_color">
                    |{{ product.product_color.name }}
                  </template>
                  <template v-if="product.product_material">
                    |{{ product.product_material.name }}
                  </template>
                  <template v-if="product.product_country">
                    | {{ product.product_country.name }}</template
                  >
                  <template v-if="product.sku"> | {{ product.sku }}</template>
                  {{ product.name }}
                </option>
              </select>
            </div>
            <!-- Kit Description-->
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300">تفاصيل قطعه الغيار</label>
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
                  v-model:content="kitAddForm.description"
                  contentType="html"
                />
              </div>
            </div>
            <!--ProductImages-->
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300" for="file_input"
                >الصوره الرئيسيه للمنتج<span class="text-red-800 font-bold"
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
                <p class="mb-0">أسم الملف: {{ imgData.value.name }}</p>
                <p class="mb-0">
                  حجم الملف: {{ Math.round(imgData.value.size / 1024) }}KB
                </p>
              </template>
              <img
                :src="`/storage/${props.kit[0].image}`"
                width="250"
                class="my-4"
              />
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
              class="mb-10 dark:bg-[#fefefe0d] dark:border-0 border py-7 px-3"
            >
              <!--Save Kit-->
              <div>
                <button
                  type="submit"
                  class="
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
                  حفظ قطعه الغيار
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

provide("title", "قطع غيار");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    {
      index: 1,
      linkTitle: "قطع غيار",
      linkRoute: "kit.index",
    },
    { index: 2, linkTitle: "تعديل قطع غيار", linkRoute: "#" },
  ])
);

const props = defineProps(["errors", "kit", "products"]);

const kitAddForm = reactive({
  title: props.kit[0].title,
  product: props.kit[0].product_id,
  description: props.kit[0].description,
  image: null,
  oldImage: props.kit[0].image,
  _method: "patch",
});

function addKit() {
  kitAddForm.image = imgData.value;
  Inertia.post(route("kit.update", props.kit[0].id), kitAddForm, {
    onSuccess: () => {
      createToast(
        {
          title: "تم تعديل قطعه الغيار",
          description: "تم تعديل قطعه الغيار" + kitAddForm.title,
        },
        {
          timeout: 3000,
          transition: "slide",
          type: "success",
          showIcon: true,
        }
      );
      kitAddForm.title = null;
      kitAddForm.product = null;
      kitAddForm.description = null;
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

const imgData = reactive([]);
const imgPreview = ref();
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
  <style>
</style>