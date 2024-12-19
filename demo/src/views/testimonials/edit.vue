<script setup>
import { ref, onMounted } from "vue";
import { useRouter, useRoute } from "vue-router";
import api from "../../api";
const router = useRouter();
const route = useRoute();
const image = ref(null);
const name = ref("");
const description = ref("");
const categoryId = ref("");
const categories = ref([]);
const errors = ref([]);
onMounted(async () => {
  try {
    const testimonialResponse = await api.get(`/api/testimonis/${route.params.id}`);
    const testimonial = testimonialResponse.data.data;
    name.value = testimonial.name;
    description.value = testimonial.description;
    categoryId.value = testimonial.category_id;
    const categoriesResponse = await api.get("/api/categories");
    categories.value = categoriesResponse.data.data;
  } catch (error) {
    console.error("Error fetching data:", error);
  }
});
const handleFileChange = (e) => {
  image.value = e.target.files[0];
};
const updateTestimonial = async () => {
  try {
    let formData = new FormData();
    if (image.value) formData.append("image", image.value);
    formData.append("name", name.value);
    formData.append("description", description.value);
    formData.append("category_id", categoryId.value);
    formData.append("_method", "PATCH");
    await api.post(`/api/testimonis/${route.params.id}`, formData);
    router.push({ path: "/admin/testimonials" });
  } catch (error) {
    if (error.response && error.response.data.errors) {
      errors.value = error.response.data.errors;
    }
  }
};
</script>
<template>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 rounded shadow">
          <div class="card-body">
            <form @submit.prevent="updateTestimonial">
              <div class="mb-3">
                <label class="form-label fw-bold">Image</label>
                <input
                  type="file"
                  class="form-control"
                  @change="handleFileChange"
                />
                <div v-if="errors.image" class="alert alert-danger mt-2">
                  <span>{{ errors.image[0] }}</span>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">Name</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="name"
                  placeholder="Name of the Testimonial"
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
                <select class="form-control" v-model="categoryId">
                  <option value="" disabled>Select Category</option>
                  <option
                    v-for="category in categories"
                    :key="category.id"
                    :value="category.id"
                  >
                    {{ category.name }}
                  </option>
                </select>
                <div v-if="errors.category_id" class="alert alert-danger mt-2">
                  <span>{{ errors.category_id[0] }}</span>
                </div>
              </div>
              <button
                type="submit"
                class="btn btn-md btn-primary rounded-sm shadow border-0"
              >
                Update
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>