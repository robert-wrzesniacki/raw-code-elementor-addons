var $ = jQuery;
function heading_script() {

}


function opinions_script() {
  if(!document.querySelector('.rcode-opinions-container.style-2.swiper')){
    return;
  }
    var param_opinions = JSON.parse(document.querySelector('.rcode-opinions-container.style-2.swiper').getAttribute('data-swiper'));

    var slider_opinions_options = {
        slidesPerView: 1,
        spaceBetween: 50,
        autoplay: param_opinions.autoplay,
        speed: param_opinions.speed,
        loop: param_opinions.loop,
        effect: 'slide',
        direction: 'horizontal',
        autoplay: {
            delay: param_opinions.delay,
            disableOnInteraction: false,
          }, 
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    }

    const opinions_swiper = new Swiper('.rcode-opinions-container.style-2.swiper', slider_opinions_options);

}
function clients_script() {

  if(!document.querySelector('.rcode-clients-container.style-2.swiper')){
    return;
  }
    var param_client = JSON.parse(document.querySelector('.rcode-clients-container.style-2.swiper').getAttribute('data-swiper'));

    var slider_clients_options = {
        autoplay: param_client.autoplay,
        speed: param_client.speed,
        loop: param_client.loop,
        effect: 'slide',
        direction: 'horizontal',
        autoplay: {
            delay: param_client.delay,
            disableOnInteraction: false,
          }, 
        breakpoints: {
            640: {
              slidesPerView: param_client.slide_m,
              spaceBetween: param_client.space_m,
            },
            768: {
              slidesPerView: param_client.slide_t,
              spaceBetween: param_client.space_t,
            },
            1024: {
              slidesPerView: param_client.slide_d,
              spaceBetween: param_client.space_d,
            },
        },
       
    }

    const clients_swiper = new Swiper('.rcode-clients-container.style-2.swiper', slider_clients_options);


}

function goback_btn_script(){
  jQuery(document).ready(function() {
    jQuery('.rcode-icon-link .go-back-btn').on('click', function() {
      window.history.go(-1); 
      return false;
    });
});
}



$(function() { 

    heading_script(); 
    opinions_script();
    clients_script();
    goback_btn_script();

})

      