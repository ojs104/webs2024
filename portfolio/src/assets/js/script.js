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