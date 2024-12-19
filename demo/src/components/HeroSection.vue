<!-- src/components/HeroSection.vue -->
<template>
    <section id="home" class="hero">
      <div class="container hero-content">
        <div class="hero-text">
          <h1>Discover Your Next Great Read</h1>
          <p>
            Welcome to <strong>Toko Buku</strong>, where stories come alive!
            Browse our curated collection of books and find the perfect companion for your adventures.
          </p>
          <a href="#products" class="btn">Explore Our Collection</a>
        </div>
        <div class="hero-image">
          <img src="/frontend/assets/hero.png" alt="Books stacked on a table" />
        </div>
      </div>
    </section>
  </template>
  
  <script>
  export default {
    name: "HeroSection",
  };
  </script>
  