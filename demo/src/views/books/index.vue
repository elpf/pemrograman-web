<template>
  <div class="container mt-5 mb-5">
    <div class="row">
      <div class="col-md-12">

        <div class="mb-4 text-start">
          <router-link to="/admin" class="btn btn-light">
            &larr; Back to Menu Admin
          </router-link>
        </div>
        <div class="d-flex justify-content-end mb-3">
          <router-link
            :to="{ name: 'books.create' }"
            class="btn btn-md btn-soft-blue rounded shadow border-0"
          >
            ADD NEW BOOK
          </router-link>
        </div>

        <!-- Tabel Buku -->
        <div class="card border-0 rounded shadow">
          <div class="card-body bg-soft-blue">
            <table class="table table-bordered">
              <thead class="bg-light-blue text-dark">
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Image</th>
                  <th scope="col">Title</th>
                  <th scope="col">Author</th>
                  <th scope="col">Genre</th>
                  <th scope="col">Price</th>
                  <th scope="col">Category</th>
                  <th scope="col">Description</th>
                  <th scope="col" style="width: 15%">Actions</th>
                </tr>
              </thead>
              <tbody>
                <!-- Jika Tidak Ada Data -->
                <tr v-if="books.length === 0">
                  <td colspan="9" class="text-center">
                    <div class="alert alert-danger mb-0">
                      Data Not Available!
                    </div>
                  </td>
                </tr>

                
                <tr v-else v-for="(book, index) in books" :key="index">
                  <td>{{ book.id }}</td>
                  <td class="text-center">
                    <img
                      :src="book.image"
                      alt="Book Image"
                      width="100"
                      class="rounded-3"
                    />
                  </td>
                  <td>{{ book.title }}</td>
                  <td>{{ book.author }}</td>
                  <td>{{ book.genre || "No Genre" }}</td>
                  <td>{{ book.price | currency }}</td>
                  <td>{{ book.category_id || "No Category" }}</td>
                  <td>{{ book.description || "No Description" }}</td>
                  <td class="text-center">
                    <!-- Tombol Edit -->
                    <router-link
                      :to="{ name: 'books.edit', params: { id: book.id } }"
                      class="btn btn-sm btn-outline-soft-blue rounded-sm shadow me-2"
                    >
                      EDIT
                    </router-link>

                    <!-- Tombol Hapus -->
                    <button
                      @click.prevent="deleteBook(book.id)"
                      class="btn btn-sm btn-outline-danger rounded-sm shadow"
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

<script setup>
import { ref, onMounted } from "vue";
import api from "../../api";

const books = ref([]);

const fetchDataBooks = async () => {
  try {
    const response = await api.get("/api/books");
    books.value = response.data.data.data;
  } catch (error) {
    console.error("Error fetching books:", error);
  }
};

onMounted(() => {
  fetchDataBooks();
});

const deleteBook = async (id) => {
  if (confirm("Are you sure you want to delete this book?")) {
    try {
      await api.delete(`/api/books/${id}`);
      fetchDataBooks();
    } catch (error) {
      console.error("Error deleting book:", error);
    }
  }
};
</script>

<style scoped>
.container {
  font-family: "Arial", sans-serif;
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
  background-color: #add8e6;
  border-color: #add8e6;
  color: #003366; 
}

.btn-soft-blue:hover {
  background-color: #90caf9;
  border-color: #90caf9;
}

.btn-outline-soft-blue {
  background-color: #add8e6; 
  border-color: #add8e6;
  color: #003366;
}

.btn-outline-soft-blue:hover {
  background-color: #90caf9;
  border-color: #90caf9;
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
