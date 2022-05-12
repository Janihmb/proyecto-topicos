<template>
    <div>
        <div class="jumbotron">
            <div class="overlay"></div>
            <div class="inner">
                <div class="h-100 parent">
                    <div>
                        <h1 class="display-3">Hello, world!</h1>

                        <p class="lead">
                            Proyecto en Laravel + Vue para la materia de Topicos Web
                        </p>
                        <hr />
                        <p class="lead">Hecho con ❤️    </p>
                        <p class="lead">
                           <section id="section03" class="demo">
                            <a class="button" href="#projects"><span></span>Scroll</a>
                            </section>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container my-5" id="projects">
            <h1 class="text-center my-5">Nuestros Proyectos</h1>
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
                                        class="
                                            w-100
                                            shadow-1-strong
                                            rounded
                                            mb-4
                                        "
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
                                                            :alt="
                                                                modalData.name
                                                            "
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
                                                            <span
                                                                class="
                                                                    text-muted
                                                                "
                                                                >Titulo:</span
                                                            >
                                                            {{ modalData.name }}
                                                        </h4>
                                                        <h4>
                                                            <span
                                                                class="
                                                                    text-muted
                                                                "
                                                                >Categoria:</span
                                                            >
                                                            {{
                                                                modalData.category
                                                            }}
                                                        </h4>
                                                        <h4>
                                                            <span
                                                                class="
                                                                    text-muted
                                                                "
                                                                >Subcategoria:</span
                                                            >
                                                            {{
                                                                modalData.sub_category
                                                            }}
                                                        </h4>
                                                        <h4>
                                                            <span
                                                                class="
                                                                    text-muted
                                                                "
                                                                >Lenguaje/Framework:</span
                                                            >
                                                            {{
                                                                modalData.language_framework
                                                            }}
                                                        </h4>
                                                        <h4>
                                                            <span
                                                                class="
                                                                    text-muted
                                                                "
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
                                                                btn
                                                                btn-secondary
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
.jumbotron {
    position: relative;
    background: url("https://i.pinimg.com/originals/a7/fc/aa/a7fcaa43650adc892c401956a08dc32a.jpg");
    background-size: cover;
    height: 95vh;
}

.jumbotron > .overlay {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1;
}

.jumbotron > .inner {
    position: relative;
    z-index: 2;
    color: white;
    display: block;
    text-align: center;
    height: 90vh;
}
.parent {
    display: flex;
    align-items: center;
    justify-content: center;
}
.button {
    position: absolute;
    bottom: 20px;
    left: 0;
    right: 0;
    z-index: 2;
    display: inline-block;
    transform: translate(0, -50%);
    color: #fff;
    font: normal 400 20px/1 "Josefin Sans", sans-serif;
    letter-spacing: 0.1em;
    text-decoration: none;
    transition: opacity 0.3s;
}

#section03 a {
    padding-top: 60px;
}
#section03 a span {
    position: absolute;
    top: 0;
    left: 50%;
    width: 46px;
    height: 46px;
    margin-left: -23px;
    border: 1px solid #fff;
    border-radius: 100%;
    box-sizing: border-box;
}
#section03 a span::after {
    position: absolute;
    top: 50%;
    left: 50%;
    content: "";
    width: 16px;
    height: 16px;
    margin: -12px 0 0 -8px;
    border-left: 1px solid #fff;
    border-bottom: 1px solid #fff;
    transform: rotate(-45deg);
    box-sizing: border-box;
}
#section03 a span::before {
    position: absolute;
    top: 0;
    left: 0;
    z-index: -1;
    content: "";
    width: 44px;
    height: 44px;
    box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.1);
    border-radius: 100%;
    opacity: 0;
    animation: waveEffect 2s infinite;
    box-sizing: border-box;
}
@-webkit-keyframes waveEffect {
    0% {
        opacity: 0;
    }
    30% {
        opacity: 1;
    }
    60% {
        box-shadow: 0 0 0 60px rgba(255, 255, 255, 0.1);
        opacity: 0;
    }
    100% {
        opacity: 0;
    }
}
@keyframes waveEffect {
    0% {
        opacity: 0;
    }
    30% {
        opacity: 1;
    }
    60% {
        box-shadow: 0 0 0 60px rgba(255, 255, 255, 0.1);
        opacity: 0;
    }
    100% {
        opacity: 0;
    }
}

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
