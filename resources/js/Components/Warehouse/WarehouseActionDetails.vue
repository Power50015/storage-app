<template>
  <div class="flex justify-between items-start">
    <h2 class="font-bold text-2xl"></h2>
    <div class="flex">
      <FormSelect v-model="action" :options="actionOptions" @change-select="getData(true)"></FormSelect>
    </div>
  </div>
  <div v-for="item in actions" :key="item.index">
    <div v-if="item.dataType == 'Stock'">
      <Link :href="route('warehouse-stock.show', item.id)" class="
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
        ">
      <div class="w-full">
        <div class="flex mt-3">
          <img :src="`/storage/${item.product.image}`" :alt="item.product.name"
            class="w-[35px] h-[35px] rounded-full" />
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
              {{ item.product.product_category.name }} -
            </template>
            <template v-if="item.product.product_type">
              -{{ item.product.product_type.name }} -
            </template>
            <template v-if="item.product.product_color">
              {{ item.product.product_color.name }} -
            </template>
            <template v-if="item.product.product_material">
              {{ item.product.product_material.name }} -
            </template>
            <template v-if="item.product.product_country">
              {{ item.product.product_country.name }}
            </template>
          </h3>
        </div>
      </div>
      <div class="w-full text-center">
        <BadgeInfo>منتج مخزون</BadgeInfo>
      </div>
      <div class="w-full">الكميه : {{ item.quantity }}</div>
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
          <img :src="item.user.profile_photo_url" :alt="item.user.name" class="w-[25px] h-[25px] rounded-full" />
          <h6 class="mx-2">{{ item.user.name }}</h6>
        </div>
      </div>
      </Link>
    </div>

    <div v-if="item.dataType == 'StockKit'">
      <Link :href="route('warehouse-stock.show', item.id)" class="
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
        ">
      <div class="w-full">
        <div class="flex mt-3">
          <img :src="`/storage/${item.kit.image}`" :alt="item.kit.title" class="w-[35px] h-[35px] rounded-full" />
          <h3 class="text-sm font-bold mx-3">
            {{ item.kit.title }}
            <template v-if="item.kit.product">
              <template> - {{ item.kit.product.name }} - </template>
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
                {{ item.kit.product.product_category.name }} -
              </template>
              <template v-if="item.kit.product.product_type">
                -{{ item.kit.product.product_type.name }} -
              </template>
              <template v-if="item.kit.product.product_color">
                {{ item.kit.product.product_color.name }} -
              </template>
              <template v-if="item.kit.product.product_material">
                {{ item.kit.product.product_material.name }} -
              </template>
              <template v-if="item.kit.product.product_country">
                {{ item.kit.product.product_country.name }}
              </template>
            </template>
          </h3>
        </div>
      </div>
      <div class="w-full text-center">
        <BadgeInfo>قطع غيار مخزون</BadgeInfo>
      </div>
      <div class="w-full">الكميه : {{ item.quantity }}</div>
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
          <img :src="item.user.profile_photo_url" :alt="item.user.name" class="w-[25px] h-[25px] rounded-full" />
          <h6 class="mx-2">{{ item.user.name }}</h6>
        </div>
      </div>
      </Link>
    </div>

    <div v-if="item.dataType == 'IncomingInvoice'">
      <Link :href="route('incoming-invoice.show', item.incoming_invoice.id)" class="
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
        ">
      <div class="w-full">
        <h2>رقم الفاتوره : {{ item.incoming_invoice.id }}</h2>
        <div class="flex mt-3">
          <img :src="`/storage/${item.product.image}`" :alt="item.product.name"
            class="w-[35px] h-[35px] rounded-full" />
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
          {{ item.incoming_invoice.total }}
        </div>
        <div v-if="item.incoming_invoice.pay_type">
          الدفع : {{ item.incoming_invoice.cash.title }}
        </div>
        <div v-else>الدفع :على الحساب</div>
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
          <img :src="item.user.profile_photo_url" :alt="item.user.name" class="w-[25px] h-[25px] rounded-full" />
          <h6 class="mx-2">{{ item.user.name }}</h6>
        </div>
      </div>
      </Link>
    </div>

    <div v-if="item.dataType == 'IncomingInvoiceKit'">
      <Link :href="route('incoming-invoice.show', item.incoming_invoice.id)" class="
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
          ">
      <div class="w-full">
        <h2>رقم الفاتوره : {{ item.incoming_invoice.id }}</h2>
        <div class="flex mt-3">
          <img :src="`/storage/${item.kit.image}`" :alt="item.kit.title" class="w-[35px] h-[35px] rounded-full" />
          <h3 class="text-sm font-bold mx-3">
            {{ item.kit.title }}
            <template v-if="item.kit.product">
              <template> - {{ item.kit.product.name }} - </template>
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
                {{ item.kit.product.product_category.name }} -
              </template>
              <template v-if="item.kit.product.product_type">
                -{{ item.kit.product.product_type.name }} -
              </template>
              <template v-if="item.kit.product.product_color">
                {{ item.kit.product.product_color.name }} -
              </template>
              <template v-if="item.kit.product.product_material">
                {{ item.kit.product.product_material.name }} -
              </template>
              <template v-if="item.kit.product.product_country">
                {{ item.kit.product.product_country.name }}
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
          {{ item.incoming_invoice.total }}
        </div>
        <div v-if="item.incoming_invoice.pay_type">
          الدفع : {{ item.incoming_invoice.cash.title }}
        </div>
        <div v-else>الدفع :على الحساب</div>
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
          <img :src="item.user.profile_photo_url" :alt="item.user.name" class="w-[25px] h-[25px] rounded-full" />
          <h6 class="mx-2">{{ item.user.name }}</h6>
        </div>
      </div>
      </Link>
    </div>

    <div v-if="item.dataType == 'ReturnedIncomingInvoice'">
      <Link :href="route('returned-incoming-invoice.show', item.returned_incoming_invoice_id)" class="
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
        ">
      <div class="w-full">
        <h2>رقم بيان المرتجع : {{ item.returned_incoming_invoice_id }}</h2>
        <div class="flex mt-3">
          <img :src="`/storage/${item.product.image}`" :alt="item.product.name"
            class="w-[35px] h-[35px] rounded-full" />
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
        <BadgeSuccess>منتج وارد مرتجع</BadgeSuccess>
      </div>

      <div class="w-full">
        <div class="flex">
          الكميه : {{ item.quantity }} * السعر :
          {{ item.price }}
        </div>
        <div>
          إجمالى المنتج :
          {{ item.quantity * item.price }}
        </div>
        <div>
          إجمالى الفاتوره :
          {{ item.returned_incoming_invoice.total }}
        </div>
        <div v-if="item.returned_incoming_invoice.pay_type">
          الدفع : {{ item.returned_incoming_invoice.cash.title }}
        </div>
        <div v-else>الدفع :على الحساب</div>
      </div>

      <div class="w-full">
        <h2>
          {{
            new Date(item.date).toLocaleDateString(
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
          <img :src="item.user.profile_photo_url" :alt="item.user.name" class="w-[25px] h-[25px] rounded-full" />
          <h6 class="mx-2">{{ item.user.name }}</h6>
        </div>
      </div>
      </Link>
    </div>

    <div v-if="item.dataType == 'ReturnedIncomingInvoiceKit'">
      <Link :href="route('returned-incoming-invoice.show', item.returned_incoming_invoice_id)" class="
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
        ">
      <div class="w-full">
        <h2>رقم بيان المرتجع : {{ item.returned_incoming_invoice_id }}</h2>
        <div class="flex mt-3">
          <img :src="`/storage/${item.kit.image}`" :alt="item.kit.title" class="w-[35px] h-[35px] rounded-full" />
          <h3 class="text-sm font-bold mx-3">
            {{ item.kit.title }}
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
        <BadgeSuccess>مرتجع قطع غيار وارده</BadgeSuccess>
      </div>
      <div class="w-full">
        <div class="flex">
          الكميه : {{ item.quantity }} * السعر : {{ item.price }}
        </div>
        <div>إجمالى المنتج : {{ item.quantity * item.price }}</div>
        <div>
          إجمالى الفاتوره :
          {{ item.returned_incoming_invoice.total }}
        </div>
        <div v-if="item.returned_incoming_invoice.pay_type">
          الدفع : {{ item.returned_incoming_invoice.cash.title }}
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
          <img :src="item.user.profile_photo_url" :alt="item.user.name" class="w-[25px] h-[25px] rounded-full" />
          <h6 class="mx-2">{{ item.user.name }}</h6>
        </div>
      </div>
      </Link>
    </div>

    <div v-if="item.dataType == 'OutgoingInvoice'">
      <Link :href="route('outgoing-invoice.show', item.id)" class="
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
        ">
      <div class="w-full">
        <h2>رقم الفاتوره : {{ item.id }}</h2>
        <div class="flex mt-3">
          <img :src="`/storage/${item.product.image}`" :alt="item.product.name"
            class="w-[35px] h-[35px] rounded-full" />
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
        <BadgePrimary>منتج صادره</BadgePrimary>
      </div>
      <div class="w-full">
        <div class="flex">
          الكميه : {{ item.quantity }} * السعر : {{ item.price }}
        </div>
        <div>إجمالى المنتج : {{ item.quantity * item.price }}</div>
        <div>
          إجمالى الفاتوره :
          {{ item.outgoing_invoice.total }}
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
          <img :src="item.user.profile_photo_url" :alt="item.user.name" class="w-[25px] h-[25px] rounded-full" />
          <h6 class="mx-2">{{ item.user.name }}</h6>
        </div>
      </div>
      </Link>
    </div>

    <div v-if="item.dataType == 'OutgoingInvoiceKit'">
      <Link :href="route('outgoing-invoice.show', item.id)" class="
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
        ">
      <div class="w-full">
        <h2>رقم الفاتوره : {{ item.id }}</h2>
        <div class="flex mt-3">
          <img :src="`/storage/${item.kit.image}`" :alt="item.kit.title" class="w-[35px] h-[35px] rounded-full" />
          <h3 class="text-sm font-bold mx-3">
            {{ item.kit.title }}
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
        <BadgePrimary>قطع غيار صادره</BadgePrimary>
      </div>
      <div class="w-full">
        <div class="flex">
          الكميه : {{ item.quantity }} * السعر : {{ item.price }}
        </div>
        <div>إجمالى المنتج : {{ item.quantity * item.price }}</div>
        <div>
          إجمالى الفاتوره :
          {{ item.outgoing_invoice.total }}
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
          <img :src="item.user.profile_photo_url" :alt="item.user.name" class="w-[25px] h-[25px] rounded-full" />
          <h6 class="mx-2">{{ item.user.name }}</h6>
        </div>
      </div>
      </Link>
    </div>

    <div v-if="item.dataType == 'ReturnedOutgoingInvoice'">
      <Link :href="route('returned-outgoing-invoice.show', item.returned_outgoing_invoice_id)" class="
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
        ">
      <div class="w-full">
        <h2>رقم بيان المرتجع : {{ item.returned_outgoing_invoice_id }}</h2>
        <div class="flex mt-3">
          <img :src="`/storage/${item.product.image}`" :alt="item.product.name"
            class="w-[35px] h-[35px] rounded-full" />
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
        <BadgePrimary>مرتجع منتج صادره</BadgePrimary>
      </div>

      <div class="w-full">
        <div class="flex">
          الكميه : {{ item.quantity }} * السعر :
          {{ item.price }}
        </div>
        <div>
          إجمالى المنتج :
          {{ item.quantity * item.price }}
        </div>
        <div>
          إجمالى الفاتوره :
          {{ item.returned_outgoing_invoice.total }}
        </div>
        <div v-if="item.returned_outgoing_invoice.pay_type">
          الدفع : {{ item.returned_outgoing_invoice.cash.title }}
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
          <img :src="item.user.profile_photo_url" :alt="item.user.name" class="w-[25px] h-[25px] rounded-full" />
          <h6 class="mx-2">{{ item.user.name }}</h6>
        </div>
      </div>
      </Link>
    </div>

    <div v-if="item.dataType == 'ReturnedOutgoingInvoiceKit'">
      <Link :href="route('returned-outgoing-invoice.show', item.returned_outgoing_invoice_id)" class="
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
        ">
      <div class="w-full">
        <h2>رقم بيان المرتجع : {{ item.returned_outgoing_invoice_id }}</h2>
        <div class="flex mt-3">
          <img :src="`/storage/${item.kit.image}`" :alt="item.kit.title" class="w-[35px] h-[35px] rounded-full" />
          <h3 class="text-sm font-bold mx-3">
            {{ item.kit.title }}
            <template v-if="item.kit.product">
              - {{ item.kit.product.name }} -
              <template v-if="item.kit.product.product_collection && item.kit.product">
                {{ item.kit.product.product_collection.name }} -
              </template>
              <template v-if="item.kit.product.product_model && item.kit.product">
                {{ item.kit.product.product_model.name }} -
              </template>
              <template v-if="item.kit.product.product_brand && item.kit.product">
                {{ item.kit.product.product_brand.name }} -
              </template>
              <template v-if="item.kit.product.product_category && item.kit.product">
                - {{ item.kit.product.product_category.name }}
              </template>
              <template v-if="item.kit.product.product_type && item.kit.product">
                - {{ item.kit.product.product_type.name }}
              </template>
              <template v-if="item.kit.product.product_color && item.kit.product">
                - {{ item.kit.product.product_color.name }}
              </template>
              <template v-if="item.kit.product.product_material && item.kit.product">
                - {{ item.kit.product.product_material.name }}
              </template>
              <template v-if="item.kit.product.product_country && item.kit.product">
                - {{ item.kit.product.product_country.name }}
              </template>
            </template>
          </h3>
        </div>
      </div>
      <div class="w-full flex justify-center">
        <BadgePrimary>مرتجع قطع غيار صادره</BadgePrimary>
      </div>

      <div class="w-full">
        <div class="flex">
          الكميه : {{ item.quantity }} * السعر :
          {{ item.price }}
        </div>
        <div>
          إجمالى المنتج :
          {{ item.quantity * item.price }}
        </div>
        <div>
          إجمالى الفاتوره :
          {{ item.returned_outgoing_invoice.total }}
        </div>
        <div v-if="item.returned_outgoing_invoice.pay_type">
          الدفع : {{ item.returned_outgoing_invoice.cash.title }}
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
          <img :src="item.user.profile_photo_url" :alt="item.user.name" class="w-[25px] h-[25px] rounded-full" />
          <h6 class="mx-2">{{ item.user.name }}</h6>
        </div>
      </div>
      </Link>
    </div>

    <div v-if="item.dataType == 'TransferFrom'">
      <Link :href="route('transfer.show', item.id)" class="
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
        ">
      <div class="w-full">
        <h2>{{ item.transfer.name }}</h2>
        <div class="flex mt-3">
          <img :src="`/storage/${item.product.image}`" :alt="item.product.name"
            class="w-[35px] h-[35px] rounded-full" />
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
      <div class="w-full text-center">
        <BadgeLight>منتج نقله صادره</BadgeLight>
      </div>
      <div class="w-full">
        <h2>الكميه : {{ item.quantity }}</h2>
        <h2>المخزن المستقبل : {{ item.warehouse_to.name }}</h2>
        <h6 class="mx-2" v-if="item.transfer.driver">
          السائق : {{ item.transfer.driver.name }}
        </h6>
      </div>
      <div class="w-full flex items-end flex-col">
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
          <img :src="item.user.profile_photo_url" :alt="item.user.name" class="w-[25px] h-[25px] rounded-full" />
          <h6 class="mx-2">{{ item.user.name }}</h6>
        </div>
      </div>
      </Link>
    </div>

    <div v-if="item.dataType == 'TransferFromKit'">
      <Link :href="route('transfer.show', item.id)" class="
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
        ">
      <div class="w-full">
        <h2>{{ item.transfer.name }}</h2>
        <div class="flex mt-3">
          <img :src="`/storage/${item.kit.image}`" :alt="item.kit.title" class="w-[35px] h-[35px] rounded-full" />
          <h3 class="text-sm font-bold mx-3">
            {{ item.kit.title }}
            <template v-if="item.kit.product">
              - {{ item.kit.product.name }} -
              <template v-if="item.kit.product.product_collection && item.kit.product">
                {{ item.kit.product.product_collection.name }} -
              </template>
              <template v-if="item.kit.product.product_model && item.kit.product">
                {{ item.kit.product.product_model.name }} -
              </template>
              <template v-if="item.kit.product.product_brand && item.kit.product">
                {{ item.kit.product.product_brand.name }} -
              </template>
              <template v-if="item.kit.product.product_category && item.kit.product">
                - {{ item.kit.product.product_category.name }}
              </template>
              <template v-if="item.kit.product.product_type && item.kit.product">
                - {{ item.kit.product.product_type.name }}
              </template>
              <template v-if="item.kit.product.product_color && item.kit.product">
                - {{ item.kit.product.product_color.name }}
              </template>
              <template v-if="item.kit.product.product_material && item.kit.product">
                - {{ item.kit.product.product_material.name }}
              </template>
              <template v-if="item.kit.product.product_country && item.kit.product">
                - {{ item.kit.product.product_country.name }}
              </template>
            </template>
          </h3>
        </div>
      </div>
      <div class="w-full text-center">
        <BadgeLight>قطعه غيار نقله صادره</BadgeLight>
      </div>
      <div class="w-full">
        <h2>الكميه : {{ item.quantity }}</h2>
        <h2>المخزن المستقبل : {{ item.warehouse_to.name }}</h2>
        <h6 class="mx-2" v-if="item.transfer.driver">
          السائق : {{ item.transfer.driver.name }}
        </h6>
      </div>
      <div class="w-full flex items-end flex-col">
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
          <img :src="item.user.profile_photo_url" :alt="item.user.name" class="w-[25px] h-[25px] rounded-full" />
          <h6 class="mx-2">{{ item.user.name }}</h6>
        </div>
      </div>
      </Link>
    </div>

    <div v-if="item.dataType == 'TransferTo'">
      <Link :href="route('transfer.show', item.id)" class="
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
        ">
      <div class="w-full">
        <h2>{{ item.transfer.name }}</h2>
        <div class="flex mt-3">
          <img :src="`/storage/${item.product.image}`" :alt="item.product.name"
            class="w-[35px] h-[35px] rounded-full" />
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
      <div class="w-full text-center">
        <BadgeLight>منتج نقله وارده</BadgeLight>
      </div>
      <div class="w-full">
        <h2>الكميه : {{ item.quantity }}</h2>
        <h2>المخزن المرسل : {{ item.warehouse_from.name }}</h2>
        <h6 class="mx-2" v-if="item.transfer.driver">
          السائق : {{ item.transfer.driver.name }}
        </h6>
      </div>
      <div class="w-full flex items-end flex-col">
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
          <img :src="item.user.profile_photo_url" :alt="item.user.name" class="w-[25px] h-[25px] rounded-full" />
          <h6 class="mx-2">{{ item.user.name }}</h6>
        </div>
      </div>
      </Link>
    </div>

    <div v-if="item.dataType == 'TransferToKit'">
      <Link :href="route('transfer.show', item.id)" class="
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
        ">
      <div class="w-full">
        <h2>{{ item.transfer.name }}</h2>
        <div class="flex mt-3">
          <img :src="`/storage/${item.kit.image}`" :alt="item.kit.title" class="w-[35px] h-[35px] rounded-full" />
          <h3 class="text-sm font-bold mx-3">
            {{ item.kit.title }}
            <template v-if="item.kit.product">
              - {{ item.kit.product.name }} -
              <template v-if="item.kit.product.product_collection && item.kit.product">
                {{ item.kit.product.product_collection.name }} -
              </template>
              <template v-if="item.kit.product.product_model && item.kit.product">
                {{ item.kit.product.product_model.name }} -
              </template>
              <template v-if="item.kit.product.product_brand && item.kit.product">
                {{ item.kit.product.product_brand.name }} -
              </template>
              <template v-if="item.kit.product.product_category && item.kit.product">
                - {{ item.kit.product.product_category.name }}
              </template>
              <template v-if="item.kit.product.product_type && item.kit.product">
                - {{ item.kit.product.product_type.name }}
              </template>
              <template v-if="item.kit.product.product_color && item.kit.product">
                - {{ item.kit.product.product_color.name }}
              </template>
              <template v-if="item.kit.product.product_material && item.kit.product">
                - {{ item.kit.product.product_material.name }}
              </template>
              <template v-if="item.kit.product.product_country && item.kit.product">
                - {{ item.kit.product.product_country.name }}
              </template>
            </template>
          </h3>
        </div>
      </div>
      <div class="w-full text-center">
        <BadgeLight>قطعه غيار نقله وارده</BadgeLight>
      </div>
      <div class="w-full">
        <h2>الكميه : {{ item.quantity }}</h2>
        <h2>المخزن المرسل : {{ item.warehouse_from.name }}</h2>
        <h6 class="mx-2" v-if="item.transfer.driver">
          السائق : {{ item.transfer.driver.name }}
        </h6>
      </div>
      <div class="w-full flex items-end flex-col">
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
          <img :src="item.user.profile_photo_url" :alt="item.user.name" class="w-[25px] h-[25px] rounded-full" />
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
import ProductOperation from "../Product/ProductOperation.vue";
import KitOperation from "../Kit/KitOperation.vue";

const props = defineProps(["id"]);

onMounted(() => window.addEventListener("scroll", handleScroll));

const rowData = reactive([]);
const actions = reactive([]);
const inputText = ref();
const action = ref();

const actionOptions = [
  { label: "مخزون", index: "Stock" },
  { label: "فواتير وارده", index: "IncomingInvoice" },
  { label: "مرتجع فواتير وارده", index: "ReturnedIncomingInvoice" },
  { label: "فواتير صادره", index: "OutgoingInvoice" },
  { label: "مرتجع فواتير صادره", index: "ReturnedOutgoingInvoice" },
  { label: "نقله صادره", index: "TransferFrom" },
  { label: "نقله وارده", index: "TransferTo" },
  { label: " منتج هالك", index: "DestructibleGoods" },
  { label: "قطعه غيار عمليات", index: "KitOperation" },
];
function getData(reload = false, page = 1) {
  if (reload) actions.length = 0;
  axios
    .get("/warehouse-action-details", {
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