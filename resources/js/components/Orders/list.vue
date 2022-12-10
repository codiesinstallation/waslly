<template>
    <div>
        <div class="row">
            <Printer :order="order" :qr="qr" :branch="order.branch" />

            <!-- Datatables -->
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div
                        class="card-header d-flex flex-row align-items-center justify-content-around"
                    >
                        <h5 class="m-0 font-weight-bold text-primary">
                            {{ __("Shipments") }}
                        </h5>
                        <div>
                            <input
                                class="form-control"
                                list="datalistOptions"
                                id="exampleDataList"
                                :placeholder="__('Search')"
                                @change="select"
                                v-model="searchorder"
                            />
                            <datalist id="datalistOptions">
                                <option
                                    v-for="(item, index) in orders"
                                    :key="index"
                                    :value="item.id"
                                >
                                    {{ item.sender }}
                                </option>
                            </datalist>
                        </div>
                    </div>
                    <table v-if="orders" class="text-center table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">{{ __("Edit") }}</th>
                                <th scope="col">{{ __("Cancel") }}</th>

                                <th scope="col">{{ __("Code") }}</th>
                                <th scope="col">{{ __("Sender Name") }}</th>
                                <th scope="col" class="d-none">
                                    {{ __("Sender Email") }}
                                </th>
                                <th scope="col">{{ __("Consignee Name") }}</th>
                                <th scope="col" class="d-none">
                                    {{ __("Consignee Email") }}
                                </th>
                                <th scope="col">{{ __("Adress") }}</th>
                                <th scope="col" class="d-none">
                                    {{ __("Order Details") }}
                                </th>

                                <th scope="col">{{ __("Shipping Date") }}</th>
                                <th scope="col">{{ __("Pay Method") }}</th>
                                <th scope="col">{{ __("User") }}</th>
                                <th scope="col">{{ __("Status") }}</th>
                                <th scope="col" class="d-none">
                                    {{ __("Sum") }}
                                </th>
                                <th scope="col" class="d-none">
                                    {{ __("Discount") }}
                                </th>
                                <th scope="col" class="d-none">
                                    {{ __("Extra") }}
                                </th>
                                <th scope="col" class="d-none">
                                    {{ __("Sub Total") }}
                                </th>
                                <th scope="col" class="d-none">
                                    {{ __("Total") }}
                                </th>
                                <th scope="col">{{ __("View") }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in orders" :key="index">
                                <td class="text-center">
                                    <Edit
                                        :user="user"
                                        :form="item"
                                    ></Edit>
                                </td>

                                <td :data-label="item.id">
                                    <button
                                        :disabled="item.canceld === true"
                                        :class="
                                            item.canceld
                                                ? 'btn btn btn-info   '
                                                : 'btn btn btn-danger'
                                        "
                                        @click="cancel(item.id)"
                                    >
                                        <i
                                            :class="
                                                item.canceld
                                                    ? 'fa fa-check'
                                                    : 'fa fa-times'
                                            "
                                        ></i>
                                    </button>
                                </td>
                                <td scope="row" :data-label="item.id">
                                    {{ item.id }}
                                </td>
                                <td :data-label="item.sender">
                                    {{ item.sender }}
                                </td>
                                <td
                                    :data-label="item.sender_email"
                                    class="d-none"
                                >
                                    {{ item.sender_email }}
                                </td>
                                <td :data-label="item.consignee">
                                    {{ item.consignee }}
                                </td>
                                <td
                                    :data-label="item.consignee_email"
                                    class="d-none"
                                >
                                    {{ item.consignee_email }}
                                </td>
                                <td >
                                 <span v-if="item.region">{{
                                        item.region.name_ar + ", "
                                    }}</span>
                                        <span v-if="item.city">{{
                                                item.city.name_ar + ", "
                                            }}</span>
                                     <span v-if="item.district">{{
                                        item.district + ", "
                                    }}</span>

                                    <span v-if="item.street_name">{{
                                        item.street_name + ", "
                                    }}</span>
                                    <span v-if="item.building">{{
                                        item.building + ", "
                                    }}</span>
                                    <span v-if="item.building_no">{{
                                        item.building_no + ", "
                                    }}</span>
                                </td>

                                <td
                                    :data-label="item.description"
                                    class="d-none"
                                >
                                    <p
                                        v-if="item.description"
                                        class="lead"
                                        :title="item.description"
                                    >
                                        {{
                                            item.description
                                                .split(/\s+/)
                                                .slice(0, 3)
                                                .join(" ") + "....."
                                        }}
                                    </p>
                                </td>

                                <td :data-label="item.shipping_date">
                                    {{ item.shipping_date }}
                                </td>
                                <td :data-label="item.pay">{{ item.pay }}</td>
                                <td :data-label="item.user.name">
                                    {{ item.user.name }}
                                </td>
                                <td :data-label="item.status">
                                    <select
                                        :class="
                                            item.status === 1
                                                ? 'font-weight-bold form-select form-control text-info'
                                                : item.status == 2
                                                ? 'font-weight-bold form-select form-control text-warning'
                                                : item.status == 3
                                                ? 'font-weight-bold form-select form-control text-success'
                                                : 'font-weight-bold form-select form-control text-danger'
                                        "
                                        aria-label=".form-select"
                                        v-model="item.status"
                                        @change="onChnage(item)"
                                    >
                                        <option value="0">في المخزن</option>
                                        <option value="1">جاهزة للشحن</option>
                                        <option value="2">في الطريق</option>
                                        <option value="3">تم التسليم</option>
                                    </select>
                                </td>

                                <td :data-label="item.sum" class="d-none">
                                    {{ item.sum }}
                                </td>
                                <td :data-label="item.discount" class="d-none">
                                    {{ item.discount }}
                                </td>
                                <td :data-label="item.extra" class="d-none">
                                    {{ item.extra }}
                                </td>
                                <td :data-label="item.sub_total" class="d-none">
                                    {{ item.sub_total }}
                                </td>
                                <td :data-label="item.total" class="d-none">
                                    {{ item.total }}
                                </td>
                                <td>
                                    <button
                                        class="btn btn-success"
                                        type="button"
                                        @click="print(item)"
                                    >
                                        <i class="fa fa-search"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div v-show="orders.length > 0" class="row text-center">
                        <ul class="pagination justify-content-center">
                            <li
                                :class="
                                    page === 1
                                        ? 'page-item disabled'
                                        : 'page-item'
                                "
                            >
                                <a
                                    class="page-link"
                                    href="#"
                                    @click="nextPage(1)"
                                    >البداية</a
                                >
                            </li>
                            <li
                                :class="
                                    page === 1
                                        ? 'page-item disabled'
                                        : 'page-item'
                                "
                            >
                                <a
                                    class="page-link"
                                    href="#"
                                    @click="nextPage(current_page - 1)"
                                    ><i class="fa fa-arrow-right"></i
                                ></a>
                            </li>
                            <li
                                class="page-item d-none"
                                v-for="(i, index) in total"
                                :key="index"
                                @click="nextPage(i)"
                            >
                                <a class="page-link" href="#">{{ i }}</a>
                            </li>
                            <li
                                :class="
                                    page === last_page
                                        ? 'page-item disabled'
                                        : 'page-item'
                                "
                            >
                                <a
                                    class="page-link"
                                    href="#"
                                    @click="nextPage(current_page + 1)"
                                    ><i class="fa fa-arrow-left"></i
                                ></a>
                            </li>
                            <li
                                :class="
                                    page === last_page
                                        ? 'page-item disabled'
                                        : 'page-item'
                                "
                            >
                                <a
                                    class="page-link"
                                    href="#"
                                    @click="nextPage(total + 1)"
                                    >الاخير</a
                                >
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- DataTable with Hover -->
        </div>
    </div>
</template>

<script>
import Edit from "./edit.vue";
import Printer from "./printer.vue";
import Tafgeet from "tafgeetjs";
import { Invoice } from "@axenda/zatca";
import Paginate from "../util/paginate.vue";

export default {
    components: { Edit, Printer, Paginate },
    props: ["user"],
    created() {
        this.allOrders();
    },
    data() {
        return {
            order: {},
            qr: {},
            total: 1,
            page: 1,
            current_page: "",
            last_page: "",
            orders: [],
            searchorder: "",
        };
    },

    methods: {
        select() {
            if (this.searchorder != "") {
                axios
                    .get("/api/orders/" + this.searchorder)
                    .then(({ data }) => {
                        if (
                            data && // 👈 null and undefined check
                            Object.keys(data).length === 0 &&
                            Object.getPrototypeOf(data) === Object.prototype
                        ) {
                            Notification.searchError();

                            this.allOrders();
                        } else {
                            this.orders = [];
                            this.orders.push(data);
                        }
                    })
                    .catch((error) => console.log(error));
            } else {
                Notification.searchError();

                this.allOrders();
            }
        },
        async print(data) {
            this.order = data;
            if (this.order.total > 0) {
                this.order.totalInChar = new Tafgeet(
                    parseFloat(this.order.total),
                    "SAR"
                ).parse();
            }
            if (this.order != null) {
                const invoice = new Invoice({
                    sellerName: this.order.branch.name_ar,
                    vatRegistrationNumber: this.order.branch.vat_num,
                    invoiceTimestamp: this.order.order_date,
                    invoiceTotal: this.order.total,
                    invoiceVatTotal: this.order.vat,
                });
                this.qr = await invoice.render();
                $("#btn").click();
            }
        },
        allOrders() {
            axios
                .get("/api/orders?page=" + this.page)
                .then(({ data }) => {
                    if (data.data.length >= 0) {
                        this.total = parseInt(data.total / data.per_page);
                        this.orders = data.data;
                        this.current_page = data.current_page;
                        this.last_page = data.last_page;
                    }
                })
                .catch((error) => console.log(error));
        },
        onChnage(order) {
            axios
                .patch("/api/orders/" + order.uuid, order)
                .then(async ({ data }) => {
                    await Notification.staus();
                })

                .catch((error) => console.log(error));
        },

        nextPage(i) {
            this.page = i;
            this.allOrders();
        },
        cancel(id) {
            Swal.fire({
                title: "هل تريد إلغاء الشحنة؟",
                text: "لايمكن الاسترجاع عن هذا!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "تأكيد إلغاء الشحنة!",
                cancelButtonText: "إلغاء",
            }).then((res) => {
                if (res.value) {
                    axios
                        .delete("/api/orders/" + id)
                        .then(() => {
                            Swal.fire("إلغاء!", "تم الإلغاء.", "success");
                        })
                        .catch((err) => console.log(err));
                }
            });
        },
    },
};
</script>
<style lang="scss">
table {
    border-collapse: collapse;
    margin: 0 auto;
    width: 100%;
    margin-top: 40px;

    tr {
        background: #f2f2f2;
    }

    th {
        font-size: 15px;
        background-color: #03d361;
        color: #1a181f;
        text-transform: uppercase;
    }
}

table th,
table td {
    padding: 15px;
    text-align: center;
}

@media screen and (max-width: 600px) {
    table {
        border: 0;

        thead {
            display: none;
        }

        tr {
            display: block;
            margin-bottom: 10px;
        }

        td {
            border-bottom: 1px solid #ddd;
            display: block;
            font-size: 14px;
            text-align: right;

            &::before {
                content: attr(data-label);
                float: left;
                font-weight: 900;
                text-transform: uppercase;
            }

            &::last-child {
                border-bottom: 0;
            }
        }
    }
}
</style>
