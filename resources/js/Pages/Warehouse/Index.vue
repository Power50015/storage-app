<template>
  <AppLayout title="المخازن">
    <FormSection
      title="إضافه مخزن"
      btnTitle="حفظ المخزن"
      :formData="form"
      formRoute="warehouse.store"
      toastMsg="تم تسجيل المخزن"
      :toastDescription="`تم تسجيل المخزن : ${form.name}`"
    >
      <InputText
        v-model="form.name"
        title="أسم المخزن"
        :error="errors.name"
        :require="true"
      />
      <InputTextArea v-model.lazy="form.address" title="عنوان المخزن" />
    </FormSection>
    <SectionTemplate>
      <div class="flex content-center items-center justify-between mb-2">
        <h2 class="font-bold">بيانات المخازن</h2>
        <btn-info :element="Link" :to="route('warehouse-stock.create')">
          أضف مخزون
        </btn-info>
      </div>
      <InputText v-model="search" placeholder="بحث ...." />
      <table class="min-w-max w-full table-auto mt-5">
        <tbody>
          <tr
            class="text-right"
            v-for="item in warehouses.data"
            :key="item.index"
          >
            <td class="py-3 px-6 whitespace-nowrap text-right">
              <div class="flex items-center justify-start">
                <Link
                  :href="route('warehouse.show', item.id)"
                  class="hover:text-[#009ef7]"
                >
                  <h3 class="pb-3 font-bold">
                    {{ item.name }}
                  </h3>
                  <div v-html="item.address" class="text-xs"></div>
                </Link>
              </div>
            </td>
            <td class="py-3 px-6 text-left">
              <div class="flex items-left justify-end">
                <warehouse-table
                  :name="item.name"
                  :address="item.address"
                  :id="item.id"
                />
              </div>
            </td>

            <td class="py-3 px-6 text-left">
              <div class="flex items-left justify-end">
                <div class="mr-2">
                  <img
                    class="w-6 h-6 rounded-full"
                    :src="item.user.profile_photo_url"
                  />
                </div>
                <Link
                  :href="route('warehouse.show', item.id)"
                  class="hover:text-[#009ef7]"
                >
                  <h6 class="mx-2">{{ item.user.name }}</h6>
                  <h6 class="mx-2">
                    {{
                      new Date(item.created_at).toLocaleDateString(
                        "ar-EG-u-nu-latn",
                        {
                          weekday: "long",
                          year: "numeric",
                          month: "short",
                          day: "numeric",
                        }
                      )
                    }}
                  </h6>
                </Link>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
      <Pagination :links="warehouses.links" />
    </SectionTemplate>
  </AppLayout>
</template>

<script setup>
import {
  computed,
  onMounted,
  provide,
  readonly,
  watch,
  reactive,
  ref,
} from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import FormSection from "@/Forms/FormSection.vue";
import InputText from "@/Forms/InputText.vue";
import InputTextArea from "@/Forms/InputTextArea.vue";
import BtnDanger from "@/Components/Buttons/BtnDanger.vue";
import BtnInfo from "@/Components/Buttons/BtnInfo.vue";
import WarehouseTable from "@/Components/Warehouse/WarehouseTable.vue";
import SectionTemplate from "@/Components/SectionTemplate.vue";
import Modal from "@/Components/Modals/Modal.vue";
import Pagination from "@/Components/Tables/Pagination.vue";
import { Inertia } from "@inertiajs/inertia";

provide("title", "المخازن");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    { index: 1, linkTitle: "المخازن", linkRoute: "#" },
  ])
);

const props = defineProps(["errors", "warehouses", "filters"]);

const warehouses = computed(() => props.warehouses);

const form = reactive({
  name: null,
  address: null,
});

const search = ref(props.filters.search);

watch(search, (value) => {
  Inertia.get(
    "/warehouse",
    {
      search: value,
    },
    {
      preserveState: true,
      replace: true,
      preserveScroll: true,
    }
  );
});
</script>
