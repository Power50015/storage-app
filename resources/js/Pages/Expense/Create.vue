<template>
    <AppLayout title="المصاريف">
        <FormSection :title="formText.title" :btnTitle="formText.btnTitle" :formData="form" :formRoute="form.route"
            :toastMsg="formText.formText" :toastDescription="form.title">
            <!-- Name -->
            <InputText v-model="form.title" title="بند المصروف" :error="errors.name" :require="true" />
            <!-- Number -->
            <InputNumber v-model="form.amount" title="مبلغ المصروف" :error="errors.amount" :require="true" />
            <!-- Date -->
            <InputDate v-model="form.date" title=" تاريخ المصروف" :error="errors.date" :require="true" />
            <!-- Cash Type -->
            <FormSelect v-model="form.cash_id" title="نوع الكاش" :error="errors.cash_id" :require="true"
                :options="cash" />
            <!-- Description -->
            <InputTextArea v-model.lazy="form.description" title="تفاصيل المصروف" />
        </FormSection>
    </AppLayout>
</template>

<script setup>
import { provide, readonly, reactive, computed } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import FormSection from "@/Forms/FormSection.vue";
import InputText from "@/Forms/InputText.vue";
import InputTextArea from "@/Forms/InputTextArea.vue";
import InputDate from "@/Forms/InputDate.vue";
import FormSelect from "@/Forms/FormSelect.vue";
import InputNumber from "@/Forms/InputNumber.vue";

provide("title", "المصاريف");

const props = defineProps(["errors", "expense", "cash"]);

const form = reactive({
    id: props.expense ? props.expense[0].id : null,
    _method: props.expense ? "patch" : "post",
    route: props.expense ? "expense.update" : "expense.store",
    title: props.expense ? props.expense[0].title : null,
    description: props.expense ? props.expense[0].description : null,
    date: props.expense
        ? new Date(props.expense[0].date).toISOString().slice(0, 10)
        : new Date().toISOString().slice(0, 10),
    amount: props.expense ? props.expense[0].amount : null,
    cash_id: props.expense ? props.expense[0].cash_id : null,
});

if (props.expense) {
    provide(
        "breadcrumb",
        readonly([
            { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
            {
                index: 1,
                linkTitle: "المصاريف",
                linkRoute: "expense.index",
            },
            {
                index: 2,
                linkTitle: "تعديل  المصروف : " + props.expense[0].id,
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
                linkTitle: "المصاريف",
                linkRoute: "expense.index",
            },

            { index: 2, linkTitle: "مصروف جديد", linkRoute: "#" },
        ])
    );
}

const formText = reactive({
    title: props.warehouse ? "تعديل بيانات  مصروف" : "إضافه مصروف ",
    btnTitle: props.warehouse ? "تعديل مصروف" : "إضافه مصروف",
    formText: props.warehouse ? "تم تعديل مصروف" : "تم أضافه مصروف",
});

const cash = computed(() => {
    return props.cash.map((item) => {
        return {
            index: item.id,
            label: item.title,
        };
    });
});
</script>
