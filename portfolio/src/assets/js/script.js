// 01. 스플리팅 호출
$(function () {
    Splitting();
});

// 02. header영역 스크롤 방향 이벤트
$(function () {
    var prevScrollTop = 0;
    document.addEventListener("scroll", function () {
        var nowScrollTop = $(window).scrollTop();

        if (nowScrollTop > prevScrollTop) {
            $('header').addClass('active');
        } else {
            $('header').removeClass('active');
        }
        prevScrollTop = nowScrollTop;
    })
});



// path 길이
$(function () {
    $('.svgAni').find('#svgAni05').each(function (i, path) {
        var length = path.getTotalLength();
        // alert(length);
    });
});

/* slimplyScroll */
$(function () {
    $(".con03 .list").simplyScroll({
        speed: 4,
        pauseOnHover: false,
        pauseOnTouch: false
    })
})

$(function () {
    gsap.registerPlugin(ScrollTrigger);

    gsap.utils.toArray('section').forEach((section, i) => {
        ScrollTrigger.create({
            trigger: section,
            start: 'top top',
            pin: true,
            pinSpacing: false,
            markers:true 
        })
        
    })

    ScrollTrigger.create({
        snap: 1 / (section.length -1)
    })
})

// a 속성 제거
$(document).on('click', 'a[href="#"]', function (e) {
    e.preventDefault();
    
})

// scrolla.js 적용
$(function () {
    $('.animate').scrolla({
        mobile: true,
        once: false
    })
});