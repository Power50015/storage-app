<template>
  <div class="flex justify-between items-start">
    <h2 class="font-bold text-2xl">تفاصيل المخازن</h2>
    <div class="flex">
      <FormSelect
        v-model="action"
        :options="actionOptions"
        @change-select="getKitsData(true)"
      ></FormSelect>
    </div>
  </div>
  <div v-for="item in kits" :key="item.index">
    <div v-if="item.dataType == 'Stock'">
      <Link
        :href="route('warehouse-stock.show', item.warehouse_stock.id)"
        class="
          w-full
          flex
          justify-between
          cursor-pointer
          hover:text-[#0095e8]
          font-bold
          transition-all
          my-2
          py-4
          px-2
          text-right
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

        <h2 class="w-full text-left">
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
      </Link>
    </div>
    <div v-if="item.dataType == 'IncomingInvoice'">
      <Link
        :href="route('incoming-invoice.show', item.incoming_invoice.id)"
        class="
          w-full
          flex
          justify-between
          cursor-pointer
          hover:text-[#0095e8]
          font-bold
          transition-all
          my-2
          py-4
          px-2
          text-right
          font-bold
        "
      >
        <h2 class="w-full">
          المخزن : {{ item.incoming_invoice.warehouse.name }}
        </h2>
        <h2 class="w-full">الكميه : {{ item.quantity }}</h2>
        <div class="w-full">
          <BadgePrimary>فاتورة وارده</BadgePrimary>
        </div>
        <h2 class="w-full text-right">
          رقم الفاتوره : {{ item.incoming_invoice.number }}
        </h2>

        <h2 class="w-full text-left">
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
      </Link>
    </div>
    <div v-if="item.dataType == 'ReturnedIncomingInvoice'">
      <Link
        :href="route('incoming-invoice.show', item.incoming_invoice.id)"
        class="
          w-full
          flex
          justify-between
          cursor-pointer
          hover:text-[#0095e8]
          font-bold
          transition-all
          my-2
          py-4
          px-2
          text-right
        "
      >
        <h2 class="w-full">
          المخزن : {{ item.incoming_invoice.warehouse.name }}
        </h2>
        <h2 class="w-full">الكميه : {{ item.quantity }}</h2>
        <div class="w-full">
          <BadgeDanger>مرتجع فاتورة وارده</BadgeDanger>
        </div>
        <h2 class="w-full text-right">
          رقم الفاتوره : {{ item.incoming_invoice.number }}
        </h2>

        <h2 class="w-full text-left">
          {{
            new Date(item.date).toLocaleDateString("ar-EG-u-nu-latn", {
              weekday: "long",
              year: "numeric",
              month: "short",
              day: "numeric",
            })
          }}
        </h2>
      </Link>
    </div>
    <div v-if="item.dataType == 'Transfer'">
      <Link
        :href="route('transfer.show', item.transfer.id)"
        class="
          w-full
          flex
          justify-between
          cursor-pointer
          hover:text-[#0095e8]
          transition-all
          my-2
          py-4
          px-2
          text-right
          font-bold
        "
      >
        <h2 class="w-full">المخزن : {{ item.transfer.warehouse_from.name }}</h2>
        <h2 class="w-full">الكميه : {{ item.quantity }}</h2>
        <div class="w-full">
          <BadgeSecondary>نقله</BadgeSecondary>
        </div>
        <h2 class="w-full text-right">
          المخزن المستقبل : {{ item.transfer.warehouse_to.name }}
        </h2>

        <h2 class="w-full text-left">
          {{
            new Date(item.transfer.date).toLocaleDateString("ar-EG-u-nu-latn", {
              weekday: "long",
              year: "numeric",
              month: "short",
              day: "numeric",
            })
          }}
        </h2>
      </Link>
    </div>
    <div v-if="item.dataType == 'OutgoingInvoice'">
      <Link
        :href="route('outgoing-invoice.show', item.outgoing_invoice.id)"
        class="
          w-full
          flex
          justify-between
          cursor-pointer
          hover:text-[#0095e8]
          transition-all
          my-2
          py-4
          px-2
          text-right
          font-bold
        "
      >
        <h2 class="w-full">
          المخزن : {{ item.outgoing_invoice.warehouse.name }}
        </h2>
        <h2 class="w-full">الكميه : {{ item.quantity }}</h2>
        <div class="w-full">
          <BadgeSuccess>فاتورة صادره</BadgeSuccess>
        </div>
        <h2 class="w-full text-right">
          رقم الفاتوره : {{ item.outgoing_invoice.id }}
        </h2>

        <h2 class="w-full text-left">
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
      </Link>
    </div>
    <div v-if="item.dataType == 'ReturnedOutgoingInvoice'">
      <Link
        :href="route('outgoing-invoice.show', item.outgoing_invoice.id)"
        class="
          w-full
          flex
          justify-between
          cursor-pointer
          hover:text-[#0095e8]
          font-bold
          transition-all
          my-2
          py-4
          px-2
          text-right
        "
      >
        <h2 class="w-full">
          المخزن : {{ item.outgoing_invoice.warehouse.name }}
        </h2>
        <h2 class="w-full">الكميه : {{ item.quantity }}</h2>
        <div class="w-full">
          <BadgeWarning>مرتجع فاتورة صادره</BadgeWarning>
        </div>
        <h2 class="w-full text-right">
          رقم الفاتوره : {{ item.outgoing_invoice.id }}
        </h2>

        <h2 class="w-full text-left">
          {{
            new Date(item.date).toLocaleDateString("ar-EG-u-nu-latn", {
              weekday: "long",
              year: "numeric",
              month: "short",
              day: "numeric",
            })
          }}
        </h2>
      </Link>
    </div>
    <div v-if="item.dataType == 'KitOperation'">
      <div
        class="
          w-full
          flex
          justify-between
          cursor-pointer
          hover:text-[#0095e8]
          transition-all
          my-2
          py-4
          px-2
          text-right
          font-bold
        "
      >
        <h2 class="w-full">المخزن : {{ item.warehouse.name }}</h2>
        <h2 class="w-full">الكميه : {{ item.quantity }}</h2>
        <div class="w-full">
          <BadgeLight>
            <template v-if="item.action == 0">أعدام</template>
            <template v-if="item.action == 1">أستعمال</template>
          </BadgeLight>
        </div>
        <h2 class="w-full text-right">
          {{ item.title }}
        </h2>

        <h2 class="w-full text-left">
          {{
            new Date(item.date).toLocaleDateString("ar-EG-u-nu-latn", {
              weekday: "long",
              year: "numeric",
              month: "short",
              day: "numeric",
            })
          }}
        </h2>
      </div>
    </div>
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

const props = defineProps(["kit"]);

onMounted(() => window.addEventListener("scroll", handleScroll));

const rowData = reactive([]);
const kits = reactive([]);
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
  { label: "استهلاك", index: "KitOperation" },
];
function getKitsData(reload = false, page = 1) {
  axios
    .get("/kit-action", {
      params: {
        kit: props.kit,
        page: page,
        action: action.value,
      },
    })
    .then(function (response) {
      rowData.length = 0;
      if (reload) kits.length = 0;
      rowData.push(response.data);
      response.data.data.forEach((item) => {
        kits.push(item);
      });
    });
}

getKitsData();

const handleScroll = (e) => {
  if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
    if (rowData[0].next_page_url != null) {
      getKitsData(false, rowData[0].current_page + 1);
    }
  }
};
</script>