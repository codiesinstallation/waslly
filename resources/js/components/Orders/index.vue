<template>
    <div class="container-fluid">
        <Printer :order="order" :qr="qr" :branch="branch" />

        <div class="card mb-3">
            <form class="needs-validation" @submit.prevent="create">
                <div class="card-header mb-3 justify-content-between d-flex">
                    <p>{{ __("New Shipment") }}</p>
                    <button
                        :disabled="inSave"
                        class="btn btn-success"
                        type="submit"
                    >
                        {{ __("Save") }}
                    </button>
                </div>

                <div class="card-bod">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header mb-4">
                                    <h5 class="text-center">
                                        {{ __("Insert Sender Deatils") }}
                                    </h5>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-floating col-md-6">
                                            <input
                                                type="text"
                                                v-model="form.sender"
                                                class="form-control mb-5"
                                                id="sender"
                                            />
                                            <label for="sender">{{
                                                __("Sender Name")
                                            }}</label>
                                        </div>
                                        <div class="form-floating col-md-6">
                                            <input
                                                type="email"
                                                class="form-control mb-5"
                                                id="sender_email"
                                                v-model="form.sender_email"
                                            /><label for="sender_email">
                                                {{ __("Email") }}
                                            </label>
                                        </div>
                                        <div class="form-floating col-md-6">
                                            <input
                                                type="text"
                                                v-model="form.sender_mobile"
                                                class="form-control mb-5"
                                                id="sender_mobile"
                                            /><label for="sender_mobile">{{
                                                __("Mobile")
                                            }}</label>
                                        </div>
                                        <div class="form-floating col-md-6">
                                            <input
                                                type="text"
                                                v-model="form.sender_identify"
                                                class="form-control mb-5"
                                                id="sender_identify"
                                            /><label for="sender_identify">{{
                                                __("Identify")
                                            }}</label>
                                        </div>
                                        <div class="form-floating col-md-12">
                                            <input
                                                type="text"
                                                v-model="form.sender_note"
                                                class="form-control mb-5"
                                                id="sender_note"
                                            /><label for="sender_note">{{
                                                __("Notes")
                                            }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header mb-4 text-center">
                                    <h5 class="text-center float-start">
                                        {{ __("Insert Consignee Deatils") }}
                                    </h5>
                                    <div class="form-check py-0 float-end my-0">
                                        <input
                                            class="form-check-input py-0"
                                            type="checkbox"
                                            value=""
                                            id="is_same"
                                            v-model="form.is_same"
                                            @change="pathData()"
                                        />
                                        <label
                                            class="form-check-label py-0 pointer"
                                            for="is_same"
                                        >
                                            {{ __("Same Sender Data") }}
                                        </label>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-floating col-md-6">
                                            <input
                                                type="text"
                                                v-model="form.consignee"
                                                class="form-control mb-5"
                                                id="consignee"
                                            />
                                            <label for="consignee">{{
                                                __("Consignee Name")
                                            }}</label>
                                        </div>
                                        <div class="form-floating col-md-6">
                                            <input
                                                type="email"
                                                class="form-control mb-5"
                                                id="consignee_email"
                                                v-model="form.consignee_email"
                                            />
                                            <label for="consignee_email">
                                                {{ __("Email") }}</label
                                            >
                                        </div>
                                        <div class="form-floating col-md-6">
                                            <input
                                                type="text"
                                                v-model="form.consignee_mobile"
                                                class="form-control mb-5"
                                                id="consignee_mobile"
                                            /><label for="consignee_mobile">{{
                                                __("Mobile")
                                            }}</label>
                                        </div>
                                        <div class="form-floating col-md-6">
                                            <input
                                                type="text"
                                                v-model="
                                                    form.consignee_identify
                                                "
                                                class="form-control mb-5"
                                                id="consignee_identify"
                                            /><label for="consignee_identify">{{
                                                __("Identify")
                                            }}</label>
                                        </div>
                                        <div class="form-floating col-md-12">
                                            <input
                                                type="text"
                                                v-model="form.consignee_note"
                                                class="form-control mb-5"
                                                id="consignee_note"
                                            /><label for="consignee_note">{{
                                                __("Notes")
                                            }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div class="card-header mb-4">
                                    <h5 class="text-center">
                                        {{
                                            __("Insert Order Deatils And Info")
                                        }}
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-floating col-md-12">
                                            <textarea
                                                class="form-control mb-5"
                                                id="description"
                                                style="height: 100px"
                                                v-model="form.description"
                                            ></textarea>
                                            <label for="description">{{
                                                __("Order Details")
                                            }}</label>
                                        </div>
                                        <div class="form-floating col-md-2">
                                            <select
                                                class="form-select"
                                                aria-label=".form-select-sm example"
                                                v-model="form.region"
                                            >
                                                <option
                                                    v-for="(
                                                        region, index
                                                    ) in regions"
                                                    :key="index"
                                                    :value="region"
                                                >
                                                    {{ region.name_ar }}
                                                </option>
                                            </select>
                                            <label for="region">{{
                                                __("Region")
                                            }}</label>
                                        </div>
                                        <div class="form-floating col-md-2">
                                            <select
                                                class="form-select"
                                                aria-label=".form-select-sm example"
                                                v-model="form.city"
                                            >
                                                <option
                                                    v-for="(city, index) in form
                                                        .region.cities"
                                                    :key="index"
                                                    :value="city"
                                                >
                                                    {{ city.name_ar }}
                                                </option>
                                            </select>
                                            <label for="city">
                                                {{ __("City") }}</label
                                            >
                                        </div>
                                        <div class="form-floating col-md-2">
                                            <input
                                                class="form-control"
                                                list="districts"
                                                id="exampleDataList"
                                                v-model="form.district"
                                            />
                                            <datalist id="districts">
                                                <option
                                                    v-for="(
                                                        district, index
                                                    ) in form.city.districts"
                                                    :key="index"
                                                >
                                                    {{ district.name_ar }}
                                                </option>
                                            </datalist>

                                            <label for="district">
                                                {{ __("District") }}</label
                                            >
                                        </div>


                                        <div class="form-floating col-md-2">
                                            <input
                                                type="text"
                                                v-model="form.street_name"
                                                class="form-control mb-5"
                                                id="street_name"
                                            /><label for="street_name">
                                                {{ __("Street Name") }}</label
                                            >
                                        </div>
                                        <div class="form-floating col-md-2">
                                            <input
                                                type="text"
                                                v-model="form.building"
                                                class="form-control mb-5"
                                                id="building"
                                            />
                                            <label for="building">{{
                                                __("Building")
                                            }}</label>
                                        </div>
                                        <div class="form-floating col-md-2">
                                            <input
                                                type="text"
                                                v-model="form.building_no"
                                                class="form-control mb-5"
                                                id="building_no"
                                            />
                                            <label for="building_no">{{
                                                __("Building No")
                                            }}</label>
                                        </div>
                                        <div class="form-floating col-md-6">
                                            <input
                                                type="date"
                                                class="form-control mb-5"
                                                id="expexted_date_from"
                                                v-model="
                                                    form.expexted_date_from
                                                "
                                            />
                                            <label for="expexted_date_from"
                                                >{{
                                                    __("Expected Date (From)")
                                                }}
                                            </label>
                                        </div>
                                        <div class="form-floating col-md-6">
                                            <input
                                                type="date"
                                                class="form-control mb-5"
                                                id="expexted_date_to"
                                                v-model="form.expexted_date_to"
                                            />
                                            <label for="expexted_date_to"
                                                >{{ __("Expected Date (To)") }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div class="card-header mb-4">
                                    <h5 class="text-center">
                                        {{ __("Calculation And Vat") }}
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-floating col-md-2">
                                            <input
                                                type="number"
                                                v-model="form.sum"
                                                class="form-control mb-5"
                                                id="sum"
                                                @keyup="calc()"
                                                onclick="this.select()"
                                            />
                                            <label for="sum">{{
                                                __("Cost")
                                            }}</label>
                                        </div>
                                        <div class="form-floating col-md-2">
                                            <input
                                                type="number"
                                                v-model="form.discount"
                                                class="form-control mb-5"
                                                id="discount"
                                                @keyup="calc()"
                                                onclick="this.select()"
                                            /><label for="discount">{{
                                                __("Discount")
                                            }}</label>
                                        </div>
                                        <div class="form-floating col-md-2">
                                            <input
                                                type="number"
                                                v-model="form.extra"
                                                class="form-control mb-5"
                                                id="extra"
                                                @keyup="calc()"
                                                onclick="this.select()"
                                            />
                                            <label for="extra">{{
                                                __("Extra")
                                            }}</label>
                                        </div>
                                        <div class="form-floating col-md-2">
                                            <input
                                                readonly
                                                type="number"
                                                v-model="form.vat"
                                                class="form-control mb-5"
                                                id="vat"
                                                onclick="this.select()"
                                            /><label for="vat">{{
                                                __("Vat")
                                            }}</label>
                                        </div>
                                        <div class="form-floating col-md-2">
                                            <input
                                                readonly
                                                type="number"
                                                v-model="form.total"
                                                class="form-control mb-5"
                                                id="total"
                                                onclick="this.select()"
                                            />
                                            <label for="total">
                                                {{ __("Total") }}</label
                                            >
                                        </div>
                                        <div class="form-floating col-md-2">
                                            <select
                                                class="form-select"
                                                aria-label=".form-select-sm example"
                                                v-model="form.pay"
                                                id="pay"
                                            >
                                                <option selected value="Cash">
                                                    {{ __("lang.Cash") }}
                                                </option>
                                                <option value="Card">
                                                    {{ __("lang.Card") }}
                                                </option>
                                            </select>
                                            <label for="pay">
                                                {{ __("Pay Method") }}</label
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import Printer from "./printer.vue";
import Tafgeet from "tafgeetjs";

import { Invoice } from "@axenda/zatca";
import moment from "moment";

export default {
    components: { Printer },

    props: ["user", "branch"],
    created() {
        this.allRegions();
    },
    data() {
        return {
            disable: true,
            inSave: false,
            cites: [],
            regions: [],
            form: {
                pay: "Cash",
                sub_total: 0.0,
                sum: 0.0,
                discount: 0.0,
                total: 0.0,
                extra: 0,
                total: 0,
                sender: "",
                consignee: "",
                sender_mobile: "",
                on_way_date: "",
                consignee_mobile: "",
                sender_email: "",
                consignee_email: "",
                sender_identify: "",
                consignee_identify: "",
                sender_note: "",
                consignee_note: "",
                expexted_date_from: "",
                expexted_date_to: "",
                canceld: "",
                region: "",
                street_name: "",
                district: "",
                city: "",
                building: "",
                building_no: "",
                status: "",
                description: "",
                notes: "",

                village: "",
                receive_date: "",
                shipping_date: "",
                is_same: false,
            },
            errors: {},
            order: {},
            qr: {},
        };
    },
    methods: {

        allRegions() {
            axios
                .get("/api/regions")
                .then(({ data }) => {
                    if (data.length >= 0) {
                        this.regions = data;
                        console.log;
                    }
                })
                .catch((error) => console.log(error));
        },
        pathData() {
            if (this.form.is_same) {
                this.form.consignee = this.form.sender;
                this.form.consignee_mobile = this.form.sender_mobile;
                this.form.consignee_email = this.form.sender_email;
                this.form.consignee_identify = this.form.sender_identify;
                this.form.consignee_note = this.form.sender_note;
            } else {
                this.form.consignee = "";
                this.form.consignee_mobile = "";
                this.form.consignee_email = "";
                this.form.consignee_identify = "";
                this.form.consignee_note = "";
            }
        },
        async print(id) {
            this.order = {};
            await axios
                .get("/api/orders/" + id)
                .then(async ({ data }) => {
                    this.order = data;
                    if (this.order.total > 0) {
                        this.order.totalInChar = new Tafgeet(
                            parseFloat(this.order.total),
                            "SAR"
                        ).parse();
                    }
                    if (this.order != null) {
                        const invoice = new Invoice({
                            sellerName: this.branch.name_ar,
                            vatRegistrationNumber: this.branch.vat_num,
                            invoiceTimestamp: this.order.order_date,
                            invoiceTotal: this.order.total,
                            invoiceVatTotal: this.order.vat,
                        });
                        this.qr = await invoice.render();
                        console.log(this.qr);
                    }
                })
                .then(() => {
                    $("#btn").click();
                })

                .catch((err) => console.log(err));
        },
        calc() {
            let vat = parseFloat(this.branch.vat);
            this.form.sub_total =
                parseFloat(this.form.sum) +
                parseFloat(this.form.extra) -
                parseFloat(this.form.discount);
            this.form.vat = parseFloat(this.form.sub_total) * (vat / 100.0);
            this.form.total =
                parseFloat(this.form.vat) + parseFloat(this.form.sub_total);
        },
        create() {
            this.inSave = true;
            this.form.user_id = this.user.id;
            this.form.branch_id = this.user.branch_id;
            axios
                .post("/api/orders", this.form)
                .then(async ({ data }) => {
                    this.print(data);
                    Notification.success();
                    this.clearForm();
                    this.inSave = false;
                })
                .catch((error) => console.log(error));
        },
        clearForm() {
            this.form.pay = "Cash";
            this.form.sub_total = 0.0;
            this.form.sum = 0.0;
            this.form.discount = 0.0;
            this.form.total = 0.0;
            this.form.extra = 0;
            this.form.total = 0;
            this.form.sender = "";
            this.form.consignee = "";
            this.form.consignee_mobile = "";
            this.form.consignee_email = "";
            this.form.sender_mobile = "";
            this.form.sender_identify = "";
            this.form.sender_email = "";
            this.form.consignee_identify = "";
            this.form.sender_note = "";
            this.form.consignee_note = "";
            this.form.on_way_date = "";
            this.form.expexted_date_from = "";
            this.form.expexted_date_to = "";
            this.form.region = "";
            this.form.street_name = "";
            this.form.district = "";
            this.form.city = "";
            this.form.building = "";
            this.form.building_no = "";
            this.form.status = "";
            this.form.description = "";
            this.form.notes = "";
            this.form.village = "";
            this.form.receive_date = "";
            this.form.shipping_date = "";
            this.disable = false;
        },
    },
};
</script>
<style>
.pointer {
    cursor: pointer;
}
label {
    font-weight: bolder;
    font-size: 18px;
}
.form-floating>label{
    top: -30px;
}
</style>
