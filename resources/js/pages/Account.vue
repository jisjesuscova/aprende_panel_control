<template>
  <div>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 text-center">
            <img :src="`../../template/dist/img/logo.jpg`" id="home_logo" alt="Logo Home">
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  components: {
  },
  created() {
    this.audit();
  },
  methods: {
    async audit() {
      const token = localStorage.getItem("token");

      const id = localStorage.getItem("id");
      
      if (token) {
        const formData = new FormData();

        formData.append("user_id", id);
        formData.append("task_id", '0');
        formData.append("task", 'Página Principal');

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
}
</script>