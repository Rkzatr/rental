$(document).ready(function () {
    $('.nav-item').removeClass('active');

    $.each(listMenu, function (label, v) {
        let menu = $($('#menu-single').html());
        menu.attr('data-id', v.id);
        menu.find('.nav-link').attr('href', v.url);
        menu.find('.fas').addClass('fa-' + v.icon);
        menu.find('span').text(label);
        menuContainer.append(menu);
        console.log(menu);
    });

    $(`.nav-item[data-id='${page}']`).addClass('active');
});