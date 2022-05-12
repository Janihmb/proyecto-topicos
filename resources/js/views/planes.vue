<template>
    <div class="pricing8 py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h3 class="mb-3">Nuestros Planes🚀</h3>
                </div>
            </div>
            <!-- row  -->
            <div class="row mt-4">
                <!-- column  -->
                <div
                    class="col-md-4 ml-auto pricing-box align-self-center"
                    v-for="(plan, i) in planes"
                    :key="i"
                >
                    <div class="card mb-4">
                        <div class="card-body p-4 text-center">
                            <h5 class="font-weight-normal">
                                {{ plan.nombre }}
                            </h5>
                            <sup>$</sup
                            ><span class="text-dark display-5">{{
                                plan.precio
                            }}</span>
                            <p class="mt-4">
                                {{ plan.detalles }}
                            </p>
                        </div>
                        <router-link
                            class="
                                btn btn-info-gradiant
                                p-3
                                btn-block
                                border-0
                                text-white
                            "
                            :to="'/detalles/' + plan.id"
                            >Obtener este plan
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// import image from "../assets/lamp.png"
export default {
    name: "HelloWorld",

    data: function () {
        return {
            planes: [
                {
                    id: 1,
                    nombre: "Regular Plan",
                    precio: 9.99,
                    detalles: "El mejor plan y economico",
                },
                {
                    id: 2,
                    nombre: "Master Plan",
                    precio: 15.99,
                    detalles: "El mejor plan y economico",
                },
                {
                    id: 3,
                    nombre: "Premium Plan",
                    precio: 19.99,
                    detalles: "El mejor plan y economico",
                },
            ],
        };
    },
};
</script>

<style scoped>
@import url(//fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800);
.pricing8 {
    font-family: "Montserrat", sans-serif;
    color: #8d97ad;
    font-weight: 300;
}

.pricing8 h1,
.pricing8 h2,
.pricing8 h3,
.pricing8 h4,
.pricing8 h5,
.pricing8 h6 {
    color: #3e4555;
}

.pricing8 h5 {
    line-height: 22px;
    font-size: 18px;
}

.pricing8 .subtitle {
    color: #8d97ad;
    line-height: 24px;
}

.pricing8 .display-5 {
    font-size: 3rem;
}

.pricing8 .font-14 {
    font-size: 14px;
}

.pricing8 .pricing-box sup {
    top: -20px;
    font-size: 16px;
}

.pricing8 .btn-info-gradiant {
    background: #188ef4;
    background: -webkit-linear-gradient(
        legacy-direction(to right),
        #188ef4 0%,
        #316ce8 100%
    );
    background: -webkit-gradient(
        linear,
        left top,
        right top,
        from(#188ef4),
        to(#316ce8)
    );
    background: -webkit-linear-gradient(left, #188ef4 0%, #316ce8 100%);
    background: -o-linear-gradient(left, #188ef4 0%, #316ce8 100%);
    background: linear-gradient(to right, #188ef4 0%, #316ce8 100%);
}

.pricing8 .btn-info-gradiant:hover {
    background: #316ce8;
    background: -webkit-linear-gradient(
        legacy-direction(to right),
        #316ce8 0%,
        #188ef4 100%
    );
    background: -webkit-gradient(
        linear,
        left top,
        right top,
        from(#316ce8),
        to(#188ef4)
    );
    background: -webkit-linear-gradient(left, #316ce8 0%, #188ef4 100%);
    background: -o-linear-gradient(left, #316ce8 0%, #188ef4 100%);
    background: linear-gradient(to right, #316ce8 0%, #188ef4 100%);
}

.pricing8 .btn-danger-gradiant {
    background: #ff4d7e;
    background: -webkit-linear-gradient(
        legacy-direction(to right),
        #ff4d7e 0%,
        #ff6a5b 100%
    );
    background: -webkit-gradient(
        linear,
        left top,
        right top,
        from(#ff4d7e),
        to(#ff6a5b)
    );
    background: -webkit-linear-gradient(left, #ff4d7e 0%, #ff6a5b 100%);
    background: -o-linear-gradient(left, #ff4d7e 0%, #ff6a5b 100%);
    background: linear-gradient(to right, #ff4d7e 0%, #ff6a5b 100%);
}

.pricing8 .btn-danger-gradiant:hover {
    background: #ff6a5b;
    background: -webkit-linear-gradient(
        legacy-direction(to right),
        #ff6a5b 0%,
        #ff4d7e 100%
    );
    background: -webkit-gradient(
        linear,
        left top,
        right top,
        from(#ff6a5b),
        to(#ff4d7e)
    );
    background: -webkit-linear-gradient(left, #ff6a5b 0%, #ff4d7e 100%);
    background: -o-linear-gradient(left, #ff6a5b 0%, #ff4d7e 100%);
    background: linear-gradient(to right, #ff6a5b 0%, #ff4d7e 100%);
}
</style>
