<template>
    <div class="d-inline">
        <button
            type="button"
            class="btn btn-sm btn-primary"
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
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">

{{ __('Edit City') }}                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="update">
                           <div class="card-body">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span
                                            id="basic-addon1"
                                            class="input-group-text"
                                        >
                            {{ __('City Name Ar') }}
                                        </span>
                                    </div>
                                    <input
                                        aria-describedby="basic-addon1"
                                        class="form-control"
                                        v-model="form.name_ar"
                                        type="text"
                                        required
                                    />
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span
                                            id="basic-addon1"
                                            class="input-group-text"
                                        >
                            {{ __('City Name EN') }}
                                        </span>
                                    </div>
                                    <input
                                        aria-describedby="basic-addon1"
                                        class="form-control"
                                        v-model="form.name_en"
                                        type="text" required
                                    />
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                          <span
                                            id="basic-addon2"
                                            class="input-group-text"
                                            >                             {{ __('Choose Country') }}
</span
                                        >
                                    </div>
                                      <select
                                        class="form-select"
                                        aria-label=".form-select-sm example"
                                        v-model="form.country_id"
                                    >
                                        <option
                                            v-for="(
                                                country, index
                                            ) in countries"
                                            :key="index"
                                            :value="country.id"
                                        >
                                            {{ country.name_ar }}
                                        </option>

                                    </select>
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
                            ??????????
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

    props: ["form",'countries'],

    data() {
        return {
            errors: {},
        };
    },

    methods: {

        update() {
            axios
                .patch("/api/governorates/" + this.form.id, this.form)
                .then(() => {
                                        location.reload(true);

                    Notification.success();
                })
                .catch((error) => (this.errors = error.response.data.errors));
        },
    },
};
</script>

<style type="text/css"></style>
