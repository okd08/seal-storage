"use strict";

// 上に戻るボタン
function scrollToTop() {
    const scrollStep = -window.scrollY / (500 / 50);
    const scrollInterval = setInterval(function () {
        if (window.scrollY !== 0) {
            window.scrollBy(0, scrollStep);
        } else {
            clearInterval(scrollInterval);
        }
    }, 15);
}