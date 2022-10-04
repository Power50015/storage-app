<template>
  <AppLayout title="إضافه فاتوره وارده">
    <FormSection
      title="إضافه  فاتوره وارده"
      btnTitle="حفظ الفاتوره "
      :formData="form"
      formRoute="incoming-invoice.store"
      toastMsg="تم تسجيل الفاتوره"
      :toastDescription="`تم تسجيل الفاتوره + ${form.number}`"
    >
      <!-- Number -->
      <InputText
        v-model="form.number"
        title="رقم الفاتوره"
        :error="errors.number"
        :require="true"
      />
      <!-- Supplier -->
      <FormSelect
        v-model="form.people_id"
        title="المورد"
        :error="errors.people_id"
        :require="true"
        :options="suppliers"
      />
      <!-- Warehouse -->
      <FormSelect
        v-model="form.warehouse_id"
        title="المخزن"
        :error="errors.warehouse_id"
        :require="true"
        :options="warehouses"
      />
      <!-- Pay Type -->
      <FormSelect
        v-model="form.pay_type"
        title="نوع الدفع"
        :error="errors.pay_type"
        :require="true"
        :options="pay"
      />
      <!-- Cash Type -->
      <FormSelect
        v-model="form.cash_id"
        title="نوع الكاش"
        :error="errors.cash_id"
        :require="true"
        :options="cash"
        v-if="form.pay_type"
      />
      <!-- Date -->
      <InputDate
        v-model="form.date"
        title="تاريخ الفاتوره"
        :error="errors.date"
        :require="true"
      />
      <!-- Content -->
      <div class="mb-10 dark:bg-[#fefefe0d] dark:border-0 border py-7 px-3">
        <h2 class="px-3 dark:text-gray-300 title font-bold mb-4">
          محتوى الفاتوره
        </h2>
        <div v-for="(i, index) in form.content" :key="index" class="mb-3">
          <!-- product -->
          <FormSelect
            v-model="form.content[index].product_id"
            title="المنتج"
            :options="products"
          />
          <div class="w-full flex items-end justify-around">
            <!-- Price -->
            <InputNumber
              v-model="form.content[index].price"
              title="سعر المنتج"
              :step="0.01"
              :min="0"
              :require="true"
            />
            <!-- Quanty -->
            <InputNumber
              v-model="form.content[index].quantity"
              title="كميه المنتج"
              :step="1"
              :min="1"
              :require="true"
            />
            <!-- Delete -->
            <BtnDanger
              @click="
                form.content = form.content.filter((item) => item.id != i.id);
                total();
              "
              ><i class="fa-solid fa-xmark"></i
            ></BtnDanger>
          </div>
        </div>
        <!--New Item-->
        <BtnSuccess @click="pushToContent"> أضف بند</BtnSuccess>
      </div>
      <!-- Kits -->
      <div class="mb-10 dark:bg-[#fefefe0d] dark:border-0 border py-7 px-3">
        <h2 class="px-3 dark:text-gray-300 title font-bold mb-4">
          قطع الغيار
          <span class="text-red-800 font-bold">*</span>
        </h2>
        <div v-for="(i, index) in form.kit" :key="index" class="mb-3">
          <!-- kit -->
          <FormSelect
            v-model="form.kit[index].kit_id"
            title="قطعه الغيار"
            :options="kits"
          />
          <div class="w-full flex items-end justify-around">
            <!-- Quanty -->
            <InputNumber
              v-model="form.kit[index].quantity"
              title="كميه القطعه"
              :step="1"
              :min="1"
              :require="true"
            />
            <!-- Delete -->
            <BtnDanger
              @click="
                form.kit = form.kit.filter((item) => item.id != i.id);
                total();
              "
              ><i class="fa-solid fa-xmark"></i
            ></BtnDanger>
          </div>
        </div>
        <!--New Item-->
        <BtnSuccess @click="pushToKit"> أضف بند</BtnSuccess>
      </div>
    </FormSection>
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
          <h2 class="title font-bold mb-4">فاتوره وارده</h2>
          <form action="POST" @submit.prevent="addIncomingInvoice">
            
            <!--Invoice Content-->
            <div
              class="mb-10 dark:bg-[#fefefe0d] dark:border-0 border py-7 px-3"
            >
              <h2 class="px-3 dark:text-gray-300 title font-bold mb-4">
                محتوى الفاتوره
                <span class="text-red-800 font-bold">*</span>
              </h2>
              <div
                v-for="(i, index) in incomingInvoiceAddForm.content"
                :key="index"
              >
                <div class="w-full my-5">
                  <h3>{{ 1 + index }}</h3>
                  <label class="px-3 dark:text-gray-300"
                    >المنتج
                    <span class="text-red-800 font-bold">*</span>
                  </label>
                  <select
                    v-model="incomingInvoiceAddForm.content[index].product"
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
                      <template v-if="product.sku">
                        | {{ product.sku }}</template
                      >
                      {{ product.name }}
                    </option>
                  </select>
                </div>
                <div class="w-full flex items-end justify-around">
                  <div class="m-5">
                    <label class="px-3 dark:text-gray-300">
                      سعر المنتج
                      <span class="text-red-800 font-bold">*</span>
                    </label>
                    <input
                      type="number"
                      min="0.00"
                      step="0.01"
                      @change="total"
                      v-model="incomingInvoiceAddForm.content[index].price"
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
                  <!-- Quanty -->
                  <div class="m-5">
                    <label class="px-3 dark:text-gray-300">
                      كميه المنتج
                      <span class="text-red-800 font-bold">*</span>
                    </label>
                    <input
                      type="number"
                      v-model="incomingInvoiceAddForm.content[index].quantity"
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
                        incomingInvoiceAddForm.content =
                          incomingInvoiceAddForm.content.filter(
                            (item) => item.id != i.id
                          );
                        total();
                      "
                    >
                      <i class="fa-solid fa-xmark"></i>
                    </div>
                  </div>
                </div>
                <hr
                  v-if="
                    incomingInvoiceAddForm.content.length > 1 &&
                    incomingInvoiceAddForm.content.length != index
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
                  @click="pushToContent"
                >
                  أضف بند
                </div>
              </div>
            </div>
            <!-- Kits -->
            <div
              class="mb-10 dark:bg-[#fefefe0d] dark:border-0 border py-7 px-3"
            >
              <h2 class="px-3 dark:text-gray-300 title font-bold mb-4">
                قطع الغيار
                <span class="text-red-800 font-bold">*</span>
              </h2>
              <div
                v-for="(i, index) in incomingInvoiceAddForm.kit"
                :key="index"
              >
                <div class="w-full my-5">
                  <h3>{{ 1 + index }}</h3>
                  <label class="px-3 dark:text-gray-300"
                    >المنتج
                    <span class="text-red-800 font-bold">*</span>
                  </label>
                  <select
                    v-model="incomingInvoiceAddForm.kit[index].kit"
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
                      v-for="kit in kits"
                      :key="kit.index"
                      :value="kit.id"
                    >
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
                  <div class="m-5">
                    <label class="px-3 dark:text-gray-300">
                      سعر قطعه الغيار
                      <span class="text-red-800 font-bold">*</span>
                    </label>
                    <input
                      type="number"
                      min="0.00"
                      step="0.01"
                      @change="total"
                      v-model="incomingInvoiceAddForm.kit[index].price"
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
                  <!-- Quanty -->
                  <div class="m-5">
                    <label class="px-3 dark:text-gray-300">
                      كميه قطعه الغيار
                      <span class="text-red-800 font-bold">*</span>
                    </label>
                    <input
                      type="number"
                      v-model="incomingInvoiceAddForm.kit[index].quantity"
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
                        incomingInvoiceAddForm.kit =
                          incomingInvoiceAddForm.kit.filter(
                            (item) => item.id != i.id
                          );
                        total();
                      "
                    >
                      <i class="fa-solid fa-xmark"></i>
                    </div>
                  </div>
                </div>
                <hr
                  v-if="
                    incomingInvoiceAddForm.kit.length > 1 &&
                    incomingInvoiceAddForm.kit.length != index
                  "
                />
              </div>

              <div>
                <!--New Item-->
                <div
                  class="
                    mt-10
                    w-full
                    bg-[#7239ea]
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
                    hover:bg-[#7239ea]
                    focus:outline-none
                    focus:ring-2
                    focus:ring-offset-2
                    focus:ring-[#7239ea]
                    cursor-pointer
                  "
                  @click="pushToKit"
                >
                  أضف بند
                </div>
              </div>
            </div>
            <div
              class="mb-10 dark:bg-[#fefefe0d] dark:border-0 border py-7 px-3"
            >
              <h2 class="px-3 dark:text-gray-300 title font-bold mb-4">
                ختام الفاتوره
              </h2>
              <div class="flex items-end justify-around">
                <h2 class="px-3 dark:text-gray-300 title font-bold mb-4">
                  الإجمالى قبل الخصم :<br />{{ totalPrice.toFixed(2) }}
                </h2>
                <div class="">
                  <label class="px-3 dark:text-gray-300">
                    خصم على الفاتورة </label
                  ><input
                    type="number"
                    min="0.00"
                    step="0.01"
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
                    v-model="incomingInvoiceAddForm.discount"
                  />
                </div>
              </div>
              <h2
                class="
                  m-3
                  p-5
                  dark:text-gray-300
                  title
                  font-bold
                  mb-4
                  dark:bg-[#1b1b29]
                  bg-[#f5f8fa]
                "
              >
                الإجمالى بعد الخصم :<br />{{
                  (totalPrice - incomingInvoiceAddForm.discount).toFixed(2)
                }}
              </h2>
              <!--Save Invoice-->
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
                  حفظ الفاتوره
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

import AppLayout from "@/Layouts/AppLayout.vue";
import FormSection from "@/Forms/FormSection.vue";
import InputText from "@/Forms/InputText.vue";
import InputDate from "@/Forms/InputDate.vue";
import FormSelect from "@/Forms/FormSelect.vue";
import InputNumber from "@/Forms/InputNumber.vue";
import BtnDanger from "@/Components/Buttons/BtnDanger.vue";
import BtnSuccess from "@/Components/Buttons/BtnSuccess.vue";

provide("title", "إضافه فاتوره وارده");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    {
      index: 1,
      linkTitle: "الفواتير الوارده",
      linkRoute: "incoming-invoice.index",
    },
    {
      index: 2,
      linkTitle: "إضافه فاتوره وارده",
      linkRoute: "#",
    },
  ])
);

const props = defineProps([
  "errors",
  "suppliers",
  "warehouses",
  "cash",
  "products",
  "kits",
]);

const form = reactive({
  number: null,
  people_id: null,
  warehouse_id: null,
  pay_type: false,
  cash_id: null,
  date: new Date().toISOString().slice(0, 10),
  discount: 0.0,
  content: [],
  kit: [],
});
const suppliers = computed(() => {
  return props.suppliers.map((item) => {
    return {
      index: item.id,
      // image: item.logo,
      label:
        item.name + (item.phone ? " | " + item.phone : "") + " | " + item.type,
    };
  });
});

const warehouses = computed(() => {
  return props.warehouses.map((item) => {
    return {
      index: item.id,
      label: item.name,
    };
  });
});

const pay = computed(() => {
  return [
    {
      index: false,
      label: "على الحساب",
    },
    {
      index: true,
      label: "كاش",
    },
  ];
});
const cash = computed(() => {
  return props.cash.map((item) => {
    return {
      index: item.id,
      label: item.name,
    };
  });
});
const products = computed(() => {
  return props.products.map((item) => {
    return {
      index: item.id,
      image: item.image,
      label:
        item.name +
        (item.product_collection ? " | " + item.product_collection.name : "") +
        (item.product_model ? " | " + item.product_model.name : "") +
        (item.product_brand ? " | " + item.product_brand.name : "") +
        (item.product_category ? " | " + item.product_category.name : "") +
        (item.product_type ? " | " + item.product_type.name : "") +
        (item.product_color ? " | " + item.product_color.name : "") +
        (item.product_material ? " | " + item.product_material.name : "") +
        (item.product_country ? " | " + item.product_country.name : ""),
    };
  });
});

const kits = computed(() => {
  return props.kits.map((item) => {
    return {
      index: item.id,
      image: item.image,
      label:
        item.title +
        (item.product ? " | " + item.product.name : "") +
        (item.product && item.product.product_collection
          ? " | " + item.product.product_collection.name
          : "") +
        (item.product && item.product.product_model
          ? " | " + item.product.product_model.name
          : "") +
        (item.product && item.product.product_brand
          ? " | " + item.product.product_brand.name
          : "") +
        (item.product && item.product.product_category
          ? " | " + item.product.product_category.name
          : "") +
        (item.product && item.product.product_type
          ? " | " + item.product.product_type.name
          : "") +
        (item.product && item.product.product_color
          ? " | " + item.product.product_color.name
          : "") +
        (item.product && item.product.product_material
          ? " | " + item.product.product_material.name
          : "") +
        (item.product && item.product.product_country
          ? " | " + item.product.product_country.name
          : ""),
    };
  });
});

const incomingInvoiceAddForm = reactive({
  number: null,
  supplier: null,
  warehouses: null,
  pay_type: false,
  cash_type: null,
  date: new Date().toISOString().slice(0, 10),
  discount: 0.0,
  content: [],
  attachment: [],
  kit: [],
});

function addIncomingInvoice() {
  if (incomingInvoiceAddForm.pay_type == false)
    incomingInvoiceAddForm.cash_type = null;
  Inertia.post(route("incoming-invoice.store"), incomingInvoiceAddForm, {
    onSuccess: () => {
      createToast(
        {
          title: "تم تسجيل الفاتوره",
          description: " تم تسجيل الفاتوره " + incomingInvoiceAddForm.number,
        },
        {
          timeout: 3000,
          transition: "slide",
          type: "success",
          showIcon: true,
        }
      );
      incomingInvoiceAddForm.number = null;
      incomingInvoiceAddForm.pay_type = false;
      incomingInvoiceAddForm.cash_type = null;
      incomingInvoiceAddForm.number = null;
      incomingInvoiceAddForm.customer = null;
      incomingInvoiceAddForm.warehouses = null;
      incomingInvoiceAddForm.discount = 0.0;
      incomingInvoiceAddForm.date = new Date().toISOString().slice(0, 10);
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

function pushToContent() {
  form.content.push({
    id: form.content.length + 1,
    product_id: null,
    price: 0.0,
    quantity: 1,
  });
}
function pushToKit() {
  form.kit.push({
    id: form.kit.length + 1,
    kit_id: null,
    price: 0.0,
    quantity: 1,
  });
}
const totalPrice = ref(0);
function total() {
  totalPrice.value = 0;
  for (let index = 0; index < incomingInvoiceAddForm.content.length; index++) {
    var i =
      incomingInvoiceAddForm.content[index].price *
      incomingInvoiceAddForm.content[index].quantity;

    totalPrice.value = totalPrice.value + i;
  }
  for (let index = 0; index < incomingInvoiceAddForm.kit.length; index++) {
    var i =
      incomingInvoiceAddForm.kit[index].price *
      incomingInvoiceAddForm.kit[index].quantity;

    totalPrice.value = totalPrice.value + i;
  }
}
</script>
<style>
</style>