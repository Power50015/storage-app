<template>
  <AppLayout title="إضافه مخزون">
    <FormSection
      title="إضافه مخزن"
      btnTitle="حفظ المخزون"
      :formData="form"
      formRoute="warehouse.store"
      toastMsg="تم تسجيل المخزون"
    >
      <FormSelect
        v-model="form.warehouses"
        title="المخزن"
        :error="errors.warehouses"
        :require="true"
        :options="options"
      >
      </FormSelect>
      <InputText
        v-model="form.title"
        title="البند"
        :error="errors.title"
        :require="true"
      />
      <!--Invoice Attach-->
      <div class="mb-10 dark:bg-[#fefefe0d] dark:border-0 border py-7 px-3">
        <h2 class="px-3 dark:text-gray-300 title font-bold mb-4">
          الملفات
          <span class="text-red-800 font-bold">*</span>
        </h2>
        <div v-for="(i, index) in form.attachment" :key="index">
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
                  form.attachment[index].attachment = $event.target.files[0]
                "
              />
              <!-- Delete -->
              <div class="mb-5">
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
                    w-[80px]
                    flex
                    items-center
                    justify-center
                    rounded-md
                  "
                  @click="
                    form.attachment = form.attachment.filter(
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
            v-if="form.attachment.length > 1 && form.attachment.length != index"
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
      <!-- Content-->
      <div class="mb-10 dark:bg-[#fefefe0d] dark:border-0 border py-7 px-3">
        <h2 class="px-3 dark:text-gray-300 title font-bold mb-4">
          محتوى المخزون من المنتجات
          <span class="text-red-800 font-bold">*</span>
        </h2>
        <div v-for="(i, index) in form.content" :key="index">
          <div class="w-full my-5">
            <h3>{{ 1 + index }}</h3>
            <label class="px-3 dark:text-gray-300"
              >المنتج
              <span class="text-red-800 font-bold">*</span>
            </label>
            <select
              v-model="form.content[index].product"
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
          <div class="w-full flex items-end justify-around">
            <!-- Quanty -->
            <div class="m-5">
              <label class="px-3 dark:text-gray-300">
                كميه المنتج
                <span class="text-red-800 font-bold">*</span>
              </label>
              <input
                type="number"
                v-model="form.content[index].quantity"
                @change="total"
                min="0"
                step="1"
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
            <!-- Delete -->
            <div class="mb-5">
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
                  w-[80px]
                  flex
                  items-center
                  justify-center
                  rounded-md
                "
                @click="
                  form.content = form.content.filter((item) => item.id != i.id);
                  total();
                "
              >
                <i class="fa-solid fa-xmark"></i>
              </div>
            </div>
          </div>
          <hr v-if="form.content.length > 1 && form.content.length != index" />
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
            @click="pushToContent"
          >
            أضف بند
          </div>
        </div>
      </div>

      <!-- Kits -->
      <div class="mb-10 dark:bg-[#fefefe0d] dark:border-0 border py-7 px-3">
        <h2 class="px-3 dark:text-gray-300 title font-bold mb-4">
          قطع الغيار
          <span class="text-red-800 font-bold">*</span>
        </h2>
        <div v-for="(i, index) in form.kit" :key="index">
          <div class="w-full my-5">
            <h3>{{ 1 + index }}</h3>
            <label class="px-3 dark:text-gray-300"
              >المنتج
              <span class="text-red-800 font-bold">*</span>
            </label>
            <select
              v-model="form.kit[index].kit"
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
              <option v-for="kit in kits" :key="kit.index" :value="kit.id">
                {{ kit.title }}
                <template v-if="kit.product">
                  |
                  <template v-if="kit.product.product_brand"
                    >{{ kit.product.product_brand.name }} |</template
                  >
                  <template v-if="kit.product.product_category">
                    {{ kit.product.product_category.name }}</template
                  >
                  <template v-if="kit.product.product_type">
                    |{{ kit.product.product_type.name }}
                  </template>
                  <template v-if="kit.product.product_collection">
                    |{{ kit.product.product_collection.name }}
                  </template>
                  <template v-if="kit.product.product_model">
                    |{{ kit.product.product_model.name }}
                  </template>
                  <template v-if="kit.product.product_color">
                    |{{ kit.product.product_color.name }}
                  </template>
                  <template v-if="kit.product.product_material">
                    |{{ kit.product.product_material.name }}
                  </template>
                  <template v-if="kit.product.product_country">
                    | {{ kit.product.product_country.name }}</template
                  >
                  <template v-if="kit.product.sku">
                    | {{ kit.product.sku }}</template
                  >
                  | {{ kit.product.name }}</template
                >
              </option>
            </select>
          </div>
          <div class="w-full flex items-end justify-around">
            <!-- Quanty -->
            <div class="m-5">
              <label class="px-3 dark:text-gray-300">
                كميه المنتج
                <span class="text-red-800 font-bold">*</span>
              </label>
              <input
                type="number"
                v-model="form.kit[index].quantity"
                @change="total"
                min="0"
                step="1"
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
            <!-- Delete -->
            <div class="mb-5">
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
                  w-[80px]
                  flex
                  items-center
                  justify-center
                  rounded-md
                "
                @click="
                  form.kit = form.kit.filter((item) => item.id != i.id);
                  total();
                "
              >
                <i class="fa-solid fa-xmark"></i>
              </div>
            </div>
          </div>
          <hr v-if="form.kit.length > 1 && form.kit.length != index" />
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
            @click="pushToKit"
          >
            أضف بند
          </div>
        </div>
      </div>
    </FormSection>
  </AppLayout>
</template>

<script setup>
import { reactive, ref } from "vue";
import { computed, provide, readonly } from "@vue/runtime-core";

import AppLayout from "@/Layouts/AppLayout.vue";
import FormSection from "@/Forms/FormSection.vue";
import InputText from "@/Forms/InputText.vue";
import FormSelect from "@/Forms/FormSelect.vue";

provide("title", "إضافه مخزون");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    {
      index: 1,
      linkTitle: "المخازن",
      linkRoute: "warehouse.index",
    },
    {
      index: 2,
      linkTitle: "إضافه مخزون",
      linkRoute: "#",
    },
  ])
);

const props = defineProps(["errors", "products", "warehouses", "kits"]);

const options = props.warehouses.map((item) => {
  return { label: item.name, index: item.id };
});

const form = reactive({
  title: null,
  warehouses: null,
  content: [],
  attachment: [],
  kit: [],
});

const totalPrice = ref(0);

function pushToContent() {
  warehouseStockAddForm.content.push({
    id: warehouseStockAddForm.content.length + 1,
    product: null,
    quantity: 0,
  });
}

function pushToAttachment() {
  warehouseStockAddForm.attachment.push({
    id: warehouseStockAddForm.attachment.length + 1,
    attachment: null,
  });
}

function pushToKit() {
  warehouseStockAddForm.kit.push({
    id: warehouseStockAddForm.kit.length + 1,
    kit: null,
    quantity: 0,
  });
}
</script>