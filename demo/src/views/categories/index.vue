<script setup>
import { ref, onMounted } from "vue";
import api from "../../api";

const categories = ref([]);
const loading = ref(true);

const fetchCategories = async () => {
  try {
    const response = await api.get("/api/categories");
    categories.value = response.data.data.data || [];
  } catch (error) {
    console.error("Error fetching categories:", error);
  } finally {
    loading.value = false;
  }
};

const deleteCategory = async (id) => {
  if (confirm("Are you sure you want to delete this category?")) {
    try {
      await api.delete(`/api/categories/${id}`);
      fetchCategories();
    } catch (error) {
      console.error("Error deleting category:", error);
    }
  }
};

onMounted(() => {
  fetchCategories();
});
</script>

<template>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="mb-4 text-start">
          <router-link to="/admin" class="btn btn-light">
            &larr; Back to Menu Admin
          </router-link>
        </div>
        <div class="d-flex justify-content-end mb-3">
          <router-link
            :to="{ name: 'categories.create' }"
            class="btn btn-md btn-soft-blue rounded shadow border-0 mb-3"
          >
            ADD NEW CATEGORY
          </router-link>
        </div>

        <div class="card border-0 rounded shadow">
          <div class="card-body bg-soft-blue">
            <div v-if="loading" class="text-center">
              <span>Loading categories...</span>
            </div>

            <table v-else class="table table-bordered">
              <thead class="bg-light-blue text-dark">
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Name</th>
                  <th scope="col" style="width: 15%">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-if="categories.length === 0">
                  <td colspan="3" class="text-center">
                    <div class="alert alert-danger mb-0">
                      No Data Available!
                    </div>
                  </td>
                </tr>
                <tr v-for="(category, index) in categories" :key="category.id">
                  <td>{{ category.id }}</td>
                  <td>{{ category.name }}</td>
                  <td class="text-center">
                    <router-link
                      :to="{ name: 'categories.edit', params: { id: category.id } }"
                      class="btn btn-sm btn-outline-soft-blue rounded-sm shadow border-0 me-2"
                    >
                      EDIT
                    </router-link>
                    <button
                      @click.prevent="deleteCategory(category.id)"
                      class="btn btn-sm btn-outline-danger rounded-sm shadow border-0"
                    >
                      DELETE
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.container {
  font-family: 'Arial', sans-serif;
}

.bg-soft-blue {
  background-color: #ffffff;
}

.bg-light-blue {
  background-color: #d0e8f2;
}

.text-dark {
  color: #333;
}

.text-white {
  color: white;
}

.btn-soft-blue {
  background-color: #ADD8E6;
  border-color: #ADD8E6;
  color: #003366;
}

.btn-soft-blue:hover {
  background-color: #90CAF9;
  border-color: #90CAF9;
}

.btn-outline-soft-blue {
  background-color: #ADD8E6;
  border-color: #ADD8E6;
  color: #003366;
}

.btn-outline-soft-blue:hover {
  background-color: #90CAF9;
  border-color: #90CAF9;
}

.btn-outline-danger {
  border-color: #cc3300;
  color: #cc3300;
}

.btn-outline-danger:hover {
  background-color: #cc3300;
  color: white;
}

.table {
  color: #333;
}

.table thead th {
  text-align: center;
}

.alert-danger {
  background-color: #ffcccc;
  color: #cc0000;
}

.card {
  border-radius: 10px;
  overflow: hidden;
}
</style>