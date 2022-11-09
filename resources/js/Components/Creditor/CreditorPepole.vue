    <template>
  <div class="flex justify-between items-start">
    <h2 class="font-bold text-2xl">الدائنون</h2>
    <InputText
      v-model="inputText"
      placeholder="بحث ...."
      @input="getPeopleData((reload = true))"
    />
  </div>
  <div v-for="item in people" :key="item.index">
    <div class="flex justify-between items-center md:flex-row flex-col">
      <Link
        :href="route('people.show', item.id)"
        class="
          w-full
          cursor-pointer
          hover:text-[#0095e8]
          font-bold
          transition-all
          my-2
          py-4
          px-2
          text-right
          flex
          justify-between
          items-center
          md:flex-row
          flex-col
        "
      >
        <h2 class="">{{ item.name }}</h2>
        <h2 class="">{{ item.total_credit.toFixed(2) * -1 }}</h2>
      </Link>
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
import { reactive, ref } from "@vue/reactivity";
import axios from "axios";
import { onMounted } from "@vue/runtime-core";
import DotsSpinner from "../Spinner/DotsSpinner.vue";
import InputText from "@/Forms/InputText.vue";

onMounted(() => window.addEventListener("scroll", handleScroll));

const rowData = reactive([]);
const people = reactive([]);
const inputText = ref("");

function getPeopleData(reload = false, page = 1) {
  if (reload) people.length = 0;
  axios
    .get("/creditor-people", {
      params: {
        page: page,
        search: inputText.value,
      },
    })
    .then(function (response) {
      rowData.length = 0;
      rowData.push(response.data.people);
      response.data.people.data.forEach((item) => {
        people.push(item);
      });
    });
}

getPeopleData();

const handleScroll = (e) => {
  if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
    if (rowData[0])
      if (rowData[0].next_page_url != null) {
        getPeopleData(false, rowData[0].current_page + 1);
      }
  }
};
</script>