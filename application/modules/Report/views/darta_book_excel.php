<table border='1'>
<tr>
        <th colspan = "7"><?php echo $uridetails->name?></th>
      </tr>
          <tr>
              <th scope="col">क्र.सं.</th>
              <th scope="col">दर्ता नं.</th>
              <th scope="col">दर्ता मिति</th>
              <th scope="col">पत्र संख्या</th>
              <th scope="col">पठाउने कार्यालय वा व्यक्तिको विवरण</th>
              <th scope="col">प्राप्त पत्रको विवरण</th>
              <th scope="col">बुझिलिनेको नाम</th>
              
          </tr>
      </thead>
      <tbody>
          <?php
              if(!isset($darta_list) || $darta_list == FALSE)
              {
                  ?>
                  <tr>

                      <td class="text-danger text-center" colspan="8"><h5>डाटाबेसमा कुनै डाटा छैन | </h5></td>
                  </tr>
                  <?php
              }
              else
              {
                  $i = 1;
                  foreach($darta_list as $data)
                  {
                      if(!empty($data->uri))
                      {
                          $patra          = Modules::run("Settings/getPatraItemByURI",$data->uri);
                          $letter_subject = $patra->name;
                      }
                      else
                      {
                          $letter_subject = $data->letter_subject;
                      }
                      $session = Modules::run('Settings/getSession',$data->session_id);
                      $user = $this->Mdl_user->getById($data->user_id);
                      ?>
                      <tr>
                          <td> <?= $i ?> </td>
                          <td> <?= $data->darta_no?> </td>
                          <td> <?= $data->nepali_darta_miti ?></td>
                          <td> <?= $session->name ?>   </td>
                          <td> <?= $data->applicant_name ?> </td>
                          <td> <?= $data->letter_subject ?> </td>
                          <td> <?= ($user != FALSE) ? $user->name : '-'?> </td>
                         
                      </tr>
                  <?php
                  $i++;
              }
          } ?>
      </tbody>
  </table>