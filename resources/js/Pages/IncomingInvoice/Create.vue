<template>
  <AppLayout title="إضافه فاتوره وارده">
    <FormSection
      :title="formText.title"
      :btnTitle="formText.btnTitle"
      :formData="form"
      :formRoute="form.route"
      :toastMsg="formText.formText"
      :toastDescription="form.title"
    >
      <!-- Number -->
      <InputText
        v-model="form.number"
        title="رقم الفاتوره"
        :error="errors.number"
        :require="true"
      />
      <!-- Supplier -->
      <SelectPeople
        v-model="form.people_id"
        :error="errors.people_id"
        title="الشركه"
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
          <select-product
            v-model="form.content[index].product_id"
            title=" المنتج"
          />
          <div class="w-full flex items-end justify-around">
            <!-- Price -->
            <InputNumber
              v-model="form.content[index].price"
              title="سعر المنتج"
              :step="0.01"
              :min="0"
              :require="true"
              @changeData="total"
            />
            <!-- Quanty -->
            <InputNumber
              v-model="form.content[index].quantity"
              title="كميه المنتج"
              :step="1"
              :min="1"
              :require="true"
              @changeData="total"
            />
            <!-- Delete -->
            <BtnDanger @click="remove(i, index, 'content')"
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
          <select-kits v-model="form.kit[index].kit_id" title=" قطعه الغيار" />
          <div class="w-full flex items-end justify-around">
            <!-- Price -->
            <InputNumber
              v-model="form.kit[index].price"
              title="سعر المنتج"
              :step="0.01"
              :min="0"
              :require="true"
              @changeData="total"
            />
            <!-- Quanty -->
            <InputNumber
              v-model="form.kit[index].quantity"
              title="كميه القطعه"
              :step="1"
              :min="1"
              :require="true"
              @changeData="total"
            />
            <!-- Delete -->
            <BtnDanger @click="remove(i, index, 'kit')"
              ><i class="fa-solid fa-xmark"></i
            ></BtnDanger>
          </div>
        </div>
        <!--New Item-->
        <BtnSuccess @click="pushToKit"> أضف بند</BtnSuccess>
      </div>
      <div class="mb-10 dark:bg-[#fefefe0d] dark:border-0 border py-7 px-3">
        <h2 class="px-3 dark:text-gray-300 title font-bold mb-4">
          ختام الفاتوره
        </h2>
        <div class="flex items-end justify-around">
          <h2 class="px-3 dark:text-gray-300 title font-bold mb-4">
            الإجمالى قبل الخصم :<br />{{ totalPrice.toFixed(2) }}
          </h2>
          <div class="">
            <label class="px-3 dark:text-gray-300"> خصم على الفاتورة </label
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
              v-model="form.discount"
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
          @click="total"
        >
          الإجمالى بعد الخصم :<br />{{
            (totalPrice - form.discount).toFixed(2)
          }}
        </h2>
      </div>
    </FormSection>
  </AppLayout>
</template>

<script setup>
import { reactive } from "vue";
import { computed, provide, readonly, ref, onMounted } from "@vue/runtime-core";
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/AppLayout.vue";
import FormSection from "@/Forms/FormSection.vue";
import InputText from "@/Forms/InputText.vue";
import InputDate from "@/Forms/InputDate.vue";
import FormSelect from "@/Forms/FormSelect.vue";
import InputNumber from "@/Forms/InputNumber.vue";
import BtnDanger from "@/Components/Buttons/BtnDanger.vue";
import BtnSuccess from "@/Components/Buttons/BtnSuccess.vue";
import SelectProduct from "@/Forms/SelectProduct.vue";
import SelectKits from "@/Forms/SelectKits.vue";
import SelectPeople from "@/Forms/SelectPeople.vue";

provide("title", "إضافه فاتوره وارده");

const props = defineProps([
  "errors",
  "warehouses",
  "cash",
  "invoice",
  "invoiceContent",
  "invoiceKit",
]);

const form = reactive({
  id: props.invoice ? props.invoice[0].id : null,
  _method: props.invoice ? "patch" : "post",
  route: props.invoice ? "incoming-invoice.update" : "incoming-invoice.store",
  number: props.invoice ? props.invoice[0].number : null,
  people_id: props.invoice ? props.invoice[0].people_id : null,
  warehouse_id: props.invoice ? props.invoice[0].warehouse_id : null,
  pay_type: props.invoice ? props.invoice[0].pay_type : 0,
  cash_id: props.invoice ? props.invoice[0].cash_id : null,
  date: props.invoice
    ? new Date(props.invoice[0].date).toISOString().slice(0, 10)
    : new Date().toISOString().slice(0, 10),
  discount: props.invoice ? props.invoice[0].discount : 0,
  content: props.invoice ? props.invoiceContent : [],
  kit: props.invoice ? props.invoiceKit : [],
  total: 0,
});

if (props.invoice) {
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
        linkTitle: " تعديل فاتوره وارده " + props.invoice[0].number,
        linkRoute: "#",
      },
    ])
  );
} else {
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
}

const formText = reactive({
  title: props.invoice ? "تعديل بيانات  فاتوره وارده" : "إضافه  فاتوره وارده ",
  btnTitle: props.invoice ? "تعديل  فاتوره وارده" : "إضافه  فاتوره وارده",
  formText: props.invoice ? "تم تعديل  فاتوره وارده" : "تم أضافه  فاتوره وارده",
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
      index: 0,
      label: "على الحساب",
    },
    {
      index: 1,
      label: "كاش",
    },
  ];
});
const cash = computed(() => {
  return props.cash.map((item) => {
    return {
      index: item.id,
      label: item.title,
    };
  });
});

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
  for (let index = 0; index < form.content.length; index++) {
    console.log(form.content[index].price);
    var i = form.content[index].price * form.content[index].quantity;

    totalPrice.value = totalPrice.value + i;
  }
  for (let index = 0; index < form.kit.length; index++) {
    var i = form.kit[index].price * form.kit[index].quantity;

    totalPrice.value = totalPrice.value + i;
    form.total = totalPrice.value - form.discount;
  }
}
function remove(i, index, content) {
  let x = form[content];
  x = form[content].filter((item) => item.id != i.id);
  form[content] = x;
}

onMounted(() => total());
</script>
<style>
</style>