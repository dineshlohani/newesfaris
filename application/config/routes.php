<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'User';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
/*
|-------------------------------------------------------------------------------
| For Demo Purpose (All Login in 1)
|-------------------------------------------------------------------------------
*/
$route['demo-login']            = 'User/demo_login';
/*
|-------------------------------------------------------------------------------
|
|-------------------------------------------------------------------------------
*/
$route['general-settings']              	= 'Admin/general_setting';
$route['login']                         	= 'User/login';
$route['logout']                        	= 'User/logout';
$route['register']                      	= 'User/register';
$route['index']                         	= 'User/index';
$route['index/(:num)']                  	= 'User/index';
$route['dashboard']                    		= 'User/index';
$route['change-password']               	= 'User/change_password';
$route['change-password/(:num)']        	= 'User/change_password';
$route['user-view']                     	= 'User/user_view';
$route['user-edit/(:num)']                = 'User/editUser/$1';
$route['updateuser']                      = 'User/updateuser';

/*------------Settings------------------------------------*/
$route['add_office']                    	= "Settings/add_office";
$route['add_office/(:num)']             	= "Settings/add_office";
$route['office']                        	= "Settings/view_office";
$route['office/(:num)']                 	= "Settings/delete_office";
$route['get_categories/(:num)']         	= "Settings/getCategories";
$route['sifaris-type']         				= "Settings/getSifarisType";
$route['yain']         						= "Settings/yain";
$route['yain/(:num)']         				= "Settings/yain";

$route['bodartha']         					= "Settings/bodartha";
$route['bodartha/(:num)']         			= "Settings/bodartha";

$route['add_state']                     	= "Settings/add_state";
$route['add_state/(:num)']              	= "Settings/add_state";
$route['state']                         	= "Settings/view_state";
$route['state/(:num)']                  	= "Settings/delete_state";
$route['get_state/(:num)']              	= "Settings/getState";

$route['add_district']                  	= "Settings/add_district";
$route['add_district/(:num)']           	= "Settings/add_district";
$route['district']                      	= "Settings/view_district";
$route['district/(:num)']               	= "Settings/delete_district";
$route['get_district/(:num)']           	= "Settings/getDistrict";

$route['add_local']                     	= "Settings/add_local";
$route['add_local/(:num)']              	= "Settings/add_local";
$route['local']                         	= "Settings/view_local";
$route['local/(:num)']                  	= "Settings/delete_local";
$route['get_local/(:num)']              	= "Settings/getLocal";

$route['add_ward']                      	= "Settings/add_ward";
$route['add_ward/(:num)']               	= "Settings/add_ward";
$route['ward']                          	= "Settings/view_ward";
$route['ward/(:num)']                   	= "Settings/delete_ward";
$route['get_ward/(:num)']               	= "Settings/getWard";

$route['add_oldnew_address']            	= "Settings/add_oldnew_address";
$route['add_oldnew_address/(:num)']     	= "Settings/add_oldnew_address";
$route['old_new_address']               	= "Settings/view_oldnew_address";
$route['old_new_address/(:num)']        	= "Settings/delete_oldnew_address";
$route['get-oldnew-address/(:num)']     	= "Settings/getOldNewAddress";
$route['getNewAddress']                 	= "Settings/getNewAddress";

$route['add_road_type']                 	= "Settings/add_road_type";
$route['add_road_type/(:num)']          	= "Settings/add_road_type";
$route['road_type']                     	= "Settings/view_road_type";
$route['road_type/(:num)']              	= "Settings/delete_road_type";
$route['get-road-type/(:num)']          	= "Settings/getRoadType";

$route['add_home_type']                 	= "Settings/add_home_type";
$route['add_home_type/(:num)']          	= "Settings/add_home_type";
$route['home_type']                     	= "Settings/view_home_type";
$route['home_type/(:num)']              	= "Settings/delete_home_type";
$route['get-home-type/(:num)']          	= "Settings/getHomeType";

//get_post_by_worker_id
$route['get_post_by_worker_id']				= "Settings/get_post_by_worker_id";
$route['get_office_post_by_worker_id']		= "Settings/get_office_post_by_worker_id";


$route['add_direction']                 	= "Settings/add_direction";
$route['add_direction/(:num)']          	= "Settings/add_direction";
$route['direction']                     	= "Settings/view_direction";
$route['direction/(:num)']              	= "Settings/delete_direction";
$route['get-direction/(:num)']          	= "Settings/getDirection";

$route['add_relation']                  	= "Settings/add_relation";
$route['add_relation/(:num)']           	= "Settings/add_relation";
$route['relation']                      	= "Settings/view_relation";
$route['relation/(:num)']               	= "Settings/delete_relation";
$route['get-relation/(:num)']           	= "Settings/getRelation";

$route['add_disable_type']                  = "Settings/add_disable_type";
$route['add_disable_type/(:num)']           = "Settings/add_disable_type";
$route['disable-type']                      = "Settings/view_disable_type";
$route['disable-type/(:num)']               = "Settings/delete_disable_type";
$route['get-disable-type/(:num)']           = "Settings/getDisableType";

$route['add_eutype']                 		= "Settings/add_eutype";
$route['add_eutype/(:num)']          		= "Settings/add_eutype";
$route['eutype']                     		= "Settings/view_eutype";
$route['eutype/(:num)']              		= "Settings/delete_eutype";
$route['get-eutype/(:num)']          		= "Settings/getEutype";

$route['add_patra_category']                = "Settings/add_patra_category";
$route['add_patra_category/(:num)']         = "Settings/add_patra_category";
$route['patra-category']                    = "Settings/view_patra_category";
$route['patra-category/(:num)']             = "Settings/delete_patra_category";
$route['getPatraCategory/(:num)']           = "Settings/getPatraCategory";

$route['add_patra_item']                 	= "Settings/add_patra_item";
$route['add_patra_item/(:num)']          	= "Settings/add_patra_item";
$route['patra-item']                     	= "Settings/view_patra_item";
$route['patra-item/(:num)']              	= "Settings/delete_patra_item";
$route['getPatraItem/(:num)']            	= "Settings/getPatraItem";

$route['add_department']                 	= "Settings/add_department";
$route['add_department/(:num)']          	= "Settings/add_department";
$route['department']                     	= "Settings/view_department";
$route['department/(:num)']              	= "Settings/delete_department";
$route['getDepartment/(:num)']            	= "Settings/getDepartment";

$route['add_session']                 		= "Settings/add_session";
$route['add_session/(:num)']          		= "Settings/add_session";
$route['session']                     		= "Settings/view_session";
$route['session/(:num)']              		= "Settings/delete_session";
$route['getSession/(:num)']           		= "Settings/getSession";
$route['session/current']             		= "Settings/update_current_session";

$route['add-marriage-type']              	= "Settings/add_marriage_type";
$route['add-marriage-type/(:num)']       	= "Settings/add_marriage_type";
$route['marriage-type']                  	= "Settings/view_marriage_type";
$route['marriage-type/(:num)']           	= "Settings/delete_marriage_type";
$route['getMarriageType/(:num)']         	= "Settings/getMarriageType";

$route['add-document']               		= "Settings/add_document";
$route['add-document/(:num)']        		= "Settings/add_document";
$route['documents']                  		= "Settings/view_document";
$route['documents/(:num)']           		= "Settings/delete_document";
$route['getDocument/(:num)']         		= "Settings/getDocument";

$route['add-work']                   		= "Settings/add_work_type";
$route['add-work/(:num)']            		= "Settings/add_work_type";
$route['work-type']                  		= "Settings/view_work_type";
$route['work-type/(:num)']           		= "Settings/delete_work_type";
$route['getWork/(:num)']             		= "Settings/getWork";

$route['add-service']                		= "Settings/add_service_type";
$route['add-service/(:num)']         		= "Settings/add_work_type";
$route['service-type']               		= "Settings/view_service_type";
$route['service-type/(:num)']        		= "Settings/delete_service_type";
$route['getService/(:num)']          		= "Settings/getService";

$route['add-post']                			= "Settings/add_post";
$route['add-post/(:num)']         			= "Settings/add_post";
$route['post']                    			= "Settings/view_post";
$route['getPost/(:num)']          			= "Settings/getPost";

$route['add-worker']                		= "Settings/add_worker";
$route['add-worker/(:num)']         		= "Settings/add_worker";
$route['worker']                    		= "Settings/view_worker";
$route['getWorker/(:num)']          		= "Settings/getWorker";

$route['add-ward-worker']                	= "Settings/add_ward_worker";
$route['add-ward-worker/(:num)']         	= "Settings/add_ward_worker";
$route['ward-worker']                    	= "Settings/view_ward_worker";
$route['getWardWorker/(:num)']          	= "Settings/getWardWorker";
/*|------------------------------ Auto District and VDC ----------------------------------|*/
$route['get_districts']                     = "Settings/getdistrictHTML";
$route['get_districts_en']                  = "Settings/getdistrictHTMLEN";
$route['get_local_body']                    = "Settings/getlocalbodyHTML";
$route['get_local_body_en']                 = "Settings/getlocalbodyHTMLEN";
$route['get_local_body_ward']               = "Settings/getlocalbodyWard";

/*|-------------------------------- Currency API -----------------------------------|*/
$route['get-currency']                      = "Settings/currency";
/*|-------------------------------- Home -----------------------------------|*/
$route['home-dashboard']                = "Home/index";
/*|-------------------------- Home Recommend -------------------------------|*/


$route['home-recommend/create']                 = "Home/create_homeRecommend";
$route['home-recommend']                       	= "Home/view_home_recommends";
$route['home-recommend/detail/(:num)']	        = "Home/details_home_recommend";
$route['home-recommend/edit/(:num)']	        = "Home/edit_home_recommend";
$route['home-recommend/darta/(:num)']	        = "Home/darta_home_recommend";
$route['home-recommend/chalani/(:num)']	        = "Home/chalani_home_recommend";
$route['home-recommend/print/(:num)']	        = "Home/print_home_recommend";

/*-----------------------Home Road Certify-----------------------------------------*/

$route['home-road-certify/create']          = "Home/create_road_certify";
$route['home-road-certify/detail/(:num)']   = "Home/details_road_certify";
$route['home-road-certify/edit/(:num)']     = "Home/edit_road_certify";
$route['home-road-certify/darta/(:num)']    = "Home/darta_road_certify";
$route['home-road-certify/chalani/(:num)']  = "Home/chalani_road_certify";
$route['home-road-certify/print/(:num)']    = "Home/print_road_certify";
$route['home-road-certify']                 = "Home/view_road_certify";
$route['getRoadCertifyHTML']                = "Home/getRoadCertifyHTML";
$route['getRoadDocumentHTML']               = "Home/getRoadDocumentHTML";
$route['getHaalAddress']                    = "Home/getHaalAddress";


/*|-----------------------------------------------------------------------------|*/

/*----------------------- Ghar Jagga Namsari -----------------------------------------*/

$route['ghar-jagga-namsari/create']             = "Home/create_ghar_jagga_namsari";
$route['ghar-jagga-namsari/detail/(:num)']      = "Home/detail_ghar_jagga_namsari";
$route['ghar-jagga-namsari/edit/(:num)']        = "Home/edit_ghar_jagga_namsari";
$route['ghar-jagga-namsari/darta/(:num)']       = "Home/darta_ghar_jagga_namsari";
$route['ghar-jagga-namsari/chalani/(:num)']     = "Home/chalani_ghar_jagga_namsari";
$route['ghar-jagga-namsari/print/(:num)']       = "Home/print_ghar_jagga_namsari";
$route['ghar-jagga-namsari']                    = "Home/view_ghar_jagga_namsari";
$route['getGharJaggaDocumentHTML']              = "Home/getGharJaggaDocumentHTML";
/*|-----------------------------------------------------------------------------|*/
/*----------------------- Kitta Kat Sifaris -----------------------------------------*/

$route['kitta-kat-sifaris/create']              = "Home/create_kitta_kat_sifaris";
$route['kitta-kat-sifaris/detail/(:num)']       = "Home/detail_kitta_kat_sifaris";
$route['kitta-kat-sifaris/edit/(:num)']         = "Home/edit_kitta_kat_sifaris";
$route['kitta-kat-sifaris/darta/(:num)']        = "Home/darta_kitta_kat_sifaris";
$route['kitta-kat-sifaris/chalani/(:num)']      = "Home/chalani_kitta_kat_sifaris";
$route['kitta-kat-sifaris/print/(:num)']        = "Home/print_kitta_kat_sifaris";
$route['kitta-kat-sifaris']                     = "Home/view_kitta_kat_sifaris";
$route['getGharJaggaDocumentHTML']              = "Home/getGharJaggaDocumentHTML";
/*|-----------------------------------------------------------------------------|*/

/*|-----------------------------------Business-----------------------------------|*/
$route['business-dashboard']                    = "Business/index";

/*|------------------------------Sanstha Darta Pramanpatra --------------------------|*/
$route['sanstha-darta-pramanpatra/create']              = "Business/create_sanstha_darta_pramanpatra";
$route['sanstha-darta-pramanpatra/detail/(:num)']       = "Business/detail_sanstha_darta_pramanpatra";
$route['sanstha-darta-pramanpatra/edit/(:num)']         = "Business/edit_sanstha_darta_pramanpatra";
$route['sanstha-darta-pramanpatra/darta/(:num)']        = "Business/darta_sanstha_darta_pramanpatra";
$route['sanstha-darta-pramanpatra/chalani/(:num)']      = "Business/chalani_sanstha_darta_pramanpatra";
$route['sanstha-darta-pramanpatra/print/(:num)']        = "Business/print_sanstha_darta_pramanpatra";
$route['sanstha-darta-pramanpatra']                     = "Business/view_sanstha_darta_pramanpatra";

/*|------------------------------Bebasaya Darta Pramanpatra --------------------------|*/
$route['bebasaya-darta/create']              = "Business/create_bebasaya_darta";
$route['bebasaya-darta/detail/(:num)']       = "Business/detail_bebasaya_darta";
$route['bebasaya-darta/edit/(:num)']         = "Business/edit_bebasaya_darta";
$route['bebasaya-darta/darta/(:num)']        = "Business/darta_bebasaya_darta";
$route['bebasaya-darta/chalani/(:num)']      = "Business/chalani_bebasaya_darta";
$route['bebasaya-darta/print/(:num)']        = "Business/print_bebasaya_darta";
$route['bebasaya-darta']                     = "Business/view_bebasaya_darta";

/*|------------------------------Bebasaya Darta Sifaris --------------------------|*/
$route['bebasaya-sifaris/create']              = "Business/create_bebasaya_sifaris";
$route['bebasaya-sifaris/detail/(:num)']       = "Business/detail_bebasaya_sifaris";
$route['bebasaya-sifaris/edit/(:num)']         = "Business/edit_bebasaya_sifaris";
$route['bebasaya-sifaris/darta/(:num)']        = "Business/darta_bebasaya_sifaris";
$route['bebasaya-sifaris/chalani/(:num)']      = "Business/chalani_bebasaya_sifaris";
$route['bebasaya-sifaris/print/first/(:num)']   = "Business/print_bebasaya_sifaris_first";
$route['bebasaya-sifaris/print/second/(:num)']  = "Business/print_bebasaya_sifaris_second";
$route['bebasaya-sifaris']                     = "Business/view_bebasaya_sifaris";

/*|------------------------------Bebasaya Banda --------------------------|*/
$route['bebasaya-banda/create']              = "Business/create_bebasaya_banda";
$route['bebasaya-banda/detail/(:num)']       = "Business/detail_bebasaya_banda";
$route['bebasaya-banda/edit/(:num)']         = "Business/edit_bebasaya_banda";
$route['bebasaya-banda/darta/(:num)']        = "Business/darta_bebasaya_banda";
$route['bebasaya-banda/chalani/(:num)']      = "Business/chalani_bebasaya_banda";
$route['bebasaya-banda/print/(:num)']        = "Business/print_bebasaya_banda";
$route['bebasaya-banda']                     = "Business/view_bebasaya_banda";

/*|------------------------------ Sanstha Darta --------------------------|*/
$route['sanstha-darta/create']              = "Business/create_sanstha_darta";
$route['sanstha-darta/detail/(:num)']       = "Business/detail_sanstha_darta";
$route['sanstha-darta/edit/(:num)']         = "Business/edit_sanstha_darta";
$route['sanstha-darta/darta/(:num)']        = "Business/darta_sanstha_darta";
$route['sanstha-darta/chalani/(:num)']      = "Business/chalani_sanstha_darta";
$route['sanstha-darta/print/(:num)']        = "Business/print_sanstha_darta";
$route['sanstha-darta']                     = "Business/view_sanstha_darta";

/*|------------------------------ Sanstha Nabikaran --------------------------|*/
$route['sanstha-nabikaran/create']              = "Business/create_sanstha_nabikaran";
$route['sanstha-nabikaran/detail/(:num)']       = "Business/detail_sanstha_nabikaran";
$route['sanstha-nabikaran/edit/(:num)']         = "Business/edit_sanstha_nabikaran";
$route['sanstha-nabikaran/darta/(:num)']        = "Business/darta_sanstha_nabikaran";
$route['sanstha-nabikaran/chalani/(:num)']      = "Business/chalani_sanstha_nabikaran";
$route['sanstha-nabikaran/print/(:num)']        = "Business/print_sanstha_nabikaran";
$route['sanstha-nabikaran']                     = "Business/view_sanstha_nabikaran";

/*|------------------------------------------------------------------------------|*/
/*|---------------------------------- Property ----------------------------------|*/
$route['property-dashboard']                    = "Property/index";

/*|------------------------------ Income Verification --------------------------|*/
$route['income-verification/create']              = "Property/create_income_verification";

$route['income-verification/detail/(:num)']       = "Property/detail_income_verification";

$route['income-verification/edit/(:num)']         = "Property/edit_income_verification";

$route['income-verification/darta/(:num)']        = "Property/darta_income_verification";

$route['income-verification/chalani/(:num)']      = "Property/chalani_income_verification";

$route['income-verification/print/(:num)']        = "Property/print_income_verification";

$route['income-verification']                     = "Property/view_income_verification";

$route['getIncomeVerificationHTML']               = "Property/getIncomeVerificationHTML";

/*|------------------------------ Property Valuation --------------------------|*/
$route['property-valuation/create']              = "Property/create_property_valuation";
$route['property-valuation/detail/(:num)']       = "Property/detail_property_valuation";
$route['property-valuation/edit/(:num)']         = "Property/edit_property_valuation";
$route['property-valuation/darta/(:num)']        = "Property/darta_property_valuation";
$route['property-valuation/chalani/(:num)']      = "Property/chalani_property_valuation";
$route['property-valuation/print/(:num)']        = "Property/print_property_valuation";
$route['property-valuation']                     = "Property/view_property_valuation";
$route['getPropertyValuationHTML']               = "Property/getPropertyValuationHTML";

/*|------------------------------ Tax Clearance --------------------------|*/
$route['tax-clearance/create']              = "Property/create_tax_clearance";
$route['tax-clearance/detail/(:num)']       = "Property/detail_tax_clearance";
$route['tax-clearance/edit/(:num)']         = "Property/edit_tax_clearance";
$route['tax-clearance/darta/(:num)']        = "Property/darta_tax_clearance";
$route['tax-clearance/chalani/(:num)']      = "Property/chalani_tax_clearance";
$route['tax-clearance/print/(:num)']        = "Property/print_tax_clearance";
$route['tax-clearance']                     = "Property/view_tax_clearance";


/*|--------------------------------------------------------------------------------|*/
/*|---------------------------------- Settlement ----------------------------------|*/
$route['settlement-dashboard']                    = "Settlement/index";

/*|------------------------------ Sthai Basobas --------------------------|*/
$route['sthai-basobas/create']              = "Settlement/create_sthai_basobas";
$route['sthai-basobas/detail/(:num)']       = "Settlement/detail_sthai_basobas";
$route['sthai-basobas/edit/(:num)']         = "Settlement/edit_sthai_basobas";
$route['sthai-basobas/darta/(:num)']        = "Settlement/darta_sthai_basobas";
$route['sthai-basobas/chalani/(:num)']      = "Settlement/chalani_sthai_basobas";
$route['sthai-basobas/print/(:num)']        = "Settlement/print_sthai_basobas";
$route['sthai-basobas']                     = "Settlement/view_sthai_basobas";

/*|------------------------------ Asthai Basobas --------------------------|*/
$route['asthai-basobas/create']              = "Settlement/create_asthai_basobas";
$route['asthai-basobas/detail/(:num)']       = "Settlement/detail_asthai_basobas";
$route['asthai-basobas/edit/(:num)']         = "Settlement/edit_asthai_basobas";
$route['asthai-basobas/darta/(:num)']        = "Settlement/darta_asthai_basobas";
$route['asthai-basobas/chalani/(:num)']      = "Settlement/chalani_asthai_basobas";
$route['asthai-basobas/print/(:num)']        = "Settlement/print_asthai_basobas";
$route['asthai-basobas']                     = "Settlement/view_asthai_basobas";

/*|------------------------------ Antarik Basai Sarai --------------------------|*/
$route['antarik-basai-sarai/create']              = "Settlement/create_antarik_basai_sarai";
$route['antarik-basai-sarai/detail/(:num)']       = "Settlement/detail_antarik_basai_sarai";
$route['antarik-basai-sarai/edit/(:num)']         = "Settlement/edit_antarik_basai_sarai";
$route['antarik-basai-sarai/darta/(:num)']        = "Settlement/darta_antarik_basai_sarai";
$route['antarik-basai-sarai/chalani/(:num)']      = "Settlement/chalani_antarik_basai_sarai";
$route['antarik-basai-sarai/print/(:num)']        = "Settlement/print_antarik_basai_sarai";
$route['antarik-basai-sarai']                     = "Settlement/view_antarik_basai_sarai";
$route['getAntarikBasaiSaraiHTML']                = "Settlement/getAntarikBasaiSaraiHTML";

/*|---------------------------------- Others ----------------------------------|*/
$route['others-dashboard']                       = "Others/index";

/*|------------------------------ Mirtyu Darta --------------------------------|*/
$route['mirtyu-darta/create']              = "Others/create_mirtyu_darta";
$route['mirtyu-darta/detail/(:num)']       = "Others/detail_mirtyu_darta";
$route['mirtyu-darta/edit/(:num)']         = "Others/edit_mirtyu_darta";
$route['mirtyu-darta/darta/(:num)']        = "Others/darta_mirtyu_darta";
$route['mirtyu-darta/chalani/(:num)']      = "Others/chalani_mirtyu_darta";
$route['mirtyu-darta/print/(:num)']        = "Others/print_mirtyu_darta";
$route['mirtyu-darta']                     = "Others/view_mirtyu_darta";

/*|------------------------------ Apanga Pramanpatra --------------------------|*/
$route['apanga-pramanpatra/create']              = "Others/create_apanga_pramanpatra";
$route['apanga-pramanpatra/detail/(:num)']       = "Others/detail_apanga_pramanpatra";
$route['apanga-pramanpatra/edit/(:num)']         = "Others/edit_apanga_pramanpatra";
$route['apanga-pramanpatra/darta/(:num)']        = "Others/darta_apanga_pramanpatra";
$route['apanga-pramanpatra/chalani/(:num)']      = "Others/chalani_apanga_pramanpatra";
$route['apanga-pramanpatra/print/(:num)']        = "Others/print_apanga_pramanpatra";
$route['apanga-pramanpatra']                     = "Others/view_apanga_pramanpatra";

/*|------------------------------ Classroom Add --------------------------|*/
$route['add-classroom/create']              = "Others/create_add_classroom";
$route['add-classroom/detail/(:num)']       = "Others/detail_add_classroom";
$route['add-classroom/edit/(:num)']         = "Others/edit_add_classroom";
$route['add-classroom/darta/(:num)']        = "Others/darta_add_classroom";
$route['add-classroom/chalani/(:num)']      = "Others/chalani_add_classroom";
$route['add-classroom/print/(:num)']        = "Others/print_add_classroom";
$route['add-classroom']                     = "Others/view_add_classroom";

/*|------------------------------ Ghar Patala -------------------------|*/
$route['ghar-patala/create']              = "Others/create_ghar_patala";
$route['ghar-patala/detail/(:num)']       = "Others/detail_ghar_patala";
$route['ghar-patala/edit/(:num)']         = "Others/edit_ghar_patala";
$route['ghar-patala/darta/(:num)']        = "Others/darta_ghar_patala";
$route['ghar-patala/chalani/(:num)']      = "Others/chalani_ghar_patala";
$route['ghar-patala/print/(:num)']        = "Others/print_ghar_patala";
$route['ghar-patala']                     = "Others/view_ghar_patala";

/*|------------------------------ Arthik Saheta -------------------------|*/
$route['arthik-saheta/create']              = "Others/create_arthik_saheta";
$route['arthik-saheta/detail/(:num)']       = "Others/detail_arthik_saheta";
$route['arthik-saheta/edit/(:num)']         = "Others/edit_arthik_saheta";
$route['arthik-saheta/darta/(:num)']        = "Others/darta_arthik_saheta";
$route['arthik-saheta/chalani/(:num)']      = "Others/chalani_arthik_saheta";
$route['arthik-saheta/print/(:num)']        = "Others/print_arthik_saheta";
$route['arthik-saheta']                     = "Others/view_arthik_saheta";

/*|------------------------------ Prabhidik Mulyankan -------------------------|*/
$route['prabhidik-mulyankan/create']              = "Others/create_prabhidik_mulyankan";
$route['prabhidik-mulyankan/detail/(:num)']       = "Others/detail_prabhidik_mulyankan";
$route['prabhidik-mulyankan/edit/(:num)']         = "Others/edit_prabhidik_mulyankan";
$route['prabhidik-mulyankan/darta/(:num)']        = "Others/darta_prabhidik_mulyankan";
$route['prabhidik-mulyankan/chalani/(:num)']      = "Others/chalani_prabhidik_mulyankan";
$route['prabhidik-mulyankan/print/(:num)']        = "Others/print_prabhidik_mulyankan";
$route['prabhidik-mulyankan']                     = "Others/view_prabhidik_mulyankan";

/*|------------------------------ Scholarship -------------------------|*/
$route['scholarship/create']              = "Others/create_scholarship";
$route['scholarship/detail/(:num)']       = "Others/detail_scholarship";
$route['scholarship/edit/(:num)']         = "Others/edit_scholarship";
$route['scholarship/darta/(:num)']        = "Others/darta_scholarship";
$route['scholarship/chalani/(:num)']      = "Others/chalani_scholarship";
$route['scholarship/print/(:num)']        = "Others/print_scholarship";
$route['scholarship']                     = "Others/view_scholarship";
$route['getScholarshipHTML']              = "Others/getScholarshipHTML";

/*|------------------------------ Nata Pramanit -------------------------|*/
$route['nata-pramanit/create']              = "Others/create_nata_pramanit";
$route['nata-pramanit/detail/(:num)']       = "Others/detail_nata_pramanit";
$route['nata-pramanit/edit/(:num)']         = "Others/edit_nata_pramanit";
$route['nata-pramanit/darta/(:num)']        = "Others/darta_nata_pramanit";
$route['nata-pramanit/chalani/(:num)']      = "Others/chalani_nata_pramanit";
$route['nata-pramanit/print/(:num)']        = "Others/print_nata_pramanit";
$route['nata-pramanit']                     = "Others/view_nata_pramanit";
$route['getNataPramanitHTML']               = "Others/getNataPramanitHTML";

/*|------------------------------ Kotha Khali Suchana -------------------------|*/
$route['kotha-khali-suchana/create']              = "Others/create_kotha_khali_suchana";
$route['kotha-khali-suchana/detail/(:num)']       = "Others/detail_kotha_khali_suchana";
$route['kotha-khali-suchana/edit/(:num)']         = "Others/edit_kotha_khali_suchana";
$route['kotha-khali-suchana/darta/(:num)']        = "Others/darta_kotha_khali_suchana";
$route['kotha-khali-suchana/chalani/(:num)']      = "Others/chalani_kotha_khali_suchana";
$route['kotha-khali-suchana/print/(:num)']        = "Others/print_kotha_khali_suchana";
$route['kotha-khali-suchana']                     = "Others/view_kotha_khali_suchana";

/*|------------------------------ Adalat Sulka Minha -------------------------|*/
$route['court-fee/create']              = "Others/create_court_fee";
$route['court-fee/detail/(:num)']       = "Others/detail_court_fee";
$route['court-fee/edit/(:num)']         = "Others/edit_court_fee";
$route['court-fee/darta/(:num)']        = "Others/darta_court_fee";
$route['court-fee/chalani/(:num)']      = "Others/chalani_court_fee";
$route['court-fee/print/(:num)']        = "Others/print_court_fee";
$route['court-fee']                     = "Others/view_court_fee";

/*|------------------------------ Hakdar Pramanit -------------------------|*/
$route['hakdar-pramanit/create']              = "Others/create_hakdar_pramanit";
$route['hakdar-pramanit/detail/(:num)']       = "Others/detail_hakdar_pramanit";
$route['hakdar-pramanit/edit/(:num)']         = "Others/edit_hakdar_pramanit";
$route['hakdar-pramanit/darta/(:num)']        = "Others/darta_hakdar_pramanit";
$route['hakdar-pramanit/chalani/(:num)']      = "Others/chalani_hakdar_pramanit";
$route['hakdar-pramanit/print/(:num)']        = "Others/print_hakdar_pramanit";
$route['hakdar-pramanit']                     = "Others/view_hakdar_pramanit";

/*|------------------------------ Sadak Khanne Swikriti -------------------------|*/
$route['sadak-khanne-swikriti/create']              = "Others/create_sadak_khanne_swikriti";
$route['sadak-khanne-swikriti/detail/(:num)']       = "Others/detail_sadak_khanne_swikriti";
$route['sadak-khanne-swikriti/edit/(:num)']         = "Others/edit_sadak_khanne_swikriti";
$route['sadak-khanne-swikriti/darta/(:num)']        = "Others/darta_sadak_khanne_swikriti";
$route['sadak-khanne-swikriti/chalani/(:num)']      = "Others/chalani_sadak_khanne_swikriti";
$route['sadak-khanne-swikriti/print/(:num)/(:num)'] = "Others/print_sadak_khanne_swikriti";
$route['sadak-khanne-swikriti']                     = "Others/view_sadak_khanne_swikriti";

/*|------------------------------ Farak Naam Thar -------------------------|*/
$route['farak-nam-thar/create']              = "Others/create_farak_nam_thar";
$route['farak-nam-thar/detail/(:num)']       = "Others/detail_farak_nam_thar";
$route['farak-nam-thar/edit/(:num)']         = "Others/edit_farak_nam_thar";
$route['farak-nam-thar/darta/(:num)']        = "Others/darta_farak_nam_thar";
$route['farak-nam-thar/chalani/(:num)']      = "Others/chalani_farak_nam_thar";
$route['farak-nam-thar/print/(:num)'] = "Others/print_farak_nam_thar";
$route['farak-nam-thar']                     = "Others/view_farak_nam_thar";

/*|------------------------------ Jet Machine -------------------------|*/
$route['jet-machine/create']              = "Others/create_jet_machine";
$route['jet-machine/detail/(:num)']       = "Others/detail_jet_machine";
$route['jet-machine/edit/(:num)']         = "Others/edit_jet_machine";
$route['jet-machine/darta/(:num)']        = "Others/darta_jet_machine";
$route['jet-machine/chalani/(:num)']      = "Others/chalani_jet_machine";
$route['jet-machine/print/(:num)']        = "Others/print_jet_machine";
$route['jet-machine']                     = "Others/view_jet_machine";

/*|------------------------------ Bibaha Pramanit --------------------------|*/
$route['bibaha-pramanit/create']              = "Others/create_bibaha_pramanit";
$route['bibaha-pramanit/detail/(:num)']       = "Others/detail_bibaha_pramanit";
$route['bibaha-pramanit/edit/(:num)']         = "Others/edit_bibaha_pramanit";
$route['bibaha-pramanit/darta/(:num)']        = "Others/darta_bibaha_pramanit";
$route['bibaha-pramanit/chalani/(:num)']      = "Others/chalani_bibaha_pramanit";
$route['bibaha-pramanit/print/(:num)']        = "Others/print_bibaha_pramanit";
$route['bibaha-pramanit']                     = "Others/view_bibaha_pramanit";


/*|------------------------------ Khanepani Jadan --------------------------|*/
$route['khanepani-jadan/create']              = "Others/create_khanepani_jadan";
$route['khanepani-jadan/detail/(:num)']       = "Others/detail_khanepani_jadan";
$route['khanepani-jadan/edit/(:num)']         = "Others/edit_khanepani_jadan";
$route['khanepani-jadan/darta/(:num)']        = "Others/darta_khanepani_jadan";
$route['khanepani-jadan/chalani/(:num)']      = "Others/chalani_khanepani_jadan";
$route['khanepani-jadan/print/(:num)']        = "Others/print_khanepani_jadan";
$route['khanepani-jadan']                     = "Others/view_khanepani_jadan";

/*|------------------------------ Biduth Jadan --------------------------|*/
$route['biduth-jadan/create']              = "Others/create_biduth_jadan";
$route['biduth-jadan/detail/(:num)']       = "Others/detail_biduth_jadan";
$route['biduth-jadan/edit/(:num)']         = "Others/edit_biduth_jadan";
$route['biduth-jadan/darta/(:num)']        = "Others/darta_biduth_jadan";
$route['biduth-jadan/chalani/(:num)']      = "Others/chalani_biduth_jadan";
$route['biduth-jadan/print/(:num)']        = "Others/print_biduth_jadan";
$route['biduth-jadan']                     = "Others/view_biduth_jadan";

/*|------------------------------ Abibhahit Pramanpatra --------------------------|*/
$route['abibhahit-pramanpatra/create']              = "Others/create_abibhahit_pramanpatra";
$route['abibhahit-pramanpatra/detail/(:num)']       = "Others/detail_abibhahit_pramanpatra";
$route['abibhahit-pramanpatra/edit/(:num)']         = "Others/edit_abibhahit_pramanpatra";
$route['abibhahit-pramanpatra/darta/(:num)']        = "Others/darta_abibhahit_pramanpatra";
$route['abibhahit-pramanpatra/chalani/(:num)']      = "Others/chalani_abibhahit_pramanpatra";
$route['abibhahit-pramanpatra/print/(:num)']        = "Others/print_abibhahit_pramanpatra";
$route['abibhahit-pramanpatra']                     = "Others/view_abibhahit_pramanpatra";

/*|------------------------------ JANMA MITI PRAMANIT --------------------------|*/
$route['janma-miti-pramanit/create']              = "Others/create_janma_miti_pramanit";
$route['janma-miti-pramanit/detail/(:num)']       = "Others/detail_janma_miti_pramanit";
$route['janma-miti-pramanit/edit/(:num)']         = "Others/edit_janma_miti_pramanit";
$route['janma-miti-pramanit/darta/(:num)']        = "Others/darta_janma_miti_pramanit";
$route['janma-miti-pramanit/chalani/(:num)']      = "Others/chalani_janma_miti_pramanit";
$route['janma-miti-pramanit/print/(:num)']        = "Others/print_janma_miti_pramanit";
$route['janma-miti-pramanit']                     = "Others/view_janma_miti_pramanit";

/*|------------------------------ Tin Pusta Pramanit --------------------------|*/
$route['tin-pusta-pramanit/create']               = 'Others/create_tin_pusta_pramanit';
$route['tin-pusta-pramanit/detail/(:num)']        = 'Others/detail_tin_pusta_pramanit';
$route['tin-pusta-pramanit/edit/(:num)']          = 'Others/edit_tin_pusta_pramanit';
$route['tin-pusta-pramanit/darta/(:num)']         = 'Others/darta_tin_pusta_pramanit';
$route['tin-pusta-pramanit/chalani/(:num)']       = 'Others/chalani_tin_pusta_pramanit';
$route['tin-pusta-pramanit/print/(:num)']         = 'Others/print_tin_pusta_pramanit';
$route['tin-pusta-pramanit']                      = 'Others/view_tin_pusta_pramanit';
$route['getTinPustaHTML']                         = 'Others/getTinPustaHTML';

/*|------------------------------ Farak Janma Miti --------------------------|*/
$route['farak-janma-miti/create']                 = 'Others/create_farak_janma_miti';
$route['farak-janma-miti/detail/(:num)']          = 'Others/detail_farak_janma_miti';
$route['farak-janma-miti/edit/(:num)']            = 'Others/edit_farak_janma_miti';
$route['farak-janma-miti/darta/(:num)']           = 'Others/darta_farak_janma_miti';
$route['farak-janma-miti/chalani/(:num)']         = 'Others/chalani_farak_janma_miti';
$route['farak-janma-miti/print/(:num)']           = 'Others/print_farak_janma_miti';
$route['farak-janma-miti']                        = 'Others/view_farak_janma_miti';

/*|------------------------------ Farak farak Hijje --------------------------|*/
$route['farak-hijje/create']                 = 'Others/create_farak_hijje';
$route['farak-hijje/detail/(:num)']          = 'Others/detail_farak_hijje';
$route['farak-hijje/edit/(:num)']            = 'Others/edit_farak_hijje';
$route['farak-hijje/darta/(:num)']           = 'Others/darta_farak_hijje';
$route['farak-hijje/chalani/(:num)']         = 'Others/chalani_farak_hijje';
$route['farak-hijje/print/(:num)']           = 'Others/print_farak_hijje';
$route['farak-hijje']                        = 'Others/view_farak_hijje';

/*|------------------------------ land --------------------------|*/
$route['land-dashboard']                    = "Land/index";

/*|------------------------------ lalpurja_pratilipi--------------------------|*/
$route['lalpurja-pratilipi/create']                    = "Land/create_lalpurja_pratilipi";
$route['lalpurja-pratilipi/edit/(:any)']               = "Land/edit_lalpurja_pratilipi";
$route['lalpurja-pratilipi']                           = "Land/pratilipi_view";
$route['lalpurja-pratilipi/(:any)']                    = "Land/pratilipi_view";
$route['getLandDocumentHTML']                          = "Land/getLandDocumentHTML";
$route['lalpurja-pratilipi/darta/(:num)']              = "Land/lalpurja_pratilipi_darta";
$route['lalpurja-pratilipi/details/(:num)']            = "Land/lalpurja_darta_details";
$route['lalpurja-pratilipi/chalani/(:num)']            = "Land/lalpurja_pratiliti_chalani";
$route['lalpurja-pratilipi/print/(:num)']              = "Land/lalpurja_pratiliti_print";

/*|------------------------------ bato kayam  --------------------------|*/
$route['bato-kayam/create']                    			= "Land/create_bato_kayam";
$route['bato-kayam/edit/(:num)']               			= "Land/edit_bato_kayam";
$route['bato-kayam']                   					= "Land/bato_kayam_view";
$route['bato-kayam/darta/(:num)']              			= "Land/bato_kayam_darta";
$route['bato-kayam/chalani/(:num)']            			= "Land/bato_kayam_chalani";
$route['bato-kayam/print/(:num)']              			= "Land/bato_kayam_print";
$route['bato-kayam/details/(:num)']            			= "Land/bato_kayam_details";

/*|------------------------------ purjama ghar kayam  --------------------------|*/
$route['purjama-ghar-kayam/create']                    	= "Land/create_purjama_ghar_kayam";
$route['purjama-ghar-kayam/edit/(:num)']               	= "Land/edit_purjama_ghar_kayam";
$route['purjama-ghar-kayam']                   		 	= "Land/purjama_ghar_kayam_view";
$route['purjama-ghar-kayam/darta/(:num)']              	= "Land/purjama_ghar_kayam_darta";
$route['purjama-ghar-kayam/chalani/(:num)']            	= "Land/purjama_ghar_kayam_chalani";
$route['purjama-ghar-kayam/print/(:num)']              	= "Land/purjama_ghar_kayam_print";
$route['purjama-ghar-kayam/details/(:num)']            	= "Land/purjama_ghar_kayam_details";

/*|------------------------------ Mohi Lagat  --------------------------|*/
$route['mohi-lagat-katta/create']                    = "Land/create_mohi_lagat_katta";
$route['mohi-lagat-katta/edit/(:num)']               = "Land/edit_mohi_lagat_katta";
$route['mohi-lagat-katta']                   = "Land/mohi_lagat_katta_view";
$route['mohi-lagat-katta/darta/(:num)']              = "Land/mohi_lagat_katta_darta";
$route['mohi-lagat-katta/chalani/(:num)']            = "Land/mohi_lagat_katta_chalani";
$route['mohi-lagat-katta/print/(:num)']              = "Land/mohi_lagat_katta_print";
$route['mohi-lagat-katta/details/(:num)']            = "Land/mohi_lagat_katta_details";

/*|------------------------------ Char Killa--------------------------|*/
$route['char-killa/create']                    = "Land/create_char_killa";
$route['char-killa/edit/(:num)']               = "Land/edit_char_killa";
$route['char-killa']                   			= "Land/char_killa_view";
$route['char-killa/darta/(:num)']              = "Land/char_killa_darta";
$route['char-killa/chalani/(:num)']            = "Land/char_killa_chalani";
$route['char-killa/print/(:num)']              = "Land/char_killa_print";
$route['char-killa/details/(:num)']            = "Land/char_killa_details";
$route['getCharKillaHTML']                     = "Land/getCharKillaHTML";
$route['getOldNew']                            = "Land/getOldNew";

/*|------------------------------ ******* -------------------------|*/
/*|------------------------------ Certificates--------------------------|*/
/*|------------------------------ ******** --------------------------|*/
$route['certificate-dashboard']                    = "Certificate/index";
/*|------------------------------ citizenShip Certificate--------------------------|*/

$route['citizenship-certificate/create']                    = "Certificate/create_citizenship_certificate";
$route['citizenship-certificate/edit/(:num)']               = "Certificate/edit_citizenship_certificate";
$route['citizenship-certificate']                   		= "Certificate/citizenship_certificate_view";
$route['citizenship-certificate/darta/(:num)']              = "Certificate/citizenship_certificate_darta";
$route['citizenship-certificate/chalani/(:num)']            = "Certificate/citizenship_certificate_chalani";
$route['citizenship-certificate/print/first/(:num)']        = "Certificate/citizenship_certificate_print_first";
$route['citizenship-certificate/print/second/(:num)']       = "Certificate/citizenship_certificate_print_second";
$route['citizenship-certificate/details/(:num)']            = "Certificate/citizenship_certificate_details";
$route['getCertificateDocumentHTML']                        = "Certificate/getCertificateDocumentHTML";
$route['getConvertedDate']                                  = "Certificate/getConvertedDate";


/*|------------------------------ ******** --------------------------|*/
/*|------------------------------ Certificates Ends--------------------------|*/
/*|------------------------------ ******** --------------------------|*/

/*|------------------------------ citizenShip Certificate Pratilipi--------------------------|*/

$route['citizenship-certificate-pratilipi/create']                    = "Certificate/create_citizenship_certificate_pratilipi";
$route['citizenship-certificate-pratilipi/edit/(:num)']               = "Certificate/edit_citizenship_certificate_pratilipi";
$route['citizenship-certificate-pratilipi']                   = "Certificate/citizenship_certificate_pratilipi_view";
$route['citizenship-certificate-pratilipi/darta/(:num)']              = "Certificate/citizenship_certificate_pratilipi_darta";
$route['citizenship-certificate-pratilipi/chalani/(:num)']            = "Certificate/citizenship_certificate_pratilipi_chalani";
$route['citizenship-certificate-pratilipi/print/(:num)']              = "Certificate/citizenship_certificate_pratilipi_print";
$route['citizenship-certificate-pratilipi/details/(:num)']            = "Certificate/citizenship_certificate_pratilipi_details";

/*|--------------------------------------------------------------------------|*/
/*|--------------------------Nagarikta Sifaris--------------------------|*/
/*|--------------------------------------------------------------------------|*/
$route['citizenship-sifaris/create']              = 'Certificate/create_citizenship_sifaris';
$route['citizenship-sifaris/detail/(:num)']       = "Certificate/detail_citizenship_sifaris";
$route['citizenship-sifaris/edit/(:num)']         = "Certificate/edit_citizenship_sifaris";
$route['citizenship-sifaris/darta/(:num)']        = "Certificate/darta_citizenship_sifaris";
$route['citizenship-sifaris/chalani/(:num)']      = "Certificate/chalani_citizenship_sifaris";
$route['citizenship-sifaris/print/(:num)']        = "Certificate/print_citizenship_sifaris";
$route['citizenship-sifaris']                     = "Certificate/view_citizenship_sifaris";

/*|------------------------------ Nabalak Pramanit--------------------------|*/
$route['nabalak-pramanit/create']                    = "Others/create_nabalak_pramanit";
$route['nabalak-pramanit/edit/(:num)']               = "Others/edit_nabalak_pramanit";
$route['nabalak-pramanit']                           = "Others/nabalak_pramanit_view";
$route['nabalak-pramanit/darta/(:num)']              = "Others/nabalak_pramanit_darta";
$route['nabalak-pramanit/chalani/(:num)']            = "Others/nabalak_pramanit_chalani";
$route['nabalak-pramanit/print/first/(:num)']        = "Others/nabalak_pramanit_print_first";
$route['nabalak-pramanit/print/second/(:num)']       = "Others/nabalak_pramanit_print_second";
$route['nabalak-pramanit/details/(:num)']            = "Others/nabalak_pramanit_details";
/*|------------------------------ Nabalak Pramanit Ends --------------------------|*/
/*|------------------------------ ******** --------------------------|*/


/*|------------------------------ Darta Book -------------------------------------|*/
$route['darta-book']                    = "DartaChalaniBook/darta_book";
$route['darta-book/detail/(:num)']      = "DartaChalaniBook/darta_book_detail";
$route['darta-fix']                     = "DartaChalaniBook/fix_darta_no";
$route['darta-direct']                  = "DartaChalaniBook/direct_darta";
$route['darta-direct/(:num)']           = "DartaChalaniBook/edit_direct_darta";
$route['darta-book-print']              = 'DartaChalaniBook/darta_book_print';
$route['darta-book-excel']              = 'DartaChalaniBook/darta_book_excel';

/*|------------------------------ Maujuda Suchi Darta -------------------------------------|*/
$route['maujuda-suchi']                 		= "DartaChalaniBook/maujuda_suchi";
$route['maujuda-darta-book']            		= "DartaChalaniBook/maujuda_darta_book";
$route['maujuda-suchi/detail/(:num)']   		= "DartaChalaniBook/maujuda_suchi_detail";
/*|------------------------------ Sachiwalaya Darta -------------------------------------|*/
$route['sachiwalaya-darta']             		= "DartaChalaniBook/sachiwalaya_darta";
$route['sachiwalaya-darta-detail/(:num)']      	= "DartaChalaniBook/sachiwalaya_darta_detail";
$route['sachiwalaya-darta-book']        		= "DartaChalaniBook/sachiwalaya_darta_book";
$route['sachiwalaya-transfer/(:num)']   		= 'DartaChalaniBook/sachiwalaya_transfer';

/*|------------------------------ Chalani Book -------------------------------------|*/
$route['chalani-direct']                = "DartaChalaniBook/direct_chalani";
$route['edit-chalani/(:num)']           = "DartaChalaniBook/edit_direct_chalani";
$route['chalani-book']                  = "DartaChalaniBook/chalani_book";
$route['chalani-book/detail/(:num)']    = "DartaChalaniBook/chalani_book_detail";
$route['chalani-fix']                   = "DartaChalaniBook/fix_chalani_no";
$route['chalani-book-excel']            = 'DartaChalaniBook/chalani_book_excel';

/*|------------------------------ Notification -------------------------------------|*/
$route['notifications']                 	= "Notification/notification_view";
/*|------------------------------ Template Form -------------------------------------|*/
$route['letter-form/create']          		= "TemplateForm/save_template_form";
$route['letter-form/edit/(:num)']     		= "TemplateForm/save_template_form";
$route['letter-form/detail/(:num)']   		= 'TemplateForm/detail_template_form';
$route['letter-form/darta/(:num)']    		= 'TemplateForm/darta_template_form';
$route['letter-form/chalani/(:num)']  		= 'TemplateForm/chalani_template_form';
$route['letter-form/print/(:num)']    		= 'TemplateForm/print_template_form';
$route['letter-form']                 		= 'TemplateForm/view_template_form';
$route['land-type'] 						= "Settings/landType";
$route['edit-land-type/(:num)']       		= "Settings/EditLandType/";
$route['delete-land-type/(:num)']     		= "Settings/delete_land_type/";


/*|------------------------------ Birth Certificate -------------------------------------|*/
$route['birth-certificate']             		= "English/Birth";
$route['birth-certificate/create']      		= "English/Birth/create";
$route['birth-certificate/save']      			= "English/Birth/saveDetails";
$route['birth-certificate/detail/(:num)']	    = "English/Birth/birth_certificate_details";
$route['birth-certificate/edit/(:num)']	        = "English/Birth/edit_details";
$route['birth-certificate/update']	        	= "English/Birth/update";
$route['birth-certificate/darta/(:num)']	    = "English/Birth/darta_details";
$route['birth-certificate/chalani/(:num)']	    = "English/Birth/chalani_details";
$route['birth-certificate/print/(:num)']	    = "English/Birth/print";

/*|------------------------------ Address vericication -------------------------------------|*/
$route['address-verification-en']             			= "English/AddressVerification";
$route['address-verification-en/create']      			= "English/AddressVerification/create";
$route['address-verification-en/save']      			= "English/AddressVerification/saveDetails";
$route['address-verification-en/detail/(:num)']	    	= "English/AddressVerification/darta_view";
$route['address-verification-en/edit/(:num)']	        = "English/AddressVerification/edit_details";
$route['address-verification-en/update']	        	= "English/AddressVerification/update";
$route['address-verification-en/darta/(:num)']	   		= "English/AddressVerification/darta_details";
$route['address-verification-en/chalani/(:num)']	    = "English/AddressVerification/chalani_details";
$route['address-verification-en/print/(:num)']	    	= "English/AddressVerification/print";

/*|------------------------------ Relationship -------------------------------------|*/
$route['relationship']             			= "English/Relationship";
$route['relationship/create']      			= "English/Relationship/create";
$route['relationship/save']      			= "English/Relationship/saveDetails";
$route['relationship/detail/(:num)']	    = "English/Relationship/relationship_details";
$route['relationship/edit/(:num)']	        = "English/Relationship/edit_details";
$route['relationship/update']	        	= "English/Relationship/update";
$route['relationship/darta/(:num)']	   		= "English/Relationship/darta_details";
$route['relationship/chalani/(:num)']	    = "English/Relationship/chalani_details";
$route['relationship/print/(:num)']	    	= "English/Relationship/print";

/*|------------------------------ Tax Clear -------------------------------------|*/
$route['tax-clearance-en']             			= "English/Taxclear";
$route['tax-clearance-en/create']      			= "English/Taxclear/create";
$route['tax-clearance-en/save']      			= "English/Taxclear/saveDetails";
$route['tax-clearance-en/detail/(:num)']	    = "English/Taxclear/tax_details";
$route['tax-clearance-en/edit/(:num)']	        = "English/Taxclear/edit_details";
$route['tax-clearance-en/update']	        	= "English/Taxclear/update";
$route['tax-clearance-en/darta/(:num)']	   		= "English/Taxclear/darta_details";
$route['tax-clearance-en/chalani/(:num)']	    = "English/Taxclear/chalani_details";
$route['tax-clearance-en/print/(:num)']	    	= "English/Taxclear/print";
/*|--------------------------------------------------------------------------------|*/
$route['annual-income-en']             			= "English/AnnualIncome";
$route['annual-income-en/create']      			= "English/AnnualIncome/create";
$route['annual-income-en/save']      			= "English/AnnualIncome/saveDetails";
$route['annual-income-en/detail/(:num)']	    = "English/AnnualIncome/darta_view";
$route['annual-income-en/edit/(:num)']	        = "English/AnnualIncome/edit_details";
$route['annual-income-en/update']	        	= "English/AnnualIncome/update";
$route['annual-income-en/darta/(:num)']	   		= "English/AnnualIncome/darta_details";
$route['annual-income-en/chalani/(:num)']	    = "English/AnnualIncome/chalani_details";
$route['annual-income-en/print/(:num)']	    	= "English/AnnualIncome/print";

/*|--------------------------------------------------------------------------------|*/
$route['property-valuation-en']             			= "English/PropertyValuation";
$route['property-valuation-en/create']      			= "English/PropertyValuation/create";
$route['property-valuation-en/save']      			= "English/PropertyValuation/saveDetails";
$route['property-valuation-en/detail/(:num)']	    = "English/PropertyValuation/darta_view";
$route['property-valuation-en/edit/(:num)']	        = "English/PropertyValuation/edit_details";
$route['property-valuation-en/update']	        	= "English/PropertyValuation/update";
$route['property-valuation-en/darta/(:num)']	   		= "English/PropertyValuation/darta_details";
$route['property-valuation-en/chalani/(:num)']	    = "English/PropertyValuation/chalani_details";
$route['property-valuation-en/print/(:num)']	    	= "English/PropertyValuation/print";

/*|--------------------------------------------------------------------------------|*/
//name-verification-en
$route['name-verification-en']             			= "English/NameVerification";
$route['name-verification-en/create']      			= "English/NameVerification/create";
$route['name-verification-en/save']      			= "English/NameVerification/saveDetails";
$route['name-verification-en/detail/(:num)']	    = "English/NameVerification/darta_view";
$route['name-verification-en/edit/(:num)']	        = "English/NameVerification/edit_details";
$route['name-verification-en/update']	        	= "English/NameVerification/update";
$route['name-verification-en/darta/(:num)']	   		= "English/NameVerification/darta_details";
$route['name-verification-en/chalani/(:num)']	    = "English/NameVerification/chalani_details";
$route['name-verification-en/print/(:num)']	    	= "English/NameVerification/print";
/*|--------------------------------------------------------------------------------|*/
$route['unmarried-en']             			= "English/Unmarried";
$route['unmarried-en/create']      			= "English/Unmarried/create";
$route['unmarried-en/save']      			= "English/Unmarried/saveDetails";
$route['unmarried-en/detail/(:num)']	    = "English/Unmarried/darta_view";
$route['unmarried-en/edit/(:num)']	        = "English/Unmarried/edit_details";
$route['unmarried-en/update']	        	= "English/Unmarried/update";
$route['unmarried-en/darta/(:num)']	   		= "English/Unmarried/darta_details";
$route['unmarried-en/chalani/(:num)']	    = "English/Unmarried/chalani_details";
$route['unmarried-en/print/(:num)']	    	= "English/Unmarried/print";

/*|--------------------------------------------------------------------------------|*/
$route['married-en']             			= "English/Married";
$route['married-en/create']      			= "English/Married/create";
$route['married-en/save']      				= "English/Married/saveDetails";
$route['married-en/detail/(:num)']	    	= "English/Married/darta_view";
$route['married-en/edit/(:num)']	        = "English/Married/edit_details";
$route['married-en/update']	        		= "English/Married/update";
$route['married-en/darta/(:num)']	   		= "English/Married/darta_details";
$route['married-en/chalani/(:num)']	    	= "English/Married/chalani_details";
$route['married-en/print/(:num)']	    	= "English/Married/print";
/*|----------------------------------report----------------------------------------|*/
$route['darta-report'] 						= "Report/dartaReport";
$route['search-report'] 					= "Report/searchDartaReport";
$route['chalani-report'] 					= "Report/chalaniReport";
$route['search-chalani-report'] 			= "Report/searchChalaniReport";

/*|----------------------------------prashasan----------------------------------------|*/
$route['sthai-niyukti'] 					= "Prashasan/sthai_niyukti";
$route['sthai-niyukti/create'] 				= "Prashasan/sthai_niyukti_create";
$route['sthai-niyukti/details/(:num)'] 		= "Prashasan/sthai_niyukti_detail";
$route['sthai-niyukti/darta/(:num)'] 		= "Prashasan/sthai_niyukti_darta";
$route['sthai-niyukti/edit/(:num)'] 		= "Prashasan/sthai_niyukti_edit";
$route['sthai-niyukti/chalani/(:num)'] 		= "Prashasan/sthai_niyukti_chalani";
$route['sthai-niyukti/print/(:num)'] 		= "Prashasan/sthai_niyukti_print";

/*|----------------------------------sawari pass----------------------------------------|*/
$route['sawari-pass'] 						= "Prashasan/sawari_pass";
$route['sawari-pass/create'] 				= "Prashasan/sawari_pass_create";
$route['sawari-pass/details/(:num)'] 		= "Prashasan/sawari_pass_detail";
$route['sawari-pass/darta/(:num)'] 			= "Prashasan/sawari_pass_darta";
$route['sawari-pass/edit/(:num)'] 			= "Prashasan/sawari_pass_edit";
$route['sawari-pass/chalani/(:num)'] 		= "Prashasan/sawari_pass_chalani";
$route['sawari-pass/print/(:num)'] 			= "Prashasan/sawari_pass_print";

/*|----------------------------------salary verify----------------------------------------|*/
$route['salary-verify'] 					= "Prashasan/salary_verify";
$route['salary-verify/create'] 				= "Prashasan/salary_verify_create";
$route['salary-verify/details/(:num)'] 		= "Prashasan/salary_verify_detail";
$route['salary-verify/darta/(:num)'] 		= "Prashasan/salary_verify_darta";
$route['salary-verify/edit/(:num)'] 		= "Prashasan/salary_verify_edit";
$route['salary-verify/chalani/(:num)'] 		= "Prashasan/salary_verify_chalani";
$route['salary-verify/print/(:num)'] 		= "Prashasan/salary_verify_print";

/*|----------------------------------upgrade position----------------------------------------|*/
$route['upgrade-position/create'] 			= "Prashasan/upgrade_position_create";
$route['upgrade-position/details/(:num)'] 	= "Prashasan/upgrade_position_detail";
$route['upgrade-position/darta/(:num)'] 	= "Prashasan/upgrade_position_darta";
$route['upgrade-position/edit/(:num)'] 		= "Prashasan/upgrade_position_edit";
$route['upgrade-position/chalani/(:num)'] 	= "Prashasan/upgrade_position_chalani";
$route['upgrade-position/print/(:num)'] 	= "Prashasan/upgrade_position_print";
$route['upgrade-position'] 					= "Prashasan/upgrade_position_view";

/*|----------------------------------hajiri----------------------------------------|*/
$route['hajiri/create'] 			= "Prashasan/hajiri_create";
$route['hajiri/details/(:num)'] 	= "Prashasan/hajiri_detail";
$route['hajiri/darta/(:num)'] 		= "Prashasan/hajiri_darta";
$route['hajiri/edit/(:num)'] 		= "Prashasan/hajiri_edit";
$route['hajiri/chalani/(:num)'] 	= "Prashasan/hajiri_chalani";
$route['hajiri/print/(:num)'] 		= "Prashasan/hajiri_print";
$route['hajiri'] 					= "Prashasan/hajiri";

/*|----------------------------------kaam_kaz----------------------------------------|*/
$route['kaam-kaz/create'] 			= "Prashasan/kaam_kaz_create";
$route['kaam-kaz/details/(:num)'] 	= "Prashasan/kaam_kaz_detail";
$route['kaam-kaz/darta/(:num)'] 	= "Prashasan/kaam_kaz_darta";
$route['kaam-kaz/edit/(:num)'] 		= "Prashasan/kaam_kaz_edit";
$route['kaam-kaz/chalani/(:num)'] 	= "Prashasan/kaam_kaz_chalani";
$route['kaam-kaz/print/(:num)'] 	= "Prashasan/kaam_kaz_print";
$route['kaam-kaz'] 					= "Prashasan/kaam_kaz";

/*|----------------------------------karar-niyukti----------------------------------------|*/
$route['karar-niyukti/create'] 			= "Prashasan/karar_niyukti_create";
$route['karar-niyukti/details/(:num)'] 	= "Prashasan/karar_niyukti_detail";
$route['karar-niyukti/darta/(:num)'] 	= "Prashasan/karar_niyukti_darta";
$route['karar-niyukti/edit/(:num)'] 	= "Prashasan/karar_niyukti_edit";
$route['karar-niyukti/chalani/(:num)'] 	= "Prashasan/karar_niyukti_chalani";
$route['karar-niyukti/print/(:num)'] 	= "Prashasan/karar_niyukti_print";
$route['karar-niyukti'] 				= "Prashasan/karar_niyukti";

/*|---------------------------------approve wiwaran----------------------------------------|*/
$route['approve-wiwaran/create'] 			= "Prashasan/approve_wiwaran_create";
$route['approve-wiwaran/details/(:num)'] 	= "Prashasan/approve_wiwaran_detail";
$route['approve-wiwaran/darta/(:num)'] 		= "Prashasan/approve_wiwaran_darta";
$route['approve-wiwaran/edit/(:num)'] 		= "Prashasan/approve_wiwaran_edit";
$route['approve-wiwaran/chalani/(:num)'] 	= "Prashasan/approve_wiwaran_chalani";
$route['approve-wiwaran/print/(:num)'] 		= "Prashasan/approve_wiwaran_print";
$route['approve-wiwaran'] 					= "Prashasan/approve_wiwaran";

