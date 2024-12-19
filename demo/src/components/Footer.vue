<!-- src/components/Footer.vue -->
<template>
    <footer class="footer">
      <div class="footer-container">
        <div class="footer-section">
          <h3>TokoBuku</h3>
          <p>Find and explore the best eBooks from all your favorite writers.</p>
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
  </template>
  
  <script>
  export default {
    name: "Footer",
  };
  </script>
  