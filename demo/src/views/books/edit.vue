<script setup>

import { ref, onMounted, watch } from "vue";
import { useRouter, useRoute } from "vue-router";
import api from "../../api";


const router = useRouter();
const route = useRoute();


const image = ref(""); 
const title = ref(""); 
const author = ref(""); 
const genre = ref(""); 
const price = ref(""); 
const description = ref(""); 
const category_id = ref(""); 
const categories = ref([]); 
const errors = ref([]); 


onMounted(async () => {
  try {
   
    const bookResponse = await api.get(`/api/books/${route.params.id}`);
    const book = bookResponse.data.data;

    
    title.value = book.title;
    author.value = book.author;
    genre.value = book.genre;
    price.value = book.price;
    description.value = book.description;
    category_id.value = book.category_id;

    
    const categoryResponse = await api.get("/api/categories");
    categories.value = categoryResponse.data.data.data || []; 
    
  } catch (error) {
    console.error("Error fetching book data:", error);
  }
});


watch(genre, (newGenre) => {
  const selectedCategory = categories.value.find(
    (category) => category.name === newGenre
  );
  category_id.value = selectedCategory ? selectedCategory.id : category_id.value;
  console.log(category_id.value);
});


const handleFileChange = (e) => {
  image.value = e.target.files[0];
};


const updateBook = async () => {
  const formData = new FormData();

  
  formData.append("image", image.value); 
  formData.append("title", title.value);
  formData.append("author", author.value);
  formData.append("genre", genre.value);
  formData.append("price", price.value);
  formData.append("description", description.value);
  formData.append("category_id", category_id.value);
  formData.append("_method", "PATCH"); 

  try {
    
    await api.post(`/api/books/${route.params.id}`, formData);
    router.push({ path: "/admin/books" }); 
  } catch (error) {
    errors.value = error.response.data.errors; 
  }
};
</script>

<template>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 rounded shadow">
          <div class="card-body">
            <form @submit.prevent="updateBook">
              <!-- Book Image -->
              <div class="mb-3">
                <label class="form-label fw-bold">Image</label>
                <input type="file" class="form-control" @change="handleFileChange($event)">
                <div v-if="errors.image" class="alert alert-danger mt-2">
                  <span>{{ errors.image[0] }}</span>
                </div>
              </div>

              <!-- Book Title -->
              <div class="mb-3">
                <label class="form-label fw-bold">Title</label>
                <input type="text" class="form-control" v-model="title" placeholder="Book Title">
                <div v-if="errors.title" class="alert alert-danger mt-2">
                  <span>{{ errors.title[0] }}</span>
                </div>
              </div>

              <!-- Book Author -->
              <div class="mb-3">
                <label class="form-label fw-bold">Author</label>
                <input type="text" class="form-control" v-model="author" placeholder="Author Name">
                <div v-if="errors.author" class="alert alert-danger mt-2">
                  <span>{{ errors.author[0] }}</span>
                </div>
              </div>

              <!-- Book Description -->
              <div class="mb-3">
                <label class="form-label fw-bold">Description</label>
                <textarea class="form-control" v-model="description" rows="5" placeholder="Book Description"></textarea>
                <div v-if="errors.description" class="alert alert-danger mt-2">
                  <span>{{ errors.description[0] }}</span>
                </div>
              </div>

              <!-- Book Genre -->
              <div class="mb-3">
                <label class="form-label fw-bold">Genre</label>
                <select v-model="genre" class="form-select">
                  <option value="">Select Genre</option>
                  <option v-for="category in categories" :key="category.id" :value="category.name">
                    {{ category.name }}
                  </option>
                </select>
                <div v-if="errors.genre" class="alert alert-danger mt-2">
                  <span>{{ errors.genre[0] }}</span>
                </div>
              </div>

              <!-- Book Price -->
              <div class="mb-3">
                <label class="form-label fw-bold">Price</label>
                <input type="number" class="form-control" v-model="price" placeholder="Book Price">
                <div v-if="errors.price" class="alert alert-danger mt-2">
                  <span>{{ errors.price[0] }}</span>
                </div>
              </div>

              <!-- Book Category -->
              <div class="mb-3">
                <label class="form-label fw-bold">Category</label>
                <select v-model="category_id" class="form-select" disabled>
                  <option value="" disabled>Select Category</option>
                  <option v-for="category in categories" :key="category.id" :value="category.id">
                    {{ category.name }} (ID: {{ category.id }})
                  </option>
                </select>
                <div v-if="errors.category_id" class="alert alert-danger mt-2">
                  <span>{{ errors.category_id[0] }}</span>
                </div>
              </div>

              <!-- Submit Button -->
              <button type="submit" class="btn btn-md btn-primary rounded-sm shadow border-0">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
