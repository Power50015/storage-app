<template>
  <div class="flex justify-between items-start">
    <h2 class="font-bold text-2xl">تفاصيل المخازن</h2>
    <div class="flex">
      <FormSelect
        v-model="action"
        :options="actionOptions"
        @change-select="getProductsData(true)"
      ></FormSelect>
    </div>
  </div>
  <div v-for="item in products" :key="item.index">
    <div v-if="item.dataType == 'Stock'">
      <Link
        :href="route('warehouse-stock.show', item.warehouse_stock.id)"
        class="
          w-full
          flex
          justify-between
          cursor-pointer
          items-center
          hover:text-[#0095e8]
          font-bold
          transition-all
          my-2
          py-4
          px-2
          text-right
          md:flex-row
          flex-col
        "
      >
        <h2 class="w-full">
          المخزن : {{ item.warehouse_stock.warehouse.name }}
        </h2>
        <h2 class="w-full">الكميه : {{ item.quantity }}</h2>
        <div class="w-full">
          <BadgeInfo>مخزون</BadgeInfo>
        </div>
        <h2 class="w-full text-right">
          {{ item.warehouse_stock.title }}
        </h2>

        <div class="w-full">
          <h2>
            {{
              new Date(item.warehouse_stock.date).toLocaleDateString(
                "ar-EG-u-nu-latn",
                {
                  weekday: "long",
                  year: "numeric",
                  month: "short",
                  day: "numeric",
                }
              )
            }}
          </h2>
          <div class="flex mt-3">
            <img
              :src="item.user.profile_photo_url"
              :alt="item.user.name"
              class="w-[25px] h-[25px] rounded-full"
            />
            <h6 class="mx-2">{{ item.user.name }}</h6>
          </div>
        </div>
      </Link>
    </div>
    <div v-if="item.dataType == 'IncomingInvoice'">
      <Link
        :href="route('incoming-invoice.show', item.incoming_invoice.id)"
        class="
          w-full
          flex
          justify-between
          items-center
          cursor-pointer
          hover:text-[#0095e8]
          transition-all
          my-2
          py-4
          px-2
          text-right
          font-bold
          md:flex-row
          flex-col
        "
      >
        <h2 class="w-full">
          المخزن : {{ item.incoming_invoice.warehouse.name }}
        </h2>
        <div class="w-full">
          <h2 class="w-full">الكميه : {{ item.quantity }}</h2>
          <h2 class="w-full">السعر : {{ item.price }}</h2>
        </div>

        <div class="w-full">
          <BadgePrimary>فاتورة وارده</BadgePrimary>
        </div>

        <div class="w-full">
          <h2>رقم الفاتوره : {{ item.incoming_invoice.number }}</h2>
          <div class="flex mt-3">
            <img
              :src="`/storage/${item.incoming_invoice.people.logo}`"
              :alt="item.incoming_invoice.people.name"
              class="w-[35px] h-[35px] rounded-full"
            />
            <h6 class="mx-2">{{ item.incoming_invoice.people.name }}</h6>
          </div>
        </div>

        <div class="w-full">
          <h2>
            {{
              new Date(item.incoming_invoice.date).toLocaleDateString(
                "ar-EG-u-nu-latn",
                {
                  weekday: "long",
                  year: "numeric",
                  month: "short",
                  day: "numeric",
                }
              )
            }}
          </h2>
          <div class="flex mt-3">
            <img
              :src="item.user.profile_photo_url"
              :alt="item.user.name"
              class="w-[35px] h-[35px] rounded-full"
            />
            <h6 class="mx-2">{{ item.user.name }}</h6>
          </div>
        </div>
      </Link>
    </div>
    <div v-if="item.dataType == 'ReturnedIncomingInvoice'">
      <Link
        :href="route('incoming-invoice.show', item.incoming_invoice.id)"
        class="
          w-full
          flex
          justify-between
          items-center
          cursor-pointer
          hover:text-[#0095e8]
          font-bold
          transition-all
          my-2
          py-4
          px-2
          text-right
          md:flex-row
          flex-col
        "
      >
        <h2 class="w-full">
          المخزن : {{ item.incoming_invoice.warehouse.name }}
        </h2>
        <h2 class="w-full">الكميه : {{ item.quantity }}</h2>
        <div class="w-full">
          <BadgeDanger>مرتجع فاتورة وارده</BadgeDanger>
        </div>
        <div class="w-full">
          <h2>رقم الفاتوره : {{ item.incoming_invoice.number }}</h2>
          <div class="flex mt-3">
            <img
              :src="`/storage/${item.incoming_invoice.people.logo}`"
              :alt="item.incoming_invoice.people.name"
              class="w-[35px] h-[35px] rounded-full"
            />
            <h6 class="mx-2">{{ item.incoming_invoice.people.name }}</h6>
          </div>
        </div>
        <div class="w-full">
          <h2>
            {{
              new Date(item.date).toLocaleDateString("ar-EG-u-nu-latn", {
                weekday: "long",
                year: "numeric",
                month: "short",
                day: "numeric",
              })
            }}
          </h2>
          <div class="flex mt-3">
            <img
              :src="item.user.profile_photo_url"
              :alt="item.user.name"
              class="w-[25px] h-[25px] rounded-full"
            />
            <h6 class="mx-2">{{ item.user.name }}</h6>
          </div>
        </div>
      </Link>
    </div>
    <div v-if="item.dataType == 'OutgoingInvoice'">
      <Link
        :href="route('outgoing-invoice.show', item.outgoing_invoice.id)"
        class="
          w-full
          flex
          justify-between
          items-center
          cursor-pointer
          hover:text-[#0095e8]
          transition-all
          my-2
          py-4
          px-2
          text-right
          font-bold
          md:flex-row
          flex-col
        "
      >
        <h2 class="w-full">
          المخزن : {{ item.outgoing_invoice.warehouse.name }}
        </h2>
        <div class="w-full">
          <h2 class="w-full">الكميه : {{ item.quantity }}</h2>
          <h2 class="w-full">السعر : {{ item.price }}</h2>
        </div>
        <div class="w-full">
          <BadgeSuccess>فاتورة صادره</BadgeSuccess>
        </div>
        <div class="w-full">
          <h2>رقم الفاتوره : {{ item.outgoing_invoice.id }}</h2>
          <div class="flex mt-3">
            <img
              :src="`/storage/${item.outgoing_invoice.people.logo}`"
              :alt="item.outgoing_invoice.people.name"
              class="w-[35px] h-[35px] rounded-full"
            />
            <h6 class="mx-2">{{ item.outgoing_invoice.people.name }}</h6>
          </div>
        </div>

        <div class="w-full">
          <h2>
            {{
              new Date(item.outgoing_invoice.date).toLocaleDateString(
                "ar-EG-u-nu-latn",
                {
                  weekday: "long",
                  year: "numeric",
                  month: "short",
                  day: "numeric",
                }
              )
            }}
          </h2>
          <div class="flex mt-3">
            <img
              :src="item.user.profile_photo_url"
              :alt="item.user.name"
              class="w-[25px] h-[25px] rounded-full"
            />
            <h6 class="mx-2">{{ item.user.name }}</h6>
          </div>
        </div>
      </Link>
    </div>
    <div v-if="item.dataType == 'ReturnedOutgoingInvoice'">
      <Link
        :href="route('outgoing-invoice.show', item.outgoing_invoice.id)"
        class="
          w-full
          flex
          justify-between
          items-center
          cursor-pointer
          hover:text-[#0095e8]
          font-bold
          transition-all
          my-2
          py-4
          px-2
          text-right
          md:flex-row
          flex-col
        "
      >
        <h2 class="w-full">
          المخزن : {{ item.outgoing_invoice.warehouse.name }}
        </h2>
        <h2 class="w-full">الكميه : {{ item.quantity }}</h2>
        <div class="w-full">
          <BadgeWarning>مرتجع فاتورة صادره</BadgeWarning>
        </div>
        <div class="w-full">
          <h2>رقم الفاتوره : {{ item.outgoing_invoice.id }}</h2>
          <div class="flex mt-3">
            <img
              :src="`/storage/${item.outgoing_invoice.people.logo}`"
              :alt="item.outgoing_invoice.people.name"
              class="w-[35px] h-[35px] rounded-full"
            />
            <h6 class="mx-2">{{ item.outgoing_invoice.people.name }}</h6>
          </div>
        </div>
        <div class="w-full">
          <h2>
            {{
              new Date(item.date).toLocaleDateString("ar-EG-u-nu-latn", {
                weekday: "long",
                year: "numeric",
                month: "short",
                day: "numeric",
              })
            }}
          </h2>
          <div class="flex mt-3">
            <img
              :src="item.user.profile_photo_url"
              :alt="item.user.name"
              class="w-[25px] h-[25px] rounded-full"
            />
            <h6 class="mx-2">{{ item.user.name }}</h6>
          </div>
        </div>
      </Link>
    </div>
    <div v-if="item.dataType == 'Transfer'">
      <Link
        :href="route('transfer.show', item.transfer.id)"
        class="
          w-full
          flex
          justify-between
          items-center
          cursor-pointer
          hover:text-[#0095e8]
          transition-all
          my-2
          py-4
          px-2
          text-right
          font-bold
          md:flex-row
          flex-col
        "
      >
        <h2 class="w-full">المخزن : {{ item.transfer.warehouse_from.name }}</h2>
        <h2 class="w-full">الكميه : {{ item.quantity }}</h2>
        <div class="w-full">
          <BadgeSecondary>نقله</BadgeSecondary>
        </div>
        <div class="w-full">
          <h2>المخزن المستقبل : {{ item.transfer.warehouse_to.name }}</h2>
          <h6 class="mx-2" v-if="item.transfer.driver">
            السائق : {{ item.transfer.driver.name }}
          </h6>
        </div>
        <div class="w-full">
          <h2>
            {{
              new Date(item.transfer.date).toLocaleDateString(
                "ar-EG-u-nu-latn",
                {
                  weekday: "long",
                  year: "numeric",
                  month: "short",
                  day: "numeric",
                }
              )
            }}
          </h2>
          <div class="flex mt-3">
            <img
              :src="item.user.profile_photo_url"
              :alt="item.user.name"
              class="w-[25px] h-[25px] rounded-full"
            />
            <h6 class="mx-2">{{ item.user.name }}</h6>
          </div>
        </div>
      </Link>
    </div>
    <div v-if="item.dataType == 'DestructibleGoods'">
      <ProductOperation :item="item" @FormSuccess="getProductsData((reload = true))" />
    </div>
  </div>
  <div v-if="(rowData[0] && rowData[0].next_page_url) || rowData.length == 0">
    <DotsSpinner />
  </div>
  <div v-if="rowData[0] && rowData[0].data.length == 0" class="mt-3">
    لا يوجد بيانات
  </div>
</template>
  <script setup>
import { Link } from "@inertiajs/inertia-vue3";
import BadgePrimary from "@/Components/Badges/BadgePrimary.vue";
import BadgeSuccess from "@/Components/Badges/BadgeSuccess.vue";
import BadgeInfo from "@/Components/Badges/BadgeInfo.vue";
import BadgeDanger from "@/Components/Badges/BadgeDanger.vue";
import BadgeWarning from "@/Components/Badges/BadgeWarning.vue";
import BadgeSecondary from "@/Components/Badges/BadgeSecondary.vue";
import BadgeLight from "@/Components/Badges/BadgeLight.vue";
import { reactive, ref } from "@vue/reactivity";
import axios from "axios";
import { onMounted } from "@vue/runtime-core";
import FormSelect from "@/Forms/FormSelect.vue";
import DotsSpinner from "../Spinner/DotsSpinner.vue";
import ProductOperation from "./ProductOperation.vue";

const props = defineProps(["product"]);

onMounted(() => window.addEventListener("scroll", handleScroll));

const rowData = reactive([]);
const products = reactive([]);
const inputText = ref();
const action = ref("all");

const actionOptions = [
  { label: "الكل", index: "all" },
  { label: "مخزون", index: "Stock" },
  { label: "فواتير وراده", index: "IncomingInvoice" },
  { label: "مرتجع فواتير وراده", index: "ReturnedIncomingInvoice" },
  { label: "فواتير صادره", index: "OutgoingInvoice" },
  { label: "مرتجع فواتير صادره", index: "ReturnedOutgoingInvoice" },
  { label: "نقله", index: "Transfer" },
  { label: "هالك", index: "Oprtion" },
];
function getProductsData(reload = false, page = 1) {
  axios
    .get("/product-action", {
      params: {
        product: props.product,
        page: page,
        action: action.value,
      },
    })
    .then(function (response) {
      rowData.length = 0;
      if (reload) products.length = 0;
      rowData.push(response.data);
      response.data.data.forEach((item) => {
        products.push(item);
      });
    });
}

getProductsData();

const handleScroll = (e) => {
  if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
    if (rowData[0])
      if (rowData[0].next_page_url != null) {
        getProductsData(false, rowData[0].current_page + 1);
      }
  }
};
</script>