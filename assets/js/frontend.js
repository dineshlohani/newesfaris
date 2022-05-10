// JQ(document).bind("contextmenu",function(e) {
//   e.preventDefault();
// });

// document.onkeydown = function(e) {
//   if(event.keyCode == 123) {
//      return false;
//   }
//   if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
//      return false;
//   }
//   if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
//      return false;
//   }
//   if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
//      return false;
//   }
//   if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
//      return false;
//   }
// }

var JQ = jQuery.noConflict();

var url     = JQ(location).attr('href');
var res     = url.split("/");

// var base_url = res[0]+"//"+ res[2]+"/";
if(res[3] != '')
{
    var temp    = res[3];

    var temp_arr = temp.split("?");
    var page    = temp_arr[0];
    JQ("#"+page).addClass("active");
    JQ("#"+page).parent().parent().addClass("active");
    JQ("#"+page).parent().siblings("a").addClass("toggled");
    JQ("#"+page).parent().parent().children("ul").show();
}

if(res[3] != '')
{
    var temp    = res[3];

    var temp_arr = temp.split("?");
    var page    = temp_arr[0];
    JQ("#"+page).addClass("active");
    JQ("#"+page).parent().parent().addClass("active");
    JQ("#"+page).parent().siblings("a").addClass("toggled");
    JQ("#"+page).parent().parent().children("ul").show();
}


JQ(document).ready(function(){
        JQ(document).on("click","#nav-home-tab",function(){

        JQ(this).addClass("active");
        JQ("#nav-profile-tab").removeClass("active");
        JQ("#details").addClass("active");
        JQ("#details").addClass("show");
        JQ("#sifaris").removeClass("show");
        JQ("#sifaris").removeClass("active");
    });
    JQ(document).on("click","#nav-profile-tab",function(){
        JQ(this).addClass("active");
        JQ("#nav-home-tab").removeClass("active");
        JQ("#sifaris").addClass("active");
        JQ("#sifaris").addClass("show");
        JQ("#details").removeClass("show");
        JQ("#details").removeClass("active");
    });
    JQ('.select2').select2();
    JQ(document).on("change","#filter",function(){

    });
    JQ(document).on("click",".user",function(){
        if(JQ(".user-div").hasClass("show") == false)
        {
          JQ(".user-div").addClass("show");
        }
        else
        {
          JQ(".user-div").removeClass("show");
        }
    });
    JQ(document).on("click",".book",function(){
        if(JQ(".book-div").hasClass("show") == false)
        {
          JQ(".book-div").addClass("show");
        }
        else
        {
          JQ(".book-div").removeClass("show");
        }
    });
    JQ(document).on("click",".menu-toggle",function()
    {
        if(JQ(this).hasClass("toggled"))
        {
            JQ(this).removeClass("toggled");
            JQ(this).parent().children('ul').hide();
        }
        else
        {
            JQ(this).addClass("toggled");
            JQ(this).parent().children('ul').show();
        }
    });
    JQ(document).on('change',"#office_id",function(){
            var office_id = JQ(this).val();
            var param = {};
            param.office_id = office_id;
            param.detail_id = res[6];
            param.uri = res[4];
            JQ.post(base_url+'Home/getSambodhanAddressJSON',param,function(data){
                console.log(data);
                var obj = JSON.parse(data);
                JQ("#office_sambodhan").val(obj.sambodhan);
                JQ("#office_address").val(obj.address);
            });
        });

    JQ(document).on('click','#submit_office',function()
    {
            var param = {};
            alert(base_url);
            param.sambodhan = JQ("#sambodhan").val();
            param.office    = JQ("#office_name").val();
            param.address   = JQ("#address").val();
            JQ.post(base_url+'Settings/addOfficeJSON',param,function(data){
                 var obj = JSON.parse(data);
                 if(obj.msg == "TRUE")
                 {
                     alert('Data Saved Successfully');
                     JQ("#office_id").empty().append(obj.html);
                     JQ("#office_sambodhan").val(param.sambodhan);
                     JQ("#office_address").val(param.address);
                     JQ("#office_id").val(obj.insert_id);
                     JQ("#sambodhan").val('');
                     JQ("#office_name").val('');
                     JQ("#address").val('');
                     JQ('#myModal').modal('hide');
                 }
             });
    });
    JQ(document).on("change", ".state_selected", function (){
               var id_selected     = JQ(this).attr("id");
               var res             = id_selected.split("-");
               var id              = res[res.length - 1];
               var state           = JQ(this).val();
               //alert(state);
               var param = {};
               param.state= state;
               param.id   = id;
               JQ.post(base_url+'get_districts',param,function(data){
                        var obj = JSON.parse(data);
                        JQ("#district_selected-"+id).html(obj.html);

               });


        });


        JQ(document).on("change", ".district_selected", function (){
               var id_selected     = JQ(this).attr("id");
               var res             = id_selected.split("-");
               var id              = res[res.length - 1];
              // alert(id);
               var district           = JQ(this).val();
               //alert(state);
               var param = {};
               param.district= district;
               param.id   = id;
               JQ.post(base_url+'get_local_body',param,function(data){
                        var obj = JSON.parse(data);
                     //  alert(obj.html);
                        JQ("#local_body_selected-"+id).html(obj.html);
               });


        });
        JQ(document).on("click","#depart_check",function()
        {
            JQ("#depart_other").toggle();
            JQ("#depart_other").val("");
        });
		JQ(document).on("change","input[name=land_type]",function(){
            var value = JQ(this).val();
            if(value == "hill")
            {
                JQ('#land_area').attr('colspan',4);
                JQ("#land_desc").attr('colspan',6);
                JQ("#biggha_span").text('रोपनी');
                JQ("#kattha_span").text('आना');
                JQ("#dhur_span").text("दाम");
                JQ(".paisa_div").show();
                // JQ(".paisa").show();
            }
            else
            {
                JQ('#land_area').attr('colspan',3);
                JQ("#land_desc").attr('colspan',5);
                JQ("#biggha_span").text('बिग्घा');
                JQ("#kattha_span").text('कट्ठा');
                JQ("#dhur_span").text("धुर");
                JQ(".paisa_div").hide();
            }
        });

});
JQ(function () {
    JQ('[data-toggle="tooltip"]').tooltip();
});
JQ(document).on('change','#ward_worker',function(){
    var worker_id = JQ(this).val();
    var param ={};
    param.worker_id= worker_id;
    JQ.get(base_url+'Settings/getWardPostByIdJSON',param,function(data){
             var obj = JSON.parse(data);
             JQ("#ward_post").val(""+obj.name);
     });

});

// ----to check if function exist ; if not create a new empty function -------
if (typeof checkMyDate !== 'function') {
  function checkMyDate(x,y){}
}

// --------------------------------------------------------------
function menuToggle()
{
    var element = document.getElementById("id_open_button");
    var body     = document.getElementsByTagName("body")[0];
    element.classList.toggle("active");
    body.classList.toggle("ls-closed");
}

JQ(document).on("change", ".state_selected_en", function (){
   var id_selected     = JQ(this).attr("id");
   var res             = id_selected.split("-");
   var id              = res[res.length - 1];
   var state           = JQ(this).val();
   var param = {};
   param.state= state;
   param.id   = id;
   JQ.post(base_url+'get_districts_en',param,function(data){
    var obj = JSON.parse(data);
    JQ("#selected_district_en-"+id).html(obj.html);
   });
});

JQ(document).on("change", ".district_selected_en", function (){
    var id_selected     = JQ(this).attr("id");
    var res             = id_selected.split("-");
    var id              = res[res.length - 1];
    var district        = JQ(this).val();
    var param           = {};
    param.district      = district;
    param.id            = id;
    JQ.post(base_url+'get_local_body_en',param,function(data){
    var obj = JSON.parse(data);
        JQ("#local_body_selected_en-"+id).html(obj.html);
    });
});

JQ(document).on("change", ".select_local_body", function (){
    var id_selected     = JQ(this).attr("id");
    var res             = id_selected.split("-");
    var id              = res[res.length - 1];
    var district        = JQ(this).val();
    var param           = {};
    param.district      = district;
    param.id            = id;
    JQ.post(base_url+'get_local_body_ward',param,function(data){
    var obj = JSON.parse(data);
        JQ("#selected_ward-"+id).html(obj.html);
    });
});

JQ(document).on("change", ".worker_id", function (){
    var id_selected     = JQ(this).attr("id");
    var worker          = JQ(this).val();
    var param           = {};
    param.worker            = worker;
    JQ.post(base_url+'get_post_by_worker_id',param,function(data){
        //var obj = JSON.parse(data);
       // console.log(obj.html);
        JQ("#worker_post").val(data);
    });
});
//select_local_body