<template>
    <div v-if="order && order.branch">
        <button
            id="btn"
            class="btn btn-info text-light d-none"
            data-bs-target="#printModal"
            data-bs-toggle="modal"
        >
            <i class="fas fa-ellipsis-v"></i>
        </button>
        <div
            id="printModal"
            aria-hidden="true"
            aria-labelledby="printModal"
            class="modal"
            role="dialog"
            tabindex="-1"
        >
            <div
                class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                role="document"
            >
                <div class="modal-content m-auto A4">
                    <div class="modal-header">
                        <button
                            aria-label="Close"
                            class="close"
                            data-bs-dismiss="modal"
                            type="button"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div
                        id="printMe"
                        class="modal-body sheet padding-10mm"
                    >
                        <!--End InvoiceTop-->
                        <div id="bot">
                            <div id="table">
                                <div class="row text-center mb-1">
                                    <div class="col-4">
                                        <strong class="d-block">
                                            {{ order.branch.name_ar }}
                                        </strong>
                                        <strong class="d-block">
                                            {{ order.branch.location_ar }}
                                        </strong>
                                        <strong class="d-block">
                                            {{ order.branch.vat_num }}
                                        </strong>
                                        <strong class="d-block">
                                            {{ order.branch.mobile }}
                                        </strong>
                                    </div>
                                    <div class="col-4">
                                        <img
                                            :src="order.branch.logo"
                                            width="100%"
                                            height="80px"
                                        />
                                        <strong class="text-center d-block">
                                            <strong v-if="order.branch.vat > 0">
                                                ???????????? ????????????
                                            </strong>
                                        </strong>
                                    </div>
                                    <div class="col-4">
                                        <strong class="d-block">
                                            {{ order.branch.name_en }}
                                        </strong>
                                        <strong class="d-block">
                                            {{ order.branch.location_en }}
                                        </strong>
                                        <strong class="d-block">
                                            {{ order.branch.vat_num }}
                                        </strong>
                                        <strong class="d-block">
                                            {{ order.branch.mobile }}
                                        </strong>
                                    </div>
                                </div>

                                <table
                                    id="resultTable"
                                    class="text-center w-100 table-bordered table"
                                >
                                    <tr>
                                        <th colspan="3">?????? ??????????</th>
                                        <td colspan="3">
                                            {{ order.id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="3">?????? ????????????</th>
                                        <td colspan="3">
                                            {{ order.uuid }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="3">?????????? ???? ??????????</th>
                                        <td colspan="3">
                                            <span>{{
                                                moment(order.order_date)
                                                    .locale("ar")
                                                    .format("dddd") +
                                                " " +
                                                moment(order.order_date)
                                                    .locale("ar")
                                                    .format("DD MMMM?? YYYY")
                                            }}</span>
                                        </td>
                                    </tr>
                                    <tr
                                        v-if="
                                            order.expexted_date_from &&
                                            order.expexted_date_to
                                        "
                                    >
                                        <th colspan="3">
                                            ?????????? ?????????????? ??????????????
                                        </th>
                                        <td colspan="3">
                                            <span>{{
                                                moment(order.expexted_date_from)
                                                    .locale("ar")
                                                    .format("dddd") +
                                                " " +
                                                moment(order.expexted_date_from)
                                                    .locale("ar")
                                                    .format("DD MMMM?? YYYY")
                                            }}</span>
                                            <b> - </b>
                                            <span>
                                                {{
                                                    moment(
                                                        order.expexted_date_to
                                                    )
                                                        .locale("ar")
                                                        .format("dddd") +
                                                    " " +
                                                    moment(
                                                        order.expexted_date_to
                                                    )
                                                        .locale("ar")
                                                        .format("DD MMMM?? YYYY")
                                                }}</span
                                            >
                                        </td>
                                    </tr>

                                    <tr v-if="order.status == 1">
                                        <th colspan="3">???? ?????????? ????????????</th>
                                        <td colspan="3">
                                            <span>{{
                                                moment(order.shipping_date)
                                                    .locale("ar")
                                                    .format("dddd") +
                                                " " +
                                                moment(order.shipping_date)
                                                    .locale("ar")
                                                    .format("DD MMMM?? YYYY")
                                            }}</span>
                                        </td>
                                    </tr>
                                    <tr v-if="order.status == 2">
                                        <th colspan="3">
                                            ?????????? ???? ???????????? ???????? ????????????
                                        </th>
                                        <td colspan="3">
                                            <span>{{
                                                moment(order.on_way_date)
                                                    .locale("ar")
                                                    .format("dddd") +
                                                " " +
                                                moment(order.on_way_date)
                                                    .locale("ar")
                                                    .format("DD MMMM?? YYYY")
                                            }}</span>
                                        </td>
                                    </tr>
                                    <tr v-if="order.status == 3">
                                        <th colspan="3">
                                            ???? ???????????? ???????????? ????????????
                                        </th>
                                        <td colspan="3">
                                            <span>{{
                                                moment(order.receive_date)
                                                    .locale("ar")
                                                    .format("dddd") +
                                                " " +
                                                moment(order.receive_date)
                                                    .locale("ar")
                                                    .format("DD MMMM?? YYYY")
                                            }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="3">?????????? ??????</th>
                                        <td colspan="3">
                                            <span v-if="order.region.name_ar">{{
                                                order.region.name_ar + ", "
                                            }}</span>
                                             <span v-if="order.city.name_ar">{{
                                                order.city.name_ar + ", "
                                            }}</span>
                                            <span v-if="order.district">{{
                                                order.district + ", "
                                            }}</span>

                                            <span v-if="order.street_name">{{
                                                order.street_name + ", "
                                            }}</span>
                                            <span v-if="order.building">{{
                                                order.building + ", "
                                            }}</span>
                                            <span v-if="order.building_no">{{
                                                order.building_no + ", "
                                            }}</span>
                                        </td>
                                    </tr>

                                    <tr class="d-none">
                                        <td colspan="3">???????????? ????????????</td>
                                        <td colspan="3">
                                            {{ order.user.name }}
                                        </td>
                                    </tr>
                                </table>

                                <table
                                    class="text-center w-100 table-bordered table"
                                >
                                    <tbody>
                                        <tr>
                                            <th style="width: 20%">
                                                ?????? ????????????
                                            </th>
                                            <td style="width: 30%">
                                                {{ order.sender }}
                                            </td>

                                            <th style="width: 20%">
                                                ?????? ???????????? ????????
                                            </th>
                                            <td style="width: 30%">
                                                {{ order.consignee }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>???????? ????????????</th>
                                            <td>
                                                {{ order.sender_mobile }}
                                            </td>

                                            <th>???????? ???????????? ????????</th>
                                            <td>
                                                {{ order.consignee_mobile }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>???????? ????????????</th>
                                            <td>
                                                {{ order.sender_identify }}
                                            </td>

                                            <th>???????? ???????????? ????????</th>
                                            <td>
                                                {{ order.consignee_identify }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>?????????????? ????????????</th>

                                            <td>
                                                {{ order.sender_note }}
                                            </td>

                                            <th>?????????????? ???????????? ????????</th>

                                            <td colspan="3">
                                                {{ order.consignee_note }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table
                                    class="text-center w-100 mb-1 table-bordered table"
                                >
                                    <thead>
                                        <tr class="text-center">
                                            <th colspan="6">????????????????</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="6">
                                                {{ order.description }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table
                                    class="text-center w-50 mt-2 table-bordered table float-start"
                                >
                                    <tbody>
                                        <tr>
                                            <td colspan="3">
                                                {{
                                                    order.sub_total > 0 &&
                                                    order.sub_total != order.sum
                                                        ? " ?????????????? ????????????:"
                                                        : " ??????????????:"
                                                }}
                                            </td>
                                            <td colspan="3">
                                                {{ order.sum }}
                                            </td>
                                        </tr>
                                        <tr v-if="order.discount > 0">
                                            <td colspan="3">
                                                ?????????? ({{ order.discount }}%):
                                            </td>

                                            <td colspan="3">
                                                {{ order.discount }}
                                            </td>
                                        </tr>

                                        <tr v-if="order.extra > 0">
                                            <td colspan="3">??????????????:</td>
                                            <td colspan="3">
                                                {{ order.extra }}
                                            </td>
                                        </tr>
                                        <tr
                                            v-if="
                                                order.sub_total > 0 &&
                                                order.sub_total != order.sum
                                            "
                                        >
                                            <td colspan="3">??????????????:</td>
                                            <td colspan="3">
                                                {{ order.sub_total }}
                                            </td>
                                        </tr>
                                        <tr v-if="order.vat > 0">
                                            <td colspan="3">
                                                ?????????? ???????????? ?????????????? ({{
                                                    order.branch.vat
                                                }}%):
                                            </td>
                                            <td colspan="3">
                                                {{ order.vat }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td
                                                colspan="3"
                                                v-if="order.pay != null"
                                            >
                                                ?????????? ??????????
                                            </td>
                                            <td
                                                colspan="3"
                                                v-if="order.pay != null"
                                            >
                                                {{ __(order.pay) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">????????????????:</td>
                                            <td colspan="3">
                                                {{ order.total }}
                                                <small style="display: block">
                                                    {{ order.totalInChar }}</small
                                                >
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div
                                    v-if="
                                        order.branch.vat_num != null &&
                                        !order.branch.vat_num.isEmpty &&
                                        order.branch.vat != null &&
                                        order.branch.vat > 0
                                    "
                                    class="text-center"
                                    style="margin-top: 2rem !important"
                                >
                                    <img :src="qr" height="120" />
                                </div>
                            </div>
                            <!--End Table-->
                            <!-- <div v-if="order.b_note">
                                        <ul class="navbar-nav row text-center">
                                            <li
                                                class="col-12"
                                                v-for="(
                                                    note, index
                                                ) in order.b_note.split(
                                                    ', '
                                                )"
                                                :key="index"
                                            >
                                                {{ note }}
                                            </li>
                                        </ul>
                                    </div> -->
                        </div>
                        <div class="clearfix my-5 pt-1"></div>
                        <!--End InvoiceBot-->
                        <div
                            v-if="order.notes"
                            class="footer text-center text-wrap"
                        >
                            {{ order.notes }}
                        </div>
                        <div
                            class="footer text-center"
                            style="font-weight: bolder; "
                        >
                            <div class="d-flex justify-content-between">
                                <div>?????????? ????????????:</div>
                                <div>?????????? ????????????:</div>
                                <div>
                                    <div class="mb-4">???????? ????????????</div>
                                    <qrcode
                                        render-as="svg"
                                        :value="$url + '/follow/' + order.uuid"
                                    ></qrcode>
                                </div>
                            </div>
                        </div>
                        <div
                            class="footer text-center"
                            style="
                                font-size: 8px;
                                font-weight: bolder;
                                ;
                            "
                        >
                            ?????????? ???????????? ????????????????
                            <i class="fa fa-phone"></i>
                            01002208627 -
                            <i class="fa fa-phone"></i> 01009199086 .
                        </div>
                        <!--End Invoice-->
                    </div>
                    <div class="modal-footer text-center">
                        <button
                            id="print"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                            type="button"
                        >
                            ??????????
                        </button>
                        <button
                            id="printer"
                            class="btn btn-success d-none"
                            @click="print()"
                        >
                            ??????????
                        </button>
                        <button
                            id="printOne"
                            class="btn btn-success"
                            @click="printOne()"
                        >
                            ??????????
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from "moment";
import qrcode from "qrcode.vue";

export default {
    components: { qrcode },
    props: ["order", "branch", "qr"],

    data() {
        return {
            isDone: false,
            moment: moment,
        };
    },
    methods: {
        print() {
            this.$htmlToPaper("printMe");
        },
        printOne() {
            this.$htmlToPaper("printMe");
        },
    },
};
</script>

<style scoped>
.modal {
    --bs-modal-width: 800px;
}
</style>
