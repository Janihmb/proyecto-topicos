
   
<template>
    <form @submit="formSubmit" enctype="multipart/form-data">
        <div>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header"><h4>Registro</h4></div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="name"
                                    v-model="formData.name"
                                />
                                <p class="text-danger" v-text="errors.name"></p>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="email"
                                    v-model="formData.email"
                                />
                                <p
                                    class="text-danger"
                                    v-text="errors.email"
                                ></p>
                            </div>
                            <div class="form-group">
                                <label for="email">Tipo de usuario</label>
                                <select
                                    class="form-select"
                                    name="user_type"
                                    v-model="formData.user_type"
                                >
                                    <option value="1">Usuario</option>
                                    <option value="2">Progrmador</option>
                                </select>
                                <p
                                    class="text-danger"
                                    v-text="errors.user_type"
                                ></p>
                            </div>
                            <div class="form-group">
                                <label for="cedula">Cedula</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="cedula"
                                    v-model="formData.cedula"
                                />
                                <p
                                    class="text-danger"
                                    v-text="errors.cedula"
                                ></p>
                            </div>
                            <div class="form-group">
                                <label for="address">Direccion</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="address"
                                    v-model="formData.address"
                                />
                                <p
                                    class="text-danger"
                                    v-text="errors.address"
                                ></p>
                            </div>
                            <div class="form-group">
                                <label for="phone">Telefono</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="phone"
                                    v-model="formData.phone"
                                />
                                <p
                                    class="text-danger"
                                    v-text="errors.phone"
                                ></p>
                            </div>
                            <div class="form-group">
                                <label for="photo">Foto</label>
                                <input
                                    type="file"
                                    class="form-control"
                                    name="photo"
                                    v-on:change="onChange"
                                />
                                <p
                                    class="text-danger"
                                    v-text="errors.photo"
                                ></p>
                            </div>

                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input
                                    type="password"
                                    class="form-control"
                                    name="password"
                                    v-model="formData.password"
                                />
                                <p
                                    class="text-danger"
                                    v-text="errors.password"
                                ></p>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation"
                                    >Confirmar Contraseña</label
                                >
                                <input
                                    type="password"
                                    class="form-control"
                                    name="password_confirmation"
                                    v-model="formData.password_confirmation"
                                />
                                <p
                                    class="text-danger"
                                    v-text="errors.password_confirmation"
                                ></p>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button
                                            @click="formSubmit"
                                            class="btn btn-primary"
                                        >
                                            Registrar
                                        </button>
                                    </div>
                                </div>
                                <div
                                    class="col-md-6 d-flex justify-content-end"
                                >
                                    <router-link to="/login"
                                        >Ya tengo cuenta</router-link
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>
<script>
export default {
    data() {
        return {
            formData: {
                name: "",
                email: "",
                cedula: "",
                address: "",
                phone: "",
                photo: "",
                user_type: 1,
                password: "",
                password_confirmation: "",
            },
            errors: {},
        };
    },
    methods: {
        onChange(e) {
            console.log(e.target.files[0]);
            this.formData.photo = e.target.files[0];
        },
        formSubmit(e) {
            e.preventDefault();
            let existingObj = this;
            const config = {
                headers: {
                    "content-type": "multipart/form-data",
                },
            };
            let data = new FormData();
            data.append("name", this.formData.name);
            data.append("email", this.formData.email);
            data.append("cedula", this.formData.cedula);
            data.append("address", this.formData.address);
            data.append("phone", this.formData.phone);
            data.append("photo", this.formData.photo);
            data.append("user_type", this.formData.user_type);
            data.append("password", this.formData.password);
            data.append(
                "password_confirmation",
                this.formData.password_confirmation
            );

            axios
                .post(window.location.origin + "/api/register", data, config)
                .then((response) => {
                    console.log(response.data);
                    this.formData.name =
                        this.formData.email =
                        this.formData.password =
                        this.formData.password_confirmation =
                            "";
                    this.errors = {};
                    this.$router.push("/");
                    this.$toaster.success(
                        "Su cuenta fue creada exitosamente, por favor inicie sesion"
                    );
                })
                .catch((errors) => {
                    this.errors = errors.response.data.errors;
                    console.log(errors.response);
                    this.$toaster.error("Por favor, intente de nuevo");
                });
        },
    },
};
</script>