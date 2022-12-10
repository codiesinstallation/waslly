<template>
    <div class="d-inline">
        <button
            type="button"
            class="btn btn-sm btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#createModal"
        >
            {{ __("Add") }}
        </button>

        <!-- Modal -->
        <div
            class="modal fade"
            id="createModal"
            tabindex="-1"
            aria-labelledby="createModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">
                            {{ __("Add Expense") }}
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <form
                            @submit.prevent="create"
                            enctype="multipart/form-data"
                        >
                            <div
                                class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                            ></div>
                            <div class="card-body">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span
                                            id="basic-addon1"
                                            class="input-group-text"
                                            >{{ __("Title") }}</span
                                        >
                                    </div>
                                    <input
                                        aria-describedby="basic-addon1"
                                        class="form-control"
                                        v-model="form.expense_title"
                                        type="text"
                                        required
                                    />
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text">{{
                                            __("Mount")
                                        }}</span>
                                    </div>
                                    <input
                                        aria-describedby="basic-addon2"
                                        class="form-control"
                                        v-model="form.expense_cost"
                                        min="0"
                                        type="number"
                                        required
                                    />
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text">{{
                                            __("Date")
                                        }}</span>
                                    </div>
                                    <input
                                        aria-describedby="basic-addon2"
                                        class="form-control"
                                        v-model="form.expense_date"
                                        type="datetime-local"
                                        required
                                    />
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text">{{
                                            __("Vat")
                                        }}</span>
                                    </div>
                                    <input
                                        aria-describedby="basic-addon2"
                                        class="form-control"
                                        v-model="form.vat"
                                        type="number"
                                    />
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text">{{
                                            __("Pay Method")
                                        }}</span>
                                    </div>
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
                                </div>

                                <div class="input-group mb-3">
                                    <img
                                        :src="form.expense_icon"
                                        class="card-img-top w-25 h-25 float-left ml-auto"
                                    />
                                    <input
                                        id="customFile"
                                        class="custom-file-input"
                                        type="file"
                                        @change="onFileSelected"
                                    />
                                    <span
                                        class="custom-file-label input-group-text w-100"
                                        for="customFile"
                                        style="width: 80px; text-align: center"
                                    ></span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >
                            {{ __("Close") }}
                        </button>
                        <button
                            class="btn btn-primary"
                            @click="create"
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

<script>
export default {
    props: ["user"],
    data() {
        return {
            errors: {},
            form: {},
        };
    },

    methods: {
        onFileSelected(event) {
            let file = event.target.files[0];
            if (file.size > 1048770) {
                Notification.image_validation();
            } else {
                let reader = new FileReader();
                reader.onload = (event) => {
                    this.form.expense_icon = event.target.result;
                    console.log(event.target.result);
                };
                reader.readAsDataURL(file);
            }
        },
        create() {
            this.form.user_id = this.user.id;
            this.form.branch_id = this.user.branch_id;

            axios
                .post("/api/expenses", this.form)
                .then(() => {
                    window.location.href = "/expenses"

                    Notification.success();
                })
                .catch((error) => (this.errors = error.response.data.errors));
        },
    },
};
</script>
