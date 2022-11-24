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
          md:flex-row
          flex-col
        "
      >
        <div class="w-full">
          <h3 class="text-sm font-bold mx-3">
            {{ item.destructible_goods.product.name }}
            <template v-if="item.destructible_goods.product.product_collection">
              - {{ item.destructible_goods.product.product_collection.name }} -
            </template>
            <template v-if="item.destructible_goods.product.product_model">
              {{ item.destructible_goods.product.product_model.name }} -
            </template>
            <template v-if="item.destructible_goods.product.product_brand">
              {{ item.destructible_goods.product.product_brand.name }} -
            </template>
            <template v-if="item.destructible_goods.product.product_category">
              - {{ item.destructible_goods.product.product_category.name }}
            </template>
            <template v-if="item.destructible_goods.product.product_type">
              - {{ item.destructible_goods.product.product_type.name }}
            </template>
            <template v-if="item.destructible_goods.product.product_color">
              - {{ item.destructible_goods.product.product_color.name }}
            </template>
            <template v-if="item.destructible_goods.product.product_material">
              - {{ item.destructible_goods.product.product_material.name }}
            </template>
            <template v-if="item.destructible_goods.product.product_country">
              - {{ item.destructible_goods.product.product_country.name }}
            </template>
          </h3>
          <template>الكميه : 1</template>
        </div>
        <div class="w-full text-center">
          <BadgeLight>
            <template v-if="item.action == 0">هالك مضاف</template>
            <template v-if="item.action == 1">تم الإعدام</template>
            <template v-if="item.action == 2">تم الإصلاح</template>
          </BadgeLight>
        </div>
        <h2 class="w-full text-right">
          {{ item.title }}
        </h2>
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
          <div v-html="item.description"></div>
          <h2 class="mb-3 font-bold">الكميه : 1</h2>
          <div class="mb-3 font-bold">
            <BadgeLight>
              <template v-if="item.action == 0">هالك مضاف</template>
              <template v-if="item.action == 1">إعدام</template>
              <template v-if="item.action == 2">أستعمال</template>
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
          </div>
        </div>
      </div>
      <FormSection
        v-if="edit"
        title="تعديل الهالك"
        btnTitle="عدل"
        :formData="form"
        formRoute="destructible-goods-action.update"
        toastMsg="تم التعديل "
        @FormSuccess="FormSuccess"
      >

        <InputText v-model="form.title" title="البند" :require="true" />
        <InputTextArea v-model="form.description" title="الوصف" />
        <FormSelect
          v-if="item.action != 0"
          v-model="form.action"
          title="نوع العمليه"
          :require="true"
          :options="option"
        ></FormSelect>
        <!-- Date -->
        <InputDate v-model="form.date" title="تاريخ الإهلاك" :require="true" />
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
import BadgeLight from "../Badges/BadgeLight.vue";
import FormSection from "@/Forms/FormSection.vue";
import InputText from "@/Forms/InputText.vue";
import InputTextArea from "@/Forms/InputTextArea.vue";
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
  date: props.item.date,
  description: props.item.description,
});

const option = [
  { label: "إعدام", index: 1 },
  { label: "أصلاح", index: 2 },
];
function FormSuccess() {
  emit("FormSuccess");
}
</script>