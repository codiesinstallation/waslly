<template>
    <div class="card">
        <!-- Modal -->

        <form @submit.prevent="update">
            <div class="card-header d-flex justify-content-between">
                {{ __("Branche Settings") }}
                <button class="btn btn-primary" @click="update" type="submit">
                    {{ __("Save") }}
                </button>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <div class="custom-file mt-5">
                                <input
                                    type="file"
                                    class="custom-file-input"
                                    @change="onFileSelected"
                                />
                            </div>
                        </div>
                        <div class="col-6">
                            <img
                                v-if="logo"
                                :src="form.logo"
                                style="height: 170px; width: 170px"
                            />
                            <img
                                v-else
                                :src="form.logo"
                                style="height: 170px; width: 170px"
                            />
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span id="basic-addon1" class="input-group-text">
                            {{ __("Name AR") }}
                        </span>
                    </div>
                    <input
                        aria-describedby="basic-addon1"
                        class="form-control"
                        v-model="form.name_ar"
                        type="text"
                    />
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span id="basic-addon1" class="input-group-text">
                            {{ __("Name EN") }}
                        </span>
                    </div>
                    <input
                        aria-describedby="basic-addon1"
                        class="form-control"
                        v-model="form.name_en"
                        type="text"
                    />
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span id="basic-addon1" class="input-group-text">
                            {{ __("Location AR") }}
                        </span>
                    </div>
                    <input
                        aria-describedby="basic-addon1"
                        class="form-control"
                        v-model="form.location_ar"
                        type="text"
                    />
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span id="basic-addon1" class="input-group-text">
                            {{ __("Location EN") }}
                        </span>
                    </div>
                    <input
                        aria-describedby="basic-addon1"
                        class="form-control"
                        v-model="form.location_en"
                        type="text"
                    />
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span id="basic-addon2" class="input-group-text">{{
                            __("Mobile")
                        }}</span>
                    </div>
                    <input
                        aria-describedby="basic-addon2"
                        class="form-control"
                        v-model="form.mobile"
                        type="text"
                    />
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span id="basic-addon2" class="input-group-text">{{
                            __("Email")
                        }}</span>
                    </div>
                    <input
                        aria-describedby="basic-addon2"
                        class="form-control"
                        v-model="form.email"
                        type="email"
                    />
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span id="basic-addon2" class="input-group-text">{{
                            __("Vat Number")
                        }}</span>
                    </div>
                    <input
                        aria-describedby="basic-addon2"
                        class="form-control"
                        v-model="form.vat_num"
                        type="text"
                    />
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span id="basic-addon2" class="input-group-text">{{
                            __("Vat")
                        }}</span>
                    </div>
                    <input
                        aria-describedby="basic-addon2"
                        class="form-control"
                        v-model="form.vat"
                        step="0.01"
                        min="0"
                        type="number"
                    />
                </div>
                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span
                                            id="basic-addon1"
                                            class="input-group-text"
                                        >
                                        {{ __('Closure Hour') }}
                                        </span>
                                    </div>
                                    <input
                                        aria-describedby="basic-addon1"
                                        class="form-control"
                                        v-model="form.closure_hour"
                                        type="time"

                                    />
                                </div>
            </div>
        </form>
    </div>
</template>

<script type="text/javascript">
export default {
    props: ["form"],
    data() {
        return {
            errors: {},
            logo: "",
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
                    this.form.logo = event.target.result;
                    this.logo = event.target.result;
                    console.log(event.target.result);
                };
                reader.readAsDataURL(file);
            }
        },
        update() {
            axios
                .patch("/api/branches/" + this.form.id, this.form)
                .then(() => {
                    location.reload(true);

                    Notification.success();
                })
                .catch((error) => (this.errors = error.response.data.errors));
        },
    },
};
</script>

<style type="text/css">
.input-group-append,
.input-group-prepend {
    min-width: 150px;
}
</style>
