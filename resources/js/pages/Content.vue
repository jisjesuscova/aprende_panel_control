<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 margin-left">
                        <h1>Contenidos</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">
                                <router-link
                                    to="/content/create"
                                    class="btn btn-block btn-success"
                                    >Agregar</router-link
                                >
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Buscar</h3>
                </div>
                <form @submit.prevent="submit">
                    <div class="card-body">
                        <div class="row mt-12">
                            <div class="col-md-6">
                                <label for="rut">
                                    Secciones
                                    </label
                                >
                                <select
                                    required
                                    v-model="section_input"
                                    class="form-control"
                                    @change="getCategories"
                                >
                                    <option value="">- Secciones -</option>
                                    <option v-for="section_post in section_posts" :key="section_post.id" :value="section_post.id">{{ section_post.title }}</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="rut">
                                    Categorias
                                    </label
                                >
                                <select
                                    required
                                    v-model="category_input"
                                    class="form-control"
                                >
                                    <option value="">- Contenidos -</option>
                                    <option v-for="category_post in category_posts" :key="category_post.id" :value="category_post.id">{{ category_post.title }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-12 w-full">
                                <button
                                    type="submit"
                                    class="btn btn-success mr-2"
                                >
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                    Buscar
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
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
                                    <div
                                        class="alert alert-success"
                                        role="alert"
                                        v-if="created_category == 1"
                                    >
                                        Registro agregado con
                                        <strong>éxito</strong>
                                    </div>
                                    <div
                                        class="alert alert-success"
                                        role="alert"
                                        v-if="updated_category == 1"
                                    >
                                        Registro actualizado con
                                        <strong>éxito</strong>
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
                                                :to="`/category/edit/${p.row.id}`"
                                                class="btn btn-success mr-2"
                                            >
                                                <i
                                                    class="fa-solid fa-pencil"
                                                ></i>
                                            </router-link>
                                            <a
                                                variant="danger"
                                                @click="deleteContent(p.row.id)"
                                                class="btn btn-danger mr-2"
                                            >
                                                <i
                                                    class="fa-solid fa-trash"
                                                ></i>
                                            </a>

                                            <a
                                                variant="warning"
                                                @click="moveDown(p.row.id)"
                                                v-if="p.row.position != posts.total"
                                                class="btn btn-warning mr-2"
                                            >
                                                <i class="fa-solid fa-arrow-down"></i>
                                            </a>

                                            <a
                                                variant="warning"
                                                @click="moveUp(p.row.id)"
                                                v-if="p.row.position != 1"
                                                class="btn btn-warning mr-2"
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
            isLoading: false,
            currentPage: 1,
            loading: false,
            created_alliance: 0,
            updated_alliance: 0,
            section_input: "",
            section_posts: [],
            category_posts: [],
            category_input: "",
        };
    },
    methods: {
        async copyPost(id) {
            const token = localStorage.getItem("token");

            if (token) {
                if (confirm("¿Estás seguro de que deseas copiar el contenido?")) {
                    try {
                        const response = await axios.get(
                            "https://paneldecontrolaprende.cl/api/content/copy/" + id,
                            {
                                headers: {
                                    Authorization: `Bearer ${token}`,
                                    accept: "application/json",
                                },
                            }
                        );
                        
                        this.submit();

                        this.audit(id, "Copiar Contenido");
                    } catch (error) {
                        console.error("Error al copiar el contenido:", error);
                    }
                }
            } else {
                this.$router.push("/login");
                this.isLoading = false;
                this.loading = false;
            }
        },
        async moveDown(id) {
            const token = localStorage.getItem("token");
            
            if (token) {
                try {
                    const response = await axios.get(
                        "https://paneldecontrolaprende.cl/api/content/move_down/" + this.section_input + "/" + this.category_input + "/" + id,
                        {
                            headers: {
                                Authorization: `Bearer ${token}`,
                                accept: "application/json",
                            },
                        }
                    );

                    
                    try {
                        const response = await axios.get(
                            "https://paneldecontrolaprende.cl/api/content/search/" + this.section_input + "/" + this.category_input,
                            {
                                headers: {
                                    Authorization: `Bearer ${token}`,
                                    accept: "application/json",
                                },
                            }
                        );

                        this.posts = response.data.data;

                        this.audit(id, "Mover Contenido Abajo");

                    } catch (error) {
                        console.error("Error al obtener la lista de contenidos:", error);
                    }
                } catch (error) {
                    console.error("Error al mover el contenido:", error);
                }
            } else {
                this.$router.push("/login");
                this.isLoading = false;
                this.loading = false;
            }
        },
        async moveUp(id) {
            const token = localStorage.getItem("token");
            
            if (token) {
                try {
                    const response = await axios.get(
                        "https://paneldecontrolaprende.cl/api/content/move_up/" + this.section_input + "/" + this.category_input + "/" + id,
                        {
                            headers: {
                                Authorization: `Bearer ${token}`,
                                accept: "application/json",
                            },
                        }
                    );

                    
                    try {
                        const response = await axios.get(
                            "https://paneldecontrolaprende.cl/api/content/search/" + this.section_input + "/" + this.category_input,
                            {
                                headers: {
                                    Authorization: `Bearer ${token}`,
                                    accept: "application/json",
                                },
                            }
                        );

                        this.posts = response.data.data;

                        this.audit(id, "Mover Contenido Arriba");

                    } catch (error) {
                        console.error("Error al obtener la lista de contenidos:", error);
                    }
                } catch (error) {
                    console.error("Error al mover el contenido:", error);
                }
            } else {
                this.$router.push("/login");
                this.isLoading = false;
                this.loading = false;
            }
        },
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
                        "https://paneldecontrolaprende.cl/api/content/",
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

                    this.audit(0, "Listar Contenidos");
                } catch (error) {
                    console.error(
                        "Error al obtener la lista de contenidos:",
                        error
                    );
                }
            } else {
                this.$router.push("/login");
                this.isLoading = false;
                this.loading = false;
            }
        },
        async getSections() {
            const token = localStorage.getItem("token");

            if (token) {
                try {
                    const response = await axios.get(
                        "https://paneldecontrolaprende.cl/api/section/all",
                        {
                            headers: {
                                Authorization: `Bearer ${token}`,
                                accept: "application/json",
                            },
                        }
                    );

                    this.section_posts = response.data.data;
                } catch (error) {
                    console.error(
                        "Error al obtener la lista de secciones:",
                        error
                    );
                }
            } else {
                this.$router.push("/login");
                this.isLoading = false;
                this.loading = false;
            }
        },
        async getCategories() {
            const token = localStorage.getItem("token");

            if (token) {
                try {
                    const response = await axios.get(
                        "https://paneldecontrolaprende.cl/api/category/all/" + this.section_input,
                        {
                            headers: {
                                Authorization: `Bearer ${token}`,
                                accept: "application/json",
                            },
                        }
                    );

                    this.category_posts = response.data.data;
                } catch (error) {
                    console.error(
                        "Error al obtener la lista de categorias:",
                        error
                    );
                }
            } else {
                this.$router.push("/login");
                this.isLoading = false;
                this.loading = false;
            }
        },
        async submit() {
            this.loading = true;
            this.isLoading = true;
            const token = localStorage.getItem("token");

            if (token) {
                try {
                    const response = await axios.get(
                        "https://paneldecontrolaprende.cl/api/content/search/" + this.section_input + "/" + this.category_input,
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

                    this.audit(0, "Buscar Contenido");
                } catch (error) {
                    console.error(
                        "Error al obtener la lista de secciones:",
                        error
                    );
                }
            } else {
                this.$router.push("/login");
                this.isLoading = false;
                this.loading = false;
            }
        },
        deleteContent(id) {
            const token = localStorage.getItem("token");
            
            if (token) {
                if (confirm("¿Estás seguro de que deseas eliminar el registro?")) {
                    
                    const headers = {
                        Authorization: `Bearer ${token}`,
                        accept: "application/json",
                    };

                    this.$axios
                        .delete("api/content/" + id, { headers })
                        .then((res) => {
                            this.submit();
                            this.audit(id, "Eliminar Contenido");
                        });
                }
            } else {
                this.$router.push("/login");
                this.isLoading = false;
                this.loading = false;
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
        this.created_category = localStorage.getItem("created_category");

        if (this.created_category == 1) {
            localStorage.removeItem("created_category");
        }

        this.updated_category = localStorage.getItem("updated_category");

        if (this.updated_category == 1) {
            localStorage.removeItem("updated_category");
        }

        this.getSections();
    },
};
</script>
