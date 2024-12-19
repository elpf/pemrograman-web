<template>
  <div class="container mt-4" style="background-color: white; padding: 20px;">
    <div class="mb-4 text-start">
      <router-link to="/" class="btn btn-light">
        &larr; Back to Home
      </router-link>
    </div>
    <h2 class="text-center mb-4 text-black">Menu Admin</h2>
    <div class="row">
      <div class="col-12 mb-3">
        <div class="card" style="background-color: white;">
          <div class="card-body d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0" style="color: black;">Categories</h5>
            <router-link :to="{ name: 'categories.index' }" class="btn btn-menu">
              Go to Categories
            </router-link>
          </div>
        </div>
      </div>
      <div class="col-12 mb-3">
        <div class="card" style="background-color: white;">
          <div class="card-body d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0" style="color: black;">Books</h5>
            <router-link :to="{ name: 'books.index' }" class="btn btn-menu">
              Go to Books
            </router-link>
          </div>
        </div>
      </div>
      <div class="col-12 mb-3">
        <div class="card" style="background-color: white;">
          <div class="card-body d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0" style="color: black;">Testimonials</h5>
            <router-link :to="{ name: 'testimonials.index' }" class="btn btn-menu">
              Go to Testimonials
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
  .btn-menu {
    color: rgb(30, 54, 132); 
    background-color: #ADD8E6; 
    border-color: #ADD8E6;
    padding: 10px 20px;
    font-size: 16px;
    text-transform: uppercase;
  }
  
  .btn-menu:hover {
    background-color: #90CAF9;
    border-color: #90CAF9;
  }

  .btn-light {
    color: rgb(0, 0, 0); 
    padding: 8px 15px;
  }
  
  .btn-light:hover {
    background-color: #c4c4c4;
  }
</style>