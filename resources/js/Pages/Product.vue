<template>
    <AppLayout title="المخازن">
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="dark:bg-[#1e1e2d] bg-white dark:text-white text-black overflow-hidden shadow-xl rounded-md p-4"
                >
                    <h2 class="title font-bold mb-4">إضافه منتج</h2>
                    <form action="POST" @submit.prevent="addProduct">
                        <div class="mb-5">
                            <label class="px-3 dark:text-gray-300">
                                قسم المنتج
                                <span class="text-red-800 font-bold">*</span>
                            </label>
                            <div v-if="errors.name" class="text-red-800">
                                {{ errors.name }}
                            </div>
                            <div class="flex">
                                <select
                                    class="w-full text-base dark:bg-[#1b1b29] bg-[#f5f8fa] dark:active:bg-[#1b1b29] active:bg-[#f5f8fa] dark:focus:bg-[#1b1b29] focus:bg-[#f5f8fa] focus:ring-0 border-0 shadow-sm rounded-r-md py-2"
                                    v-model="productCategory"
                                    @change="getProductType"
                                >
                                    <option disabled selected>
                                        اختار قسم المنتج
                                    </option>
                                    <option
                                        v-for="item in ProductCategory"
                                        :value="item.id"
                                        :key="item.id"
                                    >
                                        {{ item.name }}
                                    </option>
                                </select>
                                <AddProductCategoryModel />
                            </div>
                        </div>
                        <div class="mb-5">
                            <label class="px-3 dark:text-gray-300">
                                نوع المنتج
                                <span class="text-red-800 font-bold">*</span>
                            </label>
                            <div v-if="errors.name" class="text-red-800">
                                {{ errors.name }}
                            </div>
                            <div class="flex">
                                <select
                                    class="w-full text-base dark:bg-[#1b1b29] bg-[#f5f8fa] dark:active:bg-[#1b1b29] active:bg-[#f5f8fa] dark:focus:bg-[#1b1b29] focus:bg-[#f5f8fa] focus:ring-0 border-0 shadow-sm rounded-r-md py-2"
                                    v-model="ProductType"
                                >
                                    <option disabled selected>
                                        اختار نوع المنتج
                                    </option>
                                    <option
                                        v-for="item in ProductTypeData[0]"
                                        :value="item.name"
                                        :key="item.id"
                                    >
                                        {{ item.name }}
                                    </option>
                                </select>
                                <AddProductTypeModel
                                    :productType="productCategory"
                                    @product-type-save-success="getProductType"
                                />
                            </div>
                        </div>
                        <div class="mb-5">
                            <label class="px-3 dark:text-gray-300">
                                أسم المخزن
                                <span class="text-red-800 font-bold">*</span>
                            </label>
                            <div v-if="errors.name" class="text-red-800">
                                {{ errors.name }}
                            </div>

                            <input
                                type="text"
                                v-model="warehouseAddForm.name"
                                class="w-full text-base dark:bg-[#1b1b29] bg-[#f5f8fa] dark:active:bg-[#1b1b29] active:bg-[#f5f8fa] dark:focus:bg-[#1b1b29] focus:bg-[#f5f8fa] mt-1 focus:ring-0 border-0 shadow-sm rounded-md py-2"
                            />
                        </div>
                        <div>
                            <label class="px-3 dark:text-gray-300"
                                >عنوان المخزن</label
                            >
                            <textarea
                                type="text"
                                v-model="warehouseAddForm.address"
                                class="w-full text-base dark:bg-[#1b1b29] bg-[#f5f8fa] dark:active:bg-[#1b1b29] active:bg-[#f5f8fa] dark:focus:bg-[#1b1b29] focus:bg-[#f5f8fa] mt-1 focus:ring-0 border-0 shadow-sm rounded-md py-2 min-h-[100px]"
                            ></textarea>
                        </div>
                        <div>
                            <button
                                type="submit"
                                class="mt-6 w-full bg-[#009ef7] border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-[#009ef7] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#009ef7]"
                            >
                                حفظ المخزن
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import axios from "axios";
import { computed, provide, readonly, ref, reactive } from "@vue/runtime-core";
import { Inertia } from "@inertiajs/inertia";
import { createToast } from "mosha-vue-toastify";

import AppLayout from "@/Layouts/AppLayout.vue";
import AddProductCategoryModel from "@/Components/Product/AddProductCategoryModel.vue";
import AddProductTypeModel from "@/Components/Product/AddProductTypeModel.vue";

provide("title", "المخازن");
provide(
    "breadcrumb",
    readonly([
        { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
        { index: 1, linkTitle: "المخازن", linkRoute: "#" },
    ])
);

const props = defineProps(["errors", "ProductCategory"]);

const productCategory = ref();
const ProductType = ref();
const ProductTypeData = reactive([]);
// const ProductType = computed(() => {
//     const computedData = reactive([]);
//     axios.get("/product-type/" + productCategory.value).then((data) => {
//         computedData.push(data.data);
//     });
//     return computedData;
// });

function getProductType() {
    ProductTypeData.length = 0;
    axios
        .get("/product-type/" + productCategory.value)
        .then((data) => ProductTypeData.push(data.data));
}
/*const warehouseData = computed(() => {
    return props.warehouse;
});*/
const warehouseAddForm = reactive({
    name: null,
    address: null,
});
/*
function addWarehouse() {
    Inertia.post(route("warehouse.store"), warehouseAddForm, {
        onSuccess: () => {
            createToast(
                {
                    title: "تم تسجيل المخزن",
                    description: " تم تسجيل المخزن " + warehouseAddForm.name,
                },
                {
                    timeout: 3000,
                    transition: "slide",
                    type: "success",
                    showIcon: true,
                }
            );
            warehouseAddForm.name = "";
            warehouseAddForm.address = "";
        },
        onError: (errors) => {
            for (const [key, value] of Object.entries(errors)) {
                for (const key in errors) {
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
            }
        },
    });
}*/
</script>
