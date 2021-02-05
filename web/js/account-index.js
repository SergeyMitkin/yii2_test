$(document).ready(function() {

    // Определяем аткивную вкладку личного кабинета
    if (active == "orders"){
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