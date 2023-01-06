<template>
  <AppLayout title="إضافه نقله">
    <FormSection
      :title="formText.title"
      :btnTitle="formText.btnTitle"
      :formData="form"
      :formRoute="form.route"
      :toastMsg="formText.formText"
      :toastDescription="form.title"
    >
      <!-- Warehouse From -->
      <FormSelect
        v-model="form.driver_id"
        title="السائق"
        :error="errors.driver_id"
        :require="true"
        :options="drivers"
      >
        <Modal v-model="driverForm.modelToggle">
          <template #btn> <i class="fa-solid fa-plus"></i> </template>
          <template #default>
            <FormSection
              title="حفظ سائق"
              btnTitle="حفظ السائق"
              :formData="driverForm"
              formRoute="driver.store"
              toastMsg="تم حفظ السائق"
              :toastDescription="`تم تسجيل السائق : ${driverForm.name}`"
            >
              <InputText
                v-model="driverForm.name"
                title="أسم السائق"
                :require="true"
              />
              <InputText
                v-model="driverForm.phone"
                title="رقم هاتف السائق"
                :require="true"
              />
            </FormSection>
          </template> </Modal
      ></FormSelect>
      <!-- Warehouse From -->
      <FormSelect
        v-model="form.warehouse_from_id"
        title="المخزن المرسل"
        :error="errors.warehouse_from_id"
        :require="true"
        :options="warehouses"
      />
      <!-- Warehouse To -->
      <FormSelect
        v-model="form.warehouse_to_id"
        title="المخزن المستقبل"
        :error="errors.warehouse_to_id"
        :require="true"
        :options="warehouses"
      />
      <!-- Date -->
      <InputDate
        v-model="form.date"
        title="تاريخ النقله"
        :error="errors.date"
        :require="true"
      />
      <!-- Content -->
      <div class="mb-10 dark:bg-[#fefefe0d] dark:border-0 border py-7 px-3">
        <h2 class="px-3 dark:text-gray-300 title font-bold mb-4">
          محتوى النقله
        </h2>
        <div v-for="(i, index) in form.content" :key="index" class="mb-3">
          <!-- product -->
          <select-product
            v-model="form.content[index].product_id"
            title=" المنتج"
          />
          <div class="w-full flex items-end justify-around">
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
import Modal from "@/Components/Modals/Modal.vue";

provide("title", "إضافه نقله");

const props = defineProps([
  "errors",
  "warehouses",
  "drivers",
  "transfer",
  "transferContent",
  "transferKit",
]);

const form = reactive({
  id: props.transfer ? props.transfer[0].id : null,
  _method: props.transfer ? "patch" : "post",
  route: props.transfer ? "transfer.update" : "transfer.store",
  warehouse_from_id: props.transfer
    ? props.transfer[0].warehouse_from_id
    : null,
  warehouse_to_id: props.transfer ? props.transfer[0].warehouse_to_id : null,
  date: props.transfer
    ? new Date(props.transfer[0].date).toISOString().slice(0, 10)
    : new Date().toISOString().slice(0, 10),
  driver_id: props.transfer ? props.transfer[0].driver_id : null,
  content: props.transfer ? props.transferContent : [],
  kit: props.transfer ? props.transferKit : [],
  total: 0,
});

if (props.transfer) {
  provide(
    "breadcrumb",
    readonly([
      { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
      {
        index: 1,
        linkTitle: "النقلات",
        linkRoute: "transfer.index",
      },
      {
        index: 2,
        linkTitle: " تعديل النقله " + props.transfer[0].id,
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
        linkTitle: "النقلات",
        linkRoute: "transfer.index",
      },
      {
        index: 2,
        linkTitle: "إضافه  نقله",
        linkRoute: "#",
      },
    ])
  );
}

const formText = reactive({
  title: props.transfer ? "تعديل  نقله" : "إضافه نقله ",
  btnTitle: props.transfer ? "تعديل نقله" : "إضافه نقله",
  formText: props.transfer ? "تم تعديل نقله" : "تم أضافه نقله",
});

const warehouses = computed(() => {
  return props.warehouses.map((item) => {
    return {
      index: item.id,
      label: item.name,
    };
  });
});

const driverForm = reactive({
  modelToggle: false,
  name: null,
  phone: null,
});

const drivers = computed(() => {
  return props.drivers.map((item) => {
    return {
      index: item.id,
      label: item.name + " - " + item.phone,
    };
  });
});

function pushToContent() {
  form.content.push({
    id: form.content.length + 1,
    product_id: null,
    quantity: 1,
  });
}
function pushToKit() {
  form.kit.push({
    id: form.kit.length + 1,
    kit_id: null,
    quantity: 1,
  });
}

function remove(i, index, content) {
  let x = form[content];
  x = form[content].filter((item) => item.id != i.id);
  form[content] = x;
}
</script>
