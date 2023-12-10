<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 margin-left">
                        <h1>Secciones</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">
                                <router-link
                                    to="/section/create"
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
                                    <div class="alert alert-success" role="alert" v-if="created_section == 1">
                                        Registro agregado con <strong>éxito</strong>
                                    </div>
                                    <div class="alert alert-success" role="alert" v-if="updated_section == 1">
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
                                            field="position"
                                            label="Orden"
                                            numeric
                                            v-slot="p"
                                        >
                                            {{ p.row.position }}
                                        </o-table-column>
                                        <o-table-column
                                            field="title"
                                            label="Titulo"
                                            v-slot="p"
                                        >
                                            {{ p.row.title }}
                                        </o-table-column>
                                        <o-table-column
                                            field=""
                                            label=""
                                            v-slot="p"
                                        >
                                            <a
                                                @click="copyPost(p.row.id)"
                                                class="btn btn-info mr-2"
                                            >
                                                <i class="fa-solid fa-plus"></i>
                                            </a>
                                         
                                            <router-link
                                                :to="`/section/edit/${p.row.id}`"
                                                class="btn btn-success mr-2"
                                            >
                                                <i class="fa-solid fa-pencil"></i>
                                            </router-link>
                                            <a
                                                @click="deleteSection(p.row.id)"
                                                class="btn btn-danger mr-2"
                                            >
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                           
                                            <a
                                                @click="moveDown(p.row.id)"
                                                v-if="p.row.position != posts.total"
                                                class="btn btn-warning mr-2"
                                            >
                                                <i class="fa-solid fa-arrow-down"></i>
                                            </a>
                                    
                                            <a
                                                @click="moveUp(p.row.id)"
                                                v-if="p.row.position != 1"
                                                class="btn btn-warning"
                                            >
                                                <i class="fa-solid fa-arrow-up"></i>
                                            </a>
                                            
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

            try {
                const response = await axios.get(
                    "https://paneldecontrolaprende.cl/api/section?page="+this.currentPage,
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

                this.audit(0, 'Secciones');
            } catch (error) {
                console.error("Error al obtener la lista de secciones:", error);
            }
        },
        async copyPost(id) {
            if (confirm("¿Estás seguro de que deseas copiar la sección?")) {
                const token = localStorage.getItem("token");
                
                try {
                    const response = await axios.get(
                        "https://paneldecontrolaprende.cl/api/section/copy/" + id,
                        {
                            headers: {
                                Authorization: `Bearer ${token}`,
                                accept: "application/json",
                            },
                        }
                    );

                    this.audit(id, 'Copiar Sección');
                } catch (error) {
                    console.error("Error al copiar la sección:", error);
                }
            }
        },
        async moveDown(id) {
            const token = localStorage.getItem("token");
            
            try {
                const response = await axios.get(
                    "https://paneldecontrolaprende.cl/api/section/move_down/" + id,
                    {
                        headers: {
                            Authorization: `Bearer ${token}`,
                            accept: "application/json",
                        },
                    }
                );

                
                try {
                    const response = await axios.get(
                        "https://paneldecontrolaprende.cl/api/section/",
                        {
                            headers: {
                                Authorization: `Bearer ${token}`,
                                accept: "application/json",
                            },
                        }
                    );

                    this.posts = response.data.data;
                    this.audit(id, 'Mover Sección Abajo');

                } catch (error) {
                    console.error("Error al obtener la lista de secciones:", error);
                }
            } catch (error) {
                console.error("Error al mover la sección:", error);
            }
        },
        async moveUp(id) {
            const token = localStorage.getItem("token");
            
            try {
                const response = await axios.get(
                    "https://paneldecontrolaprende.cl/api/section/move_up/" + id,
                    {
                        headers: {
                            Authorization: `Bearer ${token}`,
                            accept: "application/json",
                        },
                    }
                );

                try {
                    const response = await axios.get(
                        "https://paneldecontrolaprende.cl/api/section/",
                        {
                            headers: {
                                Authorization: `Bearer ${token}`,
                                accept: "application/json",
                            },
                        }
                    );

                    this.posts = response.data.data;
                    this.audit(id, 'Mover Sección Arriba');

                } catch (error) {
                    console.error("Error al obtener la lista de secciones:", error);
                }
            } catch (error) {
                console.error("Error al mover la sección:", error);
            }
        },
        deleteSection(id) {
            if (confirm("¿Estás seguro de que deseas eliminar el registro?")) {
                const token = localStorage.getItem("token");
                const headers = {
                    Authorization: `Bearer ${token}`,
                    accept: "application/json",
                };

                this.$axios.delete("api/section/" + id, { headers }).then((res) => {
                    this.getData();
                    this.audit(id, 'Borrar Sección');
                });
            }
        },
        async audit(task_id, task) {
            const token = localStorage.getItem("token");

            const id = localStorage.getItem("id");
            
            if (token) {
                const formData = new FormData();

                formData.append("user_id", id);
                formData.append("task_id", task_id);
                formData.append("task", task);

                try {
                const response = await axios.post(
                        "https://paneldecontrolaprende.cl/api/audit/store",
                        formData,
                        {
                            headers: {
                            Authorization: `Bearer ${token}`,
                            "Content-Type": "multipart/form-data",
                            },
                        }
                        );
                } catch (error) {
                console.error("Error al guardar la auditoría:", error);
                }
            } else {
                this.$router.push("/login");
            }
        },
    },
    async mounted() {
        this.created_section = localStorage.getItem(
            'created_section',
        )

        if (this.created_section == 1) {
            localStorage.removeItem('created_section')
        }

        this.updated_section = localStorage.getItem(
            'updated_section',
        )

        if (this.updated_section == 1) {
            localStorage.removeItem('updated_section')
        }

        this.getData();
    },
};
</script>
