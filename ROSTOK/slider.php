<!-- Подключаем CSS слайдера -->
<link rel="stylesheet" href="/assets/css/simple-adaptive-slider_old.css">
<!-- Подключаем JS слайдера -->
<script defer src="/assets/js/simple-adaptive-slider_old.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
  // инициализация слайдера
  var slider_ad = new SimpleAdaptiveSlider('#slider_ad', {
    loop: true,
    autoplay: true,
    interval: 4000,
    swipe: true
  });
});
</script>


<!-- Разметка слайдера -->
<div class="slider unselectable" id="slider_ad">
  <div class="slider__wrapper">
    <div class="slider__items">
      <div class="slider__item">
        <div style="height: 250px; background: #3f51b5;">
          <img class="img-fluid" src="/assets/images/grade.jpg" alt="..." width=100% height="250" loading="lazy">
        </div>
      </div>
      <div class="slider__item">
        <div style="height: 250px; background: #607d8b;">
          <img class="img-fluid" src="/assets/images/dilivery.jpg" alt="..." width=100% height="250" loading="lazy">
        </div>
      </div>
      <div class="slider__item">
        <div style="height: 250px; background: #f44336;">
          <img class="img-fluid" src="/assets/images/climate.jpg" alt="..." width=100% height="250" loading="lazy">
        </div>
      </div>
      <div class="slider__item">
        <div style="height: 250px; background: #4caf50;">
          <img class="img-fluid" src="/assets/images/st1.jpg" alt="..." width=100% height="250" loading="lazy">
        </div>
      </div>
    </div>
  </div>
  <a class="slider__control slider__control_prev" href="#" role="button" data-slide="prev"></a>
  <a class="slider__control slider__control_next" href="#" role="button" data-slide="next"></a>
</div>
