<template>
  <section id="testimonials" class="testimonials">
    <div class="container">
      <h2>What Our Customers Say</h2>
      <div class="testimonial-list" id="testimonial-list">
        <div v-if="loading" class="loading-state">
          <p>Loading testimonials...</p>
        </div>
        <div v-else-if="error" class="error-state">
          <p>{{ error }}</p>
        </div>
        <div v-else-if="testimonials.length > 0" class="row">
          <div
            v-for="testimonial in testimonials"
            :key="testimonial.id"
            class="col-md-4 mb-4"
          >
            <div class="testimonial-card">
              <div class="testimonial-content">
                <p class="testimonial-text">"{{ testimonial.description }}"</p>
                <h3 class="testimonial-author">- {{ testimonial.name }}</h3>
                <p class="testimonial-category">
                  <strong>Genre:</strong> {{ getCategoryName(testimonial.category_id) }}
                </p>
                <p class="testimonial-dates">
                  <small>Posted: {{ formatDate(testimonial.created_at) }}</small>
                  <br />
                  <small v-if="testimonial.updated_at !== testimonial.created_at">
                    Updated: {{ formatDate(testimonial.updated_at) }}
                  </small>
                </p>
              </div>
            </div>
          </div>
        </div>
        <div v-else class="no-data-state">
          <p>No testimonials available yet.</p>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import { ref, onMounted } from 'vue';
import api from '../api';
export default {
  name: 'Testimonials',
  setup() {
    const testimonials = ref([]);
    const categories = ref([]);
    const loading = ref(true);
    const error = ref(null);
    const fetchTestimonials = async () => {
      try {
        const response = await api.get('/api/testimonis');
        testimonials.value = response.data.data.data;
        loading.value = false;
      } catch (err) {
        error.value = 'Failed to load testimonials. Please try again later.';
        loading.value = false;
      }
    };
    const fetchCategories = async () => {
      try {
        const response = await api.get('/api/categories');
        categories.value = response.data.data.data;
      } catch (err) {
        console.error('Error fetching categories:', err);
      }
    };
    const formatDate = (date) => {
      if (!date) return 'N/A';
      const options = { year: 'numeric', month: 'long', day: 'numeric' };
      return new Date(date).toLocaleDateString('en-US', options);
    };
    const getCategoryName = (categoryId) => {
      if (!categories.value.length) return 'Loading...';
      const category = categories.value.find(cat => cat.id === categoryId);
      return category ? category.name : 'Unknown';
    };
    onMounted(async () => {
      await Promise.all([fetchTestimonials(), fetchCategories()]);
    });
    return {
      testimonials,
      loading,
      error,
      formatDate,
      getCategoryName
    };
  }
};
</script>
<style scoped>
.testimonials {
  padding: 50px 0;
  background-color: #e3f2fd;
}
.testimonial-list {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  justify-content: center;
}
.testimonial-card {
  background-color: #ffffff;
  border-radius: 8px;
  padding: 25px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
  height: 100%;
  display: flex;
  flex-direction: column;
}
.testimonial-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}
.testimonial-content {
  flex: 1;
  display: flex;
  flex-direction: column;
}
.testimonial-text {
  font-style: italic;
  color: #555;
  font-size: 1.1em;
  line-height: 1.6;
  margin-bottom: 15px;
  flex: 1;
}
.testimonial-author {
  font-size: 1.2em;
  color: #333;
  font-weight: bold;
  margin: 10px 0;
}
.testimonial-category {
  color: #666;
  margin: 5px 0;
  font-size: 0.9em;
}
.testimonial-dates {
  color: #888;
  font-size: 0.85em;
  margin-top: auto;
}
.testimonials h2 {
  text-align: center;
  margin-bottom: 40px;
  font-size: 2.5em;
  font-weight: bold;
  color: #333;
}
.loading-state,
.error-state,
.no-data-state {
  text-align: center;
  padding: 40px;
  background: #fff;
  border-radius: 8px;
  width: 100%;
}
.error-state {
  color: #dc3545;
}
@media (max-width: 767px) {
  .testimonial-card {
    margin-bottom: 20px;
  }
  .testimonials h2 {
    font-size: 2em;
  }
  .testimonial-text {
    font-size: 1em;
  }
}
</style>