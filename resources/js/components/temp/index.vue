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
                            جميع البيانات
                        </h6>
                        <router-link
                            class="m-0 font-weight-bold text-primary"
                            to="/create/supplier"
                            >إضافة</router-link
                        >

                        <a
                            class="btn btn-info"
                            href="javascript:timedRefresh(2000)"
                        >
                            <i class="fa fa-sort"></i>
                        </a>
                        <h6
                            class="m-0 font-weight-bold text-primary float-left"
                        >
                            <div id="search">
                                <input
                                    id="filter"
                                    class="form-control-sm"
                                    name="filter"
                                    type="text"
                                    value=""
                                />
                            </div>
                        </h6>
                    </div>
                    <div class="w-100 dragscroll table-wrapper">
                        <div id="pagewrap" class="row">
                            <div id="body" class="col-sm-12">
                                <table
                                    id="resultTable"
                                    class="text-center table-bordered"
                                >
                                    <thead>
                                        <tr></tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(item, index) in data"
                                            :key="index"
                                        >
                                            <td>
                                                <router-link
                                                    :to="{
                                                        name: 'edit-supplier',
                                                        params: { id: item.id },
                                                    }"
                                                    class="btn btn-sm btn-primary"
                                                    ><i class="fa fa-edit"></i>
                                                </router-link>
                                                <a
                                                    class="btn btn-sm btn-danger"
                                                    @click="
                                                        deleteAction(item.id)
                                                    "
                                                    ><i class="fa fa-trash"></i
                                                ></a>
                                            </td>
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
export default {
    created() {
        this.allData();
    },
    data() {
        return {
            data: [],
            searchTerm: "",
            loading: true,
        };
    },
    computed: {
        filterSearch() {
            return this.data.filter((result) => {
                return result.supplier_name_ar.match(this.searchTerm);
            });
        },
    },
    methods: {
        allData() {
            axios
                .get("/api/data")
                .then(({ data }) => {
                    if (data.length > 0) {
                        this.loading = false;
                        this.data = data;
                    }
                })
                .catch((error) => console.log(error));
        },

        nextPage(i) {
            this.page = i;
            this.allData();
        },
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
                        .delete("/api/data/" + id)
                        .then(() => {
                            this.data = this.data.filter((result) => {
                                return result.supplier_id != id;
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
