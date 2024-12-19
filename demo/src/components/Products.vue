<template>
  <section id="products" class="products">
    <div class="container">
      <h2>Our Products</h2>

      <div class="category-list">
        <button
          v-for="genre in genres"
          :key="genre"
          class="category-btn"
          :class="{ active: selectedGenre === genre }"
          @click="changeGenre(genre)"
          :data-genre="genre"
        >
          {{ genre.charAt(0).toUpperCase() + genre.slice(1) }}
        </button>
      </div>

      <div>
        <div class="product-list" id="product-list" v-if="filteredBooks.length > 0">
          <div
            v-for="book in filteredBooks"
            :key="book.id"
            class="product-card"
          >
            <img class="product-image" :src="book.image" :alt="book.title" />
            <h3>{{ book.title }}</h3>
            <p><strong>Author:</strong> {{ book.author }}</p>
            <p><strong>Genre:</strong> {{ book.genre || "No Genre" }}</p>
            <p>{{ book.description || "No Description" }}</p>
            <p><strong>Price:</strong> ${{ book.price }}</p>
            <button class="cart-btn">Add to Cart</button>
          </div>
        </div>
        <p v-else>No products available for this genre.</p>
      </div>
    </div>
  </section>
</template>

<script>
import { ref, onMounted } from "vue";

export default {
  name: "Products",
  setup() {
    const genres = ref(["all"]);
    const selectedGenre = ref("all");
    const booksData = ref([]);
    const filteredBooks = ref([]);

    const fetchBooks = async () => {
      try {
        const response = await fetch("http://localhost:7000/api/books");
        const data = await response.json();
        booksData.value = data.data.data;

        const bookGenres = new Set(booksData.value.map((book) => book.genre).filter(Boolean));
        genres.value = ["all", ...bookGenres];

        filterBooks();
      } catch (error) {
        console.error("Error fetching books:", error);
      }
    };

    const filterBooks = () => {
      filteredBooks.value =
        selectedGenre.value === "all"
          ? booksData.value
          : booksData.value.filter(
              (book) =>
                book.genre &&
                book.genre.toLowerCase() === selectedGenre.value.toLowerCase()
            );
    };

    const changeGenre = (genre) => {
      selectedGenre.value = genre;
      filterBooks();
    };

    onMounted(() => {
      fetchBooks();
    });

    return {
      genres,
      selectedGenre,
      filteredBooks,
      changeGenre,
    };
  },
};
</script>

<style scoped>
.category-list {
  margin-bottom: 20px;
}

.category-btn {
  padding: 10px 20px;
  margin: 5px;
  background-color: #0056b3;
  border: 2px solid #0056b3;
  border-radius: 5px;
  color: #ffffff;
  font-size: 1rem;
  cursor: pointer;
  transition: all 0.3s ease;
}

.category-btn.active,
.category-btn:hover {
  background-color: #007bff;
  border: 2px solid #007bff;
  color: #ffffff;
}

.product-card {
  background: #ffffff;
  padding: 15px;
  border-radius: 12px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  width: 220px;
  text-align: center;
  color: #333333;
  position: relative;
  overflow: hidden;
  transition:
    transform 0.3s ease,
    box-shadow 0.3s ease;
}

.product-card:hover {
  transform: scale(1.05);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
}

.product-image {
  width: 120px;
  height: 160px;
  object-fit: cover;
  border-radius: 10px;
  margin-bottom: 10px;
}

.product-title {
  font-size: 1rem;
  font-weight: bold;
  margin-bottom: 5px;
}

.product-author {
  font-size: 0.8rem;
  color: #555555;
  margin-bottom: 5px;
}

.product-description {
  font-size: 0.8rem;
  color: #777777;
  margin-bottom: 5px;
}

.product-price {
  font-size: 1rem;
  color: #0056b3;
  font-weight: bold;
  margin-bottom: 10px;
}

.product-card h3 {
  font-size: 1rem;
  font-weight: bold;
  color: #333333;
  margin: 5px 0;
}

.product-card p {
  font-size: 0.8rem;
  color: #555555;
  margin: 8px 5px;
}

.products {
  padding: 30px 10px;
  text-align: center;
  background-color: #e3f2fd;
}

.product-list {
  display: flex;
  gap: 20px;
  justify-content: center;
  flex-wrap: wrap;
  flex-direction: column;
  gap: 15px;
  display: grid;
  grid-template-columns: repeat(3, 1fr);
}

.cart-btn {
  padding: 8px 16px;
  background-color: #0056b3;
  color: #ffffff;
  border: none;
  border-radius: 5px;
  font-size: 0.9rem;
  cursor: pointer;
  margin-top: 10px;
  align-self: center;
  transition: background-color 0.3s ease;
}

.cart-btn:hover {
  background-color: #007bff;
}

.products h2 {
  font-size: 2.5rem;
  margin-bottom: 20px;
  color: #333333;
  font-weight: bold;
}

.product-list {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
  justify-content: center;
  margin-top: 20px;
}

.product-card {
  background: #ffffff;
  padding: 15px;
  border-radius: 12px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  text-align: center;
  color: #333333;
  position: relative;
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

@media (max-width: 1024px) {
  .product-list {
    grid-template-columns: repeat(3, 1fr);
  }
}

@media (max-width: 768px) {
  .product-list {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 480px) {
  .product-list {
    grid-template-columns: 1fr;
  }
}
</style>