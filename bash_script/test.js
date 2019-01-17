var webPage = require('webpage');
var page = webPage.create();
var system = require('system');
var custom_id = system.args[1];
var express_num = system.args[2];
var width,height;

var url= 'http://10.3.0.253/ejworkbench/index.php?act=timing_print_ticket&op=print_all_ticket&named_type=airport&temp_type=two&customs_id='+custom_id;
page.open(url, function start(status) {
    if ( status === "success" ) {
        // page.includeJs("http://code.jquery.com/jquery-1.8.0.min.js",function(){
            // page.evaluate(function(){
            //     var div = document.getElementsByTagName('div')[1];
                // $(".note_view").css("background-image", "url(./jb.jpeg)");
                // var note_view = document.getElementsByClassName("note_view");
                // note_view.setAttribute("style","background:color(red)");
        //     });
        // });
        page.evaluate(function() {
                // document.body.style.backgroundImage = "url('http://10.3.0.253/ejworkbench/templates/default/images/ticket2/ticket_3_bgc.png')";
                // document.body.style.backgroundRepeat = "no-repeat";
                // document.body.style.backgroundSize = "cover";
                // document.body.style.backgroundColor = "white";
                document.body.style.padding = "0";//截屏时去除浏览器边框1
                document.body.style.margin = "0";//截屏时去除浏览器边框2

                window.setTimeout(function () {
                var div1 = document.getElementsByTagName('div')[1];//类名为note_show的div
                // div1.style.background = "none";//去除div的背景
                div1.style.padding = "0";
                width = div1.width;
                height = div1.height;

                var div2 = document.getElementsByTagName('div')[2];//图标div
                    // div2.style.padding = "0";
                // div3.style.backgroundImage = "none";

                var div4 = document.getElementsByTagName('div')[4];
                    // div4.style.background = "none";
            },1000);

        });
        window.setTimeout(function () {
            page.clipRect = { top: 0, left: 0, width: width, height: height };
            page.viewportSize = { width: 20, height: 100 };
            page.render('/home/wwwroot/oms.ejbuy.com/data/ticket_two/all_ticket/'+express_num+'.jpeg');
          
            phantom.exit();
        },1000+200);
    } else {
        console.log("Page failed to load.");
    }

});
