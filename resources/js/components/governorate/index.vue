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
{{ __('Cities') }}                        </h6>
                        <CreateModal :countries="countries"></CreateModal>
                    </div>
                    <table
                        v-if="data"
                        id="resultTable"
                        class="text-center table-bordered"
                    >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Name AR') }}</th>
                                <th>{{ __('Name EN') }}</th>
                                <th>{{ __('Country') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in data" :key="index">
                                <td>
                                    <Edit :countries="countries" :form="item"></Edit>
                                    <a
                                        class="btn btn-sm btn-danger"
                                        @click="deleteAction(item.id)"
                                        ><i class="fa fa-trash"></i
                                    ></a>
                                </td>
                                <td>
                                    {{ item.name_ar }}
                                </td>
                                <td>
                                    {{ item.name_en }}
                                </td>
                                <td>
                                    {{ item.country.name_ar }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
    props: ["data",'countries'],
    created() {},
    data() {
        return {};
    },

    methods: {
        deleteAction(id) {
            Swal.fire({
                title: "هل تريد حذف الصنف؟",
                text: "لايمكن الاسترجاع عن هذا!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "تأكيد حذف لصنف!",
                cancelButtonText: "إلغاء",
            }).then((res) => {
                if (res.value) {
                    axios
                        .delete("/api/countries/" + id)
                        .then(() => {
                            this.data = this.data.filter((result) => {
                                return result.id != id;
                            });
                        })
                        .catch(() => {
                            //   this.$router.push({ name: "data" });
                        });
                    Swal.fire("حذف!", "تم الحذف.", "success");
                }
            });
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
