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


/* slimplyScroll */
$(function () {
    $(".con03 .list").simplyScroll({
        speed: 4,
        pauseOnHover: false,
        pauseOnTouch: false
    })
})


/* gsap ScrollTrigger */
$(function () {
    gsap.registerPlugin(ScrollTrigger);

    gsap.utils.toArray('section').forEach((section, i) => {
        ScrollTrigger.create({
            trigger: section,
            start: 'top top',
            pin: true,
            pinSpacing: false,
            // markers: true
        });
    });

    ScrollTrigger.create({
        snap: 1 / (section.length - 1)
    });
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



// 스크롤 하면서 sVG로 보여주는 라인 애니메이션
function scrollifyPage() {
    const $body = $('body');
    const options = {
        section: '.panel',
        scrollSpeed: 1100,
        scrollbars: false,
        overflowScroll: false,
        afterRender() {
            $body.attr('data-pre-index', 0);
        },

        before(i, panels) {
            $(panels[i]).addClass('active').
                siblings().removeClass('active');

            let preIndex = parseInt($body.attr('data-pre-index'));
            let direction = i > preIndex ? 'down' : 'up';

            $body.attr('data-pre-index', i).
                removeClass('up down').
                addClass(direction);

            $('h1').text(direction);

            $(document).trigger('onScrollify');
        }
    };


    $.scrollify(options);
}

function drawSvg() {
    const $panel = $('.panel');

    function drawSVGPaths(_parentElement, _time) {
        const paths = $(_parentElement).find('path');

        paths.toArray().forEach(el => {
            const $el = $(el);
            const isUp = $('body').hasClass('up');
            const totalLength = isUp ? -el.getTotalLength() : el.getTotalLength();

            $el.css({
                strokeDashoffset: totalLength,
                strokeDasharray: `${Math.abs(totalLength)} ${Math.abs(totalLength)}`
            });


            $el.animate(
                { strokeDashoffset: 0 },
                { duration: _time });

        });
    }

    function startSVGAnimation(parentElement) {
        drawSVGPaths(parentElement, 1500);
    }

    function drawSvgInActivePanel() {
        $panel.toArray().forEach(el => $(el).hasClass('active') && startSVGAnimation($(el).find('svg')));
    }

    drawSvgInActivePanel();

    $(document).on('onScrollify', drawSvgInActivePanel);
}

scrollifyPage();
drawSvg();