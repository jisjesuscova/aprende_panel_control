<template>
    <div>
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
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
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Crear Contenido</h3>
                                </div>
                                <form @submit.prevent="submit">
                                    <div class="card-body">
                                        <div class="row mt-12">
                                            <div class="col-md-6">
                                                <label for="rut"
                                                    >Sección
                                                    <span class="text-danger"
                                                        >*</span
                                                    ></label
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
                                                <label for="rut"
                                                    >Categorias
                                                    <span class="text-danger"
                                                        >*</span
                                                    ></label
                                                >
                                                <select
                                                    required
                                                    v-model="category_input"
                                                    class="form-control"
                                                    v-on:change="getCategoryQuantities"
                                                >
                                                    <option value="">- Categorias -</option>
                                                    <option v-for="category_post in category_posts" :key="category_post.id" :value="category_post.id">{{ category_post.title }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-3">
                                                <label for="rut"
                                                    >Título
                                                    <span class="text-danger"
                                                        >*</span
                                                    ></label
                                                >
                                                <input
                                                    required
                                                    type="text"
                                                    class="form-control"
                                                    v-model="title_input"
                                                    placeholder="Título"
                                                    aria-label="Título"
                                                />
                                            </div>
                                            <div class="col-md-3">
                                                <label for="alliance_name"
                                                    >Sub-título
                                                    <span class="text-danger"
                                                        >*</span
                                                    ></label
                                                >
                                                <input
                                                    required
                                                    type="text"
                                                    class="form-control"
                                                    v-model="subtitle_input"
                                                    placeholder="Nombre del Sub-título"
                                                    aria-label="Nombre del Sub-título"
                                                />
                                            </div>
                                            <div class="col-md-3">
                                                <label for="alliance_alias"
                                                    >Google Tag
                                                    <span class="text-danger"
                                                        >*</span
                                                    ></label
                                                >
                                                <input
                                                    required
                                                    type="text"
                                                    class="form-control"
                                                    v-model="google_tag_input"
                                                    placeholder="Google Tag"
                                                    aria-label="Google Tag"
                                                />
                                            </div>
                                            <div class="col-md-3">
                                                <label for="alliance_contact"
                                                    >Posición
                                                    <span class="text-danger"
                                                        >*</span
                                                    ></label
                                                >
                                                <input
                                                    required
                                                    type="number"
                                                    class="form-control"
                                                    v-model="position_input"
                                                    placeholder="Posición"
                                                    aria-label="Posición"
                                                />
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-4">
                                                <label for="icon_status_input"
                                                    >Color del botón
                                                       <span
                                                        class="text-danger"
                                                        >*</span
                                                    ></label
                                                >
                                                <br>
                                                <ColorPicker @color-change="updateColor" :visible-formats="['rgb']" />
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="icon_type_input"
                                                    >Fecha de inicio
                                                    <span class="text-danger"
                                                        >*</span
                                                    >
                                                    </label
                                                >
                                                <input
                                                    required
                                                    type="date"
                                                    class="form-control"
                                                    v-model="start_date_input"
                                                    placeholder="Fecha de inicio"
                                                    aria-label="Fecha de inicio"
                                                />
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="alliance_phone"
                                                    >Fecha de fin
                                                    <span class="text-danger"
                                                        >*</span
                                                    >
                                                    </label
                                                >
                                                <input
                                                    required
                                                    type="date"
                                                    class="form-control"
                                                    v-model="end_date_input"
                                                    placeholder="Fecha de fin"
                                                    aria-label="Fecha de fin"
                                                />
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-4">
                                                <label for="icon_status_input"
                                                    >¿Tiene icono?
                                                       <span
                                                        class="text-danger"
                                                        >*</span
                                                    ></label
                                                >
                                                <select
                                                    required
                                                    v-model="icon_status_input"
                                                    class="form-control"
                                                >
                                                    <option value="">
                                                        - ¿Tiene icono? -
                                                    </option>
                                                    <option value="1">Si</option>
                                                    <option value="2">No</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4" v-if="this.icon_status_input == 1">
                                                <label for="icon_type_input"
                                                    >Tipo de icono</label
                                                >
                                                <select class="form-control"
                                                v-model="icon_type_input"
                                                >
                                                    <option value="">- Tipo de icono -</option>
                                                    <option value="1">Icono fa</option>
                                                    <option value="2">Imagen</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4" v-if="this.icon_status_input == 1 && this.icon_type_input == 1">
                                                <label for="alliance_phone"
                                                    >Icono fa - <a href="https://fontawesome.com/icons" target="_blank" class="text-danger">Ver Iconos</a></label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="fa_icon_input"
                                                    placeholder="Icono fa"
                                                    aria-label="Icono fa"
                                                />
                                            </div>
                                            <div class="col-sm-4" v-if="this.icon_status_input == 1 && this.icon_type_input == 2">
                                                <label for="icon_image"
                                                    >Imagen</label
                                                >
                                                <input ref="image" accept=".png" type="file" class="form-control" v-on:change="onFileChangeIconImage">
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="row mt-12">
                                            <div class="col-md-12">
                                                <label for="content_type_input"
                                                    >Tipo de botón
                                                       <span
                                                        class="text-danger"
                                                        >*</span
                                                    ></label
                                                >
                                                <select
                                                    v-model="content_type_input"
                                                    class="form-control"
                                                >
                                                    <option value="">
                                                        Normal
                                                    </option>
                                                    <option value="1">Video</option>
                                                    <option value="2">Audio</option>
                                                    <option value="3">Texto</option>
                                                    <option value="4">Pdf</option>
                                                    <option value="5">Iframe</option>
                                                    <option value="6">Llamada</option>
                                                    <option value="7">Página Externa</option>
                                                    <option value="8">Aplicación</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-4" v-if="this.content_type_input == 1 
                                        || this.content_type_input == 2 
                                        || this.content_type_input == 3
                                        || this.content_type_input == 4
                                        || this.content_type_input == 5
                                        || this.content_type_input == 6
                                        || this.content_type_input == 7
                                        || this.content_type_input == 8
                                        ">
                                            <div class="col-md-12">
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="row mt-4" v-if="this.content_type_input == 1">
                                            <div class="col-md-8">
                                                <label for="content_type_input"
                                                    >Descripción</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="video_description_input"
                                                    placeholder="Descripción"
                                                    aria-label="Descripción"
                                                />
                                            </div>
                                            <div class="col-md-2">
                                                <label for="content_type_input"
                                                    >Tipo de Video</label
                                                >
                                                <select
                                                    v-model="video_type_input"
                                                    class="form-control"
                                                >
                                                    <option value="">
                                                        - Tipo de Video -
                                                    </option>
                                                    <option value="1">Vimeo</option>
                                                    <option value="2">Youtube</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="content_type_input"
                                                    >Id del Video</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="video_id_input"
                                                    placeholder="Id del video"
                                                    aria-label="Id del video"
                                                />
                                            </div>
                                        </div>
                                        <div class="row mt-4" v-if="this.content_type_input == 2">
                                            <div class="col-md-6">
                                                <label for="content_type_input"
                                                    >Descripción</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="src_description_input"
                                                    placeholder="Descripción"
                                                    aria-label="Descripción"
                                                />
                                            </div>
                                            <div class="col-md-6">
                                                <label for="content_type_input"
                                                    >Src</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="audio_src_input"
                                                    placeholder="Src"
                                                    aria-label="Src"
                                                />
                                            </div>
                                        </div>
                                        <div class="row mt-12" v-if="this.content_type_input == 3">
                                            <div class="col-md-12">
                                                <label for="content_type_input"
                                                    >Texto</label
                                                >
                                                <vue-editor v-model="text_description" ref="editor"></vue-editor>
                                            </div>
                                            
                                        </div>
                                        <div class="row mt-4" v-if="this.content_type_input == 4">
                                            <div class="col-md-8">
                                                <label for="pdf_description_input"
                                                    >Descripción</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="pdf_description_input"
                                                    placeholder="Descripción"
                                                    aria-label="Descripción"
                                                />
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="pdf"
                                                    >Pdf</label
                                                >
                                                <input ref="image" accept=".pdf" type="file" class="form-control" v-on:change="onFileChangePdf">
                                            </div>
                                        </div>
                                        <div class="row mt-4" v-if="this.content_type_input == 5">
                                            <div class="col-md-6">
                                                <label for="iframe_description_input"
                                                    >Descripción</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="iframe_description_input"
                                                    placeholder="Descripción"
                                                    aria-label="Descripción"
                                                />
                                            </div>
                                            <div class="col-md-6">
                                                <label for="iframe_url_input"
                                                    >Url</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="iframe_url_input"
                                                    placeholder="Url"
                                                    aria-label="Url"
                                                />
                                            </div>
                                        </div>
                                        <div class="row mt-12" v-if="this.content_type_input == 6">
                                            <div class="col-md-12">
                                                <label for="phone_input"
                                                    >Teléfono</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="phone_input"
                                                    placeholder="Teléfono"
                                                    aria-label="Teléfono"
                                                />
                                            </div>
                                        </div>
                                        <div class="row mt-12" v-if="this.content_type_input == 7">
                                            <div class="col-md-12">
                                                <label for="url_external_page_input"
                                                    >Url a página externa</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="url_external_page_input"
                                                    placeholder="Url a página externa"
                                                    aria-label="Url a página externa"
                                                />
                                            </div>
                                        </div>
                                        <div class="row mt-12" v-if="this.content_type_input == 8">
                                            <div class="col-md-3">
                                                <label for="app_type_input"
                                                    >¿Qué método va a utilizar?</label
                                                >
                                                <select
                                                    v-model="app_type_input"
                                                    class="form-control"
                                                >
                                                    <option value="">
                                                        - ¿Qué método va a utilizar? -
                                                    </option>
                                                    <option value="1">URL</option>
                                                    <option value="2">URI</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3" v-if="this.app_type_input == 1">
                                                <label for="app_type_input"
                                                    >Url de la app</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="url_app_input"
                                                    placeholder="Url de la app"
                                                    aria-label="Url de la app"
                                                />
                                            </div>
                                            <div class="col-md-3" v-if="this.app_type_input == 2">
                                                <label for="app_type_input"
                                                    >Uri de la app</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="uri_app_input"
                                                    placeholder="Uri de la app"
                                                    aria-label="Uri de la app"
                                                />
                                            </div>
                                            <div class="col-md-3" v-if="this.app_type_input == 1 || this.app_type_input == 2">
                                                <label for="app_type_input"
                                                    >Url si es computador</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="url_desktop_app_input"
                                                    placeholder="Url si es computador"
                                                    aria-label="Url si es computador"
                                                />
                                            </div>
                                            <div class="col-md-3" v-if="this.app_type_input == 1 || this.app_type_input == 2">
                                                <label for="app_type_input"
                                                    >Url si no está instalada</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="url_not_installed_app_input"
                                                    placeholder="Url si no está instalada"
                                                    aria-label="Url si no está instalada"
                                                />
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-4">
                                                <label for="georeferencing_type_input"
                                                    >¿Tiene georeferenciación?
                                                       <span
                                                        class="text-danger"
                                                        >*</span
                                                    ></label
                                                >
                                                <select
                                                    required
                                                    v-model="georeferencing_type_input"
                                                    class="form-control"
                                                >
                                                    <option value="">
                                                        - ¿Tiene georeferenciación? -
                                                    </option>
                                                    <option value="1">Si</option>
                                                    <option value="2">No</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4" v-if="this.georeferencing_type_input == 1">
                                                <label for="region_input"
                                                    >Región</label
                                                >
                                                <select class="form-control"
                                                v-model="region_input" multiple
                                                @change="getCommunes"
                                                >
                                                    <option value="">Todas las regiones</option>
                                                    <option v-for="region_post in region_posts" :key="region_post.id" :value="region_post.id">{{ region_post.region }}</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4" v-if="this.georeferencing_type_input == 1">
                                                <label for="commune_input"
                                                    >Comuna</label
                                                >
                                                <select class="form-control"
                                                v-model="commune_input" multiple
                                                >
                                                    <option value="">Todas las comunas</option>
                                                    <option v-for="commune_post in commune_posts" :key="commune_post.id" :value="commune_post.id">{{ commune_post.commune }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="row mt-12" v-if="this.content_type_input == 1 
                                        || this.content_type_input == 2
                                        || this.content_type_input == 3
                                        || this.content_type_input == 4
                                        || this.content_type_input == 5
                                        ">
                                            <div class="col-md-6">
                                                <label for="whatsapp_type_input"
                                                    >¿El enlace de compartir de Whatsapp es personalizado? <span
                                                        class="text-danger"
                                                        >*</span
                                                    ></label
                                                >
                                                <select class="form-control"
                                                v-model="whatsapp_type_input"
                                                >
                                                    <option value="2">No</option>
                                                    <option value="1">Si</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6" v-if="this.whatsapp_type_input == 1">
                                                <label for="whatsapp_url_input"
                                                    >Url del whatsapp</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="whatsapp_url_input"
                                                    placeholder="Url del whatsapp"
                                                    aria-label="Url del whatsapp"
                                                />
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
                                                    <i
                                                        class="fa-solid fa-check"
                                                    ></i>
                                                    Guardar
                                                </button>

                                                <router-link
                                                    href="javascript:;"
                                                    to="/contents"
                                                    class="btn btn-danger ml-2"
                                                >
                                                    <i
                                                        class="fa-solid fa-remove"
                                                    ></i>
                                                    Cancelar
                                                </router-link>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mask } from "vue-the-mask";
import { VueEditor } from "vue3-editor";
import { ColorPicker } from 'vue-accessible-color-picker'
import "vue-accessible-color-picker/styles"

export default {
    directives: { mask },
    components: {
        VueEditor,
        ColorPicker
    },
    data() {
        return {
            loading: true,
            title_input: "",
            subtitle_input: "",
            google_tag_input: "",
            position_input: "",
            georeferencing_type_input: "",
            region_input: "",
            commune_input: "",
            region_posts: [],
            commune_posts: [],
            icon_status_input: "",
            icon_type_input: "",
            fa_icon_input: "",
            icon_image: "",
            noIconImage: 0,
            content_type_input: "",
            video_description_input: "",
            video_type_input: "",
            video_id_input: "",
            src_description_input: "",
            audio_src_input: "",
            text_description: "",
            pdf_description_input: "",
            pdf: "",
            noPdf: 0,
            iframe_description_input: "",
            iframe_url_input: "",
            phone_input: "",
            url_external_page_input: "",
            app_type_input: "",
            url_app_input: "",
            uri_app_input: "",
            url_desktop_app_input: "",
            url_not_installed_app_input: "",
            color: '#000000',
            start_date_input: "",
            end_date_input: "",
            whatsapp_type_input: 2,
            whatsapp_url_input: "",
            quantity: 0,
            section_input: "",
            section_posts: [],
            category_input: "",
            category_posts: [],
        };
    },
    methods: {
        updateColor (eventData) {
            this.color = eventData.colors.hex
        },
        onFileChangePdf(e){
            this.pdf = e.target.files[0];
            this.noPdf = e.target.files.length;
        },
        onFileChangeIconImage(e){
            this.icon_image = e.target.files[0];
            this.noIconImage = e.target.files.length;
        },
        async getCategoryQuantities() {
            this.loading = true;
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

                    this.quantity = response.data.data.total;
                    this.quantity = this.quantity + 1;
                    this.position_input = this.quantity;
                    this.loading = false;
                } catch (error) {
                    console.error("Error al obtener la cantidad de contenidos:", error);
                }
            } else {
                this.$router.push("/login");
                this.loading = false;
            }
        },
        async getRegions() {
            this.loading = true;
            const token = localStorage.getItem("token");

            if (token) {
                try {
                    const response = await axios.get(
                        "https://paneldecontrolaprende.cl/api/region/",
                        {
                            headers: {
                                Authorization: `Bearer ${token}`,
                                accept: "application/json",
                            },
                        }
                    );

                    this.region_posts = response.data.data;
                    this.loading = false;
                } catch (error) {
                    console.error("Error al obtener la lista de regiones:", error);
                }
            } else {
                this.$router.push("/login");
                this.loading = false;
            }
        },
        async getCommunes() {
            const token = localStorage.getItem("token");

            this.commune_posts = []

            var region_data = String(this.region_input);

            const region_ids = region_data.split(',');

            if (token) {
                for (const region_id of region_ids) {
                    try {
                        const response = await axios.get(
                            "https://paneldecontrolaprende.cl/api/commune/" + region_id,
                                {
                                    headers: {
                                        Authorization: `Bearer ${token}`,
                                        accept: "application/json",
                                    },
                                }
                            );

                        this.commune_posts = this.commune_posts.concat(response.data.data);
                    } catch (error) {
                        console.error("Error al obtener la lista de comunas:", error);
                    }
                }
            } else {
                this.$router.push("/login");
                this.loading = false;
            }
        },
        async submit() {
            this.loading = true;
            const token = localStorage.getItem("token");

            if(token) {
                const formData = new FormData();

                formData.append("section_id", this.section_input);
                formData.append("category_id", this.category_input);
                formData.append("status_id", 1);
                formData.append("title", this.title_input);
                formData.append("subtitle", this.subtitle_input);
                formData.append("google_tag", this.google_tag_input);
                formData.append("position", this.position_input);
                formData.append("color", this.color);
                formData.append("start_date", this.start_date_input);
                formData.append("end_date", this.end_date_input);
                formData.append("georeferencing_type_id", this.georeferencing_type_input);
                formData.append("region_id", this.region_input);
                formData.append("commune_id", this.commune_input);
                formData.append("icon_status_id", this.icon_status_input);
                formData.append("icon_type_id", this.icon_type_input);
                formData.append("icon_image", this.icon_image);
                formData.append("fa_icon", this.fa_icon_input);
                formData.append("content_type_id", this.content_type_input);
                formData.append("video_description", this.video_description_input);
                formData.append("video_type_id", this.video_type_input);
                formData.append("video_id", this.video_id_input);
                formData.append("src_description", this.src_description_input);
                formData.append("audio_src", this.audio_src_input);
                formData.append("text_description", this.text_description);
                formData.append("pdf_description", this.pdf_description_input);
                formData.append("pdf", this.pdf);
                formData.append("iframe_description", this.iframe_description_input);
                formData.append("iframe_url", this.iframe_url_input);
                formData.append("phone", this.phone_input);
                formData.append("url_external_page", this.url_external_page_input);
                formData.append("app_type_id", this.app_type_input);
                formData.append("url_app", this.url_app_input);
                formData.append("uri_app", this.uri_app_input);
                formData.append("url_desktop_app", this.url_desktop_app_input);
                formData.append("url_not_installed_app", this.url_not_installed_app_input);
                formData.append("whatsapp_type_id", this.whatsapp_type_input);
                formData.append("whatsapp_url", this.whatsapp_url_input);

                try {
                    const response = await axios.post(
                        "https://paneldecontrolaprende.cl/api/content/store",
                        formData,
                        {
                            headers: {
                                Authorization: `Bearer ${token}`,
                                "Content-Type": "multipart/form-data",
                            },
                        }
                    );

                    this.posts = response.data.data;
                    this.loading = false;

                    localStorage.setItem("created_content", 1);

                    this.$router.push("/contents");
                } catch (error) {
                    console.error("Error al guardar el contenido:", error);
                }
            } else {
                this.$router.push("/login");
                this.loading = false;
            }
        },
        async getSections() {
            this.loading = true;
            this.isLoading = true;
            const token = localStorage.getItem("token");

            if(token) {
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
                    this.loading = false;
                    this.isLoading = false;
                } catch (error) {
                    console.error(
                        "Error al obtener la lista de secciones:",
                        error
                    );
                }
            } else {
                this.$router.push("/login");
                this.loading = false;
                this.isLoading = false;
            }
        },
        async getCategories() {
            this.loading = true;
            this.isLoading = true;
            const token = localStorage.getItem("token");

            if(token) {
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
        
                    console.log(response.data)
                    this.category_posts = response.data.data;
                    this.loading = false;
                    this.isLoading = false;
                } catch (error) {
                    console.error(
                        "Error al obtener la lista de categorias:",
                        error
                    );
                }
            } else {
                this.$router.push("/login");
                this.loading = false;
                this.isLoading = false;
            }
        },
    },
    async mounted() {
        setTimeout(() => {
            this.loading = false;
        }, 5000);

        await this.getRegions();
        await this.getSections();
    },
};
</script>
<style scoped>
.text-info {
    color: #d7da27 !important;
    font-size: 20px !important;
}
</style>
