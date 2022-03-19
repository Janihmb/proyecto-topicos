<template>
    <div class="container">
        <div class="main-body">
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <form enctype="multipart/form-data">
                            <div>
                                <div>
                                    <div>
                                        <div class="card-header">
                                            <h4>Nuevo Proyecto</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="name">Nombre</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    name="name"
                                                    v-model="formData.name"
                                                />
                                                <p class="text-danger">
                                                    {{ errors.name }}
                                                </p>
                                            </div>
                                            <div class="form-group">
                                                <label for="category"
                                                    >Categoria</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    name="category"
                                                    v-model="formData.category"
                                                />
                                                <p class="text-danger">
                                                    {{ errors.category }}
                                                </p>
                                            </div>
                                            <div class="form-group">
                                                <label for="sub_category"
                                                    >Subcatergory</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    name="sub_category"
                                                    v-model="
                                                        formData.sub_category
                                                    "
                                                />
                                                <p class="text-danger">
                                                    {{ errors.sub_category }}
                                                </p>
                                            </div>
                                            <div class="form-group">
                                                <label for="language_framework"
                                                    >Lenguaje/Framework</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    name="language_framework"
                                                    v-model="
                                                        formData.language_framework
                                                    "
                                                />
                                                <p class="text-danger">
                                                    {{
                                                        errors.language_framework
                                                    }}
                                                </p>
                                            </div>
                                            <div class="form-group">
                                                <label for="img"
                                                    >Imagen del proyecto</label
                                                >
                                                <input
                                                    type="file"
                                                    class="form-control"
                                                    name="img"
                                                    v-on:change="onChange"
                                                />
                                                <p class="text-danger">
                                                    {{ errors.img }}
                                                </p>
                                            </div>
                                            <div class="form-group">
                                                <label for="url">URL</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    name="url"
                                                    v-model="formData.url"
                                                />
                                                <p class="text-danger">
                                                    {{ errors.url }}
                                                </p>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <button
                                                            @click="formSubmit"
                                                            class="
                                                                btn btn-primary
                                                            "
                                                        >
                                                            Guardar Proyecto
                                                        </button>
                                                    </div>
                                                </div>
                                                <div
                                                    class="
                                                        col-md-6
                                                        d-flex
                                                        justify-content-end
                                                    "
                                                ></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-8">
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
                                                class="cursor-pointer"
                                                @click="
                                                    showModalEvent(
                                                        null,
                                                        project.url
                                                    )
                                                "
                                                >Ver Video</a
                                            >
                                        </td>

                                        <td class="d-grid">
                                            <a
                                                @click="
                                                    showModalEvent(
                                                        project,
                                                        null
                                                    )
                                                "
                                                class="btn btn-primary"
                                                >Ver</a
                                            >
                                            <a class="btn btn-success"
                                                >Editar</a
                                            >
                                            <a
                                                @click="
                                                    deleteProject(project.id)
                                                "
                                                class="btn btn-danger"
                                                >Eliminar</a
                                            >
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div v-if="showModal">
                                <div class="modal-mask">
                                    <div class="modal-wrapper">
                                        <div
                                            class="modal-dialog modal-lg"
                                            role="document"
                                        >
                                            <div class="modal-content">
                                                <div
                                                    class="modal-body"
                                                    v-if="modalData"
                                                >
                                                    <img
                                                        :src="modalData.img"
                                                        :alt="modalData.name"
                                                        style="
                                                            max-height: 300px !important;
                                                            object-fit: contain;
                                                        "
                                                        class="
                                                            w-100
                                                            shadow-1-strong
                                                            rounded
                                                            mb-4
                                                        "
                                                    />
                                                    <h4>
                                                        <span class="text-muted"
                                                            >Titulo:</span
                                                        >
                                                        {{ modalData.name }}
                                                    </h4>
                                                    <h4>
                                                        <span class="text-muted"
                                                            >Categoria:</span
                                                        >
                                                        {{ modalData.category }}
                                                    </h4>
                                                    <h4>
                                                        <span class="text-muted"
                                                            >Subcategoria:</span
                                                        >
                                                        {{
                                                            modalData.sub_category
                                                        }}
                                                    </h4>
                                                    <h4>
                                                        <span class="text-muted"
                                                            >Lenguaje/Framework:</span
                                                        >
                                                        {{
                                                            modalData.language_framework
                                                        }}
                                                    </h4>
                                                    <h4>
                                                        <span class="text-muted"
                                                            >Video:</span
                                                        >
                                                        <a
                                                            :href="
                                                                modalData.url
                                                            "
                                                            target="_blank"
                                                            >{{
                                                                modalData.url
                                                            }}</a
                                                        >
                                                    </h4>
                                                </div>

                                                <div
                                                    class="modal-body"
                                                    v-if="modalDataVideo"
                                                >
                                                    <iframe
                                                        width="560"
                                                        height="315"
                                                        :src="modalDataVideo"
                                                        title="YouTube video player"
                                                        frameborder="0"
                                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                        allowfullscreen
                                                    ></iframe>
                                                </div>
                                                <div class="modal-footer">
                                                    <button
                                                        type="button"
                                                        class="
                                                            btn btn-secondary
                                                        "
                                                        @click="
                                                            showModal = false
                                                        "
                                                    >
                                                        Cerrar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
            modalData: {},
            modalDataVideo: null,
        };
    },
    methods: {
        getUserProjects() {
            this.projects = {};
            setTimeout(() => {
                axios
                    .get(
                        window.location.origin +
                            "/projects/user/" +
                            this.currentUser.id
                    )
                    .then((response) => {
                        this.projects = response.data;
                        console.log(response.data);
                        console.log("holis");
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
        deleteProject(project_id) {
            Swal.fire({
                title: "Esta seguro de eliminar este proyecto?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#ddd",
                confirmButtonText: "Eliminar",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .post(
                            window.location.origin +
                                "/project/delete/" +
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
                        "Eliminado!",
                        "El proyecto ha sido eliminado.",
                        "success"
                    );
                }
            });
        },
        showModalEvent(project = null, url = null) {
            console.log(project, url);
            if (!url) {
                this.modalData = project;
                this.modalDataVideo = null;
            }
            if (!project) {
                this.modalDataVideo = url;
                this.modalData = null;
            }
            this.showModal = true;
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
iframe {
    margin: 0 auto;
    display: block;
}
</style>