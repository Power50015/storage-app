<template>
  <div class="flex justify-between items-start">
    <h2 class="font-bold text-2xl">تحركات تفصليه</h2>
    <div class="flex">
      <FormSelect
        v-model="action"
        :options="actionOptions"
        @change-select="getPeopleData(true)"
      ></FormSelect>
    </div>
  </div>
  <div v-for="item in actions" :key="item.index">
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
          lg:flex-row
          flex-col
        "
      >
        <div class="w-full">
          <h2>رقم الفاتوره : {{ item.incoming_invoice.number }}</h2>
          <h2>المخزن : {{ item.incoming_invoice.warehouse.name }}</h2>
          <div class="flex mt-3">
            <img
              :src="`/storage/${item.product.image}`"
              :alt="item.product.name"
              class="w-[35px] h-[35px] rounded-full"
            />
            <h3 class="text-sm font-bold mx-3">
              <template> {{ item.product.name }} - </template>
              <template v-if="item.product.product_collection">
                {{ item.product.product_collection.name }} -
              </template>
              <template v-if="item.product.product_model">
                {{ item.product.product_model.name }} -
              </template>
              <template v-if="item.product.product_brand">
                {{ item.product.product_brand.name }} -
              </template>
              <template v-if="item.product.product_category">
                - {{ item.product.product_category.name }}
              </template>
              <template v-if="item.product.product_type">
                - {{ item.product.product_type.name }}
              </template>
              <template v-if="item.product.product_color">
                - {{ item.product.product_color.name }}
              </template>
              <template v-if="item.product.product_material">
                - {{ item.product.product_material.name }}
              </template>
              <template v-if="item.product.product_country">
                - {{ item.product.product_country.name }}
              </template>
            </h3>
          </div>
        </div>
        <div class="w-full flex justify-center">
          <BadgeSuccess>منتج وارده</BadgeSuccess>
        </div>
        <div class="w-full">
          <div class="flex">
            الكميه : {{ item.quantity }} * السعر : {{ item.price }}
          </div>
          <div>إجمالى المنتج : {{ item.quantity * item.price }}</div>
          <div>
            إجمالى الفاتوره :
            {{ item.incoming_invoice.total_after_discount.toFixed(2) }}
          </div>
          <div v-if="item.incoming_invoice.pay_type">
            الدفع : {{ item.incoming_invoice.cash.title }}
          </div>
          <div v-else>الدفع :على الحساب</div>
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
    <div v-if="item.dataType == 'ReturnedIncomingInvoice'">
      <template
        v-for="x in item.incoming_invoice.incoming_invoice_contents"
        :key="x.id"
      >
        <Link
          v-if="x.product_id == item.product_id"
          :href="route('incoming-invoice.show', item.incoming_invoice_id)"
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
            lg:flex-row
            flex-col
          "
        >
          <div class="w-full">
            <h2>رقم الفاتوره : {{ item.incoming_invoice.number }}</h2>
            <h2>المخزن : {{ item.incoming_invoice.warehouse.name }}</h2>
            <div class="flex mt-3">
              <img
                :src="`/storage/${item.product.image}`"
                :alt="item.product.name"
                class="w-[35px] h-[35px] rounded-full"
              />
              <h3 class="text-sm font-bold mx-3">
                <template> {{ item.product.name }} - </template>
                <template v-if="item.product.product_collection">
                  {{ item.product.product_collection.name }} -
                </template>
                <template v-if="item.product.product_model">
                  {{ item.product.product_model.name }} -
                </template>
                <template v-if="item.product.product_brand">
                  {{ item.product.product_brand.name }} -
                </template>
                <template v-if="item.product.product_category">
                  - {{ item.product.product_category.name }}
                </template>
                <template v-if="item.product.product_type">
                  - {{ item.product.product_type.name }}
                </template>
                <template v-if="item.product.product_color">
                  - {{ item.product.product_color.name }}
                </template>
                <template v-if="item.product.product_material">
                  - {{ item.product.product_material.name }}
                </template>
                <template v-if="item.product.product_country">
                  - {{ item.product.product_country.name }}
                </template>
              </h3>
            </div>
          </div>
          <div class="w-full flex justify-center">
            <BadgeSuccess>منتج وارده</BadgeSuccess>
          </div>

          <div class="w-full">
            <div class="flex">
              الكميه : {{ item.quantity }} * السعر :
              {{ x.price }}
            </div>
            <div>
              إجمالى المنتج :
              {{ item.quantity * x.price }}
            </div>
            <div>
              إجمالى الفاتوره :
              {{ item.incoming_invoice.total_after_discount.toFixed(2) }}
            </div>
            <div v-if="item.incoming_invoice.pay_type">
              الدفع : {{ item.incoming_invoice.cash.title }}
            </div>
            <div v-else>الدفع :على الحساب</div>
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
      </template>
    </div>
    <div v-if="item.dataType == 'IncomingInvoiceKit'">
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
          lg:flex-row
          flex-col
        "
      >
        <div class="w-full">
          <h2>رقم الفاتوره : {{ item.incoming_invoice.number }}</h2>
          <h2>المخزن : {{ item.incoming_invoice.warehouse.name }}</h2>
          <div class="flex mt-3">
            <img
              :src="`/storage/${item.kit.image}`"
              :alt="item.kit.name"
              class="w-[35px] h-[35px] rounded-full"
            />
            <h3 class="text-sm font-bold mx-3">
              <template>
                {{ item.kit.name }}
              </template>
              <template v-if="item.kit.product">
                - {{ item.kit.product.name }} -
                <template v-if="item.kit.product.product_collection">
                  {{ item.kit.product.product_collection.name }} -
                </template>
                <template v-if="item.kit.product.product_model">
                  {{ item.kit.product.product_model.name }} -
                </template>
                <template v-if="item.kit.product.product_brand">
                  {{ item.kit.product.product_brand.name }} -
                </template>
                <template v-if="item.kit.product.product_category">
                  - {{ item.kit.product.product_category.name }}
                </template>
                <template v-if="item.kit.product.product_type">
                  - {{ item.kit.product.product_type.name }}
                </template>
                <template v-if="item.kit.product.product_color">
                  - {{ item.kit.product.product_color.name }}
                </template>
                <template v-if="item.kit.product.product_material">
                  - {{ item.kit.product.product_material.name }}
                </template>
                <template v-if="item.kit.product.product_country">
                  - {{ item.kit.product.product_country.name }}
                </template>
              </template>
            </h3>
          </div>
        </div>
        <div class="w-full flex justify-center">
          <BadgeSuccess>قطع غيار وارده</BadgeSuccess>
        </div>
        <div class="w-full">
          <div class="flex">
            الكميه : {{ item.quantity }} * السعر : {{ item.price }}
          </div>
          <div>إجمالى المنتج : {{ item.quantity * item.price }}</div>
          <div>
            إجمالى الفاتوره :
            {{ item.incoming_invoice.total_after_discount.toFixed(2) }}
          </div>
          <div v-if="item.incoming_invoice.pay_type">
            الدفع : {{ item.incoming_invoice.cash.title }}
          </div>
          <div v-else>الدفع :على الحساب</div>
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
    <div v-if="item.dataType == 'ReturnedIncomingInvoiceKit'">
      <template
        v-for="x in item.incoming_invoice.incoming_invoice_kits"
        :key="x.id"
      >
        <Link
          v-if="x.kit_id == item.kit_id"
          :href="route('incoming-invoice.show', item.incoming_invoice_id)"
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
            lg:flex-row
            flex-col
          "
        >
          <div class="w-full">
            <h2>رقم الفاتوره : {{ item.incoming_invoice.number }}</h2>
            <h2>المخزن : {{ item.incoming_invoice.warehouse.name }}</h2>
            <div class="flex mt-3">
              <img
                :src="`/storage/${item.kit.image}`"
                :alt="item.kit.name"
                class="w-[35px] h-[35px] rounded-full"
              />
              <h3 class="text-sm font-bold mx-3">
                <template>
                  {{ item.kit.name }}
                </template>
                <template v-if="item.kit.product">
                  - {{ item.kit.product.name }} -
                  <template
                    v-if="
                      item.kit.product.product_collection && item.kit.product
                    "
                  >
                    {{ item.kit.product.product_collection.name }} -
                  </template>
                  <template
                    v-if="item.kit.product.product_model && item.kit.product"
                  >
                    {{ item.kit.product.product_model.name }} -
                  </template>
                  <template
                    v-if="item.kit.product.product_brand && item.kit.product"
                  >
                    {{ item.kit.product.product_brand.name }} -
                  </template>
                  <template
                    v-if="item.kit.product.product_category && item.kit.product"
                  >
                    - {{ item.kit.product.product_category.name }}
                  </template>
                  <template
                    v-if="item.kit.product.product_type && item.kit.product"
                  >
                    - {{ item.kit.product.product_type.name }}
                  </template>
                  <template
                    v-if="item.kit.product.product_color && item.kit.product"
                  >
                    - {{ item.kit.product.product_color.name }}
                  </template>
                  <template
                    v-if="item.kit.product.product_material && item.kit.product"
                  >
                    - {{ item.kit.product.product_material.name }}
                  </template>
                  <template
                    v-if="item.kit.product.product_country && item.kit.product"
                  >
                    - {{ item.kit.product.product_country.name }}
                  </template>
                </template>
              </h3>
            </div>
          </div>
          <div class="w-full flex justify-center">
            <BadgeSuccess>مرتجع قطع غيار وارده</BadgeSuccess>
          </div>

          <div class="w-full">
            <div class="flex">
              الكميه : {{ item.quantity }} * السعر :
              {{ x.price }}
            </div>
            <div>
              إجمالى المنتج :
              {{ item.quantity * x.price }}
            </div>
            <div>
              إجمالى الفاتوره :
              {{ item.incoming_invoice.total_after_discount.toFixed(2) }}
            </div>
            <div v-if="item.incoming_invoice.pay_type">
              الدفع : {{ item.incoming_invoice.cash.title }}
            </div>
            <div v-else>الدفع :على الحساب</div>
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
      </template>
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
          lg:flex-row
          flex-col
        "
      >
        <div class="w-full">
          <h2>رقم الفاتوره : {{ item.id }}</h2>
          <h2>المخزن : {{ item.outgoing_invoice.warehouse.name }}</h2>
          <div class="flex mt-3">
            <img
              :src="`/storage/${item.product.image}`"
              :alt="item.product.name"
              class="w-[35px] h-[35px] rounded-full"
            />
            <h3 class="text-sm font-bold mx-3">
              <template> {{ item.product.name }} - </template>
              <template v-if="item.product.product_collection">
                {{ item.product.product_collection.name }} -
              </template>
              <template v-if="item.product.product_model">
                {{ item.product.product_model.name }} -
              </template>
              <template v-if="item.product.product_brand">
                {{ item.product.product_brand.name }} -
              </template>
              <template v-if="item.product.product_category">
                - {{ item.product.product_category.name }}
              </template>
              <template v-if="item.product.product_type">
                - {{ item.product.product_type.name }}
              </template>
              <template v-if="item.product.product_color">
                - {{ item.product.product_color.name }}
              </template>
              <template v-if="item.product.product_material">
                - {{ item.product.product_material.name }}
              </template>
              <template v-if="item.product.product_country">
                - {{ item.product.product_country.name }}
              </template>
            </h3>
          </div>
        </div>
        <div class="w-full flex justify-center">
          <BadgeSuccess>منتج صادره</BadgeSuccess>
        </div>
        <div class="w-full">
          <div class="flex">
            الكميه : {{ item.quantity }} * السعر : {{ item.price }}
          </div>
          <div>إجمالى المنتج : {{ item.quantity * item.price }}</div>
          <div>
            إجمالى الفاتوره :
            {{ item.outgoing_invoice.total_after_discount.toFixed(2) }}
          </div>
          <div v-if="item.outgoing_invoice.pay_type">
            الدفع : {{ item.outgoing_invoice.cash.title }}
          </div>
          <div v-else>الدفع :على الحساب</div>
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
    <div v-if="item.dataType == 'ReturnedOutgoingInvoice'">
      <template
        v-for="x in item.outgoing_invoice.outgoing_invoice_contents"
        :key="x.id"
      >
        <Link
          v-if="x.product_id == item.product_id"
          :href="route('outgoing-invoice.show', item.outgoing_invoice_id)"
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
            lg:flex-row
            flex-col
          "
        >
          <div class="w-full">
            <h2>رقم الفاتوره : {{ item.outgoing_invoice.id }}</h2>
            <h2>المخزن : {{ item.outgoing_invoice.warehouse.name }}</h2>
            <div class="flex mt-3">
              <img
                :src="`/storage/${item.product.image}`"
                :alt="item.product.name"
                class="w-[35px] h-[35px] rounded-full"
              />
              <h3 class="text-sm font-bold mx-3">
                <template> {{ item.product.name }} - </template>
                <template v-if="item.product.product_collection">
                  {{ item.product.product_collection.name }} -
                </template>
                <template v-if="item.product.product_model">
                  {{ item.product.product_model.name }} -
                </template>
                <template v-if="item.product.product_brand">
                  {{ item.product.product_brand.name }} -
                </template>
                <template v-if="item.product.product_category">
                  - {{ item.product.product_category.name }}
                </template>
                <template v-if="item.product.product_type">
                  - {{ item.product.product_type.name }}
                </template>
                <template v-if="item.product.product_color">
                  - {{ item.product.product_color.name }}
                </template>
                <template v-if="item.product.product_material">
                  - {{ item.product.product_material.name }}
                </template>
                <template v-if="item.product.product_country">
                  - {{ item.product.product_country.name }}
                </template>
              </h3>
            </div>
          </div>
          <div class="w-full flex justify-center">
            <BadgeSuccess>مرتجع منتج صادره</BadgeSuccess>
          </div>

          <div class="w-full">
            <div class="flex">
              الكميه : {{ item.quantity }} * السعر :
              {{ x.price }}
            </div>
            <div>
              إجمالى المنتج :
              {{ item.quantity * x.price }}
            </div>
            <div>
              إجمالى الفاتوره :
              {{ item.outgoing_invoice.total_after_discount.toFixed(2) }}
            </div>
            <div v-if="item.outgoing_invoice.pay_type">
              الدفع : {{ item.outgoing_invoice.cash.title }}
            </div>
            <div v-else>الدفع :على الحساب</div>
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
      </template>
    </div>
    <div v-if="item.dataType == 'OutgoingInvoiceKit'">
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
          lg:flex-row
          flex-col
        "
      >
        <div class="w-full">
          <h2>رقم الفاتوره : {{ item.id }}</h2>
          <h2>المخزن : {{ item.outgoing_invoice.warehouse.name }}</h2>
          <div class="flex mt-3">
            <img
              :src="`/storage/${item.kit.image}`"
              :alt="item.kit.name"
              class="w-[35px] h-[35px] rounded-full"
            />
            <h3 class="text-sm font-bold mx-3">
              <template>
                {{ item.kit.name }}
              </template>
              <template v-if="item.kit.product">
                - {{ item.kit.product.name }} -
                <template v-if="item.kit.product.product_collection">
                  {{ item.kit.product.product_collection.name }} -
                </template>
                <template v-if="item.kit.product.product_model">
                  {{ item.kit.product.product_model.name }} -
                </template>
                <template v-if="item.kit.product.product_brand">
                  {{ item.kit.product.product_brand.name }} -
                </template>
                <template v-if="item.kit.product.product_category">
                  - {{ item.kit.product.product_category.name }}
                </template>
                <template v-if="item.kit.product.product_type">
                  - {{ item.kit.product.product_type.name }}
                </template>
                <template v-if="item.kit.product.product_color">
                  - {{ item.kit.product.product_color.name }}
                </template>
                <template v-if="item.kit.product.product_material">
                  - {{ item.kit.product.product_material.name }}
                </template>
                <template v-if="item.kit.product.product_country">
                  - {{ item.kit.product.product_country.name }}
                </template>
              </template>
            </h3>
          </div>
        </div>
        <div class="w-full flex justify-center">
          <BadgeSuccess>قطع غيار صادره</BadgeSuccess>
        </div>
        <div class="w-full">
          <div class="flex">
            الكميه : {{ item.quantity }} * السعر : {{ item.price }}
          </div>
          <div>إجمالى المنتج : {{ item.quantity * item.price }}</div>
          <div>
            إجمالى الفاتوره :
            {{ item.outgoing_invoice.total_after_discount.toFixed(2) }}
          </div>
          <div v-if="item.outgoing_invoice.pay_type">
            الدفع : {{ item.outgoing_invoice.cash.title }}
          </div>
          <div v-else>الدفع :على الحساب</div>
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
    <div v-if="item.dataType == 'ReturnedOutgoingInvoiceKit'">
      <template
        v-for="x in item.outgoing_invoice.outgoing_invoice_kits"
        :key="x.id"
      >
        <Link
          v-if="x.kit_id == item.kit_id"
          :href="route('outgoing-invoice.show', item.outgoing_invoice_id)"
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
            lg:flex-row
            flex-col
          "
        >
          <div class="w-full">
            <h2>رقم الفاتوره : {{ item.outgoing_invoice.id }}</h2>
            <h2>المخزن : {{ item.outgoing_invoice.warehouse.name }}</h2>
            <div class="flex mt-3">
              <img
                :src="`/storage/${item.kit.image}`"
                :alt="item.kit.name"
                class="w-[35px] h-[35px] rounded-full"
              />
              <h3 class="text-sm font-bold mx-3">
                <template>
                  {{ item.kit.name }}
                </template>
                <template v-if="item.kit.product">
                  - {{ item.kit.product.name }} -
                </template>
                <template
                  v-if="item.kit.product.product_collection && item.kit.product"
                >
                  {{ item.kit.product.product_collection.name }} -
                </template>
                <template
                  v-if="item.kit.product.product_model && item.kit.product"
                >
                  {{ item.kit.product.product_model.name }} -
                </template>
                <template
                  v-if="item.kit.product.product_brand && item.kit.product"
                >
                  {{ item.kit.product.product_brand.name }} -
                </template>
                <template
                  v-if="item.kit.product.product_category && item.kit.product"
                >
                  - {{ item.kit.product.product_category.name }}
                </template>
                <template
                  v-if="item.kit.product.product_type && item.kit.product"
                >
                  - {{ item.kit.product.product_type.name }}
                </template>
                <template
                  v-if="item.kit.product.product_color && item.kit.product"
                >
                  - {{ item.kit.product.product_color.name }}
                </template>
                <template
                  v-if="item.kit.product.product_material && item.kit.product"
                >
                  - {{ item.kit.product.product_material.name }}
                </template>
                <template
                  v-if="item.kit.product.product_country && item.kit.product"
                >
                  - {{ item.kit.product.product_country.name }}
                </template>
              </h3>
            </div>
          </div>
          <div class="w-full flex justify-center">
            <BadgeSuccess>مرتجع قطع غيار صادره</BadgeSuccess>
          </div>

          <div class="w-full">
            <div class="flex">
              الكميه : {{ item.quantity }} * السعر :
              {{ x.price }}
            </div>
            <div>
              إجمالى المنتج :
              {{ item.quantity * x.price }}
            </div>
            <div>
              إجمالى الفاتوره :
              {{ item.outgoing_invoice.total_after_discount.toFixed(2) }}
            </div>
            <div v-if="item.outgoing_invoice.pay_type">
              الدفع : {{ item.outgoing_invoice.cash.title }}
            </div>
            <div v-else>الدفع :على الحساب</div>
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
      </template>
    </div>
    <div v-if="item.dataType == 'Debtor'">
      <Link
        :href="route('debtor.show', item.id)"
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
          lg:flex-row
          flex-col
        "
      >
        <div class="w-full">
          <h2>{{ item.title }}</h2>
        </div>
        <div class="w-full flex justify-center">
          <BadgeWarning>دين مدين</BadgeWarning>
        </div>
        <h2 class="w-full">المبلغ : {{ item.amount }}</h2>

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
    <div v-if="item.dataType == 'DebtorPay'">
      <Link
        :href="route('debtor-pay.show', item.id)"
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
          lg:flex-row
          flex-col
        "
      >
        <div class="w-full">
          <h2>{{ item.title }}</h2>
          <h2>{{ item.cash.title }}</h2>
        </div>
        <div class="w-full flex justify-center">
          <BadgeSecondary>دفعه وارده</BadgeSecondary>
        </div>
        <h2 class="w-full">المبلغ : {{ item.amount }}</h2>

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
    <div v-if="item.dataType == 'DebtorKilled'">
      <Link
        :href="route('debtor-pay.show', item.id)"
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
          lg:flex-row
          flex-col
        "
      >
        <div class="w-full">
          <h2>{{ item.title }}</h2>
        </div>
        <div class="w-full flex justify-center">
          <BadgeDanger>دين مدين معدم</BadgeDanger>
        </div>
        <h2 class="w-full">المبلغ : {{ item.amount }}</h2>

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
    <div v-if="item.dataType == 'Creditor'">
      <Link
        :href="route('creditor.show', item.id)"
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
          lg:flex-row
          flex-col
        "
      >
        <div class="w-full">
          <h2>{{ item.title }}</h2>
        </div>
        <div class="w-full flex justify-center">
          <BadgeWarning>دين دائن</BadgeWarning>
        </div>
        <h2 class="w-full">المبلغ : {{ item.amount }}</h2>

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
    <div v-if="item.dataType == 'CreditorPay'">
      <Link
        :href="route('creditor-pay.show', item.id)"
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
          lg:flex-row
          flex-col
        "
      >
        <div class="w-full">
          <h2>{{ item.title }}</h2>
          <h2>{{ item.cash.title }}</h2>
        </div>
        <div class="w-full flex justify-center">
          <BadgeSecondary>دفعه صادره</BadgeSecondary>
        </div>
        <h2 class="w-full">المبلغ : {{ item.amount }}</h2>

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
    <div v-if="item.dataType == 'CreditorKilled'">
      <Link
        :href="route('creditor-pay.show', item.id)"
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
          lg:flex-row
          flex-col
        "
      >
        <div class="w-full">
          <h2>{{ item.title }}</h2>
        </div>
        <div class="w-full flex justify-center">
          <BadgeDanger>دين دائن معدم</BadgeDanger>
        </div>
        <h2 class="w-full">المبلغ : {{ item.amount }}</h2>

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

const props = defineProps(["id"]);

onMounted(() => window.addEventListener("scroll", handleScroll));

const rowData = reactive([]);
const actions = reactive([]);
const inputText = ref();
const action = ref();

const actionOptions = [
  { label: "منتجات وارده", index: "IncomingInvoice" },
  { label: "مرتجع منتجات وراده", index: "ReturnedIncomingInvoice" },
  { label: "قطع غيار وارده", index: "IncomingInvoiceKit" },
  { label: "مرتجع قطع غيار وارده", index: "ReturnedIncomingInvoiceKit" },
  { label: "منتجات صادره", index: "OutgoingInvoice" },
  { label: "مرتجع منتجات صادره", index: "ReturnedOutgoingInvoice" },
  { label: "قطع غيار صادره", index: "OutgoingInvoiceKit" },
  { label: "مرتجع قطع غيار صادره", index: "ReturnedOutgoingInvoiceKit" },
  { label: "دين مدين", index: "Debtor" },
  { label: "دفعه وارده", index: "DebtorPay" },
  { label: "دين مدين معدم", index: "DebtorKilled" },
  { label: "دين دائن", index: "Creditor" },
  { label: "دفعه صادره", index: "CreditorPay" },
  { label: "دين دائن معدم", index: "CreditorKilled" },
];
function getPeopleData(reload = false, page = 1) {
  axios
    .get("/people-action-details", {
      params: {
        people: props.id,
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