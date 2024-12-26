<?php include('includes/header.php'); ?>
<?php include('includes/navbar.php'); ?>
<!DOCTYPE html>
<html>
<head>
<style>

.faq-section {
  padding: 6rem 1rem;
  background: url('C:\xampp\htdocs\Sultans\images\Spa.jpg') no-repeat center center/cover, 
              linear-gradient(135deg, #f0f4ff 0%, #e6eeff 50%, #f0f4ff 100%);
  min-height: 100vh;
  font-family: system-ui, -apple-system, sans-serif;
}



  .container {
    max-width: 900px;
    margin: 0 auto;
  }

  .faq-header {
    text-align: center;
    margin-bottom: 4rem;
    position: relative;
  }

  .faq-title {
    font-size: 3rem;
    color: #1a365d;
    margin-bottom: 1rem;
    position: relative;
    display: inline-block;
  }

  .faq-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 4px;
    background: linear-gradient(90deg, #3b82f6, #1d4ed8);
    border-radius: 2px;
  }

  .faq-list {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
  }

  .faq-item {
    background: rgba(255, 255, 255, 0.9);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
                0 2px 4px -1px rgba(0, 0, 0, 0.06);
    transition: all 0.3s ease;
  }

  .faq-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
                0 4px 6px -2px rgba(0, 0, 0, 0.05);
  }

  .faq-question {
    padding: 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
    background: white;
    border: none;
    width: 100%;
    text-align: left;
    font-size: 1.125rem;
    font-weight: 600;
    color: #1e40af;
    transition: all 0.3s ease;
  }

  .faq-question:hover {
    background: #f0f9ff;
  }

  .faq-question::after {
    content: '+';
    font-size: 1.5rem;
    color: #3b82f6;
    transition: transform 0.3s ease;
  }

  .faq-item.active .faq-question::after {
    transform: rotate(45deg);
  }

  .faq-answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
    background: white;
    color: #4b5563;
    line-height: 1.6;
  }

  .faq-item.active .faq-answer {
    max-height: 200px;
    padding: 1.5rem;
  }

  .feature-icons {
    display: flex;
    justify-content: center;
    gap: 3rem;
    margin-top: 4rem;
  }

  .feature-icon {
    width: 60px;
    height: 60px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
  }

  .feature-icon:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 8px -1px rgba(0, 0, 0, 0.15);
  }

  .cta-section {
    margin-top: 5rem;
    background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
    padding: 4rem 2rem;
    border-radius: 24px;
    text-align: center;
    color: white;
  }

  .cta-title {
    font-size: 2.5rem;
    margin-bottom: 1.5rem;
    font-weight: bold;
  }

  .cta-text {
    font-size: 1.125rem;
    margin-bottom: 2rem;
    opacity: 0.9;
  }

  .cta-button {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: white;
    color: #1e40af;
    padding: 1rem 2rem;
    border-radius: 9999px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 2px solid transparent;
  }

  .cta-button:hover {
    background: transparent;
    color: white;
    border-color: white;
  }
</style>
</head>
<body>

<section class="faq-section">
  <div class="container">
    <header class="faq-header">
      <h1 class="faq-title">Frequently Asked Questions</h1>
    </header>

    <div class="faq-list">
      <div class="faq-item">
        <button class="faq-question">What is the check-in and check-out time?</button>
        <div class="faq-answer">
          Check-in starts at 2:00 PM, and check-out is by 12:00 PM. Early check-in and late check-out are subject to availability.
        </div>
      </div>

      <div class="faq-item">
        <button class="faq-question">Do you offer airport shuttle services?</button>
        <div class="faq-answer">
          Yes, we provide airport shuttle services at an additional cost. Please contact us in advance for arrangements.
        </div>
      </div>

      <div class="faq-item">
        <button class="faq-question">Are pets allowed at the resort?</button>
        <div class="faq-answer">
          Unfortunately, pets are not allowed on the property to ensure the comfort of all guests.
        </div>
      </div>

      <div class="faq-item">
        <button class="faq-question">What activities are available at the resort?</button>
        <div class="faq-answer">
          We offer a variety of activities, including water sports, yoga sessions, and guided tours to nearby attractions.
        </div>
      </div>

      <div class="faq-item">
        <button class="faq-question">Do you offer special packages for families or couples?</button>
        <div class="faq-answer">
          Yes, we have tailored packages for families and couples, including honeymoon packages. Contact us for more details.
        </div>
      </div>
    </div>

    <div class="feature-icons">
      <div class="feature-icon">🏨</div>
      <div class="feature-icon">✈️</div>
      <div class="feature-icon">🍽️</div>
      <div class="feature-icon">💆</div>
    </div>

    <div class="cta-section">
      <h2 class="cta-title">Have More Questions?</h2>
      <p class="cta-text">Contact us today to learn more about our services and facilities!</p>
      <a href="about-us.php" class="cta-button">Contact Us 💬</a>
    </div>
  </div>

  <script>
    document.querySelectorAll('.faq-question').forEach(button => {
      button.addEventListener('click', () => {
        const faqItem = button.parentElement;
        const isActive = faqItem.classList.contains('active');
        
        // Close all FAQ items
        document.querySelectorAll('.faq-item').forEach(item => {
          item.classList.remove('active');
        });
        
        // Open clicked item if it wasn't active
        if (!isActive) {
          faqItem.classList.add('active');
        }
      });
    });
  </script>
</section>

</body>
</html>



