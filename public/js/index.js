document.addEventListener("DOMContentLoaded", function() {
    const animatedDivs = document.querySelectorAll('.Animated');
    animatedDivs.forEach((div, index) => {
      div.classList.add('animated-showup');
      if (index === animatedDivs.length - 1) {
        div.classList.add('animated-reveal');
        const span = div.querySelector('span');
        span.parentElement.classList.add('animated-slidein');
      }
    });
  });