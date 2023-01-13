<template>
  <div class="flex justify-between items-start">
    <h2 class="font-bold text-2xl"></h2>
    <div class="flex">
      <FormSelect
        v-model="action"
        :options="actionOptions"
        @change-select="getData(true)"
      ></FormSelect>
    </div>
  </div>
  <div v-for="item in actions" :key="item.index">
    <div v-if="item.dataType == 'Stock'">
      <Link
        :href="route('warehouse-stock.show', item.id)"
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
        <h2 class="w-full text-right">
          {{ item.title }}
        </h2>
        <div class="w-full text-center">
          <BadgeInfo>مخزون</BadgeInfo>
        </div>
        <div class="w-full"></div>
        <div class="w-full flex items-end flex-col">
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
    <div v-if="item.dataType == 'IncomingInvoice'">
      <Link
        :href="route('incoming-invoice.show', item.id)"
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
        <div class="w-full">
          <h2>رقم الفاتوره : {{ item.number }}</h2>
          <div class="flex mt-3">
            <img
              :src="`/storage/${item.people.logo}`"
              alt=""
              class="w-[35px] h-[35px] rounded-full"
            />
            <h6 class="mx-2">{{ item.people.name }}</h6>
          </div>
          <div>
            نوع الدفع :
            <span v-if="item.pay_type == 0">على الحساب</span>
            <span v-if="item.pay_type == 1">{{ item.cash.title }}</span>
          </div>
        </div>

        <div class="w-full text-center">
          <BadgePrimary>فاتورة وارده</BadgePrimary>
        </div>

        <div class="w-full">
          <h2 class="w-full">الخصم : {{ item.discount }}</h2>
          <h2 class="w-full">إجمالى : {{ item.total_after_discount }}</h2>
        </div>

        <div class="w-full flex items-end flex-col">
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
        :href="route('outgoing-invoice.show', item.id)"
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
        <div class="w-full">
          <h2>رقم الفاتوره : {{ item.id }}</h2>
          <div class="flex mt-3">
            <img
              :src="`/storage/${item.people.logo}`"
              :alt="item.people.name"
              class="w-[35px] h-[35px] rounded-full"
            />
            <h6 class="mx-2">{{ item.people.name }}</h6>
          </div>
          <div>
            نوع الدفع :
            <span v-if="item.pay_type == 0">على الحساب</span>
            <span v-if="item.pay_type == 1">{{ item.cash.title }}</span>
          </div>
        </div>
        <div class="w-full text-center">
          <BadgeSuccess>فاتورة صادره</BadgeSuccess>
        </div>
        <div class="w-full">
          <h2 class="w-full">الخصم : {{ item.discount }}</h2>
          <h2 class="w-full">إجمالى : {{ item.total_after_discount }}</h2>
        </div>

        <div class="w-full flex items-end flex-col">
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
    <div v-if="item.dataType == 'ReturnedIncomingInvoice'">
      <Link
        :href="route('returned-incoming-invoice.show', item.id)"
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
        <div class="w-full">
          <h2>رقم مرتجع : {{ item.id }}</h2>
          <div class="flex mt-3">
            <img
              :src="`/storage/${item.people.logo}`"
              :alt="item.people.name"
              class="w-[35px] h-[35px] rounded-full"
            />
            <h6 class="mx-2">{{ item.people.name }}</h6>
          </div>
          <div>
            نوع الدفع :
            <span v-if="item.pay_type == 0">على الحساب</span>
            <span v-if="item.pay_type == 1">{{ item.cash.title }}</span>
          </div>
        </div>
        <div class="w-full text-center">
          <BadgePrimary>مرتجع وارد</BadgePrimary>
        </div>
        <div class="w-full">
          <h2 class="w-full">الخصم : {{ item.discount }}</h2>
          <h2 class="w-full">إجمالى : {{ item.total_after_discount }}</h2>
        </div>

        <div class="w-full flex items-end flex-col">
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
        :href="route('outgoing-invoice.show', item.id)"
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
        <div class="w-full">
          <h2>رقم الفاتوره : {{ item.id }}</h2>
          <div class="flex mt-3">
            <img
              :src="`/storage/${item.people.logo}`"
              :alt="item.people.name"
              class="w-[35px] h-[35px] rounded-full"
            />
            <h6 class="mx-2">{{ item.people.name }}</h6>
          </div>
          <div>
            نوع الدفع :
            <span v-if="item.pay_type == 0">على الحساب</span>
            <span v-if="item.pay_type == 1">{{ item.cash.title }}</span>
          </div>
        </div>
        <div class="w-full text-center">
          <BadgeSuccess>فاتورة صادره</BadgeSuccess>
        </div>
        <div class="w-full">
          <h2 class="w-full">الخصم : {{ item.discount }}</h2>
          <h2 class="w-full">إجمالى : {{ item.total_after_discount }}</h2>
        </div>

        <div class="w-full flex items-end flex-col">
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
    <div v-if="item.dataType == 'ReturnedOutgoingInvoice'">
      <Link
        :href="route('returned-outgoing-invoice.show', item.id)"
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
        <div class="w-full">
          <h2>رقم مرتجع : {{ item.id }}</h2>
          <div class="flex mt-3">
            <img
              :src="`/storage/${item.people.logo}`"
              :alt="item.people.name"
              class="w-[35px] h-[35px] rounded-full"
            />
            <h6 class="mx-2">{{ item.people.name }}</h6>
          </div>
          <div>
            نوع الدفع :
            <span v-if="item.pay_type == 0">على الحساب</span>
            <span v-if="item.pay_type == 1">{{ item.cash.title }}</span>
          </div>
        </div>
        <div class="w-full text-center">
          <BadgeSuccess>مرتجع صادر</BadgeSuccess>
        </div>
        <div class="w-full">
          <h2 class="w-full">الخصم : {{ item.discount }}</h2>
          <h2 class="w-full">إجمالى : {{ item.total_after_discount }}</h2>
        </div>

        <div class="w-full flex items-end flex-col">
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
    <div v-if="item.dataType == 'TransferFrom'">
      <Link
        :href="route('transfer.show', item.id)"
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
        <div class="w-full">
          <h2>المخزن المستقبل : {{ item.warehouse_to.name }}</h2>
          <h6 class="mx-2" v-if="item.driver">
            السائق : {{ item.driver.name }}
          </h6>
        </div>
        <div class="w-full text-center">
          <BadgeSecondary>نقله صادره</BadgeSecondary>
        </div>

        <div class="w-full flex items-end flex-col">
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
    <div v-if="item.dataType == 'TransferTo'">
      <Link
        :href="route('transfer.show', item.id)"
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
        <div class="w-full">
          <h2>المخزن المرسل : {{ item.warehouse_from.name }}</h2>
          <h6 class="mx-2" v-if="item.driver">
            السائق : {{ item.driver.name }}
          </h6>
        </div>
        <div class="w-full text-center">
          <BadgeSecondary>نقله وارده</BadgeSecondary>
        </div>

        <div class="w-full flex items-end flex-col">
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
    <div v-if="item.dataType == 'DestructibleGoods'">
      <ProductOperation :item="item" @FormSuccess="getData((reload = true))" />
    </div>
    <div v-if="item.dataType == 'KitOperation'">
      <KitOperation :item="item" @FormSuccess="getData((reload = true))" />
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
import KitOperation from "./KitOperation.vue";

const props = defineProps(["id"]);

onMounted(() => window.addEventListener("scroll", handleScroll));

const rowData = reactive([]);
const actions = reactive([]);
const inputText = ref();
const action = ref();

const actionOptions = [
  { label: "فواتير صادره", index: "OutgoingInvoice" },
  { label: "مرتجع صادره", index: "ReturnedOutgoingInvoice" },
  { label: "فواتير وارده", index: "IncomingInvoice" },
  { label: "مرتجع وارده", index: "ReturnedIncomingInvoice" },
  { label: "نقله صادره", index: "TransferFrom" },
  { label: "نقله وارده", index: "TransferTo" },
  { label: "مخزون", index: "Stock" },
  { label: " منتج هالك", index: "DestructibleGoods" },
  { label: "قطعه غيار هالك", index: "KitOperation" },
];
function getData(reload = false, page = 1) {
  axios
    .get("/warehouse-action", {
      params: {
        warehouse: props.id,
        page: page,
        action: action.value,
      },
    })
    .then(function (response) {
      rowData.length = 0;
      if (reload) actions.length = 0;
      rowData.push(response.data);
      response.data.data.forEach((item) => {
        actions.push(item);
      });
    });
}

getData();

const handleScroll = (e) => {
  if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
    if (rowData[0])
      if (rowData[0].next_page_url != null) {
        getData(false, rowData[0].current_page + 1);
      }
  }
};
</script>