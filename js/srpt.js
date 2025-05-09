
// Header section
let menus = document.querySelector("nav");
let menuBtn = document.querySelector(".menu-btn");
let clsBtn = document.querySelector(".close-btn");

menuBtn.addEventListener("click",function(){
    menus.classList.add("active");
})

clsBtn.addEventListener("click",function(){
    menus.classList.remove("active");
})

// Hero section 
document.addEventListener('DOMContentLoaded', function() {
    const swiper = new Swiper('.swiper-container', {
        loop: true,
        autoplay: {
            delay: 5000,
        },
        effect: 'fade',
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        on: {
            slideChangeTransitionStart: function () {
                // Remove zoom-in class from all slides
                document.querySelectorAll('.swiper-slide').forEach(slide => {
                    slide.classList.remove('zoom-in');
                });

                // Remove fade-out class from all elements
                document.querySelectorAll('.animate-fade-in').forEach(el => {
                    el.classList.add('animate-fade-out');
                });
            },
            slideChangeTransitionEnd: function () {
                // Add zoom-in class to the current slide
                const currentSlide = document.querySelector('.swiper-slide-active');
                currentSlide.classList.add('zoom-in');

                // Apply fade-in animation to the new slide's text elements
                currentSlide.querySelectorAll('.section-subtitle, .hero-title, .hero-text, .btn-reservation').forEach(el => {
                    el.classList.remove('animate-fade-out');
                    el.classList.add('animate-fade-in');
                });
            }
        }
    });
});

//event slider swiper code
var swiper = new Swiper(".mySwiper", {
    slidesPerView: 3,
    spaceBetween: 30,
    slidesPerGroup: 3,
    loop: true,
    loopFillGroupWithBlank: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });


// Function to create countdown timers for the promotions
function countdownTimer(offerEndDate, elementId) {
    const countdownElement = document.getElementById(elementId);
    const offerEndTime = new Date(offerEndDate).getTime();

    const interval = setInterval(function() {
        const now = new Date().getTime();
        const distance = offerEndTime - now;

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        countdownElement.innerHTML = days + "d " + hours + "h " +
            minutes + "m " + seconds + "s ";

        // If the countdown ends, display "EXPIRED"
        if (distance < 0) {
            clearInterval(interval);
            countdownElement.innerHTML = "EXPIRED";
        }
    }, 1000);
}

// Initialize countdowns for each promotion
countdownTimer('Sep 30, 2024 23:59:59', 'countdown-sri-lankan'); // Sri Lankan Curry
countdownTimer('Oct 05, 2024 23:59:59', 'countdown-mexican'); // Mexican Salad
countdownTimer('Oct 10, 2024 23:59:59', 'countdown-chinese'); // Chinese Spring Rolls
countdownTimer('Oct 15, 2024 23:59:59', 'countdown-italian'); // Italian Pasta
countdownTimer('Oct 20, 2024 23:59:59', 'countdown-japanese'); // Japanese Tempura
countdownTimer('Oct 25, 2024 23:59:59', 'countdown-indian'); // Indian Butter Chicken


// Special food and beverages section
document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.card-btn');

    buttons.forEach(button => {
        button.addEventListener('click', () => {
        });
    });
});

function openPromo(evt, promoId) {
    // Hide all elements with class="tab-content"
    var tabContents = document.querySelectorAll('.tab-content');
    tabContents.forEach(content => {
        content.style.display = 'none';
    });

    // Remove the "active" class from all buttons
    var tabButtons = document.querySelectorAll('.tab-btn');
    tabButtons.forEach(btn => {
        btn.classList.remove('active');
    });

    // Show the current tab's content and add "active" class to the button
    document.getElementById(promoId).style.display = 'block';
    evt.currentTarget.classList.add('active');
}

// Set default tab to be open
document.addEventListener('DOMContentLoaded', () => {
    document.querySelector('.tab-btn').click(); // Simulates a click on the first tab to show its content
});



//chef section
    // Create a new IntersectionObserver instance
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('show');  // Add the 'show' class when the element is visible
            }
        });
    }, { threshold: 0.5 });

    // Target all chef cards
    const chefCards = document.querySelectorAll('.chef-card');

    // Observe each chef card
    chefCards.forEach(card => {
        observer.observe(card);
    });

//reviews section
const reviewWrapper = document.querySelector('.review-wrapper');
const reviews = Array.from(document.querySelectorAll('.review-card'));
const reviewsPerSlide = 2;
let currentIndex = 0;

function showReviews() {
    // Calculate the offset for sliding effect
    const offset = -((currentIndex % reviews.length) * 100) / reviewsPerSlide;

    // Apply transform to the review wrapper
    reviewWrapper.style.transform = `translateX(${offset}%)`;

    // Update the current index for the next slide
    currentIndex = (currentIndex + reviewsPerSlide) % reviews.length;
}

// Initialize the first set of reviews to show
showReviews();

// Set the interval for sliding through the reviews
setInterval(showReviews, 5000); // Change every 5 seconds






