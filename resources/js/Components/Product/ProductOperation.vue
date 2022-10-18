<template>
  <CustomModel v-model="form.modelToggle"
    ><template #btn>
      <div
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
        "
      >
        <h2 class="w-full">
          المخزن : {{ item.destructible_goods.warehouse.name }}
        </h2>
        <h2 class="w-full">الكميه : 1</h2>
        <div class="w-full">
          <BadgeLight>
            <template v-if="item.action == 0">هالك مضاف</template>
            <template v-if="item.action == 1">إعدام</template>
            <template v-if="item.action == 1">أستعمال</template>
          </BadgeLight>
        </div>
        <h2 class="w-full text-right">
          {{ item.title }}
        </h2>
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
      </div>
    </template>
    <template #default>
      <div
        class="max-w-7xl mx-auto sm:px-6 lg:px-8"
        v-if="!edit && !deleteDiolog"
      >
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
          <h2 class="mb-3 font-bold">
            {{ item.title }}
          </h2>
          <div>{{ item.description }}</div>
          <h2 class="mb-3 font-bold">
            المخزن : {{ item.destructible_goods.warehouse.name }}
          </h2>
          <h2 class="mb-3 font-bold">الكميه : 1</h2>
          <div class="mb-3 font-bold">
            <BadgeLight>
              <template v-if="item.action == 0">هالك مضاف</template>
              <template v-if="item.action == 1">إعدام</template>
              <template v-if="item.action == 1">أستعمال</template>
            </BadgeLight>
          </div>
          <div class="mb-3 font-bold">
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
          <div class="flex justify-between mt-5">
            <BtnPrimary @click="edit = true">تعديل</BtnPrimary>
            <BtnDanger @click="deleteDiolog = true">حذف</BtnDanger>
          </div>
        </div>
      </div>
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" v-if="deleteDiolog">
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
          <h2 class="text-lg font-black">هل أنت متاكد من الحذف ؟</h2>
          <div class="flex justify-between mt-5">
            <BtnPrimary @click="deleteDiolog = false">إلغاء</BtnPrimary>
            <BtnDanger @click="deleteFun">حذف</BtnDanger>
          </div>
        </div>
      </div>
      <FormSection
        v-if="edit"
        title="أضف أستعمال"
        btnTitle="أضف"
        :formData="form"
        formRoute="kit-operation.update"
        toastMsg="تم الأستعمال "
        :toastDescription="`${form.title}`"
        @FormSuccess="FormSuccess"
      >
        <h2 class="w-full mb-5">المخزن : {{ item.warehouse.name }}</h2>
        <InputText v-model="form.title" title="البند" :require="true" />

        <InputNumber
          v-model="form.quantity"
          title="الكميه"
          step="1"
          :max="item.quantity"
        />
        <FormSelect
          v-model="form.action"
          title="نوع الإستعمال"
          :require="true"
          :options="option"
        ></FormSelect>
        <!-- Date -->
        <InputDate
          v-model="form.date"
          title="تاريخ الإستعمال"
          :require="true"
        />
        <template #footer
          ><BtnDanger class="mt-3" @click="edit = false"
            >إلغاء</BtnDanger
          ></template
        >
      </FormSection>
    </template>
  </CustomModel>
</template>
  <script setup>
import CustomModel from "@/Components/Modals/CustomModel.vue";
import { Inertia } from "@inertiajs/inertia";
import { reactive, ref } from "@vue/reactivity";
import { createToast } from "mosha-vue-toastify";
import BadgeLight from "../Badges/BadgeLight.vue";
import FormSection from "@/Forms/FormSection.vue";
import InputText from "@/Forms/InputText.vue";
import InputNumber from "@/Forms/InputNumber.vue";
import FormSelect from "@/Forms/FormSelect.vue";
import InputDate from "@/Forms/InputDate.vue";
import BtnPrimary from "../Buttons/BtnPrimary.vue";
import BtnDanger from "../Buttons/BtnDanger.vue";

const props = defineProps(["item"]);
const emit = defineEmits(["FormSuccess"]);

const edit = ref(false);
const deleteDiolog = ref(false);
const form = reactive({
  modelToggle: false,
  id: props.item.id,
  _method: "patch",
  title: props.item.title,
  action: props.item.action,
  quantity: props.item.quantity,
  date: props.item.date,
});
const option = [
  { label: "إعدام", index: 0 },
  { label: "إستعمال", index: 1 },
];
function FormSuccess() {
  emit("FormSuccess");
}
function deleteFun() {
  /**
   * PUT/PATCH/DELETE method
   * https://github.com/inertiajs/inertia/issues/495
   *
   */
  Inertia.delete(route("kit-operation.destroy", props.item.id), {
    onSuccess: () => {
      form.modelToggle = false;
      edit.value = false;
      deleteDiolog.value = false;
      emit("FormSuccess");
      createToast(
        {
          title: "تم الحذف",
        },
        {
          timeout: 3000,
          transition: "slide",
          type: "success",
          showIcon: true,
        }
      );
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
</script>