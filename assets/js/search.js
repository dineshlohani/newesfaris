var JQ = jQuery.noConflict();
JQ(document).ready(function()
{
    JQ(document).on("change","#filter",function(){
        var  value = JQ(this).val();
        if(value ===  "search-form")
        {
            JQ('.search-form').removeClass("d-none");
            JQ(".date-content").addClass("d-none");
        }
        if(value === "date")
        {
          JQ('.search-form').addClass("d-none");
          JQ(".date-content").removeClass("d-none");
        }
    });
    JQ(document).on("click",".search-toggle",function()
    {

        if(JQ(".search").hasClass("show") == false)
        {
          JQ(".search").addClass("show");
        }
        else
        {
          JQ(".search").removeClass("show");
        }
    });
    JQ(document).on("click",".reset",function(){
        JQ("#search_field").val("");
    });
});
