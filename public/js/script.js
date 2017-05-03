$(document).ready(function() {

    var cnt_profit = 0;
    var cnt_meals = 0;
    var cnt_officiants =0;
    var cnt_orders = 0;
    var cnt_all = 0;

    function cnt(cnt){

        return ++cnt;
    }

    function getProfit(){

        cnt_profit = cnt(cnt_profit);

        if(cnt_profit%2 == 0){

            $('#profit').children().remove();
            $('.nav li:first').removeClass('active');
        }
        else{
            $.ajax({
                url: "/request/profit",
                type: "POST",
                success: function (data) {
                    $('.nav li:first').addClass('active');

                    $('#profit').append('<table class="table" style="font-size: large"> </table>');

                    $('#profit table').append('<tr> </tr>');

                    $('#profit table tr:last').append('<td>Прибыль:</td>');

                    $('#profit  table tr:last').append('<td>  ' + data + '$</td>');
                }

            });
        }

    }

    function getMeals(){

        cnt_meals = cnt(cnt_meals);

        if(cnt_meals %2 == 0){
            $('#meals').children().remove();
            $('#li2').removeClass('active');
        }
        else{
            $.ajax({
                url: "/request/meals",
                type: "POST",
                success: function (data) {
                    $('#li2').addClass('active');
                    $('#meals').append('<table class="table table-bordered" > </table>');

                    $('#meals table').append('<thead></thead>');
                    $('#meals table thead').append('<tr> </tr>');
                    $('#meals table tr').append('<th>ID</th>')
                        .append('<th>Название</th>')
                        .append('<th>Цена</th>')
                        .append('<th>Кол-во заказов</th>');

                    $('#meals table').append('<tbody></tbody>');
                    for(var i in data){

                        $('#meals table tbody').append('<tr id ="m'+i+'"> </tr>');
                        $('#meals table tbody #m'+i).append('<td>'+data[i].id+'</td>')
                            .append('<td>'+data[i].name+'</td>')
                            .append('<td>'+data[i].price+'$</td>')
                            .append('<td>'+data[i].quantity+'</td>')
                    }
                }

            });
        }

    }

    function getOfficiants(){

        cnt_officiants=cnt(cnt_officiants);

        if(cnt_officiants%2 == 0){

            $('#officiants').children().remove();
            $('#li4').removeClass('active')
        }
        else{
            $.ajax({
                url: "/request/officiants",
                type: "POST",
                success: function (data) {
                    $('#li4').addClass('active');
                    $('#officiants').append('<table class="table table-bordered" > </table>');

                    $('#officiants table').append('<thead></thead>');
                    $('#officiants table thead').append('<tr> </tr>');
                    $('#officiants table tr').append('<th>ID</th>')
                        .append('<th>Имя</th>')
                        .append('<th>Фамилия</th>')
                        .append('<th>Кол-во заказов</th>');

                    $('#officiants table').append('<tbody></tbody>');
                    for(var i in data){

                        $('#officiants table tbody').append('<tr id ="m'+i+'"> </tr>');
                        $('#officiants table tbody #m'+i).append('<td>'+data[i].id+'</td>')
                            .append('<td>'+data[i].name+'</td>')
                            .append('<td>'+data[i].second_name+'</td>')
                            .append('<td>'+data[i].orders+'</td>')
                    }

                }

            });
        }

    }

    function getOrders(){

        cnt_orders = cnt(cnt_orders);

        if(cnt_orders%2 == 0){

            $('#orders').children().remove();
            $('#li3').removeClass('active');
        }
        else{
            $.ajax({
                url: "/request/orders",
                type: "POST",
                success: function (data) {

                    $('#li3').addClass('active');
                    $('#orders').append('<table class="table table-bordered"> </table>');

                    $('#orders table').append('<thead></thead>');
                    $('#orders table thead').append('<tr> </tr>');
                    $('#orders table tr').append('<th>ID</th>').append('<th>Oфициант</th>').append('<th>Сумма</th>').append('<th>Блюда</th>');
                    $('#orders table').append('<tbody> </tbody>');

                    for(var i in data){

                        $('#orders table tbody tr:last').remove();

                        $('#orders table tbody').append('<tr id ="ord'+i+'"> </tr>');
                        $('#orders table tbody #ord'+i).append('<td>'+data[i].id+'</td>')
                            .append('<td>'+data[i].officiant+'</td>')
                            .append('<td>'+data[i].sum+'$</td>');

                        for(var j in data[i].meals){

                            $('#orders table tbody tr:last').append('<td>'+data[i].meals[j]+'</td>');
                            $('#orders table tbody').append('<tr></tr>');
                            $('#orders table tbody tr:last').append('<td></td>').append('<td></td>').append('<td></td>')
                        }
                    }
                    $('#orders table tbody tr:last').remove();
                }

            });
        }

    }

    function getAll() {

        cnt_all = cnt(cnt_all);

        if(cnt_all%2 == 0){
            $('#profit').children().remove();
            $('.nav li:first').removeClass('active');
            $('#meals').children().remove();
            $('#li2').removeClass('active');
            $('#officiants').children().remove();
            $('#li4').removeClass('active');
            $('#orders').children().remove();
            $('#li3').removeClass('active');
            $('#li5').removeClass("active");
            cnt_profit = 0;
            cnt_meals = 0;
            cnt_officiants =0;
            cnt_orders = 0;
        }
        else{
            $('#profit').children().remove();
            $('.nav li:first').removeClass('active');
            $('#meals').children().remove();
            $('#li2').removeClass('active');
            $('#officiants').children().remove();
            $('#li4').removeClass('active');
            $('#orders').children().remove();
            $('#li3').removeClass('active');
            cnt_profit = 0;
            cnt_meals = 0;
            cnt_officiants =0;
            cnt_orders = 0;

            $('#li5').addClass("active");

            getProfit();
            getMeals();
            getOfficiants();
            getOrders();
        }

    }

    $('#get-profit').click(getProfit);
    $('#get-meals').click(getMeals);
    $('#get-officiants').click(getOfficiants);
    $('#get-orders').click(getOrders);
    $('#get-all').click(getAll);


});