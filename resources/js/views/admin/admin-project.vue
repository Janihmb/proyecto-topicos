<template>
    <div class="container">
        <div class="main-body">
            <div class="row gutters-sm">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>imagen</th>
                                        <th>Nombre</th>
                                        <th>Categoria</th>
                                        <th>Subcategoria</th>
                                        <th>URL</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(project, index) in projects"
                                        :key="index"
                                    >
                                        <td>{{ index + 1 }}</td>
                                        <td><img :src="project.img" /></td>
                                        <td>{{ project.name }}</td>
                                        <td>{{ project.category }}</td>
                                        <td>{{ project.sub_category }}</td>
                                        <td>
                                            <a
                                                :href="project.url"
                                                target="_blank"
                                                >{{ project.url }}</a
                                            >
                                        </td>

                                        <td>
                                            <a
                                                @click="
                                                    switchProject(project.id)
                                                "
                                                class="btn btn-danger"
                                                v-if="project.is_active"
                                                >Desactivar</a
                                            >
                                            <a
                                                @click="
                                                    switchProject(project.id)
                                                "
                                                class="btn btn-warning"
                                                v-else
                                                >Activar</a
                                            >
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            projects: {},
            currentUser: {},
            token: localStorage.getItem("token"),
            user: localStorage.getItem("user"),
            formData: {
                name: "",
                category: "",
                sub_category: "",
                language_framework: "",
                img: "",
                url: "",
            },
            errors: {},
            showModal: false,
        };
    },
    methods: {
        getUserProjects() {
            this.projects = {};
            setTimeout(() => {
                axios
                    .get(window.location.origin + "/projects/users")
                    .then((response) => {
                        this.projects = response.data;
                        console.log(response.data);
                    })
                    .catch((errors) => {
                        console.log(errors);
                    });
            }, 800);
        },
        onChange(e) {
            console.log(e.target.files[0]);
            this.formData.img = e.target.files[0];
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
            data.append("category", this.formData.category);
            data.append("sub_category", this.formData.sub_category);
            data.append("language_framework", this.formData.language_framework);
            data.append("img", this.formData.img);
            data.append("url", this.formData.url);
            data.append("user_type", this.formData.user_type);
            data.append("user_id", this.currentUser.id);

            axios
                .post(window.location.origin + "/project/create", data, config)
                .then((response) => {
                    console.log(response.data);
                    this.formData.name =
                        this.formData.category =
                        this.formData.sub_category =
                        this.formData.language_framework =
                        this.formData.img =
                        this.formData.url =
                        this.formData.user_type =
                            "";
                    this.errors = {};
                    this.$toaster.success(
                        "Su proyecto fue creado exitosamente"
                    );
                    this.getUserProjects();
                })
                .catch((errors) => {
                    this.errors = errors.response.data.errors;
                    console.log(errors.response);
                    this.$toaster.error("Por favor, intente de nuevo");
                });
        },
        switchProject(project_id) {
            Swal.fire({
                title: "Esta seguro de modificar este proyecto?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Actualizar",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .post(
                            window.location.origin +
                                "/project/switch-active/" +
                                project_id
                        )
                        .then((response) => {
                            this.getUserProjects();
                            console.log(response);
                        })
                        .catch((errors) => {
                            console.log(errors);
                        });
                    Swal.fire(
                        "Actualizado!",
                        "Este proyecto ha sido actualizado.",
                        "success"
                    );
                }
            });
        },
        logout() {
            axios
                .post("api/logout")
                .then((response) => {
                    localStorage.removeItem("token");
                    this.$router.push("/");
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
    },
    created() {
        window.axios.defaults.headers.common[
            "Authorization"
        ] = `Bearer ${this.token}`;
        this.getUserProjects();
        axios
            .get(window.location.origin + "/api/user")
            .then((response) => {
                this.currentUser = response.data;
            })
            .catch((errors) => {
                console.log(errors);
            });
    },
};
</script>

<style scoped>
img {
    max-width: 150px;
    height: 100%;
    width: 100%;
    object-fit: cover;
}
.modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: table;
    transition: opacity 0.3s ease;
}

.modal-wrapper {
    display: table-cell;
    vertical-align: middle;
}
</style>