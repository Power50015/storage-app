<template>
  <div class="flex justify-between items-start">
    <h2 class="font-bold text-2xl">الملاحظات</h2>
    <InputText
      v-model="inputText"
      placeholder="بحث ...."
      @input="getNoteData((reload = true))"
    />
  </div>
  <div class="grid gap-x-4 gap-y-2 grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
    <div class="mt-3">
      <Modal v-model="form.modelToggle">
        <template #btn
          ><i class="fa-solid fa-pen-to-square"></i>
          <span class="mx-3">إضافه ملاحظه</span></template
        >
        <template #default>
          <FormSection
            title="إضافه بيانات ملاحظه"
            btnTitle="إضافه ملاحظه"
            :formData="form"
            :formRoute="`${url}.store`"
            toastMsg="تم إضافه الملاحظه"
            :toastDescription="`تم الإضافه   : ${form.tag}`"
            @FormSuccess="getNoteData((reload = true))"
          >
            <InputText v-model="form.tag" title="تاج" />
            <InputTextArea
              v-model="form.note"
              title="الملحوظه"
              :require="true"
            />
          </FormSection>
        </template>
      </Modal>
    </div>
    <div
      v-for="item in notes"
      :key="item.index"
      class="
        my-2
        dark:bg-[#151521]
        bg-[#f5f8fa]
        p-3
        rounded-md
        flex flex-col
        justify-between
      "
    >
      <div class="flex flex-col items-start mb-3">
        <div class="w-full flex justify-between">
          <div>
            <BadgePrimary class="mb-3" v-if="item.tag"
            >{{ item.tag }}
          </BadgePrimary>
          </div>
          <DeleteModel
            :id="item.id"
            :title="` الملاحظه   : ${item.tag}`"
            :data="item.note"
            :url="url"
            @DeleteSuccess="getNoteData((reload = true))"
          />
        </div>
        <BadgeInfo>{{
          new Date(item.created_at).toLocaleDateString("ar-EG-u-nu-latn", {
            weekday: "long",
            year: "numeric",
            month: "short",
            day: "numeric",
          })
        }}</BadgeInfo>
      </div>
      <div v-html="item.note"></div>
      <div class="my-3">
        <div class="flex items-center">
          <img
            :src="item.user.profile_photo_url"
            :alt="item.user.name"
            class="w-[50px] h-[50px] rounded-full"
          />
          <h6 class="mx-2">{{ item.user.name }}</h6>
        </div>
      </div>
    </div>
  </div>
  <div v-if="(rowData[0] && rowData[0].next_page_url) || rowData.length == 0">
    <DotsSpinner />
  </div>
  <div v-if="rowData[0] && rowData[0].data.length == 0" class="mt-3">
    لا يوجد ملاحظات
  </div>
</template>
<script setup>
import { reactive, ref } from "@vue/reactivity";
import axios from "axios";
import { onMounted } from "@vue/runtime-core";
import DotsSpinner from "../Spinner/DotsSpinner.vue";
import BadgePrimary from "../Badges/BadgePrimary.vue";
import BadgeInfo from "../Badges/BadgeInfo.vue";
import FormSection from "@/Forms/FormSection.vue";
import InputText from "@/Forms/InputText.vue";
import InputTextArea from "@/Forms/InputTextArea.vue";
import Modal from "@/Components/Modals/Modal.vue";
import DeleteModel from "../Modals/DeleteModel.vue";

const props = defineProps(["url", "id"]);

onMounted(() => window.addEventListener("scroll", handleScroll));

const form = reactive({
  id: props.id,
  title: "",
  note: "",
  modelToggle: false,
});
const rowData = reactive([]);
const notes = reactive([]);
const inputText = ref();
function getNoteData(reload = false, page = 1) {
  form.id = props.id;
  if (reload) notes.length = 0;
  if (reload) rowData.length = 0;
  axios
    .get(route(props.url + ".index"), {
      params: {
        id: props.id,
        page: page,
        search: inputText.value,
      },
    })
    .then(function (response) {
      rowData.length = 0;
      rowData.push(response.data.note);
      response.data.note.data.forEach((item) => {
        notes.push(item);
      });
    });
}

getNoteData();

const handleScroll = (e) => {
  if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
    if (rowData[0])
      if (rowData[0].next_page_url != null) {
        getNoteData(false, rowData[0].current_page + 1);
      }
  }
};
</script>