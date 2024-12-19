<template>
  <div>
    <!-- Navbar -->
    <nav class="navbar">
      <div class="container">
        <a href="#" class="logo">TokoBuku</a>
        <ul class="nav-links">
          <li><a href="#home">Home</a></li>
          <li><a href="#products">Products</a></li>
          <li><a href="#testimonials">Testimonials</a></li>
          <li><a href="#about">About Us</a></li>
          <li><a href="/admin" class="btn">Login</a></li>
        </ul>
      </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
      <div class="container hero-content">
        <div class="hero-text">
          <h1>Discover Your Next Great Read</h1>
          <p>
            Welcome to <strong>Toko Buku</strong>, where stories come alive! 
            Browse our curated collection of books and find the perfect companion for your adventures. 
            From thrilling novels to inspiring non-fiction, we have it all.
          </p>
          <a href="#products" class="btn">Explore Our Collection</a>
        </div>
       
        <div class="hero-image">
          <img src="../assets/hero.png" alt="Books stacked on a table" />
        </div>
      </div>
    </section>

    <!-- Features Section -->
    <section>
      <div class="features">
        <div class="feature-item">
          <i class="icon icon-shipping"></i>
          <h3>Free Shipping</h3>
          <p>Order More Than $100</p>
        </div>
        <div class="feature-item">
          <i class="icon icon-secure"></i>
          <h3>Secure Payment</h3>
          <p>100% Secure Payment</p>
        </div>
        <div class="feature-item">
          <i class="icon icon-support"></i>
          <h3>24/7 Support</h3>
          <p>Call us anytime</p>
        </div>
      </div>
    </section>

    <!-- Products Section -->

    <section id="products" class="products">
      <div class="container">
        
        
         <Products />
      </div>
    </section>
   
    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials">
      <div class="container">
        
        
        <Testimonials />
      </div>
    </section>

    <!-- About Us Section -->
    <section id="about" class="about">
      <div class="container about-content">
        <div class="about-text">
          <h2>About Us</h2>
          <p>
            At <strong>Toko Buku</strong>, we believe in the power of stories to inspire, 
            educate, and connect people. Our mission is to provide an exceptional collection 
            of books, handpicked for readers of all ages and interests.
          </p>
          <p>
            Whether you’re searching for the latest bestsellers, timeless classics, or hidden gems, 
            we’re here to make your reading journey memorable. Join our community of book lovers 
            and let’s explore the world, one page at a time!
          </p>
          <p><strong>Discover your next adventure with us!</strong></p>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
      <div class="footer-container">
        <div class="footer-section">
          <h3>TokoBuku</h3>
          <p>
            Find and explore the best eBooks from all your favorite writers.
          </p>
        </div>
        <div class="footer-section">
          <h4>About</h4>
          <ul>
            <li><a href="#">Awards</a></li>
            <li><a href="#">FAQs</a></li>
            <li><a href="#">Privacy policy</a></li>
            <li><a href="#">Terms of services</a></li>
          </ul>
        </div>
        <div class="footer-section">
          <h4>Company</h4>
          <ul>
            <li><a href="#">Blogs</a></li>
            <li><a href="#">Community</a></li>
            <li><a href="#">Our team</a></li>
            <li><a href="#">Help center</a></li>
          </ul>
        </div>
        <div class="footer-section">
          <h4>Contact</h4>
          <address>
            Surabaya, Indonesia<br />
            <a href="mailto:e.book@email.com">tokobuku@email.com</a><br />
            0987-654-321
          </address>
        </div>
      </div>
      <div class="footer-bottom">
        <span class="footer__copy"> &#169; All Rights Reserved 2024</span>
      </div>
    </footer>
  </div>
</template>


<script>
import Products from '../components/Products.vue'; 
import Testimonials from '../components/Testimonials.vue';  

export default {
  name: 'Home',
  components: {
    Products,  Testimonials  
  }
};
</script>


<style scoped>
/* Add your styles here or import external CSS */
body {
  font-family: 'Arial', sans-serif;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  background-color: #ffffff; 
  color: #333333; 
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 15px;
}

.navbar {
  z-index: 1000;
  width: 100%;
  position: fixed;
  background-color: #e3f2fd; 
  padding: 10px 20px; 
  display: flex;
  justify-content: center; 
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.navbar .container {
  display: flex;
  justify-content: space-between; 
  align-items: center; 
  width: 100%; 
  max-width: 1200px; 
}

.navbar .logo {
  font-size: 1.8rem;
  font-weight: bold;
  color: #0056b3; 
  text-decoration: none;
}

.nav-links {
  list-style: none;
  display: flex;
  gap: 20px;
  margin: 0;
  padding: 0;
  justify-content: center; 
  align-items: center; 
}


.nav-links li a {
  color: #333333; 
  text-decoration: none;
  font-size: 1rem;
  transition: color 0.3s;
}

.nav-links li a:hover {
  color: #007bff; 
}

.nav-links .btn {
  background-color: #0056b3; 
  color: #ffffff; 
  padding: 8px 15px;
  border-radius: 30px; 
  font-weight: bold;
  transition: background-color 0.3s, transform 0.3s; 
  border: none; 
  cursor: pointer;
}

.nav-links .btn:hover {
  color: #ffffff;
  background-color: #007bff; 
  transform: translateY(-3px); 
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
}

.nav-links .btn:focus {
  outline: none; 
  box-shadow: 0 0 10px rgba(255, 87, 34, 0.6); 
}

.nav-links .btn.active {
  background-color: #ff5722; 
  transform: translateY(0); 
}

.hero {
  background-color: #e3f2fd; 
  padding: 100px 20px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.hero-content {
  display: flex;
  align-items: center;
  justify-content: space-between;
  max-width: 1200px;
  margin: 0 auto;
  gap: 30px; 
  flex-wrap: wrap; 
}

.hero-text {
  max-width: 600px;
  text-align: left;
}

.hero-text h1 {
  font-size: 3rem;
  color: #0056b3;
  margin-bottom: 20px;
}

.hero-text p {
  font-size: 1.2rem;
  color: #333;
  margin-bottom: 30px;
}

.hero-text .btn {
  padding: 10px 20px; 
  font-size: 16px;
  font-weight: bold;
  color: white;
  background-color: #0056b3; 
  border: none;
  border-radius: 30px; 
  cursor: pointer;
  transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s; 
  text-decoration: none;
}

.hero-text .btn:hover {
  background-color: #007bff;
  transform: translateY(-3px);
  box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
}

.hero-text .btn:active {
  transform: translateY(0);
  box-shadow: 0 4px 10px rgba(255, 87, 34, 0.4);
}

.hero-text .btn:focus {
  outline: none;
  box-shadow: 0 0 10px rgba(255, 87, 34, 0.6);
}

.hero-image {
  flex: 1;
  max-width: 500px;
}

.hero-image img {
  max-width: 100%;
  height: auto;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.features {
  display: flex;
  justify-content: space-around;
  align-items: center;
  background-color: #e3f2fd;
  padding: 20px;
}

.feature-item {
  text-align: center;
  color: #1a202c;
}

.feature-item i {
  font-size: 2rem;
  color: #667eea;
  margin-bottom: 10px;
}

.feature-item h3 {
  font-size: 1.2rem;
  margin: 5px 0;
  font-weight: bold;
}

.feature-item p {
  font-size: 0.9rem;
  color: #718096;
}

.icon-shipping::before {
  content: "\1F69A";
}

.icon-secure::before {
  content: "\1F512";
}

.icon-support::before {
  content: "\1F5E3";
}


.products {
  padding: 30px 10px;
  text-align: center;
  background-color: #e3f2fd;
}





.testimonials {
  background-color: #e3f2fd;
  padding: 50px 20px;
  text-align: center;
}

.testimonials h2 {
  font-size: 2.5rem;
  margin-bottom: 20px;
  color: #333333;
}

.testimonial-list {
  display: flex;
  gap: 20px;
  justify-content: center;
  flex-wrap: wrap;
}

.testimonial-card {
  background: #ffffff;
  padding: 20px;
  margin-bottom: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  width: 250px;
  text-align: center;
  transition: background 0.3s ease;
  color: #555555;
}

.testimonial-card p {
  font-style: italic;
  color: #555555;
  margin-bottom: 10px;
}

.testimonial-card h3 {
  color: #333333;
  font-weight: bold;
}

.testimonial-dates {
  font-size: 0.9em;
  color: #555555;
  margin-top: 10px;
}

.testimonial-dates small {
  display: block;
  margin-top: 5px;
  color: #555555;
}

.about {
  padding: 50px 20px;
  padding-bottom: 200px;
  background-color: #e3f2fd;
}

.about-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 30px;
  flex-wrap: wrap;
}

.about-text {
  text-align: center;
}

.about-text h2 {
  font-size: 2.5rem;
  margin-bottom: 20px;
  color: #333;
  font-weight: bold;
}

.about-text p {
  font-size: 1.1rem;
  line-height: 1.8;
  color: #555;
  margin-bottom: 15px;
}

.about-content-inner {
  display: flex;
  justify-content: center;
  gap: 30px;
  align-items: center;
}

.about-image img {
  max-width: 100%;
  height: auto;
  border-radius: 10px;
  box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
  max-width: 400px;
}

.about-text p {
  text-align: left;
}

.footer {
  background-color: #0056b3;
  padding: 20px 0;
  color: #ececec;
  font-size: 14px;
}

.footer-container {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

.footer-section {
  flex: 1;
  margin: 0 10px;
}

.footer-section h3 {
  color: #ececec;
  margin-bottom: 10px;
  font-size: 18px;
}

.footer-section h4 {
  margin-bottom: 10px;
  font-size: 16px;
}

.footer-section ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.footer-section ul li {
  margin-bottom: 5px;
}

.footer-section ul li a {
  text-decoration: none;
  color: #ececec;
}

.footer-section ul li a:hover {
  text-decoration: underline;
  color: #e3f2fd;
}

.footer-section address a {
  text-decoration: none;
  color: #ececec;
}

.footer-section address a:hover {
  text-decoration: underline;
}

.footer-section address {
  line-height: 1.6;
}

.footer-bottom {
  bottom: 0;
  width: 100%;
  background-color: #0056b3;
  text-align: center;
  padding: 40px 0 10px 0;
  font-size: 0.9rem;
  color: #ececec;
  font-weight: bold;
}

@media (max-width: 768px) {
  .navbar .container {
      flex-direction: column;
      align-items: flex-start;
  }

  .navbar .logo {
      font-size: 1.5rem;
  }

  .nav-links {
      flex-direction: column;
      gap: 10px;
  }

  .hero {
      padding: 50px 20px;
  }

  .hero-content {
      flex-direction: column;
      text-align: center;
  }

  .hero-text h1 {
      font-size: 2.5rem;
  }

  .hero-text p {
      font-size: 1rem;
  }

  .hero-image img {
      max-width: 80%;
  }

  .products {
      padding: 30px 10px;
  }

  .product-list {
      flex-direction: column;
      gap: 15px;
  }

  .product-card {
      width: 100%;
  }

  .testimonial-list {
      flex-direction: column;
  }

  .about-content {
      flex-direction: column;
  }

  .about-image img {
      max-width: 100%;
  }

  .footer-container {
      flex-direction: column;
      text-align: center;
  }

  .footer-section {
      margin-bottom: 15px;
  }

  .footer-bottom {
      font-size: 0.8rem;
  }
}
</style>
