

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
    आवेदकको विवरण | घर कायमको सिफारिस
</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="/static/images/nepal_logo.png"/>


        <link rel="stylesheet" href="/static/bower_components/bootstrap/dist/css/bootstrap.css">
        <link rel="stylesheet" href="/static/css/select2.min.css">
        <link rel="stylesheet" href="/static/css/select2-bootstrap.min.css">
        <link rel="stylesheet" href="/static/bower_components/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="/static/nepalidatepicker/nepali.datepicker.v2.2.min.css">
        <link rel="stylesheet" href="/static/css/material.css">
        <link rel="stylesheet" href="/static/css/style.css">




</head>

<body style="background:white;"
      class='  ls-opened  theme-violet '>
<div class="overlay"></div>

<div class="page-wrapper">



<nav class="navbar navbar-expand-lg navbar-dark bg-deep-blue">
    <div class="visible-xs">
        <div class="button close_button" id="id_close_button">
            <div class="bar top"></div>
            <div class="bar middle"></div>
            <div class="bar bottom"></div>
        </div>
    </div>

    <div class="hidden-xs mt-1">
        <div class="button  open_button  active "
             id="id_open_button">
            <div class="bar top"></div>
            <div class="bar middle"></div>
            <div class="bar bottom"></div>
        </div>
    </div>

    <img alt="logo" src="/static/images/logo_0.png" class="img-responsive ml-3" height="50px;">
    <a class="navbar-brand ml-2 font-27 font-kalimati" href="/">दैनिक प्रशासन </a>


    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto"></ul>

        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a style="color:white;" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                   data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-book"></i> दर्ता / चलानी
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/darta-kitab/">दर्ता किताब</a>
                    <a class="dropdown-item" href="/chalani-kitab/">चलानी किताब</a>
                </div>
            </li>

        </ul>

        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a style="color:white;" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                   data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user-circle"></i> ward1
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item " href="/users/change_password/">Change Password</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/users/logout/">Log Out</a>
                </div>
            </li>

        </ul>
    </div>
</nav>

<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar font-kalimati">
        <!-- User Info -->
        <div class="user-info bg-navy-blue">


















            <div class="info-container text-white">
                <div class="info-contact">
                    <span class="font-20"><i class="fa  fa-dollar"> 1</i> = NRs. 112.32</span>
                    <a class="text-warning" href="/currency-conversion/"> <i
                            class="fa fa-undo"></i></a>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class='list'>
                <li id="id_home">
                    <a href="/" class="pl-2">
                        <i class="fa fa-home fa-2x "></i>
                        <span>गृह</span>

                    </a>
                    <hr style="margin:0;padding:0;">

                </li>


                <li id="id_parent">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <span>घर सम्बन्धित</span>
                    </a>
                    <ul class="ml-menu">
                        <li id="home-recommendations">
                            <a id="home-recommendations" href="/home-recommendations/">
                                <span>घर कयामको सिफारिस</span>
                            </a>

                        </li>






                        <li id="home-road-certifications">
                            <a id="home-road-certifications" href="/home-road-certifications/">
                                <span>घर बाटो प्रमाणित</span>
                            </a>
                        </li>






                        <li id="ghar-jagga-namsari">
                            <a id="ghar-jagga-namsari"
                               href="/ghar-jagga-namsari/">
                                <span>घर जग्गा नामसारी</span>
                            </a>
                        </li>
                        <li id="kittakat-sifaris">
                            <a href="/kittakat-sifaris/">
                                <span>कित्ताकाट सिफारिस</span>
                            </a>
                        </li>

                    </ul>
                </li>

                <li id="id_parent">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <span>संस्था/व्यवसाय सम्बन्धित</span>
                    </a>
                    <ul class="ml-menu">
                        <li id="sanstha-darta-pramanpatra">
                            <a id="sanstha-darta-pramanpatra" href="/sanstha-darta-pramanpatra/">
                                <span>गैर नाफामुलक संस्था दर्ता <br> प्रमाणपत्र </span>
                            </a>
                        </li>

                        <li id="bebasaya-darta">
                            <a id="bebasaya-darta" href="/bebasaya-darta/">
                                <span>व्यवसाय दर्ता प्रमाणपत्र</span>
                            </a>
                        </li>

                        <li id="bebasaya-banda">
                            <a id="bebasaya-banda" href="/bebasaya-banda/">
                                <span>व्यवसाय बन्द बारे</span>
                            </a>
                        </li>

                        <li id="sanstha-darta">
                            <a href="/sanstha-darta/">
                                <span>संस्था दर्ता सिफारिस</span>
                            </a>
                        </li>

                        <li id="sanstha-nabikaran">
                            <a href="/sanstha-nabikaran/">
                                <span>संस्था नबिकरण सिफारिस</span>
                            </a>
                        </li>

                    </ul>
                </li>

                <li id="id_parent">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <span>सम्पत्ति सम्बन्धित</span>
                    </a>
                    <ul class="ml-menu">
                        <li id="income-verification">
                            <a id="income-verification" href="/income-verification/">
                                <span>वार्षिक आय प्रमाणिकरण</span>
                            </a>

                        </li>
                        <li id="property-valuation">
                            <a id="property-valuation"
                               href="/property-valuation/">
                                <span>सम्पत्ति मूल्यांकन</span>
                            </a>
                        </li>

                        <li id="tax-clearance">
                            <a id="tax-clearance"
                               href="/tax-clearance/">
                                <span>कर सावधानी प्रमाणपत्र</span>
                            </a>
                        </li>
                    </ul>
                </li>



                <li id="id_parent">
                    <a href="javascript:void(0);" class="menu-toggle">

                        <span>जग्गा सम्बन्धित</span>
                    </a>
                    <ul class="ml-menu">

















                        <li id="lalpurja-pratilipi">
                            <a href="/lalpurja-pratilipi/">
                                <span>जग्गाधनी लाल पुर्जा प्रतिलिपि</span>
                            </a>
                        </li>
                        <li id='bato-kayam'>
                            <a href="/bato-kayam/" class="">
                                <span>बाटो कायम</span>
                            </a>
                        </li>
                        <li id='purjama-ghar-kayam'>
                            <a href="/purjama-ghar-kayam/" class="">
                                <span>जग्गाधनी पुर्जामा घर कायम</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li id="id_parent">
                    <a href="javascript:void(0);" class="menu-toggle">

                        <span>बसोबास  सम्बन्धित</span>
                    </a>
                    <ul class="ml-menu">
                        <li id="sthai-basobas">
                            <a href="/sthai-basobas/">
                                <span>स्थायी बसोबास</span>
                            </a>

                        </li>
                        <li id="asthai-basobas">
                            <a href="/asthai-basobas/">
                                <span>अस्थायी बसोबास</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li id="id_parent">
                    <a href="javascript:void(0);" class="menu-toggle">

                        <span>नागरिकता  सम्बन्धित</span>
                    </a>
                    <ul class="ml-menu">
                        <li id="citizenship-certificates">
                            <a href="/citizenship-certificates/">
                                <span>नागरिकता प्रमाण पत्र</span>
                            </a>

                        </li>
                        <li id="citizenship-certificate-replica">
                            <a href="/citizenship-certificate-replica/">
                                <span>नागरिकता प्रमाण पत्रको <br> प्रतिलिपि</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li id="id_parent">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <span>अन्य</span>
                    </a>
                    <ul class="ml-menu">
                        <li id="bibaha-pramanit">
                            <a href="/bibaha-pramanit/" class="">
                                <span>विवाह प्रमाणित</span>
                            </a>
                        </li>

                        <li id="four-piller">
                            <a href="/four-piller/" class="">
                                <span>चार किल्ला सम्बन्दमा</span>
                            </a>
                        </li>







                        <li id='drinking-water-connections'>
                            <a href="/drinking-water-connections/" class="">
                                <span>खानेपानी जडान</span>
                            </a>
                        </li>

                        <li id='bidhut-jadan'>
                            <a href="/bidhut-jadan/" class="">
                                <span>बिधुत जडान</span>
                            </a>
                        </li>

                        <li id='abibahit-pramanpatra'>
                            <a href="/abibahit-pramanpatra/" class="">
                                <span>अविवाहित प्रमाणपत्र</span>
                            </a>
                        </li>

                        <li id='janma-miti-pramanit'>
                            <a href="/janma-miti-pramanit/" class="">
                                <span>जन्म मिति प्रमाणित</span>
                            </a>
                        </li>

                        <li id='jet-machine'>
                            <a href="/jet-machine/" class="">
                                <span>जेट मेशिन</span>
                            </a>
                        </li>

                        <li id='farak-nam-thar'>
                            <a href="/farak-nam-thar/" class="">
                                <span>फरक नाम थर सिफारिस</span>
                            </a>
                        </li>

                        <li id='antarik-basai-sarai'>
                            <a href="/antarik-basai-sarai/" class="">
                                <span>आन्तरिक बसाई सराई </span>
                            </a>
                        </li>
                        <li id='sadak-khanne-swikriti'>
                            <a href="/sadak-khanne-swikriti/" class="">
                                <span>सडक खन्ने स्विकृति </span>
                            </a>
                        </li>
                        <li id='hakdar-pramanit'>
                            <a href="/hakdar-pramanit/" class="">
                                <span>हकदार प्रमाणित</span>
                            </a>
                        </li>

                        <li id='nabalak-pramanit'>
                            <a href="/nabalak-pramanit/" class="">
                                <span>नाबालक परिचयपत्र</span>
                            </a>
                        </li>
                        <li id='court-fee'>
                            <a href="/court-fee/" class="">
                                <span>अदालत शुल्क मिनाह</span>
                            </a>
                        </li>

                        <li id='kotha-khali-suchana'>
                            <a href="/kotha-khali-suchana/" class="">
                                <span>कोठा खाली सूचना</span>
                            </a>
                        </li>

                        <li id='nata-pramanit'>
                            <a href="/nata-pramanit/" class="">
                                <span>नाता प्रमाणित </span>
                            </a>
                        </li>

                        <li id='scholarship'>
                            <a href="/scholarship/" class="">
                                <span>छात्रवृत्ति सिफारिस</span>
                            </a>
                        </li>

                        <li id='prabhidik-mulyankan'>
                            <a href="/prabhidik-mulyankan/" class="">
                                <span>प्राबिधिक मुल्यांकन </span>
                            </a>
                        </li>

                        <li id='arthik-saheta'>
                            <a href="/arthik-saheta/" class="">
                                <span>आर्थिक सहायता</span>
                            </a>
                        </li>
                        <li id='home-distruction'>
                            <a href="/home-distruction/" class="">
                                <span>घर पाताल भएको</span>
                            </a>
                        </li>
                        <li id='add-classroom'>
                            <a href="/add-classroom/" class="">
                                <span>कक्षा कोठा थप</span>
                            </a>
                        </li>
                        <li id='mohi-lagat-katta'>
                            <a href="/mohi-lagat-katta/" class="">
                                <span>मोही लागत कट्ठा </span>
                            </a>
                        </li>
                        <li id='apanga-pramanpatra'>
                            <a href="/apanga-pramanpatra/" class="">
                                <span>अपाङ्ग प्रमाणपत्र  </span>
                            </a>
                        </li>

                    </ul>
                </li>

                <li id="id_parent" style="">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <span> <i class="fa fa-cogs"></i> सेटिङ्हरू</span>
                    </a>
                    <ul class="ml-menu">
                        <li id="type-of-houses">
                            <a href="/type-of-houses/">
                                <span>घरको प्रकार</span>
                            </a>
                        </li>

                        <li id="natas">
                            <a href="/natas/">
                                <span>नाता</span>
                            </a>
                        </li>

                        <li id="land-types">
                            <a href="/land-types/">
                                <span>जग्गाको क्षेत्रगत किसिम</span>
                            </a>
                        </li>

                        <li id="road-types">
                            <a href="/road-types/">
                                <span>बाटोको प्रकार</span>
                            </a>
                        </li>

                        <li id="citizenship-types">
                            <a href="/citizenship-types/">
                                <span>नागरिकताको किसिम</span>
                            </a>
                        </li>

                        <li id="offices">
                            <a href="/offices/">
                                <span>कार्यालय</span>
                            </a>
                        </li>

                        <li id="file-type">
                            <a href="/file-type/">
                                <span>कागजातको प्रकार</span>
                            </a>
                        </li>

                    </ul>
                </li>
            </ul>
        </div>


        <div class="legal">
            <div class="copyright" id="id_copyright">
                &copy; <b id="id_year"> </b> &nbsp; <a target="_blank" href="https://pdmt.com.np/">PDMT</a>
            </div>
        </div>
    </aside>
</section>








    <section class="content ">

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="django-messages">

                    </div>
                </div>
            </div>
        </div>



            <div class="container-fluid ">
                <nav aria-label="breadcrumb" class="bg-shadow">
                    <ol class="breadcrumb px-3 py-2">
                        <li class="breadcrumb-item ml-1"><a href="/">गृह</a></li>


        <li class="breadcrumb-item"><a href="/home-recommendations/">घर कायमको सिफारिस</a></li>

    <li class="breadcrumb-item active">आवेदकको विवरण</li>

                    </ol>
                </nav>
            </div>






        <div class="container-fluid font-kalimati">
            <div class="bd-example bd-example-tabs">
                <nav class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#details" role="tab"
                       aria-controls="home" aria-expanded="true">बिस्तृत</a>


                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#sifaris" role="tab"
                           aria-controls="profile" aria-expanded="false">सिफारिस</a>

                </nav>

                <div class="tab-content" id="nav-tabContent">

                    <div class="tab-pane fade active show" id="details" role="tabpanel" aria-labelledby="nav-home-tab"
                         aria-expanded="true">
                        <div class="row">
                            <div class="offset-lg-2 col-lg-8">
                                <table class="table table-bordered my-4 font-kalimati">
                                    <tbody>
                                    <tr>
                                        <td>
                                            फारम ID
                                        </td>
                                        <td>
                                            0209774319
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            स्वीकृत
                                        </td>
                                        <td>

                                                <h6 class="text-success">भएको</h6>

                                        </td>
                                    </tr>

                                    <tr class="text-center font-bold font-20">
                                        <td colspan="2">घर कायम सिफारिस विवरण
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            आवेदकको नाम
                                        </td>
                                        <td>धिरज प्रधान</td>
                                    </tr>

                                    <tr>
                                        <td>
                                            ठेगाना
                                        </td>
                                        <td>हतुवागढी गाउँपालिका वार्ड
                                            नं-१, भोजपुर
                                            प्रदेश-१</td>
                                    </tr>

                                    <tr>
                                        <td>
                                            साबिक ठेगाना
                                        </td>
                                        <td>
                                            बिराटनगर-4
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            हालको ठेगाना
                                        </td>
                                        <td>
                                            बिराटनगर-3
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            नक्सा सिट नं
                                        </td>
                                        <td>123</td>
                                    </tr>

                                    <tr>
                                        <td>
                                            कित्ता नं
                                        </td>
                                        <td>
                                            12
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            क्षेत्रफल
                                        </td>
                                        <td>
                                            12-2-2
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            घर नं
                                        </td>
                                        <td>

                                                123

                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            घरको प्रकार
                                        </td>
                                        <td>
                                            1
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            घर निर्माण भएको / आनुमति लिएको साल
                                        </td>
                                        <td>
                                            २०७१
                                        </td>
                                    </tr>
                                    <tr class="text-center font-bold font-20">
                                        <td colspan="2">कागजात</td>
                                    </tr>
                                    <tr>
                                        <td>कागजातहरू</td>
                                        <td>

                                                नभएको

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                        <div class="row">
                            <div class="offset-lg-2 col-lg-8">
                                <table class="table table-borderless ">
                                    <tbody>

                                    <tr>
                                        <td colspan="2">



                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                        <div class="tab-pane fade" id="sifaris" role="tabpanel" aria-labelledby="nav-profile-tab"
                             aria-expanded="false">

                            <div class="text-right">
                                <a class="btn  btn-success  mb-4"
                                   href="/home-recommendations/detail/4/?export=Sifaris"
                                   target="_blank"> <i class="fa fa-print"></i> &nbsp; &nbsp; छाप्नुहोस्</a>
                            </div>

                            <div class="font-22 text-black" style="line-height: 1.6;">
                                <div>
                                    <img src="/media/logo.png" alt="logo.png" style="height: auto; width: 16%; ">
                                    <p class=" pt-3 font-18 font-bold">
                                        पत्र संख्या: २०७५.७६<br>
                                        चलानी नं.: ४७
                                    </p>
                                </div>
                                <div class="text-center font-bold" style="margin-top: -200px;">
                                    <h2 style="font-size: 36px; font-weight:500; ">विराटनगर महानगरपालिका</h2>
                                    <h3 style="font-size: 34px; font-weight:500; margin-top: -5px;">१
                                        नं वार्ड
                                        कार्यालय</h3>
                                    <h3 style="margin-top: -5px; font-weight:500; font-size: 26px ">विराटनगर, मोरंग</h3>
                                    <p style="font-size: 22px; font-weight: 500; margin-top:-5px;">
                                        १ नं. प्रदेश, नेपाल </p>
                                </div>

                                <div>
                                    <p class="text-right font-bold">
                                        मिति :
                                    </p>
                                </div>


                                <div class="text-center mt-2 mb-5">
                                    <h4><span
                                            style="border-bottom: 1px solid black; margin-bottom: 3px;"> बिषय: घर कायम सिफारिस। </span>
                                    </h4>
                                </div>

                                <div style="line-height: 2.3; " class="mb-4">
                                    श्री मालपोत कार्यालय <br>
                                    बेलबारी मोरङ ।

                                </div>

                                <div class="text-justify">
                                    हतुवागढी गाउँपालिका वडा नं १ अन्तर्गत बस्ने
                                    श्री/सुश्री/श्रीमती धिरज प्रधान को नाममा श्रेस्ता दर्ता कायम रहेको
                                    (साबिक
                                    ठेगाना बिराटनगर-४) अन्तर्गतको निम्नमा उल्लेखित
                                    जग्गामा घर निर्माण गरि यस वडा
                                    कार्यालयमा निजले चालु आर्थिक वर्ष सम्मको घरजग्गा कर / सम्पत्ति कर चुक्ता गरिसकेको
                                    हुनाले निजको जग्गा
                                    धनी प्रमाणपुर्जामा घर कायम गरिदिन हुन सिफारिस साथ अनुरोध गरिन्छ।
                                </div>

                                <div class="mt-4">
                                    <table class="table table-bordered text-center">

                                        <thead>
                                        <tr class="text-bold">
                                            <th>क्र.स.</th>
                                            <th>
                                                साबिक ठेगाना
                                            </th>
                                            <th>
                                                हाल ठेगाना
                                            </th>
                                            <th>
                                                सिट नं
                                            </th>
                                            <th>
                                                कि नं
                                            </th>
                                            <th>
                                                क्षेत्रफल
                                            </th>
                                            <th>
                                                घर नं
                                            </th>
                                            <th>
                                                घरको प्रकार
                                            </th>
                                            <th>
                                                घर निर्माण भएको साल /<br>अनुमति लिएको
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="font-normal">
                                            <td class="font-kalimati">
                                                १
                                            </td>
                                            <td>
                                                बिराटनगर-४
                                            </td>
                                            <td>
                                                बिराटनगर-३
                                            </td>
                                            <td>

                                                    १२३

                                            </td>
                                            <td>

                                                    १२

                                            </td>
                                            <td>
                                                १२-२-२
                                            </td>
                                            <td>

                                                    १२३

                                            </td>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                २०७१
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div style="margin-top: 120px; margin-left: 700px;">
                                    <div class="text-center">
                                        ................................. <br>
                                        वडा अध्यक्ष
                                    </div>
                                </div>
                            </div>
                        </div>




                </div>
            </div>
        </div>


    </section>
</div>



    <script src="/static/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/static/js/popper.min.js"></script>
    <script src="/static/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/static/js/select2.min.js"></script>

    <script src="/static/js/admin.js"></script>
    <script type="text/javascript" src="/static/js/jquery.formset.js"></script>
    <script type="text/javascript" src="/static/js/custom.js"></script>
    <script type="text/javascript" src="/static/nepalidatepicker/nepali.datepicker.v2.2.min.js"></script>

    <script>

        $(document).ready(function () {
            $(".alert").delay(5000).fadeOut(500, function () {
                $(this).alert('close');
            });
        });


            $('body').on('change', '#choose-category', function () {
                var select = $(this).val();
                if (select) {
                    window.location.href = '/' + select;
                    select.attr('selected', 'selected');

                }

            });


        $(document).ready(function () {
            var pathname = window.location.pathname.split("/")[1];
            if (pathname) {

                $("#choose-category option").each(function () {
                    if ($(this).val() == pathname)
                        $(this).attr("selected", "selected");
                });
            }
        });
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
        $(document).ready(function () {
            $('.js-example-basic-single').select2();
        });

        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>




    <script src="/static/clipboard/dist/clipboard.min.js"></script>
    <script>

        $(function () {
            var clipboard = new ClipboardJS('.btn');

            clipboard.on('success', function (e) {
                alert('Copied ' + e.text + ' To Clipboard');
            });

            clipboard.on('error', function (e) {
                alert('Sorry Could Not Copy');
            });

        })


    </script>



</body>
</html>
