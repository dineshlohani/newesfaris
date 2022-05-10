<table border='1'>
    <thead class="thead-light">
      <tr>
        <th colspan = "7"><?php echo $uridetails->name?></th>
      </tr>
    <tr>
        <th scope="col">चलानी नं.</th>
        <th scope="col">चलानी मिति</th>
        <th scope="col">पत्र संख्या</th>
        <th scope="col">पठाउने कार्यालय वा व्यक्तिको विवरण</th>
        <th scope="col">पत्रको विषय</th>
        <th scope="col">फाँट</th>
        <th scope="col">बुझिलिनेको नाम</th>
    </tr>
    </thead>
    <tbody>
        <?php
            if(!isset($result) || $result == FALSE)
            {
        ?>
        <tr>

                <td class="text-danger text-center" colspan="8"><h5>डाटाबेसमा कुनै डाटा छैन | </h5></td>


        </tr>
        <?php
            }
            else
            {
                foreach($result as $data)
                {
                    if(!empty($data->uri))
                    {
                        $patra = Modules::run("Settings/getPatraItemByURI",$data->uri);
                        $letter_subject = $patra->name;
                    }
                    else
                    {
                        $letter_subject = $data->letter_subject;
                    }
                    if(!empty($data->department))
                    {
                        $department_detail  = Modules::run('Settings/getDepartment',$data->department);
                        $department         = $department_detail->name;
                    }
                    else
                    {
                        $department         = $data->department_other;
                    }
                    $session = Modules::run('Settings/getSession',$data->session_id);
                   $user = $this->Mdl_user->getById($data->user_id);

        ?>
        <tr>
                <td> <?= $data->chalani_no?> </td>
                <td> <?= $data->nepali_chalani_miti ?></td>
                <td> <?= $session->name ?>   </td>
                <td> <?= $data->applicant_name ?> </td>
                <td> <?= $letter_subject ?> </td>
                <td> <?= $department ?> </td>
                <td> <?= ($user != FALSE) ? $user->name : '-'?> </td>

        </tr>
        <?php

                }
            }
        ?>



    </tbody>
</table>
