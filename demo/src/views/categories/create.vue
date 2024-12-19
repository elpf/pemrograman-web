<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import api from "../../api";

const name = ref("");
const errors = ref({});
const router = useRouter();

const storeCategory = async () => {
  try {
    await api.post("/api/categories", { name: name.value });
    router.push({ path: "/admin/categories" });
  } catch (error) {
    errors.value = error.response.data.errors || {};
  }
};
</script>

<template>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 rounded shadow">
          <div class="card-body">
            <form @submit.prevent="storeCategory">
              <div class="mb-3">
                <label class="form-label fw-bold">Category Name</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="name"
                  placeholder="Category Name"
                />
                <div v-if="errors.name" class="alert alert-danger mt-2">
                  <span>{{ errors.name[0] }}</span>
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