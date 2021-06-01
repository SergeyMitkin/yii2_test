$(document).ready(function() {

    // Сохраняем активную вкладку в гет-параметр
    $("#servers_li").on("click", function (event) {
        const url = new URL(window.location);
        url.searchParams.set('active_li', 'servers');
        history.pushState(null, null, url);
    })

    $("#orders_li").on("click", function (event) {
        const url = new URL(window.location);
        url.searchParams.set('active_li', 'orders');
        history.pushState(null, null, url);
    })

    
    // Определяем аткивную вкладку личного кабинета
    if (active_li == "orders"){
        $("#servers_li").removeClass("active");
        $("#servers_content").removeClass("active");
        $("#orders_li").addClass("active");
        $("#orders_content").addClass("active");
    } else {
        $("#orders_li").removeClass("active");
        $("#orders_content").removeClass("active");
        $("#servers_li").addClass("active");
        $("#servers_content").addClass("active");
    }
})
