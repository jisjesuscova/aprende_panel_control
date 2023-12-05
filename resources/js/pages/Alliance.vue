<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 margin-left">
                        <h1>Alianzas</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">
                                <router-link
                                    to="/alliance/create"
                                    class="btn btn-block btn-success"
                                    >Agregar</router-link
                                >
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
            <div class="container-fluid">
                <div class="row" v-if="posts.total > 0">
                    <div class="col-12">
                        <div v-if="loading">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 text-center loading">
                                        <div
                                            class="d-flex flex-column align-items-center"
                                        >
                                            <img
                                                :src="`../../template/dist/img/spinner.gif`"
                                                alt=""
                                                height="70"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Datos</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="alert alert-success" role="alert" v-if="created_alliance == 1">
                                        Registro agregado con <strong>éxito</strong>
                                    </div>
                                    <div class="alert alert-success" role="alert" v-if="updated_alliance == 1">
                                        Registro actualizado con <strong>éxito</strong>
                                    </div>
                                    <o-table
                                        :loading="isLoading"
                                        :data="
                                            posts.current_page &&
                                            posts.data.length == 0
                                                ? []
                                                : posts.data
                                        "
                                    >
                                        <o-table-column
                                            field="id"
                                            label="Id"
                                            numeric
                                            v-slot="p"
                                        >
                                            {{ p.row.id }}
                                        </o-table-column>
                                        <o-table-column
                                            field="name"
                                            label="Nombre"
                                            v-slot="p"
                                        >
                                            {{ p.row.name }}
                                        </o-table-column>
                                        <o-table-column
                                            field=""
                                            label=""
                                            v-slot="p"
                                        >
                                            <router-link
                                                :to="`/alliance/edit/${p.row.id}`"
                                                class="btn btn-success mr-2"
                                            >
                                                <i class="fa-solid fa-pencil"></i>
                                            </router-link>
                                            <o-button
                                                variant="danger"
                                                @click="deleteAlliance(p.row.id)"
                                            >
                                                <i class="fa-solid fa-trash"></i>
                                            </o-button>
                                        </o-table-column>
                                    </o-table>
                                    <hr />
                                    <o-pagination
                                        v-if="
                                            posts.current_page &&
                                            posts.data.length > 0
                                        "
                                        @change="updatePage"
                                        :total="posts.total"
                                        v-model:current="currentPage"
                                        :range-before="2"
                                        :range-after="2"
                                        order="centered"
                                        size="small"
                                        :simple="false"
                                        :rounded="true"
                                        :per-page="posts.per_page"
                                    >
                                    </o-pagination>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" v-else>
                    <div class="col-12">
                        <div v-if="loading">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 text-center loading">
                                        <div
                                            class="d-flex flex-column align-items-center"
                                        >
                                            <img
                                                :src="`../../template/dist/img/spinner.gif`"
                                                alt=""
                                                height="70"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Datos</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table text-center">
                                        <tr>
                                            <td class="font-weight-bold">
                                                No hay registros
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    data() {
        return {
            posts: [],
            isLoading: true,
            currentPage: 1,
            loading: true,
            created_alliance: 0,
            updated_alliance: 0,
        };
    },
    methods: {
        updatePage() {
            setTimeout(this.getData, 200);
        },
        async getData() {
            this.loading = true;
            this.isLoading = true;
            const token = localStorage.getItem("token");

            if (token) {
                try {
                    const response = await axios.get(
                        "https://paneldecontrolem.cl/api/alliance/",
                        {
                            headers: {
                                Authorization: `Bearer ${token}`,
                                accept: "application/json",
                            },
                        }
                    );

                    this.posts = response.data.data;
                    this.loading = false;
                    this.isLoading = false;
                } catch (error) {
                    console.error("Error al obtener la lista de alianzas:", error);
                }
            } else {
                this.$router.push("/");
                this.isLoading = false;
                this.loading = false;
            }
        },
        deleteAlliance(id) {
            const token = localStorage.getItem("token");

            if (token) {
                if (confirm("¿Estás seguro de que deseas eliminar el registro?")) {
                    
                    const headers = {
                        Authorization: `Bearer ${token}`,
                        accept: "application/json",
                    };

                    this.$axios.delete("api/alliance/" + id, { headers }).then((res) => {
                        this.getData();
                    });
                }
            } else {
                this.$router.push("/");
            }
        },
    },
    async mounted() {
        this.created_alliance = localStorage.getItem(
            'created_alliance',
        )

        if (this.created_alliance == 1) {
            localStorage.removeItem('created_alliance')
        }

        this.updated_alliance = localStorage.getItem(
            'updated_alliance',
        )

        if (this.updated_alliance == 1) {
            localStorage.removeItem('updated_alliance')
        }

        this.getData();
    },
};
</script>
