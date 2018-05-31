<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		// $this->config_model->validate_login_administrator();
		$this->load->model('checkout_model');
		$this->load->model('user_model');
	}

	function ajax($id = null) {
		// authentikasi login
		if($id == 'auth_login') {
			$t_username = $this->input->post('t_username');
			$t_password = anti_injection($this->input->post('t_password'));
			//
			if($t_username != '' && $t_password != '') {
				$validate = $this->config_model->auth_login_administrator($t_username, $t_password);
				//
				if($validate == '1') {
					echo json_encode(array(
						'result' 	=> 'true', 
						'redirect' 	=> site_url('webmin/dashboard')
					));
				} elseif($validate == '2') {
					echo json_encode(array(
						'result' 	=> 'false', 
						'message' 	=> '<i></i>Maaf, Username ini tidak aktif !', 
					));
				} else {
					echo json_encode(array(
						'result' 	=> 'false', 
						'message' 	=> '<i class="fa fa-times"></i> Maaf, Username dan/atau password Anda salah, silakan coba lagi', 
					));
				}		
			} else {
				redirect('');
			}	
		}else if($id == 'validate_username') {
			$username = $this->input->get('username');
			$user_id = $this->session->userdata('ses_user_id');
			$validate = $this->user_model->validate_username_administrator($username, $user_id);
			//
			$result = "true";
			if($validate == true) $result = "false";
			//
			echo json_encode(array(
				'result' => $result
			));
		}
	}

	function index() {	
		$ses_login_administrator = $this->session->userdata('ses_login_administrator');
		if($ses_login_administrator == '1'){
			redirect('webmin/dashboard');
		}
		$data['ses_customer_id'] = $this->session->userdata('ses_customer_id');
		if ($data['ses_customer_id'] != '') {
			redirect('webmin/logout_customer');
		}
		//
		$this->load->view('webmin/login/header');		
		$this->load->view('webmin/login/index');
	}

	function buyer($p=1, $o=0) {
		// get data
		$status = $this->input->get('status');
		$search = $this->input->get('search');
		//Data Pembeli Terbaru
		$paging = $this->checkout_model->paging_all_buyer($p,$o,$status,$search);
		$list_buyer = $this->checkout_model->get_all_buyer($o, $paging->offset, $paging->per_page, $status, $search);
		//
		$html = '';
			foreach ($list_buyer as $data){
		$html.= '<tr>
                    <td align="center">'.$data['no'].'</td>';
                if ($data['customer_id'] !='') {
		$html.='    <td>'.$data['customer_nm'].'</td>';
                }else{
        $html.='    <td>'.$data['pembeli_nm'].'</td>';
				}
        $html.='	<td align="center"><div class="nominal">Rp '.digit($data['product_total_price']).'</div></td><td>';
        if ($data['diterima_st'] == '1') {
        $html.=' 	<label class="label label-primary">Sudah Diterima</label>';
        }else{
       		if ($data['transfer_st'] == '2') {
		$html.=' 	<label class="label label-primary">Menunggu Konfirmasi Admin</label>';		
			}else {
                if ($data['bayar_st'] == '1') {
        $html.=' 	<label class="label label-success">Sudah Bayar</label>';
                }elseif ($data['bayar_st'] == '2') {
        $html.=' 	<label class="label label-warning">Belum Bayar</label>';
                }
            }
        $check_kirim_st = $this->checkout_model->check_kirim_st($data['billing_id']);        

                if ($check_kirim_st == '') {
        $html.=' 	<label class="label label-success">Sudah Kirim</label>';
                }elseif ($check_kirim_st != '') {
                	if ($data['bayar_st'] == '1') {
        $html.=' 	<label class="label label-danger">Belum Kirim</label>';
        			}
                }
        }
        $html.='</td></tr>';
            }
            if (count($list_buyer) == 0) {
        $html.='<tr>
        			<td colspan="5">Tidak ada data</td>
        		</tr>';
            }

           		if(count($list_buyer) > 0){
        $html.='<tr>
	        		<td colspan="5" align="center" style="background-color: white;">
		        		<ul class="pagination" style="margin-top: 0px; margin-bottom: 0px;">';
	               	if($paging->start_link){
		$html.='	        <li><a href="'.site_url("webmin/buyer/$paging->c_start_link/$o").'?status='.$status.'&search='.$search.'" class="link_pagination"><span><i class="fa fa-angle-double-left"></i></span></a></li>';
	                }
	                if($paging->prev){
	    $html.='            <li><a href="'.site_url("webmin/buyer/$paging->prev/$o").'?status='.$status.'&search='.$search.'" class="link_pagination"><span><i class="fa fa-angle-left"></i></span></a></li>';
	                }

	                for($i = $paging->c_start_link; $i <= $paging->c_end_link; $i++){
	                	if ($p == $i) {
	    $html.='			<li class="active">';
	                	}else{
	    $html.='			<li>';
	                	}
	    $html.='				<a href="'.site_url("webmin/buyer/$i/$o").'?status='.$status.'&search='.$search.'" class="link_pagination">'.$i.'</a>
	    					</li>';
	                        }

	                if($paging->next){
	    $html.='            <li><a href="'.site_url("webmin/buyer/$paging->next/$o").'?status='.$status.'&search='.$search.'" class="link_pagination"><span><i class="fa fa-angle-right"></i></span></a></li>';
	                        }
	                        
	                if($paging->end_link){
	    $html.='            <li><a href="'.site_url("webmin/buyer/$paging->c_end_link/$o").'?status='.$status.'&search='.$search.'" class="link_pagination"><span><i class="fa fa-angle-double-right"></i></span></a></li>';
	                        }
	    $html.='		</ul>
	                </td>
                </tr>
        		';
        		}
        $html.="<script>
					$(function() {
						$('.link_pagination').bind('click',function(e) {
						    e.preventDefault();
						    $(this).each(function() {
						    	var i = $(this).attr('href');
						    	$.get(i,null,function(data) {
						    		$('#box_result').html(data.html); 
						    	}, 'json');
						    })
						});;
					});
				</script>";


		//Data Chart
		$get_bulan = $this->checkout_model->get_bulan();
		$list_bulan = $this->checkout_model->list_bulan();
		$list_jumlah_pembeli = $this->checkout_model->list_jumlah_pembeli();
		//
		$chart = '';
        $chart.="<script>
				    Highcharts.chart('container', {
				        chart: {
				            type: 'column'
				        },
				        title: {
				            text: 'Jumlah Pembeli Tahun ".date('Y')."'
				        },
				        credits: {
				            enabled: false
				        },
				        xAxis: {
				            categories: [".$list_bulan."],
				            crosshair: true
				        },
				        yAxis: {
				            min: 0,
				            title: {
				                text: 'Jumlah Pembeli/Orang'
				            }
				        },
				        tooltip: {
				            headerFormat: '<span style=font-size:10px>{point.key}</span><table class=table-no-border>',
				            pointFormat: '<tr>' +
				                '<td style=padding:0><b>{point.y:1f} Pembeli</b></td></tr>',
				            footerFormat: '</table>',
				            shared: true,
				            useHTML: true
				        },
				        plotOptions: {
				            column: {
				                pointPadding: 0.2,
				                borderWidth: 0
				            }
				        },
				        series: [{
				            name: 'Data Pembeli',
				            data: [".$list_jumlah_pembeli."]
				        }]
				    });
				</script>";

		//Data Jumlah Pembeli
		$count_buyer = $this->checkout_model->count_buyer($status,$search);
		//
		$count = "";
		$count .= $count_buyer." Orang";
		echo json_encode(array(
			'html' => $html,
			'chart' => $chart,
			'count' => $count
		));
	}

	function dashboard() {	
		$this->config_model->validate_login_administrator();
		//
		$data['config'] = $this->config_model->general();
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/dashboard/index');
		$this->load->view('webmin/main/footer');
	}

	function form($billing_id=null) {	
		$data['config'] = $this->config_model->general();
		//
		$data['form_action'] = site_url('webmin/update/'.$billing_id);
		$data['main'] = $this->checkout_model->get_billing_edit($billing_id);
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/dashboard/form', $data);
		$this->load->view('webmin/main/footer');
	}

	function update($billing_id) {
		$this->checkout_model->update_status($billing_id);
		redirect('webmin/dashboard');
	}

	function update_administrator($user_id) {
		$this->user_model->update_administrator($user_id);
		redirect('webmin/dashboard');
	}

	function logout() {
		//$this->config_model->set_logoff();
		//
		$ses_data = array(
			'ses_login_administrator'   => false,
            'ses_user_id'               => false,
            'ses_user_name'             => false,
            'ses_user_realname'         => false,
            'ses_user_st'               => false,
            'ses_user_photo'            => false,
            'ses_user_group'            => false
		);       
        $this->session->unset_userdata($ses_data);
        // $this->session->sess_destroy();
        redirect('webmin');
	}

	function logout_customer() {
		//$this->config_model->set_logoff();
		//
		$ses_data = array(
			'ses_login'                => false,
            'ses_customer_id'          => false,
            'ses_customer_nm'          => false,
            'ses_customer_chat_nm'     => false,
            'ses_customer_address'     => false,
            'ses_customer_phone'       => false,
            'ses_customer_email'       => false,
            'ses_customer_username'    => false,
            'ses_customer_sex'         => false,
            'ses_customer_st'          => false,
            'ses_customer_img'         => false,
            'ses_register_date'        => false
		);       
        $this->session->unset_userdata($ses_data);
        // $this->session->sess_destroy();
        redirect('webmin');
	}

	function location($act=null,$id=null) {
		//
		unset_session('ses_txt_search,ses_parameter_group,ses_txt_search_provinsi,ses_txt_search_kabupaten,ses_txt_search_kecamatan,ses_txt_search_kelurahan,ses_category_parent,ses_usergroup,ses_status,filter_search,ses_billing_date,ses_tampilan_data_1,ses_tampilan_data_2,ses_tahun,ses_bulan');
		//
		if ($act !='') {
			if($id != '') {
				redirect('webmin_'.$act.'/'.$id);	
			} else {
				redirect('webmin_'.$act);
			}	
		} else {
			redirect('webmin');
		}
	}	
}