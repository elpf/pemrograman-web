<script setup>
import { ref, onMounted, watch } from "vue";
import { useRouter } from "vue-router";
import api from "../../api";
const router = useRouter();
const name = ref("");
const description = ref("");
const categoryId = ref("");
const userId = ref("");
const categories = ref([]);
const users = ref([]);
const genre = ref("");
const errors = ref([]);
const fetchCategories = async () => {
  try {
    const response = await api.get("/api/categories");
    categories.value = response.data.data.data;
  } catch (error) {
    console.error("Error fetching categories:", error);
  }
};
const fetchUsers = async () => {
  try {
    const response = await api.get("/api/users");
    users.value = response.data.data.data;
  } catch (error) {
    console.error("Error fetching users:", error);
  }
};
watch(userId, (newUserId) => {
  const selectedUser = users.value.find((user) => user.id === newUserId);
  if (selectedUser) {
    name.value = selectedUser.name;
  } else {
    name.value = "";
  }
});
watch(genre, (newGenre) => {
  const selectedCategory = categories.value.find((category) => category.name === newGenre);
  categoryId.value = selectedCategory ? selectedCategory.id : "";
});
const storeTestimonial = async () => {
  try {
    let formData = new FormData();
    formData.append("name", name.value);
    formData.append("description", description.value);
    formData.append("category_id", categoryId.value);
    formData.append("user_id", userId.value);
    await api.post("/api/testimonis", formData);
    router.push({ path: "/admin/testimonials" });
  } catch (error) {
    if (error.response && error.response.data.errors) {
      errors.value = error.response.data.errors;
    }
  }
};
onMounted(() => {
  fetchCategories();
  fetchUsers();
});
</script>
<template>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 rounded shadow">
          <div class="card-body">
            <form @submit.prevent="storeTestimonial">
              <div class="mb-3">
                <label class="form-label fw-bold">Name</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="name"
                  placeholder="Name of the Testimonial"
                  disabled
                />
                <div v-if="errors.name" class="alert alert-danger mt-2">
                  <span>{{ errors.name[0] }}</span>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">Description</label>
                <textarea
                  class="form-control"
                  v-model="description"
                  rows="5"
                  placeholder="Description of the Testimonial"
                ></textarea>
                <div v-if="errors.description" class="alert alert-danger mt-2">
                  <span>{{ errors.description[0] }}</span>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">Category</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="categoryId"
                  placeholder="Category ID"
                  disabled
                />
                <div v-if="errors.category_id" class="alert alert-danger mt-2">
                  <span>{{ errors.category_id[0] }}</span>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">Genre</label>
                <select class="form-control" v-model="genre">
                  <option value="" disabled>Select Genre</option>
                  <option
                    v-for="category in categories"
                    :key="category.id"
                    :value="category.name"
                  >
                    {{ category.name }}
                  </option>
                </select>
                <div v-if="errors.genre" class="alert alert-danger mt-2">
                  <span>{{ errors.genre[0] }}</span>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">User</label>
                <select class="form-control" v-model="userId">
                  <option value="" disabled>Select User</option>
                  <option v-for="user in users" :key="user.id" :value="user.id">
                    {{ user.id }}
                  </option>
                </select>
                <div v-if="errors.user_id" class="alert alert-danger mt-2">
                  <span>{{ errors.user_id[0] }}</span>
                </div>
              </div>
              <button
                type="submit"
                class="btn btn-md btn-primary rounded-sm shadow border-0"
              >
                Save
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>