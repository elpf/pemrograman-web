document.querySelectorAll(".nav-links a").forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault();
      const targetId = this.getAttribute("href").substring(1);
      const targetSection = document.getElementById(targetId);
  
      if (targetSection) {
        window.scrollTo({
          top: targetSection.offsetTop - 50,
          behavior: "smooth",
        });
      }
    });
  });
  
  function fetchTestimonials() {
      fetch("http://localhost:8000/api/testimoni")
        .then((response) => response.json())
        .then((data) => {
          if (data.code === 200) {
            const testimonialList = document.getElementById("testimonial-list");
            testimonialList.innerHTML = "";
    
            data.data.forEach((testimonial) => {
              const testimonialCard = document.createElement("div");
              testimonialCard.classList.add("testimonial-card");
    
              testimonialCard.innerHTML = `
                <p>"${testimonial.description}"</p>
                <h3>- ${testimonial.name}</h3>
                <p class="testimonial-dates">
                  <small>Created: ${new Date(testimonial.created_at).toLocaleDateString()}</small><br>
                  <small>Updated: ${new Date(testimonial.updated_at).toLocaleDateString()}</small>
                </p>
              `;
    
              testimonialList.appendChild(testimonialCard);
            });
          } else {
            console.error("Failed to load testimonials");
          }
        })
        .catch((error) => console.error("Error fetching testimonials:", error));
    }
    
    let booksData = [];
    function fetchBooks() {
      return fetch("http://localhost:8000/api/books")
        .then((response) => response.json())
        .then((data) => {
          booksData = data.data;
          displayProducts("all");
        })
        .catch((error) => {
          console.error("Error fetching books:", error);
        });
    }
    
    function displayProducts(genre = "all") {
      const productList = document.getElementById("product-list");
      productList.innerHTML = "";
    
      const filteredBooks =
        genre === "all"
          ? booksData
          : booksData.filter(
              (book) => book.genre.toLowerCase() === genre.toLowerCase()
            );
    
      if (filteredBooks.length > 0) {
        filteredBooks.forEach((book) => {
          const productCard = document.createElement("div");
          productCard.classList.add("product-card");
    
          productCard.innerHTML = `
          
            <img class="product-image" src="${book.image}" alt="${book.title}" />
            <h3>${book.title}</h3>
            <p><strong>Author:</strong> ${book.author}</p>
            <p><strong>Genre:</strong> ${book.genre}</p>
            <p>${book.description}</p>
            <p><strong>Price:</strong> $${book.price}</p>
            <button class="cart-btn">Add to Cart</button>
          `;
          productList.appendChild(productCard);
        });
      } else {
        productList.innerHTML = "<p>No products available for this genre.</p>";
      }
    }
    
    document.querySelectorAll(".category-btn").forEach((button) => {
      button.addEventListener("click", () => {
        document.querySelectorAll(".category-btn").forEach((btn) => btn.classList.remove("active"));
        button.classList.add("active");
    
        const genre = button.getAttribute("data-genre");
        displayProducts(genre);
      });
    });
    
    document.addEventListener("DOMContentLoaded", () => {
      fetchBooks();
      fetchTestimonials();
    });
    
    document.getElementById("refresh-data").addEventListener("click", () => {
      fetchBooks();
      fetchTestimonials();
    });
    
    setInterval(() => {
      fetchBooks();
      fetchTestimonials();
    }, 5000);