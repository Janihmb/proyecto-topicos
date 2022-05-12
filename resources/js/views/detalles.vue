<template>
    <div>
        <div class="pricing8 py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 text-center">
                        <h3 class="mb-3">Detalles de nuestro plan🥵</h3>
                    </div>
                </div>
                <!-- row  -->
                <div class="row mt-4">
                    <!-- column  -->
                    <div class="ml-auto pricing-box align-self-center">
                        <div class="card mb-4">
                            <div class="card-body p-4 text-center">
                                <h5 class="font-weight-normal">
                                    {{ currentPlan.nombre }}
                                </h5>
                                <sup>$</sup
                                ><span class="text-dark display-5">{{
                                    currentPlan.precio
                                }}</span>
                                <p class="mt-4">
                                    {{ currentPlan.detalles }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div v-show="!currentUser">
                        <h4>
                            Por Favor inicie sesion para proceder a comprar ✨
                        </h4>
                    </div>
                    <div v-show="currentUser && !order">
                        <div
                            ref="paypal"
                            class="row justify-content-center"
                        ></div>
                    </div>

                    <div v-if="order" class="main">
                        <div class="container mt-3">
                            <div class="text-center">
                                <h3 class="mb-3">Factura🥳</h3>
                            </div>
                            <div class="card animate__animated animate__fadeIn">
                                <div class="card-header">
                                    Fecha
                                    <strong>{{
                                        new Date().toLocaleDateString("es-US")
                                    }}</strong>
                                    <span class="float-right">
                                        <strong>Estado:</strong>
                                        {{ order.status }}</span
                                    >
                                </div>
                                <div class="card-body">
                                    <div class="row mb-4">
                                        <div class="col-6 col-md-6">
                                            <div>{{ currentUser.name }}</div>
                                            <div>{{ currentUser.address }}</div>
                                            <div>
                                                Email: {{ currentUser.email }}
                                            </div>
                                            <div>
                                                Phone: {{ currentUser.phone }}
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-6">
                                            <div>
                                                {{
                                                    order.payer.name.given_name
                                                }}
                                                {{ order.payer.name.surname }}
                                            </div>
                                            <div>
                                                {{
                                                    order.payer.address
                                                        .address_line_1
                                                }},
                                                {{
                                                    order.payer.address
                                                        .admin_area_1
                                                }},
                                                {{
                                                    order.payer.address
                                                        .admin_area_2
                                                }},
                                                {{
                                                    order.payer.address
                                                        .country_code
                                                }},
                                                {{
                                                    order.payer.address
                                                        .postal_code
                                                }}
                                            </div>
                                            <div>
                                                Email:
                                                {{ order.payer.email_address }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-responsive-sm">
                                        <table
                                            class="table table-sm table-striped"
                                        >
                                            <thead>
                                                <tr>
                                                    <th
                                                        scope="col"
                                                        width="2%"
                                                        class="center"
                                                    >
                                                        #
                                                    </th>
                                                    <th scope="col" width="20%">
                                                        Producto/Servicio
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="
                                                            d-none
                                                            d-sm-table-cell
                                                        "
                                                        width="50%"
                                                    >
                                                        Descripción
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        width="10%"
                                                        class="text-right"
                                                    >
                                                        Total
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-left">1</td>
                                                    <td class="item_name">
                                                        {{ currentPlan.nombre }}
                                                    </td>
                                                    <td
                                                        class="
                                                            item_desc
                                                            d-none
                                                            d-sm-table-cell
                                                        "
                                                    >
                                                        {{ currentPlan.nombre }}
                                                    </td>

                                                    <td class="text-right">
                                                        {{ currentPlan.precio }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-8 col-sm-5"></div>

                                        <div class="col-lg-4 col-sm-5 ml-auto">
                                            <table
                                                class="
                                                    table table-sm table-clear
                                                "
                                            >
                                                <tbody>
                                                    <tr>
                                                        <td class="left">
                                                            <strong
                                                                >Total</strong
                                                            >
                                                        </td>
                                                        <td
                                                            class="
                                                                text-right
                                                                bg-light
                                                            "
                                                        >
                                                            <strong
                                                                >$
                                                                {{
                                                                    currentPlan.precio
                                                                }}</strong
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
            currentUser: null,
            token: localStorage.getItem("token"),
            user: localStorage.getItem("user"),
            loaded: false,
            paidFor: false,
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
            currentPlan: null,
            order: null,
        };
    },
    mounted: function () {
        const script = document.createElement("script");
        script.src =
            "https://www.paypal.com/sdk/js?client-id=AZmScxV2t4GOaKx63HmFqqK7zfrfK5-JTFrRZyaSHOg_LYZkDr7MtQn4E8C2H_IqACSGOuFlt3MgJsq0";
        script.addEventListener("load", this.setLoaded);
        document.body.appendChild(script);
        window.axios.defaults.headers.common[
            "Authorization"
        ] = `Bearer ${this.token}`;
        axios.get(window.location.origin + "/api/user").then((response) => {
            this.currentUser = response.data;
            console.log(this.currentUser);
        });
        this.currentPlan = this.planes.find(
            (plan) => plan.id === parseInt(this.$route.params.id)
        );
    },
    methods: {
        setLoaded: function () {
            this.loaded = true;
            window.paypal
                .Buttons({
                    createOrder: (data, actions) => {
                        return actions.order.create({
                            purchase_units: [
                                {
                                    description: this.currentPlan.detalles,
                                    amount: {
                                        currency_code: "USD",
                                        value: this.currentPlan.precio,
                                    },
                                },
                            ],
                        });
                    },
                    onApprove: async (data, actions) => {
                        const order = await actions.order.capture();
                        this.paidFor = true;
                        this.order = order;
                        console.log(order);
                    },
                    onError: (err) => {
                        console.log(err);
                    },
                })
                .render(this.$refs.paypal);
        },
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
</style>
