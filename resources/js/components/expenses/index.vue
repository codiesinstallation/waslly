<template>
    <div>
        <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div
                        class="card-header d-flex flex-row align-items-center justify-content-between"
                    >
                        <h6 class="m-0 font-weight-bold text-primary">
                            {{ __("Expenses") }}
                        </h6>
                        <CreateModal :user="user"></CreateModal>

                        <input
                            v-model="searchTerm"
                            class="form-control-sm"
                            :placeholder="__('Title')"
                            type="text"
                        />
                    </div>
                    <div class="w-100 dragscroll table-wrapper">
                        <div id="pagewrap" class="row">
                            <div id="body" class="col-sm-12">
                                <table
                                    id="expenses"
                                    class="text-center table-bordered"
                                >
                                    <thead>
                                        <tr>
                                            <th class="col-header">
                                                {{ __("SETTINGS") }}
                                            </th>

                                            <th class="col-header">
                                                {{ __("Code") }}
                                            </th>
                                            <th class="col-header">
                                                {{ __("Title") }}
                                            </th>
                                            <th class="col-header">
                                                {{ __("Cost") }}
                                            </th>
                                            <th class="col-header">
                                                {{ __("Vat") }}
                                            </th>
                                            <th class="col-header">
                                                {{ __("Pay Method") }}
                                            </th>

                                            <th class="col-header">
                                                {{ __("BILL ICON") }}
                                            </th>
                                            <th class="col-header">
                                                {{ __("Date") }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(
                                                expense, index
                                            ) in filterSearch"
                                            :key="index"
                                        >
                                            <td>
                                                <Edit
                                                    :user="user"
                                                    :form="expense"
                                                ></Edit>

                                                <a
                                                    class="btn btn-sm btn-danger"
                                                    @click="
                                                        deleteAction(expense.id)
                                                    "
                                                    ><i class="fa fa-trash"></i
                                                ></a>
                                            </td>
                                            <td>{{ expense.id }}</td>
                                            <td>{{ expense.expense_title }}</td>
                                            <td>{{ expense.expense_cost }}</td>
                                            <td>{{ expense.expense_vat }}</td>
                                            <td>{{ expense.pay }}</td>

                                            <td>
                                                <a
                                                    :href=" $url +
                                                            '/' +
                                                            expense.expense_icon
                                                       "
                                                    target="_blank"
                                                >
                                                    <img
                                                        :src="
                                                            $url +
                                                            '/' +
                                                            expense.expense_icon
                                                        "
                                                        class="card-img-top w-25 h-25 float-left ml-auto"
                                                    />
                                                </a>
                                            </td>
                                            <td>{{ expense.expense_date }}</td>
                                        </tr>
                                    </tbody>
                                    <tfoot></tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- DataTable with Hover -->
        </div>
    </div>
</template>

<script>
import Edit from "./edit.vue";
import CreateModal from "./create.vue";

export default {
    components: { Edit, CreateModal },
    props: ["user"],
    async created() {
        this.allExpenses();
    },
    data() {
        return {
            expenses: [],
            searchTerm: "",
        };
    },
    computed: {
        filterSearch() {
            return this.expenses.filter((expense) => {
                return expense.expense_title.match(this.searchTerm);
            });
        },
    },
    methods: {
        allExpenses() {
            axios
                .get("/api/expenses")
                .then(({ data }) => {
                    if (data.length >= 0) {
                        this.expenses = data;
                    }
                })
                .catch((error) => console.log(error));
        },

        deleteAction(id) {
            if (confirm("هل تريد الحذف؟لايمكن الاستعاده مره اخرى.")) {
                axios
                    .delete("/api/expenses/" + id)
                    .then(() => {
                        this.expenses = this.expenses.filter((expense) => {
                            return expense.id != id;
                        });
                        Notification.successMsg("تم الحذف بنجاح");
                    })
                    .catch(() => {
                        Notification.errorMsg("لايمكن الحذف!");
                    });
            }
        },
    },
};
</script>
<style>
a,
a:hover {
    text-decoration: none;
    font-weight: bolder;
}

.bg-info {
    width: 100%;
    height: 100%;
    position: absolute;
    overflow: hidden;
}

.spinner-border {
    margin: 50vh auto !important;
}

table.table-fit {
    width: auto !important;
    table-layout: auto !important;
}

table.table-fit thead th,
table.table-fit tfoot th {
    width: auto !important;
}

table.table-fit tbody td,
table.table-fit tfoot td {
    width: auto !important;
}
</style>
