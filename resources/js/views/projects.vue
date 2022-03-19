<template>
    <div class="container">
        <div class="main-body">
            <div class="row gutters-sm">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="row">
                            <div
                                class="col-lg-4 col-md-12 mb-4 mb-lg-0"
                                v-for="(project, index) in projects"
                                :key="index"
                                v-show="project.is_active"
                            >
                                <img
                                    :src="project.img"
                                    :alt="project.name"
                                    class="w-100 shadow-1-strong rounded mb-4"
                                    @click="showModalEvent(project)"
                                />
                            </div>
                            <div v-if="showModal">
                                <div class="modal-mask">
                                    <div class="modal-wrapper">
                                        <div
                                            class="modal-dialog modal-lg"
                                            role="document"
                                        >
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">
                                                        {{ modalData.name }}
                                                    </h5>
                                                </div>
                                                <div class="modal-body">
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
                                                            >Ver Video</a
                                                        >
                                                    </h4>
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
            showModal: false,
            modalData: {},
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
            }, 300);
        },
        showModalEvent(project) {
            this.modalData = project;
            this.showModal = true;
        },
    },
    created() {
        this.getUserProjects();
    },
};
</script>

<style scoped>
img {
    cursor: pointer;
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