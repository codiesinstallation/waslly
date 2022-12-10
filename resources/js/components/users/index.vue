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
                            كل المستخدمين
                        </h6>
                        <a href="/user">{{ __('Add') }}</a>
                    </div>
                    <div class="w-100 table-wrapper">
                        <div id="pagewrap" class="row">
                            <div id="body" class="col-sm-12">
                                <table
                                    id="users"
                                    class="text-center table-bordered"
                                >
                                    <thead>
                                        <tr>
                                            <th >
                                                {{ __("Edit") }}
                                            </th>
                                            <th >
                                                {{ __("Delete") }}
                                            </th>
                                            <th >
                                                {{ __("Name") }}
                                            </th>
                                            <th >
                                                {{ __("Email") }}
                                            </th>
                                            <th >
                                                {{ __("User Status") }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(user, index) in users"
                                            :key="index"
                                            class="ErrorRow selectedR"
                                        >
                                            <td>
                                                <Edit :form="user"></Edit>
                                            </td>

                                            <td>
                                                <a
                                                    class="btn btn-danger"
                                                    @click="
                                                        deleteAction(user.id)
                                                    "
                                                    ><i class="fa fa-trash"></i
                                                ></a>
                                            </td>
                                            <td>{{ user.name }}</td>
                                            <td>{{ user.email }}</td>
                                            <td>{{ user.status===0?'مدير':user.status===1?'محاسب':'كاشير' }}</td>
                                        </tr>
                                    </tbody>
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

export default {
    async created() {
        await this.allusers();
    },
    components: { Edit },
    data() {
        return {
            users: [],
        };
    },

    methods: {
        allusers() {
            axios
                .get("/api/users")
                .then(({ data }) => {
                    if (data.length >= 0) {
                        this.users = data;
                    }
                })
                .catch((error) => console.log(error));
        },

        deleteAction(id) {
            if (confirm("هل تريد الحذف؟لايمكن الاستعاده مره اخرى.")) {
                axios
                    .delete("/api/users/" + id)
                    .then(() => {
                        this.users = this.users.filter((user) => {
                            return user.id != id;
                        });
                        Notification.successMsg("تم الحذف بنجاح ");
                    })
                    .catch(() => {
                        Notification.errorMsg("لايمكن حذف مستخدم له معاملات ");
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
