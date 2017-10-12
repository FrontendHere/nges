$(document).ready(function () {

	var heightMap = $(window).height() - $('.footer').innerHeight();

	/*if($(window).height() > 659 && $(window).width() > 1199 ){
		$('.map').css('height', heightMap);
	}*/
	
	//Открытие, закрытие окна описания конкретной продукции
	$('.catalog-item').click(function() {		
		$(this).next().css('display', 'block');
	});
	$('.catalog-item-description__close').click(function() {
		$(this).parent().css('display', 'none');
	});

	//Открытие, закрытие окна описания конкретной продукции на мобилке
	if(window.matchMedia('(max-width: 767px)').matches)
	{
		var flag = 0;
		$('.catalog-item').click(function() {			
			if(flag == 0){	
				$(this).next().css('display', 'block');
				flag = 1;
			}
			else{
				$(this).next().css('display', 'none');
				flag = 0;
			}
		});
	}
	// Прикрепляем файл 
	$(".form__file").change(function(){
         var filename = $(this).val().replace(/.*\\/, "");
         $(".form__filename").val(filename);
    });

    //Плавная прокрутка к якорю
	var linkNav = document.querySelectorAll('[href^="#"]'), //выбираем все ссылки к якорю на странице
    V = 0.5;  // скорость, может иметь дробное значение через точку (чем меньше значение - тем больше скорость)
	for (var i = 0; i < linkNav.length; i++) {
	    linkNav[i].addEventListener('click', function(e) { //по клику на ссылку
	        e.preventDefault(); //отменяем стандартное поведение
	        var w = window.pageYOffset,  // производим прокрутка прокрутка
	            hash = this.href.replace(/[^#]*(.*)/, '$1');  // к id элемента, к которому нужно перейти
	        t = document.querySelector(hash).getBoundingClientRect().top,  // отступ от окна браузера до id
	            start = null;
	        requestAnimationFrame(step);  // подробнее про функцию анимации [developer.mozilla.org]
	        function step(time) {
	            if (start === null) start = time;
	            var progress = time - start,
	                r = (t < 0 ? Math.max(w - progress/V, w + t) : Math.min(w + progress/V, w + t));
	            window.scrollTo(0,r);
	            if (r != w + t) {
	                requestAnimationFrame(step)
	            } else {
	                location.hash = hash  // URL с хэшем
	            }
	        }
	    }, false);
	}

});