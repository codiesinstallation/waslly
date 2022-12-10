<template>
    <div>
        <button
            type="button"
            class="btn btn-primary"
            data-bs-toggle="modal"
            :data-bs-target="'#exampleModal' + form.id"
        >
            <i class="fa fa-edit"></i>
        </button>

        <!-- Modal -->
        <div
            class="modal fade"
            :id="'exampleModal' + form.id"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="card-bod">
                            <form @submit.prevent="update">
                                <div class="card-body">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span
                                                id="basic-addon1"
                                                class="input-group-text"
                                                >{{ __("Name") }}</span
                                            >
                                        </div>
                                        <input
                                            aria-describedby="basic-addon1"
                                            class="form-control"
                                            v-model="form.name"
                                            type="text"
                                            required
                                        />
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span
                                                id="basic-addon1"
                                                class="input-group-text"
                                                >{{ __("Email") }}</span
                                            >
                                        </div>
                                        <input
                                            aria-describedby="basic-addon1"
                                            class="form-control"
                                            v-model="form.email"
                                            type="email"
                                            required
                                        />
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text"
                                                >كلمة المرور
                                            </span>
                                        </div>
                                        <input
                                            aria-describedby="basic-addon2"
                                            aria-label="كلمة المرور "
                                            class="form-control"
                                            placeholder="كلمة المرور "
                                            v-model="form.newpassword"
                                            type="text"
                                        />
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                {{ __("User Status") }}
                                            </span>
                                        </div>

                                        <select
                                            class="font-weight-bold form-select form-control text-info"
                                            aria-label=".form-select"
                                            v-model="form.status"
                                        >
                                            <option value="0">مدير</option>
                                            <option value="1">محاسب</option>
                                            <option value="2">كاشير</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            id="close"
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >
                            اغلاق
                        </button>
                        <button
                            class="btn btn-primary"
                            @click="update"
                            type="submit"
                        >
                            {{ __("Save") }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
export default {
    props: ["form"],

    data() {
        return {
            errors: {},
        };
    },

    methods: {
        update() {
            axios
                .patch("/api/users/" + this.form.id, this.form)
                .then(() => {

                    window.location.href = "/users";

                    Notification.success();
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                })
                .then((e) => {
                    if (this.errors.name)
                        Notification.customMsg(
                            "error",
                            "topRight",
                            this.errors.name[0]
                        );
                    if (this.errors.email)
                        Notification.customMsg(
                            "error",
                            "topRight",
                            this.errors.email[0]
                        );
                });
        },
    },
};
</script>

<style type="text/css"></style>
