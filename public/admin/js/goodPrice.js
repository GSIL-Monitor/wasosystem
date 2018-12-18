/**
 * Created by Adminitator on 2016/6/29.
 */

$(function () {
    function  createPrice() {
        var jiage = $("#cost_price").val();
        core_price(jiage,0.95);
        cooperation_price(jiage,0.9);
        member_price(jiage,0.8);
        retail_price(jiage,0.50);

    }
    createPrice();
    $(document).on('change','#cost_price',function () {
        createPrice();
        var jiage = $("#cost_price").val();
        var original_price=parseInt($("#cost_price").attr('original_price'));
        if(original_price<parseInt(jiage)){
            $("#float").val("come-up");
        }else if(original_price>parseInt(jiage)){
            $("#float").val("lower");
        }else{
            $("#float").val("smooth");
        }
    });
    //零售
    function retail_price(jiage,bfb){
        var retail_price=Math.round(jiage / bfb);
        var str = retail_price.toString().slice(5);
        var str1 = retail_price.toString().slice(4);
        var str2 = retail_price.toString().slice(3);
        var str3 = retail_price.toString().slice(2);
        var str4 = retail_price.toString().slice(1);
        var str5 = retail_price.toString().slice(0);
        var ls;var zls;
        //十
        if(retail_price.toString().length <3 && retail_price.toString().length >=2){

            if(str4<5 && str4>0){
                ls= str5-str4;
                zls=ls+5;
            }
            if(str4<10 && str4>=5){
                ls= str5-str4;
                zls=ls+10;
            }
            if(str4==0){
                zls= str5-str4;
            }
            $("#retail_price").val(parseInt(zls));
        }
        //百
        if(retail_price.toString().length <4 && retail_price.toString().length >=3){
            if(str3<5 && str3>0){
                ls= str5-str3;
                zls=ls+5;
            }
            if(str3<10 && str3>=5){
                ls= str5-str3;
                zls=ls+10;
            }
            if(str3==0){
                zls= str5-str3;
            }
            if(str4==0 && str3==0){
                zls= str5-str4;
            }
            $("#retail_price").val(parseInt(zls));
        }
        //千
        if(retail_price.toString().length <5 && retail_price.toString().length >=4){
            if(str2<10 && str2>0){
                ls= str5-str2;
                zls=ls+10;
            }
            if(str2==0){
                zls= str5-str2;
            }
            if(str3==0 && str2==0) {
                zls = str5 - str3;
            }
            if(str4==0 && str3==0 && str2==0){
                zls= str5-str4;
            }
            $("#retail_price").val(parseInt(zls));
        }
        //万
        if(retail_price.toString().length <6 && retail_price.toString().length >=5){
            if(str2<50 && str2>0){
                zls= str5-str2;
            }
            if(str2<100 && str2>=50){
                ls= str5-str2;
                zls=ls+100;
            }
            if( str2==0){
                zls= str5-str2;
            }
            if(str3==0 && str2==0){
                zls= str5-str3;
            }
            if(str4==0 && str3==0 && str2==0 && str1==0){
                zls= str5-str4;
            }
            $("#retail_price").val(parseInt(zls));
        }
        //十万
        if(retail_price.toString().length <7 && retail_price.toString().length >=6){
            if(str1<50 && str1>0){
                zls= str5-str1;
            }
            if(str1<100 && str1>=50){
                ls= str5-str1;
                zls=ls+100;
            }
            if(str3==0 && str2==0 && str1==0 && str==0){
                zls= str5-str3;
            }
            if(str2==0 && str1==0 && str==0){
                zls= str5-str2;
            }
            if(str1==0 && str==0){
                zls= str5-str1;
            }
            if(str1==0){
                zls= str5-str1;
            }
            if(str4==0 && str3==0 && str2==0 && str1==0 && str==0){
                zls= str5-str4;
            }
            //alert(str); alert(str1); alert(str2); alert(str3); alert(str4); alert(str5);
            $("#retail_price").val(parseInt(zls));
        }
    }
    //会员
    function member_price(jiage,bfb){
        var member_price=Math.round(jiage / bfb);
        var s = member_price.toString().slice(5);
        var s1 = member_price.toString().slice(4);
        var s2 = member_price.toString().slice(3);
        var s3 = member_price.toString().slice(2);
        var s4= member_price.toString().slice(1);
        var s5 = member_price.toString().slice(0);
        var hy;var zhy;
        //十
        if(member_price.toString().length <3 && member_price.toString().length >=2){
            if(s4<5 && s4>0){
                hy= s5-s4;
                zhy=hy+5;
            }
            if(s4<10 && s4>=5){
                hy= s5-s4;
                zhy=hy+10;
            }
            if(s4==0){
                zhy= s5-s4;
            }
            $("#member_price").val(parseInt(zhy));
        }
        //百
        if(member_price.toString().length <4 && member_price.toString().length >=3){
            if(s3<5 && s3>0){
                hy= s5-s3;
                zhy=hy+5;
            }
            if(s3<10 && s3>=5){
                hy= s5-s3;
                zhy=hy+10;
            }
            if(s3==0){
                zhy= s5-s3;
            }
            if(s4==0 && s3==0){
                zhy= s5-s4;
            }
            $("#member_price").val(parseInt(zhy));
        }
        //千
        if(member_price.toString().length <5 && member_price.toString().length >=4){
            if(s2<10 && s2>0){
                hy= s5-s2;
                zhy=hy+10;
            }
            if(s2==0){
                zhy= s5-s2;
            }
            if(s3==0 && s2==0) {
                zhy = s5 - s3;
            }
            if(s4==0 && s3==0 && s2==0){
                zhy= s5-s4;
            }
            $("#member_price").val(parseInt(zhy));
        }
        //万
        if(member_price.toString().length <6 && member_price.toString().length >=5){
            if(s2<50 && s2>0){
                zhy= s5-s2;
            }
            if(s2<100 && s2>=50){
                hy= s5-s2;
                zhy=hy+100;
            }
            if( s2==0){
                zhy= s5-s2;
            }
            if(s3==0 && s2==0){
                zhy= s5-s3;
            }
            if(s4==0 && s3==0 && s2==0 && s1==0){
                zhy= s5-s4;
            }
            $("#member_price").val(parseInt(zhy));
        }
        if(member_price.toString().length <7 && member_price.toString().length >=6){
            if(s1<50 && s1>0){
                zhy= s5-s1;
            }
            if(s1<100 && s1>=50){
               hy= s5-s1;
                zhy=hy+100;
            }
            if(s3==0 && s2==0 && s1==0 && s==0){
                zhy= s5-s3;
            }
            if(s2==0 && s1==0 && s==0){
                zhy= s5-s2;
            }
            if(s1==0 && s==0){
                zhy= s5-s1;
            }
            if(s1==0){
                zhy= s5-s1;
            }
            if(s4==0 && s3==0 && s2==0 && s1==0 && s==0){
                zhy= s5-s4;
            }
            //alert(t); alert(t1); alert(t2); alert(t3); alert(t4); alert(t5);
            $("#member_price").val(parseInt(zhy));
        }

    }
    //合作
    function cooperation_price(jiage,bfb){
        var cooperation_price=Math.round(jiage / bfb);
        var t = cooperation_price.toString().slice(5);
        var t1 = cooperation_price.toString().slice(4);
        var t2 = cooperation_price.toString().slice(3);
        var t3= cooperation_price.toString().slice(2);
        var t4= cooperation_price.toString().slice(1);
        var t5 = cooperation_price.toString().slice(0);
        var hz;var zhz;
        //十
        if(cooperation_price.toString().length <3 && cooperation_price.toString().length >=2){
            if(t4<5 && t4>0){
                hz= t5-t4;
                zhz=hz+5;
            }
            if(t4<10 && t4>=5){
                hz= t5-t4;
                zhz=hz+10;
            }
            if(t4==0){
                zhz= t5-t4;
            }
            $("#cooperation_price").val(parseInt(zhz));
        }
        //百
        if(cooperation_price.toString().length <4 && cooperation_price.toString().length >=3){
            if(t3<5 && t3>0){
                hz= t5-t3;
                zhz=hz+5;
            }
            if(t3<10 && t3>=5){
                hz= t5-t3;
                zhz=hz+10;
                //alert(zhz)
            }
            if(t3==0){
                zhz= t5-t3;
            }
            if(t4==0 && t3==0){
                zhz= t5-t4;
            }
            $("#cooperation_price").val(parseInt(zhz));
        }
        //千
        if(cooperation_price.toString().length <5 && cooperation_price.toString().length >=4){
            if(t2<10 && t2>0){
                hz= t5-t2;
                zhz=hz+10;
            }
            if(t2==0){
                zhz= t5-t2;
            }
            if(t3==0 && t2==0) {
                zhz = t5 - t3;
            }
            if(t4==0 && t3==0 && t2==0){
                zhz= t5-t4;
            }
            $("#cooperation_price").val(parseInt(zhz));
        }
        //万
        if(cooperation_price.toString().length <6 && cooperation_price.toString().length >=5){
            if(t2<50 && t2>0){
                zhz= t5-t2;
            }
            if(t2<100 && t2>=50){
                hz= t5-t2;
                zhz=hz+100;
            }
            if( t2==0){
                zhz= t5-t2;
            }
            if(t3==0 && t2==0){
                zhz= t5-t3;
            }
            if(t4==0 && t3==0 && t2==0 && t1==0){
                zhz= t5-t4;
            }
            $("#cooperation_price").val(parseInt(zhz));
        }
        //十万
        if(cooperation_price.toString().length <7 && cooperation_price.toString().length >=6){
            if(t1<50 && t1>0){
                zhz= t5-t1;
            }
            if(t1<100 && t1>=50){
                hz= t5-t1;
                zhz=hz+100;
            }
            if(t3==0 && t2==0 && t1==0 && t==0){
                zhz= t5-t3;
            }
            if(t2==0 && t1==0 && t==0){
                zhz= t5-t2;
            }
            if(t1==0 && t==0){
                zhz= t5-t1;
            }
            if(t1==0){
                zhz= t5-t1;
            }
            if(t4==0 && t3==0 && t2==0 && t1==0 && t==0){
                zhz= t5-t4;
            }
            //alert(t); alert(t1); alert(t2); alert(t3); alert(t4); alert(t5);
            $("#cooperation_price").val(parseInt(zhz));
        }
    }
     //核心
    function core_price(jiage,bfb){
        var core_price=Math.round(jiage / bfb);
        var r = core_price.toString().slice(5);
        var r1 = core_price.toString().slice(4);
        var r2 = core_price.toString().slice(3);
        var r3 = core_price.toString().slice(2);
        var r4 = core_price.toString().slice(1);
        var r5 = core_price.toString().slice(0);
        var hx;var zhx;
        //十
        if(core_price.toString().length <3 && core_price.toString().length >=2){
            if(r4<5 && r4>0){
                hx= r5-r4;
                zhx=hx+5;
            }
            if(r4<10 && r4>=5){
                hx= r5-r4;
                zhx=hx+10;
            }
            if(r4==0){
                zhx= r5-r4;
            }
            $("#core_price").val(parseInt(zhx));
        } //百
        if(core_price.toString().length <4 && core_price.toString().length >=3){
            if(r3<5 && r3>0){
                hx= r5-r3;
                zhx=hx+5;
            }
            if(r3<10 && r3>=5){
                hx= r5-r3;
                zhx=hx+10;
            }
            if(r3==0){
                zhx= r5-r3;
            }
            if(r4==0 && r3==0){
                zhx= r5-r4;
            }
            $("#core_price").val(parseInt(zhx));
        }
        //千
        if(core_price.toString().length <5 && core_price.toString().length >=4){
            if(r2<10 && r2>0){
                hx= r5-r2;
                zhx=hx+10;
            }
            if(r2==0){
                zhx= r5-r2;
            }
            if(r3==0 && r2==0) {
                zhx = r5 - r3;
            }
            if(r4==0 && r3==0 && r2==0){
                zhx= r5-r4;
            }
            $("#core_price").val(parseInt(zhx));
        }
        //万
        if(core_price.toString().length <6 && core_price.toString().length >=5){
            if(r2<50 && r2>0){
                zhx= r5-r2;
            }
            if(r2<100 && r2>=50){
                hx= r5-r2;
                zhx=hx+100;
            }
            if( r2==0){
                zhx= r5-r2;
            }
            if(r3==0 && r2==0){
                zhx= r5-r3;
            }
            if(r4==0 && r3==0 && r2==0 && r1==0){
                zhx= r5-r4;
            }
            $("#core_price").val(parseInt(zhx));
        }
        //十万
        if(core_price.toString().length <7 && core_price.toString().length >=6){
            if(r1<50 && r1>0){
                zhx= r5-r1;
            }
            if(r1<100 && r1>=50){
                hx= r5-r1;
                zhx=hx+100;
            }
            if(r3==0 && r2==0 && r1==0 && r==0){
                zhx= r5-r3;
            }
            if(r2==0 && r1==0 && r==0){
                zhx= r5-r2;
            }
            if(r1==0 && r==0){
                zhx= r5-r1;
            }
            if(r1==0){
                zhx= r5-r1;
            }
            if(r4==0 && r3==0 && r2==0 && r1==0 && r==0){
                zhx= r5-r4;
            }

            $("#core_price").val(parseInt(zhx));
        }

        if(core_price.toString().length >=7){
            alert("超出计算范围  请手动输入")
        }

    }


});